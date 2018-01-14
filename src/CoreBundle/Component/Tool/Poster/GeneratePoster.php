<?php

namespace Runalyze\Bundle\CoreBundle\Component\Tool\Poster;

use Runalyze\Bundle\CoreBundle\Entity\Account;
use Runalyze\Bundle\CoreBundle\Entity\TrainingRepository;
use Runalyze\Bundle\CoreBundle\Entity\Sport;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Psr\Log\LoggerInterface;

class GeneratePoster
{
    /** @var array */
    protected $Parameter = [];

    /** @var string */
    protected $KernelRootDir;

    /** @var string */
    protected $Python3path;

    /** @var TrainingRepository */
    protected $TrainingRepository;

    /** @var string */
    protected $Filename;

    /** @var LoggerInterface */
    protected $Logger;

    /**
     * @param string $kernelRootDir
     * @param string $python3Path
     * @param TrainingRepository $trainingRepository
     * @param LoggerInterface $logger
     */
    public function __construct($kernelRootDir, $python3Path, TrainingRepository $trainingRepository, LoggerInterface $logger)
    {
        $this->KernelRootDir = $kernelRootDir;
        $this->Python3Path = $python3Path;
        $this->TrainingRepository = $trainingRepository;
        $this->Logger = $logger;
    }

    /**
     * @return string
     */
    protected function pathToRepository()
    {
        return $this->KernelRootDir.'/../vendor/runalyze/GpxTrackPoster/';
    }

    /**
     * @return string
     */
    protected function pathToSvgDirectory()
    {
        return $this->KernelRootDir.'/../var/poster/';
    }

    /**
     * @param string $athlete
     * @param string $year
     */
    protected function generateRandomFileName($athlete, $year)
    {
        $this->Filename = md5($athlete.$year.strtotime("now")).'.svg';
    }

    /**
     * @return string path to generated file
     */
    public function generate()
    {
        $this->Logger->info('Poster creation requested.', ['params' => implode(' ', $this->Parameter)]);

        $builder = new Process($this->Python3Path.' create_poster.py '.implode(' ', $this->Parameter));
        $builder->setWorkingDirectory($this->pathToRepository())->run();

        return $this->pathToSvgDirectory().$this->Filename;
    }

    /**
     * @param string $type
     * @param string $jsonDir
     * @param int $year
     * @param Account $account
     * @param Sport $sport
     * @param null|string $title
     * @param string $backgroundColor
     * @param string $trackColor
     * @param string $trackColorTwo
     * @param string $textColor
     * @param string $raceColor
     * @param string $athlete
     * @param string $unit
     */
    public function buildCommand($type, $jsonDir, $year, Account $account, Sport $sport, $title, $backgroundColor, $trackColor, $trackColorTwo, $textColor, $raceColor, $athlete, $unit, $heatmapCenter, $heatmapRadius, $circularRings, $circularRingColor)
    {
        $this->generateRandomFileName($account->getUsername(), $year);

        $this->Parameter[] = '--json-dir '.$jsonDir;
        $this->Parameter[] = '--athlete '.escapeshellarg($athlete);
        $this->Parameter[] = '--unit '.escapeshellarg($unit);
        $this->Parameter[] = '--year '.(int)$year;
        $this->Parameter[] = '--output '.$this->pathToSvgDirectory().$this->Filename;
        $this->Parameter[] = '--type '.$type;
        $this->Parameter[] = '--title '.escapeshellarg($title);
        $this->Parameter[] = '--background-color  '.escapeshellarg($backgroundColor);
        $this->Parameter[] = '--track-color '.escapeshellarg($trackColor);
        $this->Parameter[] = '--heatmap-center '.escapeshellarg($heatmapCenter);
        $this->Parameter[] = '--heatmap-radius '.escapeshellarg($heatmapRadius);
        if ($circularRings) {
            $this->Parameter[] = '--circular-rings';
            $this->Parameter[] = '--circular-ring-color '.escapeshellarg($circularRingColor);
        }


        if (!empty($trackColorTwo)) {
            $this->Parameter[] = '--track-color2 '.escapeshellarg($trackColorTwo);
        }

        $this->Parameter[] = '--text-color '.escapeshellarg($textColor);
        $this->Parameter[] = '--special-color '.escapeshellarg($raceColor);

        $this->addStatsParameter($account, $sport, $year);

        if ((new Filesystem())->exists($jsonDir.'/special.params')) {
            $this->Parameter[] = file_get_contents($jsonDir.'/special.params');
        }
    }

    /**
     * @param Account $account
     * @param Sport $sport
     * @param int $year
     */
    private function addStatsParameter(Account $account, Sport $sport, $year)
    {
        $stats = $this->TrainingRepository->getStatsForPoster($account, $sport, $year)->getArrayResult();
        $data = $stats[0];

        $this->Parameter[] = '--stat-num '.(int)$data['num'];
        $this->Parameter[] = '--stat-total '.(float)$data['total_distance'];
        $this->Parameter[] = '--stat-min '.(float)$data['min_distance'];
        $this->Parameter[] = '--stat-max '.(float)$data['max_distance'];
    }

    /**
     * @return array
     */
    public function availablePosterTypes()
    {
        return ['grid', 'calendar', 'circular', 'heatmap'];
    }

    public function deleteSvg()
    {
        $filesystem = new Filesystem();
        $filesystem->remove($this->pathToSvgDirectory().$this->Filename);
    }
}
