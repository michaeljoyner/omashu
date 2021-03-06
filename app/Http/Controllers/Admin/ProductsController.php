<?php namespace Omashu\Http\Controllers\Admin;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Omashu\Http\Requests\ProductFormRequest;
use Omashu\Stock\Category;
use Omashu\Stock\Product;

class ProductsController extends Controller {

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('admin.products.show')->with(compact('product'));
    }

    public function create($category_id)
    {
        $category = Category::findOrFail($category_id);
        $product = new Product();

        return view('admin.products.create')->with(compact('product', 'category'));
	}

    public function store(ProductFormRequest $request, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->addProduct($request->all());
        flash()->message('New product added. I\'m holding thumbs.');
        return redirect()->to('admin/categories/'.$category->slug);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit')->with(compact('product'));
    }

    public function update(ProductFormRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        flash()->message('Product updated. Keeping things fresh is important');
        return redirect()->to('admin/products/'.$product->slug);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        flash()->message('Product completely eliminated. I have rubbed it from this good earth.');
        return redirect()->to('admin/brands');
    }

    public function setCoverPic(Request $request, $productId)
    {
        $this->validate($request, ['file' => 'required|image']);
        $product = Product::findOrFail($productId);
        $product->setCoverPic($request->file('file'));

        return response()->json('ok');

    }

    public function setAvailability(Request $request, $productId)
    {
        $this->validate($request, ['available' => 'required|boolean']);

        $result = Product::findOrFail($productId)->setAvailability($request->available);

        return response()->json(['new_state' => $result]);

    }



}
