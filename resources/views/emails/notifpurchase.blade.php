@php $total = '0'; @endphp
@component('mail::message')
# Request New Tools

We recieved request new tools from:
<br>
<table width="100%" class="table">
  <tr>
    <td width="20%">Name</td>
    <td width="1%">:</td>
    <td>{{ $data->karyawan->name }}</td>
  </tr>
  <tr>
    <td>Project</td>
    <td>:</td>
    <td>{{ optional($data->karyawan->project)->name }}</td>
  </tr>
  <tr>
    <td>Departemen</td>
    <td>:</td>
    <td>{{ optional($data->karyawan->departemen)->name }}</td>
  </tr>
  <tr>
    <td>Position</td>
    <td>:</td>
    <td>{{ optional($data->karyawan->position)->position }}</td>
  </tr>
  <tr>
    <td>Assignment Area</td>
    <td>:</td>
    <td>{{ optional($data->karyawan->assignmentarea)->name }}</td>
  </tr>
</table>
<br>
Request details
<br>
<table class="table"  width="100%">
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
