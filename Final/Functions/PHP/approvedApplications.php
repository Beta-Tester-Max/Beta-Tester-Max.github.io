<?php
if (isset($_SESSION['approvedApplications']) && !empty($_SESSION['approvedApplications'])) { ?>
    <table class="table table-dark table-striped-columns border border-dark">
        <thead>
            <tr class="table-active">
                <th class="text-center" scope="col">Assistance Type</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Date Submitted</th>
                <th class="text-center" scope="col">Reviewed By</th>
                <th class="text-center" scope="col">Date Reviewed</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php foreach ($_SESSION['approvedApplications'] as $a) {
                $apid = $a['Application_ID'] ?? "";
                $s = $a['Status'] ?? "";
                $aid = $a['Assistance_ID'] ?? "";
                $an = $_SESSION['aAan' . $apid] ?? "";
                $ds = $a['Date_Submitted'] ?? "";
                $rb = $_SESSION['aArb' . $apid] ?? "";
                $dr = $a['Date_Reviewed'] ?? "" ?>
                <tr>
                    <td class="text-center align-middle"><?php echo $an ?></td>
                    <td class="text-center text-success align-middle"><?php echo $s ?></td>
                    <td class="text-center align-middle"><?php echo $ds ?></td>
                    <td class="text-center align-middle"><?php echo $rb ?></td>
                    <td class="text-center align-middle"><?php echo $dr ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="history-content">
        <p>There are no approved historical applications.</p>
    </div>
<?php } ?>