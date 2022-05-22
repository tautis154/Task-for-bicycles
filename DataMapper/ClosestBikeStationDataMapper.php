<?php

namespace DataMapper;

use Entity\ClosestBikeStation;

class ClosestBikeStationDataMapper implements ClosestBikeStationDataMapperInterface
{
    /**
     * @param array $closestBikeStationData
     *
     * @return ClosestBikeStation
     */
    public function mapDataToEntity(array $closestBikeStationData): ClosestBikeStation
    {
        $closestBikeStation = new ClosestBikeStation();
        $closestBikeStation->setAddress($closestBikeStationData['closestStationAddress']);
        $closestBikeStation->setDistance($closestBikeStationData['shortestDistance']);
        $closestBikeStation->setFreeBikeCount($closestBikeStationData['freeBikeCount']);
        $closestBikeStation->setBikerCount($closestBikeStationData['bikerCount']);

        return $closestBikeStation;
    }
}
