<?php

declare(strict_types=1);


use Contributte\Middlewares\Application\IApplication;

require __DIR__ . '/../vendor/autoload.php';

//$configurator = App\Bootstrap::boot();
//$container = $configurator->createContainer();
//$application = $container->getByType(Nette\Application\Application::class);
//$application->run();

\App\Bootstrap::boot()
    ->createContainer()
    ->getByType(IApplication::class)
    ->run();
