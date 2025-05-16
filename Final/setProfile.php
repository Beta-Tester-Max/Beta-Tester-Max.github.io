<?php
session_start();
include "Functions/PHP/userDataFetcher.php";
include "Functions/PHP/forUser.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Completion Form</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/AICS150.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/form.css" />

    <style>
        input[type="date"] {
            background-color: #000033;
            color: rgba(255, 255, 255, 0.46);
            border: 1px solid #ffffff;
            padding-left: 2.5em;
            padding-right: 1.5em;
            height: 1.8em;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            background-color: white;
            border-radius: 4px;
            padding: 3px;
            cursor: pointer;
        }

        .close {
            text-decoration: none;
            color: #ffffff;
            font-size: 1.5em;
        }

        .close:hover {
            color:rgb(216, 9, 9);
        }
    </style>
</head>

<body>
    
    <?php include "Functions/PHP/hasFamilySetProfile.php"?>

    <script src="Functions/JS/setProfileScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>

</html>