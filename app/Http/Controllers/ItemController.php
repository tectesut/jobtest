<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

////↓追加
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        // $items = Item::all();
        // return view('item.index', compact('items'));

        // ページネーション
        $items = Item::paginate(5);

        return view(
        'item.index',
        ['items' => $items]
        );
        
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => '商品名は必ず指定してください。',
            'type.required' => 'カテゴリは必ず指定してください。',
            'detail.required' => '詳細は必ず指定してください。',
            'image.image' => '画像には画像ファイルを指定してください。',
            'image.mimes' => '画像にはjpeg, png, jpg, gif, svgタイプのファイルを指定してください。',
            'image.max' => '画像のサイズは2048KB以下にしてください。',
        ]);

        // 商品登録
        $item = Item::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'type' => $request->type,
            'detail' => $request->detail,
            'image_path' => null,
        ]);

        // 画像の更新処理
        if ($request->hasFile('image')) {
            $this->uploadImage($request->file('image'), $item);
        }
        return redirect('/items');
        }
        return view('item.add');
    }

        // 新しく追加 削除機能と検索機能と画像、編集機能下記
    public function destroy(Item $item) // 削除機能追加
    {
        $item->delete();
    return redirect('/items')->with('success', '商品が削除されました。'); 
    }

    public function search(Request $request)
    {
        $query = Item::query();
        if ($request->filled('search')) {
        $query->where('name', 'LIKE', '%' . $request->search . '%');
            // 他のフィールドも必要に応じて追加
        }
            $items = $query->paginate(5); // クエリを実行して結果を取得

            return view('item.index', compact('items'));
    }

    public function edit(Item $item) //編集 edit
    {
        return view('edit', compact('item')); // 編集フォームのビューを表示
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // その他のデータを更新
        $item->update([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'detail' => $validatedData['detail'],
        ]);
        // 画像の更新処理
        if ($request->hasFile('image')) {
        $this->uploadImage($request->file('image'), $item);
        }
        return redirect('/items')->with('success', '商品情報が更新されました。');
    }

    private function uploadImage($image, Item $item)
    {
        // 画像を保存する処理
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('item_images'), $imageName);

        // データベースに画像のパスを保存
        $item->update([
            'image_path' => $imageName,
        ]);
    }

}