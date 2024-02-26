
CSSどうすればうごくか？

---------------------
表示件数なるか？
/index.blade.php

                <!-- 新しく追加   ページネーション機能 -->
                <div class="display-right">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($items->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $items->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($items as $item)
                <li class="page-item{{ $item->currentPage() == $item->url($item->currentPage()) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $item->url($item->currentPage()) }}">{{ $item->currentPage() }}</a>
                </li>
            @endforeach

            <!-- Next Page Link -->
            @if ($items->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $items->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
</div>



----------------
app/Http/Controllers/ItemController.php

public function index()
    {
        // 商品一覧取得
        $items = Item::all();


        $items = Item::paginate(10); // 1ページあたりのアイテム数はここで指定
        return view('item.index', compact('items'));

    }