import { getRoot } from "./root.js";
const root = getRoot();
const THEME_STORAGE_KEY = "userTheme";

function applyTheme(themeToApply, btn) {
    if (themeToApply === "dark") {
        root.classList.add("darkness");
        if (btn) {
            btn.textContent = "Light Mode";
        }
    } else {
        root.classList.remove("darkness");
        if (btn) {
            btn.textContent = "Dark Mode";
        }
    }
    localStorage.setItem(THEME_STORAGE_KEY, themeToApply);
}

export function toggleMode(btn) {
    if (!btn) {
        console.warn("Toggle button not provided to toggleMode function.");
        return;
    }

    const currentTheme = localStorage.getItem(THEME_STORAGE_KEY) || "light";

    let newTheme;
    if (currentTheme === "dark") {
        newTheme = "light";
    } else {
        newTheme = "dark";
    }

    applyTheme(newTheme, btn);
}