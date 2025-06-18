<?php
if (!empty($_SESSION['Account'])) {
    $data = $_SESSION['Account'] ?? "";
    $u = $data['Username'] ?? "";
    ?>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="margin-right: 8em;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><?php echo $u?>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="profile.php">Profile</a>
                </li>
                <li>
                    <a class="dropdown-item" href="messaging.php">Messages</a>
                </li>
                <li><a class="dropdown-item" href="Functions/PHP/logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
<?php } else { ?>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex justify-content-center align-items-center">
        <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-secondary pe-none" aria-disabled="true">or</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="signup.php">Sign up</a>
        </li>
    </ul>
<?php } ?>