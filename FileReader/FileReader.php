<?php

namespace FileReader;

use DataMapper\BikerDataMapperInterface;
use Entity\Biker;
use Exception;

class FileReader implements FileReaderInterface
{
    private const FILE_FORMAT_XML = 'xml';
    private const FILE_FORMAT_CSV = 'csv';
    private const FILE_EXTENSION_KEY = 'extension';
    private const PATH_TO_FILE = './assets/bikers.csv';

    /**
     * @var BikerDataMapperInterface
     */
    private $dataMapper;

    public function __construct(BikerDataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @return Biker[]|null
     */
    public function getDataFromFile(): ?array
    {
        $fileInfo = pathinfo(self::PATH_TO_FILE);

        switch ($fileInfo[self::FILE_EXTENSION_KEY]) {
            case self::FILE_FORMAT_CSV:
                return $this->getBikersDataFromCsv();
            case self::FILE_FORMAT_XML:
                return $this->getBikersDataFromXml();
            default:
                return null;
        }
    }

    /**
     * @return Biker[]|null
     */
    private function getBikersDataFromCsv(): ?array
    {
        $bikersData = @file_get_contents(self::PATH_TO_FILE);
        $bikersData = explode("\n", $bikersData);

        array_shift($bikersData);

        if (count((array)$bikersData) !== 0 && $bikersData !== false) {
            return $this->dataMapper->mapCsvDataToEntity($bikersData);
        }

        return null;
    }

    /**
     * @return Biker[]|null
     */
    private function getBikersDataFromXml(): ?array
    {
        $bikersData = simplexml_load_string(@file_get_contents(self::PATH_TO_FILE));

        if (count((array)$bikersData) !== 0 && $bikersData !== false) {
            return $this->dataMapper->mapXmlDataToEntity($bikersData);
        }

        return null;
    }
}
