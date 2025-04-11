<!doctype html>
<?php include "connect.php";
session_start();
if (empty($_SESSION['userid'])) { ?>
    <script>window.location.href = "logout.php";</script><?php } ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assistance Type</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="overflow-x-hidden" style="min-width: 50em;">
    <div class="container-fluid">
        <div class="row" style="height: 100vh;">'
            <div class="col-1"></div>
            <div class="col-10 d-flex flex-column justify-content-center align-items-center p-5">
                <?php $assistancetype = array(
                    'Transportation Assistance',
                    'Medical Assistance',
                    'Burial Assistance',
                    'Educational Assistance',
                    'Food Assistance',
                    'Cash Relief Assistance',
                    'Psychosocial Support'
                );
                foreach ($assistancetype as $at) { ?>

                    <?php
                    $userid = $_SESSION['userid'];
                    $rows = [];
                    $sql = "SELECT Document_Type
                            FROM requirements_tbl 
                            where User_ID = '$userid'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        $rows[] = $row['Document_Type'];
                    }
                    if ($at === "Transportation Assistance") {
                        if (in_array("Barangay Indigency", $rows)) {
                            if (in_array("Medical Certificate Referral", $rows)) {
                                if (in_array("Death Certificate", $rows) || in_array("Medical Report", $rows)) {
                                    if (in_array("Police Report", $rows)) {
                                        if (in_array("Representative Valid ID", $rows)) {
                                            if (in_array("Valid ID", $rows)) {
                                                if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                                    ?>
                                                    <form method="POST">
                                                        <button class="btn btn-lg btn-outline-primary my-1" type="submit" style="width: 20em;" name="asstyp"
                                                            value="<?php echo $at ?>"><?php echo $at ?></button>
                                                    </form><?php
                                                } else {
                                                    $modaltext = "Birth Certificate or Marriage Certificate";
                                                    ?>
                                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                }
                                            } else {
                                                $modaltext = "Valid ID";
                                                ?>
                                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                            }
                                        } else {
                                            $modaltext = "Representative Valid ID";
                                            ?>
                                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                        }
                                    } else {
                                        $modaltext = "Police Report";
                                        ?>
                                        <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop02" style="width: 20em;"
                                            value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                    }
                                } else {
                                    $modaltext = "Death Certificate or Medical Report";
                                    ?>
                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                }
                            } else {
                                $modaltext = "Medical Certificate Referral";
                                ?>
                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                            }
                        } else {
                            $modaltext = "Barangay Indigency";
                            ?>
                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                        }
                    }
                    if ($at === "Medical Assistance") {
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
                                                                    <form method="POST">
                                                                        <button class="btn btn-lg btn-outline-primary my-1" type="submit" style="width: 20em;" name="asstyp"
                                                                            value="<?php echo $at ?>"><?php echo $at ?></button>
                                                                    </form><?php
                                                                } else {
                                                                    $modaltext = "Birth Certificate or Marriage Certificate";
                                                                    ?>
                                                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                                }
                                                            } else {
                                                                $modaltext = "Valid ID";
                                                                ?>
                                                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                            }
                                                        } else {
                                                            $modaltext = "Authorization Letter";
                                                            ?>
                                                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                        }
                                                    } else {
                                                        $modaltext = "Representative Valid ID";
                                                        ?>
                                                        <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                            value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                    }
                                                } else {
                                                    $modaltext = "Outstanding Payer Certificate";
                                                    ?>
                                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                }
                                            } else {
                                                $modaltext = "Official Receipts";
                                                ?>
                                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                            }
                                        } else {
                                            $modaltext = "Laboratory Request or Diagnostic Request";
                                            ?>
                                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                        }
                                    } else {
                                        $modaltext = "Pharmacy Quotation";
                                        ?>
                                        <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop02" style="width: 20em;"
                                            value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                    }
                                } else {
                                    $modaltext = "Hospital Billing Statement";
                                    ?>
                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                }
                            } else {
                                $modaltext = "Medical Certificate or Clinical Abstract";
                                ?>
                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                            }
                        } else {
                            $modaltext = "Barangay Indigency";
                            ?>
                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                        }
                    }
                    if ($at === "Burial Assistance") {
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
                                                                <form method="POST">
                                                                    <button class="btn btn-lg btn-outline-primary my-1" type="submit" style="width: 20em;" name="asstyp"
                                                                        value="<?php echo $at ?>"><?php echo $at ?></button>
                                                                </form><?php
                                                            } else {
                                                                $modaltext = "Outstanding Payer Certificate";
                                                                ?>
                                                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                            }
                                                        } else {
                                                            $modaltext = "Marriage Contract";
                                                            ?>
                                                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                        }
                                                    } else {
                                                        $modaltext = "Authorization Letter";
                                                        ?>
                                                        <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                            value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                    }
                                                } else {
                                                    $modaltext = "Birth Certificate or Marriage Certificate";
                                                    ?>
                                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                                }
                                            } else {
                                                $modaltext = "Valid ID";
                                                ?>
                                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                            }
                                        } else {
                                            $modaltext = "Representative Valid ID";
                                            ?>
                                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                        }
                                    } else {
                                        $modaltext = "Official Receipts";
                                        ?>
                                        <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop02" style="width: 20em;"
                                            value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                    }
                                } else {
                                    $modaltext = "Funeral Contract";
                                    ?>
                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                }
                            } else {
                                $modaltext = "Death Certificate";
                                ?>
                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                            }
                        } else {
                            $modaltext = "Barangay Indigency";
                            ?>
                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                        }
                    }
                    if ($at === "Educational Assistance") {
                        if (in_array("Barangay Indigency", $rows)) {
                            if (in_array("Enrollment Assessment Form", $rows) || in_array("Certificate of Enrollment", $rows)) {
                                if (in_array("School ID", $rows)) {
                                    if (in_array("Grade", $rows)) {
                                        if (in_array("Police Report", $rows) || in_array("Social Worker's Assessment", $rows)) {
                                            ?>
                                            <form method="POST">
                                                <button class="btn btn-lg btn-outline-primary my-1" type="submit" style="width: 20em;" name="asstyp"
                                                    value="<?php echo $at ?>"><?php echo $at ?></button>
                                            </form><?php
                                        } else {
                                            $modaltext = "Police Report or Social Worker's Assessment";
                                            ?>
                                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                        }
                                    } else {
                                        $modaltext = "Grade";
                                        ?>
                                        <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop02" style="width: 20em;"
                                            value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                    }
                                } else {
                                    $modaltext = "School ID";
                                    ?>
                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                }
                            } else {
                                $modaltext = "Enrollment Assessment Form or Certificate of Enrollment";
                                ?>
                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                            }
                        } else {
                            $modaltext = "Barangay Indigency";
                            ?>
                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                        }
                    }
                    if ($at === "Food Assistance") {
                        if (in_array("Barangay Indigency", $rows)) {
                            if (in_array("Valid ID", $rows)) {
                                if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                    ?>
                                    <form method="POST">
                                        <button class="btn btn-lg btn-outline-primary my-1" type="submit" style="width: 20em;" name="asstyp"
                                            value="<?php echo $at ?>"><?php echo $at ?></button>
                                    </form><?php
                                } else {
                                    $modaltext = "Birth Certificate or Marriage Certificate";
                                    ?>
                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                }
                            } else {
                                $modaltext = "Valid ID";
                                ?>
                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                            }
                        } else {
                            $modaltext = "Barangay Indigency";
                            ?>
                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                        }
                    }
                    if ($at === "Cash Relief Assistance") {
                        if (in_array("Barangay Indigency", $rows)) {
                            if (in_array("Valid ID", $rows)) {
                                if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                    if (in_array("Incident Report", $rows)) {
                                        ?>
                                        <form method="POST">
                                            <button class="btn btn-lg btn-outline-primary my-1" type="submit" style="width: 20em;" name="asstyp"
                                                value="<?php echo $at ?>"><?php echo $at ?></button>
                                        </form><?php
                                    } else {
                                        $modaltext = "Incident Report";
                                        ?>
                                        <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop02" style="width: 20em;"
                                            value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                    }
                                } else {
                                    $modaltext = "Birth Certificate or Marriage Certificate";
                                    ?>
                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                }
                            } else {
                                $modaltext = "Valid ID";
                                ?>
                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                            }
                        } else {
                            $modaltext = "Barangay Indigency";
                            ?>
                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                        }
                    }
                    if ($at === "Psychosocial Support") {
                        if (in_array("Barangay Indigency", $rows)) {
                            if (in_array("Valid ID", $rows)) {
                                if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                                    if (in_array("Referral Letter", $rows)) {
                                        ?>
                                        <form method="POST">
                                            <button class="btn btn-lg btn-outline-primary my-1" type="submit" style="width: 20em;" name="asstyp"
                                                value="<?php echo $at ?>"><?php echo $at ?></button>
                                        </form><?php
                                    } else {
                                        $modaltext = "Referral Letter";
                                        ?>
                                        <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop02" style="width: 20em;"
                                            value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                    }
                                } else {
                                    $modaltext = "Birth Certificate or Marriage Certificate";
                                    ?>
                                    <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop02" style="width: 20em;"
                                        value="<?php echo $at ?>"><?php echo $at ?></button><?php
                                }
                            } else {
                                $modaltext = "Valid ID";
                                ?>
                                <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop02" style="width: 20em;"
                                    value="<?php echo $at ?>"><?php echo $at ?></button><?php
                            }
                        } else {
                            $modaltext = "Barangay Indigency";
                            ?>
                            <button class="btn btn-lg btn-outline-primary my-1" type="button" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop02" style="width: 20em;"
                                value="<?php echo $at ?>"><?php echo $at ?></button><?php
                        }
                    } ?>
                <?php } ?>
                <div class="modal fade" id="staticBackdrop02" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">You are missing some
                                    <b>Requirements</b>.
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>You Are Missing <b><?php echo $modaltext ?></b>.</p>
                            </div>
                            <div class="modal-footer d-flex justify-content-center align-items-center">
                                <a type="button" class="btn btn-primary" href="profile.php#requirements">Upload Missing
                                    Requirements</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-lg btn-outline-primary my-1" href="index.php" style="width: 20em;"><-- Go Back</a>
                        <?php if (isset($_POST['asstyp'])) {
                            $_SESSION['assistancetype'] = $_POST['asstyp'];
                            $_SESSION['goback'] = "assistanceoptions.php";
                            ?>
                            <script>window.location.href = "application.php"</script><?php
                        }
                        ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>