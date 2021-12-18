@extends('layouts.app')

@section('title', 'Confirm Order - Amora Store')

@section('content')
    <main class="container">
        <form action="{{ route('order.create') }}" method="POST" class="mt-5">
            @csrf
            @if (isset($fromCart))
                <input type="hidden" name="fromCart" value="true">
            @endif

            {{-- OrderInfo --}}
            <h2>Checkout {{ $basket->count() }} Pesanan</h2>
            <hr>

            <section class="row">
                <div class="col-md-6">
                    <?php $i = 1;
                    $subtotal = 0; ?>
                    @foreach ($basket as $item)
                        @include('components.product-preview', ['item' => $item->product, 'cart' => $item, 'class' =>
                        'mb-3'])
                        <input type="hidden" name="{{ 'productID-' . $i }}" value="{{ $item->product->id }}">
                        {{-- <input type="hidden" name="{{ 'typeID-' . $i }}" value="{{ $item->type->id }}">
                        <input type="hidden" name="{{ 'wrapID-' . $i }}" value="{{ $item->wrap->id }}">
                        <input type="hidden" name="{{ 'sizeID-' . $i }}" value="{{ $item->size->id }}"> --}}
                        <?php $i++; ?>
                        <?php $subtotal += $item->product->price; ?>
                    @endforeach
                </div>
                <div class="col-md-6">
                    <label for="nameSend" class="form-label mt-2 form-required">Nama Tujuan</label>
                    <input type="text" class="form-control" id="nameSend" name="nameSend" required>
                    @error('nameSend')<small class="text-danger">{{ $message }}</small>@enderror

                    <label for="phone" class="form-label mt-2 form-required">Nomor Telepon</label>
                    <input type="number" class="form-control" id="phone" name="phone" required>
                    @error('phone')<small class="text-danger">{{ $message }}</small>@enderror

                    <label for="whatsapp" class="form-label mt-2">Nomor Whatsapp</label>
                    <input type="number" class="form-control" id="whatsapp" name="whatsapp">
                    @error('whatsapp')<small class="text-danger">{{ $message }}</small>@enderror

                </div>
            </section>

            {{-- Pengiriman --}}
            <section class="box-frame">
                <h2 class="fw-bold">Pengiriman</h2>
                <hr>

                {{-- Pengiriman Address --}}
                <h4>Alamat Pengiriman</h4>
                <input type="checkbox" name="sendToAcc" id="sendToAcc" value="true" onclick="showAddressForm()">
                <label for="sendToAcc">Kirim ke Alamat Pengguna</label><br>
                <div id="addressForm">
                    <div class="my-3 row">
                        <div class="col-6">
                            <label for="provinceID" class="form-label form-required">Provinsi</label>
                            <select class="form-select" id="provinceID" name="provinceID">
                                <option value="" hidden>Pilih satu</option>
                                @foreach ($provinces as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('provinceID')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-6">
                            <label for="city" class="form-label form-required">Kota</label>
                            <input type="text" class="form-control" id="city" name="city">
                            @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="rw" class="form-label form-required">RW</label>
                            <input type="number" class="form-control" id="rw" name="rw">
                            @error('rw')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-6">
                            <label for="rt" class="form-label form-required">RT</label>
                            <input type="number" class="form-control" id="rt" name="rt">
                            @error('rt')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-8">
                            <label for="address" class="form-label form-required">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address">
                            @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-4">
                            <label for="postcode" class="form-label form-required">Kode Pos</label>
                            <input type="number" class="form-control" id="postcode" name="postcode">
                            @error('postcode')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                </div>

                {{-- Pengiriman Method --}}
                <h4 class="mt-3">Metode Pengiriman</h4>
                <input type="radio" name="pengiriman" value="1" id="pengiriman1" required>
                <label for="pengiriman1">Instant Kurir</label><br>
                <input type="radio" name="pengiriman" value="2" id="pengiriman2">
                <label for="pengiriman2">Pengiriman Agen</label><br>
                <input type="radio" name="pengiriman" value="3" id="pengiriman3">
                <label for="pengiriman3">COD</label><br>
            </section>

            {{-- Pembayaran --}}
            <section class="box-frame">
                <h2 class="fw-bold">Pembayaran</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label for="promo">Promo code</label>
                        <input type="text" name="promo" id="promo">
                    </div>
                    <div class="col-md-6 position-relative">
                        <p>Subtotal Produk:<span class="position-absolute end-0 font-monospace">
                                Rp{{ number_format($subtotal) }}
                            </span>
                        </p>
                        <p>Total Ongkos Kirim:<span class="position-absolute end-0 font-monospace">
                                Rp{{ number_format($ongkir = 0) }}
                            </span> </p>
                        <p>Total Tagihan:<span class="position-absolute end-0 font-monospace fw-bold fs-4">
                                Rp{{ number_format($subtotal + $ongkir) }}
                            </span>
                        </p>
                    </div>
                </div>

                <input type="hidden" name="grandtotal" value="{{ $subtotal + $ongkir }}">
                <button type="submit" class="btn btn-primary p-3 w-100 my-5">Bayar</button>
            </section>
        </form>

        <script>
            function showAddressForm() {
                if (document.getElementById('sendToAcc').checked) {
                    document.getElementById('addressForm').style.display = "none";
                    document.getElementsByClassName('form-label').setAttribute("required", "required");
                } else {
                    document.getElementById('addressForm').style.display = "block";
                    document.getElementsByClassName('form-label').removeAttribute("required");
                }
            }

            function togglePayment(btn) {
                let button = document.getElementById(btn);
                let box = document.getElementById(btn.concat('Info'));

                box.style.display = (button.checked) ? 'block' : 'none';
            }
        </script>
    </main>
@endsection
