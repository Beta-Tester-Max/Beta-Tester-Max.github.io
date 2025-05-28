<?php
ini_set('session.cookie_httponly', 1);
session_start();
include "Functions/PHP/userDataFetcher.php";
include "Functions/PHP/forUser.php";
include "Functions/PHP/ifSessionSD.php";
include "Functions/PHP/hasFamilyCA.php"
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
    .close i {
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
  </style>
</head>

<body class="overflow-x-hidden" style="min-width: 21.5em">
  <div class="container-fluid">
    <div class="row justify-content-md-center my-5">
      <div class="col-md-4 form-border rounded shadow p-0">
        <div class="d-flex justify-content-end me-2 mt-1">
          <a class="text-decoration-none text-light fs-2 close" href="profile.php"><i
              class="fa-solid fa-circle-xmark"></i></a>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center px-4 pb-5">

          <div class="d-flex flex-column justify-content-center align-items-center">
            <h3>Assistance Application Form</h3>
          </div>
          <form method="POST" action="Functions/PHP/appCred.php">
            <div class="row justify-content-md-center">
              <div class="col-md-auto">
                <div class="row justify-content-md-center">
                  <div class="col-md-auto">
                    <div class="mt-3">
                      <label class="mb-1" for="asAp">Select Assitance:</label><br />
                      <select class="form-select" id="asAp" name="assistance" required>
                        <?php include "Functions/PHP/assistanceSelect.php" ?>
                      </select>
                    </div>
                    <div class="mt-3">
                      <label class="mb-1" for="beAp">Select Beneficiary:</label><br />
                      <select class="form-select" id="beAp" name="helpee" required>
                        <?php include "Functions/PHP/familyMemberSelect.php" ?>
                      </select>
                    </div>
                    <div class="mt-3">
                      <label class="mb-1" for="reAp">Submitted By:</label><br />
                      <select class="form-select" id="reAp" name="rep">
                        <?php include "Functions/PHP/familyMemberSelect.php" ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-md-center">
                  <div class="col-md-auto">
                    <div class="mt-3">
                      <div class="form-floating">
                        <textarea class="form-control" placeholder="State your reason here" style="height: 200px;" cols="40" id="reason" minlength="10"
                          maxlength="1000" name="reason" required></textarea>
                        <label class="text-dark" for="reason">Reason</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-4 d-flex justify-content-center align-items-center">
                <input type="hidden" name="appCred">
                <button type="submit" class="btn btn-outline-light submit">
                  Next Requirements <i class="fa-solid fa-arrow-right"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>