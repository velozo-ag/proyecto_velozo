<section class="contacto">
    <div class="descripcion mx-5">
        <h2>Contactanos!</h2>
        <p>¿Tienes alguna pregunta, comentario o sugerencia? ¡Nos encantaría saber de ti! Puedes ponerte en contacto con nuestro equipo de atención al cliente de las siguientes maneras:</p>
        <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>
    </div>
    <div class="formulario-ubicacion row my-2">

        <form action="<?php echo base_url('ConsultaController/enviarConsulta'); ?>" method="post" class="email-form col-lg-4">

        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo session()->get('nombre') ?>" disabled>
        <input type="text" name="apellido" placeholder="Apellido" value="<?php echo session()->get('apellido') ?>" disabled>
            <input type="text" name="email" placeholder="E-mail" value="<?php echo session()->get('email') ?>" disabled>

            <textarea type="text" maxlength="255" name="mensaje" placeholder="Mensaje"></textarea>
            <button class="boton-enviar">enviar</button>
        </form>
        <iframe class="col-lg-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1263.1326044850537!2d-58.833408619547406!3d-27.466797201012003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456ca6d24ec0c9%3A0xb92ce3fedb0d7729!2sFacultad%20de%20Ciencias%20Exactas%20y%20Naturales%20y%20Agrimensura!5e0!3m2!1ses-419!2sar!4v1713396674015!5m2!1ses-419!  2sar" width="100%" height="250px" style="border:solid 1px #2b1603; border-radius:10px; width: 80%; margin: auto;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="contact-info container">
        <div class="px-5 pt-3 my-4" style="border:solid 1px #2b1603; border-radius: 10px;">
            <p><b>Nombre de Titular:</b> RoastCafe Company</p>
            <p><b>Razon Social:</b> S.A</p>
            <p><b>Domicilio Legal:</b> 9 de Julio 1449, W3400 AZB Corrientes, Corrientes Capital</p>
            <p><b>Telefono:</b> +54 0379 4123456</p>
            <p><b>Correo:</b> roast-cafe@contacto.com</p>
        </div>
    </div>
</section>