php
<?php

namespace srcControllerAdminCategory;

use srcControllerViewController;
use srcServiceCategoryCategoryFinderService;
use srcServiceCategoryCategoryUpdaterService;
use srcEntityCategoryCategory;
use srcEntityCategoryExceptionCategoryNotFoundException;

final class CategoryUpdateController extends ViewController
{
    private CategoryFinderService $categoryFinderService;
    private CategoryUpdaterService $categoryUpdaterService;

    public function __construct(CategoryFinderService $categoryFinderService, CategoryUpdaterService $categoryUpdaterService)
    {
        $this->categoryFinderService = $categoryFinderService;
        $this->categoryUpdaterService = $categoryUpdaterService;
    }

    public function start(int $id): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Handle POST request for updating a category
                $data = [
                    'nombre' => $_POST['nombre'] ?? null,
                    // Add other category fields here
                ];

                // Basic validation (more comprehensive validation should be in Services)
                if (empty($data['nombre'])) {
                    // Handle validation error, e.g., display error message on the form
                    $category = $this->categoryFinderService->find($id);
                    $this->call('admin/category/update_form', ['category' => $category, 'error' => 'Category name cannot be empty.']);
                    return;
                }

                $updatedCategory = $this->categoryUpdaterService->update($id, $data);

                // Redirect to category list or detail page
                header('Location: /admin/categories');
                exit();

            } else {
                // Handle GET request for displaying the update form
                $category = $this->categoryFinderService->find($id);
                $this->call('admin/category/update_form', ['category' => $category]);
            }
        } catch (CategoryNotFoundException $e) {
            // Handle not found exception, e.g., show a 404 page or error message
            $this->call('error/404', ['message' => $e->getMessage()]); // Assuming an error view exists
        } catch (\Exception $e) {
            // Handle other potential exceptions
            $this->call('error/general', ['message' => 'An error occurred while updating the category.']); // Assuming a general error view exists
        }
    }
}