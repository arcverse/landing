<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:prepare-directories',
    description: 'Add a short description for your command',
)]
class PrepareDirectoriesCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('replace', "re", InputOption::VALUE_NONE, 'Replace existing directories')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dirs = ["public/uploads", "public/uploads/blog", "public/uploads/blog/images", "public/uploads/shop", "public/uploads/shop/images"];
        $io = new SymfonyStyle($input, $output);
        $replace = $input->getOption('replace');

        foreach ($dirs as $dir) {
            if (file_exists($dir)) {
                if ($replace) {
                    $io->writeln("Directory already exists: $dir | replacing");
                    $io->writeln("Removing directory: $dir");
                    rmdir($dir);
                    $io->writeln("Creating directory: $dir");
                    mkdir($dir, 0777, true);
                } else {
                    $io->writeln("Directory already exists: $dir | skipping");
                }
            } else {
                $io->writeln("Creating directory: $dir");
                mkdir($dir, 0777, true);
            }
        }

        $io->success('Directories prepared successfully.');

        return Command::SUCCESS;
    }
}
