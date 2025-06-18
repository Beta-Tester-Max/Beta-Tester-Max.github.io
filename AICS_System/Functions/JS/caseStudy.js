import { toggleMode } from "./Global/toggleMode.js";
import { getRoot } from "./Global/root.js";
import { glowChart } from "./Global/glowChart.js";

const root = getRoot();
const THEME_STORAGE_KEY = "userTheme";
const toggleModeBtn = document.getElementById("toggleMode");

document.addEventListener("DOMContentLoaded", () => {
  const savedTheme = localStorage.getItem(THEME_STORAGE_KEY) || "light";

  if (savedTheme === "dark") {
    root.classList.add("darkness");
    if (toggleModeBtn) {
      toggleModeBtn.textContent = "Light Mode";
    }
  } else {
    root.classList.remove("darkness");
    if (toggleModeBtn) {
      toggleModeBtn.textContent = "Dark Mode";
    }
  }

  if (toggleModeBtn) {
    toggleModeBtn.addEventListener("click", function () {
      toggleMode(toggleModeBtn);
      if (chartContainer) {
        chart(chartContainer);
      }
    });
  } else {
    console.warn("Toggle button with ID 'toggleMode' not found.");
  }
});
