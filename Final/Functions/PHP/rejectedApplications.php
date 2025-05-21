<?php
if (isset($_SESSION['rejectedApplications']) && !empty($_SESSION['rejectedApplications'])) { ?>
    <table class="table table-dark table-striped-columns border border-dark">
        <thead>
            <tr class="table-active">
                <th class="text-center" scope="col">Assistance Type</th>
                <th scope="col">Reason For Rejection</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Date Submitted</th>
                <th class="text-center" scope="col">Date Reviewed</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php foreach ($_SESSION['rejectedApplications'] as $r) {
                $apid = $r['Application_ID'] ?? "";
                $rfr = $r['ReasonFR'];
                $s = $r['Status'] ?? "";
                $aid = $r['Assistance_ID'] ?? "";
                $an = $_SESSION['rAan' . $apid] ?? "";
                $ds = $r['Date_Submitted'] ?? "";
                $dr = $r['Date_Reviewed'] ?? "" ?>
                <tr>
                    <td class="text-center align-middle"><?php echo $rfr ?></td>
                    <td class="text-center align-middle"><?php echo $an ?></td>
                    <td class="text-center text-danger align-middle"><?php echo $s ?></td>
                    <td class="text-center align-middle"><?php echo $ds ?></td>
                    <td class="text-center align-middle"><?php echo $dr ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="history-content">
        <p>There are no rejected historical applications.</p>
    </div>
<?php } ?>