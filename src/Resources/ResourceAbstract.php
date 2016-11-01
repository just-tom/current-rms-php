<?php

namespace CurrentRms\Resources;

use CurrentRms\CurrentRms;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;
use Exception;

abstract class ResourceAbstract
{
    protected $client;
    protected $response;

    public function __construct(CurrentRms $client)
    {
        $this->client = $client;
    }

    public function sendRequest($resource, array $params, $method)
    {
        $uri = new Uri($resource);
        try {
            $this->response = $this->client->call($uri, $params, $method);
        } catch (ClientException $e) {
            $this->response = $e->getResponse();
        } catch (ServerException $e) {
            $this->response = $e->getResponse();
        } catch (BadResponseException $e) {
            $this->response = $e->getResponse();
        } catch (Exception $e) {
            $this->response = $e->getMessage();
        }
}

    public function getResponse()
    {
        $contents = (string) $this->response->getBody();
        return \GuzzleHttp\json_decode($contents);
    }
}