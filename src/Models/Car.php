<?php

namespace RutgerKirkels\RDW_Client\Models;

/**
 * Class Car
 * @package RutgerKirkels\RDW_Client\Models
 * @author Rutger Kirkels <rutger@kirkels.nl>
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
    protected $type;

    /**
     * Car constructor.
     * @param Kenteken $kenteken
     */
    public function __construct(Kenteken $kenteken)
    {
        $this->licensePlate = $kenteken->getKenteken();
        $this->brand = $kenteken->getMerk();
        $this->type = $kenteken->getHandelsbenaming();
    }
}