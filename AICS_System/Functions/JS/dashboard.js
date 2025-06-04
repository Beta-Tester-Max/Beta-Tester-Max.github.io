const root = document.documentElement;
const modeChanger = document.getElementById("modeChanger");

if (modeChanger) {
  modeChanger.addEventListener("click", function () {
      root.classList.toggle("darkness");
    if (modeChanger.textContent !== "Light Mode") {
      modeChanger.textContent = "Light Mode";
    } else {
      modeChanger.textContent = "Dark Mode";
    }
  });
}
