<?php namespace Omashu\Http\Controllers\Admin;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Omashu\Http\Requests\CategoryFormRequest;
use Omashu\Stock\Brand;
use Omashu\Stock\Category;

class CategoriesController extends Controller {

    public function create($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $category = new Category();
        return view('admin.categories.create')->with(compact('brand', 'category'));
	}

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with('products')->first();

        return view('admin.categories.show')->with(compact('category'));
    }

    public function store(CategoryFormRequest $request, $brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $brand->categories()->create($request->all());

        return redirect()->to('admin/brands/'.$brand->slug);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(CategoryFormRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->to('admin/categories/'.$category->slug);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->to('admin/brands');
    }

}
