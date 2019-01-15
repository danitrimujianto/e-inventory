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
| Item       | Type         | Merk  | Quantity  | Price  | Subtotal |
| -----------|:------------:|:-----:|:---------:|:------:|:--------:|
@foreach($detail AS $det)
| Col 2 is      | Centered      | $10      |
| -----------|:------------:|:-----:|:---------:|:------:|:--------:|
| {{ $det->item }} | {{ ($det->type ?? '') }} | {{ $det->merk }} | {{ $det->quantity }} | {{ HelpMe::cost2($det->price) }} |
| -----------|:------------:|:-----:|:---------:|:------:|:--------:|
@php $total = $total+$det->price; @endphp
@endforeach
|                                 Total      |     {{ HelpMe::cost2($total) }}     |
| -----------|:------------:|:-----:|:---------:|:------:|:--------:|
@endcomponent

Please reponse this request.

Thank You,<br>
{{ config('app.name') }}
@endcomponent
