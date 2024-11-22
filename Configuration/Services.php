<?php
return static function(\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $configurator) {
    $services = $configurator->services();

    $services->defaults()
        ->autoconfigure()
        ->autowire()
        ->private();

    $services->load('Tyrone\\SmartConsult\\', '../Classes/*');

    foreach (glob(__DIR__ . '/../Classes/Command/*Command.php') as $file) {
        $shortClassName = basename($file, '.php');
        $camelCommandName = substr($shortClassName, 0, -strlen('Command'));
        $commandName = strtolower(preg_replace('#(?<=[a-z])([A-Z])#', ':\1', $camelCommandName));

        $services->set("Tyrone\\SmartConsult\\Command\\$shortClassName")
            ->tag('console.command', ['command' => $commandName, 'schedulable' => false]);
    }
};
