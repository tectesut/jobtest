@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>

    <br>
    <sidebar> 
    <!-- エクセルにエクスポート 複数講師に聞いてもできなかったため一旦アウト-->
    <button type="button" class="btn btn-success" onclick="####">エクセルにエクスポート</button>

    <!-- 印刷ボタン -->
    <button type="button" class="btn btn-info" onclick="printTable()">印刷</button>
    </sidebar> 
    <br>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">商品一覧</h3>

                <!-- 新しく追加 検索機能 -->
                <br>
                <div class="search-area">
                    <form class="d-flex" role="search" action="{{ route('item.search') }}" method="get">
                        <input class="" type="search" placeholder="キーワード検索" aria-label="Search" name="search">
                        <button class="btn btn-outline-success" type="submit">検索</button>
                    </form>
                </div>

                
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append">
                            <a href="{{ url('items/add') }}" class="btn btn-secondary btn btn-primary btn-lg">商品登録</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-container" style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-bordered border-dark" id="excelTable" class="table table-bordered border-dark">
                    <thead>
                        <tr class="table table-primary text-center">
                            <th>ID</th>
                            <th>商品名</th>
                            <th>画像</th> <!-- 新しく追加 -->
                            <th>カテゴリ</th>
                            <th>詳細</th>
                            <th>操作</th> <!-- 新しく追加 -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if($item->image_path)
                                <img src="{{ asset('item_images/' . $item->image_path) }}" alt="商品画像" width="50" height="50">
                                @else
                                    画像なし
                                @endif
                                <a href="{{url('/images/"><span>ハート</span></a>
                            </td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->detail }}</td>
                            <td>
                                <!-- 新しく追加 編集ボタン -->
                                <a href="{{ url('/items/' . $item->id . '/edit') }}" class="btn btn-primary" onclick="return confirm('編集していいでしょうか？')">編集</a> 
                                <!-- 新しく追加 削除ボタン -->
                                <form action="{{ url('/items/delete/' . $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                                </form>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // ↓印刷用
    function printTable() {
    window.print();
    }
</script>
@stop

@section('css')

@stop

@section('js')

@stop
