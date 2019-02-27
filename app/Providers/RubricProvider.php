<?php

namespace App\Providers;

use App\Entity\Rubric;
use App\Providers\remote\ZPClient;
use App\Providers\remote\Request;

class RubricProvider
{
    protected $client;

    public function __construct(ZPClient $client = null)
    {
        $this->client = $client ?? new ZPClient();
    }

    /**
     * @return Rubric[]
     */
    public function get(): array
    {
        $response = $this->client->send(new Request('rubrics'));

        /** @var Rubric[] $rubrics */
        $rubrics = [];
        foreach ($response->getBody() as $item) {
            $rubrics[$item['id']] = new Rubric($item['title']);
        }

        return $rubrics;
    }
}
