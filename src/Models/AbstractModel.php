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
    public function toArray(): array
    {
        $returnArray = [];
        $reflect = new \ReflectionClass($this);
        $properties = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $name = $property->getName();
            if (!is_null($this->$name)) {
                $method = 'get' . $this->dashesToCamelCase($name, true);

                $value = $this->$method();

                if (is_object($value) && get_class($value) === 'DateTime') {
                    $value = $value->format('d-m-Y');
                }
                $returnArray[$name] = $value;
            }

        }

        return $returnArray;
    }

    /**
     * @param $string
     * @param bool $capitalizeFirstCharacter
     * @return mixed|string
     */
    protected function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
    {

        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * @param string $date
     * @return bool|\DateTime
     */
    protected function convertDate(string $date)
    {
        return \DateTime::createFromFormat('j/m/Y H:i:s', $date . ' 00:00:00');
    }
}