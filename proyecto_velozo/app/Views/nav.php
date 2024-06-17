<?php $url = $_SERVER['REQUEST_URI']; ?>

<?php if (session()->get('logged_in') && (session()->get('perfil_id') == 2)): ?>
    <div class="top-line">Bienvenid@ <?= session()->get('usuario') ?></div>
<?php endif ?>
<?php if (session()->get('logged_in') && (session()->get('perfil_id') == 1)): ?>
    <div class="top-line">Bienvenid@ Admin, <?= session()->get('usuario') ?></div>
<?php endif ?>

<div class="container">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url('http://localhost/'); ?>">
                <img class="img-fluid" src="<?php echo base_url('/assets/img/LogoRoastCafe.png'); ?>"></img>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (session()->get('logged_in') && (session()->get('perfil_id') == 1)): ?>

                    <?php else: ?>

                        <li class="nav-item mx-2"><a
                                class="nav-link <?= ($url == "/" . "proyecto_velozo/") ? 'activo' : '' ?>"
                                href="http://localhost/proyecto_velozo/">inicio</a>
                        </li>

                        <li class="nav-item mx-2"><a
                                class="nav-link <?= ($url == '/proyecto_velozo/catalogo') ? 'activo' : '' ?>"
                                href="http://localhost/proyecto_velozo/catalogo">catalogo</a></li>

                        <li class="nav-item mx-2"><a
                                class="nav-link <?= ($url == '/proyecto_velozo/quienes-somos') ? 'activo' : '' ?>"
                                href="http://localhost/proyecto_velozo/quienes-somos">quienes somos</a></li>

                        <li class="nav-item mx-2"><a
                                class="nav-link <?= ($url == '/proyecto_velozo/comercializacion') ? 'activo' : '' ?>"
                                href="http://localhost/proyecto_velozo/comercializacion">comercializacion</a></li>

                        <?php if (session()->get('logged_in')): ?>
                            <li class="nav-item mx-2"><a
                                    class="nav-link <?= ($url == '/proyecto_velozo/consulta') ? 'activo' : '' ?>"
                                    href="http://localhost/proyecto_velozo/consulta">consultas</a></li>
                        <?php else: ?>
                            <li class="nav-item mx-2"><a
                                    class="nav-link <?= ($url == '/proyecto_velozo/contacto') ? 'activo' : '' ?>"
                                    href="http://localhost/proyecto_velozo/contacto">contacto</a></li>
                        <?php endif ?>

                        <li class="nav-item mx-2"><a
                                class="nav-link <?= ($url == '/proyecto_velozo/terminos-usos') ? 'activo' : '' ?>"
                                href="http://localhost/proyecto_velozo/terminos-usos">términos y usos</a></li>

                    <?php endif ?>




                    <?php if (session()->get('logged_in') && (session()->get('perfil_id') == 1)): ?>

                        <li class="nav-item mx-2"><a
                                class="nav-link <?= ($url == '/proyecto_velozo/panelAdmin') ? 'activo' : '' ?>"
                                href="http://localhost/proyecto_velozo/panelAdmin">Panel de Administracion</a>
                        </li>
                        <li class="nav-item mx-2"><a
                                class="nav-link <?= ($url == '/proyecto_velozo/catalogo') ? 'activo' : '' ?>"
                                href="http://localhost/proyecto_velozo/catalogo">catalogo</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Administrar
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="http://localhost/proyecto_velozo/adminUsuarios">Usuarios</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="http://localhost/proyecto_velozo/adminProductos">Productos</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="http://localhost/proyecto_velozo/adminConsultas">Consultas</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="http://localhost/proyecto_velozo/adminVentas">Ventas</a></li>

                            </ul>
                        </li>
                    <?php endif ?>
                </ul>

                <?php if (session()->get('logged_in')): ?>
                    <ul class="navbar-nav mt-2">
                        <li class="nav-item mx-2">
                            <a class="nav-link  <?= ($url == '/proyecto_velozo/carrito') ? 'activo' : '' ?>"
                                href="http://localhost/proyecto_velozo/carrito">carrito</a>
                        </li>
                        <a class="btn btn-outline-danger d-flex m-1" type="submit"
                            href="<?php echo base_url('LoginController/logout') ?>">Logout</a>
                    </ul>
                <?php endif ?>

                <?php if (!session()->get('logged_in')): ?>
                    <a class="btn btn-outline-success d-flex m-1" type="submit"
                        href="http://localhost/proyecto_velozo/login">Login</a>
                    <a class="btn btn-outline-success d-flex m-1" type="submit"
                        href="http://localhost/proyecto_velozo/registro">Registrar</a>
                <?php endif ?>

            </div>
        </div>
    </nav>
</div>