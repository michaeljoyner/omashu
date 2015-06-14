<?php namespace Omashu\Http\Controllers\Admin;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Omashu\Http\Requests\ImageUploadRequest;
use Omashu\Services\BrandImageStorer;
use Omashu\Services\CategoryImageStorer;
use Omashu\Services\FileStorer;
use Omashu\Services\ProductImageStorer;
use Omashu\Services\StockistImageStorer;

class AjaxUploadController extends Controller {

    public function storeBrandImage(ImageUploadRequest $request, BrandImageStorer $fileStorer)
    {
        $name = $fileStorer->storeImage($request->file('file'));

        return response()->json($name);
	}

    public function storeCategoryImage(ImageUploadRequest $request, CategoryImageStorer $fileStorer)
    {
        $name = $fileStorer->storeImage($request->file('file'));

        return response()->json($name);
    }

    public function storeProductImage(ImageUploadRequest $request, ProductImageStorer $fileStorer)
    {
        $name = $fileStorer->storeImage($request->file('file'));

        return response()->json($name);
    }

    public function storeStockistImage(ImageUploadRequest $request, StockistImageStorer $fileStorer)
    {
        $name = $fileStorer->storeImage($request->file('file'));

        return response()->json($name);
    }

}
