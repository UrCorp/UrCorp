<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Calculator;

class CalculatorManagement extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $calculators = Calculator::all();

    return view('site.admin.calculator.index')->with([
      'calculators' => $calculators
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('site.admin.calculator.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $calculator = new Calculator($request->all());
    $calculator->save();

    return redirect()->route('site.admin.panel.calculator.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    $calculator = Calculator::findBySlug($slug);

    return view('site.admin.calculator.show')->with([
      'calculator' => $calculator
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($slug)
  {
    $calculator = Calculator::findBySlug($slug);
    return view('site.admin.calculator.edit')->with([
      'calculator' => $calculator
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $slug)
  {
    $calculator = Calculator::findBySlug($slug);
    $calculator->fill($request->all());
    $calculator->update();

    return redirect()->route('site.admin.panel.calculator.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($slug)
  {
    $calculator = Calculator::findBySlug($slug);
    $calculator->delete();

    return redirect()->route('site.admin.panel.calculator.index');
  }
}
