php
<?php

namespace srcServiceCategory;

use srcModelCategory\CategoryModel;
use srcEntityCategory\Category;
use srcEntityCategory\Exception\CategoryNotFoundException;

final class CategoryFinderService
{
    private CategoryModel $categoryModel;

    public function __construct(CategoryModel $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function find(int $id): Category
    {
        $category = $this->categoryModel->find($id);

        if ($category === null) {
            throw new CategoryNotFoundException($id);
        }

        return $category;
    }
}