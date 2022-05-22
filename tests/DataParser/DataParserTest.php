<?php

require __DIR__ . "/../../DataParser/DataParserInterface.php";
require __DIR__ . "/../../DataParser/DataParser.php";
require __DIR__ . "/../../ConsoleWriter/ConsoleWriterInterface.php";
require __DIR__ . "/../../ConsoleWriter/ConsoleWriter.php";

use ConsoleWriter\ConsoleWriter;
use DataParser\DataParser;
use PHPUnit\Framework\TestCase;

final class DataParserTest extends TestCase
{
    /**
     * @var ConsoleWriter
     */
    private $consoleWriter;

    /**
     * @var DataParser
     */
    private $dataParser;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->consoleWriter = new ConsoleWriter();
        $this->dataParser = new DataParser($this->consoleWriter);
    }

    /**
     * @return void
     */
    public function testIfStationsDataFetchedFromApi(): void
    {
        $this->assertNotEmpty($this->dataParser->getStationsDataFromUrl());
    }
}
