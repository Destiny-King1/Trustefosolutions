<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validate input
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please complete the form and provide a valid email address.";
        exit;
    }

    // Recipient email address (your email)
    $recipient = "redeemerkotoka@gmail.com";

    // Email subject
    $subject = "New message from $name";

    // Build the email content.
    $email_content  = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    // If not a POST request, show a simple error message.
    echo "There was a problem with your submission. Please try again.";
}
?>