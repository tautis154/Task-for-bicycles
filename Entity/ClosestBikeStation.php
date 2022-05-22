<?php

namespace Entity;

class ClosestBikeStation
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var float
     */
    private $distance;

    /**
     * @var int
     */
    private $freeBikeCount;

    /**
     * @var int
     */
    private $bikerCount;

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     *
     * @return $this
     */
    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * @return int
     */
    public function getFreeBikeCount(): int
    {
        return $this->freeBikeCount;
    }

    /**
     * @param int $freeBikeCount
     *
     * @return $this
     */
    public function setFreeBikeCount(int $freeBikeCount): self
    {
        $this->freeBikeCount = $freeBikeCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getBikerCount(): int
    {
        return $this->bikerCount;
    }

    /**
     * @param int $bikerCount
     *
     * @return $this
     */
    public function setBikerCount(int $bikerCount): self
    {
        $this->bikerCount = $bikerCount;

        return $this;
    }
}
