<?php

namespace App\Helpers;

use App\Models\Homepage;

class SiteviewHelper {

  public static function homepage(){
    return Homepage::first();
}

}