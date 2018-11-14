<?php

namespace App\Providers;


use App\Entity\Client;
use App\Entity\Vacancy;

class VacancyProvider
{
    /** @var Client $client */
    protected $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function get()
    {
        $params = [
            'geo_id' => '826',
            'period' => 'today',
            'fields' => ['rubrics', 'position_dictionary', 'header', 'id'],
        ];
        $request = new \App\Entity\Request('vacancies', $params);

        $response = $this->client->send($request);

        $vacancy = [];
        $body = $response->getBody();
        foreach ($body as $item) {
            $vacancy[] = new Vacancy($item['id'], $item['rubrics'], $item['position_dictionary']);
        }

        return $vacancy;
    }
}
