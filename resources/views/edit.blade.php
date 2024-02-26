@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($item))
            <h2>編集更新画面</h2>
            <div class="card card-primary">
                <form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input type="text" name="id" class="form-control" value="{{ $item->id }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="name">商品名</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
                    </div>

                    <!-- 画像アップロード用のフォームフィールドを追加 -->
                    <div class="form-group">
                        <label for="image">商品画像</label>
                        <input type="file" name="image" id="image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="type">カテゴリ</label>
                        <input type="text" name="type" class="form-control" value="{{ old('type', $item->type) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <textarea name="detail" class="form-control" required>{{ old('detail', $item->detail) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" onclick="return confirm('更新していいでしょうか？')">更 新</button>
                </form>
            </div>
        @else
            <h1>商品登録</h1>
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-primary">
                        <form method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">商品名</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="商品名">
                                </div>

                                <div class="form-group">
                                    <label for="image">商品画像</label>
                                    <input type="file" name="image" id="image" accept="image/*">
                                </div>

                                <div class="form-group">
                                    <label for="type">カテゴリ</label>
                                    <input type="text" class="form-control" id="type" name="type" placeholder="カテゴリ">
                                </div>

                                <div class="form-group">
                                    <label for="detail">詳細</label>
                                    <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">登録</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection