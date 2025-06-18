document.getElementById("rM").addEventListener("click", function () {
    const fMC = document.getElementById("fMC");
    let currentValue = parseInt(fMC.value) || 0;

    if (currentValue > 0) {
        fMC.value = currentValue - 1;
        fMC.dispatchEvent(new Event('input'));
    }
});

document.getElementById("aM").addEventListener("click", function () {
    const fMC = document.getElementById("fMC");
    let currentValue = parseInt(fMC.value) || 0;

    if (currentValue < 20) {
        fMC.value = currentValue + 1;

        fMC.dispatchEvent(new Event('input'));
    }
});

document.getElementById("fMC").addEventListener("input", function () {
  const aM = document.getElementById("aM");
  const rM = document.getElementById("rM");
  const allMembersDiv = document.getElementById("allMembers");
  const count = document.getElementById("count");

  let newCount = parseInt(this.value);
  if (isNaN(newCount) || newCount < 0) newCount = 0;
  if (newCount >= 20) {
    newCount = 20;
    alert("Number Limit Reached! Limit: 20");
    aM.style.display = "none";
    rM.style.display = "";
  } else if (newCount == 0) {
    aM.style.display = "";
    rM.style.display = "none";
  } else {
    aM.style.display = "";
    rM.style.display = "";
  }

  const currentCount = allMembersDiv.children.length;
  count.value = newCount;

  for (let i = currentCount + 1; i <= newCount; i++) {
    const memberHTML = document.createElement("div");
    memberHTML.innerHTML = `
      <p>Family Member No. ${i}</p>
      <div class="form-row">
        <div class="form-group">
          <input type="text" placeholder="First Name" minlength="2" maxlength="50" name="fN${i}" required>
        </div>
        <div class="form-group">
          <input type="text" placeholder="Complete Middle Name" minlength="3" maxlength="50" name="mN${i}">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Last Name" minlength="2" maxlength="50" name="lN${i}" required>
        </div>
        <div class="form-group">
          <input type="text" placeholder="Email" minlength="3" maxlength="50" name="e${i}">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Phone No. 0XXX-XXX-XXXX" pattern="^0[89][1-9]{2}-[1-9]{3}-[1-9]{4}$" title="Please follow the proper format:
          0XXX-XXX-XXXX, First Number must be 0, Second Number must be either 8 or 9" minlength="13" maxlength="13" name="pN${i}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group" style="margin-bottom: 1em;">
          <input type="date" placeholder="Birth Day" name="bD${i}" required>
        </div>
        <div class="form-group" style="margin-bottom: 1em;">
          <select name="s${i}" required>
            <option value="" selected>Select Sex</option>
            <option value="m">Male</option>
            <option value="f">Female</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" placeholder="Civil Status" minlength="3" maxlength="50" name="cS${i}" required>
        </div>
        <div class="form-group">
          <input type="text" placeholder="Educational Attainment" minlength="3" maxlength="50" name="eA${i}">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Occupation" minlength="3" maxlength="50" name="o${i}">
        </div>
        <div class="form-group" style="margin-bottom: 1em;">
          <select name="iD${i}">
            <option value="" selected>Deceased?</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>
      </div>
      <hr>
    `;
    allMembersDiv.appendChild(memberHTML);
  }

  while (allMembersDiv.children.length > newCount) {
    allMembersDiv.removeChild(allMembersDiv.lastElementChild);
  }
});
