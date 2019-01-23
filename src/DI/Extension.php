<?php

namespace martenb\Nextras\ORM\DI;

use martenb\Nextras\ORM\Console\Command\GeneratorCommand;
use Nette\DI\CompilerExtension;

class Extension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('console.generatorCommand'))
			->setFactory(GeneratorCommand::class);
	}

}
