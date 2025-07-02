php
<?php

namespace srcControllerEntertainment;

use srcControllerViewController;
use srcServiceEntertainmentEntertainmentSearcherService;

final class EntertainmentListController extends ViewController
{
    private EntertainmentSearcherService $entertainmentSearcherService;

    public function __construct(EntertainmentSearcherService $entertainmentSearcherService)
    {
        $this->entertainmentSearcherService = $entertainmentSearcherService;
        parent::__construct();
    }

    public function start(): void
    {
        $entertainments = $this->entertainmentSearcherService->search();

        $this->callView('Entertainment/list.php', [
            'entertainments' => $entertainments
        ]);
    }
}