<?php

use Illuminate\Http\Request;
use App\Logs;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors']], function () {
    //Rutas a las que se permitirá acceso
    Route::post('/v1/track', function (Request $request ) {
        //return view('welcome');
        try{
            $data = json_decode($request->getContent());
            $geolocation = $data->geolocation;
            $uid = $data->uid;
            $product_code = $data->product_code;
    
            $log = new Logs;
            $log->uid = $uid;
            $log->geolocation = $geolocation;
            $log->product_code = $product_code;
            $log->save();
    
            return response()->json($geolocation, 200);
    
        }catch (Exception $exception) {
             return response()->json($exception->getMessage(), 501);
        }
    });
    //fin
});


