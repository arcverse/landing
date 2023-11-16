<?php

namespace App\Command;

use Logtail\Monolog\LogtailHandler;
use Monolog\Logger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:test:logger',
    description: 'Add a short description for your command',
)]
class TestLoggerCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('message', InputArgument::REQUIRED, 'The message to log')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('message');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        $logger = new Logger("landing");
        $logger->pushHandler(new LogtailHandler($_ENV["LOGTAIL_SOURCE_TOKEN"]));

        $logger->info($arg1);

        $io->success('Logged your message to logtail :D');

        return Command::SUCCESS;
    }
}
