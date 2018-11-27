<?php

namespace RutgerKirkels\RDW_Client\Models;

/**
 * Class AbstractModel
 * @package RutgerKirkels\RDW_Client\Models
 * @author Rutger Kirkels <rutger@kirkels.nl>
 * @license MIT
 */
abstract class AbstractModel
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public function toArray() : array
    {
        $returnArray = [];
        $reflect = new \ReflectionClass($this);
        $properties   = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);

        foreach($properties as $property) {
            $name = $property->getName();
            if (!is_null($this->$name)) {
                $returnArray[$name] = $this->$name;
            }

        }

        return $returnArray;
    }
}