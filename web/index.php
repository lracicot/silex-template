<?php

define('BASEPATH', dirname(__DIR__));

require_once BASEPATH.'/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(BASEPATH);
$dotenv->load();
$dotenv->required('ENVIRONMENT')->allowedValues(['development', 'staging', 'testing', 'production']);

$app = new Silex\Application();

if ($_ENV['ENVIRONMENT'] == 'development') {
    $app['debug'] = true;
}

$app->register(new Silex\Provider\MonologServiceProvider(), [
    'monolog.logfile' => BASEPATH.'/var/logs/'.$_ENV['ENVIRONMENT'].'.log',
    'monolog.level' => Monolog\Logger::DEBUG, // NOTICE, WARNING, ERROR
]);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => BASEPATH.'/app/Resources/views',
));

$app->mount('/', new MyApp\DefaultController());

$app->run();
