# Silex Template
================
This Silex template has been written to shorten the setup process of a new Silex Application.

## Pre-installation
-------------------
You will need the following program installed in your computer:

- [PHPUnit](https://phpunit.de/manual/current/en/installation.html)
- [composer](https://getcomposer.org/download/)


## Installation
---------------
1. Create your project:
```
composer create-project lracicot/silex-template path/to/new/project
```

2. Go to your project:
```
cd path/to/new/project
```

3. Setup your environment:
```
cp .env.example
```

4. Change the values you need in the `.env` file.

5. Start the server:
```
composer run
```

6. Try it! http://localhost:8000

## What's included?
-------------------

### Libraries
- [monolog](http://silex.sensiolabs.org/doc/master/providers/monolog.html) - Logging for PHP.
- [phpdotenv](https://github.com/vlucas/phpdotenv) - Loads environment variables.
- [twig](http://silex.sensiolabs.org/doc/master/providers/twig.html) - Templating system, with a default base template.
- A default controller, with the [Controller Provider](http://silex.sensiolabs.org/doc/master/providers.html#controller-providers) system.
- [bootstrap](https://getbootstrap.com) - The CSS framework.
- [jQuery](https://jquery.com/) - [The "J" word](https://hackernoon.com/how-it-feels-to-learn-javascript-in-2016-d3a717dd577f#.qadonrt62). Yep, I said it. Are do you feel about it ?

## Optional dependencies
------------------------
The doctrine DBAL
```
conposer require doctrine/dbal
```

A doctrine ORM service Provider
```
composer require dflydev/doctrine-orm-service-provider
```
