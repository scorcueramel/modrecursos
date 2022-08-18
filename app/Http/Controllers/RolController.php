<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//modelo de roles
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Validator;


class RolController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-rols|crear-rols|editar-rols|borrar-rols', ['only'=>['index']]);
        $this->middleware('permission:crear-rols', ['only'=>['create','store']]);
        $this->middleware('permission:editar-rols', ['only'=>['edit','update']]);
        $this->middleware('permission:borrar-rols', ['only'=>['destroy']]);
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('roles.crear', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','permission'=>'required']);
        $role = Role::create(['name'=>$request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermission = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.editar',compact('role','permission','rolePermission'));
    }

    public function update(Request $request, $id)
    {
       $this->validate($request, ['name'=>'required','permission'=>'required']);
       $role = Role::find($id);
       $role->name = $request->input('name');
       $role->save();
       return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('roles.index');
    }
}
