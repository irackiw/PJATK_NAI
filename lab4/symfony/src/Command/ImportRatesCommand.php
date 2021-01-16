<?php

namespace App\Command;

use App\Entity\Rate;
use App\Entity\User;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportRatesCommand extends Command
{
    protected static $defaultName = 'rate:import-csv';

    public function __construct(
        private EntityManagerInterface $entityManager,
        private FilmRepository $filmRepository,
        string $name = null
    ) {
        parent::__construct($name);
    }

    /**
     * @TODO add optional file path parameter
     */
    protected function configure()
    {
        $this
            ->setDescription('Import users, films and rates from csv file (/var/www/symfony/files/sample.csv)');
    }

    /**
     *
     * Command to import users, films and rates from csv file (/var/www/symfony/files/sample.csv)
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rowNo = 1;
        if (($fp = fopen("/var/www/symfony/public/files/sample.csv", "r")) !== false) {
            while (($row = fgetcsv($fp, 1000, ";")) !== false) {
                $num = count($row);
                $rowNo++;
                $name = $row[0];
                if (!is_string($name) && strlen($name) == 0) {
                    continue;
                }
                $user = new User($name);
                for ($c = 0; $c < $num; $c++) {

                    if (is_string($row[$c]) && strlen($row[$c]) > 0 && (key_exists($c + 1, $row) && is_numeric(
                                $row[$c + 1]
                            ) && $row[$c + 1] > 0) && ($c % 2) == 1) {
                        print_r('User: '.$name.' Film: '.$row[$c].' Ocena: '.$row[$c + 1]."\n");
                        try {
                            $film = $this->filmRepository->getOrCreate($row[$c]);
                            $rate = (new Rate())->setRate((int)$row[$c + 1])->setFilm($film)->setUser($user);
                            $this->entityManager->persist($rate);
                            $this->entityManager->flush();
                        } catch (\Throwable $throwable){
                            print_r('ERROR: ' . $throwable->getMessage());
                        }

                    }
                }
            }
            fclose($fp);
        }

        print_r("Rates imported");
        return Command::SUCCESS;
    }
}
