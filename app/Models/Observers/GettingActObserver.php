<?php

namespace App\Models\Observers;

use App\Models\Entities\GettingAct;

class GettingActObserver
{
    public function saving(GettingAct $gettingAct)
    {
        //$gettingAct->cargo()->delete();
    }
}
