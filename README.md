# Silex Template

This Silex template has been written to shorten the setup process of a new Silex Application.

## Pre-installation

You will need the following program installed in your computer:

- [PHPUnit](https://phpunit.de/manual/current/en/installation.html)
- [composer](https://getcomposer.org/download/)


## Installation

Create your project:
```
composer create-project lracicot/silex-template path/to/new/project
```
Go to your project:
```
cd path/to/new/project
```
Setup your environment:
```
cp .env.example .env
```
Change the values you need in the `.env` file.
Start the server:
```
COMPOSER_PROCESS_TIMEOUT=0 composer run
```
Try it! [http://localhost:8000](http://localhost:8000)

## Configuration

When you are deploying, there are a few configuration you might want to change. Here are the available configurations:

**ENVIRONMENT**: Can be _development_, _staging_, _testing_ or _production_ (default: _development_)
**BASEURL**: If you are running Silex in a subdirectory, you can change this. It will make the routes and the assets work.

## What's included?

### Libraries
- [monolog](http://silex.sensiolabs.org/doc/master/providers/monolog.html) - Logging for PHP.
- [phpdotenv](https://github.com/vlucas/phpdotenv) - Loads environment variables.
- [twig](http://silex.sensiolabs.org/doc/master/providers/twig.html) - Templating system, with a default base template.
- A default controller, with the [Controller Provider](http://silex.sensiolabs.org/doc/master/providers.html#controller-providers) system.
- [bootstrap](https://getbootstrap.com) - The CSS framework.
- [jQuery](https://jquery.com/) - [The "J" word](https://hackernoon.com/how-it-feels-to-learn-javascript-in-2016-d3a717dd577f#.qadonrt62). Yep, I said it. How do you feel about it ?

## Optional dependencies

The doctrine DBAL
```
conposer require doctrine/dbal
```

A doctrine ORM service Provider
```
composer require dflydev/doctrine-orm-service-provider
```
