<?php
include '../../gf/App.php';
$app= \GF\App::GetInstance();
//\GF\Loader::registerNamespace('\Test\Models', '\work\mvcframework\trunk\gftest\models');

$config = \GF\Config::getInstance();
$config->setConfigFolder('../config');

$app->run();
