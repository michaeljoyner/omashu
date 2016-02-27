<?php

namespace Omashu\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;
use Omashu\Shipping\ShippingRule;

class ShippingRulesController extends Controller
{
    public function index()
    {
        $rules = ShippingRule::all();

        return view('admin.shippingrules.index')->with(compact('rules'));
    }

    public function edit($id)
    {
        $rule = ShippingRule::findOrFail($id);

        return view('admin.shippingrules.edit')->with(compact('rule'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rate' => 'required|min:0|integer',
            'free_above' => 'required|min:0|integer'
        ]);

        $rule = ShippingRule::findOrFail($id);
        $rule->update($request->all());

        flash()->message('Shipping Policy updated! Up and at \'em');

        return redirect('admin/shippingrules');
    }
}
