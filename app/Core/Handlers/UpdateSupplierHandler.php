<?php
namespace App\Core\Handlers;

use App\Supplier;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateSupplierHandler implements Handler
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
        return $data;
    }

    private function saveDB($request)
    {
        $id = $request->id;
        $tab = Supplier::find($id);
        $tab->name = $request->name;
        $tab->address = $request->address;
        $tab->contact_person = $request->contact_person;
        $tab->phone = $request->phone;
        $tab->date = HelpMe::tgl_indo_to_sql($request->date);
        $tab->remarks = $request->remarks;
        $tab->save();

        return $tab;
    }
}
