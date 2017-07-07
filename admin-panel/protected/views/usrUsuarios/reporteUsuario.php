<?php
echo Yii::t('reporteUsuario', 'user') . $data ["concursante"]->txt_nombre . Yii::t('reporteUsuario', 'email'). $data ["concursante"]->txt_correo . Yii::t('reporteUsuario', 'instruccionProblema') . $data ["reporte"] ["txt_tipo_incidencia"] . Yii::t('reporteUsuario', 'instruccionProblemaOcaciono'). $data ["reporte"] ["txt_descripcion"];
