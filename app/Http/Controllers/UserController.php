<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hobby;
use App\Models\User;
use App\Models\User_hobby;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(){
        $hobbies = Hobby::all();
        return view('user',compact('hobbies'));
    }

    public function create(Request $request)
    {
        // print_r($request->input());exit;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->hobbies = $request->input('hobbies');

        $user = User::create([ 
            'first_name' => $request->input('first_name'), 
            'last_name' => $request->input('last_name'), 
        ]);
        
        $User_hobby = User_hobby::create([
            "user_id" => $request->input('id'),
            "hobby_id" => $request->input('hobbies'),
        ]); 

        // Handle the selected hobbies as needed, for example, save them to a user's profile

        return redirect('/user')->back()->with('message', 'User Hobby created!');
    }

    public function show(){
        return view('show');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query();

            if ($request->has('first_name')) {
                $users->where('first_name', 'like', '%' . $request->input('first_name') . '%');
            }

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
