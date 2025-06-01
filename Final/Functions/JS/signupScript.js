// document.getElementById("password").addEventListener("input", function (event) {
//   const password = event.target.value;

//   const lengthValid = password.length >= 8 && password.length <= 15;
//   const lowercaseValid = /[a-z]/.test(password);
//   const uppercaseValid = /[A-Z]/.test(password);
//   const numberValid = /[0-9]/.test(password);
//   const specialCharValid = /[!@#$%^&*(),.?":{}|<>]/.test(password);
//   const spaceValid = !/\s/.test(password);

//   updateRequirement("lengthRequirement", lengthValid);
//   updateRequirement("lowercaseRequirement", lowercaseValid);
//   updateRequirement("uppercaseRequirement", uppercaseValid);
//   updateRequirement("numberRequirement", numberValid);
//   updateRequirement("specialCharRequirement", specialCharValid);
//   updateRequirement("noSpaceRequirement", spaceValid);

//   if (password === "") {
//     document.getElementById("passwordRequirements").classList.add("d-none");
//     document.getElementById("sF").classList.add("py-5");
//     document.getElementById("sF").classList.remove("py-3");
//   } else {
//     document.getElementById("passwordRequirements").classList.remove("d-none");
//     document.getElementById("sF").classList.add("py-3");
//     document.getElementById("sF").classList.remove("py-5");
//   }

//   const allValid =
//     lengthValid &&
//     lowercaseValid &&
//     uppercaseValid &&
//     numberValid &&
//     specialCharValid &&
//     spaceValid;
//   document.getElementById("submitBtn").disabled = !allValid;
// });

// function updateRequirement(id, isValid) {
//   const requirement = document.getElementById(id);
//   if (isValid) {
//     requirement.classList.remove("invalid");
//     requirement.classList.add("valid");
//   } else {
//     requirement.classList.remove("valid");
//     requirement.classList.add("invalid");
//   }
// }

// document.getElementById("sF").addEventListener("submit", function (event) {
//   const email = document.getElementById("email").value.trim();

//   const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

//   if (!emailRegex.test(email)) {
//     alert("Invalid Email!");
//     event.preventDefault();
//     email.focus();
//   }
// });
