<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRole;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles-read')->only(['index']);
        $this->middleware('permission:roles-create')->only(['create', 'store']);
        $this->middleware('permission:roles-update')->only(['edit', 'update']);
        $this->middleware('permission:roles-delete')->only(['destroy']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::idDescending()->whereRoleNot(['super_admin'])->with('permissions')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if (Auth::guard('admin')->user()->hasPermission('roles-update')){
             $btn ='<a href="' .route("roles.edit", $row->id). '"><button type="button"
             class="delete btn btn-success fa fa-edit" data-size="sm" title="Edit"></button></a> &nbsp';
                }
                if (Auth::guard('admin')->user()->hasPermission('roles-delete')){
                $btn = $btn.
                '<form class="delete"  action="' . route("roles.destroy", $row->id) . '"  method="POST" id="sa-params"
                style="display: inline-block; right: 50px;" >
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <button type="submit" class="delete btn btn-danger fa fa-trash" title=" ' . 'Delete' . ' "></button>
                    </form>';
                }
                        return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);
            }

            $models = ['admins','roles','users','countries','settings'];

            $actions = ['create', 'read', 'update', 'delete'];

            return view('admin.roles.index',compact('models','actions'));
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());

        $role->attachPermissions($request->permissions);

        // session()->flash('success', __('admin.addsuccess'));
        // return redirect()->route('roles.index');
        return response()->json(['status'=>'success','data'=>$role]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $models = ['admins','roles','users','countries','settings'];

        $actions = ['create', 'read', 'update', 'delete'];

        $role = Role::findOrFail($id);
        return view('admin.roles.edit',compact('role','models','actions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => ['required',Rule::unique('roles')->ignore($id)],
            'permissions' => 'required|array|min:1',
        ]);

        $role->update($request->all());
        $role->syncPermissions($request->permissions);
        // session()->flash('success', __('admin.updatesuccessfully'));
        // return redirect()->route('roles.index');
        return response()->json(['status'=>'success','data'=>$role]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(['status'=>'success']);
    }
}
