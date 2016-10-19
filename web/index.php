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
));

$app['absolute_url'] = function () {
    if (isset($_ENV['BASEURL'])) {
        $base_url = $_ENV['BASEURL'];
    } else {
        $protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        $base_url = $protocol.'://'.$_SERVER['SERVER_NAME'];

        if ($_SERVER['SERVER_PORT']) {
            $base_url .= ':'.$_SERVER['SERVER_PORT'];
        }
    }

    return $base_url.$_ENV['BASEURI'];
};

$app->mount($_ENV['BASEURI'], new MyApp\DefaultController());

$app->run();
