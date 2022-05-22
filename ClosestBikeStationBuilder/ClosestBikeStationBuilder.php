<?php

namespace ClosestBikeStationBuilder;

require_once('Entity/ClosestBikeStation.php');

use DataMapper\ClosestBikeStationDataMapperInterface;
use Entity\Biker;
use Entity\ClosestBikeStation;

class ClosestBikeStationBuilder implements ClosestBikeStationBuilderInterface
{
    private const EARTH_RADIUS = 6371;
    private const SHORTEST_DISTANCE_KEY = 'shortestDistance';
    private const INITIAL_SHORTEST_DISTANCE_VALUE = 9999999999;
    private const CLOSEST_STATION_ADDRESS_KEY = 'closestStationAddress';
    private const FREE_BIKE_COUNT_KEY = 'freeBikeCount';
    private const BIKER_COUNT_KEY = 'bikerCount';

    /**
     * @var ClosestBikeStationDataMapperInterface
     */
    private $closestBikeStationDataMapper;

    public function __construct(ClosestBikeStationDataMapperInterface $closestBikeStationDataMapper)
    {
        $this->closestBikeStationDataMapper = $closestBikeStationDataMapper;
    }

    /**
     * @param Biker[] $bikersData
     * @param array $stationsData
     *
     * @return ClosestBikeStation[]
     */
    public function buildClosestStationsFromData(array $bikersData, array $stationsData): array
    {
        $closestBikeStations = [];

        foreach ($bikersData as $biker) {
            $closestBikeStationData = $this->buildInitialClosestBikeStationArray();

            $closestBikeStationData = $this->buildClosestStationDataArray(
                $closestBikeStationData,
                $stationsData,
                $biker
            );

            $closestBikeStations[] = $this->closestBikeStationDataMapper->mapDataToEntity($closestBikeStationData);
        }

        return $closestBikeStations;
    }

    /**
     * @return array
     */
    private function buildInitialClosestBikeStationArray(): array
    {
        return [
            self::SHORTEST_DISTANCE_KEY => self::INITIAL_SHORTEST_DISTANCE_VALUE,
            self::CLOSEST_STATION_ADDRESS_KEY => '',
            self::FREE_BIKE_COUNT_KEY => 0,
            self::BIKER_COUNT_KEY => 0,
        ];
    }

    /**
     * @param array $closestBikeStationData
     * @param array $stationsData
     * @param Biker $biker
     *
     * @return array
     */
    private function buildClosestStationDataArray(
        array $closestBikeStationData,
        array $stationsData,
        Biker $biker
    ): array {
        $shortestDistanceKey = 0;

        foreach ($stationsData as $key => $station) {
            $distance = $this->getDistance(
                $station["latitude"],
                $station["longitude"],
                $biker->getLatitude(),
                $biker->getLongitude()
            );

            if ($distance < $closestBikeStationData[self::SHORTEST_DISTANCE_KEY]) {
                $closestBikeStationData[self::SHORTEST_DISTANCE_KEY] = $distance;
                $shortestDistanceKey = $key;
            }

            if (array_key_last($stationsData) === $key) {
                $closestBikeStationData[self::CLOSEST_STATION_ADDRESS_KEY] = $stationsData[$shortestDistanceKey]['extra']["address"];
                $closestBikeStationData[self::FREE_BIKE_COUNT_KEY] = $stationsData[$shortestDistanceKey]["free_bikes"];
                $closestBikeStationData[self::BIKER_COUNT_KEY] = $biker->getCount();
            }
        }

        return $closestBikeStationData;
    }

    /**
     * @param float $stationLatitude
     * @param float $stationLongitude
     * @param float $bikerLatitude
     * @param float $bikerLongitude
     *
     * @return float|int
     */
    private function getDistance(
        float $stationLatitude,
        float $stationLongitude,
        float $bikerLatitude,
        float $bikerLongitude
    ) {
        $deltaLat = deg2rad($bikerLatitude - $stationLatitude);
        $deltaLon = deg2rad($bikerLongitude - $stationLongitude);

        $distance = sin($deltaLat/2)
            * sin($deltaLat/2)
            + cos(deg2rad($stationLatitude))
            * cos(deg2rad($bikerLatitude))
            * sin($deltaLon/2)
            * sin($deltaLon/2);

        return 2 * asin(sqrt($distance)) * self::EARTH_RADIUS;
    }
}
