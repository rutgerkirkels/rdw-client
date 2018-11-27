<?php

namespace RutgerKirkels\RDW_Client\Repositories;

use GuzzleHttp\Client;

/**
 * Class AbstractRepository
 * @package RutgerKirkels\RDW_Client\Repositories
 * @author Rutger Kirkels <rutger@kirkels.nl>
 * @license MIT
 */
abstract class AbstractRepository
{
    /**
     * @var string
     */
    protected $apiUrl;

    /**
     * @var string
     */
    protected $appToken;

    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client(
            array(
                'base_uri' => $this->apiUrl
            )
        );
    }

    /**
     * @param $key
     * @param $value
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function findBy($key, $value, $limit = 100, $offset = 0)
    {
        $query = array(
            '$limit' => $limit,
            '$offset' => $offset,
            $key => $value
        );
        return $this->find($query);
    }

    /**
     * @param $key
     * @param $value
     * @return array|null
     * @throws \Exception
     */
    public function findOneBy($key, $value)
    {
        return $this->findBy($key, $value, 1, 0);
    }

}