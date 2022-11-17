<?php
class MainController extends Controller {
    public function action_index() {
        $this->view->page = 'main_page';
        $this->view->render();
    }

    public function action_todos() {

    }
}