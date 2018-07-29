<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;

use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //VVI - Below returns and array. Needs all(). Otherwise it won't work.Also name then id should be parameters
        //otherwise for (id, name) parameter order will give result in the select box differently.
        //$roles = Role::lists('name', 'id');
        $roles = Role::lists('name', 'id')->all();
        
        //dd($roles);
        
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        //return $request->all();
        
        //User::create($request->all());
        
        //return redirect('/admin/users');
        
        $input = $request->all();
        //var_dump($input);
        //var_dump($request->file);
        //VVI - Below line does not work.
        //var_dump($request->file('size'));
        //var_dump($request->file('photo_id'));
        //VVI - Note the changed if statement.
        //if ($request->file('photo_id')) {
        //if ($file = $request->file('photo_id')) {
        //VVI - Did not use photo_id as that was giving null value.
        if ($file = $request->file) {
            
            //var_dump($file);
            //dd($file);
            //return $file;
            //return "Yes";
            
            //return "photo exists";
            $name = time() . $file->getClientOriginalName();
            //VVI - images folder will be created in public directory.
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        /*else {
            
            return "No";
            
        }*/
        
        $input['password'] = bcrypt($request->password);
        User::create($input);
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
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.users.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
