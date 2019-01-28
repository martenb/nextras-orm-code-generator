<?php

namespace MartenB\Nextras\ORM\DI;

use martenb\Nextras\ORM\Console\Command\GeneratorCommand;
use Nette\DI\CompilerExtension;
use Nette\DI\Helpers;

class Extension extends CompilerExtension
{

	private $defaults = [
		'directory' => '%appDir%/model/orm',
		'namespace' => 'App\Model',
		'entityExtends' => 'App\Model\BaseEntity',
		'repositoryExtends' => 'App\Model\BaseRepository',
		'mapperExtends' => 'App\Model\BaseMapper',
	];


	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('console.generatorCommand'))
			->setFactory(GeneratorCommand::class)
			->addSetup('setConfig', [$this->_getConfig()]);
	}


	private function _getConfig()
	{
		$config = $this->validateConfig($this->defaults, $this->config);

		$config['directory'] = Helpers::expand(
			$config['directory'],
			$this->getContainerBuilder()->parameters
		);

		return $config;
	}

}
