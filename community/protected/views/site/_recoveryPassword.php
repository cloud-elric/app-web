<!DOCTYPE html>
<html>
<head></head>
<body>

	<table cellpadding="8" cellspacing="0"
		style="padding: 0; width: 100% !important; background: #ffffff; background-color: #ffffff;"
		border="0">
		<tbody>
			<tr>
				<td valign="top">
					<table cellpadding="0" cellspacing="0"
						style="border-radius: 4px; border: 1px #dceaf5 solid;" border="0"
						align="center">
						<tbody>
							<tr>
								<td colspan="3" height="6"></td>
							</tr>
							<tr style="line-height: 0px;">
								<td width="100%" style="font-size: 0px;" align="center"
									height="1"><img width="40px"
									style="max-height: 73px; width: 40px;" alt=""
									src="https://globaljudging.com/community/images/hardcode/WPC-Logo.png"></td>
							</tr>
							<tr>
								<td><table cellpadding="0" cellspacing="0"
										style="line-height: 25px;" border="0" align="center">
										<tbody>
											<tr>
												<td colspan="3" height="30"></td>
											</tr>
											<tr>
												<td width="36"></td>
												<td width="454" align="left"
													style="color: #444444; border-collapse: collapse; font-size: 11pt; font-family: proxima_nova, 'Open Sans', 'Lucida Grande', 'Segoe UI', Arial, Verdana, 'Lucida Sans Unicode', Tahoma, 'Sans Serif'; max-width: 454px;"
													valign="top"><?=Yii::t('recoveryPassword', 'gretting')?>,<br>
												<br><?=Yii::t('recoveryPassword', 'descriptionMessage1')?> <a
														href="<?php echo Yii::app()->createAbsoluteUrl('site/resetPassword', array("hide"=>$data["hash"]->txt_clave_recovery, "t"=>$data["t"]));?>">
														<?=Yii::t('recoveryPassword', 'linkTest')?></a>:<br>
												<br>
												<center>
														<a
															style="border-radius: 3px; font-size: 15px; color: white; border: 1px #1373b5 solid; box-shadow: inset 0 1px 0 #6db3e6, inset 1px 0 0 #48a1e2; text-decoration: none; padding: 14px 7px 14px 7px; width: 210px; max-width: 210px; font-family: proxima_nova, 'Open Sans', 'lucida grande', 'Segoe UI', arial, verdana, 'lucida sans unicode', tahoma, sans-serif; display: block; background-color: #007ee6; text-align: center;"
															href="<?php echo Yii::app()->createAbsoluteUrl('site/resetPassword', array("hide"=>$data["hash"]->txt_clave_recovery, "t"=>$data["t"]));?>"
															target="_blank"><?=Yii::t('recoveryPassword', 'btnText')?></a>
													</center> <br><?=Yii::t('recoveryPassword', 'descriptionMessage2')?><br>
<!-- 												<br>Gracias!<br> -->
												</td>
												<td width="36"></td>
											</tr>
											<tr>
												<td colspan="3" height="36"></td>
											</tr>
										</tbody>
									</table></td>
							</tr>
						</tbody>
					</table>
					<table cellpadding="0" cellspacing="0" align="center" border="0">
						<tbody>
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td style="padding: 0; border-collapse: collapse;"><table
										cellpadding="0" cellspacing="0" align="center" border="0">
										<tbody>
											<tr
												style="color: #a8b9c6; font-size: 11px; font-family: proxima_nova, 'Open Sans', 'Lucida Grande', 'Segoe UI', Arial, Verdana, 'Lucida Sans Unicode', Tahoma, 'Sans Serif';">
												<td width="400" align="left"></td>
												<td width="128" align="right">© 2016 Haz Clic con México</td>
											</tr>
										</tbody>
									</table></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>

</body>
</html>
