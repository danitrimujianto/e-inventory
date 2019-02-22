@php $total = '0'; @endphp
@component('mail::message')
# Handover Retur Tools

We recieved handover retur tools from:
<br>
<table width="100%" class="table">
  <tr>
    <td width="40%">Code</td>
    <td width="1%">:</td>
    <td>{{ $data->kode }}</td>
  </tr>
  @if($data->type == 'user')
  <tr>
    <td width="40%">Name</td>
    <td width="1%">:</td>
    <td>{{ optional($data->karyawan)->name }}</td>
  </tr>
  @endif
  <tr>
    <td>Project</td>
    <td>:</td>
    <td>{{ optional($data->project)->name }}</td>
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
  <tr>
    <td>Remarks</td>
    <td>:</td>
    <td>{{ $data->remarks }}</td>
  </tr>
</table>
<br>
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
Please reponse this retur.
@component('mail::button', ['url' => $url])
Response Retur
@endcomponent
<br>
Thank You,<br>
{{ config('app.name') }}
@endcomponent
