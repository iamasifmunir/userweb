<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function login(Request $request){

        $user = User::where('email', $request->get('email'))->first();



        if ($user && Hash::check($request->get('password'), $user->password)) {
            $user->api_token = Str::random(60);
            $user->save();

            $this->setData([$user]);
            $this->setMessage('User Data');

            return $this->response();
        }
        $this->setErrors(['invalid credentials']);
        //    dd($this);
        return $this->response();
    }

    public function index(){

        $data = [];

        $data['website']= Website::all();

        $this->setData([$data]);
        $this->setMessage('User Data');
        //  dd($this);

        return $this->response();



    }
}
