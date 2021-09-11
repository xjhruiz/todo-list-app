<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/sweetalert.min.js" />

</head>

<body>
    <div class="separador-top">

    </div>
    <header class="cabecera">
        <div class="contenedor-cabecera">
            <div class="title-header">
                <a href="/"><span>TODO-LIST</span></a>
            </div>
            <div class="menu-contenedor">
                <a class="container-burger-icon" href="#">
                    <div class="burger-icon" aria-hidden="true">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <nav class="menu">
                    <ul class="menu-item">
                        <li class="menu-subitem"><a href="/aboutme"><span>About Me</span></a></li>
                        <li class="menu-subitem"><a href="/logout"><span class="active">Logout</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <hr>
    <main>
        <div class="contenido">
            <?php echo $contenido ?>
        </div>
    </main>

    <?php include 'footer.php' ?>