<?php

namespace App\Helpers;

use App\Models\Component;
use App\Models\Settings;
use App\Models\Navbar;
use App\Models\Footer;
use App\Models\item;

class SiteviewHelper
{

  public static function item($limit = '' )
  {
    $items = ($limit) ? Item::take($limit)->get() : Item::get();


    $itemDesign = Component::where('name', 'home')->first();

    $part = explode('<!-- Column 1 -->', $itemDesign->html);
    $image = explode('<!-- img -->', $itemDesign->html)[1];
    $itemdata = '';
    foreach ($items as $item) {

      $part[1] = str_replace('Book title', $item->name, $part[1]);
      $part[1] = str_replace('00.00', $item->price, $part[1]);

      $part[1] = preg_replace('/href="(.*?)"/', 'href="example.com"', $part[1]);

      $imageChanged = preg_replace('/src="(.*?)"/', 'src="' . asset('book_images/'.$item->image) . '"', $image);
      $itemdata .= str_replace($image, $imageChanged, $part[1]);
    }

    return $itemdata;
  }


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
