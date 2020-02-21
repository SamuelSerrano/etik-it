<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App;
class EmpleadoController extends Controller
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
        $obj_empleados = DB::table('empleados')
                        ->join('roles', 'empleados.role_id','=','roles.role_id')
                        ->join('clientes', 'empleados.cliente_id','=','clientes.cliente_id')
                        ->select('empleados.*','roles.role','clientes.nombre')
                        ->paginate(3);

        $obj_roles = App\Role::all();
        $obj_clientes = App\Cliente::all();
        return view('empleados.empleado',compact('obj_empleados','obj_roles','obj_clientes'));
       
    }

    public function crear(Request $req){

        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'role_id' => 'required',
            'cliente_id' => 'required',
        ]);

        $empleadoNew = new App\Empleado;
        $empleadoNew->name = $req->name;
        $empleadoNew->email = $req->email;
        $empleadoNew->password = Hash::make($req->password);
        $empleadoNew->role_id = $req->role_id;
        $empleadoNew->cliente_id = $req->cliente_id;
        $empleadoNew->save();
        return back()->with('mensaje','Empleado creado con éxito!!');
 
    }

    public function editar($empleado_id){
        $obj_empleados = DB::table('empleados')
                        ->join('roles', 'empleados.role_id','=','roles.role_id')
                        ->join('clientes', 'empleados.cliente_id','=','clientes.cliente_id')
                        ->select('empleados.*','roles.role','clientes.nombre')
                        ->where('empleado_id','=',$empleado_id)
                        ->get();

        $obj_roles = App\Role::all();
        $obj_clientes = App\Cliente::all();
        return view('empleados.editar',compact('obj_empleados','obj_roles','obj_clientes'));
    }

    public function update(Request $req, $empleado_id){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            //'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'role_id' => 'required',
            'cliente_id' => 'required',
        ]);
        $row_update = App\Empleado::
        where('empleado_id','=',$empleado_id)
        ->update(array('name'=>$req->name, 'email'=> $req->email, 'role_id'=> $req->role_id, 'cliente_id'=> $req->cliente_id));
        return back()->with('mensaje','Empleado actualizado con éxito!!');
    }

    public function eliminar($empleado_id){
        $row_delete = App\Empleado::where('empleado_id','=',$empleado_id)->delete();
        return back()->with('mensaje','Empleado eliminado con éxito!!');
    }
}
