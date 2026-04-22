<?php
require_once __DIR__ . '/../models/FeedbackModel.php';
class AdminFeedbackController
{
    private $model;

    public function __construct()
    {
        $this->model = new FeedbackModel();
    }

    public function updateStatus($feedbackId, $status)
    {
        $validStatuses = ['open', 'resolved', 'ignored'];
        if (!in_array($status, $validStatuses)) {
            return;
        }
        $this->model->updateStatus($feedbackId, $status);
    }

    public function delete($feedbackId)
    {
        $this->model->delete($feedbackId);
        include __DIR__ . '/../views/admin/allfeedbacks.php'; 
    }

}
