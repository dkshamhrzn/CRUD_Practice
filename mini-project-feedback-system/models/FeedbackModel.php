<?php
require_once __DIR__ . '/../config/DB.php';

class FeedbackModel extends DB
{

    public function getAll()
    {
        $query = "
            SELECT f.id, u.username, f.feedback_text, f.submitted_at, f.status, f.image
            FROM user_feedback f
            LEFT JOIN users u ON f.user_id = u.id
            ORDER BY f.submitted_at DESC
        ";

        $stmt = $this->conn->prepare($query);
        if (!$stmt->execute()) {
            throw new Exception("Query execution failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $feedbackList = [];

        while ($row = $result->fetch_assoc()) {
            $feedbackList[] = $row;
        }

        return $feedbackList;
    }





    /* public function save($userId, $feedbackText)
     {
         $stmt = $this->conn->prepare("
             INSERT INTO user_feedback (user_id, feedback_text, status, image)
             VALUES (?, ?, ?, ?)
         ");

         $status = 'open';
         $image = null; // Assign a default value to $image
         $stmt->bind_param("isss", $userId, $feedbackText, $status, $image);

         if ($stmt->execute()) {
             return true;
         } else {
             error_log("Feedback insert failed: " . $stmt->error);
             return false;
         }
     }*/
    /* public function save($userId, $feedbackText, $image)
 {
     $status = 'open';
     

     // Check if an image file was uploaded
     if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

         $uploadDir = 'uploads/';
         $imageName = basename($_FILES['image']['name']);
         $targetPath = ;

         // Move uploaded file to target directory
         if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
             $imagePath = $targetPath; // Save path to store in DB
         } else {
             error_log("Failed to move uploaded image.");
         }
     }

     // Prepare and execute the insert query
     $stmt = $this->conn->prepare("
         INSERT INTO user_feedback (user_id, feedback_text, status, image)
         VALUES (?, ?, ?, ?)
     ");

     $stmt->bind_param("isss", $userId, $feedbackText, $status, $imagePath);

     if ($stmt->execute()) {
         return true;
     } else {
         error_log("Feedback insert failed: " . $stmt->error);
         return false;
     }
 }*/
    public function save($userId, $feedbackText, $image)
    {
        $status = 'open';

        $stmt = $this->conn->prepare("
        INSERT INTO user_feedback (user_id, feedback_text, status, image)
        VALUES (?, ?, ?, ?)
    ");

        $stmt->bind_param("isss", $userId, $feedbackText, $status, $image);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Feedback insert failed: " . $stmt->error);
            return false;
        }
    }



    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM user_feedback WHERE id = ?");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Delete failed: " . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

    public function updateStatus($feedbackId, $status)
    {
        $sql = "UPDATE user_feedback SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("si", $status, $feedbackId);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }



        return true;
    }





}



