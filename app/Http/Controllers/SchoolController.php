<?php

namespace App\Http\Controllers;

use App\Course;
use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = School::all();

        if(!$school) {
            return response()->json([
                'message'   => 'None record found',
            ], 404);
        }

        return response()->json($school, 201);
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
        $school = new School();

        $school->fill($request->all());
        $school->save();

        return response()->json($school, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $school = School::findOrFail($id);

            $school->fill($request->all());
            $school->save();

            return response()->json($school);
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);

        if(!$school) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $school->delete();
    }
}
