<?php
ini_set('display_errors',true);
error_reporting(E_ALL);
require_once '../config/config.php';
require_once 'core/Core.php';
require_once 'core/Boot.php';
require_once 'core/Route.php';

Route::run();