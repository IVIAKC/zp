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

    public function getPopularPosition()
    {
        //Боже мой что я наделал...
        $vacancy = $this->vacancyProvider->get();
        $position = [];
        foreach ($vacancy as $item) {
            $word = $item->getWord();
            if (isset($word['id'])) {
                if (!isset($position[$word['id']])) {
                    $position[$word['id']] = ['title' => $word['title'], 'count' => 1];
                }else{
                    $position[$word['id']]['count'] += 1;
                }
            }
        }


        usort($position, function ($first, $last) {
            return $first['count'] < $last['count'];
        });


        return $position;
    }

    /**
     * @param Vacancy[]|array|null $vacancy
     * @return array
     */
    public function getPopularRubric()
    {
        $rubric = $this->rubricProvider->get();

        $vacancy = $this->vacancyProvider->get();


        //TODO Пересмотреть и выдернуть.
        /** @var Vacancy $item */
        foreach ($vacancy as $item) {
            foreach ($item->getRubrics() as $item) {
                $rubric[$item['id']]->appendCount();
            }
        }

        usort($rubric, function ($first, $last) {
            return $first->getCount() < $last->getCount();
        });

        return $rubric;
    }
}