<?php
ini_set('session.cookie_httponly', 1);
session_start();
include "Functions/PHP/displayAlert.php";
include "Functions/PHP/userDataFetcher.php";
include "Functions/PHP/adminLoggedIn.php"
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AICS Page</title>
  <link rel="icon" type="image/x-icon" href="./assets/img/AICS150.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/index.css" />
  <link rel="stylesheet" href="assets/nav.css" />
  <link rel="stylesheet" href="assets/footerfeed.css" />
</head>

<body class="overflow-x-hidden">
  <nav class="sticky-top navbar navbar-expand-lg">
    <div class="container-fluid py-2">
      <a class="navbar-brand" href="#">
        <img class="logo" src="./assets/img/AICS150.png" alt="AICS" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#banner">About</a>
          </li>
        </ul>
        <!-- search start -->
        <div class="search-cont">
          <div class="search-container mb-0">
            <input type="text" placeholder="Search..." class="search-input" />
            <button class="search-button" onclick="toggleSearch()">
              <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                  d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
              </svg>
            </button>
          </div>
        </div>
        <script>
          function toggleSearch() {
            const searchInput = document.querySelector(".search-input");

            if (window.innerWidth <= 768) {
              if (searchInput.style.width === "200px") {
                searchInput.style.width = "0";
                searchInput.style.padding = "0";
                searchInput.style.opacity = "0";
              } else {
                searchInput.style.width = "200px";
                searchInput.style.padding = "10px 15px";
                searchInput.style.opacity = "1";
              }
            }
          }

          // Reset search bar on window resize
          window.addEventListener("resize", function () {
            const searchInput = document.querySelector(".search-input");
            if (window.innerWidth > 768) {
              searchInput.style.width = "100%";
              searchInput.style.padding = "10px 15px";
              searchInput.style.opacity = "1";
            } else {
              searchInput.style.width = "0";
              searchInput.style.padding = "0";
              searchInput.style.opacity = "0";
            }
          });
        </script>
        <!-- search end -->
        <?php include "Functions/PHP/accountContent.php" ?>
      </div>
    </div>
  </nav>
  <!-- Brief Description start-->
  <div class="aics">AICS</div>
  <div class="brief-desc">
    The Municipality of Alaminos, Laguna, through its Municipal Social Welfare
    and Development Office (MSWDO) , is committed to providing immediate and
    compassionate support to individuals and families facing urgent crises.
    Guided by Section 16 of the Local Government Code of 1991 (RA 7160), the
    AICS Program ensures that marginalized, vulnerable, and low-income
    residents receive timely assistance to alleviate distress, meet basic
    needs, and pave the way toward long-term stability.
  </div>
  <!-- Brief Description end-->
  <!-- Annex Start -->
  <div class="annex">
    <img src="./assets/img/Annex.png" alt="Annex" class="annex-image" />
  </div>
  <!-- Annex Start -->
  <!-- Carousel start -->
  <div class="banner" id="banner">
    <div class="slider" style="--quantity: 7">
      <div class="item" id="item1" style="--position: 1" onclick="showDescription(1)">
        <img src="./assets/img/transportation.png" alt="Transportation" />
      </div>
      <div class="item" id="item2" style="--position: 2" onclick="showDescription(2)">
        <img src="./assets/img/food.png" alt="Food" />
      </div>
      <div class="item" id="item3" style="--position: 3" onclick="showDescription(3)">
        <img src="./assets/img/medical.png" alt="Medical" />
      </div>
      <div class="item" id="item4" style="--position: 4" onclick="showDescription(4)">
        <img src="./assets/img/cash.png" alt="Cash Relief" />
      </div>
      <div class="item" id="item5" style="--position: 5" onclick="showDescription(5)">
        <img src="./assets/img/burial.png" alt="Burial" />
      </div>
      <div class="item" id="item6" style="--position: 6" onclick="showDescription(6)">
        <img src="./assets/img/educational.png" alt="Educational" />
      </div>
      <div class="item" id="item7" style="--position: 7" onclick="showDescription(7)">
        <img src="./assets/img/psychosocial.png" alt="Psychosocial" />
      </div>
      <div class="item" id="item8" style="--position: 8" onclick="showDescription(8)">
        <img src="./assets/img/AICS150.png" alt="AICS LOGO" />
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
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
        8: "The AICS Program is a government initiative that provides immediate assistance to individuals and families facing crises. It aims to alleviate distress, meet basic needs, and promote long-term stability for marginalized and vulnerable residents.",
      };

      const descriptionBox = document.querySelector(".description-box");
      const descriptionText = document.getElementById("description-text");

      descriptionText.textContent = descriptions[position];
      descriptionBox.classList.add("active");
    }
  </script>
  <br />
  <br />
  <!-- new carousel start -->
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
        aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"
        aria-label="Slide 5"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5"
        aria-label="Slide 6"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6"
        aria-label="Slide 7"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./assets/img/transportation.png" alt="Transportation Assistance" />
        <div class="description">
          <h3>Transportation Assistance</h3>
          <ol>
            <li class="text-start">
              Updated Original Certificate of Indigency from Barangay with
              proof of low income
            </li>
            <li class="text-start">
              Medical Certificate referral (for medical transport request)
            </li>
            <li class="text-start">
              Death Certificate or Medical Report of a Relative (for family
              emergency)
            </li>
            <li class="text-start">
              Police Report or legal documents (for cases of abuse,
              transferring or court related cases).
            </li>
            <li class="text-start">
              ID of authorized representative and Authorization Letter
            </li>
            <li class="text-start">ID of patient</li>
            <li class="text-start">
              Proof of Relationship (Birth Certificate, Marriage Certificate)
            </li>
          </ol>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./assets/img/food.png" alt="Food Assistance" />
        <div class="description">
          <h3>Food Assistance</h3>
          <ol>
            <li class="text-start">
              Updated Original Certificate of Indigency from Barangay with
              proof of low income
            </li>
            <li class="text-start">Valid ID (Photocopy)</li>
            <li class="text-start">
              Marriage Certificate or Birth Certificate
            </li>
            <li class="text-start">
              Disaster Certificate (if applicable for calamity affected
              individual)
            </li>
            <li class="text-start">
              Medical Certificate or Referral (if applicable for malnourished
              individual or those with health conditions requiring food aid)
            </li>
          </ol>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./assets/img/medical.png" alt="Medical Assistance" />
        <div class="description">
          <h3>Medical Assistance</h3>
          <ol>
            <li class="text-start">
              Updated Original Certificate of Indigency from Barangay with
              proof of low income
            </li>
            <li class="text-start">
              Original or Certified True Copy of Latest Medical Certificate or
              Clinical Abstract
            </li>
            <li class="text-start">
              Hospital Billing Statement for Hospitalization or procedure
            </li>
            <li class="text-start">
              Pharmacy Quotation for required medications.
            </li>
            <li class="text-start">
              Laboratory/ Diagnostic request for test and imaging
            </li>
            <li class="text-start">Original Official Receipts</li>
            <li class="text-start">
              Original or Certified True Copy of Certification of outstanding
              debts or Payable Obligations
            </li>
            <li class="text-start">
              ID of authorized representative and Authorization Letter
            </li>
            <li class="text-start">ID of patient</li>
            <li class="text-start">
              Proof of Relationship (Birth Certificate, Marriage Certificate)
            </li>
          </ol>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./assets/img/cash.png" alt="Cash Relief Assistance" />
        <div class="description">
          <h3>Cash Relief Assistance</h3>
          <ol>
            <li class="text-start">
              Updated Original Certificate of Indigency from Barangay with
              proof of low income
            </li>
            <li class="text-start">Valid ID (Photocopy)</li>
            <li class="text-start">
              Marriage Certificate or Birth Certificate
            </li>
            <li class="text-start">
              Incident Report from BFP, LGU or disaster response agency.
            </li>
            <li class="text-start">
              Medical Certificate (if the applicant or a family member was
              injured in the disaster)
            </li>
          </ol>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./assets/img/burial.png" alt="Burial Assistance" />
        <div class="description">
          <h3>Burial Assistance</h3>
          <ol>
            <li class="text-start">
              Updated Original Certificate of Indigency from Barangay proving
              financial incapacity
            </li>
            <li class="text-start">Death Certificate</li>
            <li class="text-start">Funeral Contract</li>
            <li class="text-start">
              Original or certified true copy of Official Receipt
            </li>
            <li class="text-start">ID of Authorized Representative</li>
            <li class="text-start">ID of expired person</li>
            <li class="text-start">
              Proof of Relationship (Birth Certificate) Photocopy
            </li>
            <li class="text-start">
              Marriage Contract and Authorization Letter
            </li>
            <li class="text-start">
              Certification of Outstanding Debts or Payable Obligations
              (Original or Certified True Copy)
            </li>
          </ol>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./assets/img/educational.png" alt="Educational Assistance" />
        <div class="description">
          <h3>Educational Assistance</h3>
          <ol>
            <li class="text-start">
              Updated Original Certificate of Indigency from Barangay proving
              financial incapacity
            </li>
            <li class="text-start">
              Certified True Copy of Enrollment Assessment Form or Certificate
              of Enrollment
            </li>
            <li class="text-start">
              School ID of the student/ Beneficiary (Photocopy)
            </li>
            <li class="text-start">
              Certified True Copy of Grades signed by the authorized personnel
            </li>
            <li class="text-start">
              Medical Certificate (if applicable for HIV and other health
              related cases)
            </li>
            <li class="text-start">
              Police Report/ Social Worker’s Assessment (for abuse and
              displacement cases)
            </li>
          </ol>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./assets/img/psychosocial.png" alt="Psychosocial Support" />
        <div class="description">
          <h3>Psychosocial Support</h3>
          <ol>
            <li class="text-start">
              Updated Original Certificate of Indigency from Barangay with
              proof of low income
            </li>
            <li class="text-start">Valid ID (Photocopy)</li>
            <li class="text-start">
              Marriage Certificate or Birth Certificate
            </li>
            <li class="text-start">
              Referral Letter from Social Worker, Barangay Officer, or Mental
              Health Professional
            </li>
            <li class="text-start">
              Medical or Psychological Report (if applicable, for cases
              related to diagnosed mental health conditions)
            </li>
            <li class="text-start">
              Police or Legal Report (if applicable, for cases involving
              abuse, violence, or exploitation)
            </li>
            <li class="text-start">
              Original or Certified True Copy of Certification of outstanding
              debts or Payable Obligations
            </li>
          </ol>
        </div>
      </div>
      <!-- Add more carousel items as needed -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- new carousel end -->

  <!-- feed start -->
  <form method="POST" action="Functions/PHP/feedbackInsert.php" id="fF">
    <div class="feedback-container">
      <div class="feedback-form">
        <div class="form-left">
          <h2>Feedback</h2>
          <textarea class="feedback-textarea" rows="10" cols="70" placeholder="Write your Feedback here"
            style="color: rgb(17, 17, 17)" required id="fM" name="message" minlength="10" maxlength="1000"></textarea>
        </div>

        <div class="form-right">
          <h2>Rate Us</h2>
          <input type="hidden" id="rating-value" name="rating" value="0">
          <div class="stars">
            <span class="star" data-rating="1" style="height: 50px; width: 50px">★</span>
            <span class="star" data-rating="2" style="height: 50px; width: 50px">★</span>
            <span class="star" data-rating="3" style="height: 50px; width: 50px">★</span>
            <span class="star" data-rating="4" style="height: 50px; width: 50px">★</span>
            <span class="star" data-rating="5" style="height: 50px; width: 50px">★</span>
          </div>

          <div class="input-container" style="background-color: #0066cc">
            <input type="email" class="form-input" id="email" placeholder="" required
              style="background-color: #0066cc; color: #ffffff;" minlength="3" maxlength="50" name="email">
            <label for="username" style="color: #ffffff">Email</label>
          </div>
          <div class="input-container" style="background-color: #0066cc">
            <input type="text" class="form-input" id="name" placeholder="" required
              style="background-color: #0066cc; color: #ffffff;" minlength="3" maxlength="50" name="name">
            <label for="username" style="color: #ffffff">Name</label>
          </div>
          <input type="hidden" name="feedback">
          <button type="submit" class="submit-btn">Submit</button>
        </div>
      </div>
    </div>
  </form>

  <script>
    const stars = document.querySelectorAll(".star");
    const ratingValue = document.getElementById("rating-value");

    stars.forEach((star) => {
      star.addEventListener("click", () => {
        const rating = star.getAttribute("data-rating");
        ratingValue.value = rating;

        // Update visual appearance
        stars.forEach((s) => {
          const starRating = s.getAttribute("data-rating");
          if (starRating <= rating) {
            s.classList.add("active");
          } else {
            ratingValue.value.remove();
            s.classList.remove("active");
          }
        });
      });
    });

    // Reset stars when clicking below 1
    document.querySelector(".stars").addEventListener("click", (e) => {
      if (!e.target.classList.contains("star")) {
        stars.forEach((s) => s.classList.remove("active"));
        ratingValue.value = 0;
      }
    });

    const feedForm = document.getElementById('fF');

    feedForm.addEventListener("submit", function (event) {
      const email = document.getElementById('email').value.trim();
      const name = document.getElementById('name').value.trim();
      const fM = document.getElementById('fM').value.trim();

      const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

      if (ratingValue.value <= 0) {
        alert('Please give a rating before submitting feedback.');
        event.preventDefault();
      } else if (fM === '') {
        alert('Feedback must not be empty!');
        event.preventDefault();
        fM.focus();
      } else if (email === '') {
        alert('Email is required!');
        event.preventDefault();
        email.focus();
      } else if (email.length > 50) {
        alert('Email cannot be longer than 50 characters');
        event.preventDefault();
        email.focus();
      } else if (!emailRegex.test(email)) {
        alert('Invalid Email!');
        event.preventDefault();
        email.focus();
      } else if (name === '') {
        alert('Name is required!');
        event.preventDefault();
        name.focus();
      } else if (name.length > 50) {
        alert('Name cannot be longer than 50 characters');
        event.preventDefault();
        name.focus();
      }
    });
  </script>
  <br style="height: 10px" />
  <!--==================== FOOTER AREA ====================-->
  <footer class="footer-container">
    <div class="footer-grid">
      <div class="footer-section">
        <h2>VISIT US</h2>
        <p>D. Fandiño Street, Poblacion 3, Alaminos, Laguna</p>
        <div class="map-container">
          <!-- Map placeholder -  map embed -->
          <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
            <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div>
            <script>
              (function () {
                var setting = {
                  query: "Alaminos Laguna, Alaminos, Laguna, Philippines",
                  width: 400,
                  height: 200,
                  satellite: true,
                  zoom: 12,
                  placeId: "ChIJKQ0PkhFovTMRfhLklyI_di8",
                  cid: "0x2f763f2297e4127e",
                  coords: [14.0651171, 121.2462164],
                  cityUrl: "/philippines/tagaytay-city-33123",
                  cityAnchorText:
                    "Map of Tagaytay City, Calabarzon, Philippines",
                  lang: "us",
                  queryString:
                    "Alaminos Laguna, Alaminos, Laguna, Philippines",
                  centerCoord: [14.0651171, 121.2462164],
                  id: "map-9cd199b9cc5410cd3b1ad21cab2e54d3",
                  embed_id: "1214998",
                };
                var d = document;
                var s = d.createElement("script");
                s.src =
                  "https://1map.com/js/script-for-user.js?embed_id=1214998";
                s.async = true;
                s.onload = function (e) {
                  window.OneMap.initMap(setting);
                };
                var to = d.getElementsByTagName("script")[0];
                to.parentNode.insertBefore(s, to);
              })();
            </script>
          </div>
        </div>

        <!-- Logo images added here -->
        <div class="logo-container">
          <img src="./assets/img/AICS150.png" alt="Logo 1" class="logo-image" />
          <img src="./assets/img/Alam150.png" alt="Logo 2" class="logo-image" />
        </div>
      </div>

      <div class="footer-section">
        <h2>ABOUT US</h2>
        <p>
          Alaminos, officially the
          <strong>Municipality of Alaminos</strong> (Tagalog:
          <em>Bayan ng Alaminos</em>), is a 1st class municipality in the
          province of Laguna, Philippines.
        </p>
        <p>
          According to the 2020 census, it has a population of 51,619 people.
        </p>

        <table class="info-table">
          <tr>
            <th>Country</th>
            <td>Philippines</td>
          </tr>
          <tr>
            <th>Province</th>
            <td>Laguna</td>
          </tr>
          <tr>
            <th>Elevation</th>
            <td>121 m (397 ft)</td>
          </tr>
          <tr>
            <th>Founded</th>
            <td>1873</td>
          </tr>
          <tr>
            <th>Lowest elevation</th>
            <td>59 m (194 ft)</td>
          </tr>
          <tr>
            <th>Region</th>
            <td>Calabarzon</td>
          </tr>
          <tr>
            <th>Highest elevation</th>
            <td>543 m (1,781 ft)</td>
          </tr>
          <tr>
            <th>District</th>
            <td>3rd district</td>
          </tr>
        </table>
      </div>

      <div class="footer-section">
        <h2>GOVERNMENT LINKS</h2>
        <a href="https://www.gov.ph/">About Gov PH</a>
        <a href="https://pbbm.com.ph/">The President</a>
        <a href="https://op-proper.gov.ph/">Office of the President</a>
        <a href="https://www.ovp.gov.ph/">Office of the Vice President</a>
        <a href="https://legacy.senate.gov.ph/">Senate of the Philippines</a>
        <a href="https://www.congress.gov.ph/">House of Representatives</a>
        <a href="https://alaminoslaguna.com/">Alaminos, Laguna</a>
      </div>
    </div>

    <div class="copyright">© 2025 Alaminos Laguna All Rights Reserved.</div>
  </footer>
  <!-- Footer Section end-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>