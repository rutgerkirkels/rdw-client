<?php

namespace RutgerKirkels\RDW_Client;


use RutgerKirkels\RDW_Client\Repositories\KentekenRepository;

class Client
{
    /**
     * @var string
     */
    protected $appToken;

    public function __construct(string $appToken)
    {
        $this->appToken = $appToken;
    }

    public function findCarByLicensePlateNumber(string $licensePlateNumber)
    {
        $kentekenRepository = new KentekenRepository();
        $licensePlate = $kentekenRepository->findOneBy('kenteken', $licensePlateNumber);
        dd($licensePlate);
    }
}