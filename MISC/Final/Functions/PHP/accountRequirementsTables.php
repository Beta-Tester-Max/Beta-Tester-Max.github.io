<?php
if (isset($_SESSION['sD']) && !empty($_SESSION['sD'])) {
    $a = $d['a'] ?? "";
    $an = $d['an'] ?? "";
    ?>
    <p class="text-center fs-4"><b><?php echo $an ?></b></p>

    <?php include "Functions/PHP/ratesSelect.php"?>

    <table class="table table-dark table-striped-columns border border-dark">
        <thead>
            <tr class="table-active">
                <th scope="col">Document Description</th>
                <th class="text-center" scope="col">Importance</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
            if (isset($_SESSION['Requirements' . $a]) && !empty($_SESSION['Requirements' . $a])) {
                $c = count($_SESSION['Requirements' . $a]) + 1;
                for ($n = 1; $n < $c; ++$n) {
                    $nc = $n - 1;
                    $r = $_SESSION['Requirements' . $a][$nc];
                    $rid = $r['Requirement_ID'] ?? "";
                    $desc = $r['Description'] ?? "";
                    $i = $r['Importance'] ?? "";

                    ?>
                    <tr>
                        <td class="align-middle"><?php echo $desc ?></td>
                        <td class="text-center align-middle"><?php
                        if ($i === 'Required') {
                            ?>
                                <b class="text-danger">Required</b>
                                <?php
                        } else {
                            ?>
                                <i class="text-secondary">Optional</i>
                                <?php
                        }
                        ?>
                        </td>
                        <td class="text-center align-middle">
                            <div class="fileCon">
                                <button type="button" class="btn btn-outline-dark file fakeFile mb-2">Choose File</button>
                                <input class="form-control realFile d-none" type="file" name="file<?php echo $n ?>"
                                    accept="application/pdf">
                                <p class="textFile m-0">No File Chosen</p>
                            </div>
                            <input type="hidden" name="importance<?php echo $n ?>" value="<?php echo $i ?>">
                            <input type="hidden" name="requirement<?php echo $n ?>" value="<?php echo $rid ?>">
                        </td>
                    </tr>

                <?php }
            } else {
                echo "<p>No requirements found for this assistance.</p>";
            } ?>
        </tbody>
    </table>
    <?php
}
?>