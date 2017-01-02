<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Calculator;
use App\Platform;
use App\Item;
use App\Icon;

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
    $icons      = Icon::orderBy('name', 'ASC');

    return view('site.admin.calculator.items.create')->with([
      'calculator'  => $calculator,
      'icons'       => $icons
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $calculatorSlug) {
    $calculator = Calculator::findBySlug($calculatorSlug);
    
    $item = new Item($request->all());

    if ($item->save()) {
      $platforms = $request->input('platforms');

      if (!empty($platforms)) {
        $arr_prices = [];

        foreach ($platforms as $slug => $price) {
          $platform = Platform::findBySlug($slug);

          $arr_prices[$platform->id] = [
            'price' => $price
          ];
        }
        $item->platforms()->sync($arr_prices);
      }
      return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
    }
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
  public function edit($calculatorSlug, $itemSlug) {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $item       = Item::findBySlug($itemSlug);
    $icons      = Icon::orderBy('name', 'ASC');

    return view('site.admin.calculator.items.edit')->with([
      'calculator'  => $calculator,
      'item'        => $item,
      'icons'       => $icons
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $calculatorSlug, $itemSlug) {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $item       = Item::findBySlug($itemSlug);

    $item->fill($request->all());

    if ($item->update()) {
      $platforms = $request->input('platforms');

      if (!empty($platforms)) {
        $arr_prices = [];

        foreach ($platforms as $slug => $price) {
          $platform = Platform::findBySlug($slug);

          $arr_prices[$platform->id] = [
            'price' => $price
          ];
        }
        $item->platforms()->sync($arr_prices);
      }
    }

    return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($calculatorSlug, $itemSlug) {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $item       = Item::findBySlug($itemSlug);

    $item->delete();

    return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
  }
}
