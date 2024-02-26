<!--いいね！画像つける。 -->
database/migrations ディレクトリ内の create_likes_table.php
public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('image_id');
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('images');
        });
    }
------------------------------
Model  Like

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}

--------------------------
ItemController
// いいね！画像入れる方法
    public function likeImage(Request $request, $imageId)
    {
        $user = Auth::user();
        $image = Image::find($imageId);
    
        $like = $user->likes()->where('image_id', $imageId)->first();
    
        if ($like) {
            // すでにいいね！している場合、取り消す
            $like->delete();
        } else {
            // いいね！していない場合、新しいいいね！を作成
            $user->likes()->create(['image_id' => $imageId]);
        }
    
        return redirect()->back();
    }

    -----------------------------
    ルーティング
    // 画像いいね！
    Route::post('/images/{imageId}/like', [App\Http\Controllers\ItemController::class, 'likeImage'])->name('images.like');




    @if(Auth::check())
    @if($image->isLikedBy(Auth::user()))
        <form action="{{ route('images.like', $image->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">いいね！取り消し</button>
        </form>
    @else
        <form action="{{ route('images.like', $image->id) }}" method="POST">
            @csrf
            <button type="submit">いいね！</button>
        </form>
    @endif
@endif
------index.blade.php
