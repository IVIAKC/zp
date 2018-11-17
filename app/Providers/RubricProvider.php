<?php

namespace App\Providers;


use App\Entity\Rubric;
use App\Providers\remote\Client;
use App\Providers\remote\Request;

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
     * @return array|Rubric[]
     */
    public function get(): array
    {
        $request = new Request('rubrics', []);

        $response = $this->client->send($request);

        $rubrics = [];
        foreach ($response->getBody() as $item) {
            $rubrics[$item['id']] = new Rubric($item['title']);
        }

        return $rubrics;
    }
}
