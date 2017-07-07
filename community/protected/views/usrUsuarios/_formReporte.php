<?php echo CHtml::beginForm(); ?>


<div class="row">
        
        <?php echo CHtml::dropDownList("txt_tipo_incidencia", "", array("Pago con tarjeta"=>"Pago con tarjeta", "Pago con ticket de pago"=>"Pago con ticket de pago", "Pago con Paypal"=>"Pago con Paypal", "Cargando fotos"=>"Cargando fotos", "Otro"=>"Otro"))?>
    </div>

<div class="row">
    
        <?php echo CHtml::textArea("txt_descripcion")?>
    </div>

<div class="row submit">
        <?php echo CHtml::submitButton('Reportar'); ?>
    </div>

<?php echo CHtml::endForm(); ?>
