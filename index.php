<?php

//Include Configuration File
include('config.php');

$login_button = '';

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        // if (!empty($data['gender'])) {
        //     $_SESSION['user_gender'] = $data['gender'];
        // }

        // if (!empty($data['picture'])) {
        //     $_SESSION['user_image'] = $data['picture'];
        // }
    }
}

//Ancla para iniciar sesión
if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" style=" background: #dd4b39; border-radius: 10px; color: white; display: block; font-weight: bold; padding: 20px; text-align: center; text-decoration: none; width: 100%;">Registro con Google</a> <hr>
    <a href="#" style=" background: #1f2fd8; border-radius: 10px; color: white; display: block; font-weight: bold; padding: 20px; text-align: center; text-decoration: none; width: 100%;">Registro con Facebok</a>';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro con Google</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container pt-5">
        <div class="frmData">
            <?php
            if ($login_button == '') { ?>
                <div class="card">
                    <div class="card-header">
                        <h3>Gracias <b><?php echo $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] ?> </b>, por favor completa la siguiente información para completar tu registro</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="fname" value="<?php echo $_SESSION['user_first_name'] ?>">
                            <input type="hidden" name="lname" value="<?php echo $_SESSION['user_last_name'] ?>">
                            <input type="hidden" name="email" value="<?php echo $_SESSION['user_email_address'] ?>">
                            <div class="w-100">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tipo de Identificación</td>
                                            <td>
                                                <select id="id_identificacion" name="id_identificacion" class="form-control">
                                                    <option value="1">Nacional</option>
                                                    <option value="2">DIMEX</option>
                                                    <option value="3">Pasaporte</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Identificación</td>
                                            <td>
                                                <input type="text" id="identificacion" name="identificacion" class="form-control" placeholder="Consta de 9 dígitos numéricos" maxlength="9" minlength="9">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Teléfono</td>
                                            <td>
                                                <input type="text" id="telefono" name="telefono" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Establezca su clave:</td>
                                            <td><input type="password" id="clave" name="clave" class="form-control" autocomplete="off">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Confirmar clave</td>
                                            <td><input type="password" id="clave2" name="clave2" class="form-control" autocomplete="off">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p id="checkaccept"><input type="checkbox"> Estoy de acuerdo con la politica de <a style="text-decoration: underline" target="_blank" href="terminos_condiciones.pdf">Términos de Servicio</a> y <a style="text-decoration: underline" target="_blank" href="politica_privacidad.pdf">Politica de Privacidad</a> los cuales acepto expresamente al marcar esta casilla y continuar con el registro</p>
                            </div>
                            <input class="btn btn-primary" type="button" onclick="val()" value="Registrarme">
                            <input class="btn btn-secondary" type="button" onclick="location.href = 'logout.php'" value="Salir">
                        </form>
                    </div>
                </div>

            <?php } else { ?>
                <div style="align-items: center;"><?php echo $login_button ?> </div>
            <?php } ?>
        </div>
        <a href="https://wa.me/50683182537" class="float" target="_blank">
            <i class="fas fa-whatsapp my-float"></i>
        </a>
    </div>

    <script src="functions.js"></script>
</body>

</html>