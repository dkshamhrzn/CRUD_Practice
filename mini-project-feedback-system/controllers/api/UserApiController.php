<?php
require_once __DIR__ . '/../../models/UserModel.php';

class UserApiController{
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function loginApi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->model->login($username, $password)) {
                http_response_code(200); // OK
                echo json_encode(['message' => 'Login successful.']);
            } else {
                http_response_code(401); // Unauthorized
                echo json_encode(['message' => 'Invalid username or password.']);
            }
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['message' => 'Method not allowed.']);
        }
    }

    public function signupApi() {

        $UserList = $this->model->getAllUsers();
        header('Content-Type: application/json');
        echo json_encode($UserList);
    }


}