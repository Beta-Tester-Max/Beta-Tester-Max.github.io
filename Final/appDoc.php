<?php
session_start();
include "Functions/PHP/userDataFetcher.php";
include "Functions/PHP/forUser.php";
include "Functions/PHP/hasFamilyCA.php";
include "Functions/PHP/appCredFetcher.php"
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Application Form</title>
  <link rel="icon" type="image/x-icon" href="./assets/img/AICS150.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/7961b8f896.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./assets/create.css" />
  <style>
    .close i{
      transition: ease .5s;
    }

    .close i:hover {
      color: red;
      scale: 1.2;
      transition: ease .5s;
    }

    .submit {
      transition: ease .5s;
    }

    .submit:hover {
      scale: 1.2;
      transition: ease .5s;
    }

    .file {
      transition: ease 1s;
    }

    .file:hover {
      transition: ease 1s;
    }
  </style>
</head>

<body class="overflow-x-hidden" style="min-width: 50em">
  <div class="container-fluid">
    <div class="row justify-content-md-center my-5">
      <div class="col-md-auto form-border rounded shadow p-0">
        <div class="d-flex justify-content-end me-2 mt-1">
          <a class="text-decoration-none text-light fs-2 close" href="createApp.php"><i
              class="fa-solid fa-circle-xmark"></i></a>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center px-4 pb-5">

          <div class="d-flex flex-column justify-content-center align-items-center">
            <h3>Files to Submit</h3>
          </div>
          <form method="POST" enctype="multipart/form-data" action="Functions/PHP/createApplication.php">
            <div class="row justify-content-md-center">
              <div class="col-md-auto">

                <?php include "Functions/PHP/accountRequirementsTables.php" ?>

              </div>
              <div class="mt-4 d-flex justify-content-center align-items-center">
                <?php include "Functions/PHP/appHiddenInputs.php"?>
                <input type="hidden" name="createApplication">
                <button type="submit" class="btn btn-outline-light submit ms-4">
                  Submit Application
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="Functions/JS/appDocScript.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>