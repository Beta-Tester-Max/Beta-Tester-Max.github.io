const pass = document.getElementById("password");
const pV = document.getElementById("passwordVisibility");

if (pV) {
  pV.addEventListener("change", function () {
    if (pass.type === "password") {
      pass.type = "text";
      pass.focus();
    } else {
      pass.type = "password";
      pass.focus();
    }
  });
}