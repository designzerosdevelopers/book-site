<?php

namespace App\Helpers;

use App\Models\Component;
use App\Models\Settings;
use App\Models\Navbar;
use App\Models\Footer;
use App\Models\Item;

class SiteviewHelper
{
  

  public static function item($limit = '')
  {
    $items = ($limit) ? Item::take($limit)->get() : Item::get();

    $itemDesign = Component::where('name', 'home')->first();

    $part = explode('<!-- Column 1 -->', $itemDesign->html);
    
    $image = explode('<!-- img -->', $itemDesign->html)[1];
    $itemdata = '';

    foreach ($items as $item) {
      $currentPart = $part[1]; // Save the original part for this iteration

      // Replace dynamic content in the current part
      $currentPart = str_replace('Book title', $item->name, $currentPart);
      $currentPart = str_replace('00.00', $item->price, $currentPart);
      $currentPart = preg_replace('/href="(.*?)"/', 'href="example.com"', $currentPart);
      $imageChanged = preg_replace('/src="(.*?)"/', 'src="' . asset('book_images/' . $item->image) . '"', $image);

      $itemdata .= str_replace($image, $imageChanged, $currentPart);
    }

    return $itemdata;
  }

  public static function page($page)
  {

      return Component::where('name', $page)->first();

  }

  public static function homepage()
  {

      $home = Component::where('name', 'home')->first();
      $itemDesign = explode('<!-- Column 1 -->', $home->html);
      return $itemDesign[0].self::item(3).$itemDesign[2];

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
      $urlComponents = parse_url($url);
      $path = isset($urlComponents['path']) ? ltrim($urlComponents['path'], '/') : '';

      if ($path === '') {
        $path = '/';
      }
      if ($value['route'] === 'index') {
        $route = '/';
        $navHtml .= '<li class="nav-item ' . (($route == $path) ? 'active' : '') . '">';
        $navHtml .= '<a class="nav-link" href="' . $route . '">' . $value['name'] . '</a>';
        $navHtml .= '</li>';
      } else {
        $navHtml .= '<li class="nav-item ' . (($value['route'] == $path) ? 'active' : '') . '">';
        $navHtml .= '<a class="nav-link" href="' . $value['route'] . '">' . $value['name'] . '</a>';
        $navHtml .= '</li>';
      }
    }
    return $navHtml;
  }

  public static function footer()
  {
    $footers = Footer::all();
    return $footers->pluck('footer')->implode("");
  }
}
