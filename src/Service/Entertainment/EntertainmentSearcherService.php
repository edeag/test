php
<?php

namespace srcServiceEntertainment;

use srcModelEntertainment\EntertainmentModel;
use srcEntityEntertainment\Entertainment;

final class EntertainmentSearcherService
{
    private EntertainmentModel $entertainmentModel;

    public function __construct(EntertainmentModel $entertainmentModel)
    {
        $this->entertainmentModel = $entertainmentModel;
    }

    /**
     * Searches for entertainment records based on optional criteria.
     *
     * @param array $criteria Optional criteria for searching.
     * @return Entertainment[] An array of Entertainment entities.
     */
    public function search(array $criteria = []): array
    {
        // The model's search method would handle translating criteria to SQL
        // and returning primitive data. This service transforms primitives to entities.
        $primitiveResults = $this->entertainmentModel->search($criteria);

        $entities = [];
        foreach ($primitiveResults as $primitive) {
            $entities[] = $this->entertainmentModel->toEntity($primitive);
        }

        return $entities;
    }
}