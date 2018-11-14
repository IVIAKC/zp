<?php

namespace App\Providers;


use App\Entity\Vacancy;
use App\Providers\remote\Client;
use App\Providers\remote\Request;

/**
 * Class VacancyProvider
 * @package App\Providers
 */
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
            'fields' => ['rubrics', 'position_dictionary', 'id'],
        ];

        $request = new Request('vacancies', $params);

        $response = $this->client->send($request);

        $vacancy = [];
        foreach ($response->getBody() as $item) {
            $vacancy[] = new Vacancy($item['rubrics'], $item['position_dictionary']);
        }

        return $vacancy;
    }
}
