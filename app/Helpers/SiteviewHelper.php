<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use App\Models\Component;
use App\Models\Settings;
use App\Models\Item;
use App\Models\CustomCode;

class SiteviewHelper
{
  public static function item($page = '', $limit = '')
  {
    $component = Component::find(1);
    $data = $component->data;
    $dataArray = json_decode($data, true);
    $perpage = $dataArray['display_product'];

    return Item::limit($perpage)->get();
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


  public static function style($page)
  {
    $css = File::get('clientside/js-css-other/style.css');

    if ($page == 'themesetting') {
      $style = [];
      preg_match('/(\.hero\s*{\s*.*?background:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['hero'] = $matches[2];
      preg_match('/(body\s*{\s*.*?background-color:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['bg'] = isset($matches[2]) ? $matches[2] : null;

      preg_match('/(a\s*{\s*.*?color:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['url'] = isset($matches[2]) ? $matches[2] : null;

      preg_match('/(\.custom-navbar\s*{\s*.*?background:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['navbar'] = trim(str_replace('!important', '', $matches[2]));
      preg_match('/(\.footer-section\s*{\s*.*?background:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['footer'] = $matches[2];
    } elseif ($page == 'homesetting') {

      preg_match('/(\.item-title\s*{[^}]*?color:\s*)([^;]+)(\s* !important\s*;\s*})/i', $css, $matches);
      $style['titleColor'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.item-title\s*{[^}]*?font-size:\s*)([^;]+)(\s* !important\s*;\s*[^}]*})/i', $css, $matches);
      $style['titleSize'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.item-price\s*{[^}]*?color:\s*)([^;]+)(\s* !important\s*;\s*})/i', $css, $matches);
      $style['priceColor'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.item-price\s*{[^}]*?font-size:\s*)([^;]+)(\s* !important\s*;\s*[^}]*})/i', $css, $matches);
      $style['priceSize'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.item-thumbnail-size\s*{\s*.*?height:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['productHeight'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.item-thumbnail-size\s*{\s*.*?width:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['productWidth'] = isset($matches[2]) ? $matches[2] : null;
      $style['data'] = json_decode(Component::where('name', 'home')->first()->data, true);
    } elseif ($page == 'shopsetting') {
      $style['displayProduct'] = json_decode(Component::where('name', 'shop')->first()->data, true)['display_product'];
    } elseif ($page == 'contactsetting') {
      preg_match('/(\.service .service-icon\s*{\s*.*?color:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['contactTextColor'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.service .service-icon\s*{\s*.*?background:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['contactIconBG'] = isset($matches[2]) ? $matches[2] : null;
      $style['contactInfo'] = json_decode(Component::where('name', 'contact')->first()->data, true);
    } elseif ($page == 'productdetailsettings') {
      preg_match('/(\.product-title\s*{\s*.*?color:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['titleColor'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.product-title\s*{\s*.*?font-size:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['titleSize'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.product-price\s*{\s*.*?color:\s*)([^ !important;]+)(.*?})/s', $css, $matches);
      $style['priceColor'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.product-price\s*{\s*.*?font-size:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['priceSize'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.product-detail-main-img img\s*{\s*.*?height:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['productHeight'] = isset($matches[2]) ? $matches[2] : null;
      preg_match('/(\.product-detail-main-img img\s*{\s*.*?width:\s*)([^;]+)(.*?})/s', $css, $matches);
      $style['productWidth'] = isset($matches[2]) ? $matches[2] : null;
      $style['data'] = json_decode(Component::where('name', 'productdetail')->first()->data, true);
    }

    return $style;
  }

  public static function getCart()
  {
    $items = json_decode(request()->cookie('cart'), true) ?? [];
    return $items;
  }

  public static function customCode($type = '', $for = '')
  {
    if ($for == '') {
      return CustomCode::get();
    } else {
      return CustomCode::where('for', $for)->where('type', $type)->get();
    }
  }

}
