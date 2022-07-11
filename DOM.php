<?php
//require_once "page.php";
//require_once "line.php";
//chua lam
// khoi tao doi tg document
$document = new DOMDocument();

// load tai lieu xml
$document->load('sample.xml');

//echo "<pre>";
//print_r($document);
//echo "</pre>";
//die();

//lay ra root node ( nút gốc )
$root = $document->documentElement;

$pages = $document->getElementsByTagName('page');
echo "<pre>";
print_r($pages);
echo "</pre>";
die();

$pages = $root->childNodes;
echo "<pre>";
print_r($pages);
echo "</pre>";
$texts = $document->getElementsByTagName('text');
//$texts = $pages->childNodes;

foreach ($pages as $page){

    foreach ($texts as $line){
        $top = $line->getAttribute('top');
        $left = $line->getAttribute('left');
        $height = $line->getAttribute('height');
        $width = $line->getAttribute('width');
        $font = $line->getAttribute('font');
        $value = $line->nodeValue;
        $text = new Line($top,$left,$height,$width,$font,$value);
        $arrLine[] = $text;
    }

//    foreach ($pageElement->fontspec as $fontElement){
//        $id = $fontElement->attributes()->id;
//        $size = $fontElement->attributes()->size;
//        $family = $fontElement->attributes()->family;
//        $color = $fontElement->attributes()->color;
//        $font = new Font($id,$size,$family,$color);
//        $arrFont[] = $font;
//    }
//    if($page->nodeType == XML_ELEMENT_NODE){
        $number = $page->getAttribute('number');
        $position = $page->getAttribute('absolute');
        $top = $page->getAttribute('top');
        $left = $page->getAttribute('left');
        $height =  $page->getAttribute('height');
        $width = $page->getAttribute('width');
//    }


    $page = new Page($number,$position,$top,$left , $height , $width, $arrLine);

    unset($arrLine);
    echo $page->getHtml();
}


?>
