<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class ClienteController extends Controller
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
        $obj_clientes = App\Cliente::paginate(3);
        return view('clientes.cliente',compact('obj_clientes'));
    }

    public function crear(Request $req){

        $req->validate([
            'nombre' => 'required'
        ]);

        $clienteNew = new App\Cliente;
        $clienteNew->nombre = $req->nombre;
        $clienteNew->activo = $req->has('activo');
        $clienteNew->save();
        return back()->with('mensaje','Cliente creado con éxito!!');
 
    }

    public function editar($cliente_id){
        $obj_cliente = App\Cliente::where('cliente_id','=',$cliente_id)->firstOrFail();
        return view('clientes.editar',compact('obj_cliente'));
    }

    public function update(Request $req, $cliente_id){
        $req->validate([
            'nombre' => 'required'
        ]);
        $row_update = App\Cliente::where('cliente_id','=',$cliente_id)->update(array('nombre'=>$req->nombre, 'activo'=> $req->has('activo')));
        return back()->with('mensaje','Cliente actualizado con éxito!!');
    }

    public function eliminar($cliente_id){
        $row_delete = App\Cliente::where('cliente_id','=',$cliente_id)->delete();
        return back()->with('mensaje','Cliente eliminado con éxito!!');
    }
}
