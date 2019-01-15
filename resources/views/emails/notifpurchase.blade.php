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

<table width="100%" border="1">
  <tr>
    <th>Item</th>
    <th>Type</th>
    <th>Merk</th>
    <th align="center">Quantity</th>
    <th align="right">Price</th>
    <th align="right">Subtotal</th>
  </tr>
  @foreach($detail AS $det)
  <tr>
    <td>{{ $det->item }}</td>
    <td>{{ ($det->type ?? '') }}</td>
    <td>{{ $det->merk }}</td>
    <td align="center">{{ $det->quantity }}</td>
    <td align="right">{{ HelpMe::cost2($det->price) }}</td>
    <td align="right">{{ HelpMe::cost2($det->total) }}</td>
  </tr>
  @php $total = $total+$det->price; @endphp
  @endforeach
  <tr>
    <td colspan="5" align="right">Total:</td>
    <td align="right">{{ HelpMe::cost2($total) }}</td>
  </tr>
</table>
<br><br>
Please reponse this request.

Thank You,<br>
{{ config('app.name') }}
@endcomponent
