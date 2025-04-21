<?php include 'connect.php';
session_start();
if (empty($_SESSION['userid'])) {
    session_destroy();
    session_start(); ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body class="overflow-x-hidden" style="min-width: 50em;">
        <div class="container-fluid">
            <div class="d-flex flex-column justify-content-center align-items-center mt-5">
                <form method="POST">
                    <div class="mb-3">
                        <label for="account" class="form-label">Username or Email</label>
                        <input type="text" class="form-control" placeholder="Enter Username/Email" name="account"
                            maxlength="25" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password"
                            maxlength="15" required>
                    </div>
                    <div class="mb-3 justify-content-center align-items-center d-flex">
                        <button type="submit" name="loginForm" class="btn btn-primary">Submit</button>
                    </div>
                    <p>Go to <a href="register.php">Sign up</a> or <a href="index.php">homepage</a></p>
                </form>
                <?php if (isset($_POST['loginForm'])) {
                    $account = $_POST['account'];
                    $password = $_POST['password'];

                    try {
                        $sql = $pdo->prepare("SELECT User_ID, Password, Access_Level FROM register_tbl where Username = :account OR Email = :account");
                        $sql->bindParam(":account", $account, PDO::PARAM_STR);
                        $sql->execute();
                        $row = $sql->fetch(PDO::FETCH_ASSOC);

                        if ($row && password_verify($password, $row["Password"])) {
                            if ($row["Access_Level"] === "Admin") { 
                                $_SESSION['authority'] = $row['Access_Level'];
                                ?>
                                <script>
                                    window.location.href = "administration.php"
                                </script>
                            <?php } else {
                                $_SESSION["userid"] = $row["User_ID"] ?>
                                <script>
                                    window.location.href = "index.php"
                                </script>
                            <?php }
                        }
                    } catch (PDOException $e) {
                        echo "<script>alert('Database error: " . addslashes($e->getMessage()) . "');</script>";
                    }
                    $sql = null;
                } ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else { ?>
    <script>window.location.href = 'index.php'</script><?php }