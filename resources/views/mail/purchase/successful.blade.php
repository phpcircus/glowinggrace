@component('mail::message')
# Thank you for your support

@component('mail::panel')
Your purchase from Team Kimbelryn was successful.<br><br>
{{ $deliveryLineOne }}<br>
{{ $deliveryLineTwo }}
@endcomponent

@component('mail::table')
| Size       | Quantity      | Price Each  | Total       |
|:----------:|:-------------:|:-----------:|:-----------:|
@foreach($lineItems as $item)
| {{ $item->size->slug }}     | {{ $item->quantity }} | ${{ $item->size->price/100 }} | ${{ $item->total/100 }} |
@endforeach
@endcomponent

@component('mail::panel')
Total: {{ $total }}<br>
@if($method === 'shipped')
Your total includes $5 for shipping.
@endif
@endcomponent

Thanks again,<br>
{{ config('app.name') }}
@endcomponent
