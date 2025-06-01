<?php
ini_set('session.cookie_httponly', 1);
session_start();
include "../Functions/PHP/displayAlert.php";
include "../Functions/PHP/adminDataFetcher.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AICS - Settings</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/AICS150.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/administration.css">
    <link rel="stylesheet" href="../assets/set.css">
    <style>
        .tdn {
            text-decoration: none;
            color: #ffffff;
        }

        .btn-modal {
            background-color: transparent;
            border: 1px solid #ffffff;
            border-radius: 10px;
            padding: 10px;
            font-size: 20px;
            color: #ffffff;
            transition: .3s ease;
            cursor: pointer;
        }

        .btn-modal:hover {
            box-shadow: 0 5px rgba(255, 255, 255, 0.33);
            transform: translateY(-4px);
            transition: .3s ease;
        }

        .btn-modal:active {
            box-shadow: 0 2px rgba(255, 255, 255, 0.33);
            transform: translateY(0px);
            transition: .3s ease;
        }

        .hr {
            border-bottom: 3px solid #ffffff;
            box-shadow: 0 2px 5px #ffffff;
            margin-bottom: 30px;
        }

        .btn-close {
            transition: .5s ease;
        }

        .btn-close:hover {
            transition: .5s ease;
            scale: 1.2;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            border-radius: 8px;
            background-color: transparent;
            box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 8px;
            background-color: rgba(217, 241, 8, 0.2);
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: rgb(248, 240, 4);
        }

        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i><img src="../assets/img/AICS150.png" alt="AICS LOGO" /></i>
                <span>AICS</span>
            </div>
            <ul class="menu">
                <a class="tdn" href="dashboard.php">
                    <li class="menu-item">
                        <i><img src="../assets/img/Dashboard.png" alt="" /></i>
                        <span>Dashboard</span>
                    </li>
                </a>
                <a class="tdn" href="applications.php">
                    <li class="menu-item">
                        <i><img src="../assets/img/Application.png" alt="" /></i>
                        <span>Applications</span>
                    </li>
                </a>
                <a class="tdn" href="report.php">
                    <li class="menu-item">
                        <i><img src="../assets/img/Report.png" alt="" /></i>
                        <span>Reports</span>
                    </li>
                </a>
                <a class="tdn" href="">
                    <li class="menu-item active">
                        <i><img src="../assets/img/Settings.png" alt="" /></i>
                        <span>Settings</span>
                    </li>
                </a>
                <a class="tdn" href="notification.php">
                    <li class="menu-item">
                        <i><img src="../assets/img/Notification.png" alt="" /></i>
                        <span>Notifications</span>
                    </li>
                </a>
                <a style="text-decoration: none; color: #ffffff;" href="../Functions/PHP/logout.php">
                    <li class="ps-4 menu-item fs-4">
                        <i class="fa-solid fa-house"></i>
                        <span>Logout</span>
                    </li>
                </a>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main pb-0">
            <div class="header" style="margin: 0;">
                <div class="category-dropdown">
                </div>
                <div class="header-right d-flex align-end">
                    <div class="admin-info text-light">
                        <i class="fas fa-user"></i>
                        <?php include "../Functions/php/adminNandA.php" ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="set-content pt-0">
            <!-- Access Control -->
            <h2 class="section-title mt-0">Access Control</h2>
            <div class="table-container overflow-y-auto" style="max-height: 300px;">
                <table>
                    <thead>
                        <tr>
                            <th>Access Name</th>
                            <th>Access</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/aCTable.php" ?>
                    </tbody>
                </table>

            </div>

            <div class="d-flex justify-content-center align-items-center mb-3">
                <button type="button" class="btn-modal" data-bs-toggle="modal" data-bs-target="#createAccess">Create
                    Access</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createAccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="cALabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content text-light" style="background-color: #000133;">
                        <div class="modal-header p-0">
                            <div class="row" style="width: 100%;">
                                <div class="col py-3 ms-3">
                                    <h1 class="modal-title fs-5" id="cALabel">Create Access</h1>
                                </div>
                                <div class="col py-3 mt-1 pe-2">
                                    <div class="col d-flex justify-content-end p-0">
                                        <button type="button" class="bg-light rounded-circle btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="../Functions/PHP/createAccess.php">
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" minlength="3" maxlength="50" id="accessName"
                                        name="name" placeholder="" required>
                                    <label for="accessName">Enter Access Name</label>
                                </div>

                                <div class="hr m-0"></div>

                                <h4 class="text-center mt-3">Set Restrictions</h4>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="mAC" name="mAC">
                                    <label class="form-check-label" for="mAC">Managing Access Control</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="mUA" name="mUA">
                                    <label class="form-check-label" for="mUA">Managing User Access</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="createAccess">
                                <button type="submit" class="btn-modal">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hr"></div>

            <!-- Manage User Roles -->
            <h2 class="section-title mt-0">Manage User Roles</h2>
            <div class="table-container overflow-y-auto" style="max-height: 300px;">
                <table>
                    <thead>
                        <tr>
                            <th>Token</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/uRTable.php" ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center align-items-center mb-3">
                <form method="POST" action="../Functions/PHP/createToken.php">
                    <input type="hidden" name="createToken">
                    <button type="submit" class="btn-modal">Generate Token</button>
                </form>
            </div>

            <?php
            if (isset($_SESSION['key']) && isset($_SESSION['token'])) {
                $k = $_SESSION['key'];
                $t = $_SESSION['token'];
                unset($_SESSION['key'], $_SESSION['token']);
                ?>
                <script>alert("Key: <?php echo $k ?? "" ?>\nToken: <?php echo $t ?? "" ?>")</script>
                <?php
            }
            ?>

            <div class="hr"></div>

            <!-- Activity Log -->
            <h2 class="section-title">Activity Log</h2>
            <div class="table-container overflow-y-auto" style="max-height: 300px;">
                <table>
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Admin Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tbl-row">
                            <td>01/10/2023 09:30am</td>
                            <td>Maria Simukuan</td>
                            <td>Review Application</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/2023 10:30am</td>
                            <td>Maria Penduko</td>
                            <td>Review Application</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/2023 10:45am</td>
                            <td>Maria Jaurigue</td>
                            <td>Schedule Application</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/2023 10:50am</td>
                            <td>Mario Dela Cruz</td>
                            <td>Send Notifications</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/2023 11:00am</td>
                            <td>Ricardo Dalsay</td>
                            <td>Review Application</td>
                        </tr>
                        <tr class="tbl-row">
                            <td>01/10/0223 11:30am</td>
                            <td>Lola Besyang</td>
                            <td>Modify Settings</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="hr"></div>

            <!-- Budget Allocation -->
            <h2 class="section-title">Budget Allocation</h2>
            <div class="table-container overflow-y-auto" style="max-height: 270px;">
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>Budget Name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/budgetTable.php" ?>
                    </tbody>
                </table>
            </div>

            <div class="hr"></div>

            <!-- All Assistance -->
            <h2 class="section-title">All Assistance</h2>
            <div class="table-container overflow-y-auto" style="max-height: 270px;">
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Assistance Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/allAssistance.php" ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center align-items-center mb-3">
                <button type="button" class="btn-modal" data-bs-toggle="modal" data-bs-target="#createAssistance">Create
                    Assistance</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createAssistance" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="cAsLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content text-light" style="background-color: #000133;">
                        <div class="modal-header p-0">
                            <div class="row" style="width: 100%;">
                                <div class="col py-3 ms-3">
                                    <h1 class="modal-title fs-5" id="cAsLabel">Create Assistance</h1>
                                </div>
                                <div class="col py-3 mt-1 pe-2">
                                    <div class="col d-flex justify-content-end p-0">
                                        <button type="button" class="bg-light rounded-circle btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="../Functions/PHP/createAssistance.php">
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" minlength="3" maxlength="50" id="addAs"
                                        name="assistance" placeholder="" required>
                                    <label for="addAs">Enter Assistance Name</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="createAssistance">
                                <button type="submit" class="btn-modal">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hr"></div>

            <!-- All Assistance -->
            <h2 class="section-title">All Documents</h2>
            <div class="table-container overflow-y-auto" style="max-height: 270px;">
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/allDocuments.php" ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center align-items-center mb-3">
                <button type="button" class="btn-modal" data-bs-toggle="modal" data-bs-target="#createDocument">Create
                    Document</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createDocument" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="cDLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content text-light" style="background-color: #000133;">
                        <div class="modal-header p-0">
                            <div class="row" style="width: 100%;">
                                <div class="col py-3 ms-3">
                                    <h1 class="modal-title fs-5" id="cDLabel">Create Document</h1>
                                </div>
                                <div class="col py-3 mt-1 pe-2">
                                    <div class="col d-flex justify-content-end p-0">
                                        <button type="button" class="bg-light rounded-circle btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="../Functions/PHP/createDocument.php">
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="" id="addDoc" style="height: 100px"
                                        minlength="10" maxlength="1000" name="desc" required></textarea>
                                    <label for="addDoc">Enter Document Description</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="createDocument">
                                <button type="submit" class="btn-modal">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hr"></div>

            <!-- All Assistance -->
            <h2 class="section-title">All Requirements</h2>
            <div class="table-container overflow-y-auto" style="max-height: 270px;">
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Assistance ID</th>
                            <th>Document ID</th>
                            <th>Description</th>
                            <th>Importance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/allRequirements.php" ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center align-items-center mb-3">
                <button type="button" class="btn-modal" data-bs-toggle="modal"
                    data-bs-target="#createRequirement">Create
                    Requirement</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createRequirement" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="cRLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content text-light" style="background-color: #000133;">
                        <div class="modal-header p-0">
                            <div class="row" style="width: 100%;">
                                <div class="col py-3 ms-3">
                                    <h1 class="modal-title fs-5" id="cRLabel">Create Requirement</h1>
                                </div>
                                <div class="col py-3 mt-1 pe-2">
                                    <div class="col d-flex justify-content-end p-0">
                                        <button type="button" class="bg-light rounded-circle btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="../Functions/PHP/createRequirement.php">
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="" id="addReq" style="height: 100px"
                                        minlength="10" maxlength="1000" name="desc" required></textarea>
                                    <label for="addReq">Enter Document Description</label>
                                </div>

                                <select class="form-select mb-3" name="assistance" required>
                                    <option value="" selected>Select Assistance</option>
                                    <?php include "../Functions/PHP/allAssistanceSelect.php" ?>
                                </select>

                                <select class="form-select mb-3" name="document" required>
                                    <option value="" selected>Select Document</option>
                                    <?php include "../Functions/PHP/allDocumentsSelect.php" ?>
                                </select>

                                <select class="form-select mb-3" name="importance" required>
                                    <option value="" selected>Select Importance</option>
                                    <option value="Required">Required</option>
                                    <option value="Optional">Optional</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="createRequirement">
                                <button type="submit" class="btn-modal">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hr"></div>

            <!-- All Availability -->
            <h2 class="section-title">All Availability</h2>
            <div class="table-container overflow-y-auto" style="max-height: 270px;">
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Availability Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/allAvailability.php" ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center align-items-center mb-3">
                <button type="button" class="btn-modal" data-bs-toggle="modal"
                    data-bs-target="#createAvailability">Create
                    Availability</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createAvailability" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="cAvLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content text-light" style="background-color: #000133;">
                        <div class="modal-header p-0">
                            <div class="row" style="width: 100%;">
                                <div class="col py-3 ms-3">
                                    <h1 class="modal-title fs-5" id="cAvLabel">Create Availability</h1>
                                </div>
                                <div class="col py-3 mt-1 pe-2">
                                    <div class="col d-flex justify-content-end p-0">
                                        <button type="button" class="bg-light rounded-circle btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="../Functions/PHP/createAvailability.php">
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" minlength="3" maxlength="50" id="addAv"
                                        name="availability" placeholder="" required>
                                    <label for="addAv">Enter Availability Name</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="createAvailability">
                                <button type="submit" class="btn-modal">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hr"></div>

            <!-- All Rates -->
            <h2 class="section-title">All Rates</h2>
            <div class="table-container overflow-y-auto" style="max-height: 270px;">
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Assistance ID</th>
                            <th>Availability ID</th>
                            <th>Criteria</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/allRates.php" ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center align-items-center mb-3">
                <button type="button" class="btn-modal" data-bs-toggle="modal" data-bs-target="#createRate">Create
                    Rate</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createRate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="cRLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content text-light" style="background-color: #000133;">
                        <div class="modal-header p-0">
                            <div class="row" style="width: 100%;">
                                <div class="col py-3 ms-3">
                                    <h1 class="modal-title fs-5" id="cRLabel">Create Rate</h1>
                                </div>
                                <div class="col py-3 mt-1 pe-2">
                                    <div class="col d-flex justify-content-end p-0">
                                        <button type="button" class="bg-light rounded-circle btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="../Functions/PHP/createRate.php">
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="" id="addCriteria" style="height: 100px"
                                        minlength="10" maxlength="1000" name="criteria" required></textarea>
                                    <label for="addCriteria">Enter Criteria</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" minlength="1" maxlength="11" pattern="^\d+$"
                                        title="Digits only, no spaces allowed" id="addCost" name="cost" placeholder=""
                                        required>
                                    <label for="addCost">Enter Cost</label>
                                </div>

                                <select class="form-select mb-3" name="assistance" required>
                                    <option value="" selected>Select Assistance</option>
                                    <?php include "../Functions/PHP/allAssistanceSelect.php" ?>
                                </select>

                                <select class="form-select mb-3" name="availability" required>
                                    <option value="" selected>Select Availability</option>
                                    <?php include "../Functions/PHP/allAvailabilitySelect.php" ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="createRate">
                                <button type="submit" class="btn-modal">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hr"></div>

            <!-- All User Accounts -->
            <h2 class="section-title">All User Accounts</h2>
            <div class="table-container overflow-y-auto" style="max-height: 270px;">
                <table class="budget-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../Functions/PHP/allAccounts.php" ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
</body>

</html>