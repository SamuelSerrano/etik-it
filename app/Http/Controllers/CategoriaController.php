<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class CategoriaController extends Controller
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
        $obj_categorias = App\Categoria::paginate(3);
        return view('categorias.categoria',compact('obj_categorias'));
    }

    public function crear(Request $req){

        $req->validate([
            'nombre' => 'required'
        ]);

        $categoriaNew = new App\Categoria;
        $categoriaNew->nombre = $req->nombre;
        $categoriaNew->save();
        return back()->with('mensaje','Categoria creada con éxito!!');
    }

    public function editar($categoria_id){
        $obj_categoria = App\Categoria::where('categoria_id','=',$categoria_id)->firstOrFail();
        return view('categorias.editar',compact('obj_categoria'));
    }

    public function update(Request $req, $categoria_id){
        $req->validate([
            'nombre' => 'required'
        ]);
        $row_update = App\Categoria::where('categoria_id','=',$categoria_id)->update(array('nombre'=>$req->nombre));
        return back()->with('mensaje','Categoria actualizada con éxito!!');
    }

    public function eliminar($categoria_id){
        $row_delete = App\Categoria::where('categoria_id','=',$categoria_id)->delete();
        return back()->with('mensaje','Categoria eliminada con éxito!!');
    }
}
