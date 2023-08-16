<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DataTables;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        if(request()->ajax())
        {
            $users = User::all();
            return $this->generateDatatables($users);
        };

        return view ('admin.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:1,2,3',
            'email' => 'required|email|unique:users', // Make sure email is unique
            'password' => 'required|min:8',
        ]);
        
        // You should use $request->input('password') instead of 'temp-password'
        $user = User::create([
            'name' => $validatedData['name'],
            'role_as' => $validatedData['role'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        
        $users = User::all();
        
        return view('admin.users.index')->with('users', $users);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view ('admin.users.edit')->with('user', $user);
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:1,2,3',
            'email' => 'required|email',
          
        ]);

        $user = User::findOrFail($id);

        $user-> update([
            'name' => $request->name,
            'role_as' => $request->role,
            'email' => $request->email,

        ]);

        $users = User::all();

        return view ('admin.users.index')->with ([

            'users' => $users,
            'user_name' => $user->name,

        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteUser = User::findOrFail($id);

        
        $userName = $deleteUser->name;
        $deleteUser->destroy($id);


        if ($deleteUser->delete()) {
            return redirect()->route('users.index')->with('success', $userName . ' deleted successfully');
        } else {
            return redirect()->route('users.index')->with('error', 'Failed to delete!');
        }
        
        
    }

    public function generateDatatables($request)
    {
        return DataTables::of($request)
                ->addIndexColumn()
                ->addColumn('role', function($data){
                    $role = '';
                    if($data->role_as == 1){
                        $role = '<span class="badge badge-primary">Administrator</span>';
                    } else if($data->role_as == 2){
                        $role = '<span class="badge badge-warning">Supervisor</span>';
                    } else {
                        $role = '<span class="badge badge-secondary">Trainee</span>';
                    }
                    return $role;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="'.route('users.edit', $data->id).'" class="btn btn-sm btn-warning editUser">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="'.route('users.destroy', $data->id).'" method="POST" class="d-inline">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                    <button type="submit" class="btn btn-sm btn-danger deleteUser">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                </form>';
                    return $actionButtons;
                })
                ->rawColumns(['action','role']) 
                ->make(true);
    }
}
