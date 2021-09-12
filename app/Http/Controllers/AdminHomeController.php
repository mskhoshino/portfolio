<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminHomeController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_name = $request->session()->get('user_name');
        $loginCheck = $this->user->loginCheck($user_name);

        if(! $loginCheck){ 
            return redirect('/admin/login');
            return redirect('/admin/layout');
        }

        return view('admin.top');
        return view('admin.layout');
    }
}
