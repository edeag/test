php
<?php

namespace srcControllerAdminCategory;

use srcControllerViewController;
use srcServiceCategory\CategoryDeleterService;
use srcEntityCategory\Exception\CategoryNotFoundException;

final class CategoryDeleteController extends ViewController
{
    private CategoryDeleterService $categoryDeleterService;

    public function __construct(CategoryDeleterService $categoryDeleterService)
    {
        parent::__construct();
        $this->categoryDeleterService = $categoryDeleterService;
    }

    public function start(int $id): void
    {
        try {
            $this->categoryDeleterService->delete($id);
            // Redirect to category list on success
            header('Location: /admin/categories');
            exit();
        } catch (CategoryNotFoundException $e) {
            // Handle category not found, perhaps show an error page
            $this->call('error.php', ['message' => $e->getMessage()]);
        } catch (\Exception $e) {
            // Handle other potential exceptions during deletion
            $this->call('error.php', ['message' => 'An error occurred while deleting the category.']);
        }
    }
}