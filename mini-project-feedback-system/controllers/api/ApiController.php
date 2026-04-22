<?php

class ApiController
{
    private $model;
    

    public function __construct() {
        $this->model = new FeedbackModel();
    }



    
    public function getFeedbackForApi()
    {
        $feedbackList = $this->model->getAll();
        // echo "<pre>";
        // print_r($feedbackList);
        // echo "</pre>";
        // exit;
        header('Content-Type: application/json');
        echo json_encode($feedbackList);
    }

    public function submitFeedbackApi()
    {
        // var_dump($_POST);
        // exit;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;
            $feedbackText = trim($_POST['feedback_text'] ?? '');
            $image = $_FILES['image'] ?? null;

            if ($userId && !empty($feedbackText)) {
                $success = $this->model->save($userId, $feedbackText, $image);
                if ($success) {
                    http_response_code(201); // Created
                    echo json_encode(['message' => 'Feedback submitted successfully.']);
                } else {
                    http_response_code(500); // Internal Server Error
                    echo json_encode(['message' => 'Failed to submit feedback.']);
                }
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Invalid input data.']);
            }
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['message' => 'Method not allowed.']);
        }
    } 

    /*public function deleteFeedbackApi($feedbackId)
    {
        try{if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($feedbackId)) {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Feedback ID is required.']);
                return;
            }
            $this->model->delete($feedbackId);
            http_response_code(204); // No Content
            echo json_encode(['message' => 'Feedback deleted successfully.']);
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['message' => 'Method not allowed.']);
        }}catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(['message' => 'Failed to delete feedback: ' . $e->getMessage()]);
        }
    }*/
   /* public function deleteFeedbackApi($feedbackId)
{
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            if (empty($feedbackId)) {
                http_response_code(400);
                echo json_encode(['message' => 'Feedback ID is required.']);
                return;
            }

            $this->model->delete($feedbackId);

            http_response_code(200);
            echo json_encode(['message' => 'Feedback deleted successfully.']);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed.']);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['message' => 'Failed to delete feedback: ' . $e->getMessage()]);
    }
}
*/
public function deleteFeedbackApi($feedbackId) {
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        if (empty($feedbackId)) {
            http_response_code(400);
            echo json_encode(['error' => 'Feedback ID is required']);
            return;
        }

        $Model = $this->model->delete($feedbackId);

        if (!$Model) {
            http_response_code(404);
            echo json_encode(['error' => 'Feedback not found']);
            return;
        }

        http_response_code(200);
        echo json_encode(['message' => 'Feedback deleted successfully!']);
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
}

public function updateFeedbackStatusApi()

{
    
    if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['message' => 'Method not allowed.']);
        return;
    }

    // Read JSON from the PUT request body
    $input = json_decode(file_get_contents('php://input'), true);

    $feedbackId = $input['feedbackId'] ?? null;
    $status = $input['status'] ?? null;

    if (empty($feedbackId) || empty($status)) {
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'Feedback ID and status are required.']);
        return;
    }

    if ($this->model->updateStatus($feedbackId, $status)) {
        http_response_code(200); // OK
        echo json_encode(['message' => 'Feedback status updated successfully.']);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['message' => 'Failed to update feedback status.']);
    }
}

/*
   public function updateFeedbackStatusApi($feedbackId, $status)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['message' => 'Method not allowed.']);
        return;
    }

    // Read JSON from the PUT request body
    $input = json_decode(file_get_contents('php://input'), true);

    $feedbackId = $input['feedbackId'] ?? null;
    $status = $input['status'] ?? null;

    if (empty($feedbackId) || empty($status)) {
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'Feedback ID and status are required.']);
        return;
    }

    if ($this->model->updateStatus($feedbackId, $status)) {
        http_response_code(200); // OK
        echo json_encode(['message' => 'Feedback status updated successfully.']);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['message' => 'Failed to update feedback status.']);
    }
}
 */


}
