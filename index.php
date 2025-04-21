<?php include "connect.php";
session_start();
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
}
try {
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AICS System demo</title>
        <link rel="icon" type="image/x-icon" href="Logo.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .logo {
                height: 3em;
                width: 3.5em;
            }

            .carousel {
                position: relative;
                width: 150px;
                height: 150px;
                transform-style: preserve-3d;
                animation: spin 20s linear infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotateX(-30deg) rotateY(0deg) rotateZ(0deg);
                }

                100% {
                    transform: rotateX(-30deg) rotateY(360deg) rotateZ(0deg);
                }
            }

            .carousel .sides {
                position: absolute;
                width: 150px;
                height: 150px;
                transform-style: preserve-3d;

            }

            .carousel .side {
                position: absolute;
                width: 150px;
                height: 150px;
                opacity: 0.8;
                font-size: 24px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .side1 {
                transform: translateZ(300px);
                cursor: pointer;
            }

            .side1:hover {
                scale: 1.05;
            }

            .side2 {
                transform: rotateY(45deg) translateZ(300px);
                cursor: pointer;
            }

            .side2:hover {
                scale: 1.05;
            }

            .side3 {
                transform: rotateY(90deg) translateZ(300px);
                cursor: pointer;
            }

            .side3:hover {
                scale: 1.05;
            }

            .side4 {
                transform: rotateY(135deg) translateZ(300px);
                cursor: pointer;
            }

            .side4:hover {
                scale: 1.05;
            }

            .side5 {
                transform: rotateY(180deg) translateZ(300px);
                cursor: pointer;
            }

            .side5:hover {
                scale: 1.05;
            }

            .side6 {
                transform: rotateY(225deg) translateZ(300px);
                cursor: pointer;
            }

            .side6:hover {
                scale: 1.05;
            }

            .side7 {
                transform: rotateY(270deg) translateZ(300px);
                cursor: pointer;
            }

            .side7:hover {
                scale: 1.05;
            }

            .side8 {
                transform: rotateY(315deg) translateZ(300px);
                cursor: pointer;
            }

            .side8:hover {
                scale: 1.05;
            }

            .inf-scroll {
                display: none;
                width: 100px;
                margin-inline: auto;
                position: relative;
                height: 80%;
                margin-top: 75px;
                overflow: hidden;
                mask-image: linear-gradient(to bottom,
                        rgba(0, 0, 0, 0),
                        rgba(0, 0, 0, 1) 20%,
                        rgba(0, 0, 0, 1) 80%,
                        rgba(0, 0, 0, 0));
            }

            .item {
                width: 100px;
                height: 100px;
                border-radius: 6px;
                position: absolute;
                animation: scrollLeft 30s linear infinite;
            }

            @keyframes scrollLeft {
                from {
                    transform: translateY(-500px);
                }

                to {
                    transform: translateY(500px);
                }
            }

            .item:nth-child(1) {
                animation-delay: calc(30s / 8 * 7 * -1);
            }

            .item:nth-child(2) {
                animation-delay: calc(30s / 8 * 6 * -1);
            }

            .item:nth-child(3) {
                animation-delay: calc(30s / 8 * 5 * -1);
            }

            .item:nth-child(4) {
                animation-delay: calc(30s / 8 * 4 * -1);
            }

            .item:nth-child(5) {
                animation-delay: calc(30s / 8 * 3 * -1);
            }

            .item:nth-child(6) {
                animation-delay: calc(30s / 8 * 2 * -1);
            }

            .item:nth-child(7) {
                animation-delay: calc(30s / 8 * 1 * -1);
            }

            .item:nth-child(8) {
                animation-delay: calc(30s / 8 * 0 * -1);
            }

            .item1:hover {
                scale: 1.1;
            }

            .item2:hover {
                scale: 1.1;
            }

            .item3:hover {
                scale: 1.1;
            }

            .item4:hover {
                scale: 1.1;
            }

            .item5:hover {
                scale: 1.1;
            }

            .item6:hover {
                scale: 1.1;
            }

            .item7:hover {
                scale: 1.1;
            }

            .item8:hover {
                scale: 1.1;
            }

            @media (max-width: 1400px) {
                .carousel {
                    display: none;
                }

                .inf-scroll {
                    display: flex;
                }
            }
        </style>
    </head>

    <body class="overflow-x-hidden" style="min-width: 20em;">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img class="logo" src="logo.ico" alt="AICS">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
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
                                <?php if (empty($_SESSION["userid"])) {
                                    ?>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop01">
                                            Create Application
                                        </button>
                                    </li>
                                <?php } else {
                                    $rows = [];
                                    $sql = $pdo->prepare("SELECT Document_Type 
                                        FROM requirements_tbl 
                                        where User_ID = :userid AND Status = 'Validated'");
                                    $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                    $sql->execute();
                                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                                    while ($row) {
                                        $rows[] = $row["Document_Type"];
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
                                                                </li><?php if (isset($_POST["traass"])) {
                                                                    $_SESSION["assistancetype"] = $_POST["traass"];
                                                                    $_SESSION["goback"] = "index.php";
                                                                    ?>
                                                                    <script>window.location.href = "application.php"</script><?php
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
                                                                                </li><?php if (isset($_POST["medass"])) {
                                                                                    $_SESSION["assistancetype"] = $_POST["medass"];
                                                                                    $_SESSION["goback"] = "index.php"
                                                                                        ?>
                                                                                    <script>window.location.href = "application.php"</script><?php
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
                                                                            </li><?php if (isset($_POST["burass"])) {
                                                                                $_SESSION["assistancetype"] = $_POST["burass"];
                                                                                $_SESSION["goback"] = "index.php";
                                                                                ?>
                                                                                <script>window.location.href = "application.php"</script><?php
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
                                                        </li><?php if (isset($_POST["eduass"])) {
                                                            $_SESSION["assistancetype"] = $_POST["eduass"];
                                                            $_SESSION["goback"] = "index.php";
                                                            ?>
                                                            <script>window.location.href = "application.php"</script><?php
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
                                                </li><?php if (isset($_POST["fooass"])) {
                                                    $_SESSION["assistancetype"] = $_POST["fooass"];
                                                    $_SESSION["goback"] = "index.php";
                                                    ?>
                                                    <script>window.location.href = "application.php"</script><?php
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
                                                    </li><?php if (isset($_POST["casass"])) {
                                                        $_SESSION["assistancetype"] = $_POST["casass"];
                                                        $_SESSION["goback"] = "index.php";
                                                        ?>
                                                        <script>window.location.href = "application.php"</script><?php
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
                                                    </li><?php if (isset($_POST["psysup"])) {
                                                        $_SESSION["assistancetype"] = $_POST["psysup"];
                                                        $_SESSION["goback"] = "index.php";
                                                        ?>
                                                        <script>window.location.href = "application.php"</script><?php
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
                                if (isset($_SESSION["userid"])) {
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
                    <form class="d-flex m-auto" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                    <?php if (empty($_SESSION["userid"])) { ?>
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
                                    <?php $sql = $pdo->prepare("SELECT Username FROM register_tbl where User_ID = :userid");
                                    $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                                    $sql->execute();
                                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                                    if ($row) {
                                        echo htmlspecialchars($row["Username"], ENT_QUOTES, 'UTF-8');
                                    } ?>
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
                "Transportation Assistance",
                "Medical Assistance",
                "Burial Assistance",
                "Educational Assistance",
                "Food Assistance",
                "Cash Relief Assistance",
                "Psychosocial Support",
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
                                    case "Transportation Assistance":
                                        echo $modaltatext;
                                        break;
                                    case "Medical Assistance":
                                        echo $modalmatext;
                                        break;
                                    case "Burial Assistance":
                                        echo $modalbatext;
                                        break;
                                    case "Educational Assistance":
                                        echo $modaleatext;
                                        break;
                                    case "Food Assistance":
                                        echo $modalfatext;
                                        break;
                                    case "Cash Relief Assistance":
                                        echo $modalcratext;
                                        break;
                                    case "Psychosocial Support":
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
                    <?php if (isset($_SESSION["userid"])) {
                        ?>
                        <h1>Hello! <?php $sql = $pdo->prepare("SELECT Fname, Mname, Lname FROM userinfo_tbl where User_ID = :userid");
                        $sql->bindParam(":userid", $userid, PDO::PARAM_INT);
                        $sql->execute();
                        $row = $sql->fetch(PDO::FETCH_ASSOC);
                        if ($row) {
                            if (empty($row["Mname"])) {
                                echo htmlspecialchars($row["Fname"], ENT_QUOTES, 'UTF-8') . "&nbsp;" . htmlspecialchars($row["Lname"], ENT_QUOTES, 'UTF-8');
                            } else {
                                echo htmlspecialchars($row["Fname"], ENT_QUOTES, 'UTF-8') . "&nbsp;" . htmlspecialchars($row["Mname"], ENT_QUOTES, 'UTF-8') . "&nbsp;" . htmlspecialchars($row["Lname"], ENT_QUOTES, 'UTF-8');
                            }
                        }
                        ?>.</h1>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center" style="height: 20em;">
                    <div class="carousel">
                        <div class="sides">
                            <img src="img/bananaman.gif" class="side side1">
                            <img src="img/bananaman.gif" class="side side2">
                            <img src="img/bananaman.gif" class="side side3">
                            <img src="img/bananaman.gif" class="side side4">
                            <img src="img/bananaman.gif" class="side side5">
                            <img src="img/bananaman.gif" class="side side6">
                            <img src="img/bananaman.gif" class="side side7">
                            <img src="img/bananaman.gif" class="side side8">
                        </div>
                    </div>
                    <div class="inf-scroll">
                        <div class="items">
                            <img src="img/bananaman.gif" class="item item1">
                            <img src="img/bananaman.gif" class="item item2">
                            <img src="img/bananaman.gif" class="item item3">
                            <img src="img/bananaman.gif" class="item item4">
                            <img src="img/bananaman.gif" class="item item5">
                            <img src="img/bananaman.gif" class="item item6">
                            <img src="img/bananaman.gif" class="item item7">
                            <img src="img/bananaman.gif" class="item item8">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "<script>alert('Database error: " . addslashes($e->getMessage()) . "');</script>";
}
$sql = null;