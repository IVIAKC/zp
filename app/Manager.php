<?php

namespace App;


use App\Entity\Vacancy;
use App\Provider\RubricProvider;
use App\Provider\VacancyProvider;

class Manager
{
    protected $vacancyProvider;

    protected $rubricProvider;

    public function __construct()
    {
        $this->rubricProvider = new RubricProvider();
        $this->vacancyProvider = new VacancyProvider();
    }

    public function getVacancy()
    {
        //TODO Пересмотреть

        $vacancy = $this->vacancyProvider->get();
        return $vacancy;
    }

    /**
     * @param Vacancy[]|array|null $vacancy
     * @return array
     */
    public function getRubric(?array $vacancy)
    {
        $rubric = $this->rubricProvider->get();
        if ($vacancy === null) {
            $vacancy = $this->getVacancy();
        }
        //TODO Пересмотреть и выдернуть.
        /** @var Vacancy $item */
        foreach ($vacancy as $item) {
            foreach ($item->getRubrics() as $item) {
                $rubric[$item['id']]->appendCount();
            }
        }

        return $rubric;
    }
}