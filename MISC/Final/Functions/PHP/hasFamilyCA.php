<?php if (isset($_SESSION['Family_ID']) && !empty($_SESSION['Family_ID'])) {
    if (isset($_SESSION['hasFamily']) && $_SESSION['hasFamily'] === 1) {

    } else {
        $_SESSION['Alert'] = "You need atleast 1 family member to apply.";
        $_SESSION['Path'] = "../../profile.php";

        header('Location: index.php');
        exit;
    }
} else {
        $_SESSION['Alert'] = "You First Need to set your profile to apply.";
        $_SESSION['Path'] = "../../profile.php";

    header('Location: index.php');
    exit;
} ?>