<?php
session_start();



$action = $_POST['action'] ?? $_GET['action'] ?? 'home';


require_once 'controllers/UserController.php';
require_once 'controllers/FeedbackController.php';
require_once 'controllers/AdminFeedbackController.php';
require_once 'controllers/api/ApiController.php';
require_once 'controllers/api/UserApiController.php';
$userController = new UserController();

$AdminfeedbackController = new AdminFeedbackController();

$feedbackController = new FeedbackController();

$ApiController = new ApiController();

$UserApiController = new UserApiController();


switch ($action) {
    case 'login':
        $userController->login();
        break;

    case 'signup':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->signup($_POST['username'], $_POST['email'], $_POST['password']);
        } else {
            include 'views/signup.php';
        }
        break;

    case 'feedback':
        if (isset($_SESSION['user'])) {
            include 'views/feedback_form.php';
        } else {
            echo "<script>alert('Please log in to submit feedback.'); window.location.href = 'index.php?action=login';</script>";
            exit;
        }
        break;


    case 'admin':

        $feedbackController->showAllFeedbacks();
        break;

    /*case 'submit_feedback':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //$feedbackController = new FeedbackController();
            $userId = $_SESSION['user']['id'] ?? null;  // Fix here
            $feedbackText = trim($_POST['feedback_text'] ?? '');
            $image = time() . $_FILES['image'] ?? null;
            if ($userId && !empty($feedbackText)) {
                $feedbackController->submitFeedback($userId, $feedbackText, $image);
                exit;
            } else {
                echo "Please log in and write some feedback.";
            }
        }
        break;
*/
    case 'submit_feedback':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'] ?? null;
            $feedbackText = trim($_POST['feedback_text'] ?? '');

            $imagePath = null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $imagePath = $uploadDir . $fileName;

                // Create uploads/ directory if it doesn't exist
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Move uploaded file
                if (!move_uploaded_file($fileTmpPath, $imagePath)) {
                    echo "Image upload failed.";
                    exit;
                }
            }

            if ($userId && !empty($feedbackText)) {
                $feedbackController->submitFeedback($userId, $feedbackText, $imagePath);
                exit;
            } else {
                echo "Please log in and write some feedback.";
            }
        }
        break;


    case 'update_feedback_status':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            if ($id && $status) {
                $AdminfeedbackController->updateStatus($id, $status);
                header('Location: index.php?action=admin');
                exit;
            } else {
                echo "Invalid data provided.";
            }
        }
        break;

    case 'delete_feedback':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $AdminfeedbackController->delete($id);
                header('Location: index.php?action=admin');
                exit;
            } else {
                echo "Invalid feedback ID.";
            }
        }
        break;

    case 'logout':
        $userController->logout();
        break;

    case 'home':
        include 'views/home.php';
        break;
    case 'api_feedback':
        $ApiController->getFeedbackForApi();
        exit;

    case 'api_submit_feedback':
        $ApiController->submitFeedbackApi();
        exit;

    /*case 'api_delete_feedback':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $ApiController->deleteFeedbackApi($id);
                header('Location: index.php?action=admin');
                exit;
            } else {
                echo "Invalid feedback ID.";
            }
        }
        break;

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $id = $_Post['id'] ?? null;
            $ApiController->deleteFeedbackApi($id);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed.']);
        }
        break;*/
    case 'api_delete_feedback':
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

            if (stripos($contentType, 'application/json') !== false) {
                $deleteData = json_decode(file_get_contents("php://input"), true);
            } else {
                parse_str(file_get_contents("php://input"), $deleteData);
            }

            $id = $deleteData['id'] ?? null;

            if ($id) {
                $ApiController->deleteFeedbackApi($id);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Invalid feedback ID.']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed.']);
        }
        break;



    /* case 'api_update_status':

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $id = $_POST['id'] ?? null;
             $status = $_POST['status'] ?? null;

             if ($id && $status) {
                 $ApiController->updateFeedbackStatusApi($id, $status);
                 header('Location: index.php?action=admin');
                 exit;
             } else {
                 echo "Invalid data provided.";
             }
         }
         break;*/
    case 'api_update_status':
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $ApiController->updateFeedbackStatusApi();
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed.']);
        }
        break;


    case 'api_login':
        $UserApiController->loginApi();
        exit;

    case 'api_signup':
        $UserApiController->signupApi();
        exit;

    default:
        if (!isset($_SESSION['user_id'])) {
            header("Location: views/home.php");
            exit();
        }
}
