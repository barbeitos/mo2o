<?php

namespace App\Domain;

use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\build_query;

class RecipeClient
{
    private $base_uri = "http://www.recipepuppy.com/api/?";

    private $client = null;

    /**
     * RecipeClient constructor.
     * @param null $client
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->getBaseUri(),
            'timeout'  => 2.0,
        ]);
    }


    public function launchClient(){
        $response = $this->getClient()->request('GET', '?i=onions,garlic&q=omelet&p=3 ');
        return $response;
    }

    public function request(string $search, string $tags, int $page)
    {
        $response = $this->getClient()->request(
            "GET",
            $this->constructQueryUri($search, $tags, $page)
        );

        return $response->getBody()->getContents();
    }

    public function constructQueryUri(string $search, string $tags, int $page){
        $array = array(
            'q' => $search,
            'i' => $tags,
            'p' => $page
        );

        return $this->getBaseUri().build_query($array);
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->base_uri;
    }/**
     * @param string $base_uri
     */
    public function setBaseUri(string $base_uri): void
    {
        $this->base_uri = $base_uri;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }



}