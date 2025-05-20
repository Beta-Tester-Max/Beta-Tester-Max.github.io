<?php
require_once "connect.php";
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['createApplication'])) {
    // Retrieve form data
    $a = intval($_SESSION['Account_ID']) ?? "";
    $aid = intval($_POST['assistance']) ?? "";
    $h = intval($_POST['helpee']) ?? "";
    $rp = intval($_POST['rep']) ?? "";
    $r = $_POST['reason'] ?? "";

    // Validate input
    if (empty($a)) {
        $_SESSION['Alert'] = "Missing Account ID!";
        $_SESSION['Path'] = "../../createApp.php";
        header('Location: ../../index.php');
        exit;
    } elseif (empty($aid)) {
        $_SESSION['Alert'] = "Missing Assistance!";
        $_SESSION['Path'] = "../../createApp.php";
        header('Location: ../../index.php');
        exit;
    } elseif (strlen(trim(strval($aid))) > 11) {
        $_SESSION['Alert'] = "Assistance can only contain 11 digits";
        $_SESSION['Path'] = "../../createApp.php";
        header('Location: ../../index.php');
        exit;
    } else {
        try {
            // Start the database transaction
            $pdo->beginTransaction();

            // Check if assistance exists
            $sql = $pdo->prepare("SELECT * FROM tbl_assistance WHERE Assistance_ID = :a");
            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                // Validate helpee and representative
                if (empty($h) || empty($rp)) {
                    $pdo->rollBack();
                    $_SESSION['Alert'] = "Missing Beneficiary or Representative or both!";
                    $_SESSION['Path'] = "../../createApp.php";
                    header('Location: ../../index.php');
                    exit;
                } else {
                    // Check if helpee exists in the family composition
                    $sql = $pdo->prepare("SELECT * FROM tbl_family_composition WHERE Account_ID = :a AND User_ID = :h");
                    $sql->bindParam(":a", $a, PDO::PARAM_INT);
                    $sql->bindParam(":h", $h, PDO::PARAM_INT);
                    $sql->execute();

                    if ($sql->rowCount() > 0) {
                        // Check if representative exists in the family composition
                        $sql = $pdo->prepare("SELECT * FROM tbl_family_composition WHERE Account_ID = :a AND User_ID = :r");
                        $sql->bindParam(":a", $a, PDO::PARAM_INT);
                        $sql->bindParam(":r", $rp, PDO::PARAM_INT);
                        $sql->execute();

                        if ($sql->rowCount() > 0) {
                            // Retrieve requirements for the given assistance ID
                            $sql = $pdo->prepare("SELECT * FROM tbl_requirements WHERE Assistance_ID = :a");
                            $sql->bindParam(":a", $aid, PDO::PARAM_INT);
                            $sql->execute();

                            if ($sql->execute()) {
                                $rc = $sql->rowCount();
                                $c = $rc + 1;
                                $nf = "";

                                for ($i = 1; $i < $c; ++$i) {
                                    $d = $_POST['requirement' . $i] ?? "";
                                    $im = $_POST['importance' . $i] ?? "";

                                    if (empty($d)) {
                                        $pdo->rollBack();
                                        $_SESSION['Alert'] = "Missing Requirement!";
                                        $_SESSION['Path'] = "../../createApp.php";
                                        header('Location: ../../index.php');
                                        exit;
                                    } elseif (strlen(trim(strval($d))) > 11) {
                                        $_SESSION['Alert'] = "Requirement can only contain 11 digits";
                                        $_SESSION['Path'] = "../../createApp.php";
                                        header('Location: ../../index.php');
                                        exit;
                                    } else {
                                        $sql = $pdo->prepare("SELECT * FROM tbl_requirements WHERE Requirement_ID = :r");
                                        $sql->bindParam(":r", $d, PDO::PARAM_INT);
                                        $sql->execute();

                                        if ($sql->rowCount() === 0) {
                                            $pdo->rollBack();
                                            $_SESSION['Alert'] = "$d This Requirement does not exists.";
                                            $_SESSION['Path'] = "../../createApp.php";
                                            header('Location: ../../index.php');
                                            exit;
                                        } else {
                                            $fileKey = 'file' . $i;

                                            if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
                                                // Handle file upload
                                                $f = $_FILES[$fileKey]["name"];
                                                $fS = $_FILES[$fileKey]["size"];
                                                $fTN = $_FILES[$fileKey]["tmp_name"];
                                                $e = pathinfo($f, PATHINFO_EXTENSION);
                                                $nF = $a . "_" . $d . "." . $e;
                                                $dir = "../../Files/";
                                                $fP = $dir . $nF;

                                                // Validate file size
                                                $fsMB = number_format($fS / (1024 * 1024), 2) . "MB";
                                                $mFS = 5 * 1024 * 1024; // 5MB

                                                if ($fS <= $mFS) {
                                                    // Validate file type (PDF only)
                                                    $fT = mime_content_type($fTN);
                                                    if ($fT === "application/pdf") {
                                                        $sql = $pdo->prepare("SELECT * FROM tbl_files WHERE Account_ID = :a AND Requirement_ID = :r AND is_deleted = 0");
                                                        $sql->bindParam(":a", $a, PDO::PARAM_INT);
                                                        $sql->bindParam(":r", $d, PDO::PARAM_INT);
                                                        $sql->execute();

                                                        if ($sql->rowCount() > 0) {
                                                            $result = $sql->fetch(PDO::FETCH_ASSOC);
                                                            $data = sanitize($result);
                                                            $fid = $data['File_ID'] ?? "";
                                                            $of = $data['File_Name'] ?? "";
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
                                                                    $sql->execute();
                                                                } else {
                                                                    $pdo->rollBack();
                                                                    $_SESSION['Alert'] = "Error Renaming and Moving Deleted File. '$nof'";
                                                                    $_SESSION['Path'] = "../../createApp.php";
                                                                    header('Location: ../../index.php');
                                                                    exit;
                                                                }
                                                            } else {
                                                                $pdo->rollBack();
                                                                $_SESSION['Alert'] = "Couldn't Find File! '$nof'";
                                                                $_SESSION['Path'] = "../../createApp.php";
                                                                header('Location: ../../index.php');
                                                                exit;
                                                            }

                                                        }

                                                        $sql = $pdo->prepare("INSERT INTO tbl_files (Account_ID, File_Name, Requirement_ID) VALUES (:a, :f, :r)");
                                                        $sql->bindParam(":a", $a, PDO::PARAM_INT);
                                                        $sql->bindParam(":f", $nF, PDO::PARAM_STR);
                                                        $sql->bindParam(":r", $d, PDO::PARAM_INT);


                                                        if ($sql->execute()) {
                                                            // Track inserted file ID
                                                            if (!empty($nf)) {
                                                                $nf .= ", " . $pdo->lastInsertId();
                                                            } else {
                                                                $nf = $pdo->lastInsertId();
                                                            }

                                                            // Move uploaded file to destination folder
                                                            if (!move_uploaded_file($fTN, $fP)) {
                                                                $pdo->rollBack();
                                                                $_SESSION['Alert'] = "Error Moving File '$f'.";
                                                                $_SESSION['Path'] = "../../createApp.php";
                                                                header('Location: ../../index.php');
                                                                exit;
                                                            }
                                                        } else {
                                                            $pdo->rollBack();
                                                            $_SESSION['Alert'] = "Error Inserting File '$f' into Database.";
                                                            $_SESSION['Path'] = "../../createApp.php";
                                                            header('Location: ../../index.php');
                                                            exit;
                                                        }
                                                    } else {
                                                        $pdo->rollBack();
                                                        $_SESSION['Alert'] = "File '$f' is not a valid PDF.";
                                                        $_SESSION['Path'] = "../../createApp.php";
                                                        header('Location: ../../index.php');
                                                        exit;
                                                    }
                                                } else {
                                                    $pdo->rollBack();
                                                    $_SESSION['Alert'] = "File '$f' exceeds the maximum allowed size of 5MB.";
                                                    $_SESSION['Path'] = "../../createApp.php";
                                                    header('Location: ../../index.php');
                                                    exit;
                                                }
                                            } elseif ($im === 'Required') {
                                                $pdo->rollBack();
                                                $_SESSION['Alert'] = "Required Documents Can't Be empty.";
                                                $_SESSION['Path'] = "../../createApp.php";
                                                header('Location: ../../index.php');
                                                exit;
                                            }
                                        }
                                    }
                                }

                                $sql = $pdo->prepare("INSERT INTO tbl_applications (Account_ID, Assistance_ID, Beneficiary, Representative, Reason, Files)
                                VALUES (:a, :as, :h, :rp, :r, :f)");
                                $sql->bindParam(":a", $a, PDO::PARAM_INT);
                                $sql->bindParam(":as", $aid, PDO::PARAM_INT);
                                $sql->bindParam(":h", $h, PDO::PARAM_INT);
                                $sql->bindParam(":rp", $rp, PDO::PARAM_INT);
                                $sql->bindParam(":r", $r, PDO::PARAM_STR);
                                $sql->bindParam(":f", $nf, PDO::PARAM_STR);

                                if ($sql->execute()) {
                                    $pdo->commit();

                                    unset($_SESSION['sD']);
                                    $_SESSION['Alert'] = "Application Submitted Successfully!";
                                    $_SESSION['Path'] = "../../profile.php";

                                    header('Location: ../../index.php');
                                    exit;
                                } else {
                                    $pdo->rollBack();

                                    $_SESSION['Alert'] = "Error Inserting Data.";
                                    $_SESSION['Path'] = "../../createApp.php";

                                    header('Location: ../../index.php');
                                    exit;
                                }
                            } else {
                                $pdo->rollBack();
                                $_SESSION['Alert'] = "Couldn't Fetch Requirements.";
                                $_SESSION['Path'] = "../../createApp.php";
                                header('Location: ../../index.php');
                                exit;
                            }
                        } else {
                            $pdo->rollBack();
                            $_SESSION['Alert'] = "Representative is not an Existing User!";
                            $_SESSION['Path'] = "../../createApp.php";
                            header('Location: ../../index.php');
                            exit;
                        }
                    } else {
                        $pdo->rollBack();
                        $_SESSION['Alert'] = "Beneficiary is not an Existing User!";
                        $_SESSION['Path'] = "../../createApp.php";
                        header('Location: ../../index.php');
                        exit;
                    }
                }
            } else {
                $pdo->rollBack();
                $_SESSION['Alert'] = "Assistance does not exist!";
                $_SESSION['Path'] = "../../createApp.php";
                header('Location: ../../index.php');
                exit;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['Alert'] = "Connection Error: " . $e->getMessage();
            $_SESSION['Path'] = "../../createApp.php";
            header('Location: ../../index.php');
            exit;
        }
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>