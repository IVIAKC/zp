<?php

namespace App\Providers;


use App\Entity\Client;
use App\Entity\Request;
use App\Entity\Rubric;

/**
 * Class RubricProvider
 * @package App\Provider
 */
class RubricProvider
{
    /** @var Client $client */
    protected $client;

    /**
     * RubricProvider constructor.
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * @return array
     */
    public function get()
    {
        $request = new Request('rubrics', []);

        $response = $this->client->send($request);

        $rubrics = [];

        foreach ($response->getBody() as $item) {
            $rubrics[$item['id']] = new Rubric($item['title'], $item['id']);
        }

        return $rubrics;
    }
}
