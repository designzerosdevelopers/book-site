<?php

namespace App\Helpers;

use App\Models\Component;
use App\Models\Settings;
use App\Models\Item;
use App\Helpers\HtmlEasyDom;

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
      $totalprice = (float)00.00;
      foreach ($items as $item) {
        $totalprice += (float)$item['item_price'];
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


  public static function test()
  {
    $htmlCode = "<h1>Hello, <?php echo 'World'; ?></h1>";

    ob_start();
    eval("?>" . $htmlCode);
    $output = ob_get_clean();

    return $output;
  }

  public static function getCart()
  {
    $items = json_decode(request()->cookie('cart'), true) ?? [];
    return $items;
  }
}
