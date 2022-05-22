<?php

namespace ClosestBikeStationBuilder;

use Entity\Biker;
use Entity\ClosestBikeStation;

interface ClosestBikeStationBuilderInterface
{
    /**
     * @param Biker[] $bikersData
     * @param array $stationsData
     *
     * @return ClosestBikeStation[]
     */
    public function buildClosestStationsFromData(array $bikersData, array $stationsData): array;
}
