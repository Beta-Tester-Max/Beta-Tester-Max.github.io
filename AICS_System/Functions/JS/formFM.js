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

        [
            'fname' + i,
            'mname' + i,
            'lname' + i,
            'dob' + i,
            'occupation' + i
        ].forEach(function(fieldId) {
            var field = memberHTML.querySelector('#' + fieldId);
            if (field) field.addEventListener('input', updateFamilyTableWord);
        });
        ['relation' + i, 'sx' + i, 'civStat' + i, 'educAtt' + i].forEach(function(fieldId) {
            var field = memberHTML.querySelector('#' + fieldId);
            if (field) field.addEventListener('change', updateFamilyTableWord);
        });
    }
    while (allMembersDiv.children.length > newCount) {
        allMembersDiv.removeChild(allMembersDiv.lastElementChild);
    }
    setTimeout(updateFamilyTableWord, 0);
});

function updateFamilyTableWord() {
    var allMembersDiv = document.getElementById("allMembers");
    var tableBody = document.getElementById("familyTableWordBody");
    tableBody.innerHTML = "";
    for (var i = 0; i < allMembersDiv.children.length; i++) {
        var memberDiv = allMembersDiv.children[i];
        var fname = memberDiv.querySelector('#fname' + (i+1));
        fname = fname ? fname.value : "";
        var mname = memberDiv.querySelector('#mname' + (i+1));
        mname = mname ? mname.value : "";
        var lname = memberDiv.querySelector('#lname' + (i+1));
        lname = lname ? lname.value : "";
        var relationSel = memberDiv.querySelector('#relation' + (i+1));
        var relation = (relationSel && relationSel.value && relationSel.selectedOptions[0] && relationSel.selectedOptions[0].text !== '--Select--') ? relationSel.selectedOptions[0].text : "";
        var dob = memberDiv.querySelector('#dob' + (i+1));
        dob = dob ? dob.value : "";
        var sxSel = memberDiv.querySelector('#sx' + (i+1));
        var sx = (sxSel && sxSel.value && sxSel.selectedOptions[0] && sxSel.selectedOptions[0].text !== '--Select--') ? sxSel.selectedOptions[0].text : "";
        var civSel = memberDiv.querySelector('#civStat' + (i+1));
        var civStat = (civSel && civSel.value && civSel.selectedOptions[0] && civSel.selectedOptions[0].text !== '--Select--') ? civSel.selectedOptions[0].text : "";
        var eduSel = memberDiv.querySelector('#educAtt' + (i+1));
        var educAtt = (eduSel && eduSel.selectedIndex > 0) ? eduSel.options[eduSel.selectedIndex].text : "";
        var occupation = memberDiv.querySelector('#occupation' + (i+1));
        occupation = occupation ? occupation.value : "";
        var age = "";
        if (dob) {
            var birthDate = new Date(dob);
            var today = new Date();
            var years = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                years--;
            }
            age = years !== "" && !isNaN(years) ? years + " years old" : "";
        }
        var fullName = [fname, mname, lname].filter(Boolean).join(" ");
        // N/A logic for optional fields
        var educAttDisplay = educAtt ? educAtt : 'N/A';
        var occupationDisplay = occupation ? occupation : 'N/A';
        var row = document.createElement("tr");
        row.innerHTML =
            '<td>' + fullName + '</td>' +
            '<td>' + relation + '</td>' +
            '<td>' + age + '</td>' +
            '<td>' + sx + '</td>' +
            '<td>' + civStat + '</td>' +
            '<td>' + educAttDisplay + '</td>' +
            '<td>' + occupationDisplay + '</td>';
        tableBody.appendChild(row);
    }
}

function syncWordIdentifyingData() {
    const fname = document.getElementById('fname').value || '';
    const mname = document.getElementById('mname').value || '';
    const lname = document.getElementById('lname').value || '';
    document.getElementById('word_name').textContent = [fname, mname, lname].filter(Boolean).join(' ');
    const dob = document.getElementById('dob').value || '';
    let dobFormatted = '';
    if (dob) {
        const dateObj = new Date(dob);
        if (!isNaN(dateObj.getTime())) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            dobFormatted = dateObj.toLocaleDateString('en-US', options);
        }
    }
    document.getElementById('word_dob').textContent = dobFormatted;
    let age = '';
    if (dob) {
        const birthDate = new Date(dob);
        const today = new Date();
        let years = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            years--;
        }
        age = years !== '' && !isNaN(years) ? years + ' years old' : '';
    }
    document.getElementById('word_age').textContent = age;

    const sxSel = document.getElementById('sx');
    document.getElementById('word_sex').textContent = (sxSel.value && sxSel.selectedOptions[0]?.text !== '--Select--') ? sxSel.selectedOptions[0]?.text : '';

    const civSel = document.getElementById('civStat');
    document.getElementById('word_civil_status').textContent = (civSel.value && civSel.selectedOptions[0]?.text !== '--Select--') ? civSel.selectedOptions[0]?.text : '';

    const eduSel = document.getElementById('educAtt');
    document.getElementById('word_educational_attainment').textContent = (eduSel.value && eduSel.selectedOptions[0]?.text !== '--Select--') ? eduSel.selectedOptions[0]?.text : '';

    document.getElementById('word_occupation').textContent = document.getElementById('occupation').value || '';
    document.getElementById('word_address').textContent = document.getElementsByName('address')[0]?.value || '';
    document.getElementById('word_contact_number').textContent = document.getElementsByName('contact_number')[0]?.value || '';
}

function syncWordNarrativeFields() {
    document.getElementById('word_problem_presented').textContent = document.getElementById('problem_presented_ui').value || '';
    document.getElementById('word_historical_background').textContent = document.getElementById('f4text').value || '';
    document.getElementById('word_recommendation').textContent = document.getElementById('f5text').value || '';
}

['fname','mname','lname','dob','occupation'].forEach(id => {
    document.getElementById(id).addEventListener('input', syncWordIdentifyingData);
});
document.getElementById('sx').addEventListener('change', syncWordIdentifyingData);
document.getElementById('civStat').addEventListener('change', syncWordIdentifyingData);
document.getElementById('educAtt').addEventListener('change', syncWordIdentifyingData);
if(document.getElementsByName('address')[0]) document.getElementsByName('address')[0].addEventListener('input', syncWordIdentifyingData);
if(document.getElementsByName('contact_number')[0]) document.getElementsByName('contact_number')[0].addEventListener('input', syncWordIdentifyingData);

document.getElementById('problem_presented_ui').addEventListener('input', syncWordNarrativeFields);
document.getElementById('f4text').addEventListener('input', syncWordNarrativeFields);
document.getElementById('f5text').addEventListener('input', syncWordNarrativeFields);

updateFamilyTableWord();
syncWordIdentifyingData();
syncWordNarrativeFields();
