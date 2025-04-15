<?php include "connect.php";
session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AICS Landing Page</title>
  <link rel="icon" type="image/x-icon" href="./img/aics-logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="landing.css">
  <link rel="stylesheet" href="nav.css">
  <style>
    footer .mg-widget p,
    footer .site-title-footer a,
    footer .site-title a:hover,
    footer .site-description-footer,
    footer .site-description:hover {

      color: #000000;
    }
  </style>
</head>

<bod class="overflow-x-hidden" style="min-width: 20em;">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img class="logo" src="./img/aics-logo.ico" alt="AICS">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Assistance
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="application.php">Psychosocial Support</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <?php if (empty($_SESSION['userid'])) {
              ?>
                <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop01">
                    Create Application
                  </button>
                </li>
                <?php } else {
                $userid = $_SESSION['userid'];
                $rows = [];
                $sql = "SELECT Document_Type 
                                        FROM requirements_tbl 
                                        where User_ID = '$userid'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                  $rows[] = $row['Document_Type'];
                }
                if (in_array("Barangay Indigency", $rows)) {
                  if (in_array("Valid ID", $rows)) {
                    if (in_array("Birth Certificate", $rows) || in_array("Marriage Certificate", $rows)) {
                      if (in_array("Referral Letter", $rows)) {
                ?>
                        <li><a class="dropdown-item" href="application.php">Create Application</a></li><?php
                                                                                                      } else {
                                                                                                        $modaltext = "Referral Letter";
                                                                                                        ?>
                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop02">
                            Create Application
                          </button>
                        </li><?php
                                                                                                      }
                                                                                                    } else {
                                                                                                      $modaltext = "Birth Certificate or Marriage Certificate";
                              ?>
                      <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                          data-bs-target="#staticBackdrop02">
                          Create Application
                        </button>
                      </li><?php
                                                                                                    }
                                                                                                  } else {
                                                                                                    $modaltext = "Valid ID";
                            ?>
                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop02">
                        Create Application
                      </button>
                    </li><?php
                                                                                                  }
                                                                                                } else {
                                                                                                  $modaltext = "Barangay Indigency";
                          ?>
                  <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                      data-bs-target="#staticBackdrop02">
                      Create Application
                    </button>
                  </li><?php
                                                                                                }
                                                                                              } ?>
            </ul>
          </li>
        </ul>
        <div class="search-container">
          <form class="d-flex m-auto" role="search">
            <input class="form-control me-2 searchbar" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light searchbtn" type="submit">Search</button>
          </form>
        </div>
        <?php if (empty($_SESSION['userid'])) { ?>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <p class="nav-link btn-secondary pe-none">or</p>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Sign up</a>
            </li>
          </ul>
        <?php } else { ?>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <?php $userid = $_SESSION['userid'];
                $sql = "SELECT Username FROM register_tbl where User_ID = '$userid'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo $row['Username'] ?>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="messaging.php">Messages</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        <?php } ?>
      </div>
    </div>
  </nav>

  <div class="aics">AICS</div>
  <div
    class="brief-desc">
    The Municipality of Alaminos, Laguna, through its Municipal Social Welfare
    and Development Office (MSWDO) , is committed to providing immediate and compassionate support to
    individuals and families facing urgent crises. Guided by Section 16 of the
    Local Government Code of 1991 (RA 7160), the AICS Program ensures that
    marginalized, vulnerable, and low-income residents receive timely assistance
    to alleviate distress, meet basic needs, and pave the way toward long-term
    stability.
  </div>
  <br />
  <br />
  <br />
  <div class="banner">
    <div class="slider" style="--quantity: 7">
      <div class="item" id="item1" style="--position: 1" onclick="showDescription(1)">
        <img src="./img/transportation.png" alt="">
      </div>
      <div class="item" id="item2" style="--position: 2" onclick="showDescription(2)">
        <img src="./img/food.png" alt="">
      </div>
      <div class="item" id="item3" style="--position: 3" onclick="showDescription(3)">
        <img src="./img/medical.png" alt="">
      </div>
      <div class="item" id="item4" style="--position: 4" onclick="showDescription(4)">
        <img src="./img/cash.png" alt="">
      </div>
      <div class="item" id="item5" style="--position: 5" onclick="showDescription(5)">
        <img src="./img/burial.png" alt="">
      </div>
      <div class="item" id="item6" style="--position: 6" onclick="showDescription(6)">
        <img src="./img/educational.png" alt="">
      </div>
      <div class="item" id="item7" style="--position: 7" onclick="showDescription(7)">
        <img src="./img/psychosocial.png" alt="">
      </div>
      <div class="item" id="item8" style="--position: 8" onclick="showDescription(8)">
        <img src="./img/aics-logo.ico" alt="">
      </div>
    </div>
    <div class="description-box">
      <p id="description-text">Click on an image to see the description.</p>
    </div>
  </div>
  <script>
    function showDescription(position) {
      const descriptions = {
        1: "Transportation Assistance offers financial aid to individuals who need travel funds for medical treatments, job relocation, or emergency situations. This program ensures that applicants can reach their destinations, such as hospitals or places of employment, without financial hardship.",
        2: "Food Assistance provides essential food supplies or financial aid to individuals and families facing hunger due to crisis situations such as calamities, job loss, or financial instability. This program aims to ensure food security and prevent malnutrition, especially among vulnerable groups.",
        3: "Medical Assistance provides financial aid to individuals who need support for hospitalization, medical procedures, laboratory tests, or the purchase of essential medicines. This program helps applicants cover medical expenses, ensuring they receive the necessary healthcare services, particularly for emergency and life-threatening conditions.",
        4: "Cash Relief Assistance offers immediate financial aid to individuals and families affected by unexpected crises such as natural disasters, accidents, or economic hardships. The provided cash support helps them address urgent needs, including rent, food, and other daily expenses.",
        5: "Burial Assistance helps families cope with funeral and burial expenses after the loss of a loved one. This program provides financial support for coffin purchase, funeral services, and burial costs, reducing the financial burden on grieving families during difficult times.",
        6: "Educational Assistance is designed to support students from financially struggling families by providing financial aid for tuition fees, school supplies, and other academic-related expenses. This assistance aims to ensure that students, particularly those in crisis situations, can continue their education without financial barriers.",
        7: "Psychosocial Support is designed to assist individuals dealing with emotional, mental, or social distress caused by traumatic experiences, such as disasters, abuse, or loss. This program offers counseling, therapy, and guidance services to help applicants recover and rebuild their emotional well-being.",
        8: "The AICS Program is a government initiative that provides immediate assistance to individuals and families facing crises. It aims to alleviate distress, meet basic needs, and promote long-term stability for marginalized and vulnerable residents."
      };

      const descriptionBox = document.querySelector(".description-box");
      const descriptionText = document.getElementById("description-text");

      descriptionText.textContent = descriptions[position];
      descriptionBox.classList.add("active");
    }
  </script>
  <br />
  <di id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" aria-label="Slide 7"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./img/trans slider.png" class="d-block w-100" alt="Transportation Assistance">
          <div class="carousel-caption d-none d-md-block">
            <h3>Transportation Assistance</h3>
            <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
            <p class="text-start">2. Medical Certificate referral (for medical transport request)</p>
            <p class="text-start">3. Death Certificate or Medical Report of a Relative (for family emergency)</p>
            <p class="text-start">4. Police Report or legal documents (for cases of abuse, transferring or court related cases).</p>
            <p class="text-start">5. ID of authorized representative and Authorization Letter</p>
            <p class="text-start">6. ID of patient</p>
            <p class="text-start">7. Proof of Relationship (Birth Certificate, Marriage Certificate)</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./img/food slider.png" class="d-block w-100" alt="Food Assistance">
          <div class="carousel-caption d-none d-md-block">
            <h3>Food Assistance</h3>
            <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
            <p class="text-start">2. Valid ID (Photocopy)</p>
            <p class="text-start">3. Marriage Certificate or Birth Certificate</p>
            <p class="text-start">4. Disaster Certificate (if applicable for calamity affected individual)</p>
            <p class="text-start">5. Medical Certificate or Referral (if applicable for malnourished individual or those with health conditions requiring food aid)</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./img/medical slider.png" class="d-block w-100" alt="Medical Assistance">
          <div class="carousel-caption d-none d-md-block">
            <h3>Medical Assistance</h3>
            <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
            <p class="text-start">2. Original or Certified True Copy of Latest Medical Certificate or Clinical Abstract</p>
            <p class="text-start">3. Hospital Billing Statement for Hospitalization or procedure</p>
            <p class="text-start">4. Pharmacy Quotation for required medications.</p>
            <p class="text-start">5. Laboratory/ Diagnostic request for test and imaging</p>
            <p class="text-start">6. Original Official Receipts</p>
            <p class="text-start">7. Original or Certified True Copy of Certification of outstanding debts or Payable Obligations </p>
            <p class="text-start">8. ID of authorized representative and Authorization Letter)</p>
            <p class="text-start">9. ID of patient</p>
            <p class="text-start">10. Proof of Relationship (Birth Certificate, Marriage Certificate)</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./img/Cash slider.png" class="d-block w-100" alt="Cash Relief Assistance">
          <div class="carousel-caption d-none d-md-block">
            <h3>Cash Relief Assistance</h3>
            <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
            <p class="text-start">2. Valid ID (Photocopy)</p>
            <p class="text-start">3. Marriage Certificate or Birth Certificate</p>
            <p class="text-start">4. Incident Report from BFP, LGU or disaster response agency.</p>
            <p class="text-start">5. Medical Certificate (if the applicant or a family member was injured in the disaster)</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./img/Bur slider.png" class="d-block w-100" alt="Burial Assistance">
          <div class="carousel-caption d-none d-md-block">
            <h3>Burial Assistance</h3>
            <p class="text-start">1. Updated Original Certificate of Indigency from Barangay proving financial incapacity</p>
            <p class="text-start">2. Death Certificate </p>
            <p class="text-start">3. Funeral Contract</p>
            <p class="text-start">4. Original or certified true copy of Official Receipt</p>
            <p class="text-start">5. ID of Authorized Representative</p>
            <p class="text-start">6. ID of expired person</p>
            <p class="text-start">7. Proof of Relationship (Birth Certificate) Photocopy</p>
            <p class="text-start">8. Marriage Contract and Authorization Letter</p>
            <p class="text-start">9. Certification of Outstanding Debts or Payable Obligations (Original or Certified True Copy)</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./img/edu slider.png" class="d-block w-100" alt="Educational Assistance">
          <div class="carousel-caption d-none d-md-block">
            <h3>Educational Assistance</h3>
            <p class="text-start">1. Updated Original Certificate of Indigency from Barangay proving financial incapacity</p>
            <p class="text-start">2. Certified True Copy of Enrollment Assessment Form or Certificate of Enrollment</p>
            <p class="text-start">3. School ID of the student/ Beneficiary (Photocopy)</p>
            <p class="text-start">4. Certified True Copy of Grades signed by the authorized personnel</p>
            <p class="text-start">5. Medical Certificate (if applicable for HIV and other health related cases)</p>
            <p class="text-start">6. Police Report/ Social Worker’s Assessment (for abuse and displacement cases)</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="./img/Psych slider.png" class="d-block w-100" alt="Psychosocial Support">
          <div class="carousel-caption d-none d-md-block">
            <h3>Psychosocial Support</h3>
            <p class="text-start">1. Updated Original Certificate of Indigency from Barangay with proof of low income</p>
            <p class="text-start">2. Valid ID (Photocopy)</p>
            <p class="text-start">3. Marriage Certificate or Birth Certificate</p>
            <p class="text-start">4. Referral Letter from Social Worker, Barangay Officer, or Mental Health Professional</p>
            <p class="text-start">5. Medical or Psychological Report (if applicable, for cases related to diagnosed mental health conditions)</p>
            <p class="text-start">6. Police or Legal Report (if applicable, for cases involving abuse, violence, or exploitation)</p>
            <p class="text-start">7. Original or Certified True Copy of Certification of outstanding debts or Payable Obligations </p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    </div>
    </body>
    <br />
    <!-- Feedback Section start-->
    <section class="feedback-section">
      <div class="feedback-container">
        <h2 class="feedback-title">Feedback</h2>
        <p class="feedback-description">We value your feedback! Please let us know your thoughts about our services.</p>
        <form action="feedback.php" method="POST" class="feedback-form">
          <div class="input-container">
            <input type="text" id="email" placeholder="Email" required style="background-color: #f0f0f0;" />
            <label for="username">Email</label>
          </div>
          <div class="input-container">
            <input type="text" id="name" placeholder="Name" required style="background-color: #f0f0f0;" />
            <label for="username">Name</label>
          </div>
          <textarea name="message" class="feedbackText" rows="10" cols="70" placeholder="Write Your Feedback Here" required></textarea>
          <button type="submit">Submit</button>
        </form>
      </div>
    </section>
    <!-- Feedback Section end-->
    <!--==================== FOOTER AREA ====================-->
    <footer>
      <div class="overlay" style="background-color: #0669ff;">
        <!--Start mg-footer-widget-area-->
        <div class="mg-footer-widget-area">
          <div class="container-fluid">
            <div class="row">
              <div id="block-76" class="col-md-4 rotateInDownLeft animated mg-widget widget_block">
                <ul>
                  <li style="font-style:normal;font-weight:700" class="has-medium-font-size"><strong>VISIT US</strong></li>


                  <li> D. Fandiño Street, Poblacion 3, Alaminos, Laguna </li>
                  <!-- /wp:list-item -->

                  <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
                    <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div>
                    <script>
                      (function() {
                        var setting = {
                          "query": "Alaminos Municipal Hall, Alaminos, Laguna, Philippines",
                          "width": 611,
                          "height": 251,
                          "satellite": true,
                          "zoom": 14,
                          "placeId": "ChIJK-BKkxFovTMRCHKdGJxYv5Q",
                          "cid": "0x94bf589c189d7208",
                          "coords": [14.0653171, 121.246531],
                          "cityUrl": "/philippines/tagaytay-city-33123",
                          "cityAnchorText": "Map of Tagaytay City, Calabarzon, Philippines",
                          "lang": "us",
                          "queryString": "Alaminos Municipal Hall, Alaminos, Laguna, Philippines",
                          "centerCoord": [14.0653171, 121.246531],
                          "id": "map-9cd199b9cc5410cd3b1ad21cab2e54d3",
                          "embed_id": "1118305"
                        };
                        var d = document;
                        var s = d.createElement('script');
                        s.src = 'https://1map.com/js/script-for-user.js?embed_id=1118305';
                        s.async = true;
                        s.onload = function(e) {
                          window.OneMap.initMap(setting)
                        };
                        var to = d.getElementsByTagName('script')[0];
                        to.parentNode.insertBefore(s, to);
                      })();
                    </script><a href="https://1map.com/map-embed">1 Map</a>
                  </div>

              </div>
              <div id="block-77" class="col-md-4 rotateInDownLeft animated mg-widget widget_block">
                <ul>
                  <li style="font-style:normal;font-weight:700" class="has-medium-font-size"><strong>ABOUT US</strong></li>



                  <li>Alaminos, officially the&nbsp;<strong>Municipality of Alaminos</strong>&nbsp;(<a href="https://en.wikipedia.org/wiki/Tagalog_language">Tagalog</a>:&nbsp;<em>Bayan ng Alaminos</em>), is a 3rd class&nbsp;<a href="https://en.wikipedia.org/wiki/Municipality_of_the_Philippines">municipality</a>&nbsp;in the&nbsp;<a href="https://en.wikipedia.org/wiki/Philippine_Province">province</a>&nbsp;of&nbsp;<a href="https://en.wikipedia.org/wiki/Laguna_(province)">Laguna</a>,&nbsp;<a href="https://en.wikipedia.org/wiki/Philippines">Philippines</a>.&nbsp;</li>



                  <li>According to the 2020 census, it has a population of 51,619 people. </li>
                </ul>

                <figure class="wp-block-image size-full"><img loading="lazy" decoding="async" width="600" height="164" src="https://alaminoslaguna.com/wp-content/uploads/2024/06/Screenshot-2024-06-04-215715.png" alt="" class="wp-image-4054" srcset="https://i0.wp.com/alaminoslaguna.com/wp-content/uploads/2024/06/Screenshot-2024-06-04-215715.png?w=600&amp;ssl=1 600w, https://i0.wp.com/alaminoslaguna.com/wp-content/uploads/2024/06/Screenshot-2024-06-04-215715.png?resize=150%2C41&amp;ssl=1 150w, https://i0.wp.com/alaminoslaguna.com/wp-content/uploads/2024/06/Screenshot-2024-06-04-215715.png?resize=80%2C22&amp;ssl=1 80w" sizes="auto, (max-width: 600px) 100vw, 600px" /></figure>
              </div>
              <div id="block-56" class="col-md-4 rotateInDownLeft animated mg-widget widget_block">
                <ul class="wp-block-list">
                  <li style="font-style:normal;font-weight:700" class="has-medium-font-size"><strong>GOVERNMENT LINKS</strong></li>



                  <li><a href="https://www.gov.ph/" data-type="link" data-id="https://www.gov.ph/">About Gov PH</a></li>



                  <li><a href="https://pbbm.com.ph/">The President</a></li>



                  <li><a href="https://op-proper.gov.ph/">Office of the President </a></li>



                  <li><a href="https://www.ovp.gov.ph/">Office of the Vice President </a></li>



                  <li><a href="https://legacy.senate.gov.ph/">Senate of the Philippines</a></li>



                  <li><a href="https://www.congress.gov.ph/">House of Representatives</a></li>



                  <li></li>
                </ul>
              </div>
              <div id="block-79" class="col-md-4 rotateInDownLeft animated mg-widget widget_block widget_text">
                <p>© 2024 <strong>Alaminos Laguna</strong>. All Rights Reserved.</p>
              </div>
            </div>
            <!--/row-->
          </div>
          <!--/container-->
        </div>
        <!--End mg-footer-widget-area-->
        <!--Start mg-footer-widget-area-->
        <div class="mg-footer-bottom-area">
          <div class="container-fluid">
            <div class="divide-line"></div>
            <div class="row align-items-center">
              <!--col-md-4-->
              <div class="col-md-6">
                <span class="navbar-brand"><img width="260" height="260" src="https://alaminoslaguna.com/wp-content/uploads/2023/08/cropped-cropped-cropped-Alaminos_Laguna_seal_logo.png" class="custom-logo" alt="" decoding="async" srcset="https://i0.wp.com/alaminoslaguna.com/wp-content/uploads/2023/08/cropped-cropped-cropped-Alaminos_Laguna_seal_logo.png?w=260&amp;ssl=1 260w, https://i0.wp.com/alaminoslaguna.com/wp-content/uploads/2023/08/cropped-cropped-cropped-Alaminos_Laguna_seal_logo.png?resize=150%2C150&amp;ssl=1 150w, https://i0.wp.com/alaminoslaguna.com/wp-content/uploads/2023/08/cropped-cropped-cropped-Alaminos_Laguna_seal_logo.png?resize=80%2C80&amp;ssl=1 80w" sizes="(max-width: 260px) 100vw, 260px" /></span>
                <div class="site-branding-text">
                  <p class="site-title-footer"> <a href="https://alaminoslaguna.com/" rel="home">Alaminos, Laguna</a></p>
                  <p class="site-description-footer">The Town of CoRambLan Festival</p>
                </div>
              </div>


              <div class="col-md-6 text-right text-xs">

                <ul class="mg-social">
                  <li> <a href="https://www.facebook.com/KuyaGlenn.Official"><span class="icon-soci facebook"><i class="fab fa-facebook"></i></span>
                    </a></li>

                  <li><a target="_blank" href="#">
                      <span class="icon-soci linkedin"><i class="fab fa-linkedin"></i></span></a></li>

                  <li><a href="#"><span class="icon-soci instagram"><i class="fab fa-instagram"></i></span>
                    </a></li>

                </ul>


              </div>
              <!--/col-md-4-->

            </div>
            <!--/row-->
          </div>
          <!--/container-->
        </div>
        <!--End mg-footer-widget-area-->

        <div class="mg-footer-copyright">
          <div class="container-fluid">
            <div class="row">

              <div class="col-md-12 text-xs text-center">
                <p>
                  <a href="https://wordpress.org/">
                    Proudly powered by WordPress </a>
                  <span class="sep"> | </span>
                  Theme: Newsup by <a href="https://themeansar.com/" rel="designer">Themeansar</a>.
                </p>
              </div>


            </div>
          </div>
        </div>
      </div>
      <!--/overlay-->
    </footer>
    <!--/footer-->
    <!-- Footer Section end-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
    </body>

</html>