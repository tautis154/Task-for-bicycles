<?php

namespace FileReader;

use Entity\Biker;

interface FileReaderInterface
{
    /**
     * @return Biker[]|null
     */
    public function getDataFromFile(): ?array;
}
