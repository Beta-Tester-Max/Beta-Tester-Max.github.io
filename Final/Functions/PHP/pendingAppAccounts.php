<?php
if (isset($_SESSION['pA']) && !empty($_SESSION['pA'])) {
  foreach ($_SESSION['pA'] as $p) {
    $aid = $p['Application_ID'] ?? "";
    $a = $p['Account_ID'] ?? "";
    $n = $_SESSION['pA_name' . $aid] ?? "";
    $assistance = $_SESSION['pA_as' . $aid] ?? "";
    $fn = $n['First_Name'] ?? "";
    $mn = $n['Middle_Name'] ?? "";
    $ln = $n['Last_Name'] ?? "";
    if (!empty($mn)) {
      $fullname = $fn . '&nbsp;' . $mn . '&nbsp;' . $ln;
    } else {
      $fullname = $fn . '&nbsp;' . $ln;
    }
    $ad = $_SESSION['pA_add' . $aid] ?? "";
    $address = $ad['House_Number'] . "&nbsp;" . $ad['Street_Name'] . "&nbsp;" . $ad['Barangay'] . "&nbsp;" . $ad['City_or_Municipality'] . ", " . $ad['Province'];
    ?>
    <li class="application-item">
      <div class="application-name">
        <p><?php echo $fullname ?></p>
        <p><?php echo $assistance ?></p>
        <p><?php echo $address ?></p>
      </div>
      <button type="button" class="application-action" data-bs-toggle="modal" data-bs-target="#application_<?php echo $aid?>">
        Review
      </button>
    </li>
    <?php
  }
}
?>