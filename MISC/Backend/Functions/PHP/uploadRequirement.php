<?php
require_once "connect.php";
session_start();

if (isset($_POST["uploadRequirement"])) {
    $a = $_SESSION['Account_ID'];
    $d = $_POST['document'];
    $f = $_FILES["file"]["name"];
    $fS = $_FILES["file"]["size"];
    $fTN = $_FILES["file"]["tmp_name"];
    $e = pathinfo($f, PATHINFO_EXTENSION);
    $nF = $a . "_" . $d . "." . $e;
    $dir = "../../Files/";
    $fP = $dir . $nF;

    try {
        $pdo->beginTransaction();

        $fsMB = ($fS / 1024) / 1024 . "MB";
        $mFS = 5 * 1024 * 1024;

        if ($fS <= $mFS) {
            $fT = mime_content_type($fTN);

            if ($fT === "application/pdf") {

                $sql = $pdo->prepare("INSERT INTO tbl_files (Account_ID, File_Name) VALUES (:a, :f)");
                $sql->bindParam(":a", $a, PDO::PARAM_INT);
                $sql->bindParam(":f", $nF, PDO::PARAM_STR);

                if ($sql->execute()) {
                    $f = $pdo->lastInsertId();

                    if (move_uploaded_file($fTN, $fP)) {
                        $sql = $pdo->prepare("INSERT INTO tbl_account_requirements (Account_ID, Document_ID, File_ID)
                                    VALUES (:a, :d, :f)");
                        $sql->bindParam(":a", $a, PDO::PARAM_INT);
                        $sql->bindParam(":d", $d, PDO::PARAM_INT);
                        $sql->bindParam(":f", $f, PDO::PARAM_INT);

                        if ($sql->execute()) {
                            $pdo->commit();

                            $_SESSION['Alert'] = "Requirement Submitted Successfully.";
                            $_SESSION['Path'] = "../../profile.php";

                            header('Location: ../../index.php');
                            exit;
                        } else {
                            $pdo->rollBack();

                            $_SESSION['Alert'] = "Error Moving File.";
                            $_SESSION['Path'] = "../../profile.php";

                            header('Location: ../../index.php');
                            exit;
                        }
                    } else {
                        $pdo->rollBack();

                        $_SESSION['Alert'] = "Error Inserting Requirement.";
                        $_SESSION['Path'] = "../../profile.php";

                        header('Location: ../../index.php');
                        exit;
                    }
                } else {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Error Inserting File.";
                    $_SESSION['Path'] = "../../profile.php";

                    header('Location: ../../index.php');
                    exit;
                }
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Your File may look like a PDF but its not, Most Likely a dummy created to look like one which is not allowed.";
                $_SESSION['Path'] = "../../profile.php";

                header('Location: ../../index.php');
                exit;
            }
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "You File has a size of $fsMB and is way above the Max Allowed File Size which is 5MB.";
            $_SESSION['Path'] = "../../profile.php";

            header('Location: ../../index.php');
            exit;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();

        $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
        $_SESSION['Path'] = "../../profile.php";

        header('Location: ../../index.php');
        exit;
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>