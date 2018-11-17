<?php

namespace App;


use App\Entity\TableRow;
use App\Entity\Vacancy;
use App\Interfaces\TableRow as TableRowInterface;
use App\Providers\RubricProvider;
use App\Providers\VacancyProvider;

/**
 * Class Manager
 * @package App
 */
class Manager
{
    /** @var VacancyProvider */
    protected $vacancyProvider;
    /** @var RubricProvider */
    protected $rubricProvider;
    /** @var array|null|Vacancy[] $vacancy */
    protected $vacancy;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        $this->rubricProvider = new RubricProvider();
        $this->vacancyProvider = new VacancyProvider();
    }

    /**
     * @return array|TableRow[]
     */
    public function getPopularPosition(): array
    {
        $result = [];
        foreach ($this->getVacancy() as $item) {

            if (!$position = $item->getPosition()) {
                continue;
            }

            if (!isset($result[$position['id']])) {
                $result[$position['id']] = new TableRow($position['title'], 1);
            } else {
                $result[$position['id']]->increaseCount();
            }
        }

        $this->sortTableRow($result);

        return $result;
    }

    /**
     * @return array|Vacancy[]
     */
    protected function getVacancy(): array
    {

        if ($this->vacancy === null) {
            $this->vacancy = $this->vacancyProvider->get();
        }

        return $this->vacancy;
    }

    /**
     * @param array|TableRowInterface[] $array
     */
    protected function sortTableRow(array &$array): void
    {
        usort($array, function (TableRowInterface $first, TableRowInterface $last) {
            return $first->getCount() < $last->getCount();
        });
    }

    /**
     * @return array|TableRow[]
     */
    public function getPopularRubric(): array
    {
        $result = [];
        foreach ($this->rubricProvider->get() as $key => $item){
            $result[$key] = new TableRow($item->getName());
        }

        /** @var Vacancy $vacancy */
        foreach ($this->getVacancy() as $vacancy) {
            foreach ($vacancy->getRubrics() as $rubric) {
                $result[$rubric['id']]->increaseCount();
            }
        }

        $this->sortTableRow($result);

        return $result;
    }
}
