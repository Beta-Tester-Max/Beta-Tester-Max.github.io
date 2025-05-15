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
  const allMembersDiv = document.getElementById("allMembers");
  const count = document.getElementById("count");

  let newCount = parseInt(this.value);
  if (isNaN(newCount) || newCount < 0) newCount = 0;
  if (newCount > 20) {
    newCount = 20;
    alert("Number Limit Reached! Limit: 20");
    aM.style.display = "none";
  } else {
    aM.style.display = "";
  }

  const currentCount = allMembersDiv.children.length;
  count.value = newCount;

  // Add members if increasing
  for (let i = currentCount + 1; i <= newCount; i++) {
    const memberHTML = document.createElement("div");
    memberHTML.innerHTML = `
      <p>Family Member No. ${i}</p>
      <div class="form-row">
        <div class="form-group">
          <input type="text" placeholder="First Name" name="fN${i}" required>
        </div>
        <div class="form-group">
          <input type="text" placeholder="Middle Name" name="mN${i}">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Last Name" name="lN${i}" required>
        </div>
        <div class="form-group">
          <input type="text" placeholder="Email" name="e${i}">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Phone Number" name="pN${i}">
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
          <input type="text" placeholder="Civil Status" name="cS${i}" required>
        </div>
        <div class="form-group">
          <input type="text" placeholder="Educational Attainment" name="eA${i}">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Occupation" name="o${i}">
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
