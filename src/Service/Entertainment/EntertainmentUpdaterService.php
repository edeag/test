php
<?php

namespace srcServiceEntertainment;

use srcModelEntertainment\EntertainmentModel;
use srcEntityEntertainment\Entertainment;
use srcEntityEntertainment\Exception\EntertainmentNotFoundException;

final class EntertainmentUpdaterService
{
    private EntertainmentModel $entertainmentModel;

    public function __construct(EntertainmentModel $entertainmentModel)
    {
        $this->entertainmentModel = $entertainmentModel;
    }

    public function update(int $id, array $data): Entertainment
    {
        $entertainment = $this->entertainmentModel->find($id);

        if ($entertainment === null) {
            throw new EntertainmentNotFoundException($id);
        }

        // Assuming the model has an update method that takes the ID and data
        // You will need to implement the update logic in EntertainmentModel
        $updatedEntertainment = $this->entertainmentModel->update($id, $data);

        return $updatedEntertainment;
    }
}