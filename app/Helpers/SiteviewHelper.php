<?php

namespace App\Helpers;

use App\Models\Homepage;
use App\Models\Settings;
class SiteviewHelper {

  public static function homepage()
  {
    return Homepage::first();
  }

  public static function getsettings($key)
  {
    $settings = Settings::where('key', $key)->firstOrfail('value');
    return $settings->value;
  }


}