<?php

namespace DataParser;

interface DataParserInterface
{
    /**
     * @return array
     */
    public function getStationsDataFromUrl(): array;
}
