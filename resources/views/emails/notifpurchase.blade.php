@php $total = '0'; @endphp
@component('mail::message')
# Request New Tools

We recieved request new tools from:
Name                  : {{ $data->karyawan->name }}
Project               : {{ optional($data->karyawan->project)->name }}
Departemen            : {{ optional($data->karyawan->departemen)->name }}
Position              : {{ optional($data->karyawan->position)->position }}
Assignment Area       : {{ optional($data->karyawan->assignmentarea)->name }}

Request details
@component('mail::table')
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    | Col 2 is      | Centered      | $10      |
    | Col 3 is      | Right-Aligned | $20      |
    @endcomponent

@component('mail::table')
----------------------------------------------------------------------------
| Item | Merk   |   Type    |     Quantity    |   Price     |   Subtotal   |
@foreach($detail AS $det)
----------------------------------------------------------------------------
| {{ $det->item }} | {{ ($det->merk ?? '') }} | {{ $det->type }} | {{ $det->quantity }} | {{ $det->price }} |
----------------------------------------------------------------------------
@php $total = $total+$det->price; @endphp
@endforeach
|                                                 Total      |     {{ $total }}     |
----------------------------------------------------------------------------
@endcomponent
Please reponse this request.

Thank You,<br>
{{ config('app.name') }}
@endcomponent
