<section>

    <h3 class="mt-5">Details</h3>
    @dump($order->toArray())
    <p>{{ $order->orderUUID }}</p>
    <p><strong>Invoice ID :</strong> {{ $order->invoiceID }}</p>

    <h3 class="mt-5">Pembeli</h3>
    <hr>
    <p><strong>Nama :</strong> {{ $order->user->name }}</p>
    <p><strong>Email :</strong> {{ $order->user->email }}</p>
    <p><strong>Phone :</strong> {{ $order->user->phone }}</p>
    <p><strong>Whatsapp :</strong> {{ $order->user->whatsapp }}</p>

    <h3 class="mt-5">Item Pesanan</h3>
    <hr>
    @foreach ($order->orderitems as $item)
        <section class="border border-primary border-1 p-3">
            <a
                href="{{ route('product', ['shopURL' => $item->shop->url, 'prodName' => str_replace(' ', '-', $item->product->name)]) }}">
                {{ $item->product->name }}
            </a>
            from
            <a href="{{ route('shop', ['shopURL' => $item->shop->url]) }}">
                <strong>{{ $item->shop->name }}</strong>
            </a>

            <div class="row mt-3">
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
            </div>

            @if ($item->statusID == 4)
                <form action="{{ route('order.update') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="uuid" value="{{ $order->orderUUID }}">
                    <button type="submit" name="status" value="done" class="btn btn-primary">Pesanan sudah
                        Sampai</button>
                </form>

            @elseif ($item->statusID == 5)
                <h5 class="fw-bold mt-3">Pesanan Selesai</h5>
            @endif
        </section>
    @endforeach
</section>
