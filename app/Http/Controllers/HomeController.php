<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    // 言語選択プルダウン
    public $languageTypePulldown = [
        'ja' => '日本語を英語・中国語に翻訳する',
        'zh' => '中国語を英語・日本語に翻訳する',
        'en' => '英語を中国語・日本語に翻訳する'
    ];

    // 言語タイプ
    public $languageType = [
        'ja' => '日本語',
        'zh' => '中国語',
        'en' => '英語'
    ];

    /**
    * 初期表示
    */
    public function index()
    {
        // 言語選択プルダウン
        $language_type_pulldown = $this->languageTypePulldown;

        $language_type_from = null;

        return view('user.index', compact('language_type_pulldown', 'language_type_from'));
        return view('user.layout', compact('language_type_pulldown', 'language_type_from'));
    }

    /**
    * 翻訳処理
    *
    * @param  \Illuminate\Http\Request  $request
    */
    public function get_translate(Request $request) {

        // リクエスト内容取得
        $input = $request->all();

        $text = $input['text'];
        $language_type_from = $input['language_type_from'];
        $messages = [];

        // バリデーション
        $messages = $this->inputValidation($text, $language_type_from);
        if($messages) {
            return view('user/index', compact('language_type_pulldown', 'messages', 'language_type_from'));
            return view('user.layout', compact('language_type_pulldown', 'messages', 'language_type_from'));
        }

        // 実行用URL作成
        $base_url = config('app.translate_api_base_url');
        $url_param = '?text=%s&source=%s&target=%s';

        // 言語タイプ
        $language_type = $this->languageType;
        $japanese = 'ja';
        $english = 'en';
        $chinese = 'zh';

        // パラメータ組み立て
        if ($language_type_from == $japanese) {
            // 日本語を翻訳
            $translated_language_1 = $language_type[$chinese];
            $translated_language_2 = $language_type[$english];

            $url_1 = $this->createUrl($base_url, $url_param, $text, $language_type_from, $chinese);
            $url_2 = $this->createUrl($base_url, $url_param, $text, $language_type_from, $english);
        } else if ($language_type_from == $english) {
            // 英語を翻訳
            $translated_language_1 = $language_type[$chinese];
            $translated_language_2 = $language_type[$japanese];

            $url_1 = $this->createUrl($base_url, $url_param, $text, $language_type_from, $chinese);
            $url_2 = $this->createUrl($base_url, $url_param, $text, $language_type_from, $japanese);
        } else if ($language_type_from == $chinese) {
            // 中国語を翻訳
            $translated_language_1 = $language_type[$japanese];
            $translated_language_2 = $language_type[$english];

            $url_1 = $this->createUrl($base_url, $url_param, $text, $language_type_from, $japanese);
            $url_2 = $this->createUrl($base_url, $url_param, $text, $language_type_from, $english);
        }

        // 翻訳API実行
        $client = new Client();
        $result_1 = $client->request("GET", $url_1);
        $result_2 = $client->request("GET", $url_2);

        $posts_1 = $result_1->getBody();
        $posts_2 = $result_2->getBody();
        
        if (!$posts_1 || !$posts_2) {
            $messages['connection'] = "接続エラー";
            return view('user/index', compact('language_type_pulldown', 'language_type_from', 'messages'));
            return view('user.layout', compact('language_type_pulldown', 'language_type_from', 'messages'));
        }

        // 結果(json)を配列に変換
        $posts_1 = json_decode($posts_1, true);
        $posts_2 = json_decode($posts_2, true);

        // 言語選択プルダウン
        $language_type_pulldown = $this->languageTypePulldown;

        return view('user/index', compact('language_type_pulldown', 'language_type_from', 'posts_1', 'posts_2', 'translated_language_1', 'translated_language_2'));
        return view('user.layout', compact('language_type_pulldown', 'language_type_from', 'posts_1', 'posts_2', 'translated_language_1', 'translated_language_2'));
    }

    /**
     * API実行URL作成
     * 
     * @param string $base_url APIURL
     * @param string $url_param パラメータ
     * @param string $text 翻訳対象テキスト
     * @param string $language_type_from 翻訳前言語タイプ
     * @param string $language_type_to 翻訳語言語タイプ
     */
    public function createUrl($base_url, $url_param, $text, $language_type_from, $language_type_to)
    {
        $params = sprintf($url_param, $text, $language_type_from, $language_type_to);
        $url = $base_url.$params;
        return $url;
    }

    /**
     * バリデーション
     * 
     * @param string $text 翻訳対象テキスト
     * @param string $language_type_from 翻訳前言語タイプ
     */
    public function inputValidation($text, $language_type_from)
    {
        // 言語タイプ、キーワードが未入力
        if (is_null($text) && is_null($language_type_from)) {
            return [
                'text_and_language' => "言語タイプを選択してキーワードを入力してください。"
            ];
        }

        // キーワードが未入力
        if (is_null($text)) {
            return [
                'text' => "キーワードを入力してください。"
            ];            
        }

        // 言語タイプが未選択
        if (is_null($language_type_from)) {
            return [
                'language_type' => "言語タイプを選択してください。"
            ];
        }

        return false;
    }
}