<?php

namespace ConsoleWriter;

use Entity\ClosestBikeStation;

interface ConsoleWriterInterface
{
    /**
     * @param ClosestBikeStation[] $closestBikeStations
     *
     * @return void
     */
    public function writeStationsDataToConsole(array $closestBikeStations): void;

    /**
     * @return void
     */
    public function writeBikersNotFoundToConsole(): void;

    /**
     * @param string $errorMessage
     *
     * @return void
     */
    public function writeApiDataErrorToConsole(string $errorMessage): void;
}
