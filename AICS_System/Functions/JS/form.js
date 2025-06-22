import { toggleMode } from "./Global/toggleMode.js";
import { getRoot } from "./Global/root.js";
import { glowChart } from "./Global/glowChart.js";

const root = getRoot();
const THEME_STORAGE_KEY = "userTheme";
const toggleModeBtn = document.getElementById("toggleMode");
const dateInputs = document.querySelectorAll(".form__field--date");
const selectInputs = document.querySelectorAll(".form__field--select");
const selects = document.querySelectorAll(".form__real-select");
const form = document.getElementById("form");
const sxSelect = document.getElementById("sxSelect");
const csSelect = document.getElementById("csSelect");
const bSelect = document.getElementById("bSelect");
const highlightContent = document.getElementById("highlightContent");
const content = document.getElementById('content');

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

  dateInputs.forEach((input) => {
    const originalType = "text";
    const dateType = "date";

    input.addEventListener("focus", () => {
      input.type = dateType;
      input.click();
    });

    input.addEventListener("blur", () => {
      if (!input.value) {
        input.type = originalType;
      }
    });

    input.addEventListener("input", () => {
      input.classList.toggle("has-value", !!input.value);
    });

    if (input.value) {
      input.classList.add("has-value");
    }
  });

  selectInputs.forEach((input, index) => {
    const select = selects[index];

    input.addEventListener("focus", () => {
      input.style.display = "none";
      select.style.display = "block";
      select.focus();
    });

    select.addEventListener("change", () => {
      if (select.value) {
        input.value = select.options[select.selectedIndex].text;
        input.classList.add("has-value");
        select.classList.add("has-value");
      }
      select.style.display = "none";
      input.style.display = "block";
    });

    select.addEventListener("blur", () => {
      if (!select.value) {
        select.style.display = "none";
        input.style.display = "block";
      }
    });
  });

  if (form) {
    form.addEventListener("submit", function (event) {
      let errors = [];

      if (!sxSelect || sxSelect.value.trim() === "") {
        errors.push("Sex is required");
      }

      if (!csSelect || csSelect.value.trim() === "") {
        errors.push("Civil Status is required");
      }

      if (!bSelect || bSelect.value.trim() === "") {
        errors.push("Barangay is required");
      }

      if (errors.length > 0) {
        event.preventDefault();
        alert(errors.join("\n"));
      }
    });
  }

  if (highlightContent) {
    highlightContent.addEventListener("click", function () {
      if (content) {
        glowChart(highlightContent, content);
      }
    });
  }
});