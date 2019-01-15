<?php

namespace App;

use App\Notifications\NotifFinancePurchase as NotifFinancePurchase;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class EmailExternal extends Model
{
    use Notifiable;

    protected $table = "email_external";

    public function NotifPurchase($data, $email)
    {

    $this->notify(new NotifFinancePurchase($data, $email));

    }
}
