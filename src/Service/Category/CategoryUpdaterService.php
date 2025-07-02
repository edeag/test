php
<?php

namespace srcServiceCategory;

use srcModelCategory\CategoryModel;
use srcEntityCategory\Category;
use srcEntityCategory\Exception\CategoryNotFoundException;

final class CategoryUpdaterService
{
    private CategoryModel $categoryModel;

    public function __construct(CategoryModel $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function update(int $id, array $data): Category
    {
        $category = $this->categoryModel->find($id);

        if ($category === null) {
            throw new CategoryNotFoundException($id);
        }

        // In a real implementation, you would validate $data here
        // and then call a method on $this->categoryModel to perform the update
        // For now, we'll just return the original category for structure

        // $updatedCategory = $this->categoryModel->update($id, $data);
        // return $updatedCategory;

        // Placeholder return - replace with actual update logic
        return $category;
    }
}