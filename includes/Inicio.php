<?php
error_reporting(0);
include_once('db.php');
session_start();
if (isset($_SESSION['id_usuario'])) {
    session_start();
    session_destroy();
}

$usuario = mysqli_real_escape_string($conectar, $_POST['Usuario']);
$contraseña = mysqli_real_escape_string($conectar, $_POST['password']);
$encriptada = sha1($contraseña);

$sql = "SELECT id, id_cargo FROM usuarios WHERE email='$usuario' AND contrasena = '$encriptada' AND activacion = 1";
$resultado = $conectar->query($sql);
$rows = mysqli_fetch_array($resultado);

if ($rows['id_cargo'] == 1) {
    $row = $resultado->fetch_assoc();
    $_SESSION['id_usuario'] = utf8_decode($row['id']);
    header("location: dashboardD.php");
} else {
    if ($rows['id_cargo'] == 2) {
        $_SESSION['id_usuario'] = utf8_decode($row['id']);
        header("location: dashboardE.php");
    } else {
        if ($rows['id_cargo'] == 3) {
            $_SESSION['id_usuario'] = utf8_decode($row['id']);
            header("location: ../includes/dashboardA.php");
        } else {
            $sql = "SELECT id FROM usuarios WHERE email='$usuario' AND contrasena = '$encriptada' AND activacion = 0";
            $resultado = $conectar->query($sql);
            $rows = $resultado->num_rows;
            if ($rows > 0) {
                $res = "Su usuario se encuentra inactivo";
                $res1 = "Verifique la validacion en su correo o comuniquese con un administrador";
            } else {
                $res = "Usuario o contraseña invalidos";
                $res1 = "valide los datos e intente nuevamente";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="Es-es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../css/Inicio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light bg-opacity-50">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="Index.html">
                <img class="varr" src="../Imagenes/favicon.png" alt="Logo" width="300" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-1 mb-lg-0">
                    <li class="navbar-brand me-5">
                        <a class="nav-link active" aria-current="page" href="Modulos.html">Modulos</a>
                    </li>
                    <li class="navbar-brand me-5">
                        <a class="nav-link active" href="ventajas.html">Ventajas</a>
                    </li>
                    <li class="navbar-brand me-5">
                        <a class="nav-link active" href="contacto.html">Contacto</a>
                </ul>

                <form class="d-flex">
                    <a class="btn btn-dark me-2 btn-lg border rounded-pill" href="Inicio.html" role="button">Iniciar
                        sesion</a>
                    <a class="btn btn-dark me-2 btn-lg border rounded-pill" href="registrar.html" role="button">Registrarse</a>

                </form>
            </div>
        </div>
    </nav>

    <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
        <strong> <?php echo $res ?> </strong><?php echo $res1 ?>
        <button id="boton" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


    <div class="container-fluid">
        <div class="content">
            <div class="container m-5 ">
                <div class="row">
                    <div class="col-6 p-0 d-flex">
                        <img class="ms-auto" src="../Imagenes/fondolog.jpg" alt="Jugador Basquet" height="590vh" width="532vh">
                    </div>
                    <div class="background col-5 px-3 py-5">
                        <div class="container mt-4">
                            <form id="form" class="row g-3" action="../includes/Inicio.php" method="post">
                                <div class="col-12 mb-3">
                                    <h1 class>Iniciar sesion</h1>
                                </div>
                                <div class="col-12">
                                    <label for="NombreInput" class="form-label"><b>Correo Usuario</b></label>
                                    <input type="text" class="form-control form-control-lg" name="Usuario" id="Usuario" placeholder="Escribe tu Correo" required>
                                </div>

                                <div class="col-12 mt-4">
                                    <label for="ApellidosInput" class="form-label"><b>Contraseña</b></label>
                                    <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Escribe tu Contraseña" required>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Politica de privacidad
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-12 mt-4">
                                    <button id="liveAlertBtn" type="submit" class="btn btn-warning border rounded-pill "><b>Ingresa</b>
                                    </button>
                                </div>

                                <div class="col-10 mt-3">
                                    <p>No tienes una cuenta, da click <a href="../html/registrar.html">Aqui</a></p>
                                    <p>¿Has olvidado tu contraseña? da click <a href="../html/recuperarcontraseña.html">Aqui</a></p>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>