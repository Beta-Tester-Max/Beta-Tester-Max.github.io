<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Code Test 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>

    <?php
    include 'connect.php';

    $encrypted = $_GET['data'] ?? '';
    $decrypted = decrypt($encrypted);

    parse_str($decrypted, $data);

    $item = $data['item'] ?? 'Unknown';
    $desc = $data['desc'] ?? 'No description';

    echo "<h2>Decrypted Data</h2>";
    echo "<strong>Item:</strong> " . htmlspecialchars(ENT_QUOTES,$item, 'UTF-8') . "<br>";
    echo "<strong>Description:</strong> " . htmlspecialchars(ENT_QUOTES,$desc, 'UTF-8');

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>