<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Services\CategoryService;


class CategoryController extends Controller
{

    public function __construct(public CategoryService $categoryService){}
    public function index()
    {
      $categories = $this->categoryService->index();
      return view('admin.dashboard.categories.index' , compact('categories'));
    }


    public function create()
    {

        return view('admin.dashboard.categories.create');
    }


    public function store(CategoryRequest $request)
    {
      $this->categoryService->store($request->validated());
      return redirect()->route('category.index');

    }


    public function show(string $id)
    {
        $category =  $this->categoryService->show($id);
        return view('admin.dashboard.categories.show',compact('category'));
    }


    public function edit(string $id)
    {
        $category =  $this->categoryService->show($id);
        return view('admin.dashboard.categories.edit',compact('category'));
    }

    public function update(CategoryRequest $request, string $id)
    {
        $this->categoryService->update($id ,$request->validated());
        return redirect()->route('category.index');
    }


    public function destroy($id)
    {
        $this->categoryService->destroy($id);
        return redirect()->route('category.index');
    }
}
