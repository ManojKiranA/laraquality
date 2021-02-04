<?php

namespace App\Http\Controllers;

use App\Models\ComplaintType;
use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComplaintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Complaint/ComplaintType/Index',[
            'complaintTypes' => ComplaintType::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Complaint/ComplaintType/Create',[
            'departments'=>Department::where('is_complaint',1)->get(['id','name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintType $complaintType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintType $complaintType)
    {
        //
    }
}
