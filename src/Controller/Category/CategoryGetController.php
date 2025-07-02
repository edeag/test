php
<?php

namespace srcControllerCategory;

use srcControllerViewController;
use srcServiceCategoryCategoryFinderService;
use srcEntityCategoryCategory;
use srcEntityCategoryExceptionCategoryNotFoundException;

final readonly class CategoryGetController extends ViewController
{
    private CategoryFinderService $categoryFinderService;

    public function __construct(CategoryFinderService $categoryFinderService)
    {
        $this->categoryFinderService = $categoryFinderService;
    }

    public function start(int $id): void
    {
        try {
            $category = $this->categoryFinderService->find($id);
            parent::call("Category/detail", ['category' => $category]);
        } catch (CategoryNotFoundException $e) {
            // Handle the case where the category is not found
            // You might want to render a specific error view or display a message
            echo "Error: " . $e->getMessage();
            // Or render an error view:
            // parent::call("Error/not_found", ['message' => $e->getMessage()]);
        }
    }
}