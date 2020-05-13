<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionsOptionsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Products::paginate(10);
        return view('products/list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('products/form', ['title' => 'Create Product', 'button' => 'save', 'products' => []]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request) {
        $product_data = array('product_name' => $request->product_name);
        Products::updateOrCreate(['id' => $request->id], $product_data);
        $massge = $request->id ? 'Product Updated successfully.' : 'Product Added successfully.';
        return redirect('products')->with('success', $massge);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $products = Products::findOrFail($id);
        return view('products/form', ['products' => $products, 'title' => 'Update Product', 'button' => 'Update']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $data = Products::findOrFail($id);
        $data->is_active = !$data->is_active;
        $data->update();
        return redirect('products')->with('success', 'Product is successfully Updated');
    }

}
