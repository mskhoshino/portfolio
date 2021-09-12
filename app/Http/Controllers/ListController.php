<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Models\AdminContent;

class ListController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $admincategory;
    protected $admincontent;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminCategory $admincategory, AdminContent $admincontent)
    {
        $this->admincategory = $admincategory;
        $this->admincontent = $admincontent;
    }

    /**
    * Store a newly created resource in storage.
    */
    public function index() {
        // 全ての投稿データを取得
        $contents = $this->admincontent->orderBy('create_at', 'desc')->get();

        // カテゴリーを取得
        $categories = $this->admincategory->get();

        // 言語タイプ
        $language_type = array(
            '0' => '中国語',
            '1' => '英語'
        );

        return view('user.list', compact('contents', 'categories', 'language_type'));
        return view('user.layout', compact('contents', 'categories', 'language_type'));
    }

    public function search(Request $request) {
        // 言語タイプ
        $language_type = array(
            '0' => '中国語',
            '1' => '英語'
        );

        $messages = [];

        $search_category_id = $request->input('search_category_id');
        $search_language_type = $request->input('search_language_type');
        $search_text = $request->input('search_text');

        if(is_null($search_category_id) && is_null($search_language_type) && is_null($search_text)) {
            // 全ての投稿データを取得(検索条件を指定しない場合は全件表示)
            $contents = $this->admincontent->get();
            // カテゴリーを取得
            $categories = $this->admincategory->get();

            return view('user.list', compact('contents', 'categories', 'language_type'));
            return view('user.layout', compact('contents', 'categories', 'language_type'));
        } else {
            if(! is_null($search_category_id)) {
                if(! is_null($search_language_type) && ! is_null($search_text)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_category_id)
                    ->Where('language_type', '=', $search_language_type )
                    ->Where('content', 'like', '%'.$search_text.'%')
                    ->orderBy('create_at', 'desc')
                    ->get();
                } else if(is_null($search_language_type) && ! is_null($search_text)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_category_id)
                    ->Where('content', 'like', '%'.$search_text.'%')
                    ->orderBy('create_at', 'desc')
                    ->get();
                } else if(! is_null($search_language_type) && is_null($search_text)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_category_id)
                    ->Where('language_type', '=', $search_language_type )
                    ->orderBy('create_at', 'desc')
                    ->get();
                } else if(is_null($search_language_type) && is_null($search_text)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_category_id)
                    ->orderBy('create_at', 'desc')
                    ->get();
                }
            }
            if(! is_null($search_language_type)) {
                if(! is_null($search_category_id) && ! is_null($search_text)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_category_id)
                    ->Where('language_type', '=', $search_language_type)
                    ->Where('content', 'like', '%'.$search_text.'%')
                    ->orderBy('create_at', 'desc')
                    ->get();
                } else if(is_null($search_category_id) && ! is_null($search_text)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_language_type)
                    ->Where('content', 'like', '%'.$search_text.'%')
                    ->orderBy('create_at', 'desc')
                    ->get();
                } else if(! is_null($search_category_id) && is_null($search_text)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_category_id)
                    ->Where('language_type', '=', $search_language_type)
                    ->orderBy('create_at', 'desc')
                    ->get();
                } else if(is_null($search_category_id) && is_null($search_text)) {
                    $contents = $this->admincontent
                    ->Where('language_type', '=', $search_language_type)
                    ->orderBy('create_at', 'desc')
                    ->get();
                }
            }
            if(! is_null($search_text)) {
                if(! is_null($search_category_id) && ! is_null($search_language_type)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_category_id)
                    ->Where('language_type', '=', $search_language_type)
                    ->Where('content', 'like', '%'.$search_text.'%')
                    ->orderBy('create_at', 'desc')
                    ->get();
                } else if(is_null($search_category_id) && ! is_null($search_language_type)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_language_type)
                    ->Where('content', 'like', '%'.$search_text.'%')
                    ->orderBy('create_at', 'desc')
                    ->get();
                } else if(! is_null($search_category_id) && is_null($search_language_type)) {
                    $contents = $this->admincontent
                    ->where('category_id', '=', $search_category_id)
                    ->Where('content', 'like', '%'.$search_text.'%')
                    ->orderBy('create_at', 'desc')
                    ->get();
                } else if(is_null($search_category_id) && is_null($search_language_type)) {
                    $contents = $this->admincontent
                    ->Where('content', 'like', '%'.$search_text.'%')
                    ->orderBy('create_at', 'desc')
                    ->get();
                }
            }

            // カテゴリーを取得
            $categories = $this->admincategory->get();

            if($contents->isEmpty()) {
                $messages = array(
                    'search' => "該当する記事がみつかりませんでした。"
                );
            }

            return view('user.list', compact('contents', 'categories', 'language_type', 'messages'));
            return view('user.layout', compact('contents', 'categories', 'language_type', 'messages'));
        }
    }

    /**
    * Store a newly created resource in storage.
    */
    public function showDetail($id) {
        // idに該当する投稿データを取得
        $content = $this->admincontent->find($id);
        // カテゴリーを取得
        $categories = $this->admincategory->get();

        return view('user.detail', compact('content', 'categories'));
        return view('user.layout', compact('content', 'categories'));
    }
}
