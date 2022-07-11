<?php
require_once "page.php";
require_once "line.php";
require_once "font.php";

$file = 'sample.xml';

$xml  = simplexml_load_file($file);
//echo "<pre>";
//print_r($xml);
//echo "</pre>";
//die();
foreach ($xml->page as $pageElement){
//    print_r($pageElement);
//    die();
    foreach ($pageElement->text as $line){
//        print_r($line);
//        die();
        $top = $line->attributes()->top;
        $left = $line->attributes()->left;
        $height = $line->attributes()->height;
        $width = $line->attributes()->width;
        $font = $line->attributes()->font;

        if($line->count()){
            $value = $line->children()->saveXML();
        }
        else{
            $value = $line->__toString();
        }
//        print_r($value);
        $text = new Line($top,$left,$height,$width,$font,$value);
        $arrLine[] = $text;
    }
//    echo "<pre>";
//    print_r($arrLine);
//    echo "</pre>";


    foreach ($pageElement->fontspec as $fontElement){
        $id = $fontElement->attributes()->id;
        $size = $fontElement->attributes()->size;
        $family = $fontElement->attributes()->family;
        $color = $fontElement->attributes()->color;
        $font = new Font($id,$size,$family,$color);
        $arrFont[] = $font;
    }
    $number = $pageElement->attributes()->number;
    $position = $pageElement->attributes()->position;
    $top = $pageElement->attributes()->top;
    $left = $pageElement->attributes()->left ;
    $height = $pageElement->attributes()->height;
    $width = $pageElement->attributes()->width;
    // khoi tao page
//    echo "<pre>";
//    print_r($arrLine);
//    echo "</pre>";
    $page = new Page($number,$position,$top,$left , $height , $width, $arrLine ,$arrFont);
    unset($arrLine);
    unset($arrFont);
    echo $page->getHtml();

}


?>
