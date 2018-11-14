<?php

namespace App;


use App\Entity\TableRow;
use App\Entity\Vacancy;
use App\Interfaces\TableRow as TableRowInterface;
use App\Providers\RubricProvider;
use App\Providers\VacancyProvider;

class Manager
{
    /** @var VacancyProvider */
    protected $vacancyProvider;
    /** @var RubricProvider */
    protected $rubricProvider;
    /** @var array|null|Vacancy[] $vacancy */
    protected $vacancy;

    public function __construct()
    {
        $this->rubricProvider = new RubricProvider();
        $this->vacancyProvider = new VacancyProvider();
    }

    public function getPopularPosition()
    {
        $result = [];
        foreach ($this->getVacancy() as $item) {

            $word = $item->getPosition();

            if (!$word) {
                continue;
            }

            if ($result[$word['id']] === null) {
                $result[$word['id']] = new TableRow($word['title']);
            } else {
                $result[$word['id']]->increaseCount();
            }
        }

        $this->sortTableRow($result);

        return $result;
    }

    /**
     * @return array|Vacancy[]
     */
    protected function getVacancy()
    {

        if ($this->vacancy == null) {
            $this->vacancy = $this->vacancyProvider->get();
        }

        return $this->vacancy;
    }

    /**
     * @param array|TableRowInterface[] $array
     */
    protected function sortTableRow(array &$array)
    {
        usort($array, function (TableRowInterface $first, TableRowInterface $last) {
            return $first->getCount() < $last->getCount();
        });
    }

    /**
     * @return array
     */
    public function getPopularRubric()
    {
        $rubric = $this->rubricProvider->get();

        /** @var Vacancy $vacancy */
        foreach ($this->getVacancy() as $vacancy) {
            foreach ($vacancy->getRubrics() as $rubrics) {
                $rubric[$rubrics['id']]->increaseCount();
            }
        }

        $this->sortTableRow($rubric);

        return $rubric;
    }
}
