<?php

use Dom\Comment;

require_once "connect.php";
session_start();

if (isset($_POST['feedback'])) {
    $m = $_POST['message'] ?? "";
    $r = intval($_POST['rating']) ?? "";
    $e = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ?? "";
    $n = $_POST['name'] ?? "";

    if (empty($m)) {
        $_SESSION['Alert'] = "Feedback Message Missing!";
        $_SESSION['Path'] = "../../index.php";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen($m) > 1000) {
        $_SESSION['Alert'] = "Feedback Message must not exceed 1000 characters!";
        $_SESSION['Path'] = "../../index.php";

        header('Location: ../../index.php');
        exit;
    } elseif (empty($r)) {
        $_SESSION['Alert'] = "Rating Missing!";
        $_SESSION['Path'] = "../../index.php";

        header('Location: ../../index.php');
        exit;
    } elseif ($r < 1 || $r > 5) {
        $_SESSION['Alert'] = "Rating cannot be anything other than 1-5";
        $_SESSION['Path'] = "../../index.php";

        header('Location: ../../index.php');
        exit;
    } elseif (empty($e)) {
        $_SESSION['Alert'] = "Email Missing!";
        $_SESSION['Path'] = "../../index.php";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen($e) > 50) {
        $_SESSION['Alert'] = "Email must not exceed 50 characters";
        $_SESSION['Path'] = "../../index.php";

        header('Location: ../../index.php');
        exit;
    } elseif (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['Alert'] = "Invalid Email";
        $_SESSION['Path'] = "../../index.php";

        header('Location: ../../index.php');
        exit;
    } elseif (empty($n)) {
        $_SESSION['Alert'] = "Name Missing!";
        $_SESSION['Path'] = "../../index.php";

        header('Location: ../../index.php');
        exit;
    } elseif (strlen($n) > 50) {
        $_SESSION['Alert'] = "Name must not exceed 50 characters";
        $_SESSION['Path'] = "../../index.php";

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
                $_SESSION['Path'] = "../../index.php";

                header('Location: ../../index.php');
                exit;
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Error Inserting Feedback.";
                $_SESSION['Path'] = "../../index.php";

                header('Location: ../../index.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
            $_SESSION['Path'] = "../../index.php";

            header('Location: ../../index.php');
            exit;
        }
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>