<?php

namespace martenb\Nextras\ORM\Console\Command;

use Exception;
use Nette\PhpGenerator\PhpFile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GeneratorCommand extends Command
{

	protected function configure()
	{
		$this->setName('orm:generator')
			->setDescription('Generate entity, repository and mapper')
			->addArgument('entityName', InputArgument::REQUIRED, 'Entity name (e.g. Product)')
			->addArgument('repositoryName', InputArgument::REQUIRED, 'Repository name (e.g. Products)')
			->addArgument('mapperName', InputArgument::OPTIONAL, 'Mapper name (e.g. Products)')
			->addOption('directory', 'd', InputOption::VALUE_OPTIONAL, 'Base ORM directory', __DIR__ . '/../../../model/orm')
			->addOption('namespace', 's', InputOption::VALUE_OPTIONAL, 'Entity, repository and mapper namespace', 'App\Model')
			->addOption('entityExtends', 'ee', InputOption::VALUE_OPTIONAL, 'Entity extends class name', 'App\Model\BaseEntity')
			->addOption('repositoryExtends', 're', InputOption::VALUE_OPTIONAL, 'Repository extends class name', 'App\Model\BaseRepository')
			->addOption('mapperExtends', 'me', InputOption::VALUE_OPTIONAL, 'Mapper extends class name', 'App\Model\BaseMapper');
	}


	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$directory = $input->getOption('directory') . '/' . $input->getArgument('entityName');
		if (file_exists($directory)) {
			throw new Exception('Directory already exists.');
		}
		mkdir($directory, 0777, TRUE);

		$namespace = $input->getOption('namespace');

		// entity
		$entityName = $input->getArgument('entityName');
		$file = new PhpFile;
		$file
			->addNamespace($namespace)
				->addClass($entityName)
					->setExtends($input->getOption('entityExtends'))
					->addComment('@property int $id {primary}');

		file_put_contents($directory . '/' . $entityName . '.php', (string) $file);

		// repository
		$repositoryName = $input->getArgument('repositoryName') . 'Repository';
		$file = new PhpFile;
		$file
			->addNamespace($namespace)
				->addClass($repositoryName)
					->setExtends($input->getOption('repositoryExtends'))
					->addMethod('getEntityClassNames')
						->setStatic(TRUE)
						->setReturnType('array')
						->setBody('return [' . $input->getArgument('entityName') . '::class];');

		file_put_contents($directory . '/' . $repositoryName . '.php', (string) $file);

		// mapper
		$mapperName = ($input->getArgument('mapperName') ?? $input->getArgument('repositoryName')) . 'Mapper';
		$file = new PhpFile;
		$file
			->addNamespace($namespace)
				->addClass($mapperName)
					->setExtends($input->getOption('mapperExtends'));

		file_put_contents($directory . '/' . $mapperName . '.php', (string) $file);
	}

}
