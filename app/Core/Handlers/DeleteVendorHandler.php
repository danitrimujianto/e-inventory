<?php
namespace App\Core\Handlers;

use App\Vendor;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class DeleteVendorHandler implements Handler
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
        $this->helpme = new HelpMe;
    }

    public function handle()
    {
        $id = $this->id;
        $data = $this->deleteDB($id);

        return $data;
    }

    private function deleteDB($id)
    {
        $tab = Vendor::find($id);
        $tab->delete();
        return $tab;
    }
}
