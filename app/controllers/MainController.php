<?php
class MainController extends Controller {
    public function action_index() {
        if($_SERVER['REQUEST_METHOD'] === "POST") {
            $action = filter_input(INPUT_POST, 'action');
            switch($action) {
                case "logout":
                    $_SESSION['login'] = false;
                    $_SESSION['user_id'] = false;
                    $_SESSION['message'] = false;
                    break;
                case "login":
                    $username = filter_input(INPUT_POST, 'username');
                    $password = filter_input(INPUT_POST, 'password');
                    $fields = ['username' => $username, 'password' => $password];
                    $validation = Validation::validate_fields($fields);
                    if($validation) {
                        $this->model = new MainModel();
                        $respond = $this->model->isRegistered($username, $password);
                        if($respond) {
                            $_SESSION['login'] = true;
                            $_SESSION['user_id'] = $respond[0]['id'];
                        }
                    }
                    break;
            }
        }
        $this->view->page = 'main_page';
        $this->view->render();
    }

    public function action_login() {
        $this->view->page = 'login_page';
        GenerateHeader::generateHeader(true, 200, $this->view->getPage());
    }
}