<!-- .pago-seleccion -->
<div class="pago-seleccion container-fluid">
	<!-- .row -->
	<div class="row">
		<!-- .col (left) -->
		<div class="col-sm-6 col-md-6 pago-participante-col-flex">
			
			<!-- .text -->
			<div class="text">
				<h2 class="bienvenido">
					Bienvenido al concurso <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/hazClickMexico.png" alt="Haz Clic con México">
				</h2>
				<button type="button" class="btn btn-blue">Consulta las bases del concurso</button>
			</div>
			<!-- end / .text -->
				
				<!--
				<div class="example box screen-pago-ticket" data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
                    <div>
                        <div>
                            

							<section class="payment-screen-openpayReceipt-template">
								<div class="op-receipt-container">
									<div class="dgom-ui-content-row">
										<div class="op-receipt-toolBox">
											
											<a id="dgom-func-printTicket" class="dgom-ui-printBtn">
												<i class="icon-print">Imprimir Ticket</i>
											</a>
											<a id="dgom-func-dismissTicket" class="dgom-ui-alertBox-dismissBtn">
												<i class="icon-cancel-circle">Cerrar</i>
											</a>
										</div>
									</div>
									<div class="op-receipt-header">
									<div class="op-receipt-store-logo">
								    	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/logo.png" alt="Logo del Comite Fotográfico Mexicano">
								    </div>
								    <div class="op-receipt-paynet-logo">
								    	<div>Plataforma de Pago</div>
								    	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/paynet_logo.png" alt="Logo Paynet">
								    </div>
								    </div>
								    <div class="op-receipt-data">
								    	<div class="op-receipt-data-big-bullet">
								        	<span></span>
								        </div>
								    	<div class="op-receipt-data-col1">
								        	<h3>Fecha límite de pago</h3>
								            <h4>30 de Noviembre 2014, a las 2:30 AM</h4>
								            <img width="300" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/codigo_barras.gif" alt="Código de Barras">
								        	<span>000020TRTJGWX6WVE2NF3R7FOW0260006</span>
								            <small>En caso de que el escáner no sea capaz de leer el código de barras, escribir la referencia tal como se muestra.</small>
								        
								        </div>
								        <div class="op-receipt-data-col2">
								        	<h2>Total a pagar</h2>
								            <h1>$9,000<span>.00</span><small> MXN</small></h1>
								            <h2 class="op-receipt-S-margin">+8 pesos por comisión</h2>
								        </div>
								    </div>
								    <div class="op-receipt-data-table-margin"></div>
								    <div class="op-receipt-data">
								    	<div class="op-receipt-data-big-bullet">
								        	<span></span>
								        </div>
								    	<div class="op-receipt-data-col1 op-receipt-data-col11">
								        	<h3>Detalles de la compra</h3>
								        </div>
									</div>
								    <div class="op-receipt-details-data">
								    	<div class="op-receipt-details-data-table-row op-receipt-color1">
								        	<div>Descripción</div>
								            <span>Descripcion de la compra realizada</span>
								        </div>
								    	<div class="op-receipt-details-data-table-row op-receipt-color2">
								        	<div>Fecha y hora</div>
								            <span>30 de Noviembre de 2014 a las 4:00 A.M.</span>
								        </div>
								    	<div class="op-receipt-details-data-table-row op-receipt-color1">
								        	<div>Correo del proveedor</div>
								            <span>finanzas@comitefotomx.com</span>
								        </div>

								       
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
								            <small>Si tienes dudas comunicate a NOMBRE TIENDA al teléfono TELEFONO TIENDA o al correo CORREO SOPORTE TIENDA</small>
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
								    	<div><img width="50" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/7eleven.png" alt="7elven"></div>
								        <div class="op-receipt-margen2"><img width="90" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/extra.png" alt="7elven"></div>
								        <div class="op-receipt-margen2"><img width="90" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/farmacia_ahorro.png" alt="7elven"></div>
								        <div class="op-receipt-mg3"><img width="150" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/benavides.png" alt="7elven"></div>
								        <div class="op-receipt-mg3 op-receipt-mg3-w100"><small>¿Quieres pagar en otras tiendas? <br> visita: www.openpay.mx/tiendas</small></div>
								    </div>
								    <div class="op-receipt-poweredBy">
								    	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/powered_openpay.png" alt="Powered by Openpay" width="150">
								    </div>
								</div>
							</section>
							

                        </div>
                    </div>
                </div>
            	-->

			<!-- footer -->
		    <footer class="footer-fixed-int">
		      <a href="http://2gom.com.mx/" target="_blank">powered by 2 Geeks one Monkey</a>
		    </footer>
		    <!-- end / footer -->
			
		</div>
		<!-- end / .col (left) -->

		<!-- .col (right) -->
		<div class="col-sm-6 col-md-6 pago-seleccion-datos">

			<!-- .pago-seleccion-user -->
			<div class="pago-seleccion-user">
				
				<p>Hola Juan Perez</p>

				<!-- .pago-seleccion-user-flip -->
				<div class="pago-seleccion-user-flip">

					<!-- .pago-seleccion-user-flip-front-side -->
					<div class="pago-user-flip pago-seleccion-user-flip-front-side" data-flip="front">
						<span style="background-image: url(http://lorempixel.com/100/100/people/3/)"></span>
					</div>
					<!-- end / .pago-seleccion-user-flip-front-side -->

					<!-- .pago-seleccion-user-flip-back-side  -->
					<div class="pago-user-flip pago-seleccion-user-flip-back-side" data-flip="back">
						<a href="#" class="pago-seleccion-user-logout"><i class="fa fa-lock"></i></a>
					</div>
					<!-- end / .pago-seleccion-user-flip-back-side  -->
				</div>
				<!-- end / .pago-seleccion-user-flip -->

			</div>
			<!-- end / .pago-seleccion-user -->

			
			<!-- .pago-terminos-flip -->
			<div class="pago-terminos-flip">

				
				<!-- .pago-terminos-front-side -->
				<div class="pago-terminos-front-side pago-terminos-click" data-flip="front">



					<!-- .screen-int -->
					<div class="example box screen-pago" data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
						<!-- SCROLL -->
						<div>
							<!-- SCROLL -->
							<div>
									
								<!-- .pago-seleccion-producto -->
								<div class="pago-seleccion-producto">
									
									<h2 class="selecciona-inscripcion">Por favor selecciona tu tipo de inscripción</h2>

									<!-- .rowProductos -->
									<div class="row rowProductos">
										<div class="col-sm-8 col-md-8">
											<div class="radio-style">
												<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
												<label for="optionsRadios1">Producto 1</label>
												<p>
													Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque accusantium nihil amet, distinctio dolor consequuntur deserunt.
												</p>
												<div class="check"></div>
											</div>
										</div>
										<div class="col-sm-4 col-md-4 text-right">
											<span class="text-right-precio">$ 150</span>
										</div>

										<!-- .radio-style-retro-alim -->
										<div class="radio-style radio-style-retro-alim">
											<input type="radio" name="optionsRadioz" id="optionsRadioz1" value="option1">
											<label for="optionsRadioz1">
												<p>Agregar retro-alimentación</p> <span>+ $ 400</span>
											</label>
											<div class="check"></div>
										</div>
										<!-- end / .radio-style-retro-alim -->

										<div class="line"></div>
									</div>
									<!-- end / .rowProductos -->

									<!-- .rowProductos -->
									<div class="row rowProductos">
										<div class="col-sm-8 col-md-8">
											<div class="radio-style">
												<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
												<label for="optionsRadios2">Producto 2</label>
												<p>
													Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque accusantium nihil amet, distinctio dolor consequuntur deserunt.
												</p>
												<div class="check"></div>
											</div>
										</div>
										<div class="col-sm-4 col-md-4 text-right">
											<span class="text-right-precio">$ 300</span>
										</div>

										<!-- .radio-style-retro-alim -->
										<div class="radio-style radio-style-retro-alim">
											<input type="radio" name="optionsRadioz" id="optionsRadioz2" value="option2">
											<label for="optionsRadioz2">
												<p>Agregar retro-alimentación</p> <span>+ $ 400</span>
											</label>
											<div class="check"></div>
										</div>
										<!-- end / .radio-style-retro-alim -->

										<div class="line"></div>
									</div>
									<!-- end / .rowProductos -->

									<!-- .rowProductos -->
									<div class="row rowProductos">
										<div class="col-sm-8 col-md-8">
											<div class="radio-style">
												<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
												<label for="optionsRadios3">Producto 3</label>
												<p>
													Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque accusantium nihil amet, distinctio dolor consequuntur deserunt.
												</p>
												<div class="check"></div>
											</div>
										</div>
										<div class="col-sm-4 col-md-4 text-right">
											<span class="text-right-precio">$ 500</span>
										</div>

										<!-- .radio-style-retro-alim -->
										<div class="radio-style radio-style-retro-alim">
											<input type="radio" name="optionsRadioz" id="optionsRadioz3" value="option3">
											<label for="optionsRadioz3">
												<p>Agregar retro-alimentación</p> <span>+ $ 400</span>
											</label>
											<div class="check"></div>
										</div>
										<!-- end / .radio-style-retro-alim -->

										<div class="line"></div>
									</div>
									<!-- end / .rowProductos -->

									<!-- .rowProductos
									<div class="row rowProductos">
										<div class="col-sm-12 col-md-12">
											<div class="radio-style radio-style-retro-alim">
												<input type="radio" name="optionsRadios" id="optionsRadios4" value="option4">
												<label for="optionsRadios4">
													<p>Agregar retro-alimentación</p> <span>+ $ 400</span>
												</label>
												<div class="check"></div>
											</div>
										</div>
									</div>
									<!- end / .rowProductos -->

									<!-- <button class="btn btn-primary" data-target="#modalOpenPay" data-toggle="modal" type="button">Generate</button> -->

								</div>
								<!-- end / .pago-seleccion-producto -->
							
							</div>
							<!-- end / SCROLL -->
						</div>
						<!-- end / SCROLL -->


					</div>
					<!-- end / .screen-int -->

						
					<!-- .pago-seleccion-pago -->
					<div class="pago-seleccion-pago">
						
						<!-- .row -->
						<div class="row margin-0">
							
							<div class="col-sm-4 col-md-3 items">
								<div class="items-total">
									Total <span>$ 150</span>
								</div>
							</div>

							<div class="col-sm-4 col-md-3 items">

								<div class="check-style">
									<input class="check-terminos-condiciones" type="checkbox" id="terminoscondiciones" name="terminoscondiciones">
									<label for="terminoscondiciones">
										<span>Acepto terminos</span> <span>y condiciones</span>
									</label>
									<div class="check"></div>
								</div>

								<div class="mask-check"></div>
							</div>

							<div class="col-sm-4 col-md-6 items items-pay">

								<div class="radio-style radio-style-pay">
									<input type="radio" name="tipoPago" id="paypal" value="Paypal" data-name="Paypal">
									<label for="paypal">
										<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/paypal.png" alt="">
									</label>
									<div class="check"></div>
								</div>

								<div class="radio-style radio-style-pay">
									<input type="radio" name="tipoPago" id="openpay" value="Open Pay" data-name="Open Pay">
									<label for="openpay">
										<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay.png" alt="">
									</label>
									<div class="check"></div>
								</div>

								<button type="submit" class="btn btn-yellow btn-pagar" disabled="disabled">Pagar</button>
								<div class="mask-pagar"></div>

							</div>

						</div>
						<!-- end / .row -->

					</div>
					<!-- end / .pago-seleccion-pago -->


				</div>
				<!-- end / .pago-terminos-front-side -->
				


				<!-- .pago-terminos-back-side -->
				<div class="pago-terminos-back-side pago-terminos-click" data-flip="back">
					

					<!-- .screen-int -->
					<div class="example box screen-pago-terminos" data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
						<!-- SCROLL -->
						<div>
							<!-- SCROLL -->
							<div>

								<!-- .terminos-condiciones -->
								<div class="terminos-condiciones">
									
									<span class="terminos-condiciones-closer">+</span>

									<h2>Terminos y condiciones</h2>

									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit maxime ut, voluptatem voluptas ducimus sapiente cupiditate, optio reprehenderit maiores temporibus possimus! Voluptatum voluptates sapiente, nemo vel repellat minus porro, velit!
									</p>

									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt fuga aspernatur, quae nemo culpa numquam quibusdam provident minima autem ab facere nam, animi et error eos laudantium. Alias fuga rerum libero explicabo molestias distinctio nihil ipsum veniam perspiciatis sunt a esse voluptates, harum iusto? Adipisci laboriosam magnam esse distinctio ullam, voluptatum fugit quisquam reiciendis consequuntur minus vitae aliquam aut quis perferendis culpa minima. Ad ab soluta magni aut animi, ipsum blanditiis quis, consequuntur, iste ex debitis veniam. Tempore error in, ducimus quas consequatur, saepe distinctio dolorum repellat deserunt est illo numquam ratione! Neque pariatur consequuntur, sit recusandae hic. Vitae, tempora?
									</p>

									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt dignissimos eum vero maxime, illo aut iste voluptas numquam in veniam autem temporibus ducimus, magnam fugit dolorem sequi praesentium, facere, hic.
									</p>

									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, in.
									</p>

									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias repellat dicta maxime aut, reprehenderit blanditiis molestias, voluptatem provident temporibus, eum laborum ratione nemo sint voluptatibus enim omnis sunt quas. Voluptatem aperiam, reiciendis, odit nam veniam debitis. Praesentium minus a ut quis quaerat explicabo hic cum, tempora beatae repellat! Ipsum, velit.
									</p>

									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis iusto tempora laudantium dolores veniam ad voluptatum iste deleniti quae omnis.
									</p>
									
									<div class="text-center">
										<button class="btn btn-green terminos-condiciones-aceptor">Acepto terminos y condiciones</button>
									</div>

								</div>
								<!-- end / .terminos-condiciones -->

							</div>
							<!-- end / SCROLL -->
						</div>
						<!-- end / SCROLL -->
					</div>
					<!-- end / .screen-int -->

				</div>
				<!-- end / .pago-terminos-back-side -->

			</div>
			<!-- end / .pago-terminos-flip -->

				



						








						<!-- .pago-seleccion-datos-recibo -->
						<div class="pago-seleccion-datos-recibo">
						
							<!-- .screens -->
							<div class="example box screen-int-pago" data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
								<!-- SCROLL -->
								<div>
									<!-- SCROLL -->
									<div>
									
										dfdf

									</div>
									<!-- end / SCROLL -->
								</div>
								<!-- end / SCROLL -->

							</div>
							<!-- end / .screens -->

						</div>
						<!-- end / .pago-seleccion-datos-recibo -->
						


						


						

					

		</div>
		<!-- end / .col (right) -->
	</div>
	<!-- end / .row -->
