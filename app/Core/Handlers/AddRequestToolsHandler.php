<?php
namespace App\Core\Handlers;

use App\User;
use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use DB;
use HelpMe;
use Mail;
use Notifiable;

class AddRequestToolsHandler implements Handler
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $request = $this->request;
        $data = $this->saveDB($request);
        $detail = $this->getPurchaseDetail($data->id);
        // dd($data->id);
        $returnData['data'] = $data;
        $returnData['detail'] = $detail;
        $user = User::where('usertype_id', 3)->get();
        // dd($returnData);
        $emails = array();
        foreach($user AS $val){
          $sendmail = $val->NotifPurchase($returnData, $val->email);
        }

        // $sendmail = $this->notify(new NotifPurchase($this->token));
        // $sendmail = $this->sendmail($emails, $der);
        return $data;
    }

    private function saveDB($request)
    {
        $path = "";
        $usertype = Auth::user()->usertype_id;

        $sender = ($usertype != 1 ? Auth::user()->karyawan_id : $request->sender_id);
        $status = (($usertype == 2 || $usertype == 1) ? "1" : "0");
        $type = (($usertype == 2 || $usertype == 1) ? "office" : "user");

        $kode = $this->kode();
        $type = 'Tools';

        $tab = new PurchaseRequest();
        $tab->tanggal = HelpMe::tgl_indo_to_sql($request->tanggal);
        $tab->karyawan_id = $request->karyawan_id;
        $tab->due_date = HelpMe::tgl_indo_to_sql($request->due_date);
        $tab->description = $request->description;
        $tab->type = $type;
        $tab->pr_no = $kode;
        $tab->status = '0';
        $tab->save();

        $tools = array();
        $isToll = false;
        $no=0;
        foreach($request->item AS $item){
          if(!empty($item)){
            $tools[] = array(
                          'purchase_request_id'=>$tab->id,
                          'item'=>$item,
                          'merk'=>$request->merk[$no],
                          'type'=>$request->type[$no],
                          'quantity'=>HelpMe::normalNumber($request->quantity[$no]),
                          'price'=>HelpMe::normalNumber($request->price[$no]),
                          'total'=>HelpMe::normalNumber($request->subtotal[$no])
                        );
            $isTool = true;
          }
          $no++;
        }
        // dd($request->price);
        if($isTool) $bulkTools = PurchaseRequestDetail::insert($tools);


        // dd($emails);
        return $tab;
    }

    private function getPurchaseDetail($id){
      $data = PurchaseRequestDetail::where('purchase_request_id', $id)->get();

      return $data;
    }

    private function kode()
    {
      $prefix = "PR/";
      $bln = (strlen(date('m')) == 1 ? '0'.date('m') : date('m'));
      $thn = date('Y');

      $data = PurchaseRequest::whereMonth('tanggal', $bln)->whereYear('tanggal', $thn)->orderBy('id', 'desc')->first();
      $new_no = (substr($data["pr_no"], 3, 4)+1);

      if(strlen($new_no) == 1)
      { $new_no = "000".$new_no; }
      if(strlen($new_no) == 2)
      { $new_no = "00".$new_no; }
      if(strlen($new_no) == 3)
      { $new_no = "0".$new_no; }
      if(strlen($new_no) == 4)
      { $new_no = $new_no; }

      $new_no = $prefix.$new_no.'/'.$bln.'/'.substr($thn, 2, 2);
      return $new_no;
    }

    private function sendmail($email, $data)
    {
      Mail::send('emails.purchase_request', $data, function($message) use ($email){
        $message->subject('Purchase Request');
        $message->from('info@sinergitelecom.net', 'SINERGI TELECOM');
        $message->to($email);
      });
      // var_dump( Mail:: failures());
    }
}
