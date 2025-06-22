<nav class="navbar navbar-expand-lg bg-body-tertiary border shadow-sm">
    <div class="container-fluid">
        <img src="../Assets/Image/dswd-logo.png" class="navbar-brand" style="width: 2em; height: 2.5em;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a <?php echo ($cd === "Dashboard") ? "class='btn btn-light btn-lg fs-4 disabled'" : "class='btn btn-light btn-lg fs-4'" ?> aria-current="page" title="Dashboard" <?php echo ($cd === "Dashboard") ? "href=''" : "href='../Dashboard/'" ?>><i class="fa-solid fa-table-columns"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a <?php echo ($cd === "Case_Study") ? "class='btn btn-light btn-lg fs-4 disabled'" : "class='btn btn-light btn-lg fs-4'" ?> aria-current="page" title="Case Study" <?php echo ($cd === "Case_Study") ? "href=''" : "href='../Case_Study/'" ?>><i
                            class="fa-solid fa-file-word"></i> Case Study</a>
                </li>
                <li class="nav-item">
                    <a <?php echo ($cd === "Report") ? "class='btn btn-light btn-lg fs-4 disabled'" : "class='btn btn-light btn-lg fs-4'" ?> aria-current="page" title="Report" <?php echo ($cd === "Report") ? "href=''" : "href='../Report/'" ?>><i
                            class="fa-solid fa-clipboard-question"></i> Report</a>
                </li>
                <li class="nav-item">
                    <a <?php echo ($cd === "Settings") ? "class='btn btn-light btn-lg fs-4 disabled'" : "class='btn btn-light btn-lg fs-4'" ?> aria-current="page" title="Settings" <?php echo ($cd === "Settings") ? "href=''" : "href='../Settings/'" ?>><i
                            class="fa-solid fa-gear"></i> Settings</a>
                </li>
                <?php if ($cd === "Dashboard") { ?>
                    <li class="nav-item dropdown">
                        <a class="btn btn-light btn-lg fs-4 dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-folder"></i> Content
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" title="Statistics" href="#"><i
                                        class="fa-solid fa-chart-simple"></i> Statistics</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" title="Recent" href="#"><i class="fa-solid fa-clock"></i>
                                    Recent</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" title="Budgeting" href="#"><i class="fa-solid fa-coins"></i>
                                    Budgeting</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <form class="d-flex align-items-center">
                <button type="button" class="btn btn-light btn-sm rounded-circle ms-1" id="toggleMode"><i
                        class="fa-regular fa-sun"></i></button>
                <img src="../Assets/Image/profile_placeholder.png" class="rounded-circle mx-3"
                    style="width: 2em; height: 2em;">
                <h4 class="m-0">Username</h4>
            </form>
        </div>
    </div>
</nav>