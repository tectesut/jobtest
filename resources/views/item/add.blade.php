@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

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
                            <label for="options">オプション</label>
                            <select class="form-control" id="options" name="options" multiple>
                                <!-- オプションの選択肢を動的に生成する場合、適切な方法でデータを取得してループ処理する -->
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                            </select>
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
@stop

@section('css')
@stop

@section('js')
@stop
