<?php
require(dirname(__FILE__) . '/Openpay.php');

$monto = 7;
$desc  = "Desc";


$openpay = Openpay::getInstance('muqckh3xbqhszkgapcer','sk_e4b7e0e618804517bea2a0fef5e0609e');

$chargeData = array(
    'method' => 'store',
    'amount' => (float)$monto,
    'description' => $desc
	);
$charge = $openpay->charges->create($chargeData);
?>
<?php //print_r($_POST);?>
<hr>


id: <?=$charge->id?><br>
Descripción:<?=$charge->description?><br>
Error Message: <?=$charge->error_message?><br>
Autorización: <?=$charge->authorization?><br>
Monto: <?=$charge->amount?><br>
Tipo de operacion: <?=$charge->operation_type?><br>
barcode url: <img src="<?=$charge->payment_method->barcode_url?>"><br>
Reference: <?=$charge->payment_method->reference?><br>
Número de orden: <?=$charge->order_id?><br>
Tipo de transacción: <?=$charge->transaction_type?><br>
Fecha de creación: <?=$charge->creation_date?><br>
Tipo de moneda: <?=$charge->currency?><br>
Estatus: <?=$charge->status?><br>
Metodo de pago: <?=$charge->method?><br>

<?php //print_r($charge);?>


<section class="payment-screen-openpayReceipt-template">
	<div class="op-receipt-container">
		<div class="op-receipt-header">
		<div class="op-receipt-store-logo">
	    	<img src="<?= $url = plugins_url(); ?>/2gomPhotoContest/Openpay/recibo/images/logo.png" alt="Logo del Comite Fotográfico Mexicano">
	    </div>
	    <div class="op-receipt-paynet-logo">
	    	<div>Plataforma de Pago</div>
	    	<img src="<?= $url = plugins_url(); ?>/2gomPhotoContest/Openpay/recibo/images/paynet_logo.png" alt="Logo Paynet">
	    </div>
	    </div>
	    <div class="op-receipt-data">
	    	<div class="op-receipt-data-big-bullet">
	        	<span></span>
	        </div>
	    	<div class="op-receipt-data-col1">
	        	<h3>Fecha límite de pago</h3>
	            <h4>30 de Noviembre 2014, a las 2:30 AM</h4>
	            <img width="300" src="<?=$charge->payment_method->barcode_url?>" alt="Código de Barras">
	        	<span><?=$charge->payment_method->reference?></span>
	            <small>En caso de que el escáner no sea capaz de leer el código de barras, escribir la referencia tal como se muestra.</small>
	        
	        </div>
	        <div class="op-receipt-data-col2">
	        	<h2>Total a pagar</h2>
	            <h1><?=$charge->amount?><span>.00</span><small> MXN</small></h1>
	            <h2 class="op-receipt-S-margin">+8 pesos por comisión</h2>
	        </div>
	    </div>
	    <div class="op-receipt-data-table-margin"></div>
	    <div class="op-receipt-data">
	    	<div class="op-receipt-data-big-bullet">
	        	<span></span>
	        </div>
	    	<div class="op-receipt-data-col1">
	        	<h3>Detalles de la compra</h3>
	        </div>
		</div>
	    <div class="op-receipt-details-data">
	    	<div class="op-receipt-details-data-table-row op-receipt-color1">
	        	<div>Descripción</div>
	            <span><?=$charge->description?></span>
	        </div>
	    	<div class="op-receipt-details-data-table-row op-receipt-color2">
	        	<div>Fecha y hora</div>
	            <span><?=$charge->creation_date?></span>
	        </div>
	    	<div class="op-receipt-details-data-table-row op-receipt-color1">
	        	<div>Correo del proveedor</div>
	            <span>finanzas@comitefotomx.com</span>
	        </div>

	        <!-- Estas tableRows es por si se necesitara mas info en el ticket. -->

	    	<div class="op-receipt-details-data-table-row color2"  style="display:none">
	        	<div>&nbsp;</div>
	            <span>&nbsp;</span>
	        </div>
	    	<div class="op-receipt-details-data-table-row color1" style="display:none">
	        	<div>&nbsp;</div>
	            <span>&nbsp;</span>
	        </div>



	    </div>
	    <div class="op-receipt-data-table-margin"></div>
	    <div>
	        <div class="op-receipt-data-big-bullet">
	        	<span></span>
	        </div>
	    	<div class="op-receipt-data-col1">
	        	<h3>Como realizar el pago</h3>
	            <ol>
	            	<li>Acude a cualquier tienda afiliada</li>
	                <li>Entrega al cajero el código de barras y menciona que realizarás un pago de servicio Paynet</li>
	                <li>Realizar el pago en efectivo por $ 260.00 MXN (más $8 pesos por comisión)</li>
	                <li>Conserva el ticket para cualquier aclaración</li>
	            </ol>
	            <small>Si tienes dudas comunícate a NOMBRE TIENDA al teléfono TELEFONO TIENDA o al correo CORREO SOPORTE TIENDA</small>
	        </div>
	    	<div class="op-receipt-data-col1">
	        	<h3>Instrucciones para el cajero</h3>
	            <ol>
	            	<li>Ingresar al menú de Pago de Servicios</li>
	                <li>Seleccionar Paynet</li>
	                <li>Escanear el código de barras o ingresar el núm. de referencia</li>
	                <li>Ingresa la cantidad total a pagar</li>
	                <li>Cobrar al cliente el monto total más la comisión de $8 pesos</li>
	                <li>Confirmar la transacción y entregar el ticket al cliente</li>
	            </ol>
	            <small>Para cualquier duda sobre como cobrar, por favor llamar al teléfono 01 800 300 08 08 en un horario de 8am a 9pm de lunes a domingo</small>
	        </div>    
	    </div>
	    
	    <div class="op-receipt-data-logos-tiendas">
	    	<div><img width="50" src="<?= $url = plugins_url(); ?>/2gomPhotoContest/Openpay/recibo/images/7eleven.png" alt="7elven"></div>
	        <div class="op-receipt-margen2"><img width="90" src="<?= $url = plugins_url(); ?>/2gomPhotoContest/Openpay/recibo/images/extra.png" alt="7elven"></div>
	        <div class="op-receipt-margen2"><img width="90" src="<?= $url = plugins_url(); ?>/2gomPhotoContest/Openpay/recibo/images/farmacia_ahorro.png" alt="7elven"></div>
	        <div class="op-receipt-mg3"><img width="150" src="<?= $url = plugins_url(); ?>/2gomPhotoContest/Openpay/recibo/images/benavides.png" alt="7elven"></div>
	        <div class="op-receipt-mg3"><small>¿Quieres pagar en otras tiendas? <br> visita: www.openpay.mx/tiendas</small></div>
	    </div>
	    <div class="op-receipt-poweredBy">
	    	<img src="<?= $url = plugins_url(); ?>/2gomPhotoContest/Openpay/recibo/images/powered_openpay.png" alt="Powered by Openpay" width="150">
	    </div>
	</div>
</section>