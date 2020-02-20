<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class RoleController extends Controller
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
        $obj_roles = App\Role::paginate(3);
        return view('roles.role',compact('obj_roles'));
    }

    public function crear(Request $req){

        $req->validate([
            'role' => 'required'
        ]);

        $roleNew = new App\Role;
        $roleNew->role = $req->role;
        $roleNew->save();
        return back()->with('mensaje','Role creado con éxito!!');
    }

    public function editar($role_id){
        $obj_role = App\Role::where('role_id','=',$role_id)->firstOrFail();
        return view('roles.editar',compact('obj_role'));
    }

    public function update(Request $req, $role_id){
        $req->validate([
            'role' => 'required'
        ]);
        $row_update = App\Role::where('role_id','=',$role_id)->update(array('role'=>$req->role));
        return back()->with('mensaje','Role actualizado con éxito!!');
    }

    public function eliminar($role_id){
        $row_delete = App\Role::where('role_id','=',$role_id)->delete();
        return back()->with('mensaje','Role eliminado con éxito!!');
    }
}
