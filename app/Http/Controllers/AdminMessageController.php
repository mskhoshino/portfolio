<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Models\AdminContent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminMessageController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $admincategory;
    protected $admincontent;
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminCategory $admincategory, AdminContent $admincontent, User $user)
    {
        $this->user = $user;

        $this->admincategory = $admincategory;
        $this->admincontent = $admincontent;
    }

    public function index(Request $request)
    {
        // ログインチェック
        $user_name = $request->session()->get('user_name');
        $loginCheck = $this->user->loginCheck($user_name);

        if(! $loginCheck){ 
            return redirect('/admin/login');
            return redirect('/admin/layout');
        }

        // カテゴリーを取得
        $categories = $this->admincategory->get();
        // 言語タイプを取得
        return view('admin.form', ['categories' => $categories]);
        return view('admin.layout', ['categories' => $categories]);
    }

    public function store(Request $request) {
        // 入力情報を取得
        $input = $request->all();

        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:30',
            'content' => 'required|max:1000',
            'language_type' => 'required',
        ],
        [
            'category_id.required' => 'カテゴリーを選択してください',
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは30文字以内で入力してください',
            'content.required' => '投稿内容を入力してください',
            'content.max' => '投稿内容は1000文字以内で入力してください',
            'language_type.required' => '言語を選択してください',
        ]);

        // 保存
        $this->admincontent->fill($input)->save();
        return redirect('/admin/top');
        return redirect('/admin/layout');
    }

    public function edit($id, Request $request)
    {
        // ログインチェック
        $user_name = $request->session()->get('user_name');
        $loginCheck = $this->user->loginCheck($user_name);

        if(! $loginCheck){ 
            return redirect('/admin/login');
            return redirect('/admin/layout');
        }

        // idに該当する投稿データを取得
        $admincontent = $this->admincontent->find($id);
        // カテゴリーを取得
        $categories = $this->admincategory->get();
        // 言語タイプを取得
        return view('admin.edit', ['admincontent' => $admincontent, 'categories' => $categories]);
        return view('admin.layout', ['admincontent' => $admincontent, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        // 入力情報を取得
        $input = $request->all();
        
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:30',
            'content' => 'required|max:1000',
            'language_type' => 'required',
        ],
        [
            'category_id.required' => 'カテゴリーを選択してください',
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは30文字以内で入力してください',
            'content.required' => '投稿内容を入力してください',
            'content.max' => '投稿内容は1000文字以内で入力してください',
            'language_type.required' => '言語を選択してください',
        ]);

        // 保存
        $this->admincontent->find($id)->fill($input)->save();
        return redirect()->to('/admin/list');
        return redirect()->to('/admin/layout');
    }

    public function listIndex(Request $request)
    {
        // ログインチェック
        $user_name = $request->session()->get('user_name');
        $loginCheck = $this->user->loginCheck($user_name);

        if(! $loginCheck){ 
            return redirect('/admin/login');
            return redirect('/admin/layout');
        }

        // 全ての投稿データを取得
        $contents = $this->admincontent->get();
        // カテゴリーを取得
        $categories = $this->admincategory->get();

        // 言語タイプを取得
        return view('admin.list', ['contents' => $contents, 'categories' => $categories]);
        return view('admin.layout', ['contents' => $contents, 'categories' => $categories]);
    }

    public function detail($id) {
        $this->admincontent->find($id)->delete();
        return redirect()->to('admin/list');
        return redirect()->to('admin/layout');
    }
}
