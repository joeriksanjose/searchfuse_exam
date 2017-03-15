<?php

class UserController extends AppController
{
    public function index()
    {
        $user = Session::get('user');

        if (!$user) {
            $this->redirect(url('login/index'));
        }

        $action = $this->action;
        $last_week_datetime = date("Y-m-d H:i:s", strtotime("-1 week"));
        $status = Task::STATUS_PENDING;
        $tasks = Task::getAllTasksByUserId($user['id']);

        $this->set(get_defined_vars());
    }

    public function login()
    {
        $username = Param::post('username');
        $password = Param::post('pass');

        $validator = new Validator($_POST);
        $validator->rule('required', ['username', 'pass'])
            ->message('- {field} required.')
            ->labels(["username" => "Username", "pass" => "Password"]);

        if (!$validator->validate()) {
            $errors = $validator->errors();
            $error_msgs = [];
            foreach ($errors as $error) {
                $error_msgs[] = $error[0];
            }

            $this->setFlash(implode("</br>", $error_msgs), 'danger');
            $this->redirect(url('login/index'));
        }

        $user = User::verify($username, encrypt_password($password));

        if (!$user) {
            $this->setFlash("Invalid Username/Password.", "danger");
            $this->redirect(url('login/index'));
        }

        unset($user["password"]);
        Session::set('user', $user);
        $this->redirect(url('user/index'));
    }

    public function logout()
    {
        Session::destroy();
        $this->redirect(url('login/index'));
    }

    public function register()
    {
        if (Param::isMethodPost()) {
            $firstname  = Param::post('firstname');
            $lastname   = Param::post('lastname');
            $role       = Param::post('role');
            $username   = Param::post('username');
            $password   = Param::post('pass');

            $validator = new Validator($_POST);
            $validator->rule('required', ['firstname', 'lastname', 'role', 'username', 'pass', 'repass'])
                ->message('- {field} required.')
                ->labels([
                    "firstname" => "First Name",
                    "lastname" => "Last Name",
                    "role" => "Role",
                    "username" => "Username",
                    "pass" => "Password",
                    "repass" => "Password Confirmation"
                ])
                ->rule('equals', 'pass','repass')
                ->message('- Password did not match.')
                ->rule('length', 'username', 5)
                ->message('- Username must be at least 5 characters long.')
                ->rule('length', 'pass', 6)
                ->message('- Password must be at least 6 characters long.')
                ->rule('length', 'repass', 6)
                ->message('- Password must be at least 6 characters long.');

            if (!$validator->validate()) {
                $errors = $validator->errors();
                $error_msgs = [];
                foreach ($errors as $error) {
                    $error_msgs[] = $error[0];
                }

                $this->setFlash(implode("</br>", $error_msgs), 'danger');
                $this->render(url('user/register'));
            }

            $user_data = [
                'first_name' => $firstname,
                'last_name'  => $lastname,
                'role'       => $role,
                'username'   => $username,
                'password'   => encrypt_password($password),
            ];

            try {
                User::create($user_data);
                $this->setFlash("Successful registration! You may now login your account.", "info");
            } catch (PDOException $pdoe) {
                $this->setFlash("An error occured. Please try again.", "danger");
                Log::warn($pdoe->getMessage());
            }
        }
    }

    public function task()
    {
        $action = $this->action;
        $user = Session::get('user');
        if (!$user) {
            $this->redirect(url('login/index'));
        }

        $status = Param::get("status");
        $since_datetime = Param::get("since");

        $tasks = Task::getAllTasksByStatus($user['id'], $status, $since_datetime);
        $this->set(get_defined_vars());
        $this->render('user/index');
    }
}