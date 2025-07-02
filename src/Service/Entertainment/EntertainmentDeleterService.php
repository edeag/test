php
<?php

namespace srcServiceEntertainment;

use srcModelEntertainment\EntertainmentModel;
use srcEntityEntertainment\Exception\EntertainmentNotFoundException;

final class EntertainmentDeleterService
{
    private EntertainmentModel $entertainmentModel;

    public function __construct(EntertainmentModel $entertainmentModel)
    {
        $this->entertainmentModel = $entertainmentModel;
    }

    public function delete(int $entertainmentId): void
    {
        $entertainment = $this->entertainmentModel->find($entertainmentId);

        if ($entertainment === null) {
            throw new EntertainmentNotFoundException($entertainmentId);
        }

        $this->entertainmentModel->delete($entertainmentId);
    }
}