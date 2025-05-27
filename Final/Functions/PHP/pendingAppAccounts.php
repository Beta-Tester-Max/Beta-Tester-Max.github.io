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
    $reason = $p['Reason'] ?? "";
    ?>
    <li class="application-item">
      <div class="application-name">
        <p class="app-name"><?php echo $fullname ?></p>
        <p class="app-assistance"><?php echo $assistance ?></p>
        <p class="app-address"><?php echo $address ?></p>
        <p class="app-reason" style="display: none;">Reason: <?php echo $reason ?></p>
        <p class="app-application" style="display: none;"><?php echo $aid ?></p>
      </div>
      <button class="application-action">Review</button>
    </li>
    <?php
  }
}
?>