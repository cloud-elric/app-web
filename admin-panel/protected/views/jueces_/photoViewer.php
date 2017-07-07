<?php

foreach($modelPhoto as $cat):
?>
	
		
				<img src="<?=Yii::app()->baseUrl?>/uploads/image/contest/<?=$cat->txt_file_name ?>">
<?=$cat->txt_file_name ?><br>
	 
<?php
	endforeach;
?>	
