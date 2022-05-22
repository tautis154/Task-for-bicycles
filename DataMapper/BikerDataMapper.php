<?php

namespace DataMapper;

require_once('Entity/Biker.php');

use Entity\Biker;
use SimpleXMLElement;

class BikerDataMapper implements BikerDataMapperInterface
{
    private const BIKER_COUNT_KEY = 0;
    private const BIKER_LATITUDE_KEY = 1;
    private const BIKER_LONGITUDE_KEY = 2;

    /**
     * @param array $bikersData
     *
     * @return Biker[]
     */
    public function mapCsvDataToEntity(array $bikersData): array
    {
        $formattedBikersData = [];

        foreach ($bikersData as $bikerData)
        {
            if ($bikerData !== '') {
                $formattedBikersData[] = $this->buildBikerFromCsvData($bikerData);
            }
        }

        return $formattedBikersData;
    }

    /**
     * @param SimpleXMLElement $bikersData
     *
     * @return Biker[]
     */
    public function mapXmlDataToEntity(SimpleXMLElement $bikersData): array
    {
        $formattedBikersData = [];

        foreach ($bikersData as $bikerData)
        {
            $formattedBikersData[] = $this->buildBikerFromXmlData($bikerData);
        }

        return $formattedBikersData;
    }

    /**
     * @param string $bikerData
     *
     * @return Biker
     */
    private function buildBikerFromCsvData(string $bikerData): Biker
    {
        $bikerDataInArray = explode(',', $bikerData);

        return $this->buildBikerFromData(
            (int)$bikerDataInArray[self::BIKER_COUNT_KEY],
            (float)$bikerDataInArray[self::BIKER_LATITUDE_KEY],
            (float)$bikerDataInArray[self::BIKER_LONGITUDE_KEY]
        );
    }

    /**
     * @param SimpleXMLElement $bikerData
     *
     * @return Biker
     */
    private function buildBikerFromXmlData(SimpleXMLElement $bikerData): Biker
    {
        return $this->buildBikerFromData(
            (int)$bikerData->count,
            (float)$bikerData->latitude,
            (float)$bikerData->longitude
        );
    }

    /**
     * @param int $bikerCount
     * @param float $bikerLatitude
     * @param float $bikerLongitude
     *
     * @return Biker
     */
    private function buildBikerFromData(int $bikerCount, float $bikerLatitude, float $bikerLongitude): Biker
    {
        $biker = new Biker();
        $biker->setCount($bikerCount);
        $biker->setLatitude($bikerLatitude);
        $biker->setLongitude($bikerLongitude);

        return $biker;
    }
}
