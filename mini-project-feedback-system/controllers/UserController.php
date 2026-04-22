<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            if ($username === 'admin' && $password === 'admin123') {
                $_SESSION['user'] = [
                    'username' => 'admin',
                    
                ];
                header('Location: index.php?action=admin');
                exit();
            } elseif (!empty($username) && !empty($password)) {
                $user = $this->model->getUserByUsername($username);
                if ($user && $this->model->verifyPassword($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email']
                    ];
                    header('Location: index.php?action=home');
                    exit;
                } else {
                    $_SESSION['message'] = 'Username or password is incorrect. Please try again.';
                    
                    header('Location: index.php?action=login');
                    
                    exit;
                }
            } else {
                $_SESSION['message'] = 'Please enter username and password.';
            }
        }
        include __DIR__ . '/../views/login.php';
    }



    public function signup($username, $email, $password)
    {
        try{
        $result = $this->model->signup($username, $email, $password);
        if ($result === true) {
            //echo "Signup successful. <a href='index.php'>Login now</a>";
            header("Location: index.php?action=login");
        } elseif ($result === "exists") {
            echo "Username already taken. <a href='index.php?action=signup'>Try again</a>";
        } else {
            echo "Signup failed. <a href='index.php?action=signup'>Try again</a>";
        }}
        catch(Exception $e){
            echo "An error occurred: " . $e->getMessage();
        }
        include __DIR__ . '/../views/signup.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
    }



}