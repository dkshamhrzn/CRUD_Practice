
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #F1C21B;
            margin: 0;
            padding: 0;
        }
        .feedback-container {
            background: #fff;
            max-width: 500px;
            margin: 40px auto;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        textarea {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
            resize: vertical;
        }
        input[type="submit"] {
            
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        .button-center{
            justify-content:center;
            display: flex;
            padding: 10px 10px 10px 10px;
        }
        #logout a {
            text-decoration: none;
            background-color: red;
            padding:10px 10px;
            color: white;
            border-radius: 4px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <?php 
    echo "<center><h1>Welcome, " . htmlspecialchars($_SESSION['user']['username'] ?? 'Guest') . "!</h1></center>";
    if (isset($_SESSION['message'])) {
        echo "<p style='color: red'; >" . htmlspecialchars($_SESSION['message']) . "</p>";
        unset($_SESSION['message']);
    }?>

    <!-- views/feedback_form.php -->
    <div class="feedback-container">
        <h2>Submit Feedback</h2>
        <h2><center>Was the system well built?</center></h2>
        <form method="POST" action="index.php?action=submit_feedback" enctype="multipart/form-data">
            <label>Feedback:</label>
            <textarea name="feedback_text" placeholder="Write your feedback..." required rows="6" cols="60"></textarea><br><br>
            <label>Evidence for any issues encountered:</label>
            <input type="file" name="image" placeholder="Upload evidence (optional)" ><br><br>
            <div class="button-center"><input type="submit" value="Submit Feedback"></div>
        </form>
        <div class="button-center" id="logout">
            <a href="index.php?action=logout" >Logout</a>
        </div>
        
    </div>
</body>
</html>
