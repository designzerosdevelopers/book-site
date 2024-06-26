<?php

namespace App\Helpers;

class HTMLElement
{
    public $Element;
    public $textContent;

    public function __construct($Element, $textContent)
    {
        $this->Element = $Element;
        $this->textContent = $textContent;
    }
}

class HtmlEasyDom
{
    public $html;

    public function __construct($html)
    {
        $this->html = $html;
    }

    public static function loadHTML($html)
    {
        return new static($html);
    }

    public function getElementByClass($className)
    {

        $pattern = '/<[^>]*class="[^"]*' . preg_quote($className, '/') . '[^"]*"[^>]*>(.*?)<\/[^>]+>/s';


        if (preg_match($pattern, $this->html, $matches)) {
            
            $completeElement = $matches[0];
            $innerHTML = $matches[0];
            $textContent = strip_tags($innerHTML);

            return new HTMLElement($completeElement, $textContent);
        } else {
            return null;
        }
    }

    public function getElementById($idName)
    {

        $pattern = '/<[^>]*id="[^"]*' . preg_quote($idName, '/') . '[^"]*"[^>]*>(.*?)<\/[^>]+>/s';


        if (preg_match($pattern, $this->html, $matches)) {
            
            $completeElement = $matches[0];
            $innerHTML = $matches[0];
            $textContent = strip_tags($innerHTML);

            return new HTMLElement($completeElement, $textContent);
        } else {
            return null;
        }
    }

    public function replaceElementContentByClass($className, $newContent)
{
    $pattern = '/<[^>]*class="[^"]*' . preg_quote($className, '/') . '[^"]*"[^>]*>(.*?)<\/[^>]+>/s';

    // Replace the content of the element with the new content
    $newHtml = preg_replace_callback($pattern, function($matches) use ($newContent) {

        
        $elementStartTag = $matches[1];
        return $elementStartTag . $newContent ;
    }, $this->html);
    dd($newHtml);
    return $newHtml;
}

}


