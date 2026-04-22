<?php
require_once __DIR__ . '/../config/DB.php';

class UserModel extends DB
{
    public function login($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result && password_verify($password, $result['password'])) {
            return $result;
        }
        return false;
    }

    public function signup($username, $email, $password)
    {
        $check = $this->conn->prepare("SELECT * FROM users WHERE username=?");
        $check->bind_param("s", $username);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            return "exists";
        }

        $hashedpw = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedpw);
        var_dump($username, $email, $hashedpw);
        return $stmt->execute();

    }

    public function getUserByUsername($username)
{
    $username = $this->conn->real_escape_string($username);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $this->conn->query($query);

    if ($result && $result->num_rows === 1) {
        return $result->fetch_assoc(); 
    }

    return false; 
}

public function verifyPassword($inputPassword, $hashedPassword)
{
    return password_verify($inputPassword, $hashedPassword);
}

public function getAllUsers()
{
    $query = "SELECT * FROM users";
    $result = $this->conn->query($query);

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];


}
}