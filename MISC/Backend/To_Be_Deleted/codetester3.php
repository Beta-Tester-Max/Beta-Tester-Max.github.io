<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Floating Text Validation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }

    .container {
      position: relative;
      width: 300px;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .floating-text {
      position: absolute;
      top: -30px;
      left: 0;
      width: 100%;
      color: red;
      font-size: 14px;
      visibility: hidden; /* Hidden by default */
      transition: visibility 0.3s ease-in-out, opacity 0.3s ease-in-out;
    }

    .visible {
      visibility: visible;
      opacity: 1;
    }

  </style>
</head>
<body>

  <div class="container">
    <input type="text" id="inputField" placeholder="Enter password" />
    <div id="floatingMessage" class="floating-text"></div>
  </div>

  <script>
    // Function to validate the input
    function validateInput(input) {
      // Define the regex patterns
      const uppercasePattern = /[A-Z]/;
      const lowercasePattern = /[a-z]/;
      const numberPattern = /\d/;
      const specialCharacterPattern = /[!@#$%^&*()+]/;
      const lengthPattern = /^.{8,15}$/;
      const validCharacters = /^[a-zA-Z0-9!@#$%^&*()+]*$/;

      if (!validCharacters.test(input)) {
        return { valid: false, message: "Input contains invalid characters." };
      }

      // Check for at least one uppercase letter
      if (!uppercasePattern.test(input)) {
        return { valid: false, message: "Input must contain at least one uppercase letter." };
      }

      // Check for at least one lowercase letter
      if (!lowercasePattern.test(input)) {
        return { valid: false, message: "Input must contain at least one lowercase letter." };
      }

      // Check for at least one number
      if (!numberPattern.test(input)) {
        return { valid: false, message: "Input must contain at least one number." };
      }

      // Check for at least one special character
      if (!specialCharacterPattern.test(input)) {
        return { valid: false, message: "Input must contain at least one special character (!@#$%^&*()+)." };
      }

      if (!lengthPattern.test(input)) {
        return { valid: false, message: "Input must be between 8 and 15 characters long." };
      }

      // If all checks pass
      return { valid: true, message: "Input is valid!" };
    }

    const inputField = document.getElementById('inputField');
    const floatingMessage = document.getElementById('floatingMessage');

    inputField.addEventListener('input', () => {
      const input = inputField.value;
      const validationResult = validateInput(input);
      
      if (!validationResult.valid) {
        floatingMessage.textContent = validationResult.message;
        floatingMessage.classList.add('visible');
      } else {
        floatingMessage.textContent = validationResult.message;
        floatingMessage.classList.add('visible');
      }
    });
  </script>

</body>
</html>
