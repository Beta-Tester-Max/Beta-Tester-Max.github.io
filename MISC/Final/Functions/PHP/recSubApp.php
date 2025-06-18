<?php
if (isset($_SESSION['recSubApp'])) {
    $r = $_SESSION['recSubApp'];
    unset($_SESSION['recSubApp']);
    $as = $r['Assistance'] ?? "";
    $cr = $r['Criteria'] ?? "";
    $fn = $r['fullName'] ?? "";
    $ad = $r['Address'] ?? "";
    $c = $r['Cost'] ?? "";

?>
<div class="container">
        <div class="success-message">
            <i><img src="./assets/img/Check Mark.png" alt=""></i>
            <h2>APPLICATION SUBMITTED</h2>
            <p>Your application has been successfully submitted</p>
        </div>

        

        <div class="details-grid">
            <div class="detail-box">
                <div class="detail-title">Assistance Type</div>
                <div class="detail-content"><?php echo $as?></div>
            </div>
            <div class="detail-box">
                <div class="detail-title">Severity</div>
                <div class="detail-content"><?php echo $cr?></div>
            </div>
            <div class="detail-box">
                <div class="detail-title">Applicant Information</div>
                <div class="detail-content"><b>Submitted By: </b><?php echo $fn?><br><b>From: </b><?php echo $ad?></div>
            </div>
            <div class="detail-box">
                <div class="detail-title">Financial Information</div>
                <div class="detail-content">₱ <?php echo number_format($c, 2, '.', ',')?></div>
            </div>
        </div>
    </div>
<?php } ?>