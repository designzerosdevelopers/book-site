<?php

namespace App\Helpers;

use App\Models\Component;
use App\Models\Settings;
use App\Models\Navbar;
use App\Models\Footer;
use App\Models\Item;
use HTML5;


class SiteviewHelper
{
  public static function item($limit = '', $page = '')
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

  public static function clientSidePage($limit = '', $page = '')
  {
    if ($page == 'home') {
      $itemDesign = explode('<!-- Column 1 -->', \App\Helpers\SiteviewHelper::page('home')->html);
      return $itemDesign[0] . self::item($limit, $page) . $itemDesign[2];
    } else {
      $itemDesign = explode('<!-- Column 1 -->', \App\Helpers\SiteviewHelper::page('shop')->html);
      return $itemDesign[0] . self::item($limit, $page) . $itemDesign[2];
    }
  }

  public static function getsettings($key)
  {
    $settings = Settings::where('key', $key)->firstOrfail('value');
    return $settings->value;
  }

  public static function getFooterColor()
  {
    $footerHtml = Component::where('name', 'footer')->value('html');

    $matches = [];
    preg_match('/<footer[^>]*style="[^"]*background-color\s*:\s*([^;"]+)/i', $footerHtml, $matches);

    return $matches[1];
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
