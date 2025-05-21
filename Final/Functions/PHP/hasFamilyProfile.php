<?php if (isset($_SESSION['Family_ID']) && !empty($_SESSION['Family_ID'])) {
    if (isset($_SESSION['hasFamily']) && $_SESSION['hasFamily'] === 1) { ?>
        <a href="setProfile.php" class="action-button">
            <i><img src="./assets/img/Edit Property.png" alt=""></i>
            <p>Add More<br>Family Members</p>
        </a>

        <a href="application.php" class="action-button">
            <i><img src="./assets/img/Track.png" alt=""></i>
            <p>Track your Application</p>
        </a>

        <a href="createApp.php" class="action-button">
            <i><img src="./assets/img/Create Application.png" alt=""></i>
            <p>Start Creating<br>Applications</p>
        </a>
    <?php } else { ?>
        <a href="setProfile.php" class="action-button">
            <i><img src="./assets/img/Edit Property.png" alt=""></i>
            <p>Add atleast 1<br>Family Member to Apply</p>
        </a>
    <?php }
} else { ?>

    <a href="setProfile.php" class="action-button">
        <i><img src="./assets/img/Edit Property.png" alt=""></i>
        <p>Complete your<br>Profile to Apply</p>
    </a>

<?php } ?>