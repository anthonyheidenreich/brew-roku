<?php
define(BASEDIR, realpath(dirname(__FILE__)));

$config = parse_ini_file('config.ini', true);

require_once(BASEDIR.'/lib/util.php');
