<?php
namespace MyApp;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class DefaultController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Application $app) {
            return $app['twig']->render('index.html.twig');
        });

        return $controllers;
    }
}
