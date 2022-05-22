<?php

require_once('Index.php');
require_once('DataParser/DataParserInterface.php');
require_once('DataParser/DataParser.php');
require_once('FileReader/FileReaderInterface.php');
require_once('FileReader/FileReader.php');
require_once('DataMapper/BikerDataMapperInterface.php');
require_once('DataMapper/BikerDataMapper.php');
require_once('DataMapper/ClosestBikeStationDataMapperInterface.php');
require_once('DataMapper/ClosestBikeStationDataMapper.php');
require_once('ConsoleWriter/ConsoleWriterInterface.php');
require_once('ConsoleWriter/ConsoleWriter.php');
require_once('ClosestBikeStationBuilder/ClosestBikeStationBuilderInterface.php');
require_once('ClosestBikeStationBuilder/ClosestBikeStationBuilder.php');

use ClosestBikeStationBuilder\ClosestBikeStationBuilder;
use ConsoleWriter\ConsoleWriter;
use DataMapper\BikerDataMapper;
use DataMapper\ClosestBikeStationDataMapper;
use DataParser\DataParser;
use FileReader\FileReader;

$index = new Index(
    new DataParser(new ConsoleWriter()),
    new FileReader(new BikerDataMapper()),
    new ConsoleWriter(),
    new ClosestBikeStationBuilder(new ClosestBikeStationDataMapper())
);

$index->indexAction();
