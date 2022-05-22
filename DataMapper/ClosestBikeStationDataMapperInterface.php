<?php

namespace DataMapper;

use Entity\ClosestBikeStation;

interface ClosestBikeStationDataMapperInterface
{
    /**
     * @param array $closestBikeStationData
     *
     * @return ClosestBikeStation
     */
    public function mapDataToEntity(array $closestBikeStationData): ClosestBikeStation;
}
