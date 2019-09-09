<?php declare(strict_types = 1);

use MartenB\Nextras\ORM\Console\Command\GeneratorCommand;
use MartenB\Nextras\ORM\DI\Extension;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

// Test if GeneratorCommand is created
test(function () use ($defaultTestsConfig): void {
	$loader = new ContainerLoader(TMP_DIR, true);
	$class = $loader->load(function (Compiler $compiler) use ($defaultTestsConfig): void {
		$compiler->addExtension('ormGenerator', new Extension())
			->addConfig([
				'ormGenerator' => $defaultTestsConfig,
			]);
	}, 1);
	/** @var Container $container */
	$container = new $class();

	Assert::type(GeneratorCommand::class, $container->getService('ormGenerator.console.generatorCommand'));
});
