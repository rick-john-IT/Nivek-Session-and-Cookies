<?php
// Include the database connection file
include('include/conn.php');

// Function to validate token and reset password
function resetPassword($pdo, $token, $password) {
    // Hash the new password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Retrieve the user_id associated with the token
    $stmt = $pdo->prepare("SELECT user_id FROM password_reset WHERE token = ?");
    $stmt->execute([$token]);
    $user_id = $stmt->fetchColumn();

    // Update the user's password in the database
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE user_id = ?");
    $stmt->execute([$hashed_password, $user_id]);

    // Delete the token from the password_reset table
    $stmt = $pdo->prepare("DELETE FROM password_reset WHERE token = ?");
    $stmt->execute([$token]);

    // Redirect user to login page
    header("Location: account.php");
    exit();
}

// Check if the token is provided in the URL parameter
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $stmt = $pdo->prepare("SELECT * FROM password_reset WHERE token = ?");
    $stmt->execute([$token]);
    $reset_data = $stmt->fetch();

    // If token not found, show error message or redirect to an error page
    if (!$reset_data) {
        $error_message = "Invalid token.";
    }
} else {
    // If token is not provided in the URL parameter, show an error message or redirect to an error page
    $error_message = "Token not provided.";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve password from the form
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Reset password
        resetPassword($pdo, $token, $password);
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
    font-weight: bold;
    margin-bottom: 10px;
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
              <form class="form" method="post" action="">
                <div class="form__group">
                <input type="password" class="form__input" id="password" name="password" placeholder="New Password" required>
                  <label for="newPassword" class="form__label">New Password</label>
                  <!-- You can add an icon for the password input if needed -->
                  <div class="form__input-after"></div>
                </div>
                <div class="form__group">
                <input type="password" class="form__input" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
                  <label for="confirmNewPassword" class="form__label">Confirm New Password</label>
                  <!-- You can add an icon for the password input if needed -->
                  <div class="form__input-after"></div>
                </div>
                <div class="form__group">
                  <button type="submit" class="form__btn">
                    <span class="form__btn-text">Reset Password</span>
                  </button>
                </div>
                <?php if(isset($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
              </form>
            </div>
          </div>
        </div>
      </div>

	  <?php include 'include/footer.php'; ?>

</body>
</html>
