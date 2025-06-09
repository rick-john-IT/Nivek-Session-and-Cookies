<?php
// Include the database connection file
include('include/conn.php');

$error_message = "";

// Function to generate a unique token
function generateToken($length = 32) {
  return bin2hex(random_bytes($length));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve email from the form
  $email = $_POST['email'];

  // Check if the email exists in the database
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  if ($user) {
    // Generate a unique token
    $token = generateToken();

    // Insert a record into password_reset table
    $stmt = $pdo->prepare("INSERT INTO password_reset (user_id, token) VALUES (?, ?)");
    $stmt->execute([$user['user_id'], $token]);

    // Redirect user to password reset page 
    $reset_link = "http://localhost/NivekPC/password_new.php?token=$token";
    header("Location: $reset_link");
    exit();
  } else {
    // Email not found in the database, set error message
    $error_message = "Email not found!";
  }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <?php include 'include/navbar.php'; ?>
    <title>Forget - Password</title>

    <style>
            .reset-password {
      display: flex;
      width: 100%;
      flex-direction: column;
      margin: 0 auto;
      margin-bottom: 5rem; /* Adding margin at the bottom */
    }
    
    .reset-password .reset-password__inner {
      display: flex;
      width: 100%;
      flex-wrap: wrap;
      align-content: center;
      padding: 0 2rem;
    }
    
    .reset-password .reset-password__inner .reset-password__header {
      display: flex;
      width: 100%;
      margin-bottom: 10rem;
    }
    
    .reset-password .reset-password__inner .reset-password__header .reset-password__title {
      display: flex;
      width: 100%;
    }
    
    .reset-password .reset-password__inner .reset-password__header .reset-password__title h1.reset-password__heading {
      font-size: 5.5rem;
      font-weight: 100;
      color: #fff;
      text-align: center;
      margin: 5rem 0 2.5rem 0;
      width: 100%;
    }
    
    .reset-password .reset-password__inner .reset-password__content {
      display: flex;
      width: 100%;
      flex-wrap: wrap;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form {
      display: flex;
      width: 100%;
      justify-content: center;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form {
      display: flex;
      width: 100%;
      flex-wrap: wrap;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group {
      position: relative;
      display: flex;
      width: 100%;
      margin-bottom: 5rem;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group:last-of-type {
      margin-bottom: 0;
      flex-direction: column;
      justify-content: center;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group:last-of-type .form__text {
      text-align: center;
      margin-bottom: 1.5rem;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group:last-of-type .form__text:last-of-type {
      margin-bottom: 0;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group:last-of-type .form__link {
      color: #fff;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__icon {
      position: absolute;
      top: 0;
      left: 1rem;
      display: flex;
      width: 2rem;
      height: 100%;
      fill: #fff;
    }

    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input:focus {
  border-bottom-color: #fff; /* Change border color when focused */
   transition: .25s cubic-bezier(.694, .048, .335, 1) all;
}

    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input {
      display: flex;
      width: 100%;
      padding: 2rem 4rem;
      background: transparent;
      font-size: 1.75rem;
      color: #fff;
      border: none;
      outline: none;
      box-shadow: none;
      border-bottom: .1rem solid rgba(255, 255, 255, .3);
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input:focus + .form__input-after {
      width: 100%;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input:focus ~ .form__label,
.reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input:valid ~ .form__label,
.reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input:not(:placeholder-shown) ~ .form__label {
      transform: translate3d(4rem, 0, 0);
      font-size: 1.25rem;
      color: rgba(255, 255, 255, .3);
    
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input:-webkit-autofill,
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input:-webkit-autofill:hover,
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input:-webkit-autofill:focus,
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input:-webkit-autofill:active {
      transition: 0s 50000s ease all;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__input-after {
      position: absolute;
      left: 0;
      bottom: 0;
      z-index: 99;
      display: flex;
      width: 0;
      height: .1rem;
      background-color: #fff;
      transition: .25s cubic-bezier(.694, .048, .335, 1) all;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__label {
      position: absolute;
      top: 0;
      left: 0;
      display: flex;
      width: calc(100% - 8rem);
      height: 2rem;
      font-size: 1.75rem;
      transform: translate3d(4rem, 2rem, 0);
      transition: .25s cubic-bezier(.694, .048, .335, 1) all;
      pointer-events: none;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__btn {
      position: relative;
      display: flex;
      width: 100%;
      justify-content: center;
      padding: 2rem 4rem;
      cursor: pointer;
      border: .1rem solid #fff;
      border-radius: .25rem;
      background: transparent;
      box-shadow: none;
      outline: none;
      text-transform: uppercase;
      transition: .25s cubic-bezier(.694, .048, .335, 1) all;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__btn::after {
      content: " ";
      position: absolute;
      top: 0;
      left: 0;
      display: flex;
      width: 0;
      height: 100%;
      background-color: #fff;
      transition: .25s cubic-bezier(.694, .048, .335, 1) all;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__btn:hover::after {
      width: 100%;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__btn:hover .form__btn-text {
      color: #1f2029;
    }
    
    .reset-password .reset-password__inner .reset-password__content .reset-password__form .form .form__group .form__btn .form__btn-text {
      position: relative;
      z-index: 99;
      font-size: 1.75rem;
      letter-spacing: .25rem;
      color: #fff;
    }
    .error-message {
      color: red;
    font-size: 14px;
    position: absolute; /* Position the error message absolutely */
    bottom: -20px; /* Adjust the distance from the input field */
    left: 0; /* Align the error message to the left */
}
    
    
    /* Media Queries */
    @media (min-width: 48rem) {
      .reset-password {
        width: 75%;
      }
    }
    
    @media (min-width: 62rem) {
      .reset-password {
        width: 50%;
      }
    }
    
    @media (min-width: 75rem) {
      .reset-password {
        width: 33%;
      }
    
      .reset-password .reset-password__inner {
        max-width: 50rem;
        margin: 0 auto;
      }
    }
    </style>
</head>
<body>
    
   

<div class="reset-password">
        <div class="reset-password__inner">
            <div class="reset-password__header">
                <div class="reset-password__title">
                    <h1 class="reset-password__heading">Reset Password</h1>
                </div>
            </div>
            <div class="reset-password__content">
                <div class="reset-password__form">
                    <form class="form" method="POST">
                        <!-- Move error message above the form group -->
                        <div class="form__group">
                            <input type="email" class="form__input" id="email" name="email" placeholder="Email" required>
                            <label for="email" class="form__label">Email</label>
                             <!-- Display error message here -->
                    <?php if($error_message): ?>
                        <div class="error-message"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                            <svg class="form__icon" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 1.5c.956 0 1.875.141 2.75.406L12 10.813 9.25 3.906c.875-.265 1.794-.406 2.75-.406zM4.406 9l7.594 5.719L19.781 9H4.406zM11 11l-8 6h16l-8-6zm0 2.281L15.281 15H6.719L11 13.281z"/>
                            </svg>
                            <div class="form__input-after"></div>
                        </div>
                        <div class="form__group">
                            <button type="submit" name="submit" class="form__btn">
                                <span class="form__btn-text">Reset Password</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'include/footer.php'; ?>
</body>
</html>