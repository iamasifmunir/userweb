<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Notification;
use App\Notifications\EmailNotification;



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

    public function create(Request $request){
       // dd($request);
        $Post = New Post();
        $Post->website_id = $request->id;
        $Post->text = $request->text;
        $Post->save();

        $user = User::first();

        $project = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'Your Website Has new Post',
            'thanks' => 'Thanks',
            'actionText' => 'View Post',
            'actionURL' => url('/'),
            'id' => 57
        ];

        Notification::send($user, new EmailNotification($project));

        $this->setData([$Post]);
        $this->setMessage('User Data');
        //  dd($this);
        return $this->response();
    }
}
