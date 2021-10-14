<a class="card text-decoration-none text-reset btn btn-light p-0 {{ $var = isset($class) ? $class : '' }}"
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
                <h3 class="card-title text-start fw-bold">
                    {{ $var = strlen($item->name) > (isset($titleLen) ? $titleLen : 25) ? substr($item->name, 0, isset($titleLen) ? $titleLen : 25) . '...' : $item->name }}
                </h3>
                <p class="card-text text-start">
                    {{ $var = strlen($item->description) > (isset($descLen) ? $descLen : 50) ? substr($item->description, 0, isset($descLen) ? $descLen : 50) . '...' : $item->description }}
                    @if (isset($cart))
                        <br> {{ $cart->type->name }} | {{ $cart->wrap->name }} | {{ $cart->size->name }}
                        <br> extras : no
                    @endif
                </p>
            </div>
        </div>
    </div>
</a>
