<?php

use ClosestBikeStationBuilder\ClosestBikeStationBuilderInterface;
use ConsoleWriter\ConsoleWriterInterface;
use DataParser\DataParserInterface;
use FileReader\FileReaderInterface;

class Index
{
    /**
     * @var DataParserInterface
     */
    private $dataParser;

    /**
     * @var FileReaderInterface
     */
    private $fileReader;

    /**
     * @var ConsoleWriterInterface
     */
    private $consoleWriter;

    /**
     * @var ClosestBikeStationBuilderInterface
     */
    private $closestBikeStationBuilder;

    /**
     * @param DataParserInterface $dataParser
     * @param FileReaderInterface $fileReader
     * @param ConsoleWriterInterface $consoleWriter
     * @param ClosestBikeStationBuilderInterface $closestBikeStationBuilder
     */
    public function __construct(
        DataParserInterface $dataParser,
        FileReaderInterface $fileReader,
        ConsoleWriterInterface $consoleWriter,
        ClosestBikeStationBuilderInterface $closestBikeStationBuilder
    ) {
        $this->dataParser = $dataParser;
        $this->fileReader = $fileReader;
        $this->consoleWriter = $consoleWriter;
        $this->closestBikeStationBuilder = $closestBikeStationBuilder;
    }

    /**
     * @return void
     */
    public function indexAction(): void
    {
        $stationsDataArray = $this->dataParser->getStationsDataFromUrl();

        $bikersData = $this->fileReader->getDataFromFile();

        if ($bikersData) {
            $closestBikeStations = $this
                ->closestBikeStationBuilder
                ->buildClosestStationsFromData($bikersData, $stationsDataArray);

            $this->consoleWriter->writeStationsDataToConsole($closestBikeStations);
        } else {
            $this->consoleWriter->writeBikersNotFoundToConsole();
        }
    }
}
