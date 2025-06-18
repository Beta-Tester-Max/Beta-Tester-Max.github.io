document.getElementById("hFMN").addEventListener("input", function () {
  let potNumMembers = parseInt(this.value);
  let allMembersDiv = document.getElementById("allMembers");
  let count =  document.getElementById('count');
  let memberHTML = "";

  if (potNumMembers > 20) {
    numMembers = 20;
  } else if (potNumMembers <= 20) {
    numMembers = potNumMembers;
  } else {
    numMembers = 0;
  }

  count.value = numMembers;

  allMembersDiv.innerHTML = "";

  for (let i = 1; i <= numMembers; i++) {
    memberHTML += `
                <div class="member">
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <label for="firstName${i}"><b>First Name: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="firstName${i}" name="firstName${i}" required>
                        </div>
                        <div class="col-md-auto">
                            <label for="middleName${i}"><b>Middle Name: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="middleName${i}" name="middleName${i}">
                        </div>
                        <div class="col-md-auto">
                            <label for="lastName${i}"><b>Last Name: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="lastName${i}" name="lastName${i}" required>
                        </div>
                        <div class="col-md-auto">
                            <label for="email${i}"><b>Email:</b></label><br>
                            <input type="email" id="email${i}" name="email${i}">
                        </div>
                        <div class="col-md-auto">
                            <label for="phoneNumber${i}"><b>Phone Number:</b></label><br>
                            <input type="text" id="phoneNumber${i}" name="phoneNumber${i}">
                        </div>
                    </div>

                    <br>

                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <label for="birthday${i}"><b>Birthday: <span class="text-danger">*</span></b></label><br>
                            <input type="date" id="birthday${i}" name="birthday${i}" required>
                        </div>
                        <div class="col-md-auto">
                            <p class="text-center m-0"><b>Sex: <span class="text-danger">*</span></b></p>
                            <div class="d-flex justify-content-center align-items-center">
                                <label for="r1${i}" class="me-1">Male</label>
                                <input class="me-3" type="radio" value="Male" id="r1${i}" name="sex${i}" required>
                                <label for="r2${i}" class="me-1">Female</label>
                                <input type="radio" value="Female" id="r2${i}" name="sex${i}" required>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <label for="civilStatus${i}"><b>Civil Status: <span class="text-danger">*</span></b></label><br>
                            <input type="text" id="civilStatus${i}" name="civilStatus${i}" required>
                        </div>
                        <div class="col-md-auto">
                            <label for="educAtt${i}"><b>Educational Attainment:</b></label><br>
                            <input type="text" id="educAtt${i}" name="educAtt${i}">
                        </div>
                        <div class="col-md-auto">
                            <label for="occupation${i}"><b>Occupation:</b></label><br>
                            <input type="text" id="occupation${i}" name="occupation${i}">
                        </div>
                    </div>

                    <br>

                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <p class="text-center m-0"><b>Is This Person Deceased?</b></p>
                            <div class="d-flex justify-content-center align-items-center">
                                <label for="r3${i}" class="me-1">Yes</label>
                                <input class="me-3" type="radio" value="1" id="r3${i}" name="isDeceased${i}">
                                <label for="r4${i}" class="me-1">No</label>
                                <input type="radio" value="0" id="r4${i}" name="isDeceased${i}">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            `;
  }

  allMembersDiv.innerHTML = memberHTML;
});
