<?php include 'connect.php';
session_start();
if (empty($_SESSION['userid'])) {
    session_destroy();
    session_start(); ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="icon" type="image/x-icon" href="./img/AICS150.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="nav.css">
        <style>
            #logoLog {
                width: 60px;
                height: 60px;
                display: flex;
                justify-content: center;
                margin: auto;
            }
        </style>
    </head>

    <body class="overflow-x-hidden" style="min-width: 50em;">
        <nav class="sticky-top navbar navbar-expand-lg">
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
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
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
                    <!-- search start -->
                <div class="search-cont">
                    <div class="search-container">
                        <input type="text" placeholder="Search..." class="search-input">
                        <button class="search-button" onclick="toggleSearch()">
                            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <script>
                    function toggleSearch() {
                        const searchInput = document.querySelector('.search-input');

                        if (window.innerWidth <= 768) {
                            if (searchInput.style.width === '200px') {
                                searchInput.style.width = '0';
                                searchInput.style.padding = '0';
                                searchInput.style.opacity = '0';
                            } else {
                                searchInput.style.width = '200px';
                                searchInput.style.padding = '10px 15px';
                                searchInput.style.opacity = '1';
                            }
                        }
                    }

                    // Reset search bar on window resize
                    window.addEventListener('resize', function() {
                        const searchInput = document.querySelector('.search-input');
                        if (window.innerWidth > 768) {
                            searchInput.style.width = '100%';
                            searchInput.style.padding = '10px 15px';
                            searchInput.style.opacity = '1';
                        } else {
                            searchInput.style.width = '0';
                            searchInput.style.padding = '0';
                            searchInput.style.opacity = '0';
                        }
                    });
                </script>
                <!-- search end -->
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
            <div class="d-flex flex-column justify-content-center align-items-center mt-2">
                <form method="POST" class="logbox">
                    <div class="mb-3">
                        <h1 class="textHead">Login</h1>
                        <img src="./img/AICS150.png" alt="AICS LOGO" id="logoLog">
                        <!-- <label for="account" class="form-label">Username or Email</label>
                        <input type="text" class="form-control" placeholder="Enter Username/Email" name="account"
                            maxlength="25" required> -->
                    </div>
                    <div class="input-container" style="background-color: #FFFFFF">
                        <input type="text" class="form-input" id="email" placeholder="Email" required
                            style="background-color: #FFFFFF;" />
                        <label for="account" style="color: #0c0b0b;">Email</label>
                    </div>
                    <div class="input-container" style="background-color: #FFFFFF">
                        <input type="password" class="form-input" id="password" placeholder="Password" name="password" required
                            style="background-color: #FFFFFF;" />
                        <label for="Password" style="color: #0c0b0b;">Password</label>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password"
                            maxlength="15" required>
                    </div> -->
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="mb-3 justify-content-center align-items-center d-flex">
                        <button type="submit" name="loginForm" class="btn btn-primary">Submit</button>
                    </div>
                    <p class="text-center">Don't have an account? </p>
                    <p class="text-center"><a href="register.php">Sign up</a> or Go to <a href="index.php">homepage</a></p>
                </form>

                <?php if (isset($_POST['loginForm'])) {
                    $account = $_POST['account'];
                    $password = $_POST['password'];

                    $sql = "SELECT User_ID, Password FROM register_tbl where Username = '$account' OR Email = '$account'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $fetchedPassword = $row['Password'];
                        if ($password === $fetchedPassword) {
                            $userid = $row['User_ID'];
                            $sql = "SELECT Access_Level FROM register_tbl where User_ID = '$userid'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            if ($row['Access_Level'] === "Admin") {
                                $_SESSION['authority'] = $row['Access_Level'] ?>
                                <script>
                                    window.location.href = 'administration.php'
                                </script> <?php
                            } else { ?>
                                <script>
                                    window.location.href = 'index.php'
                                </script> <?php
                                $_SESSION['userid'] = $userid;
                            }
                        } else { ?>
                            <p class="text-danger justify-content-center align-items-center d-flex">Incorrect Password.</p>
                        <?php }
                    } else { ?>
                        <p class="text-danger justify-content-center align-items-center d-flex">Incorrect Username.</p>
                    <?php }
                }
                $conn->close() ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else { ?>
    <script>window.location.href = 'index.php'</script><?php }