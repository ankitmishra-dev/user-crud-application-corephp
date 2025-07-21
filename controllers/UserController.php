<?php

class UserController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

public function createUser()
{
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = $_POST['dob'] ?? '';

    $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, dob) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $dob);

    try {
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'User created']);
        } else {
            // Check for duplicate email error (MySQL error code 1062)
            if ($this->conn->errno === 1062) {
                echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create user']);
            }
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }

    $stmt->close();
}


    public function getUsers()
    {
        $result = $this->conn->query("SELECT id, name, email, dob FROM users");
        $users = [];

        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        echo json_encode($users);
    }

public function updateUser()
{
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $dob = $_POST['dob'] ?? '';

    // I am checking if email exists for a different user
    $checkStmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $checkStmt->bind_param("si", $email, $id);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
        $checkStmt->close();
        return;
    }
    $checkStmt->close();

    $stmt = $this->conn->prepare("UPDATE users SET name=?, email=?, dob=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $dob, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User updated']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed']);
    }

    $stmt->close();
}


    public function deleteUser()
    {
        $id = $_POST['id'] ?? '';

        $stmt = $this->conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'User deleted']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
        }
        $stmt->close();
    }
}
