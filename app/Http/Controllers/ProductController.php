<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Standard;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|\Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Product/Index',[
            'products'=>Product::with('department:id,name','standard:id,name,code','productType:id,name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Product/Create',[
            'departments'=> Department::where('is_production',1)->get(),
            'standards'=>Standard::where('standard_type',0)->get(),
            'productTypes' => ProductType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $attributes['product_type'] = $request->product_type['id'];
        isset($request->department_id) ? $attributes['department_id'] = $request->department_id['id'] : $attributes['department_id'] = null;
        $attributes['is_certified'] = $request->is_certified['value'];
        isset($request->standard_id) ? $attributes['standard_id'] = $request->standard_id['id'] : $attributes['standard_id'] = null;
        $attributes['standard_id'] = $request->standard_id['id'];
        $attributes['creator_id'] = Auth::id();
        Product::create($attributes);

        return redirect()->back()
            ->with('message', 'Post Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function destroy($id)
    {
        //
    }
}
