<?php
  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['honeypot'])) {
      exit("Spam detected!");
    }
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate the form data
    if (empty($name) || empty($email) || empty($message)) {
      die('Please fill in all fields.');
    }

    // Send an email
    $to = 'hello@charleneslimp.com';
    $subject = 'Charlene Slimp Website Contact';
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
      echo 'Thank you for contacting me.';
    } else {
      echo 'There was a problem sending your message. Please try again.';
    }
  }
