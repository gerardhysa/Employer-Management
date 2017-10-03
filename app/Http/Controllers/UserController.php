<?php

namespace App\Http\Controllers;

use App\Departments;
use Illuminate\Http\Request;
use Auth;
use Image;
use Storage;
use App\User;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;




class UserController extends Controller
{
    public function profile(){

        return view('profile', ['user' => Auth::user()]);
    }

    public function update_avatar(Request $request)
    {

        $user = Auth::user();

        //Image update

        if($request->hasFile('avatar')){

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $location = public_path('/uploads/avatars/'. $filename);

            Image::make($avatar)->resize(300,300)->save($location);

            $oldFileName = $user->avatar;

            $user->avatar = $filename;

            Storage::delete($oldFileName);

        }

        $user->save();

        return view('profile',['user' => Auth::user()]);
    }

    public function update_info(Request $request){

        $this->validate($request, array(
            'name' => 'required | max:255',
            'surname' => 'sometimes',
            'address' => 'sometimes'
        ));

        // Save the data to the database
       /* $user = User::find($id);*/

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->address = $request->input('address');

        $user->save();

        return view('profile',['user' => Auth::user()]);
    }

    public function getIndex()
    {
        return view('/home');
    }


    public function anyData()
    {
        $users = DB::table('users')
        ->join('departments', 'users.department_id', '=', 'departments.department_id')
            ->select('departments.*', 'users.*')
        ->get();

        return Datatables::of($users)->addColumn('action', function ($user) {
            return '<a href="/profileEdit/' . $user->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a href="/delete/' . $user->id . '" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete the user?\')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        })->make(true);

    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('home');
    }

    public function getUserProfile($id){

        $user = User::find($id);

        return view('userProfile')->withUser($user);
    }

    public function getUserProfileInfoUpdated(Request $request, $id){

        $this->validate($request, array(
            'name' => 'required | max:255',
            'surname' => 'sometimes',
            'address' => 'sometimes',
            'department' => 'sometimes'
        ));

        // Save the data to the database

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->address = $request->input('address');
        $user->department = $request->input('department');

        $user->save();

        return view('userProfile')->withUser($user);
    }

    public function getUserProfilePhotoUpdated(Request $request, $id){

        $user = User::find($id);

        if($request->hasFile('avatar')){

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $location = public_path('/uploads/avatars/'. $filename);

            Image::make($avatar)->resize(300,300)->save($location);

            $oldFileName = $user->avatar;

            $user->avatar = $filename;

            Storage::delete($oldFileName);
        }

        $user->save();

        return view('userProfile')->withUser($user);
    }

    public function createUser(){

       $departments = Departments::all();
        return view('createNew')->with('departments', $departments);
    }

    public function storeUser(Request $request){

        $this->validate($request, array(
            'name' => 'required | max:255',
            'surname' => 'sometimes',
            'email' => 'required',
            'address' => 'sometimes',
            'avatar' => 'sometimes|image',
            'admin' => 'required'
        ));

        $user = new User();

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->department_id = $request->department_id;
        $user->password = bcrypt($user->name);
        $user->admin = $request->admin;

        $user->save();

        return view('home');

    }

    public function login(Request $request){


        if(Auth::attempt(['email'=> $request->email, 'password' => $request->password])){

            $user =  User::where('email',$request->email)->first();

            if($user->is_admin()){

                return redirect()->route('home');
            }

            return redirect()->route('userHome');

        }
        return redirect()->back();
    }

    public function getUsersTable(Request $request){

        $users = DB::table('users')
            ->join('departments', 'users.department_id', '=', 'departments.department_id')
            ->where('users.department_id','=',$request->id)->get();

        return Datatables::of($users)->addColumn('action', function ($user) {
            return '<a href="/profileEdit/' . $user->department_id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a href="/delete/' . $user->department_id . '" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete the user?\')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        })->make(true);

    }

    public function editDep(){

        $departments = Departments::all();
        return view('editDepartments')->with('departments', $departments);

    }

    public function storeDep(Request $request){

        $this->validate($request, array(
            'dep_name' => 'required | max:255',
            'department_id' => 'required'
        ));

        $department = new Departments();

        $department->dep_name = $request->dep_name;
        $department->parent_id = $request->department_id;

        $department->save();

        return view('home');
    }

    public function deleteDep($id)
    {

        $department = Departments::find($id);

        $result = DB::table('departments')
            ->select('departments.*')->where('departments.parent_id',$id)
            ->get();

        $results = DB::table('users')
            ->select('users.*')->where('users.department_id',$id)
            ->get();

        if(count($result) > 0){
            echo "<script>
            alert('This department cannot be deleted');
            window.location.href='/home';
            </script>";
        }elseif (count($results) > 0){
            echo "<script>
            alert('This department cannot be deleted');
            window.location.href='/home';
            </script>";
        }else {


            $department->delete();
            return redirect()->route('home');
        }
        }
}
