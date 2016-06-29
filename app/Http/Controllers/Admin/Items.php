<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Calculator;
use App\Platform;
use App\Item;

class Items extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($calculatorSlug)
  { 
    $calculator = Calculator::findBySlug($calculatorSlug);

    return view('site.admin.calculator.items.create')->with([
      'calculator' => $calculator
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $calculatorSlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);

    $item = new Item($request->all());

    if ($item->save()) {
      $platforms = $request->input('platforms');

      $arr_prices = [];
      foreach ($platforms as $slug => $price) {
        $platform = Platform::findBySlug($slug);

        $arr_prices[$platform->id] = [
          'price' => $price
        ];
      }
      if ($item->platforms()->sync($arr_prices)) {
        return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
      }
    }
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
  public function update(Request $request, $calculatorSlug, $itemSlug)
  {

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }
}
