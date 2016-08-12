<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Calculator;
use App\Section;

class Sections extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($key_name)
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($slug)
  {
    $calculator = Calculator::findBySlug($slug);

    return view('site.admin.calculator.sections.create')->with([
      'calculator' => $calculator
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $slug)
  {
    $calculator = Calculator::findBySlug($slug);

    $section = new Section($request->all());
    $section->calculator_id =  $calculator->id;
    $section->save();

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
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($calculatorSlug, $sectionSlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $section   = Section::findBySlug($sectionSlug);

    return view('site.admin.calculator.sections.edit')->with([
      'calculator'  => $calculator,
      'section'     => $section
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $calculatorSlug, $sectionSlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $section   = Section::findBySlug($sectionSlug);

    $section->fill($request->all());
    $section->update();

    return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($calculatorSlug, $sectionSlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $section   = Section::findBySlug($sectionSlug);

    $section->delete();

    return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
  }
}
