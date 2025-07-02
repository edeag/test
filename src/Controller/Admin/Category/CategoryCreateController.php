php
<?php

namespace srcControllerAdminCategory;

use srcControllerViewController;
use srcServiceCategoryCategoryCreatorService;

final class CategoryCreateController extends ViewController
{
    private CategoryCreatorService $categoryCreatorService;

    public function __construct(CategoryCreatorService $categoryCreatorService)
    {
        parent::__construct();
        $this->categoryCreatorService = $categoryCreatorService;
    }

    public function start(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle POST request - process form submission
            $categoryData = [
                'nombre' => $_POST['nombre'] ?? '',
                // Add other category fields as needed
            ];

            // Basic validation (more robust validation should be in Services)
            if (!empty($categoryData['nombre'])) {
                try {
                    $this->categoryCreatorService->create($categoryData);
                    // Redirect to category list page on success
                    header('Location: /admin/categories');
                    exit();
                } catch (\Exception $e) {
                    // Handle creation errors
                    $this->render('admin/category/create_form', ['error' => 'Error creating category: ' . $e->getMessage()]);
                }
            } else {
                // Handle validation errors
                $this->render('admin/category/create_form', ['error' => 'Category name cannot be empty']);
            }
        } else {
            // Handle GET request - display the creation form
            $this->render('admin/category/create_form');
        }
    }
}