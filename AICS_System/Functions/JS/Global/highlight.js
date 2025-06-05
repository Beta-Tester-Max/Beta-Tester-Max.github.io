function highlightItem(item) {
  let glowItem = document.getElementById(item);
}

function highlightBtn(btn) {
  let glowBtn = document.getElementById(btn);
}

if (glowBtn) {
  glowBtn.addEventListener("click", function () {
    if (glowItem) {
      if (item) {
        item.style.boxShadow = "0 0 8px var(--sfont), 0 0 16px var(--font)";
        item.style.animation = "highlightChart 3s ease";
        setTimeout(() => {
          item.style.boxShadow = "0 0 2px var(--sfont), 0 0 4px var(--font)";
          item.style.animation = "";
          item.style.transition = ".5s ease";
        }, 3000);
      }
    } else {
      console.log("Missing Item!");
    }
  });
}
