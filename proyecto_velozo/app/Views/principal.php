<!DOCTYPE html>
<html lang="en">

<body>
    <main class="principal">
        <section class="hero d-flex flex-column align-items-center">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo base_url('/assets/img/banners/Banner4.png'); ?>"
                            class="img-fluid d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('/assets/img/banners/Banner5.png'); ?>"
                            class="img-fluid d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('/assets/img/banners/Banner6.png'); ?>"
                            class="img-fluid d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon ccontrol" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon ccontrol" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="breve-desc p-4 text-center">
                <h6 class="m-1">Descubre Nuestros Cafés Instantáneos</h6>
                <p class="m-1">Explora nuestra variedad de sabores exquisitos y disfruta del auténtico sabor del café en
                    segundos. Nuestros cafés instantáneos están listos para satisfacer tus ansias de café en cualquier
                    momento.</p>
            </div>
        </section>
        <section class="productos-principales py-4">
            <h2 class="titulo-seccion">Productos Principales</h2>
            <div class="row justify-content-center column-gap-2 row-gap-2 my-2">
                <?php foreach ($productos as $producto): ?>
                    <div class="card col-2 my-4 mt-2 producto" style="width: 18rem;">
                        <img src="<?php echo base_url("/assets/img/thumbnails/" . $producto['imagen']); ?>"
                            class="card-img-top my-2" alt="...">
                        <div class="card-body text-center my-2 p-0">
                            <h4 class="card-title"><?php echo $producto['nombre'] ?></h4>
                            <h6 class="my-0">$<?php echo $producto['precio_venta'] ?></h6>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <a class="boton-catalogo" href="<?php echo base_url('catalogo') ?>">Ver mas Productos</a>
            </div>
        </section>
        <section class="descubrenos">
            <h2 class="titulo-seccion">Descubre nuestros granos</h2>
            <p>Conoce nuestra colección de cafés <u>premium</u>, cada uno cuidadosamente seleccionado y preparado para
                ofrecerte una experiencia <u>única</u> en cada taza. Desde el oscuro y audaz hasta el suave y
                equilibrado, tenemos el café <u>perfecto</u> para satisfacer todos los paladares y preferencias.</p>
            <div class="card mb-3 tarjeta-tipos-cafe">
                <div class="row g-0 text-center align-items-center">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('/assets/img/photos/fabrica2.png'); ?>"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text">Empieza tu día con nuestra delicia del amanecer, <u>Dawn Delight</u>.
                                Un tostado ligero y un perfil de sabor floral y afrutado. Perfecto para aquellos que
                                buscan una taza sutil para comenzar el día con <u>tranquilidad y energía</u>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3 tarjeta-tipos-cafe">
                <div class="row g-0 text-center align-items-center ">
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text">Sumérgete en la magia de la noche con nuestro café <u>Midnight
                                    Magic</u>. Un tostado oscuro profundo y un perfil de sabor rico y audaz. Perfecto
                                para los amantes del café que aprecian la <u>robustez y la elegancia</u> en cada sorbo.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo base_url('/assets/img/photos/almacen2.png'); ?>"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                </div>
            </div>

            <p>Te invitamos a descubrir el mundo de los cafés especiales y a explorar las diversas características y
                perfiles de sabor que ofrecen nuestras especialidades. Con cada taza, te llevamos en un viaje sensorial
                único que despertará tus sentidos y te hará apreciar la belleza y la diversidad del café.</p>

        </section>
    </main>
</body>

</html>