<?php include 'connect.php';
session_start();
if (empty($_SESSION['userid'])) { ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign Up</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body class="p-0 m-0 overflow-x-hidden" style="min-width: 50em;">
        <div class="container-fluid">
            <div class="row m-5">
                <div class="col-12">
                    <div class="d-flex flex-column justify-content-center align-items-center m-auto border border-black rounded shadow"
                        style="width: 50em;">
                        <form method="POST" style="width: 100%;">
                            <div class="row m-5">
                                <div class="d-flex justify-content-center align-items-center text-center">
                                    <h3>Registration</h3>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <label for="fname" class="form-label">First Name</label>
                                        <input type="text" maxlength="20" class="form-control"
                                            placeholder="Enter First Name" name="fname" id="fname" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="mname" class="form-label">Middle Name</label>
                                        <input type="text" maxlength="20" class="form-control"
                                            placeholder="Enter Middle Name" name="mname" id="mname">
                                    </div>
                                    <div class="mt-3">
                                        <label for="lname" class="form-label">Last Name</label>
                                        <input type="text" maxlength="20" class="form-control" placeholder="Enter Last Name"
                                            name="lname" id="lname" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" maxlength="25" class="form-control" placeholder="Enter Username"
                                            name="username" id="username" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" placeholder="Enter Password"
                                            name="password" maxlength="15" id="password" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" maxlength="25" class="form-control" placeholder="Enter Email"
                                            name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <label class="mb-1 form-label" for="bday">Date of Birth</label>
                                        <input class="p-2 form-control" type="date" id="bday" name="bday" required>
                                    </div>
                                    <div class="mt-3">
                                        <label>Sex</label>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <input class="me-2" type="radio" name="sex" id="female" value="m" required>
                                            <label class="me-4" for="female" class="form-label">Male</label>
                                            <input class="me-2" type="radio" name="sex" id="male" value="f" required>
                                            <label class="me-0" for="male" class="form-label">Female</label>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="me-4 mb-2" for="phoneno" class="form-label">Phone Number</label>
                                        <div class="d-flex">
                                            <p class="p-1 border border-primary-subtle bg-primary-subtle rounded-start-pill"
                                                style="height: 2em;">+63</p>
                                            <input class="p-2 border border-secondary-subtle rounded-end-pill" type="tel"
                                                placeholder="0XXX-XXX-XXXX"
                                                pattern="0[8-9][0-9]{2}-[0-9]{3}-[0-9]{4}" name="phoneno"
                                                id="phoneno" maxlength="13" style="height: 2em; width: 11em;" required>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="civilStatus" class="form-label">Civil Status</label>
                                        <select class="form-select" name="civilstatus" id="civilStatus" required>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="religion" class="form-label">Religion</label>
                                        <input type="text" maxlength="50" class="form-control" placeholder="Enter Religion"
                                            name="religion" id="religion" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="nationality" class="form-label">Nationality</label>
                                        <select class="form-select" id="nationality" name="nationality" required>
                                            <option value="">Select a Nationality</option>
                                            <option value="afghan">Afghan</option>
                                            <option value="albanian">Albanian</option>
                                            <option value="algerian">Algerian</option>
                                            <option value="american">American</option>
                                            <option value="andorran">Andorran</option>
                                            <option value="angolan">Angolan</option>
                                            <option value="antiguans">Antiguans</option>
                                            <option value="argentinean">Argentinean</option>
                                            <option value="armenian">Armenian</option>
                                            <option value="australian">Australian</option>
                                            <option value="austrian">Austrian</option>
                                            <option value="azerbaijani">Azerbaijani</option>
                                            <option value="bahamian">Bahamian</option>
                                            <option value="bahraini">Bahraini</option>
                                            <option value="bangladeshi">Bangladeshi</option>
                                            <option value="barbadian">Barbadian</option>
                                            <option value="barbudans">Barbudans</option>
                                            <option value="batswana">Batswana</option>
                                            <option value="belarusian">Belarusian</option>
                                            <option value="belgian">Belgian</option>
                                            <option value="belizean">Belizean</option>
                                            <option value="beninese">Beninese</option>
                                            <option value="bhutanese">Bhutanese</option>
                                            <option value="bolivian">Bolivian</option>
                                            <option value="bosnian">Bosnian</option>
                                            <option value="brazilian">Brazilian</option>
                                            <option value="british">British</option>
                                            <option value="bruneian">Bruneian</option>
                                            <option value="bulgarian">Bulgarian</option>
                                            <option value="burkinabe">Burkinabe</option>
                                            <option value="burmese">Burmese</option>
                                            <option value="burundian">Burundian</option>
                                            <option value="cambodian">Cambodian</option>
                                            <option value="cameroonian">Cameroonian</option>
                                            <option value="canadian">Canadian</option>
                                            <option value="cape verdean">Cape Verdean</option>
                                            <option value="central african">Central African</option>
                                            <option value="chadian">Chadian</option>
                                            <option value="chilean">Chilean</option>
                                            <option value="chinese">Chinese</option>
                                            <option value="colombian">Colombian</option>
                                            <option value="comoran">Comoran</option>
                                            <option value="congolese">Congolese</option>
                                            <option value="costa rican">Costa Rican</option>
                                            <option value="croatian">Croatian</option>
                                            <option value="cuban">Cuban</option>
                                            <option value="cypriot">Cypriot</option>
                                            <option value="czech">Czech</option>
                                            <option value="danish">Danish</option>
                                            <option value="djibouti">Djibouti</option>
                                            <option value="dominican">Dominican</option>
                                            <option value="dutch">Dutch</option>
                                            <option value="east timorese">East Timorese</option>
                                            <option value="ecuadorean">Ecuadorean</option>
                                            <option value="egyptian">Egyptian</option>
                                            <option value="emirian">Emirian</option>
                                            <option value="equatorial guinean">Equatorial Guinean</option>
                                            <option value="eritrean">Eritrean</option>
                                            <option value="estonian">Estonian</option>
                                            <option value="ethiopian">Ethiopian</option>
                                            <option value="fijian">Fijian</option>
                                            <option value="filipino">Filipino</option>
                                            <option value="finnish">Finnish</option>
                                            <option value="french">French</option>
                                            <option value="gabonese">Gabonese</option>
                                            <option value="gambian">Gambian</option>
                                            <option value="georgian">Georgian</option>
                                            <option value="german">German</option>
                                            <option value="ghanaian">Ghanaian</option>
                                            <option value="greek">Greek</option>
                                            <option value="grenadian">Grenadian</option>
                                            <option value="guatemalan">Guatemalan</option>
                                            <option value="guinea-bissauan">Guinea-Bissauan</option>
                                            <option value="guinean">Guinean</option>
                                            <option value="guyanese">Guyanese</option>
                                            <option value="haitian">Haitian</option>
                                            <option value="herzegovinian">Herzegovinian</option>
                                            <option value="honduran">Honduran</option>
                                            <option value="hungarian">Hungarian</option>
                                            <option value="icelander">Icelander</option>
                                            <option value="indian">Indian</option>
                                            <option value="indonesian">Indonesian</option>
                                            <option value="iranian">Iranian</option>
                                            <option value="iraqi">Iraqi</option>
                                            <option value="irish">Irish</option>
                                            <option value="israeli">Israeli</option>
                                            <option value="italian">Italian</option>
                                            <option value="ivorian">Ivorian</option>
                                            <option value="jamaican">Jamaican</option>
                                            <option value="japanese">Japanese</option>
                                            <option value="jordanian">Jordanian</option>
                                            <option value="kazakhstani">Kazakhstani</option>
                                            <option value="kenyan">Kenyan</option>
                                            <option value="kittian and nevisian">Kittian and Nevisian</option>
                                            <option value="kuwaiti">Kuwaiti</option>
                                            <option value="kyrgyz">Kyrgyz</option>
                                            <option value="laotian">Laotian</option>
                                            <option value="latvian">Latvian</option>
                                            <option value="lebanese">Lebanese</option>
                                            <option value="liberian">Liberian</option>
                                            <option value="libyan">Libyan</option>
                                            <option value="liechtensteiner">Liechtensteiner</option>
                                            <option value="lithuanian">Lithuanian</option>
                                            <option value="luxembourger">Luxembourger</option>
                                            <option value="macedonian">Macedonian</option>
                                            <option value="malagasy">Malagasy</option>
                                            <option value="malawian">Malawian</option>
                                            <option value="malaysian">Malaysian</option>
                                            <option value="maldivan">Maldivan</option>
                                            <option value="malian">Malian</option>
                                            <option value="maltese">Maltese</option>
                                            <option value="marshallese">Marshallese</option>
                                            <option value="mauritanian">Mauritanian</option>
                                            <option value="mauritian">Mauritian</option>
                                            <option value="mexican">Mexican</option>
                                            <option value="micronesian">Micronesian</option>
                                            <option value="moldovan">Moldovan</option>
                                            <option value="monacan">Monacan</option>
                                            <option value="mongolian">Mongolian</option>
                                            <option value="moroccan">Moroccan</option>
                                            <option value="mosotho">Mosotho</option>
                                            <option value="motswana">Motswana</option>
                                            <option value="mozambican">Mozambican</option>
                                            <option value="namibian">Namibian</option>
                                            <option value="nauruan">Nauruan</option>
                                            <option value="nepalese">Nepalese</option>
                                            <option value="new zealander">New Zealander</option>
                                            <option value="ni-vanuatu">Ni-Vanuatu</option>
                                            <option value="nicaraguan">Nicaraguan</option>
                                            <option value="nigerien">Nigerien</option>
                                            <option value="north korean">North Korean</option>
                                            <option value="northern irish">Northern Irish</option>
                                            <option value="norwegian">Norwegian</option>
                                            <option value="omani">Omani</option>
                                            <option value="pakistani">Pakistani</option>
                                            <option value="palauan">Palauan</option>
                                            <option value="panamanian">Panamanian</option>
                                            <option value="papua new guinean">Papua New Guinean</option>
                                            <option value="paraguayan">Paraguayan</option>
                                            <option value="peruvian">Peruvian</option>
                                            <option value="polish">Polish</option>
                                            <option value="portuguese">Portuguese</option>
                                            <option value="qatari">Qatari</option>
                                            <option value="romanian">Romanian</option>
                                            <option value="russian">Russian</option>
                                            <option value="rwandan">Rwandan</option>
                                            <option value="saint lucian">Saint Lucian</option>
                                            <option value="salvadoran">Salvadoran</option>
                                            <option value="samoan">Samoan</option>
                                            <option value="san marinese">San Marinese</option>
                                            <option value="sao tomean">Sao Tomean</option>
                                            <option value="saudi">Saudi</option>
                                            <option value="scottish">Scottish</option>
                                            <option value="senegalese">Senegalese</option>
                                            <option value="serbian">Serbian</option>
                                            <option value="seychellois">Seychellois</option>
                                            <option value="sierra leonean">Sierra Leonean</option>
                                            <option value="singaporean">Singaporean</option>
                                            <option value="slovakian">Slovakian</option>
                                            <option value="slovenian">Slovenian</option>
                                            <option value="solomon islander">Solomon Islander</option>
                                            <option value="somali">Somali</option>
                                            <option value="south african">South African</option>
                                            <option value="south korean">South Korean</option>
                                            <option value="spanish">Spanish</option>
                                            <option value="sri lankan">Sri Lankan</option>
                                            <option value="sudanese">Sudanese</option>
                                            <option value="surinamer">Surinamer</option>
                                            <option value="swazi">Swazi</option>
                                            <option value="swedish">Swedish</option>
                                            <option value="swiss">Swiss</option>
                                            <option value="syrian">Syrian</option>
                                            <option value="taiwanese">Taiwanese</option>
                                            <option value="tajik">Tajik</option>
                                            <option value="tanzanian">Tanzanian</option>
                                            <option value="thai">Thai</option>
                                            <option value="togolese">Togolese</option>
                                            <option value="tongan">Tongan</option>
                                            <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                            <option value="tunisian">Tunisian</option>
                                            <option value="turkish">Turkish</option>
                                            <option value="tuvaluan">Tuvaluan</option>
                                            <option value="ugandan">Ugandan</option>
                                            <option value="ukrainian">Ukrainian</option>
                                            <option value="uruguayan">Uruguayan</option>
                                            <option value="uzbekistani">Uzbekistani</option>
                                            <option value="venezuelan">Venezuelan</option>
                                            <option value="vietnamese">Vietnamese</option>
                                            <option value="welsh">Welsh</option>
                                            <option value="yemenite">Yemenite</option>
                                            <option value="zambian">Zambian</option>
                                            <option value="zimbabwean">Zimbabwean</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <label for="streetAddress" class="form-label">Street Address</label>
                                        <input type="text" maxlength="50" class="form-control"
                                            placeholder="Enter Street Address" name="streetaddress" id="streetAddress"
                                            required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="barangay" class="form-label">Barangay</label>
                                        <input type="text" maxlength="25" class="form-control" placeholder="Enter Barangay"
                                            name="barangay" id="barangay" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="ciormuni" class="form-label">City or Municipality</label>
                                        <input type="text" maxlength="25" class="form-control"
                                            placeholder="Enter City/Municipality" name="cityormunicipality" id="ciormuni"
                                            required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="province" class="form-label">Province</label>
                                        <input type="text" maxlength="25" class="form-control" placeholder="Enter Province"
                                            name="province" id="province" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="region" class="form-label">Region</label>
                                        <input type="text" maxlength="25" class="form-control" placeholder="Enter Region"
                                            name="region" id="region" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="zipCode" class="form-label">Zip Code</label>
                                        <input type="number" class="form-control" min="1" max="99999" name="zipcode"
                                            id="zipCode" placeholder="Enter Zip Code" required>
                                    </div>
                                </div>
                                <div class="mt-5 justify-content-center align-items-center d-flex">
                                    <button type="submit" name="registerForm" class="btn btn-primary">Submit</button>
                                </div>
                                <p class="mt-3 justify-content-center align-items-center d-flex">Go to&nbsp;<a
                                        href="login.php">login</a>&nbsp;or&nbsp;<a href="index.php">homepage</a></p>
                            </div>
                        </form>
                        <?php if (isset($_POST['registerForm'])) {
                            $fname = ucwords(strtolower($_POST['fname']));
                            $mname = ucwords(strtolower($_POST['mname'])) ?: "";
                            $lname = ucwords(strtolower($_POST['lname']));
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $bday = $_POST['bday'];
                            $password = $_POST['password'];
                            $sex = ucwords(strtolower($_POST['sex']));
                            $phoneno = $_POST['phoneno'];
                            $civilstatus = $_POST['civilstatus'];
                            $religion = ucwords(strtolower($_POST['religion']));
                            $nationality = $_POST['nationality'];
                            $streetaddress = ucwords(strtolower($_POST['streetaddress']));
                            $barangay = ucwords(strtolower($_POST['barangay']));
                            $cityormuni = ucwords(strtolower($_POST['cityormunicipality']));
                            $province = ucwords(strtolower($_POST['province']));
                            $region = $_POST['region'];
                            $zipcode = $_POST['zipcode'];

                            $sql = "SELECT * FROM register_tbl where username = '$username'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) == 0) {
                                $sql = "INSERT INTO register_tbl (Username, Email, Password)
                                VALUES ('$username', '$email', '$password')";
                                if (mysqli_query($conn, $sql)) {
                                    $sql = "SELECT User_ID From register_tbl where Username = '$username'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($row = mysqli_fetch_assoc($result)) {
                                        $userid = $row['User_ID'];
                                        $sql = "INSERT INTO userinfo_tbl (User_ID, Fname, Mname, Lname, Birth_Date, Sex, Contact_Number, Civil_Status, Religion, Nationality)
                                        VALUES ('$userid', '$fname', '$mname', '$lname', '$bday', '$sex', '$phoneno', '$civilstatus', '$religion', '$nationality')";
                                        if (mysqli_query($conn, $sql)) {
                                            $sql = "INSERT INTO address_tbl (User_ID, Street_Address, Barangay, CityorMunicipality, Province, Region, Zip_Code)
                                                    VALUES ('$userid', '$streetaddress', '$barangay', '$cityormuni', '$province', '$region', '$zipcode')";
                                            if (mysqli_query($conn, $sql)) {
                                                $_SESSION['userid'] = $userid ?>
                                                <script>window.location.href = "index.php"</script><?php }
                                        }
                                    }
                                }
                            } else { ?>
                                <p class="text-danger justify-content-center align-items-center d-flex">Username Already Exists.</p><?php
                            }
                        }
                        $conn->close() ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else { ?>
    <script>window.location.href = 'index.php'</script><?php }