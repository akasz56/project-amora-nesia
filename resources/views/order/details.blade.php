<section class="box-frame mb-5">

    <h2 class="position-relative">
        Rincian Pesanan
        <span class="fs-6 position-absolute end-0 bottom-0">{{ $order->orderUUID }}</span>
    </h2>
    <hr>
    {{-- @dump($order->toArray()) --}}

    <section class="row">
        <div class="col-md-6">
            <h3 class="fw-bold">Pembeli</h3>
            <h5>
                {{ $order->user->name }}
                <span class="fs-6">({{ $order->user->email }})</span>
            </h5>
            <p>{{ $order->user->phone }} {{ $var = $order->user->whatsapp ? ' | ' . $order->user->whatsapp : '' }}
            </p>
        </div>
        <div class="col-md-6">
            <h3 class="fw-bold">Penerima</h3>
            <h5>{{ $order->nameSend }}</h5>
            <p>{{ $order->phone }} {{ $var = $order->whatsapp ? ' | ' . $order->whatsapp : '' }}</p>
            <span class="d-block fw-bold">Alamat Tujuan</span>
            {{ $provinces[$order->provinceID]->name }}, {{ $order->city }},
            {{ $order->address }} {{ $order->postcode }}
            RT : {{ $order->rt }} | RW : {{ $order->rw }}
        </div>
    </section>

    <h3 class="mt-5">Item Pesanan</h3>
    <hr>
    @foreach ($order->orderitems as $item)
        {{-- <a
                href="{{ route('product', ['shopURL' => $item->shop->url, 'prodName' => str_replace(' ', '-', $item->product->name)]) }}">
                {{ $item->product->name }}
            </a>
            from
            <a href="{{ route('shop', ['shopURL' => $item->shop->url]) }}">
                <strong>{{ $item->shop->name }}</strong>
            </a> --}}
        @include('components.product-preview', ['item' => $item->product, 'class' => 'mb-3', 'orderStatus' =>
        $item->statusID, 'role' => 'user'])

        {{-- <div class="row mt-3">
                <div class="col-4">
                    <strong>Flower type</strong> <br>
                    {{ $item->product_type->name }}<br>
                    Warna : {{ $item->product_type->color }}
                </div>
                <div class="col-4">
                    <strong>Flower wrap</strong> <br>
                    {{ $item->product_wrap->name }}<br>
                    Warna : {{ $item->product_wrap->color }}
                </div>
                <div class="col-4">
                    <strong>Flower size</strong> <br>
                    {{ $item->product_size->name }}<br>
                    Jumlah Bunga : {{ $item->product_size->flower_amount }}
                </div>
            </div> --}}
    @endforeach
</section>
