<?php namespace Omashu\Http\Controllers\Admin;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Omashu\Http\Requests\BrandFormRequest;
use Omashu\Stock\Brand;

class BrandsController extends Controller {

    public function index()
    {
        $brands = Brand::all();

        return view('admin.brands.index')->with(compact('brands'));
	}

    public function show($slug)
    {
        $brand = Brand::where('slug', $slug)->with('categories')->first();

        return view('admin.brands.show')->with(compact('brand'));
    }

    public function create()
    {
        $brand = new Brand();
        return view('admin.brands.create')->with(compact('brand'));
    }

    public function store(BrandFormRequest $request)
    {
        Brand::create($request->all());
        flash()->message('New brand added! You\'re killing it!');
        return redirect()->to('admin/brands');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit')->with(compact('brand'));
    }

    public function update(BrandFormRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update($request->all());
        flash()->message('Brand updated successfully. Good work soldier.');
        return redirect()->to('admin/brands');
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        flash()->message('That brand is gone. Nothing lasts forever. Nothing.');
        return redirect()->to('admin/brands');
    }

    public function setCoverPic(Request $request, $brandId)
    {
        $this->validate($request, ['file' => 'required|image']);
        $brand = Brand::findOrFail($brandId);
        $brand->setCoverPic($request->file('file'));

        return response()->json('ok');
    }

}
