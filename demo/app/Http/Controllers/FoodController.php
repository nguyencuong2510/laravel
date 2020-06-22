<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\food;
use App\Http\Controllers\DB;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = food::all();
        return view("index", ["foods"=> $foods]);
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
        $datas = $request->all();
        $name = $datas['dish'];
        $res = $datas['restaurant'];
        $price = $datas['price'];

        $currentData = new food;
        $currentData->name = $name;
        $currentData->res = $res;
        $currentData->price = $price;
        $currentData->save();

        return redirect()->route('food.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return food::find($id);
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
        $datas = $request->all();
        $name = $datas['dish'];
        $res = $datas['restaurant'];
        $price = $datas['price'];
        
        $currentData = food::find($id);
        $currentData->name = $name;
        $currentData->res = $res;
        $currentData->price = $price;
        $currentData->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentData = food::find($id);
        $currentData->delete();
    }

    public function getRandom()
    {
        return food::all()->random(1);
    }
}
