<?php if (isset($_SESSION['Family_ID']) && !empty($_SESSION['Family_ID'])) { ?>
    <form method="POST" action="Functions/PHP/addFMInsert.php">
        <div class="container">
            <h2>Kindly add your family members to your profile so you can apply for assistance</h2>

            <div class="form-container" style="padding-bottom: 0;">
                <div style="display: flex; justify-content: end;">
                    <a href="profile.php" class="close">x</a>
                </div>

                <div class="form-section">
                    <div class="form-header">Family Composition</div>

                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" pattern="^(0|[1-9]|1[0-9]|20)$" title="Enter a number between 0 and 20"
                                placeholder="Number of Family Members" id="fMC">
                        </div>
                    </div>

                    <div id="allMembers"></div>

                    <input type="hidden" id="count" name="count">

                    <div class="add-member" style="display: flex;justify-content: end">
                        <button type="button" id="rM" style="display: none; margin-right: .5em;">Remove Member</button>
                        <button type="button" id="aM">Add Member</button>
                    </div>

                    <div class="add-member">
                        <input type="hidden" name="addFamilyMember">
                        <button type="submit" style="font-size: 20px; padding: .5em;">Set Profile</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
<?php } else { ?>
    <form method="POST" action="Functions/PHP/setProfileInsert.php">
        <div class="container">
            <h2>Kindly Complete your profile so you can apply for assistance</h2>

            <div class="form-container" style="padding-bottom: 0;">
                <div style="display: flex; justify-content: end;">
                    <a href="profile.php" class="close">x</a>
                </div>
                <div class="form-section">
                    <div class="form-header">Family Information</div>

                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" placeholder="Family Name" minlength="3" maxlength="50" name="fN" required>
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
                            <input type="text" placeholder="House No." pattern="^\d+$" title="Numbers only." minlength="1"
                                maxlength="4" name="hN" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Street" minlength="3" maxlength="50" name="s" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Barangay" minlength="3" maxlength="50" name="b" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="City of Municipality" minlength="3" maxlength="50" name="c" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Province" minlength="3" maxlength="50" name="p" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" placeholder="Region" minlength="3" maxlength="50" name="r" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Zip Code" pattern="^\d+$" title="Numbers only." minlength="1"
                                maxlength="5" name="zC" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-header">Family Composition <i style="color:rgb(85, 81, 81);">Can be set later</i></div>

                    <div id="allMembers"></div>

                    <input type="hidden" id="count" name="count">

                    <div class="add-member" style="display: flex;justify-content: end">
                        <button type="button" id="rM" style="display: none; margin-right: .5em;">Remove Member</button>
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
<?php } ?>