@extends('layouts.app')

@section('title', 'Confirm Order - Amora Store')

@section('content')
    <main class="container">
        <form action="{{ route('order.create') }}" method="POST" class="mt-5">
            @csrf

            {{-- OrderInfo --}}
            <h2>Konfirmasi {{ $basket->count() }} Pesanan</h2>
            <hr>

            <?php $i = 1; ?>
            @foreach ($basket as $item)
                @include('components.product-preview', ['item' => $item->product, 'cart' => $item, 'class' => 'mb-3'])
                <input type="hidden" name="{{ 'productID-' . $i }}" value="{{ $item->product->id }}">
                <input type="hidden" name="{{ 'typeID-' . $i }}" value="{{ $item->type->id }}">
                <input type="hidden" name="{{ 'wrapID-' . $i }}" value="{{ $item->wrap->id }}">
                <input type="hidden" name="{{ 'sizeID-' . $i }}" value="{{ $item->size->id }}">
                <?php $i++; ?>
            @endforeach

            <div class="col-6">
                <label for="nameSend" class="form-label mt-2 form-required">Nama Tujuan / Untuk siapa?</label>
                <input type="text" class="form-control" id="nameSend" name="nameSend" required>
                @error('nameSend')<small class="text-danger">{{ $message }}</small>@enderror

                <label for="phone" class="form-label mt-2 form-required">Nomor Telepon</label>
                <input type="number" class="form-control" id="phone" name="phone" required>
                @error('phone')<small class="text-danger">{{ $message }}</small>@enderror

                <label for="whatsapp" class="form-label mt-2">Nomor Whatsapp</label>
                <input type="number" class="form-control" id="whatsapp" name="whatsapp">
                @error('whatsapp')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            {{-- Promo Code --}}
            <h2 class="mt-5">Promo code</h2>
            <hr>
            <label for="promo">Promo code</label>
            <input type="text" name="promo" id="promo">

            {{-- Payment --}}
            <h2 class="mt-5">Pembayaran</h2>
            <hr>
            @foreach ($payment as $item)
                <input type="radio" name="payment" value="{{ $item->id }}" id="{{ $item->name }}"
                    onclick="togglePayment('{{ $item->name }}')" required>
                <label for="{{ $item->name }}">{{ $item->name }}</label><br>
                <div class="card" id="{{ $item->name . 'Info' }}" style="display: none">
                    <div class="card-body">
                        <p>{{ $item->noRek }}</p>
                        <p>{{ $item->namaRek }}</p>
                        <p>{{ $item->desc }}</p>
                    </div>
                </div>
            @endforeach

            {{-- Pengiriman --}}
            <h2 class="mt-5">Pengiriman</h2>
            <hr>

            {{-- Pengiriman Address --}}
            <h4>Alamat Pengiriman</h4>
            <input type="checkbox" name="sendToAcc" id="sendToAcc" value="true" onclick="showAddressForm()">
            <label for="sendToAcc">Kirim ke Alamat Pengguna</label><br>
            <div id="addressForm">
                <div class="my-3 row">
                    <div class="col-6">
                        <label for="provinceID" class="form-label">Provinsi</label>
                        <select class="form-select" id="provinceID" id="provinceID" name="provinceID">
                            <option value="" hidden>Pilih satu</option>
                            @foreach ($provinces as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('provinceID')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-6">
                        <label for="city" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="city" name="city">
                        @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-6">
                        <label for="rw" class="form-label">RW</label>
                        <input type="number" class="form-control" id="rw" name="rw">
                        @error('rw')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-6">
                        <label for="rt" class="form-label">RT</label>
                        <input type="number" class="form-control" id="rt" name="rt">
                        @error('rt')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-8">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address">
                        @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-4">
                        <label for="postcode" class="form-label">Kode Pos</label>
                        <input type="number" class="form-control" id="postcode" name="postcode">
                        @error('postcode')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>

            {{-- Pengiriman Method --}}
            <h4>Metode Pengiriman</h4>
            <input type="radio" name="pengiriman" value="1" id="pengiriman1" required>
            <label for="pengiriman1">Instant Kurir</label><br>
            <input type="radio" name="pengiriman" value="2" id="pengiriman2">
            <label for="pengiriman2">Pengiriman Agen</label><br>
            <input type="radio" name="pengiriman" value="3" id="pengiriman3">
            <label for="pengiriman3">COD</label><br>

            <button type="submit" class="btn btn-primary p-3 w-100 my-5">Lanjutkan</button>
        </form>

        <script>
            function showAddressForm() {
                document.getElementById('addressForm').style.display = (document.getElementById('sendToAcc').checked) ? "none" :
                    "block";
            }

            function togglePayment(btn) {
                let button = document.getElementById(btn);
                let box = document.getElementById(btn.concat('Info'));

                box.style.display = (button.checked) ? 'block' : 'none';
            }
        </script>
    </main>
@endsection
