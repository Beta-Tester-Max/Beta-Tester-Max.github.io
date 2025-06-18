<?php if (isset($_SESSION['Family_ID']) && !empty($_SESSION['Family_ID'])) {
    if (isset($_SESSION['hasFamily']) && $_SESSION['hasFamily'] === 1) { ?>
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-auto">

                <h4 class="text-center">Requirements</h4><br><br>

                <?php include "Functions/PHP/accountRequirementButtons.php" ?>

            </div>
        </div>

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <?php include "Functions/PHP/accountRequirementsTables.php" ?>

            </div>
        </div>

        <div class="row justify-content-md-center my-5">
            <div class="col-md-auto">

                <?php include "Functions/PHP/hasValidatedRequirements.php" ?>

            </div>
        </div>
    <?php } else { ?>
        <div class="row justify-content-md-center mt-5">
        <div class="col-md-auto">

            <p><b> TO BE ABLE TO SUBMIT AND VALIDATE YOUR ACCOUNT MUST HAVE ATLEAST ONE FAMILY MEMBER. go to: <a
                        href="familyMember.php">Add Family Member</a></b></p>

        </div>
    </div>
    <?php }
} else { ?>
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-auto">

            <p><b> TO BE ABLE TO SUBMIT AND VALIDATE YOUR ACCOUNT MUST FIRST HAVE A FAMILY NAME AND ADDRESS. go to: <a
                        href="editProfile.php">Edit Profile</a></b></p>

        </div>
    </div>
<?php } ?>