<?php
class Document{
    private $pages;
    public function __construct($pages = [])
    {
        $this->pages = $pages;
    }

    public function getHtmlDocument(){
        foreach ($this->pages as $page){
            echo $page->getHtmlPage();
        }
    }
}