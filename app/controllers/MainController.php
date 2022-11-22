<?php
class MainController extends Controller {
    public function action_index() {
        $this->view->page = 'main_page';
        $this->view->render();
    }

    public function action_login() {
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
            } else {
                $_SESSION['message'] = "wrong username or password";
            }
        }
        header('Location: ' . '/');
    }

    public function action_logout() {
        $_SESSION['login'] = false;
        $_SESSION['user_id'] = false;
        $_SESSION['message'] = false;
        header('Location: ' . '/');
    }

    public function action_loginpage() {
        $this->view->page = 'login_page';
        GenerateHeader::generateHeader(true, 200, $this->view->getPage());
    }

    public function action_phonebook() {
        $this->model = new MainModel();
        $this->view->users = $this->model->getUsers();
        $this->view->page = 'phonebook_page';
        GenerateHeader::generateHeader(true, 200, $this->view->getPage());
    }

    public function action_details($id) {
        $this->model = new MainModel();
        $this->view->user = $this->model->getUser($id);
        $this->view->phones = $this->model->getPhones($id, true);
        $this->view->emails = $this->model->getEmails($id, true);
        $this->view->page = 'details_page';
        GenerateHeader::generateHeader(true, 200, $this->view->getPage());
    }

    public function action_mycontact() {
        $id = $_SESSION['user_id'];
        $this->model = new MainModel();
        $this->view->user = $this->model->getUser($id);
        $this->view->phones = $this->model->getPhones($id);
        $this->view->emails = $this->model->getEmails($id);
        $this->view->countries = $this->model->getCountries();
        $this->view->page = 'mycontact_page';
        GenerateHeader::generateHeader(true, 200, $this->view->getPage());
    }

    public function action_editcontact() {
        $id = $_SESSION['user_id'];
        $c = Validation::check_contacts();
        if(!$c) {
            header('Location: ' . '/');
            return;
        }
        $p = Validation::check_phones();
        if(!$p) {
            header('Location: ' . '/');
            return;
        }
        $e = Validation::check_emails();
        if(!$e) {
            header('Location: ' . '/');
            return;
        }
        $this->model = new MainModel();
        $this->model->updateUser($id, $c['publish_user'], $c['firstname'], $c['lastname'], $c['address'], $c['city'], $c['country_id']);
        $this->model->multiUpdateCreatePhones($p['phones'], $p['phones_id'], $p['phones_checkbox'], $p['new_phones'], $p['new_phones_checkbox'], $id);
        $this->model->multiUpdateCreateEmails($e['emails'], $e['emails_id'], $e['emails_checkbox'], $e['new_emails'], $e['new_emails_checkbox'], $id);
        header('Location: ' . '/');
    }
}