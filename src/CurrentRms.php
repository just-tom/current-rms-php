<?php

namespace CurrentRms;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;

class CurrentRms
{
    const POST = 'POST';
    const GET = 'GET';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    protected $client;
    protected $config;
    protected $logger;

    public function __construct()
    {
    }

    public function initClient()
    {
        $this->client = new Client([
            $this->getConfigurationValues(),
            'handler'  => $this->createLoggingHandlerStack('RESPONSE: {code} - {res_body}')
        ]);
    }

    public function getConfigurationValues()
    {
        return $this->config;
    }

    public function setConfigurationValues(array $values)
    {
        $this->config = $values;
    }

    public function call(Uri $uri, array $params, $method = CurrentRms::GET)
    {
        if (!$this->client) {
            $this->initClient();
        }

        $params['http_errors'] = false;

        return $this->client->request($method, $uri, $params);
    }

    private function getLogger()
    {
        if (!$this->logger) {
            $this->logger = new \Monolog\Logger('api-consumer');
            $this->logger->pushHandler(
                new \Monolog\Handler\StreamHandler('logs/api-consumer.log')
            );
        }

        return $this->logger;
    }

    private function createGuzzleLoggingMiddleware($messageFormat)
    {
        return \GuzzleHttp\Middleware::log(
            $this->getLogger(),
            new \GuzzleHttp\MessageFormatter($messageFormat)
        );
    }

    private function createLoggingHandlerStack($messageFormat)
    {
        $handlerStack = \GuzzleHttp\HandlerStack::create();

        $handlerStack->push(
            $this->createGuzzleLoggingMiddleware($messageFormat)
        );

        return $handlerStack;
    }

}
