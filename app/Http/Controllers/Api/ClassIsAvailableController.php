<?php

namespace App\Http\Controllers\Api;

use App\ClassIsAvailable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ClassIsAvailableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_is_available = ClassIsAvailable::all();

        return response()->json($class_is_available);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class_is_available = new ClassIsAvailable();
        $class_is_available->teacher_id = $request->get('teacher_id');
        $class_is_available->class_id = $request->get('class_id');
        $class_is_available->start_time = $request->get('start_time');
        $class_is_available->end_time = $request->get('end_time');

        $class_is_available->save();

        return $class_is_available;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class_is_available = ClassIsAvailable::find($id);
        $class_is_available->delete();
    }
}
