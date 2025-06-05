export function getPathName() {
  return window.location.pathname;
}

export function getRoot() {
  return document.documentElement;
}

export function getCSSVar(name) {
  return getComputedStyle(document.documentElement)
    .getPropertyValue(name)
    .trim();
}
