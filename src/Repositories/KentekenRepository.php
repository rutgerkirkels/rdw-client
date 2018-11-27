<?php

namespace RutgerKirkels\RDW_Client\Repositories;

use GuzzleHttp\Exception\RequestException;
use RutgerKirkels\RDW_Client\Models\Kenteken;

/**
 * Class KentekenRepository
 * @package RutgerKirkels\RDW_Client\Repositories
 * @author Rutger Kirkels <rutger@kirkels.nl>
 * @license MIT
 */
class KentekenRepository extends AbstractRepository
{
    /**
     * KentekenRepository constructor.
     */
    public function __construct()
    {
        $this->apiUrl = 'https://opendata.rdw.nl/resource/m9d7-ebf2.json';
        parent::__construct();
    }

    /**
     * @param $query
     * @return array|Kenteken
     * @throws \Exception
     */
    public function find($query)
    {
        try {
            $request = $this->client->get('', array(
                'query' => $query,
                'headers' => array(
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                )
            ));
        } catch (RequestException $e) {
            throw new \Exception($e->getMessage());
        }
        $response = $request->getBody();
        $results = json_decode($response);
        $kentekens = [];
        $countResults = count($results);
        foreach ($results as $result) {
            $kenteken = new Kenteken($result);
            if ($countResults > 1) {
                $kentekens[] = $kenteken;
            } else {
                return $kenteken;
            }
        }

        return $kentekens;
    }
}