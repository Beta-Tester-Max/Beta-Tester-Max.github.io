<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['mail']);
    $comment = htmlspecialchars($_POST['comment']);
    
    // Recipient email address
    $to = "betat378@gmail.com";
    
    // Email subject
    $subject = "New message from contact form";
    
    // Email body
    $message = "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Comment: $comment\n";
    
    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "Your message has been sent!";
    } else {
        echo "There was an error sending your message. Please try again later.";
    }
}
?>
