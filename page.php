<?php
require_once "line.php";
class Page{
    private $number , $position , $top , $left , $height , $width , $lines ,  $fonts  ;

        public function __construct($number, $position, $top, $left, $height, $width, $lines = [] , $fonts = [])
    {
        $this->number = $number;
        $this->position = $position;
        $this->top = $top;
        $this->left = $left;
        $this->height = $height;
        $this->width = $width;
        $this->fonts = $fonts;
        $this->lines = $lines;
    }
    public function getHtmlPage(){
        foreach ($this->lines as $line){
            $arrLine[] =  $line->getHtmlLine();
        }
//        echo "Page : " . $this->number ;
        return "<div>" . implode(" ",$arrLine) . "</div>";
    }





}