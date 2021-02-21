<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::all();

        if(!$course) {
            return response()->json([
                'message'   => 'None record found',
            ], 404);
        }

        return response()->json($course, 201);
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
        $course = new Course();

        $course->fill($request->all());
        $course->save();

        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);

            $course->fill($request->all());
            $course->save();

            return response()->json($course);
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if(!$course) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $course->delete();
    }

    public function fetch($date)
    {
        //Get csv of the currencies of the day consulted
        $csv = file_get_contents("https://www4.bcb.gov.br/Download/fechamento/{$date}.csv");

        // search and replace , to .
        $newCsv = str_replace(",", ".", $csv);
        // read csv with delimiter by ;
        $rows = explode(";", $newCsv);
        $explodedCSV = array();

        // create array by csv
        foreach ($rows as $row) {
            $explodedCSV[] = str_getcsv($row);
        }

        // get values courses
        $response = Http::get('https://exports.allyhub.co/');
        $courseValue = json_decode($response, true);


        // constants values coins
        $USD = 0;
        $AUD  = 0;
        $EUR = 0;
        for ($j = 0; $j <= sizeof($explodedCSV);$j++) {
            if ($explodedCSV[$j][0] == "USD") {
                $USD = $explodedCSV[$j + 1][0];
                break;
            }
        }
        for ($j = 0; $j <= sizeof($explodedCSV);$j++) {
            if ($explodedCSV[$j][0] == "AUD") {
                $AUD = $explodedCSV[$j + 1][0];
                break;
            }
        }
        for ($j = 0; $j <= sizeof($explodedCSV);$j++) {
            if ($explodedCSV[$j][0] == "EUR") {
                $EUR = $explodedCSV[$j + 1][0];
                break;
            }
        }

        $test = $courseValue;

        foreach ($courseValue as $key => $course) {
            if ($course["USD"]) {
                $totalUSD = $course["USD"];
                $totalBRL = $totalUSD * $USD;

                $totalAUD = $totalBRL / $AUD;
                $totalEUR = $totalBRL / $EUR;

                $courseValue[$key]["BRL"] = floatval(number_format($totalBRL, 2, '.', ''));
                $courseValue[$key]["AUD"] = floatval(number_format($totalAUD, 2, '.', ''));
                $courseValue[$key]["EUR"] = floatval(number_format($totalEUR, 2, '.', ''));

            }
            if ($course["AUD"]) {
                $totalAUD = $course["AUD"];
                $totalBRL = $totalAUD * $AUD;

                $totalUSD = $totalBRL / $USD;
                $totalEUR = $totalBRL / $EUR;

                $courseValue[$key]["BRL"] = floatval(number_format($totalBRL, 2, '.', ''));
                $courseValue[$key]["USD"] = floatval(number_format($totalUSD, 2, '.', ''));
                $courseValue[$key]["EUR"] = floatval(number_format($totalEUR, 2, '.', ''));

            }
            if ($course["EUR"]) {
                $totalEUR = $course["EUR"];
                $totalBRL = $totalEUR * $EUR;

                $totalAUD = $totalBRL / $AUD;
                $totalUSD = $totalBRL / $USD;

                $courseValue[$key]["BRL"] = floatval(number_format($totalBRL, 2, '.', ''));
                $courseValue[$key]["AUD"] = floatval(number_format($totalAUD, 2, '.', ''));
                $courseValue[$key]["USD"] = floatval(number_format($totalUSD, 2, '.', ''));

            }
            if ($course["BRL"]) {
                $totalBRL = $course["BRL"];

                $totalAUD = $totalBRL / $AUD;
                $totalUSD = $totalBRL / $USD;
                $totalEUR = $totalBRL / $EUR;


                $courseValue[$key]["EUR"] = floatval(number_format($totalEUR, 2, '.', ''));
                $courseValue[$key]["AUD"] = floatval(number_format($totalAUD, 2, '.', ''));
                $courseValue[$key]["USD"] = floatval(number_format($totalUSD, 2, '.', ''));

            }
        }

        return response()->json($courseValue);

    }

}
