php
<?php

namespace srcServiceEntertainment;

use srcModelEntertainment\EntertainmentModel;
use srcEntityEntertainment\Entertainment;

final class EntertainmentCreatorService
{
    private EntertainmentModel $entertainmentModel;

    public function __construct(EntertainmentModel $entertainmentModel)
    {
        $this->entertainmentModel = $entertainmentModel;
    }

    public function create(array $entertainmentData): Entertainment
    {
        // This is a placeholder. The actual creation logic in the model
        // would need to handle inserting data and returning the created entity,
        // potentially by finding it after insertion or having the insert method
        // return the entity directly.
        // For now, let's assume the model has a method that returns the entity after creation.
        // You would also likely need validation of $entertainmentData here in a real application.

        $createdEntertainment = $this->entertainmentModel->create($entertainmentData);

        // Assuming create method in model returns the created Entertainment entity
        return $createdEntertainment;
    }
}