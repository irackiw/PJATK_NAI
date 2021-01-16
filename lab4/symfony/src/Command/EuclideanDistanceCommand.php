<?php

namespace App\Command;

use App\Service\EuclideanDistanceCalculatorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EuclideanDistanceCommand extends Command
{
    protected static $defaultName = 'rate:calculate:euclidean';

    public function __construct(
        private EuclideanDistanceCalculatorService $calculator,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Calculate euclidean distance based on user rates');
    }

    /**
     * Command to calculate euclidean distance based on user rates
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->calculator->generateEuclideanDistanceScoreForAllRatings();

        } catch (\Throwable $throwable) {
            print_r($throwable->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
