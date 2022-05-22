<?php

namespace DataMapper;

use Entity\Biker;
use SimpleXMLElement;

interface BikerDataMapperInterface
{
    /**
     * @param array $bikersData
     *
     * @return Biker[]
     */
    public function mapCsvDataToEntity(array $bikersData): array;

    /**
     * @param SimpleXMLElement $bikersData
     *
     * @return Biker[]
     */
    public function mapXmlDataToEntity(SimpleXMLElement $bikersData): array;
}
