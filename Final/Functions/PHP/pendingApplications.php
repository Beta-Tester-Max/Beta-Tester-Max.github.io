<?php
if (isset($_SESSION['pendingApplications']) && !empty($_SESSION['pendingApplications'])) { ?>
    <table class="table table-dark table-striped-columns border border-dark">
        <thead>
            <tr class="table-active">
                <th class="text-center" scope="col">Assistance Type</th>
                <th scope="col">Severity</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Date Submitted</th>
                <th class="text-center" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php foreach ($_SESSION['pendingApplications'] as $p) {
                $apid = $p['Application_ID'] ?? "";
                $st = $p['Status'] ?? "";
                $aid = $p['Assistance_ID'] ?? "";
                $an = $_SESSION['pAan' . $apid] ?? "";
                $s = $_SESSION['pAs' . $apid] ?? "";
                $ds = $p['Date_Submitted'] ?? "" ?>
                <tr>
                    <td class="text-center align-middle"><?php echo $an ?></td>
                    <td class="align-middle"><?php echo $s ?></td>
                    <td class="text-center text-warning align-middle"><?php echo $st ?></td>
                    <td class="text-center align-middle"><?php echo $ds ?></td>
                    <td class="align-middle text-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delCon<?php echo $apid ?>">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="history-content">
        <p>There are no pending applications.</p>
    </div>
<?php } ?>