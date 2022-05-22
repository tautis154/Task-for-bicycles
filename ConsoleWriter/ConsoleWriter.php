<?php

namespace ConsoleWriter;

use Entity\ClosestBikeStation;

class ConsoleWriter implements ConsoleWriterInterface
{
    private const TITLE_DISTANCE = 'distance';
    private const TITLE_ADDRESS = 'address';
    private const TITLE_FREE_BIKE_COUNT = 'free_bike_count';
    private const TITLE_BIKER_COUNT = 'biker_count';
    private const MESSAGE_BIKERS_NOT_FOUND = 'No Biker data was found in your data file.';
    private const MESSAGE_API_ERROR = 'occurred when getting data from API';

    /**
     * @param ClosestBikeStation[] $closestBikeStations
     *
     * @return void
     */
    public function writeStationsDataToConsole(array $closestBikeStations): void
    {
        $row = "%s: %s\n";

        foreach ($closestBikeStations as $closestBikeStation) {
            printf($row, self::TITLE_DISTANCE, $closestBikeStation->getDistance());
            printf($row, self::TITLE_ADDRESS, $closestBikeStation->getAddress());
            printf($row, self::TITLE_FREE_BIKE_COUNT, $closestBikeStation->getFreeBikeCount());
            printf($row, self::TITLE_BIKER_COUNT, $closestBikeStation->getBikerCount());
        }
    }

    /**
     * @return void
     */
    public function writeBikersNotFoundToConsole(): void
    {
        echo (self::MESSAGE_BIKERS_NOT_FOUND);
    }

    /**
     * @param string $errorMessage
     *
     * @return void
     */
    public function writeApiDataErrorToConsole(string $errorMessage): void
    {
        printf('%s %s', $errorMessage, self::MESSAGE_API_ERROR);

        $this->endCode();
    }

    /**
     * @return void
     */
    private function endCode(): void
    {
        die();
    }
}
