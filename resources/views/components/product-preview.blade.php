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
                    {{-- @if (isset($cart))
                        <br> {{ $cart->type->name }} | {{ $cart->wrap->name }} | {{ $cart->size->name }}
                        <br> extras : no
                    @endif --}}

                    {{-- Statuses --}}
                    @if (isset($orderStatus) && isset($role))

                        @if ($role == 'user')
                            @if ($orderStatus == 1)
                                <div class="alert alert-primary">Menunggu Pembayaran</div>
                            @elseif ($orderStatus == 2)
                                <div class="alert alert-primary">Menunggu Diproses</div>
                            @elseif ($orderStatus == 3)
                                <div class="alert alert-primary">Menunggu Dikirim</div>
                            @elseif ($orderStatus == 4)
                                <form action="{{ route('order.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="uuid" value="{{ $order->orderUUID }}">
                                    <button type="submit" name="status" value="done" class="btn btn-primary">Pesanan
                                        sudah Sampai</button>
                                </form>
                            @elseif ($orderStatus == 5)
                                <div class="alert alert-success">Pesanan Selesai</div>
                            @endif

                        @elseif ($role == 'shop')
                            @if ($orderStatus < 4)
                                <form action="{{ route('shop.orderAction', ['uuid' => $order->orderUUID]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="orderItemID" value="{{ $orderItemID }}">
                                    @if ($orderStatus == 1)
                                        <div class="alert alert-primary">Menunggu Pembayaran</div>
                                    @elseif ($orderStatus == 2)
                                        <button type="submit" name="statusID" value="3" class="btn btn-primary">Proses
                                            Pesanan</button>
                                    @elseif ($orderStatus == 3)
                                        <button type="submit" name="statusID" value="4" class="btn btn-primary">Kirim
                                            Pesanan</button>
                                    @endif
                                    <button type="submit" name="statusID" value="10" class="btn btn-danger"
                                        onclick="return confirm('Yakin utk membatalkan pesanan?')">Batalkan
                                        Pesanan</button>
                                </form>
                            @else
                                @if ($orderStatus == 4)
                                    <div class="alert alert-success">Produk dalam Perjalanan</div>
                                @elseif ($orderStatus == 5)
                                    <div class="alert alert-success">Pesanan Selesai</div>
                                @elseif ($orderStatus == 10)
                                    <div class="alert alert-danger">Pesanan dibatalkan</div>
                                @endif
                            @endif
                        @endif
                    @endif
                </p>
            </div>
        </div>
    </div>
</a>
