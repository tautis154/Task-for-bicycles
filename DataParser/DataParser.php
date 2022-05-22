<?php

namespace DataParser;

use ConsoleWriter\ConsoleWriterInterface;
use Exception;

class DataParser implements DataParserInterface
{
    private const API_URL = 'https://api.citybik.es/v2/networks/bycyklen';

    /**
     * @var ConsoleWriterInterface
     */
    private $consoleWriter;

    /**
     * @param ConsoleWriterInterface $consoleWriter
     */
    public function __construct(ConsoleWriterInterface $consoleWriter)
    {
        $this->consoleWriter = $consoleWriter;
    }

    /**
     * @return array
     */
    public function getStationsDataFromUrl(): array
    {
        $dataJson = @file_get_contents(self::API_URL);

        try {
            $dataArray = json_decode($dataJson, true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $exception) {
            $this->consoleWriter->writeApiDataErrorToConsole($exception->getMessage());
        }

        return $dataArray['network']['stations'];
    }
}
