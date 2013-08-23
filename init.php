<?php
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(__DIR__));
$config = parse_ini_file('config.ini', true);

require_once('lib/util.php');

function debug($data) { echo '<pre>',print_r($data,1),'</pre>'; }
