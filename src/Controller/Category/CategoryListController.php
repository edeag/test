php
<?php

namespace srcControllerCategory;

use srcControllerViewController;
use srcServiceCategory\CategorySearcherService;

final class CategoryListController extends ViewController
{
    private CategorySearcherService $categorySearcherService;

    public function __construct(CategorySearcherService $categorySearcherService)
    {
        $this->categorySearcherService = $categorySearcherService;
    }

    public function start(): void
    {
        $categories = $this->categorySearcherService->search();

        $this->callView('Category/list', [
            'categories' => $categories,
        ]);
    }
}