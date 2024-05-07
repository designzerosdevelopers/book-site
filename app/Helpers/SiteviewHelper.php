<?php

namespace App\Helpers;

use App\Models\Home;
use App\Models\Component;
use App\Models\Settings;
use App\Models\Navbar;
use App\Models\Footer;

class SiteviewHelper {

  public static function page($page)
  {
    return Component::where('name', $page)->first();
  }

  public static function getsettings($key)
  {
    $settings = Settings::where('key', $key)->firstOrfail('value');
    return $settings->value;
  }

  
  public static function navbar()
  {
    $nav_elements = Navbar::orderBy('position')->get()->toArray();
    $navHtml = '';
    foreach ($nav_elements as $value) {
      $url = request()->url();
      // Parse the URL
      $urlComponents = parse_url($url);

      // Extract the path component
      $path = isset($urlComponents['path']) ? ltrim($urlComponents['path'], '/') : '';

      // Check if the path is empty after removing the leading "/"
      if ($path === '') {
          // If the path is empty, set it to "/"
          $path = '/';
      }
      // dd($value['route']);
      if($value['route'] === 'index'){
        $route = '/';
        $navHtml .= '<li class="nav-item ' . (($route == $path) ? 'active' : '') . '">';
        $navHtml .= '<a class="nav-link" href="' . $route. '">' . $value['name'] . '</a>';
        $navHtml .= '</li>';
      }else {
        $navHtml .= '<li class="nav-item ' . (($value['route'] == $path) ? 'active' : '') . '">';
        $navHtml .= '<a class="nav-link" href="' . $value['route'] . '">' . $value['name'] . '</a>';
        $navHtml .= '</li>';
      }
    }
    return $navHtml;
  }

  public static function footer() 
{
    $footers = Footer::all(); // Assuming you want to fetch all footers
    return $footers->pluck('footer')->implode("");
}

  


}