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
    if ($page === 'shop') {
      if ($limit && $limit > 0) {
        $items = Item::paginate($limit);
      } else {
        $items = Item::paginate(10);
      }
    } else {
      $items = Item::paginate(10);
    }

    $itemDesign = Component::where('name', 'item_box')->first();

    $part = explode('<!-- Column 1 -->', $itemDesign->html);

//   // Example usage
//   $html = '<h2 id="product-title" style="text-align: center;"> heko <span style="color: rgb(22, 145, 121);">Book title</span></h2>
//   <h2 class="product-description" style="text-align: center;">heko <span style="color: rgb(22, 145, 121);">the nice Book</span></h2>';

//         $dom = HtmlEasyDom::loadHTML($html);
//         $result = $dom->getElementById('product-title');
//         $result = $dom->replaceElementContentByClass('product-description','after the class');

// dd($result);

    $dom = new \DOMDocument();
    $dom->loadHTML($part[1], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $xpath = new \DOMXPath($dom);
 
    $dynamicItem = '';
    foreach ($items as $item) {
      $title = "//*[contains(concat(' ', normalize-space(@class), ' '), 'product-title')]";
      $xpath->query($title)->item(0)->nodeValue = $item->name;

      $price = "//*[contains(concat(' ', normalize-space(@class), ' '), 'product-price')]";
      $xpath->query($price)->item(0)->nodeValue = '$' . $item->price;

      $dom->getElementById("poster")->setAttribute('src', asset('book_images/' . $item->image));

      $anchorElements = $dom->getElementsByTagName('a');
      foreach ($anchorElements as $anchorElement) {
        $anchorElement->setAttribute('href', $item->slug);
      }

      $dynamicItem .= $dom->saveHTML();
    }

    return $dynamicItem;
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
}
