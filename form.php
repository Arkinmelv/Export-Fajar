<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject'])); // Perbaiki nama field
    $message = htmlspecialchars(trim($_POST['message']));

    $errors = [];

    // Validasi input
    if (empty($name)) $errors[] = "Name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($phone)) $errors[] = "Phone number is required.";
    if (empty($subject)) $errors[] = "Subject is required.";
    if (empty($message)) $errors[] = "Message is required.";

    if (empty($errors)) {
        $to = "arkinmelviansyah@gmail.com"; // Ganti dengan email tujuan Anda
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Format pesan email
        $mailBody = "Name: $name\n";
        $mailBody .= "Email: $email\n";
        $mailBody .= "Phone: $phone\n";
        $mailBody .= "Subject: $subject\n";
        $mailBody .= "Message:\n$message";

        // Kirim email
        if (mail($to, $subject, $mailBody, $headers)) {
            echo "<script>alert('Message sent successfully.');</script>";
        } else {
            echo "<script>alert('Failed to send the message. Please try again later.');</script>";
        }
    } else {
        // Tampilkan semua error
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}
?>
