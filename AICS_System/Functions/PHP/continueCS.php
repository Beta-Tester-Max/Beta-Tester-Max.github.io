<?php
require_once "connect.php";
ini_set('session.cookie_httponly', 1);
session_start();

if (isset($_POST['continue'])) {
    $id = cleanInt(intval($_POST['id'] ?? ""));

    if (empty($id)) {
        $_SESSION['alert'] = "Missing ID!";
        header('Location: ../../Case_Study/');
        exit;
    } elseif (strlen(strval($id)) > 11) {
        $_SESSION['alert'] = "Invaid ID Length.";
        header('Location: ../../Case_Study/');
        exit;
    } else {
        $_SESSION['csID'] = $id;

        try {

            $sql = $pdo->prepare("SELECT form_I FROM tbl_cs WHERE id = :1");
            $sql->bindParam(":1", $id, PDO::PARAM_INT);
            $sql->execute();
            $r = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['hasFormI'] = cleanInt(intval($r['form_I'] ?? ""));

            $sql = $pdo->prepare("SELECT form_II FROM tbl_cs WHERE id = :1");
            $sql->bindParam(":1", $id, PDO::PARAM_INT);
            $sql->execute();
            $r = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['hasFormII'] = cleanInt(intval($r['form_II'] ?? ""));

            $sql = $pdo->prepare("SELECT form_III FROM tbl_cs WHERE id = :1");
            $sql->bindParam(":1", $id, PDO::PARAM_INT);
            $sql->execute();
            $r = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['hasFormIII'] = cleanInt(intval($r['form_III'] ?? ""));

            $sql = $pdo->prepare("SELECT form_IV FROM tbl_cs WHERE id = :1");
            $sql->bindParam(":1", $id, PDO::PARAM_INT);
            $sql->execute();
            $r = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['hasFormIV'] = cleanInt(intval($r['form_IV'] ?? ""));

            if (cleanInt(intval($_SESSION['hasFormIV'] ?? "")) === 1) {
                header('Location: ../../Form_V/');
                exit;
            } elseif (cleanInt(intval($_SESSION['hasFormIII'] ?? "")) === 1) {
                header('Location: ../../Form_IV/');
                exit;
            } elseif (cleanInt(intval($_SESSION['hasFormII'] ?? "")) === 1) {
                header('Location: ../../Form_III/');
                exit;
            } elseif (cleanInt(intval($_SESSION['hasFormI'] ?? "")) === 1) {
                header('Location: ../../Form_II/');
                exit;
            } else {
                header('Location: ../../Form_I/');
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
    }
} else {
    header('Location: include/logout.php');
    exit;
}
?>