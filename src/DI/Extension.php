<?php declare(strict_types = 1);

namespace MartenB\Nextras\ORM\DI;

use MartenB\Nextras\ORM\Console\Command\GeneratorCommand;
use Nette\DI\CompilerExtension;
use Nette\DI\Helpers;

class Extension extends CompilerExtension
{

	/** @var string[] */
	private $defaults = [
		'directory' => '%appDir%/Model/Orm',
		'namespace' => 'App\Model',
		'entityExtends' => 'App\Model\BaseEntity',
		'repositoryExtends' => 'App\Model\BaseRepository',
		'mapperExtends' => 'App\Model\BaseMapper',
	];

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('console.generatorCommand'))
			->setFactory(GeneratorCommand::class)
			->addSetup('setConfig', [$this->_getConfig()]);
	}

	/**
	 * @return string[]
	 */
	private function _getConfig(): array
	{
		$config = $this->validateConfig($this->defaults);

		$config['directory'] = Helpers::expand(
			$config['directory'],
			$this->getContainerBuilder()->parameters
		);

		return $config;
	}

}
