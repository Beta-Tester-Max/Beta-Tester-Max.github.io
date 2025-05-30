<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['feedback'])) {
    $m = $_POST['message'] ?? "";
    $r = intval(trim($_POST['rating'])) ?? "";
    $e = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) ?? "";
    $n = $_POST['name'] ?? "";

    if (empty($m)) {
        $_SESSION['Alert'] = "Feedback Message Missing!";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen($m) > 1000) {
        $_SESSION['Alert'] = "Feedback Message must not exceed 1000 characters!";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen(trim($m)) < 10) {
        $_SESSION['Alert'] = "Feedback Message must not be shorter than 10 characters! Space not included.";

        header('Location: ../../index.php');
        exit;
    } elseif (empty($r)) {
        $_SESSION['Alert'] = "Rating Missing!";

        header('Location: ../../index.php');
        exit;
    } elseif ($r < 1 || $r > 5) {
        $_SESSION['Alert'] = "Rating cannot be anything other than 1-5";

        header('Location: ../../index.php');
        exit;
    } elseif (empty($e)) {
        $_SESSION['Alert'] = "Email Missing!";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen($e) > 50) {
        $_SESSION['Alert'] = "Email must not exceed 50 characters";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen($e) < 3) {
        $_SESSION['Alert'] = "Email must not be shorter than 3 characters! Space not included.";

        header('Location: ../../index.php');
        exit;
    } elseif (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['Alert'] = "Invalid Email";

        header('Location: ../../index.php');
        exit;
    } elseif (empty($n)) {
        $_SESSION['Alert'] = "Name Missing!";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen($n) > 50) {
        $_SESSION['Alert'] = "Name must not exceed 50 characters";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen(trim($n)) < 3) {
        $_SESSION['Alert'] = "Name must not shorter than 3 characters! Space not included";

        header('Location: ../../index.php');
        exit;
    } else {
        try {
            $pdo->beginTransaction();

            $sql = $pdo->prepare("INSERT INTO tbl_feedbacks (Message, Rating, Email, Name)
            VALUES (:m, :r, :e, :n)");
            $sql->bindParam(":m", $m, PDO::PARAM_STR);
            $sql->bindParam(":r", $r, PDO::PARAM_INT);
            $sql->bindParam(":e", $e, PDO::PARAM_STR);
            $sql->bindParam(":n", $n, PDO::PARAM_STR);

            if ($sql->execute()) {
                $pdo->commit();

                $_SESSION['Alert'] = "Thank you! for your Feedback.";

                header('Location: ../../index.php');
                exit;
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Error Inserting Feedback.";

                header('Location: ../../index.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();

            header('Location: ../../index.php');
            exit;
        }
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>