</div>
<!-- end / .pago-seleccion -->

<!--
<div class="section">
    	<div class="inner">
            <section>
                <h3>Vertical Scrollable</h3>

                <div class="example box" data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
                    <div>
                        <div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam malesuada at metus eget sodales. Aenean tincidunt mi sed orci sollicitudin placerat. Nullam tempus nisl augue, sed pulvinar eros lacinia vitae. Mauris vehicula velit a nibh dapibus vehicula. Fusce dui tellus, tincidunt sit amet porttitor efficitur, aliquam ac arcu. Cras non tempor dui. Nunc a dolor sit amet dolor bibendum auctor a eu ipsum.</p>
                            <p>Pellentesque lobortis facilisis risus, sit amet maximus turpis venenatis vitae. Donec nec eros iaculis, congue risus at, tempus augue. Donec quis felis vel purus pretium tincidunt. Integer sodales ultricies tristique. Phasellus et risus sagittis, dictum tortor a, semper lorem. Vivamus quis ipsum velit. Nam molestie ut ipsum ultricies volutpat. Integer molestie sagittis tempor. Integer vitae mauris est. Ut laoreet dignissim tellus, non accumsan erat gravida vel. Curabitur non erat id velit aliquam malesuada. Proin aliquet cursus orci quis pulvinar.</p>
                            <p>Duis elit massa, scelerisque sed nisl sed, tempus iaculis felis. Duis accumsan eget justo id auctor. Aliquam consequat odio non dolor efficitur, hendrerit porttitor neque porttitor. Integer varius maximus nunc, at malesuada leo tristique id. Sed aliquet pharetra ipsum, non interdum lacus dictum sit amet. Curabitur semper imperdiet sem eget interdum. Nunc at egestas tellus, vel tincidunt lacus. Fusce eget neque vel leo volutpat tincidunt ac non enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus cursus leo in felis viverra interdum.</p>
                            <p>Mauris id ultricies magna. Quisque rutrum lobortis elit blandit rutrum. Curabitur mattis enim lorem, eget tempor nunc pretium dignissim. Cras tincidunt ac nisl eget finibus. Fusce lobortis turpis sed dui mollis, eget fringilla risus porttitor. In id neque vitae lorem pharetra sodales. Morbi neque ex, mattis at dolor quis, consequat tincidunt leo. Vivamus sagittis placerat sem at porta.</p>
                            <p>Proin varius arcu ac ligula suscipit, sit amet pretium lectus tincidunt. Aliquam eu mi imperdiet, efficitur tellus ac, mollis eros. Cras malesuada feugiat pharetra. Curabitur lectus lacus, bibendum sed odio at, egestas tempor nisl. Vivamus sagittis est porta velit pretium, in elementum arcu tempus. Ut id cursus libero, non ullamcorper velit. Cras pretium arcu lacus, nec dignissim elit accumsan vitae. Aliquam tristique lorem et tempus congue. Donec vel metus enim. Praesent sed turpis et magna suscipit tincidunt. Proin efficitur neque non sapien cursus vehicula. Suspendisse iaculis, neque vel convallis lobortis, mauris dui posuere mi, at maximus lorem tortor a metus. Ut in quam efficitur, finibus nulla et, feugiat orci.</p>
                            <p>Sed mattis volutpat enim eget porttitor. Sed lectus ligula, condimentum nec elit eget, vehicula porttitor nunc. Curabitur pulvinar leo velit, a convallis tellus suscipit ac. Donec tempor est ut sagittis varius. Mauris maximus nunc metus, non venenatis justo ornare vel. Phasellus iaculis erat sit amet enim fermentum mattis. Cras sollicitudin tortor dolor, ac aliquam dolor iaculis non. Donec sed sodales enim. Suspendisse potenti. Integer quis turpis cursus enim consectetur fringilla eu eu ante.</p>
                        </div>
                    </div>
                </div>
            </section>

	        <section>
                <h3>Horizontal Scrollable</h3>
                <div class="example box" data-options='{"direction": "horizontal", "contentSelector": ">", "containerSelector": ">"}'>
                    <div >
                        <div>
                            <img data-src="holder.js/1500x200/sky" width="2000" />
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3>Both Scrollable</h3>
                <div class="example box" data-options='{"direction": "both", "contentSelector": ">", "containerSelector": ">"}'>
                    <div>
                        <div>
                            <img data-src="holder.js/1500x400/sky" width="1500" height="400" />
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3>Both Scrollable 2</h3>
                <div class="example box" data-options='{"direction": "both", "contentSelector": ">", "containerSelector": ">"}'>
                    <div>
                        <div>
                            <img data-src="holder.js/100%x200/lava" width="100%" height="200" />
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3>Auto x</h3>
                <div class="example box" style="overflow-x: auto; overflow-y: hidden" data-options='{"direction": "auto", "contentSelector": ">", "containerSelector": ">"}'>
                    <div>
                        <div>
                            <img data-src="holder.js/1200x200/vine" width="1200" height="200" />
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3>Auto y</h3>
                <div class="example box" style="overflow-y: auto; overflow-x: hidden" data-options='{"direction": "auto", "contentSelector": ">", "containerSelector": ">"}'>
                    <div>
                        <div>
                            <img data-src="holder.js/958x300/vine" width="958" height="300" />
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3>Auto both</h3>
                <div class="example box" style="overflow: auto" data-options='{"direction": "auto", "contentSelector": ">", "containerSelector": ">"}'>
                    <div>
                        <div>
                            <img data-src="holder.js/1200x300/vine" width="1200" height="300" />
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3>Auto none</h3>
                <div class="example box" data-options='{"direction": "auto", "contentSelector": ">", "containerSelector": ">"}'>
                    <div>
                        <div>
                            <img data-src="holder.js/958x200/lava" width="958" height="200" />
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3>Simple Structure</h3>
                <div class="example">
                    <div class="box">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam malesuada at metus eget sodales. Aenean tincidunt mi sed orci sollicitudin placerat. Nullam tempus nisl augue, sed pulvinar eros lacinia vitae. Mauris vehicula velit a nibh dapibus vehicula. Fusce dui tellus, tincidunt sit amet porttitor efficitur, aliquam ac arcu. Cras non tempor dui. Nunc a dolor sit amet dolor bibendum auctor a eu ipsum.</p>
                        <p>Pellentesque lobortis facilisis risus, sit amet maximus turpis venenatis vitae. Donec nec eros iaculis, congue risus at, tempus augue. Donec quis felis vel purus pretium tincidunt. Integer sodales ultricies tristique. Phasellus et risus sagittis, dictum tortor a, semper lorem. Vivamus quis ipsum velit. Nam molestie ut ipsum ultricies volutpat. Integer molestie sagittis tempor. Integer vitae mauris est. Ut laoreet dignissim tellus, non accumsan erat gravida vel. Curabitur non erat id velit aliquam malesuada. Proin aliquet cursus orci quis pulvinar.</p>
                        <p>Duis elit massa, scelerisque sed nisl sed, tempus iaculis felis. Duis accumsan eget justo id auctor. Aliquam consequat odio non dolor efficitur, hendrerit porttitor neque porttitor. Integer varius maximus nunc, at malesuada leo tristique id. Sed aliquet pharetra ipsum, non interdum lacus dictum sit amet. Curabitur semper imperdiet sem eget interdum. Nunc at egestas tellus, vel tincidunt lacus. Fusce eget neque vel leo volutpat tincidunt ac non enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus cursus leo in felis viverra interdum.</p>
                        <p>Mauris id ultricies magna. Quisque rutrum lobortis elit blandit rutrum. Curabitur mattis enim lorem, eget tempor nunc pretium dignissim. Cras tincidunt ac nisl eget finibus. Fusce lobortis turpis sed dui mollis, eget fringilla risus porttitor. In id neque vitae lorem pharetra sodales. Morbi neque ex, mattis at dolor quis, consequat tincidunt leo. Vivamus sagittis placerat sem at porta.</p>
                        <p>Proin varius arcu ac ligula suscipit, sit amet pretium lectus tincidunt. Aliquam eu mi imperdiet, efficitur tellus ac, mollis eros. Cras malesuada feugiat pharetra. Curabitur lectus lacus, bibendum sed odio at, egestas tempor nisl. Vivamus sagittis est porta velit pretium, in elementum arcu tempus. Ut id cursus libero, non ullamcorper velit. Cras pretium arcu lacus, nec dignissim elit accumsan vitae. Aliquam tristique lorem et tempus congue. Donec vel metus enim. Praesent sed turpis et magna suscipit tincidunt. Proin efficitur neque non sapien cursus vehicula. Suspendisse iaculis, neque vel convallis lobortis, mauris dui posuere mi, at maximus lorem tortor a metus. Ut in quam efficitur, finibus nulla et, feugiat orci.</p>
                        <p>Sed mattis volutpat enim eget porttitor. Sed lectus ligula, condimentum nec elit eget, vehicula porttitor nunc. Curabitur pulvinar leo velit, a convallis tellus suscipit ac. Donec tempor est ut sagittis varius. Mauris maximus nunc metus, non venenatis justo ornare vel. Phasellus iaculis erat sit amet enim fermentum mattis. Cras sollicitudin tortor dolor, ac aliquam dolor iaculis non. Donec sed sodales enim. Suspendisse potenti. Integer quis turpis cursus enim consectetur fringilla eu eu ante.</p>
                    </div>
                </div>
            </section>
            <section>
                <div>
                    <button class="api-scroll-to" data-to="0">Scroll to 0</button>
                    <button class="api-scroll-to" data-to="50">Scroll to 50</button>
                    <button class="api-scroll-to" data-to="0%">Scroll to 0%</button>
                    <button class="api-scroll-to" data-to="100%">Scroll to 100%</button>
                    <button class="api-scroll-to" data-to="50%">Scroll to 50%</button>
                </div>
                <div>
                    <button class="api-scroll-by" data-by="10">Scroll by 10</button>
                    <button class="api-scroll-by" data-by="+10">Scroll by +10</button>
                    <button class="api-scroll-by" data-by="-10">Scroll by -10</button>
                    <button class="api-scroll-by" data-by="10%">Scroll by 10%</button>
                    <button class="api-scroll-by" data-by="+10%">Scroll by +10%</button>
                    <button class="api-scroll-by" data-by="-10%">Scroll by -10%</button>
                </div>
                <div>
                    <button class="api-init">Init</button>
                    <button class="api-enable">enable</button>
                    <button class="api-disable">disable</button>
                    <button class="api-destory">Destory</button>
                </div>
            </section>
    	</div>
    </div>
