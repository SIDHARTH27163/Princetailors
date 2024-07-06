<?php
include('../inlcudes/db.php');
// Create the ContactUs table if it doesn't exist
$createTableSql = "
CREATE TABLE IF NOT EXISTS ContactUs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($createTableSql)) {
    die("Table creation failed: " . $conn->error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert data into the ContactUs table
    $stmt = $conn->prepare("INSERT INTO ContactUs (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Data inserted successfully, now send the email
        $to = 'princetailorsdharamshala@gmail.com';
        $email_subject = "Contact Form Submission: $subject";
        $email_body = "You have received a new message from the contact form.\n\n".
                      "Here are the details:\n".
                      "Name: $name\n".
                      "Email: $email\n".
                      "Subject: $subject\n".
                      "Message: \n$message";

        $headers = "From: noreply@princetailorsdharamshala.com\n";
        $headers .= "Reply-To: $email";

        if (mail($to, $email_subject, $email_body, $headers)) {
            echo "Thank you! Your message has been sent.";
        } else {
            echo "Sorry! Your message could not be sent.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
