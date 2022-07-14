<?php
require_once "Page.php";
require_once "Line.php";
require_once "Font.php";
require_once "Document.php";

$path = "sample.xml";
$arrFont = [];
$arrLine = [];

// Read entire file into string
$xmlfile = file_get_contents($path);
$arrPageExplode = explode("</page>", $xmlfile);

array_pop($arrPageExplode);  // xoa ptu cuoi : the </pdf2xml>

foreach ($arrPageExplode as $pageExplode) {
    $arrLineOfOnePage = explode("\n", $pageExplode);

    foreach ($arrLineOfOnePage as $key => $value) {
        $pattern = '/<page .*?>|<text .*?>(.*?)<\/text>|<fontspec .*?\/>/';  // regex check tag
        $checkTag = preg_match($pattern, $value);
        if (!$checkTag) {
            unset($arrLineOfOnePage[$key]);  // xoa ptu khong phai 3 the
        }
    }

    foreach ($arrLineOfOnePage as $line) {
        $patternText = '/<text .*?>(.*?)<\/text>/';
        $checkTagText = preg_match($patternText, $line,$matches);
        if ($checkTagText) {
            $valueText = $matches[1];  // value text have tag <b>

            $doc = new DOMDocument();
            @$doc->loadHTML($line);

            $textTag = $doc->getElementsByTagName('text')->item(0);
            $topText = $textTag->getAttribute('top');
            $leftText = $textTag->getAttribute('left');
            $heightText = $textTag->getAttribute('height');
            $widthText = $textTag->getAttribute('width');
            $fontText = $textTag->getAttribute('font');
            $text = new Line($topText, $leftText, $heightText, $widthText, $fontText, $valueText);
            $arrLine[] = $text;
        }

        $patternFont = '/<fontspec .*?\/>/';
        $checkTagText = preg_match($patternFont, $line);
        if ($checkTagText) {
            $doc = new DOMDocument();
            @$doc->loadHTML($line);
            $fontTag = $doc->getElementsByTagName('fontspec')->item(0);
            $id = $fontTag->getAttribute('id');
            $size = $fontTag->getAttribute('size');
            $family = $fontTag->getAttribute('family');
            $color = $fontTag->getAttribute('color');
            $font = new Font($id, $size, $family, $color);
            $arrFont[] = $font;
        }
    }

    $pageTagString =  array_values($arrLineOfOnePage)[0];  // get tag page
    $checkTagText = preg_match('/<page .*?>/', $pageTagString);
    if ($checkTagText) {
        $doc = new DOMDocument();
        @$doc->loadHTML($pageTagString);
        $pageTag = $doc->getElementsByTagName('page')->item(0);
        $numberPage = $pageTag->getAttribute('number');
        $positionPage = $pageTag->getAttribute('position');
        $topPage = $pageTag->getAttribute('top');
        $leftPage = $pageTag->getAttribute('left');
        $heightPage = $pageTag->getAttribute('height');
        $widthPage = $pageTag->getAttribute('width');
        $page = new Page($numberPage, $positionPage, $topPage, $leftPage, $heightPage, $widthPage, $arrLine, $arrFont);
        $arrPage[] = $page;
    }
    unset($arrFont);
    unset($arrLine);

//    echo $page->getHtml();

}

$document = new Document($arrPage);
$document->getHtmlDocument();
