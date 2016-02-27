<?php namespace Omashu\Http\Controllers\Admin;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Omashu\Http\Requests\CategoryFormRequest;
use Omashu\Stock\Brand;
use Omashu\Stock\Category;

class CategoriesController extends Controller {

    public function create($brandId)
    {
        $brand = Brand::findOrFail($brandId);
        $category = new Category();
        return view('admin.categories.create')->with(compact('brand', 'category'));
	}

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with('products')->first();

        return view('admin.categories.show')->with(compact('category'));
    }

    public function store(CategoryFormRequest $request, $brandId)
    {
        $brand = Brand::findOrFail($brandId);
        $brand->addCategory($request->all());
        flash()->message('New category created. Diversity is great!');
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
        flash()->message('Category updated. Keeping a tight ship, I respect that.');
        return redirect()->to('admin/categories/'.$category->slug);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        flash()->message('Category deleted. All that once was is but memories now.');
        return redirect()->to('admin/brands');
    }

    public function setCoverPic(Request $request, $categoryId)
    {
        $this->validate($request, ['file' => 'required|image']);
        $category = Category::findOrFail($categoryId);
        $category->setCoverPic($request->file('file'));

        return response()->json('ok');
    }    


}
