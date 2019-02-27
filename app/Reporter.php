<?php

namespace App;

use App\Entity\TableRow;
use App\Entity\Vacancy;
use App\Providers\RubricProvider;
use App\Providers\VacancyProvider;

class Reporter
{
    /** @var VacancyProvider */
    protected $vacancyProvider;

    /** @var RubricProvider */
    protected $rubricProvider;

    /** @var null|Vacancy[] */
    protected $vacancies;

    public function __construct()
    {
        $this->rubricProvider = new RubricProvider();
        $this->vacancyProvider = new VacancyProvider();
    }

    /**
     * @return TableRow[]
     */
    public function getRowsPopularPosition(): array
    {
        /** @var TableRow[] $tableRows */
        $tableRows = [];
        foreach ($this->getVacancies() as $vacancy) {
            if (($position = $vacancy->getPosition()) === null) {
                continue;
            }

            if (isset($tableRows[$position['id']])) {
                $tableRows[$position['id']]->increaseCount();
            } else {
                $tableRows[$position['id']] = new TableRow($position['title'], 1);
            }
        }

        $this->sortTableRow($tableRows);

        return $tableRows;
    }

    /**
     * @return TableRow[]
     */
    public function getRowsPopularRubric(): array
    {
        $tableRows = [];
        foreach ($this->rubricProvider->get() as $rubricID => $rubric) {
            $tableRows[$rubricID] = new TableRow($rubric->getName());
        }

        /** @var Vacancy $vacancy */
        foreach ($this->getVacancies() as $vacancy) {
            foreach ($vacancy->getRubrics() as $rubric) {
                $tableRows[$rubric['id']]->increaseCount();
            }
        }

        $this->sortTableRow($tableRows);

        return $tableRows;
    }

    /**
     * @return Vacancy[]
     */
    protected function getVacancies(): array
    {
        return $this->vacancies ?: $this->vacancyProvider->get();
    }

    /**
     * @param TableRow[] $array
     */
    protected function sortTableRow(array &$array): void
    {
        usort($array, function (TableRow $first, TableRow $last) {
            return $first->getCount() < $last->getCount();
        });
    }
}
