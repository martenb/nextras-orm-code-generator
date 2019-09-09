<?php declare(strict_types = 1);

use Ninjify\Nunjuck\Environment;

if (@!include __DIR__ . '/../vendor/autoload.php') {
	echo 'Install Nette Tester using `composer update --dev`';
	exit(1);
}

// Configure environment
Environment::setupTester();
Environment::setupTimezone();
Environment::setupVariables(__DIR__);

$defaultTestsConfig = [
	'directory' => TEMP_DIR . '/Model/Orm',
	'namespace' => 'App\Model\Orm',
	'entityExtends' => 'Nextras\Orm\Entity\Entity',
	'repositoryExtends' => 'Nextras\Orm\Repository\Repository',
	'mapperExtends' => 'Nextras\Orm\Mapper\Mapper',
];
