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

<table>
  <tr>
    <th>Item</th>
    <th>Type</th>
    <th>Merk</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Subtotal</th>
  </tr>
  @foreach($detail AS $det)
  <tr>
    <td>{{ $det->item }}</td>
    <td>{{ ($det->type ?? '') }}</td>
    <td>{{ $det->merk }}</td>
    <td>{{ $det->quantity }}</td>
    <td>{{ HelpMe::cost2($det->price) }}</td>
    <td>{{ HelpMe::cost2($det->total) }}</td>
  </tr>
  @php $total = $total+$det->price; @endphp
  @endforeach
  <tr>
    <td colspan="5" align="right">Total:</td>
    <td align="right">{{ HelpMe::cost2($total) }}</td>
  </tr>
</table>

Please reponse this request.

Thank You,<br>
{{ config('app.name') }}
@endcomponent
