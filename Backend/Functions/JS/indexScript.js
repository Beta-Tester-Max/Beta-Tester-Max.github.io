addEventListener("DOMContentLoaded", () => {
  if (alertMessage) {
    alert(alertMessage);
    window.location.href = "Functions/PHP/clearSession.php";
  }
});
