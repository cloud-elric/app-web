<?php $this->beginContent('//layouts/main'); ?>	
	
	<div class="row">
		<aside class="col-lg-2">
			<div class="dgom_menu_box_header">
				<p>Admin</p>
			</div>		
			<nav class="dgom_menu_box_content">
				<?php
					$this->beginWidget('zii.widgets.CMenu', array(
						'items'=>$this->menu,
						'htmlOptions'=>array('class'=>'nav nav-pills nav-stacked'),
					));
					$this->endWidget();
				?>
				
			</nav>
		</aside>
		
		<!-- MAIN CONTENT -->
		<main  class="col-lg-10">
			<?php echo $content; ?>
		</main>
	
	</div>
<?php $this->endContent(); ?>	