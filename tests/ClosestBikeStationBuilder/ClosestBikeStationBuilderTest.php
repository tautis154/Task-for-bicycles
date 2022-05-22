<?php

require __DIR__ . "/../../ClosestBikeStationBuilder/ClosestBikeStationBuilderInterface.php";
require __DIR__ . "/../../ClosestBikeStationBuilder/ClosestBikeStationBuilder.php";
require __DIR__ . "/../../DataMapper/ClosestBikeStationDataMapperInterface.php";
require __DIR__ . "/../../DataMapper/ClosestBikeStationDataMapper.php";
require __DIR__ . "/../../Entity/Biker.php";

use ClosestBikeStationBuilder\ClosestBikeStationBuilder;
use DataMapper\ClosestBikeStationDataMapper;
use Entity\Biker;
use PHPUnit\Framework\TestCase;

final class ClosestBikeStationBuilderTest extends TestCase
{
    /**
     * @var ClosestBikeStationDataMapper
     */
    private $closestBikeStationMapper;

    /**
     * @var ClosestBikeStationBuilder
     */
    private $closestBikeStationBuilder;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->closestBikeStationMapper = new ClosestBikeStationDataMapper();
        $this->closestBikeStationBuilder = new ClosestBikeStationBuilder($this->closestBikeStationMapper);
    }

    /**
     * @return void
     */
    public function testIfClosestBikeStationFound(): void
    {
        $biker = new Biker();
        $biker->setCount(0);
        $biker->setLatitude(55.67766);
        $biker->setLongitude(12.59747);
        $bikersData[] = $biker;

        $stationsData[] = [
            'free_bikes' => 0,
            'latitude' => 55.677848815918,
            'longitude' => 12.562789916992,
            'extra' => [
                'address' => 'Staunings Plads, København, 1606 Copenhagen',
            ],
        ];

        $closestBikeStations = $this->closestBikeStationBuilder->buildClosestStationsFromData($bikersData, $stationsData);
        $this->assertNotNull($closestBikeStations[0]);
    }

    /**
     * @return void
     */
    public function testIfClosestBikeStationAddressIsCorrect(): void
    {
        $biker = new Biker();
        $biker->setCount(0);
        $biker->setLatitude(55.67766);
        $biker->setLongitude(12.59747);
        $bikersData[] = $biker;

        $stationsData[] = [
            'free_bikes' => 0,
            'latitude' => 55.677848815918,
            'longitude' => 12.562789916992,
            'extra' => [
                'address' => 'Testing Address',
            ],
        ];

        $closestBikeStations = $this->closestBikeStationBuilder->buildClosestStationsFromData($bikersData, $stationsData);
        $this->assertEquals('Testing Address', $closestBikeStations[0]->getAddress());
    }

    /**
     * @return void
     */
    public function testIfClosestBikeStationIsActuallyClosest(): void
    {
        $biker = new Biker();
        $biker->setCount(0);
        $biker->setLatitude(55.67766);
        $biker->setLongitude(12.59747);
        $bikersData[] = $biker;

        $stationsData[] = [
            'free_bikes' => 0,
            'latitude' => 55.67766,
            'longitude' => 12.59747,
            'extra' => [
                'address' => 'First Testing Address',
            ],
        ];
        $stationsData[] = [
            'free_bikes' => 0,
            'latitude' => 70.677848815918,
            'longitude' => 20.562789916992,
            'extra' => [
                'address' => 'Second Testing Address',
            ],
        ];

        $closestBikeStations = $this->closestBikeStationBuilder->buildClosestStationsFromData($bikersData, $stationsData);
        $this->assertEquals('First Testing Address', $closestBikeStations[0]->getAddress());
    }
}