-->




<!-- Modal -->
<div class="modal fade modal-warning modal-open-pay" id="modalOpenPay" aria-hidden="true" aria-labelledby="modalOpenPay" aria-labelledby="exampleModalWarning" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg modal-center">
		<div class="modal-content">
			
			<!-- .modal-header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<p class="modal-imprimir-ticket"><i class="fa fa-print"></i> Imprimir ticket</p>
				<h4 class="modal-title">Ticket de OpenPay</h4>
			</div>
			<!-- end / .modal-header -->

			<!-- .modal-body -->
			<div class="modal-body">
				
				<!-- .screen-pago-ticket -->
				<div class="example box screen-pago-ticket" data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
                    <!-- SCROLL -->
                    <div>
                    	<!-- SCROLL -->
                        <div>

                            <!-- .payment-screen-openpayReceipt-template -->
							<section class="payment-screen-openpayReceipt-template" id="print">
								<div class="op-receipt-container">

									<!--
									<div class="dgom-ui-content-row">
										<div class="op-receipt-toolBox">
											
											<a id="dgom-func-printTicket" class="dgom-ui-printBtn">
												<i class="icon-print">Imprimir Ticket</i>
											</a>
											<a id="dgom-func-dismissTicket" class="dgom-ui-alertBox-dismissBtn">
												<i class="icon-cancel-circle">Cerrar</i>
											</a>
										</div>
									</div>
									-->

									<div class="op-receipt-header">
									<div class="op-receipt-store-logo">
								    	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/logo.png" alt="Logo del Comite Fotográfico Mexicano">
								    </div>
								    <div class="op-receipt-paynet-logo">
								    	<div>Plataforma de pago</div>
								    	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/paynet_logo.png" alt="Logo Paynet">
								    </div>
								    </div>
								    <div class="op-receipt-data">
								    	<div class="op-receipt-data-big-bullet">
								        	<span></span>
								        </div>
								    	<div class="op-receipt-data-col1">
								        	<h3>Fecha límite de pago</h3>
								            <h4>30 de Noviembre 2014, a las 2:30 AM</h4>
								            <img width="300" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/codigo_barras.gif" alt="Código de Barras">
								        	<span>000020TRTJGWX6WVE2NF3R7FOW0260006</span>
								            <small>En caso de que el escáner no sea capaz de leer el código de barras, escribir la referencia tal como se muestra.</small>
								        
								        </div>
								        <div class="op-receipt-data-col2">
								        	<h2>Total a pagar</h2>
								            <h1>$9,000<span>.00</span><small> MXN</small></h1>
								            <h2 class="op-receipt-S-margin">+9 pesos por comisión</h2>
								        </div>
								    </div>
								    <div class="op-receipt-data-table-margin"></div>
								    <div class="op-receipt-data">
								    	<div class="op-receipt-data-big-bullet">
								        	<span></span>
								        </div>
								    	<div class="op-receipt-data-col1 op-receipt-data-col11">
								        	<h3>Detalles de la compra</h3>
								        </div>
									</div>
								    <div class="op-receipt-details-data">
								    	<div class="op-receipt-details-data-table-row op-receipt-color1">
								        	<div>Descripción</div>
								            <span>Descripcion de la compra realizada</span>
								        </div>
								    	<div class="op-receipt-details-data-table-row op-receipt-color2">
								        	<div>Fecha y hora</div>
								            <span>30 de Noviembre de 2014 a las 4:00 A.M.</span>
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
								            <small>Si tienes dudas comunicate a NOMBRE TIENDA al teléfono TELEFONO TIENDA o al correo CORREO SOPORTE TIENDA</small>
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
								    	<div><img width="50" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/7eleven.png" alt="7elven"></div>
								        <div class="op-receipt-margen2"><img width="90" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/extra.png" alt="7elven"></div>
								        <div class="op-receipt-margen2"><img width="90" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/farmacia_ahorro.png" alt="7elven"></div>
								        <div class="op-receipt-mg3"><img width="150" src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/benavides.png" alt="7elven"></div>
								        <div class="op-receipt-mg3 op-receipt-mg3-w100"><small>¿Quieres pagar en otras tiendas? <br> visita: www.openpay.mx/tiendas</small></div>
								    </div>
								    <div class="op-receipt-poweredBy">
								    	<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/openpay/powered_openpay.png" alt="Powered by Openpay" width="150">
								    </div>
								</div>
							</section>
							<!-- end / .payment-screen-openpayReceipt-template -->

                        </div>
                        <!-- end / SCROLL -->
                    </div>
                    <!-- end / SCROLL -->
                </div>
                <!-- end / .screen-pago-ticket -->

			</div>
			<!-- end / .modal-body -->

		</div>
	</div>
</div>