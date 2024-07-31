<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check honeypot
    if (!empty($_POST['honeypot'])) {
        exit("Spam detected!");
    }

    // Sanitize and validate input
    $name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8');

    if (empty($name) || empty($email) || empty($message)) {
        exit("Please fill in all fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Invalid email format.");
    }

    // Prepare email
    $to = "hello@charleneslimp.com";
    $subject = "New Contact Form Submission";
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $headers = "From: $name <$email>";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        // Redirect back to the contact page with a success message
        header("Location: contact.html?status=success");
        exit();
    } else {
        exit("Oops! Something went wrong and we couldn't send your message.");
    }
} else {
    exit("There was a problem with your submission, please try again.");
}
?>