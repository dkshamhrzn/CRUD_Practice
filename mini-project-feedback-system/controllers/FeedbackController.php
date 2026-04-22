<?php
// Controller.php
require_once __DIR__ . '/../models/FeedbackModel.php';


class FeedbackController
{
    private $model;


    public function __construct()
    {
        $this->model = new FeedbackModel();
    }

    public function showAllFeedbacks()
    {
        $feedbackList = $this->model->getAll();
        include 'views/admin/allfeedbacks.php';

        return $feedbackList;
    }

    public function showFeedbackForm()
    {
        include __DIR__ . '/../views/feedback_form.php';
    }

    public function submitFeedback($userId, $feedbackText, $image)
    {
        $success = $this->model->save($userId, $feedbackText, $image);

        if ($success) {
            $_SESSION['feedback_success'] = '✅ Feedback submitted successfully! Would you like to submit another?';
            header("Location: index.php?action=feedback");
        } else {
            echo "<p>Failed to submit feedback. Try again.</p>";
            echo "<a href='index.php?action=feedback'>Back</a>";
        }
    }


}
