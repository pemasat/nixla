<?php

/**
 * My Application bootstrap file.
 */
use Nette\Application\Routers\Route;


// Load Nette Framework
require LIBS_DIR . '/Nette/loader.php';


// Configure application
$configurator = new Nette\Config\Configurator;

// Enable Nette Debugger for error visualisation & logging
//$configurator->setDebugMode($configurator::AUTO);
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->addDirectory(LIBS_DIR)
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config/config.neon');
$container = $configurator->createContainer();

// Setup router
/*
$dynamicRoute->router[] = new DynamicRoute('<url>', array(
	'presenter' => 'Frontend',
	'action' => 'default'
));
*/

/*
$route = new Route('<presenter>/<action>/<id>', array(
    'presenter' => array(
        Route::VALUE => 'Homepage',
        Route::FILTER_IN => 'filterInFunc',
        Route::FILTER_OUT => 'filterOutFunc',
    ),
    'action' => 'default',
    'id' => NULL,
));
*/


// $dynamicRoute->context = $container;



// $dynamicRoute->context = $container;
$container->router[] = new DynamicRoute('/<path .+>', array(
    'presenter' => 'Homepage',
    'action' => 'default',
    'path' => array(
        Route::VALUE => NULL,
        Route::FILTER_IN => callback($container->pages, 'getIdByUrl'),
        Route::FILTER_OUT => callback($container->pages, 'getUrlById'),
    ),
));


$container->router[] = new Route('index.php', 'Homepage:default', Route::ONE_WAY);
$container->router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');


// Configure and run the application!
$container->application->run();
