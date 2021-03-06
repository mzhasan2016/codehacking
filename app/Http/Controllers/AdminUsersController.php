<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;

use App\User;
use App\Role;
use App\Photo;

use Illuminate\Support\Facades\Session;

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
        return redirect('/admin/users');
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
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();
        
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //
        //return $request->all();
        
        $user = User::findOrFail($id);
        //$input = $request->all();
        
        //VVI - Must use trim below othewise problem, $request->except('password') from Laravel
        if(trim($request->password) == '') {
            
            $input = $request->except('password');
            
        } else {
            
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        
        if ($file = $request->file) {
            
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
                    
        }
        
        $user->update($input);
        return redirect('/admin/users');
        
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
        //return "Destroy";
        
        //User::findOrFail($id)->delete();
        
        $user = User::findOrFail($id);
        
        //VVI - Below code did not work, since images folder came twice due to Accessor
        //unlink(public_path() . "/images/" . $user->photo->file);
        //var_dump(public_path());
        //unlink($user->photo->file);
        
        $user->delete();
        
        //VVI - Below code is from Laravel
        Session::flash('deleted_user', 'The user has been deleted');
        
        return redirect('/admin/users');
        
    }
}
