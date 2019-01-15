@php $total = ''; @endphp
@component('mail::message')
# Request New Tools

We recieved request new tools from:
Name                  : {{ $data->karyawan->name }}
Project               : {{ optional($data->karyawan->project)->name }}
Departemen            : {{ optional($data->karyawan->departemen)->name }}
Position              : {{ optional($data->karyawan->position)->position }}
Assignment Area       : {{ optional($data->karyawan->assignmentarea)->name }}

Request details
----------------------------------------------------------------------------
| Item | Merk   |   Type    |     Quantity    |   Price     |   Subtotal   |
@component('mail::table')
@foreach($detail AS $det)
----------------------------------------------------------------------------
| {{ $det->item }} | {{ $det->merk }} | {{ $det->type }} | {{ $det->quantity }} | {{ $det->price }} |
----------------------------------------------------------------------------
@php $total = $total+$det->price; @endphp
@endforeach
@endcomponent
|                                                 Total      |     {{ $$total }}     |
----------------------------------------------------------------------------
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
