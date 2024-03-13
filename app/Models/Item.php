<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'image_path', // 画像ファイルのパスを保存するためのカラム
        'type',
        'detail',
        'options',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

       // ここに画像アップロードの処理を追加する
    public function uploadImage($image)
    {
        // 画像を保存する処理
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('item_images'), $imageName);

        // データベースに画像のパスを保存
        $this->update([
            'image_path' => $imageName,
        ]);
    }
    public function index()
    {
    $items = Item::paginate(5); // 5件ずつページネーションする例
    return view('item.index', compact('items'));
    }
}
