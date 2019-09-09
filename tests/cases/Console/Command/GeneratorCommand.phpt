<?php declare(strict_types = 1);

use MartenB\Nextras\ORM\Console\Command\GeneratorCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';

// Test if GeneratorCommand is created
test(function () use ($defaultTestsConfig): void {
	$generatorCommand = new GeneratorCommand();

	$generatorCommand->setConfig($defaultTestsConfig);

	$input = new ArrayInput([
		'entityName' => 'User',
		'repositoryName' => 'Users',
		'mapperName' => 'Users',
	]);

	$output = new BufferedOutput();

	Assert::same(0, $generatorCommand->run($input, $output));

	require $defaultTestsConfig['directory'] . '/User/User.php';
});
