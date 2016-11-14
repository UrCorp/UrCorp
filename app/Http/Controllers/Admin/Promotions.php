<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\PromotionCode;
use App\ReferringUser;

class Promotions extends Controller
{
  public function index() {
    $promotionCodes = PromotionCode::orderBy('id', 'ASC')->get();

    return view('site.admin.promotions.index')->with([
      'promotionCodes' => $promotionCodes
    ]);
  }

  public function create() {
    return view('site.admin.promotions.create');
  }

  public function store(Request $request) {
    $tmp_code = null;
    $promotionCodeData = $request->input('promotionCode');

    $promotionCode = new PromotionCode(['percentage' => $promotionCodeData['percentage']]);

    do {
      $tmp_code = str_random(8);
    } while (PromotionCode::whereCode($tmp_code)->count() > 0);

    $promotionCode->code = $tmp_code;
    $promotionCode->save();

    if (isset($promotionCodeData['add_referring_user']) and 
        $promotionCodeData['add_referring_user'] == "true") {
      $referringUserData = $promotionCodeData['referring_user'];
      $referringUser = ReferringUser::whereEmail($referringUserData['email']);

      if ($referringUser->count() == 0) {
        $referringUser = new ReferringUser();
        $referringUser->fill($referringUserData);
        $referringUser->save();
      } else {
        $referringUser = $referringUser->first();
      }
      /*
       * Sync - El método lo limita a sólo un código de promoción por usuario referente.
       * Al pasar a la modalidad de múltiples códigos por usuarios referentes se
       * utilizará el método Attach hasta entonces.
       */
      $referringUser->promotionCodes()->sync([$promotionCode->id]);
    }


    Flash::success('El código de promoción: <b>' . $promotionCode->code . '</b> ha sido generado exitosamente! :)');
    return redirect()->route('site.admin.panel.promotions.index');
  }

  public function edit($code) {
    $promotionCode = PromotionCode::whereCode($code)->first();

    return view('site.admin.promotions.edit')->with([
      'promotionCode' => $promotionCode
    ]);
  }

  public function update($code, Request $request) {
    $promotionCodeData = $request->input('promotionCode');
    $promotionCode = PromotionCode::whereCode($code)->first();

    $promotionCode->percentage = $promotionCodeData['percentage'];
    $promotionCode->update();

    if (isset($promotionCodeData['add_referring_user']) and 
        $promotionCodeData['add_referring_user'] == "true") {
      $referringUserData = $promotionCodeData['referring_user'];
      $referringUser = ReferringUser::whereEmail($referringUserData['email']);

      if ($referringUser->count() == 0) {
        $referringUser = new ReferringUser();
        $referringUser->fill($referringUserData);
        $referringUser->save();
      } else {
        $referringUser = $referringUser->first();
      }
      /*
       * Sync - El método lo limita a sólo un código de promoción por usuario referente.
       * Al pasar a la modalidad de múltiples códigos por usuarios referentes se
       * utilizará el método Attach hasta entonces.
       */
      $referringUser->promotionCodes()->sync([$promotionCode->id]);
    }

    Flash::warning('El código de promoción: <b>' . $promotionCode->code . '</b> ha sido actualizado.');
    return redirect()->route('site.admin.panel.promotions.index');
  }

  public function destroy($code) {
    $promotionCode = PromotionCode::whereCode($code)->first();
    $promotionCode->delete();


    Flash::error('El código de promoción: <b>' . $promotionCode->code . '</b> ha sido eliminado.');
    return redirect()->route('site.admin.panel.promotions.index');
  }
}
