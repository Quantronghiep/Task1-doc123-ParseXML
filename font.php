<?php
class Font{
    public $id , $size , $family , $color;

    public function __construct($id, $size, $family, $color)
    {
        $this->id = $id;
        $this->size = $size;
        $this->family = $family;
        $this->color = $color;
    }

}