<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Calculator;
use App\Package;
use App\Item;
use App\Icon;

class PackagesController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($calculatorSlug) {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $icons      = Icon::orderBy('name', 'ASC');

    return view('site.admin.calculator.packages.create')->with([
      'calculator'  => $calculator,
      'items'       => $calculator->items,
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
    $calculator   = Calculator::findBySlug($calculatorSlug);
    $package      = new Package();
    $items        = [];

    $package_params = $request->all();

    if (isset($package_params['items']) && is_array($package_params['items'])) {
      $itemSlugs = $package_params['items'];
      unset($package_params['items']);

      foreach ($itemSlugs as $itemSlug) {
        $item = Item::findBySlug($itemSlug);

        if ($item) {
          array_push($items, $item->id);
        }
      }
    }

    $package->fill($package_params);

    if ($package->save()) {
      if (count($items)) {
        $package->items()->sync($items);
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
  public function edit($calculatorSlug, $packageSlug) {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $package    = Package::findBySlug($packageSlug);
    $icons      = Icon::orderBy('name', 'ASC');

    return view('site.admin.calculator.packages.edit')->with([
      'calculator'  => $calculator,
      'package'     => $package,
      'items'       => $calculator->items,
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
  public function update(Request $request, $calculatorSlug, $packageSlug) {
    $calculator   = Calculator::findBySlug($calculatorSlug);
    $package      = Package::findBySlug($packageSlug);
    $items        = [];

    $package_params = $request->all();

    if (isset($package_params['items']) && is_array($package_params['items'])) {
      $itemSlugs = $package_params['items'];
      unset($package_params['items']);

      foreach ($itemSlugs as $itemSlug) {
        $item = Item::findBySlug($itemSlug);

        if ($item) {
          array_push($items, $item->id);
        }
      }

      $package->items()->sync($items);
    }

    $package->fill($package_params);

    if ($package->update()) {
      return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($calculatorSlug, $packageSlug) {
    $calculator = Calculator::findBySlug($calculatorSlug);
    $package    = Package::findBySlug($packageSlug);

    if ($package->delete()) {
      return redirect()->route('site.admin.panel.calculator.show', $calculator->slug);
    }
  }
}
