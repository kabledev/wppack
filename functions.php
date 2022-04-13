<?php

/**
 * WPPack Functions
 * 
 * @see https://github.com/kableDev/wppack
 * @package wppack
 * @since 1.0.1
 *
 */

define('THEMEDIR', dirname(__FILE__));
define('VIEWDIR', dirname(__FILE__) . '/views');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) :
    require_once dirname(__FILE__) . '/vendor/autoload.php';
endif;

new App;
new AppSetup;
new AppAssets;
// new AppCPT;
