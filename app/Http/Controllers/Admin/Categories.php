<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Calculator;
use App\Category;

class Categories extends Controller
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

    return view('site.admin.calculator.categories.create')->with([
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

    $category = new Category($request->all());
    $category->calculator_id =  $calculator->id;
    $category->save();

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
  public function edit($calculatorSlug, $categorySlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $category   = Category::findBySlug($categorySlug);

    return view('site.admin.calculator.categories.edit')->with([
      'calculator'  => $calculator,
      'category'    => $category
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $calculatorSlug, $categorySlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $category   = Category::findBySlug($categorySlug);

    $category->fill($request->all());
    $category->update();

    return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($calculatorSlug, $categorySlug)
  {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $category   = Category::findBySlug($categorySlug);

    $category->delete();

    return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
  }
}
