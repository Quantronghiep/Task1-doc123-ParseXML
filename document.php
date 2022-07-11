<?php
class Document{
    private $pages;
    public function __construct($pages = [])
    {
        $this->pages = $pages;
    }
}