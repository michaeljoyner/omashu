<?php namespace Omashu\Http\Controllers\Admin;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Omashu\Http\Requests\StockistFormRequest;
use Omashu\Stock\Stockist;

class StockistsController extends Controller {

    public function index()
    {
        $stockists = Stockist::all();

        return view('admin.stockists.index')->with(compact('stockists'));
	}

    public function show($slug)
    {
        $stockist = Stockist::where('slug', $slug)->first();

        return view('admin.stockists.show')->with(compact('stockist'));
    }

    public function create()
    {
        $stockist = new Stockist();

        return view('admin.stockists.create')->with(compact('stockist'));
    }

    public function edit($id)
    {
        $stockist = Stockist::findOrFail($id);

        return view('admin.stockists.edit')->with(compact('stockist'));
    }

    public function update(StockistFormRequest $request, $id)
    {
        $stockist = Stockist::findOrFail($id);
        $stockist->update($request->all());

        return redirect()->to('admin/stockists');
    }

    public function store(StockistFormRequest $request)
    {
        Stockist::create($request->all());

        return redirect()->to('admin/stockists');
    }
}
