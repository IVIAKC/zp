<?php

namespace App\Providers;

use App\Entity\Vacancy;
use App\Providers\remote\Request;
use App\Providers\remote\ZPClient;

class VacancyProvider
{
    /** @var ZPClient  */
    private $client;

    private const PARAMS_REQUEST = [
        'geo_id' => 826,
        'period' => 'today',
        'fields' => ['id', 'rubrics', 'position_dictionary'],
    ];

    public function __construct(ZPClient $client = null)
    {
        $this->client = $client ?? new ZPClient();
    }

    public function get(): array
    {
        $response = $this->client->send(new Request('vacancies', self::PARAMS_REQUEST));

        /** @var Vacancy[] $vacancies */
        $vacancies = [];
        foreach ($response->getBody() as $item) {
            $vacancies[] = new Vacancy($item['rubrics'], $item['position_dictionary']);
        }

        return $vacancies;
    }
}
