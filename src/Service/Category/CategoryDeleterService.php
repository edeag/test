php
<?php

namespace srcServiceCategory;

use srcModelCategory\CategoryModel;
use srcEntityCategory\Exception\CategoryNotFoundException;

final class CategoryDeleterService
{
    private CategoryModel $categoryModel;

    public function __construct(CategoryModel $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function delete(int $id): void
    {
        $category = $this->categoryModel->find($id);

        if ($category === null) {
            throw new CategoryNotFoundException($id);
        }

        // Assuming CategoryModel has a delete method
        // $this->categoryModel->delete($id); 
        // You will need to implement this in CategoryModel
    }
}