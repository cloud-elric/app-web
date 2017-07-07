<?php
echo "El usuario " . $data ["concursante"]->txt_nombre . " con el mail " . $data ["concursante"]->txt_correo . " presenta un problema del tipo " . $data ["reporte"] ["txt_tipo_incidencia"] . " y lo ocurrido fue " . $data ["reporte"] ["txt_descripcion"];
