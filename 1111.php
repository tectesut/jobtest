<!-- 通知機能 -->
-----ダッシュボード商品登録されたら、１日まで表示次日には削除自動で表示
use App\Notifications\NewProductNotification;
use App\Models\User; // User モデルを追加

// 通知機能 ItemController
        public function store(Request $request)
        {
            // 商品登録処理...
        
            // 商品がデータベースに保存された後に通知を送信
            $usersToNotify = User::all();
            Notification::send($usersToNotify, new NewProductNotification());
        
            // リダイレクトや他の処理...
            return redirect('/items')->with('success', '商品が登録されました。');
        }
        public function markAsRead()
        {
            Auth::user()->unreadNotifications->markAsRead();
        }

-----
 <-- 通知用 商品登録追加-> -->index.blade.php
    @foreach (Auth::user()->unreadNotifications as $notification)
    <div class="alert alert-info">
        <strong>{{ $notification->data['title'] }}</strong>
        <p>{{ $notification->data['message'] }}</p>
        <a href="{{ $notification->data['link'] }}">詳細を見る</a>
    </div>
    @endforeach

------
ItemController
    public function store(Request $request)
{
    // 商品登録処理...

    // 新着商品通知を送信
    auth()->user()->notify(new NewProductNotification($product));

    // リダイレクトや他の処理...

    return redirect('/items')->with('success', '商品が登録されました。');
}


use App\Notifications\NewProductNotification;