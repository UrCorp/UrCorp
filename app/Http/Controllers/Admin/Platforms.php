<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Calculator;
use App\Platform;
use App\Icon;

class Platforms extends Controller
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

    return view('site.admin.calculator.platforms.create')->with([
      'calculator' => $calculator,
      'icons'      => $icons
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

    $platform = new Platform($request->all());
    $platform->calculator_id =  $calculator->id;
    $platform->save();

    return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($calculatorSlug, $platformSlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $platform   = Platform::findBySlug($platformSlug);
    $icons      = Icon::orderBy('name', 'ASC');

    return view('site.admin.calculator.platforms.edit')->with([
      'calculator'  => $calculator,
      'platform'    => $platform,
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
  public function update(Request $request, $calculatorSlug, $platformSlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $platform   = Platform::findBySlug($platformSlug);

    $platform->fill($request->all());
    $platform->update();

    return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($calculatorSlug, $platformSlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $platform   = Platform::findBySlug($platformSlug);

    $platform->delete();

    return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
  }
}
