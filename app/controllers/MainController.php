<?php
class MainController extends Controller {
    public function action_index() {
        /*if($_SERVER['REQUEST_METHOD'] === "POST") {
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
        }*/
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
        $publish_user = filter_input(INPUT_POST, 'publish_contact');
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $country_id = filter_input(INPUT_POST, 'country');

        $phones = filter_input(INPUT_POST, 'phones', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $phones_id = filter_input(INPUT_POST, 'phones_id', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $phones_checkbox = filter_input(INPUT_POST, 'phones_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $new_phones = filter_input(INPUT_POST, 'new_phones', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $new_phones_checkbox = filter_input(INPUT_POST, 'new_phones_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        /*var_export($phones); echo '<br/>';
        var_export($phones_id); echo '<br/>';
        var_export($phones_checkbox); echo '<br/>';
        var_export($new_phones); echo '<br/>';
        var_export($new_phones_checkbox); echo '<br/>';*/

        $emails = filter_input(INPUT_POST, 'emails', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $emails_id = filter_input(INPUT_POST, 'emails_id', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $emails_checkbox = filter_input(INPUT_POST, 'emails_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $new_emails = filter_input(INPUT_POST, 'new_emails', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $new_emails_checkbox = filter_input(INPUT_POST, 'new_emails_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        /*var_export($emails); echo '<br/>';
        var_export($emails_id); echo '<br/>';
        var_export($emails_checkbox); echo '<br/>';
        var_export($new_emails); echo '<br/>';
        var_export($new_emails_checkbox); echo '<br/>';*/
        $this->model = new MainModel();
        $this->model->updateUser($id, $publish_user, $firstname, $lastname, $address, $city, $country_id);
        $this->model->multiUpdateCreatePhones($phones, $phones_id, $phones_checkbox, $new_phones, $new_phones_checkbox, $id);
        $this->model->multiUpdateCreateEmails($emails, $emails_id, $emails_checkbox, $new_emails, $new_emails_checkbox, $id);

        header('Location: ' . '/');
    }
}