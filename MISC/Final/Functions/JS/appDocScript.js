const fileUploadSets = document.querySelectorAll(".fileCon");

fileUploadSets.forEach((set) => {
  const realFileInput = set.querySelector(".realFile");
  const customButton = set.querySelector(".fakeFile");
  const fileNameSpan = set.querySelector(".textFile");

  if (customButton && realFileInput && fileNameSpan) {
    customButton.addEventListener("click", () => {
      realFileInput.click();
    });

    realFileInput.addEventListener("change", () => {
      if (realFileInput.files && realFileInput.files.length > 0) {
        fileNameSpan.textContent = "File is Chosen";
        fileNameSpan.classList.remove("text-muted");
        fileNameSpan.classList.add("text-success");
      } else {
        fileNameSpan.textContent = "No File Chosen";
        fileNameSpan.classList.add("text-muted");
        fileNameSpan.classList.remove("text-success");
      }
    });
  }
});
