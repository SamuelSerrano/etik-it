<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use \Datetime;
use \stdClass;

class LoteProductoController extends Controller
{
    public function index()
    {
        $obj_lotes = DB::table('lote_productos')
                        ->join('productos', 'lote_productos.producto_id','=','productos.producto_id')
                        ->select('lote_productos.*','productos.nombre AS producto')
                        ->paginate(3);

        $obj_productos = App\Producto::all();
        return view('lotes.lote',compact('obj_lotes','obj_productos'));
        //return $obj_lotes;
       
    }

    public function crear(Request $req){

        $req->validate([
            'lote' => 'required',
            'cantidad' => 'required|numeric',
            'fechaVencimiento' => 'required|date',            
            'producto_id' => 'required',            
        ]);

        $loteNew = new App\LoteProducto;
        $loteNew->lote = $req->lote;
        $loteNew->cantidad = $req->cantidad; 
        $loteNew->fechaVencimiento = $req->fechaVencimiento;      
        $loteNew->producto_id = $req->producto_id;        
        $loteNew->save();
        return back()->with('mensaje','Lote creado con éxito!!');
 
    }

    public function editar($lote_id){
        $obj_lotes = DB::table('lote_productos')
        ->join('productos', 'lote_productos.producto_id','=','productos.producto_id')
        ->select('lote_productos.*','productos.nombre AS producto')
        ->where('lote_id','=',$lote_id)
        ->get();

        $obj_productos = App\Producto::all();
        return view('lotes.editar',compact('obj_lotes','obj_productos'));
        //return $obj_lotes;
    }

    public function update(Request $req, $lote_id){
        $req->validate([
            'lote' => 'required',
            'cantidad' => 'required|numeric',
            'fechaVencimiento' => 'required|date',            
            'producto_id' => 'required', 
        ]);
        $row_update = App\LoteProducto::
        where('lote_id','=',$lote_id)
        ->update(array('lote'=>$req->lote, 'cantidad'=> $req->cantidad, 
                       'fechaVencimiento'=> $req->fechaVencimiento,'producto_id'=> $req->producto_id));
        return back()->with('mensaje','Lote actualizado con éxito!!');
    }

    public function eliminar($lote_id){
        $row_delete = App\LoteProducto::where('lote_id','=',$lote_id)->delete();
        return back()->with('mensaje','Lote eliminado con éxito!!');
}
}
