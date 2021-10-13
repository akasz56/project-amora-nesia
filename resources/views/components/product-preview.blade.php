<a class="card mb-3 text-decoration-none text-reset btn btn-light p-0 "
    href="{{ route('product', ['shopURL' => $item->shop->url, 'prodName' => str_replace(' ', '-', $item->name)]) }}">
    <div class="row g-0">
        @if ($item->photos->isNotEmpty())
            <div class="col-md-4">
                <img class="img-fluid rounded-start" src={{ asset($item->photos->first()->blob) }}
                    alt="{{ $item->name }} thumbnail">
            </div>
        @else
            <div class="col-md-4 position-relative p-3">
                <span class="position-absolute top-50 start-50 translate-middle w-100">Tidak ada gambar</span>
            </div>
        @endif
        <div class="col-md-8">
            <div class="card-body">
                <h3 class="card-title text-start fw-bold">{{ $item->name }}</h3>
                <p class="card-text text-start">{{ substr($item->description, 0, 50) . '...' }}</p>
            </div>
        </div>
    </div>
</a>
