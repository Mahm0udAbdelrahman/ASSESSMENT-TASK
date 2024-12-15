<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{

    public function __construct(public Category $model){}


    public function index()
    {

        return $this->model->paginate();
    }

    public function store(array $data)
    {
        $category = $this->model->create($data);
        return $category;
    }

    public function show($id)
    {
        $category = $this->model->findOrFail($id);
        return $category;
    }

    public function update($id , array $data)
    {

        $category = $this->show($id);
        $category->update($data);
        return $category;
    }

    public function destroy($id)
    {
        $category = $this->show($id);
        $category->delete();
    }



}
