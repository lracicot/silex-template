<?php

define('BASEPATH', dirname(__DIR__));

require_once BASEPATH.'/vendor/autoload.php';

// Dotenv is a library that reads the `.env` file
// to set environment variables. Those variables can
// also be defined by the server.
$dotenv = new Dotenv\Dotenv(BASEPATH);
$dotenv->load();
$dotenv->required('ENVIRONMENT')->allowedValues(['development', 'staging', 'testing', 'production']);
$dotenv->required('BASEURI');

// This is the Silex Application, basically, it is
// a dependency injection container.
$app = new Silex\Application();

// We set the debug to true only if we are in dev mode
if ($_ENV['ENVIRONMENT'] == 'development') {
    $app['debug'] = true;
}

// The asset service helps with the assets paths in the templates
// It enables the {{ assets() }} twig function
$app->register(new Silex\Provider\AssetServiceProvider(), [
  'assets.base_path' => $_ENV['BASEURI']
]);

// This is the PSR-3 compliant logging service
$app->register(new Silex\Provider\MonologServiceProvider(), [
    'monolog.logfile' => BASEPATH.'/var/logs/'.$_ENV['ENVIRONMENT'].'.log',
    'monolog.level' => Monolog\Logger::DEBUG, // NOTICE, WARNING, ERROR
]);

// The default template for the views is twig
// It will autoload any twig files from the paths
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => [
        BASEPATH.'/app/Resources/views',
        BASEPATH.'/src/MyApp/Resources/views'
    ],
    'twig.options' => [
        'cache' => dirname(__DIR__).'/var/cache',
        'strict_variables' => true
    ]
));

// This is a helper function that returns the full url of the site
$app['absolute_url'] = function () {
    $base_url = '';
    if (isset($_ENV['BASEURL'])) {
        $base_url = $_ENV['BASEURL'];
    } elseif (isset($_SERVER['SERVER_NAME'])) {
        $protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        $base_url = $protocol.'://'.$_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT']) {
            $base_url .= ':'.$_SERVER['SERVER_PORT'];
        }
    }
    return $base_url.$_ENV['BASEURI'];
};


/**
 * Uncomment this if you use doctrine, or delete it.
 */
// $app->register(new Silex\Provider\DoctrineServiceProvider(), [
//     'db.options' => [
//         'driver'   => 'pdo_mysql',
//         'user'     => $_ENV['DB_USER'],
//         'password' => $_ENV['DB_PASS'],
//         'dbname'   => $_ENV['DB_NAME'],
//     ],
// ]);

// We mount the default contorller.
// You can add more controllers here
$app->mount($_ENV['BASEURI'], new MyApp\DefaultController());

// Start the app
$app->run();

// We returns the app because phpunit needs it
return $app;
