const sAB = document.getElementById("submitApp");
const sAF = document.getElementById("submitAppForm");
const reason = document.getElementById("reason");

if (sAB) {
  sAB.addEventListener("click", function (event) {
    if (reason.value !== "") {
      if (confirm("Are you sure?") == true) {
        if (sAF) {
          sAF.submit();
        }
      } else {
        event.preventDefault();
      }
    } else {
        alert('Please! state your reason.');
        event.preventDefault();
    }
  });
}
