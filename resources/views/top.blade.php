<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <title>ポートフォリオ</title>
  </head>
  <body>
    <div class="contents">
      <h2 class="title"></h2>
      <dl class="accordion js-accordion">
          <div class="accordion_item js-accordion-trigger">
            <dt class="accordion_title">Profile</dt>
            <dd class="accordion_contents">
              <img class="introduce_img" src="{{ asset('img/introduce.jpg') }}" alt="プロフィール画像"><br>
              Hoshino Misaki<br>
              <br>
              2018年からシステムサポート業務に携わりながらプログラミングを学び、2019年にプロジェクトへ初参画しました。<br>
              直近ではCakePHP、JavaScriptを使って企業様向けの業務ツールを開発しているバックエンドエンジニアです。<br>
            </dd>
          </div>

          <div class="accordion_item js-accordion-trigger">
            <dt class="accordion_title">Skills</dt>
            <dd class="accordion_contents">
              <h3 class="item">フロントエンド</h3>
              <li>HTML</li>
              <li>CSS</li>
              <li>JavaScript</li>
              <br>

              <h3 class="item">バックエンド</h3>
              <li>PHP</li>
              <li>Laravel</li>
              <li>CakePHP</li>
              <br>

              <h3 class="item">環境</h3>
              <li>Linux</li>
              <li>Apache</li>
              <li>MySQL</li>
              <li>PostgreSQL</li>
              <li>Oracle</li>
            </dd>
          </div>

          <div class="accordion_item js-accordion-trigger">
            <dt class="accordion_title">Portfolio</dt>
            <dd class="accordion_contents">
              <span>
                <section>
                  <a href="{{ route('user.index') }}" class="portfolio_link" target="_blank" rel="noopener noreferrer">
                    中国語学習用 翻訳ツール
                  </a>
                </section>
                <h3 class="item">開発環境</h3>
                <li>CentOS</li>
                <li>Vagrant</li>
                <li>Apache</li>
                <li>MySQL</li>
                <br>

                <h3 class="item">使用言語</h3>
                <li>Laravel</li>
                <li>JavaScript</li>
                <li>HTML</li>
                <li>CSS</li>
                <br>

                <h3 class="item">実装機能</h3>
                <p>- ユーザー画面</p>
                <li>翻訳機能(翻訳APIはGoogle Apps Scriptで自作)</li>
                <li>記事一覧表示</li>
                <li>記事詳細表示</li>
                <li>記事検索</li>

                <p>- 管理画面</p>
                <li>ログイン機能</li>
                <li>記事投稿</li>
                <li>記事編集・削除</li>
                <li>記事一覧表示</li>

              </span>
              <br>
              <!-- <span>
                <a href="/hp" target="_blank" rel="noopener noreferrer" style="font-weight: bold;">ホットペッパーお店検索</a>
                <p>開発環境</p>
                <li>CentOS</li>
                <li>Vagrant</li>
                <li>Apache</li>
                <li>MySQL</li>
                <br>

                <p>使用言語<p>
                <li>Laravel</li>
                <li>JavaScript</li>
                <li>HTML</li>
                <li>CSS</li>
              </span> -->
            </dd>
          </div>
        </dl>
      <script type="text/javascript" src="{{ asset('/js/custom.js') }}"></script>
    </div>
  </body>
</html>
