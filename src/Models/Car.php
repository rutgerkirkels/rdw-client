<?php

namespace RutgerKirkels\RDW_Client\Models;

/**
 * Class Car
 * @package RutgerKirkels\RDW_Client\Models
 * @author Rutger Kirkels <rutger@kirkels.nl>
 * @license MIT
 */
class Car extends AbstractModel
{
    /**
     * @var string
     */
    protected $licensePlate;

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $version;

    /**
     * Car constructor.
     * @param Kenteken $kenteken
     */
    public function __construct(Kenteken $kenteken)
    {
        $this->licensePlate = $kenteken->getKenteken();
        $this->brand = $kenteken->getMerk();
        $this->version = $kenteken->getHandelsbenaming();
    }

    public function getFullDescription() : string
    {
        return $this->brand . ' ' . $this->version;
    }

    /**
     * @return string
     */
    public function getLicensePlate(): string
    {
        return $this->licensePlate;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}