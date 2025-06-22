document.getElementById("removeMember").addEventListener("click", function () {
    const fMC = document.getElementById("familyMember");
    let currentValue = parseInt(fMC.value) || 0;

    if (currentValue > 0) {
        fMC.value = currentValue - 1;
        fMC.dispatchEvent(new Event('input'));
    }
});

document.getElementById("addMember").addEventListener("click", function () {
    const fMC = document.getElementById("familyMember");
    let currentValue = parseInt(fMC.value) || 0;

    if (currentValue < 20) {
        fMC.value = currentValue + 1;
        fMC.dispatchEvent(new Event('input'));
    }
});

document.getElementById("familyMember").addEventListener("input", function () {
    const aM = document.getElementById("addMember");
    const rM = document.getElementById("removeMember");
    const allMembersDiv = document.getElementById("allMembers");
    const count = document.getElementById("count");

    let newCount = parseInt(this.value);
    if (isNaN(newCount) || newCount < 0) newCount = 0;
    if (newCount >= 20) {
        newCount = 20;
        alert("Number Limit Reached! Limit: 20");
        aM.style.display = "none";
        rM.style.display = "";
        this.value = "20";
    } else if (newCount === 0) {
        aM.style.display = "";
        rM.style.display = "none";
        this.value = "";
    } else {
        aM.style.display = "";
        rM.style.display = "";
    }

    const currentCount = allMembersDiv.children.length;
    count.value = newCount;

    for (let i = currentCount + 1; i <= newCount; i++) {
        const memberHTML = document.createElement("div");

        const relationClone = document.getElementById("templateRelation").cloneNode(true);
        relationClone.id = `relation${i}`;
        relationClone.name = `relation${i}`;
        relationClone.classList.remove("d-none");
        relationClone.required = true;

        const sxClone = document.getElementById("templateSex").cloneNode(true);
        sxClone.id = `sx${i}`;
        sxClone.name = `sx${i}`;
        sxClone.classList.remove("d-none");
        sxClone.required = true;

        const civStatClone = document.getElementById("templateCivStat").cloneNode(true);
        civStatClone.id = `civStat${i}`;
        civStatClone.name = `civStat${i}`;
        civStatClone.classList.remove("d-none");
        civStatClone.required = true;

        const educAttClone = document.getElementById("templateEducAtt").cloneNode(true);
        educAttClone.id = `educAtt${i}`;
        educAttClone.name = `educAtt${i}`;
        educAttClone.classList.remove("d-none");

        const makeFloatingWrapper = (clone, labelText, id, showAsterisk = true) => {
            const wrapper = document.createElement("div");
            wrapper.className = "form-floating mb-3";
            clone.classList.add("form-select", "shadow-sm");
            wrapper.appendChild(clone);
            wrapper.innerHTML += `<label for="${id}">${labelText}${showAsterisk ? ' <span class="text-danger">*</span>' : ''}</label>`;
            return wrapper;
        };

        memberHTML.innerHTML = `
        <div class="row">
            <div class="col">
                <h4 class="m-0">Family Member No.${i}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-sm" id="fname${i}" name="fname${i}" minlength="2" maxlength="50" required>
                    <label for="fname${i}">First Name <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-sm" id="mname${i}" name="mname${i}" maxlength="50">
                    <label for="mname${i}">Middle Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-sm" id="lname${i}" name="lname${i}" minlength="2" maxlength="50" required>
                    <label for="lname${i}">Last Name <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="col">
                <div class="relation-wrap"></div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control shadow-sm" id="dob${i}" name="bday${i}" required>
                    <label for="dob${i}">Date of Birth <span class="text-danger">*</span></label>
                </div>
                <div class="sex-wrap"></div>
            </div>
            <div class="col">
                <div class="civStat-wrap"></div>
                <div class="educAtt-wrap"></div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-sm" id="occupation${i}" name="occupation${i}" minlength="2" maxlength="50">
                    <label for="occupation${i}">Occupation</label>
                </div>
            </div>
        </div>
        <hr class="m-0 mb-2">
        `;

        allMembersDiv.appendChild(memberHTML);

        memberHTML.querySelector(".relation-wrap").appendChild(makeFloatingWrapper(relationClone, "Relation", `relation${i}`));
        memberHTML.querySelector(".sex-wrap").appendChild(makeFloatingWrapper(sxClone, "Sex", `sx${i}`));
        memberHTML.querySelector(".civStat-wrap").appendChild(makeFloatingWrapper(civStatClone, "Civil Status", `civStat${i}`));
        memberHTML.querySelector(".educAtt-wrap").appendChild(makeFloatingWrapper(educAttClone, "Educational Attainment", `educAtt${i}`, false));
    }

    while (allMembersDiv.children.length > newCount) {
        allMembersDiv.removeChild(allMembersDiv.lastElementChild);
    }
});
