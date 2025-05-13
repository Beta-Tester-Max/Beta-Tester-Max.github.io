<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="Assets/Style/style.css">
</head>

<body>

    <video autoplay muted loop class="bg-video" playsinline>
        <source src="Assets/Video/background.webm" type="video/webm">
        Your browser does not support the video tag.
    </video>

    <div class="container-fluid">

        <div class="position-absolute top-50 start-50 translate-middle">

            <div class="bg-glass rounded px-3 pt-5 pb-3 my-5">

                <form class="center flex-column align-items-center" method="POST" action="">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" maxlength="50" placeholder="" id="usernameInput"
                            required>
                        <label for="usernameInput">Username or Email</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" maxlength="15" placeholder="" id="passwordInput"
                            required>
                        <label for="passwordInput">Password</label>
                    </div>

                    <button type="submit" class="btn btn-outline-light btn-lg mb-3">Login</button>

                    <a class="text-center text-light link" href="registrationForm.php">Don't have an account?</a>
                </form>

            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
            crossorigin="anonymous"></script>
</body>

</html>