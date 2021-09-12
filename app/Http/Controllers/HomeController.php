<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
    * Store a newly created resource in storage.
    */
    public function  index() {
        // 言語タイプのプルダウン
        $language_type = array(
            'ja' => '日本語',
            'zh' => '中国語',
            'en' => '英語'
        );

        $language_type_from = null;

        return view('user.index', compact('language_type', 'language_type_from'));
        return view('user.layout', compact('language_type', 'language_type_from'));
    }

    public function  get_translate(Request $request) {

        $input = $request->all();

        $text = $input['text'];
        $language_type_from = $input['language_type_from'];
        $messages = [];

        // 言語タイプのプルダウン
        $language_type = array(
            'ja' => '日本語',
            'zh' => '中国語',
            'en' => '英語'
        );

        if(! is_null($text) && ! is_null($language_type_from)){
            // 実行用URL作成
            $base_url = 'https://script.google.com/macros/s/AKfycbyLYVprVk8A7oFTEhQk4zYHMRP6ADN3Mxz2iY-5KM8oS09hrRGA/exec';

            // パラメータ組み立て
            if($language_type_from == "ja") {
                $params_1 = sprintf('?text=%s&source=%s&target=%s', $text, $language_type_from, 'zh');
                $url_1 = $base_url.$params_1;
                $translated_language_1 = "中国語";

                $params_2 = sprintf('?text=%s&source=%s&target=%s', $text, $language_type_from, 'en');
                $url_2 = $base_url.$params_2;
                $translated_language_2 = "英語";
            } else if($language_type_from == "en") {
                $params_1 = sprintf('?text=%s&source=%s&target=%s', $text, $language_type_from, 'zh');
                $url_1 = $base_url.$params_1;
                $translated_language_1 = "中国語";

                $params_2 = sprintf('?text=%s&source=%s&target=%s', $text, $language_type_from, 'ja');
                $url_2 = $base_url.$params_2;
                $translated_language_2 = "日本語";
            } else if($language_type_from == "zh") {
                $params_1 = sprintf('?text=%s&source=%s&target=%s', $text, $language_type_from, 'ja');
                $url_1 = $base_url.$params_1;
                $translated_language_1 = "日本語";

                $params_2 = sprintf('?text=%s&source=%s&target=%s', $text, $language_type_from, 'en');
                $url_2 = $base_url.$params_2;
                $translated_language_2 = "英語";
            }

            // 翻訳API実行
            $client = new Client();
            $result_1 = $client->request("GET", $url_1);
            $result_2 = $client->request("GET", $url_2);

            $posts_1 = $result_1->getBody();
            $posts_2 = $result_2->getBody();
            $posts_1 = json_decode($posts_1, true);
            $posts_2 = json_decode($posts_2, true);       

            if(! is_null($posts_1) && ! is_null($posts_2)) {
                return view('user/index', compact('language_type', 'language_type_from', 'posts_1', 'posts_2', 'translated_language_1', 'translated_language_2'));
                return view('user.layout', compact('language_type', 'language_type_from', 'posts_1', 'posts_2', 'translated_language_1', 'translated_language_2'));
            } else {
                $messages['connection'] = "接続エラー";
                return view('user/index', compact('language_type', 'language_type_from', 'messages'));
                return view('user.layout', compact('language_type', 'language_type_from', 'messages'));
            }

            } else if(is_null($text) && is_null($language_type_from)) {
                $messages = array(
                    'text_and_language' => "言語タイプを選択してキーワードを入力してください。"
                ); 
            } else if(is_null($text)) {
                $messages = array(
                    'text' => "キーワードを入力してください。"
                );            
            } else if(is_null($language_type_from)) {
                $messages = array(
                    'language_type' => "言語タイプを選択してください。"
                ); 
            }
        return view('user/index', compact('language_type', 'messages', 'language_type_from'));
        return view('user.layout', compact('language_type', 'messages', 'language_type_from'));
    }
}