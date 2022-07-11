<?php
class Line
{
    private $top, $left, $height, $width, $font, $valueText;

    public function __construct($top, $left, $width , $height,$font, $valueText)
    {
        $this->top = $top;
        $this->left = $left;
        $this->height = $height;
        $this->width = $width;
        $this->font = $font;
        $this->valueText = $valueText;
    }

    public function getLine(){
        return $this->valueText;
    }

    public function getHtmlLine(){
//        if($this->top != $top)
        return "<p>" . $this->getLine() ."</p>";
//        return $this->getLine() ."</br>";
    }
}
