<?php
class View {
    public $template;
    public $page;

    public function __construct() {
        $this->template = 'main_template';
    }

    public function render() {
        include_once 'app/views/templates/'.$this->template.'.php';
    }
}