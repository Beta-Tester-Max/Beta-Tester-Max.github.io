<?php
if (isset($_SESSION['csID']) || !empty($_SESSION['csID'])) {
    $csid = cleanInt(intval($_SESSION['csID'] ?? ""));
    if (empty($csid)) {
        header('Location: logout.php');
        exit;
    } elseif (strlen(strval($csid)) > 11) {
        header('Location: logout.php');
        exit;
    } elseif (!preg_match("/^\d+$/", $csid)) {
        header('Location: logout.php');
        exit;
    }
    try {

        $sql = $pdo->prepare("SELECT form_II FROM tbl_cs WHERE id = :1");
        $sql->bindParam(":1", $csid, PDO::PARAM_INT);
        $sql->execute();
        $r = $sql->fetch(PDO::FETCH_ASSOC);
        $_SESSION['hasFormII'] = cleanInt(intval($r['form_II'] ?? ""));
        if (cleanInt(intval($r['form_II'] ?? "")) === 1) {

        } else {
            header('Location: ../Form_II/');
            exit;
        }
    } catch (PDOException $e) {
        $alert = "Connection Error: " . $e->getMessage();
        ?>
        <script>
            alert(<?php echo json_encode($alert) ?>);
        </script>
        <?php
    }
} else {
    header('Location: ../Form_II/');
    exit;
}
?>