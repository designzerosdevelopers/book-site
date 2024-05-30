<?php

namespace App\Helpers;

use App\Models\Component;
use App\Models\Settings;
use App\Models\Item;
use App\Models\Customcode;
use App\Helpers\HtmlEasyDom;
use Illuminate\Support\Facades\DB;

class SiteviewHelper
{
  public static function item($page = '', $limit = '')
  {
    return Item::get();
  }

  public static function page($page)
  {

    return Component::where('name', $page)->first();
  }


  public static function getCartList()
  {
    $items = json_decode(request()->cookie('cart'), true) ?? [];


    if (!empty($items)) {
      $dom = new \DOMDocument();
      $dom->loadHTML(\App\Helpers\SiteviewHelper::page('cart')->html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
      $totalprice = (float) 00.00;
      foreach ($items as $item) {
        $totalprice += (float) $item['item_price'];
      }

      $dom->getElementById("subtotal")->nodeValue = "$$totalprice";
      $dom->getElementById("totalprice")->nodeValue = "$$totalprice";
      $carttotal = $dom->saveHTML();

      $cart = explode('<!-- cartempty -->', $carttotal);
      $cart = explode('<!-- cartlist -->', $cart[0] . $cart[2]);

      $dom = new \DOMDocument();
      $dom->loadHTML($cart[1], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
      $xpath = new \DOMXPath($dom);
      $dynamicItem = '';
      foreach ($items as $item) {

        $title = "//*[contains(concat(' ', normalize-space(@class), ' '), 'product-name')]";
        $xpath->query($title)->item(0)->nodeValue = $item['item_name'];

        $title = "//*[contains(concat(' ', normalize-space(@class), ' '), 'product-name')]";
        $xpath->query($title)->item(0)->nodeValue = $item['item_name'];

        $dom->getElementById("price")->nodeValue = '$' . $item['item_price'];

        $dom->getElementById("thumbnail")->setAttribute('src', asset('book_images/' . $item['item_image']));

        $anchorElements = $dom->getElementsByTagName('a');
        foreach ($anchorElements as $anchorElement) {
          $anchorElement->setAttribute('href', route('remove.from.cart', ['id' => $item['item_id']]));
        }

        $dynamicItem .= $dom->saveHTML();
      }

      return $cart[0] . $dynamicItem . $cart[2];
    } else {

      $cartempty = explode('<!-- cartlist -->', \App\Helpers\SiteviewHelper::page('cart')->html);
      return $cartempty[0] . $cartempty[2];
    }
  }

  public static function getsettings($key)
  {
    $settings = Settings::where('key', $key)->firstOrfail('value');
    return $settings->value;
  }


  public static function style($page)
  {
    $css = Component::where('name', 'site')->first()->css;

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



  public static function customcode($column)
  {
    if ($column == 'css') {
      return asset('clientside/css/bootstrap.min.css');
  }
    // return DB::table('customcode')->first()->{$column};
  }

}
