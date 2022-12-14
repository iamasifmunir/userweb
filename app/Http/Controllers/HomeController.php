<?php

namespace App\Http\Controllers;

use Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\EmailNotification;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function send()
    {
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

        dd('Notification sent!');
    }


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }
}
