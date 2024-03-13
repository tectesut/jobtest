@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<div class="d-flex justify-content-between">
        <h1>商品一覧</h1>
        <div>
            <p>{{ date('Y年m月d日') }}</p>
            <p class="align-right">{{ getJapaneseDayOfWeek(date('N')) }}</p>
        </div>
</div>

    <br>
    <sidebar> 
    <!-- エクセルにエクスポート -->								
    <button type="button" class="btn btn-success" onclick="exportToExcel()">エクセルにエクスポート</button>								

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

                <!-- 追加 検索機能 -->
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
                            <th>画像</th> <!-- 追加 -->
                            <th>カテゴリ</th>
                            <th>詳細</th>
                            <th>操作</th> <!-- 追加 -->
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
                            </td>

                            <td>{{ $item->type }}</td>
                            <td>{{ $item->detail }}</td>
                            <td>
                                <!-- 追加 編集ボタン -->
                                <a href="{{ url('/items/' . $item->id . '/edit') }}" class="btn btn-primary" onclick="return confirm('編集していいでしょうか？')">編集</a> 
                                <!-- 追加 削除ボタン -->
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
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>								

<script>
    // ↓印刷用
    function printTable() {
    window.print();
    }
</script>

<script>
    // ↓エクセルエクスポート
function exportToExcel() {				
    var table = document.getElementById("excelTable");				
    var data = XLSX.utils.table_to_sheet(table);				
    var wb = XLSX.utils.book_new();				
    XLSX.utils.book_append_sheet(wb, data, "Sheet1");				
    XLSX.writeFile(wb, 'exported_data.xlsx');				
    }				
				

</script>
{{-- ページネーション --}}
        @if ($items->hasPages())
            <div class="card-footer clearfix">
                {{ $items->links('pagination::bootstrap-5') }}
            </div>
        @endif

@stop

@section('css')

@stop

@section('js')
<!-- SheetJS Library -->	
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>	

@stop

@php
    function getJapaneseDayOfWeek($dayNumber) {
        $dayOfWeek = [
            '1' => '月曜日',
            '2' => '火曜日',
            '3' => '水曜日',
            '4' => '木曜日',
            '5' => '金曜日',
            '6' => '土曜日',
            '7' => '日曜日',
        ];

        return $dayOfWeek[$dayNumber] ?? '';
    }
@endphp