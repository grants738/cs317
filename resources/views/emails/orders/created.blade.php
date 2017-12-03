@component('mail::message')
# Order Received
Hi, {{$order->customer->name}}

Your order has been placed!

You can review you order by clicking the button below.

@component('mail::button', ['url' => route('order.show', ['hash' => $order->hash])])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
