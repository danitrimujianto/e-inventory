<?php

namespace App;

use App\Notifications\NotifFinancePurchase as NotifFinancePurchase;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use Notifiable;

class EmailExternal extends Model
{
    protected $table = "email_external";

    public function NotifPurchase($data, $email)
    {

    $this->notify(new NotifFinancePurchase($data, $email));

    }
}
