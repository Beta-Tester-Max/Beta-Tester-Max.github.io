<?php
require_once "connect.php";
session_start();

if (isset($_POST["editRequirement"])) {
    $arid = $_POST['arid'];
    $fid = $_POST['fid'];
    $a = $_SESSION['Account_ID'];
    $d = $_POST['document'];
    $date = date("Y/m/d");

    try {
        $pdo->beginTransaction();

        $sql = $pdo->prepare("SELECT File_Name FROM tbl_Files WHERE File_ID = :f");
        $sql->bindParam(":f", $fid, PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $data = sanitize($result);
            $of = $data['File_Name'];
            $ofdir = "../../Files/" . $of;

            if (file_exists($ofdir)) { 
            $nof = "deleted_" . $fid . "_" . $of;
            $nofdir = "../../Files/Deleted_Files/" . $nof;

                if (rename($ofdir, $nofdir)) {

                $sql = $pdo->prepare("UPDATE tbl_Files
                SET is_deleted = 1,
                File_Name = :fn
                WHERE File_ID = :f");
                $sql->bindParam(":fn", $nof, PDO::PARAM_STR);
                $sql->bindParam(":f", $fid, PDO::PARAM_INT);

                if ($sql->execute()) {
                    $f = $_FILES["file"]["name"];
                    $fS = $_FILES["file"]["size"];
                    $fTN = $_FILES["file"]["tmp_name"];
                    $e = pathinfo($f, PATHINFO_EXTENSION);
                    $nF = $a . "_" . $d . "." . $e;
                    $dir = "../../Files/";
                    $fP = $dir . $nF;

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
                                    $sql = $pdo->prepare("UPDATE tbl_account_requirements
                                    SET FILE_ID = :f,
                                    Status = 'Unvalidated',
                                    Date_Submitted = :date
                                    WHERE Account_Requirement_ID = :a");
                                    $sql->bindParam(":f", $f, PDO::PARAM_INT);
                                    $sql->bindParam(":date", $date, PDO::PARAM_STR);
                                    $sql->bindParam(":a", $arid, PDO::PARAM_INT);

                                    if ($sql->execute()) {
                                        $pdo->commit();

                                        $_SESSION['Alert'] = "Requirement Updated Successfully.";
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

                                    $_SESSION['Alert'] = "Error Updating Requirement.";
                                    $_SESSION['Path'] = "../../profile.php";

                                    header('Location: ../../index.php');
                                    exit;
                                }
                            } else {
                                $pdo->rollBack();

                                $_SESSION['Alert'] = "Error Insertingv New File.";
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
                } else {
                    $pdo->rollBack();

                    $_SESSION['Alert'] = "Failed in Deleting Old File.";
                    $_SESSION['Path'] = "../../profile.php";

                    header('Location: ../../index.php');
                    exit;
                }
            } else {
                $pdo->rollBack();

                    $_SESSION['Alert'] = "Failed in Moving Old File.";
                    $_SESSION['Path'] = "../../profile.php";

                    header('Location: ../../index.php');
                    exit;
            }
            } else {
                $pdo->rollBack();

                $_SESSION['Alert'] = "Old File does not exist.";
                $_SESSION['Path'] = "../../profile.php";

                header('Location: ../../index.php');
                exit;
            }
        } else {
            $pdo->rollBack();

            $_SESSION['Alert'] = "Error getting File Name.";
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