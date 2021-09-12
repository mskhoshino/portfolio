<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
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

    public function index()
    {
        return view('admin.login');
        return view('admin.layout');
    }


    /**
     * ログイン
     *
     * @return Response
     */
    public function login(Request $request){
        //入力内容をチェックする
        $loginInfos = $request->only('user_name', 'password');
        $user_name = $loginInfos['user_name'];
        $password = $loginInfos['password'];
        $result = $this->user->getUsers($user_name, $password);

        if($result) {
            //ユーザー情報をセッションに保存
            $request->session()->put('user_name', $user_name);

            return redirect("/admin/top");
            return redirect("/admin/layout");
        } else {
            //ログイン失敗
            return redirect("/admin/login")->withErrors([
              // セッションにエラー情報を入れる
              "login" => "ユーザー名またはパスワードが違います"
            ]);
            return redirect("/admin/layout")->withErrors([
                // セッションにエラー情報を入れる
                "login" => "ユーザー名またはパスワードが違います"
            ]);
        }

    }

    public function logout()
    {
        $request->session()->forget('user_name');
        return redirect()->route('login');
    }
}
