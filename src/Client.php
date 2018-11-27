<?php
namespace RutgerKirkels\RDW_Client;

use RutgerKirkels\RDW_Client\Models\Car;
use RutgerKirkels\RDW_Client\Repositories\KentekenRepository;

/**
 * Class Client
 * @package RutgerKirkels\RDW_Client
 * @author Rutger Kirkels <rutger@kirkels.nl>
 * @license MIT
 */
class Client
{
    /**
     * @var string
     */
    protected $appToken;

    /**
     * Client constructor.
     * @param string $appToken
     */
    public function __construct(string $appToken = '')
    {
        $this->appToken = $appToken;
    }

    /**
     * @param string $licensePlateNumber
     * @return null|Car If no match was found, NULL is returned.
     * @throws \Exception
     */
    public function findCarByLicensePlateNumber(string $licensePlateNumber) : ?Car
    {
        $kentekenRepository = new KentekenRepository('', $this->appToken);
        $result = $kentekenRepository->findOneBy('kenteken', $this->filterLicensePlateNumber($licensePlateNumber));

        if (!is_object($result)) {
            return null;
        }

        return new Car($result);
    }

    /**
     * Filters out all characters except upper case characters en digits.
     * @param string $licensePlatNumber
     * @return string
     */
    protected function filterLicensePlateNumber(string $licensePlatNumber) : string
    {
        return preg_replace('/[^A-Z0-9]/', '', strtoupper($licensePlatNumber));
    }

}