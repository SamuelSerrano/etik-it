<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App;
use \Datetime;
use \stdClass;
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
            'descripcion' => 'required|max:100',
            'url_fabricante' => 'required|url',
            'categoria_id' => 'required',            
        ]);

        $productoNew = new App\Producto;
        $productoNew->nombre = $req->nombre;
        $productoNew->descripcion = $req->descripcion; 
        $productoNew->url_fabricante = $req->url_fabricante;     
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
            'descripcion' => 'required|max:100',
            'url_fabricante' => 'required|url',            
            'categoria_id' => 'required',
        ]);
        $row_update = App\Producto::
        where('producto_id','=',$producto_id)
        ->update(array('nombre'=>$req->nombre, 'descripcion'=> $req->descripcion, 
                       'url_fabricante'=> $req->url_fabricante,'categoria_id'=> $req->categoria_id, 'activo'=> $req->has('activo')));
        return back()->with('mensaje','Producto actualizado con éxito!!');
    }

    public function eliminar($producto_id){
        $row_delete = App\Producto::where('producto_id','=',$producto_id)->delete();
        return back()->with('mensaje','Producto eliminado con éxito!!');
    }

    public function Cola(){       
        $obj_productos = DB::table('lote_productos')
        ->join('productos', 'lote_productos.producto_id','=','productos.producto_id')
        ->select(DB::raw("CONCAT(productos.nombre,' ',lote_productos.lote) AS lote"),'lote_productos.lote_id')
        ->orderBy('lote')
        ->get();
        return view('productos.cola',compact('obj_productos'));
    }

    public function generarCola(Request $req){
        $req->validate([
            'cantidad' => 'required|numeric',            
            'lote_id' => 'required',
        ]);

        $obj_lote =  $obj_lotes = DB::table('lote_productos')
        ->join('productos', 'lote_productos.producto_id','=','productos.producto_id')
        ->select('lote_productos.*','productos.nombre AS producto','productos.url_fabricante AS url')
        ->where('lote_id','=',$req->lote_id)
        ->get();
        $timestamp = strtotime("now");
        $arr_cola = array(); 
        $nombre_archivo =  $obj_lote[0]->lote."_".$timestamp.".csv";
        $obj_csv = fopen('files_csv/'.$nombre_archivo,"a") or die ("Error al crear el archivo");
        for($i=1;$i<=$req->cantidad;$i++)
        {
            $strMask = 'PRD'.$timestamp
            .'|'.$i
            .'|'.$obj_lote[0]->producto_id
            //.'-'.$obj_productos[0]->descripcion
            .'|'.$obj_lote[0]->lote
            .'|'.date('dmY', strtotime($obj_lote[0]->fechaVencimiento))
            .'|'.$obj_lote[0]->url;
            //$arr_cola[$i] = $strMask;
            $arr_cola[$i] = Hash::make($strMask);
            
            //SDSE - 17032020 Se inserta cada registro creado.
            $colaNew = new App\ColaProducto;
            $colaNew->lote_id = $obj_lote[0]->lote_id;
            $colaNew->producto_id = $obj_lote[0]->producto_id; 
            $colaNew->hash_cadena = Hash::make($strMask);                   
            $colaNew->uid = $strMask;        
            $colaNew->save();
            
            fwrite($obj_csv, $strMask."\n");
        }
        
        $obj_cola = collect($arr_cola);
        return view('productos.plantilla',compact('obj_cola','nombre_archivo'));
        //return $obj_cola;
    }

    
}
