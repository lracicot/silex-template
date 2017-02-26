<?php

define('BASEPATH', dirname(__DIR__));

require_once BASEPATH.'/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(BASEPATH);
$dotenv->load();
$dotenv->required('ENVIRONMENT')->allowedValues(['development', 'staging', 'testing', 'production']);
$dotenv->required('BASEURI');

$app = new Silex\Application();

if ($_ENV['ENVIRONMENT'] == 'development') {
    $app['debug'] = true;
}
$app->register(new Silex\Provider\AssetServiceProvider(), [
  'assets.base_path' => $_ENV['BASEURI']
]);

$app->register(new Silex\Provider\MonologServiceProvider(), [
    'monolog.logfile' => BASEPATH.'/var/logs/'.$_ENV['ENVIRONMENT'].'.log',
    'monolog.level' => Monolog\Logger::DEBUG, // NOTICE, WARNING, ERROR
]);

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

$app->mount($_ENV['BASEURI'], new MyApp\DefaultController());

$app->run();

return $app;