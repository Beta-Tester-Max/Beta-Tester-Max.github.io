import { toggleMode } from './Global/toggleMode.js';
import { getRoot } from './Global/root.js';
import { getChartContainer, chart } from "./Global/chart.js";
import { highlightBtn, highlightItem, glowChart } from "./Global/glowChart.js";

const root = getRoot();
const THEME_STORAGE_KEY = "userTheme";
const chartContainer = getChartContainer("chart");
const toggleModeBtn = document.getElementById("toggleMode");
const highStats = document.getElementById("highlightStatistics");
const stats = document.getElementById("statistics");

document.addEventListener('DOMContentLoaded', () => {
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

    if (chartContainer) {
        chart(chartContainer);
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

    if (highStats) {
      highStats.addEventListener("click", function () {
        if (stats)  {
          glowChart(highStats, stats);
        }
      });
    }
});