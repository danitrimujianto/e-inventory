@php $total = '0'; @endphp
@component('mail::message')
# Request New Tool

We recieved request new tools from:
<br>
<table width="100%" class="table">
  <tr>
    <td width="40%">Name</td>
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
Request detail
<br>
<table width="100%" class="table">
  <tr>
    <td width="40%">Purchase Nomor</td>
    <td width="1%">:</td>
    <td>{{ $data->pr_no }}</td>
  </tr>
  <tr>
    <td>Due Date</td>
    <td>:</td>
    <td>{{ HelpMe::tgl_sql_to_indo($data->tanggal) }}</td>
  </tr>
  <tr>
    <td>Description</td>
    <td>:</td>
    <td><?php echo $data->description; ?></td>
  </tr>
</table>
<br>
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
  @php $total = $total+$det->total; @endphp
  @endforeach
  <tr>
    <td colspan="5" align="right">Total:</td>
    <td align="right">{{ HelpMe::cost2($total) }}</td>
  </tr>
</table>
<br><br>
Please reponse this request.
@component('mail::button', ['url' => $url])
Response Request
@endcomponent
<br>
Thank You,<br>
{{ config('app.name') }}
@endcomponent
