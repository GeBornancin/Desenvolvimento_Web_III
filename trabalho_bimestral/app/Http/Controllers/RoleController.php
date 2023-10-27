<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $roles = Role::all();
        return view('viewsRoles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
        return view('viewsRoles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $novaRole = new Role();
        $novaRole->name = $request->name;
        $novaRole->guard_name = 'web';

        $novaRole->save();

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
        $role = Role::findById($id);
        $permissions = Permission::all();

        return view('viewsRoles.show', compact(['role', 'permissions']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
        $role = Role::findById($id);

        return view('viewsRoles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $role = Role::findById($id);

        $role->name = $request->name;
        $role->save();

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        $role = Role::findById($id);

        if(!isset($role)) {
            $msg = "Não há [ Papel ], com identificador [ $role->id ], registrada no sistema!";
            $link = "viewsRoles.index";
            return view('viewsRoles.erroid', compact(['msg', 'link']));
        }

        Role::destroy($id);

        return redirect()->route('roles.index');
    }
}
