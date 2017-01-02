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

    $promotionCode = new PromotionCode([
      'percentage' => $promotionCodeData['percentage'],
      'start_date' => isset($promotionCodeData['start_date']) ? $promotionCodeData['start_date'] : null,
      'expiry_date' => isset($promotionCodeData['expiry_date']) ? $promotionCodeData['expiry_date'] : null
    ]);

    do {
      $tmp_code = str_random(8);
    } while (PromotionCode::whereCode($tmp_code)->count() > 0);

    $promotionCode->code = $tmp_code;
    
    if (isset($promotionCodeData['add_expiring_date']) and 
        $promotionCodeData['add_expiring_date'] == "true" and
        $promotionCode->expiry_date < $promotionCode->start_date) {
      Flash::error('El código de promoción no pudo ser generado debido a que la fecha de expiración es menor a la de inicio.');
      return redirect()->route('site.admin.panel.promotions.index');
    } else {
      $promotionCode->save();
    }

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
    $promotionCode->start_date = isset($promotionCodeData['start_date']) ? $promotionCodeData['start_date'] : null;
    $promotionCode->expiry_date = isset($promotionCodeData['expiry_date']) ? $promotionCodeData['expiry_date'] : null;
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
      $promotionCode->referringUsers()->sync([$referringUser->id]);
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

  public function getDiscount($code) {
    $resp = [
      'status'  => 'CONNECTION_ERROR',
      'msg'     => 'Existe un error en la conexión <br/>¡Por favor, intente más tarde!'
    ];
    $tmp_date = date('Y-m-d');
    $promotionCode = PromotionCode::whereCode($code);

    if ($promotionCode->count() > 0) {
      $promotionCode = $promotionCode->first();

      if (is_null($promotionCode->start_date) and is_null($promotionCode->expiry_date)) {
        $resp['discount'] = (double) $promotionCode->percentage;
        $resp['msg'] = '¡Promoción aplicada exitosamente!';
        $resp['status'] = 'SUCCESS';
      }
      else if (!is_null($promotionCode->start_date) and !is_null($promotionCode->expiry_date) and 
              $tmp_date >= $promotionCode->start_date and $tmp_date <= $promotionCode->expiry_date) {
        $resp['discount'] = (double) $promotionCode->percentage;
        $resp['msg'] = '¡Promoción aplicada exitosamente!';
        $resp['status'] = 'SUCCESS';
      }
      else if (!is_null($promotionCode->start_date) and !is_null($promotionCode->expiry_date)) {
        if ($tmp_date < $promotionCode->start_date) {
          $resp['msg'] = 'El código de promoción aún no es válido.';
          $resp['status'] = 'VALIDATION_ERROR';
        }
        else if ($tmp_date > $promotionCode->expiry_date) {
          $resp['msg'] = 'El código de promoción ha expirado.';
          $resp['status'] = 'VALIDATION_ERROR';
        }
      }
    } else if ($promotionCode->count() == 0) {
      $resp['msg'] = 'El código de promoción no se encuentra registrado.';
      $resp['status'] = 'VALIDATION_ERROR';
    }
    return response()->json($resp);
  }
}