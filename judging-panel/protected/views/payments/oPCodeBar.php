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

