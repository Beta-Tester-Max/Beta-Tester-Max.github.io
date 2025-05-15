<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Completion Form</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/AICS150.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/form.css" />

    <style>
        input[type="date"] {
            background-color: #000033;
            color:rgba(255, 255, 255, 0.46);
            border: 1px solid #ffffff;
            padding-left: 2.5em;
            padding-right: 1.5em;
            height: 1.8em;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            background-color: white;
            border-radius: 4px;
            padding: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <form method="POST" action="Functions/PHP/setProfileInsert.php">
        <div class="container">
            <h2>Kindly Complete your profile so you can apply for assistance</h2>

            <div class="form-container" style="padding-bottom: 0;">
                <div class="form-section">
                    <div class="form-header">Family Information</div>

                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" placeholder="Family Name" name="fN" required>
                        </div>
                        <div class="form-group">
                            <input type="text" pattern="^(0|[1-9]|1[0-9]|20)$" title="Enter a number between 0 and 20"
                                placeholder="Number of Family Members" id="fMC">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-header">Address</div>

                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" placeholder="House No." name="hN" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Street" name="s" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Barangay" name="b" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="City" name="c" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Province" name="p" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" placeholder="Region" name="r" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Zip Code" name="zC" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-header">Family Composition</div>

                    <div id="allMembers"></div>

                    <input type="hidden" id="count" name="count">

                    <div class="add-member" style="display: flex;justify-content: end">
                        <button type="button" id="aM">Add Member</button>
                    </div>

                    <div class="add-member">
                        <input type="hidden" name="setProfile">
                        <button type="submit" style="font-size: 20px; padding: .5em;">Set Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="Functions/JS/setProfileScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>

</html>