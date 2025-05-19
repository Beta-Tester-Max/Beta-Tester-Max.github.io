<!-- /^0[89][1-9]{2}-[1-9]{3}-[1-9]{4}$/ -> phone no
/^\d+$/ -> digits only
/^\d{4}-\d{2}-\d{2}$/ -> Date -->
<!-- <form method="POST" enctype="multipart/form-data" action="Functions/PHP/uploadRequirement.php"></form>
<form method="POST" enctype="multipart/form-data" action="Functions/PHP/editRequirement.php">
    <input type="hidden" name="editRequirement" required>
</form>
<form method="POST" target="_blank" action="Functions/PHP/fileOpener.php"></form> -->


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .file-upload-wrapper {
  position: relative;
  overflow: hidden; /* To contain the custom button */
  display: inline-block; /* Or block, as needed */
}

.custom-file-upload {
  /* Bootstrap's btn-dark class will handle the initial styling */
}

.custom-file-upload:hover {
  background-color: #fff !important; /* White background on hover */
  color: #000 !important;        /* Black text on hover */
  border-color: #fff !important; /* Optional: Keep the border white on hover */
}

#real-file-input {
  position: absolute;
  font-size: 999px;
  opacity: 0;
  right: 0;
  top: 0;
  cursor: pointer;
}

#file-name {
  /* Added Bootstrap's margin utility class for spacing */
}
</style>

<div class="file-upload-wrapper">
    <button type="button" class="custom-file-upload btn btn-dark">Choose File</button>
    <input type="file" id="real-file-input" style="display: none;">
</div>


<script>
    const realFileInput = document.getElementById('real-file-input');
    const customButton = document.querySelector('.custom-file-upload');
    const fileNameSpan = document.getElementById('file-name');

    customButton.addEventListener('click', () => {
        realFileInput.click();
    });

    realFileInput.addEventListener('change', () => {
        if (realFileInput.files && realFileInput.files.length > 0) {
            fileNameSpan.textContent = realFileInput.files[0].name;
            fileNameSpan.classList.remove('text-muted'); // Remove muted text when a file is chosen
        } else {
            fileNameSpan.textContent = 'No file chosen';
            fileNameSpan.classList.add('text-muted');    // Add muted text when no file is chosen
        }
    });
</script>