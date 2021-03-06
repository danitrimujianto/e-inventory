@php $total = '0'; @endphp
@if($target != 'sender')
@component('mail::message')
# Handover Tool

@if($target != 'reciever')
We recieved handover tool from:
@else
You recieved handover tool from:
@endif
<br>
<table width="100%" class="table">
  <tr>
    <td width="40%">Outgoing Nomor</td>
    <td width="1%">:</td>
    <td>{{ $data->outgoing_no }}</td>
  </tr>
  @if($data->type == 'office')
  <tr>
    <td width="40%">Name</td>
    <td width="1%">:</td>
    <td>Office</td>
  </tr>
  @endif
  @if($data->type == 'user')
  <tr>
    <td width="40%">Name</td>
    <td width="1%">:</td>
    <td>{{ optional($data->sender)->name }}</td>
  </tr>
  <tr>
    <td>Project</td>
    <td>:</td>
    <td>{{ optional($data->sender->project)->name }}</td>
  </tr>
  <tr>
    <td>Departemen</td>
    <td>:</td>
    <td>{{ optional($data->sender->departemen)->name }}</td>
  </tr>
  <tr>
    <td>Position</td>
    <td>:</td>
    <td>{{ optional($data->sender->position)->position }}</td>
  </tr>
  <tr>
    <td>Assignment Area</td>
    <td>:</td>
    <td>{{ optional($data->sender->assignmentarea)->name }}</td>
  </tr>
  @endif
</table>
<br>
@if($target != 'reciever')
To:
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
@endif
List Tools:
<br>
<br>
<table class="table" width="100%">
    <tr>
      <th>Item</th>
      <th>Condition</th>
      <th>Merk</th>
      <th>Type</th>
      <th>Serial Number</th>
      <th>Imei</th>
    </tr>
    <tbody id="listTools">
    @foreach($detail AS $detail)
    <tr>
        <td>{{ optional($detail->tools)->code.' - '.optional($detail->tools)->item }}</td>
        <td>{{ optional($detail->condition)->name }}</td>
        <td>{{ optional($detail->tools)->merk }}</td>
        <td>{{ optional($detail->tools)->type }}</td>
        <td>{{ optional($detail->tools)->serial_number }}</td>
        <td>{{ optional($detail->tools)->imei }}</td>
    </tr>
    @endforeach
    </tbody>
  </table>
<br><br>
Please reponse this handover.
@component('mail::button', ['url' => $url])
Response Handover
@endcomponent
<br>
Thank You,<br>
{{ config('app.name') }}
@endcomponent
@else
@component('mail::message')
Your handover tool to:
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
<table width="100%" class="table">
  <tr>
    <td align="center"><img src="{{ asset('dist/img/approved.png') }}" style=" width: 150px; height: 150px; "></td>
  </tr>
  <tr>
    <td align="center"><strong>ACCEPTED</strong></td>
  </tr>
</table>
@endcomponent
@endif
