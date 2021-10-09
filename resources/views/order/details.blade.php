<section>
    <h3>Details</h3>
    @dump($order->toArray())
    <p>{{ $order->orderUUID }}</p>
    <p><strong>Invoice ID :</strong> {{ $order->invoiceID }}</p>
    <h3>Pembeli</h3>
    <hr>
    <p><strong>Nama :</strong> {{ $order->user->name }}</p>
    <p><strong>Email :</strong> {{ $order->user->email }}</p>
    <p><strong>Phone :</strong> {{ $order->user->phone }}</p>
    <p><strong>Whatsapp :</strong> {{ $order->user->whatsapp }}</p>
</section>
