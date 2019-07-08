
@if($target == '3' || $target == '6')
@component('mail::message')
# Maintenance

We recieved maintenance tool
<br>
<table width="100%" class="table">
  <tr>
    <td width="40%">Name</td>
    <td width="1%">:</td>
    <td>{{ optional($data->karyawan)->name }}</td>
  </tr>
  <tr>
    <td>ID Tools</td>
    <td>:</td>
    <td>{{ optional($data->tools)->code }}</td>
  </tr>
  <tr>
    <td>Items</td>
    <td>:</td>
    <td>{{ optional($data->tools)->item }}</td>
  </tr>
  <tr>
    <td>Serial Number</td>
    <td>:</td>
    <td>{{ optional($data->tools)->serial_number }}</td>
  </tr>
  <tr>
    <td>Imei</td>
    <td>:</td>
    <td>{{ optional($data->tools)->imei }}</td>
  </tr>
  <tr>
    <td>Condition</td>
    <td>:</td>
    <td>{{ optional($data->condition)->name }}</td>
  </tr>
  <tr>
    <td>Problem</td>
    <td>:</td>
    <td>{{ $data->problem }}</td>
  </tr>
  <tr>
    <td>Service</td>
    <td>:</td>
    <td>{{ $data->service }}</td>
  </tr>
  <tr>
    <td>Estimate Price</td>
    <td>:</td>
    <td>{{ HelpMe::cost2($data->price) }}</td>
  </tr>
  <tr>
    <td>Remarks</td>
    <td>:</td>
    <td>{{ $data->remarks }}</td>
  </tr>
</table>
<br><br>
Please reponse this maintenance.
@component('mail::button', ['url' => $url])
Response
@endcomponent
<br>
Thank You,<br>
{{ config('app.name') }}
@endcomponent
@else
  @if($data->status == "1")
  @component('mail::message')
    Congratulation, Maintenance Tools <strong>{{ $data->tools->code }}</strong>
    <br>
    <table width="100%" class="table">
      <tr>
        <td align="center"><img src="{{ asset('dist/img/approved.png') }}" style=" width: 150px; height: 150px; "></td>
      </tr>
      <tr>
        <td align="center"><strong>APPROVED</strong></td>
      </tr>
    </table>
    @endcomponent
  @else
  @component('mail::message')
    Sorry, Maintenance Tools <strong>{{ $data->tools->code }}</strong>
    <br>
    <table width="100%" class="table">
      <tr>
        <td align="center"><img src="{{ asset('dist/img/cancel.png') }}" style=" width: 150px; height: 150px; "></td>
      </tr>
      <tr>
        <td align="center"><strong>REJECTED</strong></td>
      </tr>
    </table>
    @endcomponent
  @endif
@endif
