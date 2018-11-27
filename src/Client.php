<?php

namespace RutgerKirkels\RDW_Client;


use RutgerKirkels\RDW_Client\Models\Car;
use RutgerKirkels\RDW_Client\Models\Kenteken;
use RutgerKirkels\RDW_Client\Repositories\KentekenRepository;

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
    public function __construct(string $appToken)
    {
        $this->appToken = $appToken;
    }

    /**
     * @param string $licensePlateNumber
     * @return Kenteken
     * @throws \Exception
     */
    public function findCarByLicensePlateNumber(string $licensePlateNumber) : ?Car
    {
        $kentekenRepository = new KentekenRepository();
        $result = $kentekenRepository->findOneBy('kenteken', $this->filterLicensePlateNumber($licensePlateNumber));

        if (!is_object($result)) {
            return null;
        }

        return new Car($result);
    }

    protected function filterLicensePlateNumber(string $licensePlatNumber) : string
    {
        return preg_replace('/[^A-Z0-9]/', '', strtoupper($licensePlatNumber));
    }

}