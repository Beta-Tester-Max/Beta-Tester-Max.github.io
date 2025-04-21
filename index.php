<?php include "connect.php";
session_start();
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AICS System demo</title>
    <link rel="icon" type="image/x-icon" href="./img/AICS150.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="index.css">
    <style>
        .logo {
            height: 2em;
            width: 2em;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .feedback-container {
            background-color: #0066CC;
            padding: 20px;
            color: white;
        }

        .feedback-form {
            display: flex;
            flex-wrap: wrap;
            gap: 90px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .form-left {
            flex: 1;
            min-width: 300px;
        }

        .form-right {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
        }

        h2 {
            margin-bottom: 15px;
            font-size: 48px;
        }

        .feedback-textarea {
            width: 100%;
            padding: 10px;
            resize: none;
            border: none;
            background-color: #ddd;
        }

        .stars {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .star {
            color: #ddd;
            font-size: 60px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star.active {
            color: gold;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 20px;
            margin-bottom: 10px;
            background-color: #eee;
        }

        .submit-btn {
            background-color: white;
            color: #0066CC;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            align-self: flex-end;
            font-weight: bold;
        }

        .submit-btn:hover {
            background-color: #f0f0f0;
        }

        @media (max-width: 600px) {
            .feedback-form {
                flex-direction: column;
            }
        }

        .footer-container {
            background-color: #0066CC;
            color: white;
            margin-top: auto;
        }

        .footer-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .footer-section {
            flex: 1;
            padding: 0 15px;
        }

        .footer-section h2 {
            font-size: 22px;
            margin-bottom: 15px;
            border-bottom: 1px solid #fff;
            padding-bottom: 5px;
        }

        .footer-section p {
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .footer-section a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        .map-container {
            margin-top: 10px;
            width: 100%;
            height: 200px;
            background-color: #eee;
        }

        .info-table {
            background-color: #fff;
            color: #0066CC;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 15px;
        }

        .info-table tr {
            border-bottom: 1px solid #eee;
        }

        .info-table td {
            padding: 8px 15px;
        }

        .info-table tr:last-child {
            border-bottom: none;
        }

        .info-table th {
            width: 50%;
            padding: 8px 15px;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .logo-image {
            width: 120px;
            height: auto;
            margin: 0 10px;
        }

        .copyright {
            text-align: left;
            padding: 15px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            .footer-grid {
                flex-direction: column;
            }

            .footer-section {
                margin-bottom: 20px;
            }

            .logo-container {
                flex-direction: column;
                align-items: center;
            }

            .logo-image {
                margin: 10px 0;
            }
        }
    </style>
</head>

<body class="overflow-x-hidden" style="min-width: 20em;">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img class="logo" src="./img/AICS150.png" alt="AICS">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Assistance
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (empty($_SESSION['userid'])) {
                            ?>
                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop01">
                                        Create Application
                                    </button>
                                </li>
                                <?php } else {
                                $rows = [];
                                $sql = "SELECT Document_Type 
                                        FROM requirements_tbl 
                                        where User_ID = '$userid' AND Status = 'Validated'";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $rows[] = $row['Document_Type'];
                                }
                                if (in_array("Barangay Indigency", $rows)) {
                                    if (in_array("Medical Certificate Referral", $rows)) {
                                        if (in_array("Death Certificate", $rows) || in_array("Medical Report", $rows)) {
                                            if (in_array("Police Report", $rows)) {
                                                if (in_array("Representative Valid ID", $rows)) {
                                                    if (in_array("Valid ID", $rows)) {
                                                        if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                ?>
                                                            <li>
                                                                <form method="POST">
                                                                    <button type="submit" class="dropdown-item" name="traass"
                                                                        value="Transportation Assistance">Transportation Assistance</button>
                                                                </form>
                                                            </li><?php if (isset($_POST['traass'])) {
                                                                        $_SESSION['assistancetype'] = $_POST['traass'];
                                                                        $_SESSION['goback'] = "index.php";
                                                                    ?>
                                                                <script>
                                                                    window.location.href = "application.php"
                                                                </script><?php
                                                                        }
                                                                    } else {
                                                                        $modaltatext = "Birth Certificate or Marriage Certificate";
                                                                            ?>
                                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#TransportationAssistance">
                                                                    Transportation Assistance
                                                                </button>
                                                            </li><?php
                                                                    }
                                                                } else {
                                                                    $modaltatext = "Valid ID";
                                                                    ?>
                                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#TransportationAssistance">
                                                                Transportation Assistance
                                                            </button>
                                                        </li><?php
                                                                }
                                                            } else {
                                                                $modaltatext = "Representative Valid ID";
                                                                ?>
                                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#TransportationAssistance">
                                                            Transportation Assistance
                                                        </button>
                                                    </li><?php
                                                            }
                                                        } else {
                                                            $modaltatext = "Police Report";
                                                            ?>
                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#TransportationAssistance">
                                                        Transportation Assistance
                                                    </button>
                                                </li><?php
                                                        }
                                                    } else {
                                                        $modaltatext = "Death Certificate or Medical Report";
                                                        ?>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#TransportationAssistance">
                                                    Transportation Assistance
                                                </button>
                                            </li><?php
                                                    }
                                                } else {
                                                    $modaltatext = "Medical Certificate Referral";
                                                    ?>
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#TransportationAssistance">
                                                Transportation Assistance
                                            </button>
                                        </li><?php
                                                }
                                            } else {
                                                $modaltatext = "Barangay Indigency";
                                                ?>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#TransportationAssistance">
                                            Transportation Assistance
                                        </button>
                                    </li><?php
                                            }
                                            if (in_array("Barangay Indigency", $rows)) {
                                                if (in_array("Medical Certificate", $rows) || in_array("Clinical Abstract", $rows)) {
                                                    if (in_array("Hospital Billing Statement", $rows)) {
                                                        if (in_array("Pharmacy Quotation", $rows)) {
                                                            if (in_array("Laboratory Request", $rows) || in_array("Diagnostic Request", $rows)) {
                                                                if (in_array("Official Receipts", $rows)) {
                                                                    if (in_array("Outstanding Payer Certificate", $rows)) {
                                                                        if (in_array("Representative Valid ID", $rows)) {
                                                                            if (in_array("Authorization Letter", $rows)) {
                                                                                if (in_array("Valid ID", $rows)) {
                                                                                    if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                            ?>
                                                                            <li>
                                                                                <form method="POST">
                                                                                    <button type="submit" class="dropdown-item" name="medass"
                                                                                        value="Medical Assistance">Medical Assistance</button>
                                                                                </form>
                                                                            </li><?php if (isset($_POST['medass'])) {
                                                                                            $_SESSION['assistancetype'] = $_POST['medass'];
                                                                                            $_SESSION['goback'] = "index.php";
                                                                                    ?>
                                                                                <script>
                                                                                    window.location.href = "application.php"
                                                                                </script><?php
                                                                                        }
                                                                                    } else {
                                                                                        $modalmatext = "Birth Certificate or Marriage Certificate";
                                                                                            ?>
                                                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                                    data-bs-target="#MedicalAssistance">
                                                                                    Medical Assistance
                                                                                </button>
                                                                            </li><?php
                                                                                    }
                                                                                } else {
                                                                                    $modalmatext = "Valid ID";
                                                                                    ?>
                                                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                                data-bs-target="#MedicalAssistance">
                                                                                Medical Assistance
                                                                            </button>
                                                                        </li><?php
                                                                                }
                                                                            } else {
                                                                                $modalmatext = "Authorization Letter";
                                                                                ?>
                                                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                            data-bs-target="#MedicalAssistance">
                                                                            Medical Assistance
                                                                        </button>
                                                                    </li><?php
                                                                            }
                                                                        } else {
                                                                            $modalmatext = "Representative Valid ID";
                                                                            ?>
                                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                        data-bs-target="#MedicalAssistance">
                                                                        Medical Assistance
                                                                    </button>
                                                                </li><?php
                                                                        }
                                                                    } else {
                                                                        $modalmatext = "Outstanding Payer Certificate";
                                                                        ?>
                                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#MedicalAssistance">
                                                                    Medical Assistance
                                                                </button>
                                                            </li><?php
                                                                    }
                                                                } else {
                                                                    $modalmatext = "Official Receipts";
                                                                    ?>
                                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#MedicalAssistance">
                                                                Medical Assistance
                                                            </button>
                                                        </li><?php
                                                                }
                                                            } else {
                                                                $modalmatext = "Laboratory Request or Diagnostic Request";
                                                                ?>
                                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#MedicalAssistance">
                                                            Medical Assistance
                                                        </button>
                                                    </li><?php
                                                            }
                                                        } else {
                                                            $modalmatext = "Pharmacy Quotation";
                                                            ?>
                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#MedicalAssistance">
                                                        Medical Assistance
                                                    </button>
                                                </li><?php
                                                        }
                                                    } else {
                                                        $modalmatext = "Hospital Billing Statement";
                                                        ?>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#MedicalAssistance">
                                                    Medical Assistance
                                                </button>
                                            </li><?php
                                                    }
                                                } else {
                                                    $modalmatext = "Medical Certificate or Clinical Abstract";
                                                    ?>
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#MedicalAssistance">
                                                Medical Assistance
                                            </button>
                                        </li><?php
                                                }
                                            } else {
                                                $modalmatext = "Barangay Indigency";
                                                ?>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#MedicalAssistance">
                                            Medical Assistance
                                        </button>
                                    </li><?php
                                            }
                                            if (in_array("Barangay Indigency", $rows)) {
                                                if (in_array("Death Certificate", $rows)) {
                                                    if (in_array("Funeral Contract", $rows)) {
                                                        if (in_array("Official Receipts", $rows)) {
                                                            if (in_array("Representative Valid ID", $rows)) {
                                                                if (in_array("Valid ID", $rows)) {
                                                                    if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                                        if (in_array("Authorization Letter", $rows)) {
                                                                            if (in_array("Marriage Contract", $rows)) {
                                                                                if (in_array("Outstanding Payer Certificate", $rows)) {
                                            ?>
                                                                        <li>
                                                                            <form method="POST">
                                                                                <button type="submit" class="dropdown-item" name="burass"
                                                                                    value="Burial Assistance">Burial Assistance</button>
                                                                            </form>
                                                                        </li><?php if (isset($_POST['burass'])) {
                                                                                        $_SESSION['assistancetype'] = $_POST['burass'];
                                                                                        $_SESSION['goback'] = "index.php";
                                                                                ?>
                                                                            <script>
                                                                                window.location.href = "application.php"
                                                                            </script><?php
                                                                                    }
                                                                                } else {
                                                                                    $modalbatext = "Outstanding Payer Certificate";
                                                                                        ?>
                                                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                                data-bs-target="#BurialAssistance">
                                                                                Burial Assistance
                                                                            </button>
                                                                        </li><?php
                                                                                }
                                                                            } else {
                                                                                $modalbatext = "Marriage Contract";
                                                                                ?>
                                                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                            data-bs-target="#BurialAssistance">
                                                                            Burial Assistance
                                                                        </button>
                                                                    </li><?php
                                                                            }
                                                                        } else {
                                                                            $modalbatext = "Authorization Letter";
                                                                            ?>
                                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                        data-bs-target="#BurialAssistance">
                                                                        Burial Assistance
                                                                    </button>
                                                                </li><?php
                                                                        }
                                                                    } else {
                                                                        $modalbatext = "Birth Certificate or Marriage Certificate";
                                                                        ?>
                                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#BurialAssistance">
                                                                    Burial Assistance
                                                                </button>
                                                            </li><?php
                                                                    }
                                                                } else {
                                                                    $modalbatext = "Valid ID";
                                                                    ?>
                                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#BurialAssistance">
                                                                Burial Assistance
                                                            </button>
                                                        </li><?php
                                                                }
                                                            } else {
                                                                $modalbatext = "Representative Valid ID";
                                                                ?>
                                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#BurialAssistance">
                                                            Burial Assistance
                                                        </button>
                                                    </li><?php
                                                            }
                                                        } else {
                                                            $modalbatext = "Official Receipts";
                                                            ?>
                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#BurialAssistance">
                                                        Burial Assistance
                                                    </button>
                                                </li><?php
                                                        }
                                                    } else {
                                                        $modalbatext = "Funeral Contract";
                                                        ?>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#BurialAssistance">
                                                    Burial Assistance
                                                </button>
                                            </li><?php
                                                    }
                                                } else {
                                                    $modalbatext = "Death Certificate";
                                                    ?>
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#BurialAssistance">
                                                Burial Assistance
                                            </button>
                                        </li><?php
                                                }
                                            } else {
                                                $modalbatext = "Barangay Indigency";
                                                ?>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#BurialAssistance">
                                            Burial Assistance
                                        </button>
                                    </li><?php
                                            }
                                            if (in_array("Barangay Indigency", $rows)) {
                                                if (in_array("Enrollment Assessment Form", $rows) || in_array("Certificate of Enrollment", $rows)) {
                                                    if (in_array("School ID", $rows)) {
                                                        if (in_array("Grade", $rows)) {
                                                            if (in_array("Police Report", $rows) || in_array("Social Worker's Assessment", $rows)) {
                                            ?>
                                                    <li>
                                                        <form method="POST">
                                                            <button type="submit" class="dropdown-item" name="eduass"
                                                                value="Educational Assistance">Educational Assistance</button>
                                                        </form>
                                                    </li><?php if (isset($_POST['eduass'])) {
                                                                    $_SESSION['assistancetype'] = $_POST['eduass'];
                                                                    $_SESSION['goback'] = "index.php";
                                                            ?>
                                                        <script>
                                                            window.location.href = "application.php"
                                                        </script><?php
                                                                }
                                                            } else {
                                                                $modaleatext = "Police Report or Social Worker's Assessment";
                                                                    ?>
                                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#EducationalAssistance">
                                                            Educational Assistance
                                                        </button>
                                                    </li><?php
                                                            }
                                                        } else {
                                                            $modaleatext = "Grade";
                                                            ?>
                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#EducationalAssistance">
                                                        Educational Assistance
                                                    </button>
                                                </li><?php
                                                        }
                                                    } else {
                                                        $modaleatext = "School ID";
                                                        ?>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#EducationalAssistance">
                                                    Educational Assistance
                                                </button>
                                            </li><?php
                                                    }
                                                } else {
                                                    $modaleatext = "Enrollment Assessment Form or Certificate of Enrollment";
                                                    ?>
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#EducationalAssistance">
                                                Educational Assistance
                                            </button>
                                        </li><?php
                                                }
                                            } else {
                                                $modaleatext = "Barangay Indigency";
                                                ?>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#EducationalAssistance">
                                            Educational Assistance
                                        </button>
                                    </li><?php
                                            }
                                            if (in_array("Barangay Indigency", $rows)) {
                                                if (in_array("Valid ID", $rows)) {
                                                    if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                            ?>
                                            <li>
                                                <form method="POST">
                                                    <button type="submit" class="dropdown-item" name="fooass"
                                                        value="Food Assistance">Food Assistance</button>
                                                </form>
                                            </li><?php if (isset($_POST['fooass'])) {
                                                            $_SESSION['assistancetype'] = $_POST['fooass'];
                                                            $_SESSION['goback'] = "index.php";
                                                    ?>
                                                <script>
                                                    window.location.href = "application.php"
                                                </script><?php
                                                        }
                                                    } else {
                                                        $modalfatext = "Birth Certificate or Marriage Certificate";
                                                            ?>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#FoodAssistance">
                                                    Food Assistance
                                                </button>
                                            </li><?php
                                                    }
                                                } else {
                                                    $modalfatext = "Valid ID";
                                                    ?>
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#FoodAssistance">
                                                Food Assistance
                                            </button>
                                        </li><?php
                                                }
                                            } else {
                                                $modalfatext = "Barangay Indigency";
                                                ?>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#FoodAssistance">
                                            Food Assistance
                                        </button>
                                    </li><?php
                                            }
                                            if (in_array("Barangay Indigency", $rows)) {
                                                if (in_array("Valid ID", $rows)) {
                                                    if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                        if (in_array("Incident Report", $rows)) {
                                            ?>
                                                <li>
                                                    <form method="POST">
                                                        <button type="submit" class="dropdown-item" name="casass"
                                                            value="Cash Relief Assistance">Cash Relief Assistance</button>
                                                    </form>
                                                </li><?php if (isset($_POST['casass'])) {
                                                                $_SESSION['assistancetype'] = $_POST['casass'];
                                                                $_SESSION['goback'] = "index.php";
                                                        ?>
                                                    <script>
                                                        window.location.href = "application.php"
                                                    </script><?php
                                                            }
                                                        } else {
                                                            $modalcratext = "Incident Report";
                                                                ?>
                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#CashReliefAssistance">
                                                        Cash Relief Assistance
                                                    </button>
                                                </li><?php
                                                        }
                                                    } else {
                                                        $modalcratext = "Birth Certificate or Marriage Certificate";
                                                        ?>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#CashReliefAssistance">
                                                    Cash Relief Assistance
                                                </button>
                                            </li><?php
                                                    }
                                                } else {
                                                    $modalcratext = "Valid ID";
                                                    ?>
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#CashReliefAssistance">
                                                Cash Relief Assistance
                                            </button>
                                        </li><?php
                                                }
                                            } else {
                                                $modalcratext = "Barangay Indigency";
                                                ?>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#CashReliefAssistance">
                                            Cash Relief Assistance
                                        </button>
                                    </li><?php
                                            }
                                            if (in_array("Barangay Indigency", $rows)) {
                                                if (in_array("Valid ID", $rows)) {
                                                    if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                        if (in_array("Referral Letter", $rows)) {
                                            ?>
                                                <li>
                                                    <form method="POST">
                                                        <button type="submit" class="dropdown-item" name="psysup"
                                                            value="Psychosocial Support">Psychosocial Support</button>
                                                    </form>
                                                </li><?php if (isset($_POST['psysup'])) {
                                                                $_SESSION['assistancetype'] = $_POST['psysup'];
                                                                $_SESSION['goback'] = "index.php";
                                                        ?>
                                                    <script>
                                                        window.location.href = "application.php"
                                                    </script><?php
                                                            }
                                                        } else {
                                                            $modalpstext = "Referral Letter";
                                                                ?>
                                                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#PsychosocialSupport">
                                                        Psychosocial Support
                                                    </button>
                                                </li><?php
                                                        }
                                                    } else {
                                                        $modalpstext = "Birth Certificate or Marriage Certificate";
                                                        ?>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#PsychosocialSupport">
                                                    Psychosocial Support
                                                </button>
                                            </li><?php
                                                    }
                                                } else {
                                                    $modalpstext = "Valid ID";
                                                    ?>
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#PsychosocialSupport">
                                                Psychosocial Support
                                            </button>
                                        </li><?php
                                                }
                                            } else {
                                                $modalpstext = "Barangay Indigency";
                                                ?>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#PsychosocialSupport">
                                            Psychosocial Support
                                        </button>
                                    </li><?php
                                            }
                                        }
                                        if (isset($_SESSION['userid'])) {
                                            ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="assistanceoptions.php">Create Application</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <div class="search-container">
                    <form class="d-flex m-auto" role="search">
                        <input class="form-control me-2 searchbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-outline-light searchbtn" type="submit">Search</button>
                    </form>
                </div>
                <?php if (empty($_SESSION['userid'])) { ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <p class="nav-link btn-secondary pe-none">or</p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Sign up</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?php $sql = "SELECT Username FROM register_tbl where User_ID = '$userid'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['Username'] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="messaging.php">Messages</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="modal fade" id="staticBackdrop01" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">You are not <b>Signed In</b>.</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You must be <b>Signed In</b> to be able to create an application.</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <a type="button" class="btn btn-primary" href="login.php">Go to login</a>
                    </div>
                </div>
            </div>
        </div>
        <?php $assistancetype = array(
            'Transportation Assistance',
            'Medical Assistance',
            'Burial Assistance',
            'Educational Assistance',
            'Food Assistance',
            'Cash Relief Assistance',
            'Psychosocial Support',
        );
        foreach ($assistancetype as $at) { ?>
            <div class="modal fade" id="<?php echo str_replace(" ", "", $at) ?>" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">You are missing some <b>Requirements</b>.
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>You Are Either Missing <b><?php
                                                            switch ($at) {
                                                                case 'Transportation Assistance':
                                                                    echo $modaltatext;
                                                                    break;
                                                                case 'Medical Assistance':
                                                                    echo $modalmatext;
                                                                    break;
                                                                case 'Burial Assistance':
                                                                    echo $modalbatext;
                                                                    break;
                                                                case 'Educational Assistance':
                                                                    echo $modaleatext;
                                                                    break;
                                                                case 'Food Assistance':
                                                                    echo $modalfatext;
                                                                    break;
                                                                case 'Cash Relief Assistance':
                                                                    echo $modalcratext;
                                                                    break;
                                                                case 'Psychosocial Support':
                                                                    echo $modalpstext;
                                                                    break;
                                                            }
                                                            ?></b> or it's Not Validated.</p>
                        </div>
                        <div class="modal-footer d-flex justify-content-center align-items-center">
                            <a type="button" class="btn btn-primary" href="profile.php#requirements">Upload Missing
                                Requirements</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center" style="height: 10em;">
                <?php if (isset($_SESSION['userid'])) {
                ?>
                    <h1>Hello! <?php $sql = "SELECT Fname, Mname, Lname FROM userinfo_tbl where User_ID = '$userid'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                if (empty($row['Mname'])) {
                                    echo $row['Fname'] . "&nbsp;" . $row['Lname'];
                                } else {
                                    echo $row['Fname'] . "&nbsp;" . $row['Mname'] . "&nbsp;" . $row['Lname'];
                                }
                                ?>.</h1>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Brief Description start-->
    <div class="aics">AICS</div>
    <div class="brief-desc">
        The Municipality of Alaminos, Laguna, through its Municipal Social Welfare
        and Development Office (MSWDO) , is committed to providing immediate and compassionate support to
        individuals and families facing urgent crises. Guided by Section 16 of the
        Local Government Code of 1991 (RA 7160), the AICS Program ensures that
        marginalized, vulnerable, and low-income residents receive timely assistance
        to alleviate distress, meet basic needs, and pave the way toward long-term
        stability.
    </div>
    <!-- Brief Description end-->
    <!-- Carousel start -->
    <div class="banner">
        <div class="slider" style="--quantity: 7">
            <div class="item" id="item1" style="--position: 1" onclick="showDescription(1)">
                <img src="./img/transportation.png" alt="">
            </div>
            <div class="item" id="item2" style="--position: 2" onclick="showDescription(2)">
                <img src="./img/food.png" alt="">
            </div>
            <div class="item" id="item3" style="--position: 3" onclick="showDescription(3)">
                <img src="./img/medical.png" alt="">
            </div>
            <div class="item" id="item4" style="--position: 4" onclick="showDescription(4)">
                <img src="./img/cash.png" alt="">
            </div>
            <div class="item" id="item5" style="--position: 5" onclick="showDescription(5)">
                <img src="./img/burial.png" alt="">
            </div>
            <div class="item" id="item6" style="--position: 6" onclick="showDescription(6)">
                <img src="./img/educational.png" alt="">
            </div>
            <div class="item" id="item7" style="--position: 7" onclick="showDescription(7)">
                <img src="./img/psychosocial.png" alt="">
            </div>
            <div class="item" id="item8" style="--position: 8" onclick="showDescription(8)">
                <img src="./img/AICS150.png" alt="">
            </div>
        </div>
        <div class="description-box">
            <p id="description-text">Click on an image to see the description.</p>
        </div>
    </div>
    <script>
        function showDescription(position) {
            const descriptions = {
                1: "Transportation Assistance offers financial aid to individuals who need travel funds for medical treatments, job relocation, or emergency situations. This program ensures that applicants can reach their destinations, such as hospitals or places of employment, without financial hardship.",
                2: "Food Assistance provides essential food supplies or financial aid to individuals and families facing hunger due to crisis situations such as calamities, job loss, or financial instability. This program aims to ensure food security and prevent malnutrition, especially among vulnerable groups.",
                3: "Medical Assistance provides financial aid to individuals who need support for hospitalization, medical procedures, laboratory tests, or the purchase of essential medicines. This program helps applicants cover medical expenses, ensuring they receive the necessary healthcare services, particularly for emergency and life-threatening conditions.",
                4: "Cash Relief Assistance offers immediate financial aid to individuals and families affected by unexpected crises such as natural disasters, accidents, or economic hardships. The provided cash support helps them address urgent needs, including rent, food, and other daily expenses.",
                5: "Burial Assistance helps families cope with funeral and burial expenses after the loss of a loved one. This program provides financial support for coffin purchase, funeral services, and burial costs, reducing the financial burden on grieving families during difficult times.",
                6: "Educational Assistance is designed to support students from financially struggling families by providing financial aid for tuition fees, school supplies, and other academic-related expenses. This assistance aims to ensure that students, particularly those in crisis situations, can continue their education without financial barriers.",
                7: "Psychosocial Support is designed to assist individuals dealing with emotional, mental, or social distress caused by traumatic experiences, such as disasters, abuse, or loss. This program offers counseling, therapy, and guidance services to help applicants recover and rebuild their emotional well-being.",
                8: "The AICS Program is a government initiative that provides immediate assistance to individuals and families facing crises. It aims to alleviate distress, meet basic needs, and promote long-term stability for marginalized and vulnerable residents."
            };

            const descriptionBox = document.querySelector(".description-box");
            const descriptionText = document.getElementById("description-text");

            descriptionText.textContent = descriptions[position];
            descriptionBox.classList.add("active");
        }
    </script>
    <br />
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" aria-label="Slide 7"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/trans slider.png" class="d-block w-100" alt="Transportation Assistance">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Transportation Assistance</h3>
                        <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
                        <p class="text-start">2. Medical Certificate referral (for medical transport request)</p>
                        <p class="text-start">3. Death Certificate or Medical Report of a Relative (for family emergency)</p>
                        <p class="text-start">4. Police Report or legal documents (for cases of abuse, transferring or court related cases).</p>
                        <p class="text-start">5. ID of authorized representative and Authorization Letter</p>
                        <p class="text-start">6. ID of patient</p>
                        <p class="text-start">7. Proof of Relationship (Birth Certificate, Marriage Certificate)</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./img/food slider.png" class="d-block w-100" alt="Food Assistance">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Food Assistance</h3>
                        <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
                        <p class="text-start">2. Valid ID (Photocopy)</p>
                        <p class="text-start">3. Marriage Certificate or Birth Certificate</p>
                        <p class="text-start">4. Disaster Certificate (if applicable for calamity affected individual)</p>
                        <p class="text-start">5. Medical Certificate or Referral (if applicable for malnourished individual or those with health conditions requiring food aid)</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./img/medical slider.png" class="d-block w-100" alt="Medical Assistance">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Medical Assistance</h3>
                        <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
                        <p class="text-start">2. Original or Certified True Copy of Latest Medical Certificate or Clinical Abstract</p>
                        <p class="text-start">3. Hospital Billing Statement for Hospitalization or procedure</p>
                        <p class="text-start">4. Pharmacy Quotation for required medications.</p>
                        <p class="text-start">5. Laboratory/ Diagnostic request for test and imaging</p>
                        <p class="text-start">6. Original Official Receipts</p>
                        <p class="text-start">7. Original or Certified True Copy of Certification of outstanding debts or Payable Obligations </p>
                        <p class="text-start">8. ID of authorized representative and Authorization Letter)</p>
                        <p class="text-start">9. ID of patient</p>
                        <p class="text-start">10. Proof of Relationship (Birth Certificate, Marriage Certificate)</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./img/Cash slider.png" class="d-block w-100" alt="Cash Relief Assistance">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Cash Relief Assistance</h3>
                        <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
                        <p class="text-start">2. Valid ID (Photocopy)</p>
                        <p class="text-start">3. Marriage Certificate or Birth Certificate</p>
                        <p class="text-start">4. Incident Report from BFP, LGU or disaster response agency.</p>
                        <p class="text-start">5. Medical Certificate (if the applicant or a family member was injured in the disaster)</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./img/Bur slider.png" class="d-block w-100" alt="Burial Assistance">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Burial Assistance</h3>
                        <p class="text-start">1. Updated Original Certificate of Indigency from Barangay proving financial incapacity</p>
                        <p class="text-start">2. Death Certificate </p>
                        <p class="text-start">3. Funeral Contract</p>
                        <p class="text-start">4. Original or certified true copy of Official Receipt</p>
                        <p class="text-start">5. ID of Authorized Representative</p>
                        <p class="text-start">6. ID of expired person</p>
                        <p class="text-start">7. Proof of Relationship (Birth Certificate) Photocopy</p>
                        <p class="text-start">8. Marriage Contract and Authorization Letter</p>
                        <p class="text-start">9. Certification of Outstanding Debts or Payable Obligations (Original or Certified True Copy)</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./img/edu slider.png" class="d-block w-100" alt="Educational Assistance">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Educational Assistance</h3>
                        <p class="text-start">1. Updated Original Certificate of Indigency from Barangay proving financial incapacity</p>
                        <p class="text-start">2. Certified True Copy of Enrollment Assessment Form or Certificate of Enrollment</p>
                        <p class="text-start">3. School ID of the student/ Beneficiary (Photocopy)</p>
                        <p class="text-start">4. Certified True Copy of Grades signed by the authorized personnel</p>
                        <p class="text-start">5. Medical Certificate (if applicable for HIV and other health related cases)</p>
                        <p class="text-start">6. Police Report/ Social Worker’s Assessment (for abuse and displacement cases)</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./img/Psych slider.png" class="d-block w-100" alt="Psychosocial Support">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Psychosocial Support</h3>
                        <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
                        <p class="text-start">2. Valid ID (Photocopy)</p>
                        <p class="text-start">3. Marriage Certificate or Birth Certificate</p>
                        <p class="text-start">4. Referral Letter from Social Worker, Barangay Officer, or Mental Health Professional</p>
                        <p class="text-start">5. Medical or Psychological Report (if applicable, for cases related to diagnosed mental health conditions)</p>
                        <p class="text-start">6. Police or Legal Report (if applicable, for cases involving abuse, violence, or exploitation)</p>
                        <p class="text-start">7. Original or Certified True Copy of Certification of outstanding debts or Payable Obligations </p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel end -->
    <!-- feed start -->
    <div class="feedback-container">
        <div class="feedback-form">
            <div class="form-left">
                <h2>Feedback</h2>
                <textarea class="feedback-textarea" rows="10" cols="70" placeholder="Write your Feedback here"
                    style="color:rgb(17, 17, 17);"></textarea>
            </div>

            <div class="form-right">
                <h2>Rate Us</h2>
                <input type="hidden" id="rating-value" name="rating-value" value="0">
                <div class="stars">
                    <span class="star" data-rating="1" style="height: 50px;
      width: 50px;">★</span>
                    <span class="star" data-rating="2" style="height: 50px;
      width: 50px;">★</span>
                    <span class="star" data-rating="3" style="height: 50px;
      width: 50px;">★</span>
                    <span class="star" data-rating="4" style="height: 50px;
      width: 50px;">★</span>
                    <span class="star" data-rating="5" style="height: 50px;
      width: 50px;">★</span>
                </div>


                <div class="input-container" style="background-color: #0066CC">
                    <input type="text" class="form-input" id="email" placeholder="Email" required
                        style="background-color: #0066CC;" />
                    <label for="username" style="color: #FFFFFF;">Email</label>
                </div>
                <div class="input-container" style="background-color: #0066CC">
                    <input type="text" class="form-input" id="name" placeholder="Name" required
                        style="background-color: #0066CC;" />
                    <label for="username" style="color: #FFFFFF;">Name</label>
                </div>
                <button class="submit-btn">Submit</button>
            </div>
        </div>
    </div>

    <script>
        // Star rating functionality
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('rating-value');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-rating');
                ratingValue.value = rating;

                // Update visual appearance
                stars.forEach(s => {
                    const starRating = s.getAttribute('data-rating');
                    if (starRating <= rating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
        });

        // Reset stars when clicking below 1
        document.querySelector('.stars').addEventListener('click', (e) => {
            if (!e.target.classList.contains('star')) {
                stars.forEach(s => s.classList.remove('active'));
                ratingValue.value = 0;
            }
        });
    </script>
    <!-- feed end -->
    <br style="height: 10px;" />
    <!--==================== FOOTER AREA ====================-->
    <footer class="footer-container">
        <div class="footer-grid">
            <div class="footer-section">
                <h2>VISIT US</h2>
                <p>D. Fandiño Street, Poblacion 3, Alaminos, Laguna</p>
                <div class="map-container">
                    <!-- Map placeholder -  map embed -->
                    <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
                        <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div>
                        <script>
                            (function() {
                                var setting = {
                                    "query": "Alaminos Laguna, Alaminos, Laguna, Philippines",
                                    "width": 400,
                                    "height": 200,
                                    "satellite": true,
                                    "zoom": 12,
                                    "placeId": "ChIJKQ0PkhFovTMRfhLklyI_di8",
                                    "cid": "0x2f763f2297e4127e",
                                    "coords": [14.0651171, 121.2462164],
                                    "cityUrl": "/philippines/tagaytay-city-33123",
                                    "cityAnchorText": "Map of Tagaytay City, Calabarzon, Philippines",
                                    "lang": "us",
                                    "queryString": "Alaminos Laguna, Alaminos, Laguna, Philippines",
                                    "centerCoord": [14.0651171, 121.2462164],
                                    "id": "map-9cd199b9cc5410cd3b1ad21cab2e54d3",
                                    "embed_id": "1214998"
                                };
                                var d = document;
                                var s = d.createElement('script');
                                s.src = 'https://1map.com/js/script-for-user.js?embed_id=1214998';
                                s.async = true;
                                s.onload = function(e) {
                                    window.OneMap.initMap(setting)
                                };
                                var to = d.getElementsByTagName('script')[0];
                                to.parentNode.insertBefore(s, to);
                            })();
                        </script>
                    </div>
                </div>

                <!-- Logo images added here -->
                <div class="logo-container">
                    <img src="./img/AICS150.png" alt="Logo 1" class="logo-image">
                    <img src="./img/Alam150.png" alt="Logo 2" class="logo-image">
                </div>
            </div>

            <div class="footer-section">
                <h2>ABOUT US</h2>
                <p>Alaminos, officially the <strong>Municipality of Alaminos</strong> (Tagalog: <em>Bayan ng
                        Alaminos</em>), is a 1st class municipality in the province of Laguna, Philippines.</p>
                <p>According to the 2020 census, it has a population of 51,619 people.</p>

                <table class="info-table">
                    <tr>
                        <th>Country</th>
                        <td>Philippines</td>
                    </tr>
                    <tr>
                        <th>Province</th>
                        <td>Laguna</td>
                    </tr>
                    <tr>
                        <th>Elevation</th>
                        <td>121 m (397 ft)</td>
                    </tr>
                    <tr>
                        <th>Founded</th>
                        <td>1873</td>
                    </tr>
                    <tr>
                        <th>Lowest elevation</th>
                        <td>59 m (194 ft)</td>
                    </tr>
                    <tr>
                        <th>Region</th>
                        <td>Calabazon</td>
                    </tr>
                    <tr>
                        <th>Highest elevation</th>
                        <td>543 m (1,781 ft)</td>
                    </tr>
                    <tr>
                        <th>District</th>
                        <td>3rd district</td>
                    </tr>
                </table>
            </div>

            <div class="footer-section">
                <h2>GOVERNMENT LINKS</h2>
                <a href="https://www.gov.ph/">About Gov PH</a>
                <a href="https://pbbm.com.ph/">The President</a>
                <a href="https://op-proper.gov.ph/">Office of the President</a>
                <a href="https://www.ovp.gov.ph/">Office of the Vice President</a>
                <a href="https://legacy.senate.gov.ph/">Senate of the Philippines</a>
                <a href="https://www.congress.gov.ph/">House of Representatives</a>
                <a href="https://alaminoslaguna.com/">Alaminos, Laguna</a>
            </div>
        </div>

        <div class="copyright">
            © 2025 Alaminos Laguna All Rights Reserved.
        </div>
    </footer>
    <!-- Footer Section end-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>