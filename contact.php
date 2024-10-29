<?php
// Include the database connection
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data and trim it
  $name = isset($_POST['name']) ? trim($_POST['name']) : '';
  $email = isset($_POST['email']) ? trim($_POST['email']) : '';
  $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
  $message = isset($_POST['message']) ? trim($_POST['message']) : '';

  // Log the values for debugging
  error_log("Name: '$name', Email: '$email', Phone: '$phone', Message: '$message'");

  // Check if all required fields are filled
  if (empty($name) || empty($email) || empty($phone) || empty($message)) {
      echo "error:missing_fields";
      exit;
  }

  // Sanitize inputs before inserting into the database
  $name = $conn->real_escape_string($name);
  $email = $conn->real_escape_string($email);
  $phone = $conn->real_escape_string($phone);
  $message = $conn->real_escape_string($message);

  // Insert the data into the database
  $sql = "INSERT INTO contact_submissions (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
  
  if ($conn->query($sql) === TRUE) {
      echo "success";
  } else {
      echo "error: " . $conn->error;  // Output the actual error from MySQL
  }
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TEASTREETPH</title>

    <!--=============== BOX ICONS ===============-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--=============== CUSTOM CSS ===============-->
    <link rel="stylesheet" href="assets/css/homepage.css"/>
    <link rel="stylesheet" href="assets/css/contact.css"/>
</head>

<style>
    .bg-primary {
        background-color: var(--color-primary);
        color: var(--color-bg);
    }
    .bg-secondary {
        background-color: #CCF6C8;
        color: #000;
    }
    .bg-extra {
        background-color: var(--color-extra);
        color: var(--color-text);
    }
    .bg-dark {
        background-color: var(--color-dark);
        color: var(--color-text);
    }
    .contact-container {
        width: 100%;
        height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    form {
        display: flex;
        flex-direction: column;
        padding: 2vw 4vw;
        width: 90%;
        max-width: 600px;
    }
    form input, form textarea {
        border: 0;
        margin: 10px 0;
        padding: 20px;
        outline: none;
        background: #f5f5f5;
        font-size: 15px;
    }
    form button {
        padding: 15px;
        background: #78be80;
        color: #fff;
        font-size: 18px;
        border: 0;
        outline: none;
        cursor: pointer;
    }
</style>

<body>
    <!--=============== NAVIGATION BAR ===============-->
    <?php include 'navigation.php'; ?>
    
    <!--=============== HAMBURGER MENU ===============-->
    <button type="button" class="hamburger" id="menu-btn">
        <span class="hamburger-top"></span>
        <span class="hamburger-middle"></span>
        <span class="hamburger-bottom"></span>
    </button>
    
    <!--=============== MOBILE MENU ===============-->
    <div class="mobile-menu hidden" id="menu">
        <ul>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="listoforder.php">Order Now</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="mobile-menu-bottom">
            <button class="btn btn-dark-outline">Sign in</button>
            <button class="btn btn-dark">Join now</button>
            <div>
                <a href="stores.php">
                    <img src="images/marker.svg" alt="" />
                    <span>Find a store</span>
                </a>
            </div>
        </div>
    </div>

    <!--=============== CONTACT FORM ===============-->
    <div class="contact-container">
        <form id="contactForm">
            <h3 class="text-md">Get in touch!</h3>
            <input type="text" id="name" name="name" placeholder="Your name" required>
            <input type="email" id="email" name="email" placeholder="Your email" required>
            <input type="text" id="phone" name="phone" placeholder="Your mobile number" required>
            <textarea id="message" name="message" rows="4" placeholder="How can we help you?" required></textarea>
            <button type="submit">Send</button>
        </form>
        <p id="responseMessage" style="display:none;">Thank you for your support!</p>
    </div>

    <script>
    // Handle form submission via AJAX
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Create a new FormData object to handle form data
        var formData = new FormData(this);

        // Send an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "contact.php", true);
xhr.onload = function() {
    console.log("Response: " + xhr.responseText);  // Log the response for debugging

    if (xhr.status === 200) { // Check if the request was successful
        if (xhr.responseText === "success") {
            document.getElementById('responseMessage').style.display = 'block';
            document.getElementById('contactForm').reset(); // Clear the form fields
        } else if (xhr.responseText.includes("error:missing_fields")) {
            alert("Please fill all the required fields.");
        } else {
            alert("There was an error submitting the form: " + xhr.responseText);
        }
    } else {
        // Handle different HTTP status codes
        alert("Error: " + xhr.status + " - " + xhr.statusText);
    }
};

        
        xhr.onerror = function() {
            alert("Request failed.");
        };

        xhr.send(formData);
    });
    </script>

    <!--=============== FOOTER ===============-->
    <?php include 'front/footer.php'; ?>
    <!--=============== CUSTOM JS ===============-->
    <script src="assets/js/homepage.js"></script>
</body>
</html>
