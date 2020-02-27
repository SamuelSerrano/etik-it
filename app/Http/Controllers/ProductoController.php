<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;

class ProductoController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $obj_productos = DB::table('productos')
                        ->join('categorias', 'productos.categoria_id','=','categorias.categoria_id')
                        ->select('productos.*','categorias.nombre AS nombrecat')
                        ->paginate(3);

        $obj_categorias = App\Categoria::all();
        return view('productos.producto',compact('obj_productos','obj_categorias'));
        //return $obj_productos;
       
    }

    public function crear(Request $req){

        $req->validate([
            'nombre' => 'required',
            'lote' => 'required',
            'categoria_id' => 'required',            
        ]);

        $productoNew = new App\Producto;
        $productoNew->nombre = $req->nombre;
        $productoNew->lote = $req->lote;     
        $productoNew->activo = $req->has('activo');   
        $productoNew->categoria_id = $req->categoria_id;        
        $productoNew->save();
        return back()->with('mensaje','Producto creado con éxito!!');
 
    }

    public function editar($producto_id){
        $obj_productos = DB::table('productos')
        ->join('categorias', 'productos.categoria_id','=','categorias.categoria_id')
        ->select('productos.*','categorias.nombre AS nombrecat')
        ->where('producto_id','=',$producto_id)
        ->get();

        $obj_categorias = App\Categoria::all();
        return view('productos.editar',compact('obj_productos','obj_categorias'));
    }

    public function update(Request $req, $producto_id){
        $req->validate([
            'nombre' => 'required',
            'lote' => 'required',            
            'categoria_id' => 'required',
        ]);
        $row_update = App\Producto::
        where('producto_id','=',$producto_id)
        ->update(array('nombre'=>$req->nombre, 'lote'=> $req->lote, 'categoria_id'=> $req->categoria_id, 'activo'=> $req->has('activo')));
        return back()->with('mensaje','Producto actualizado con éxito!!');
    }

    public function eliminar($producto_id){
        $row_delete = App\Producto::where('producto_id','=',$producto_id)->delete();
        return back()->with('mensaje','Producto eliminado con éxito!!');
    }
}
