<?php

/**
 * Plugin Name:       Agence
 * Description:       Gestion immobilière
 * Version:           0.0.1
 * Requires at least: 6.1.1
 * Requires PHP:      8.1
 * Author:            Geoffroy Colpart
 * Text Domain:       agence
 */

use App\Application;
use App\Controller\AjaxController;
use App\Controller\PageController;
use App\Controller\ContactController;
use App\Controller\EnqueueController;
use App\Controller\PropertyController;
use App\Controller\TaxonomyController;
use App\Controller\CharacteristicController;

if (! defined('ABSPATH')) {
    exit;
}

$autoload = WP_PLUGIN_DIR . "/agence/vendor/autoload.php";
if (!file_exists($autoload)) {
    throw new Exception(__("Le fichier d'autoload n'existe pas", "agence"));
}
require_once $autoload;

// Activation du plugin
$app = new Application;
$app
    ->addController(EnqueueController::class)
    ->addController(PropertyController::class)
    ->addController(TaxonomyController::class)
    ->addController(CharacteristicController::class)
    ->addController(AjaxController::class)
    ->addController(PageController::class)
    ->addController(ContactController::class)
;

$app->start();