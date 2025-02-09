<?php

    class UserController extends Controller {

        public function login() {
            if (Security::isAccessTokenValid()) {
                header('Location: ' . URLROOT . '/playlist/index');
                exit;
            }

            $this->view('user/login');
        }

        public function logUserIn() {
            if (Security::isAccessTokenValid()) {
                header('Location: ' . URLROOT . '/playlist/index');
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = new Member(0, '', $email, $password);
                if ($user -> login()) {
                    Security::createAccessToken($user->getUserId());
                    header('Location: ' . URLROOT . '/playlist/index');
                    exit;
                } else {
                    $_SESSION['error'] = "Invalid username or password.";
                }
            }

            header('Location: ' . URLROOT . '/User/login');
        }

        public function register() {
            if (Security::isAccessTokenValid()) {
                header('Location: ' . URLROOT . '/playlist/index');
                exit;
            }

            $this->view('user/register');
        }

        public function registerUser() {
            if (Security::isAccessTokenValid()) {
                header('Location: ' . URLROOT . '/playlist/index');
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $role = $_POST['account_type'];

                if ($role == "Artist") {
                    $user = new Artist(0, $username, $email, $password);
                } else {
                    $user = new Member(0, $username, $email, $password);
                }

                if ($user -> register()) {
                    Security::createAccessToken($user->getUserId());
                    header('Location: ' . URLROOT . '/playlist/index');
                    exit;
                } else {
                    $_SESSION['error'] = $user -> getErrors()[0];
                }

            }

            header('Location: ' . URLROOT . '/User/register');
        }

        public function logout() {
            Security::deleteAccessToken();
            session_destroy();
            header('Location: ' . URLROOT);
        }
    }