php
<?php

namespace srcServiceCategory;

use srcModelCategory\CategoryModel;
use srcEntityCategory\Category;

final class CategoryCreatorService
{
    private CategoryModel $categoryModel;

    public function __construct(CategoryModel $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function create(array $categoryData): Category
    {
        // TODO: Implement data validation before creating
        $categoryId = $this->categoryModel->create($categoryData);

        // TODO: Fetch and return the newly created Category entity
        // For now, returning a dummy Category entity
        return new Category(
            $categoryId,
            $categoryData['nombre'] ?? '' // Assuming 'nombre' is the field for category name
        );
    }
}