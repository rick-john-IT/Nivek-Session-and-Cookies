<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include_once "include/conn.php";

    // Retrieve form data
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";

    // Perform validation (you can add more validation as needed)
    if ($password !== $confirm_password) {
        $error = "Password and confirm password do not match.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Establish a database connection using the Database class
$pdo = new Database();
$conn = $pdo->open();

  // Prepare and execute SQL statement to insert data into your database
  $stmt = $conn->prepare("INSERT INTO users (username, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$username, $email, $hashed_password, $phone, $address]);
  if ($stmt->rowCount() > 0) {
      echo "User inserted successfully.";
  } else {
      echo "Error inserting user: " . $stmt->errorInfo()[2];
  }

// Close the database connection
$pdo->close();

// Redirect the user to a success page or login page
header("Location: account.php");
exit();
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
 
    <title>Sign Up</title>


    <style>
  .signup {
    display: flex;
    width: 100%;
    flex-direction: column;
    margin: 0 auto;
    margin-bottom: 5rem; /* Adding margin at the bottom */
  }
  
  .signup .signup__inner {
    display: flex;
    width: 100%;
    flex-wrap: wrap;
    align-content: center;
    padding: 0 2rem;
  }
  
  .signup .signup__inner .signup__header {
    display: flex;
    width: 100%;
    margin-bottom: 10rem;
  }
  
  .signup .signup__inner .signup__header .signup__title {
    display: flex;
    width: 100%;
  }
  
  .signup .signup__inner .signup__header .signup__title h1.signup__heading {
    font-size: 5.5rem;
    font-weight: 100;
    color: #fff;
    text-align: center;
    margin: 5rem 0 2.5rem 0;
    width: 100%;
  }
  
  .signup .signup__inner .signup__content {
    display: flex;
    width: 100%;
    flex-wrap: wrap;
  }
  
  .signup .signup__inner .signup__content .signup__form {
    display: flex;
    width: 100%;
    justify-content: center;
  }
  
  .signup .signup__inner .signup__content .signup__form .form {
    display: flex;
    width: 100%;
    flex-wrap: wrap;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group {
    position: relative;
    display: flex;
    width: 100%;
    margin-bottom: 5rem;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group:last-of-type {
    margin-bottom: 0;
    flex-direction: column;
    justify-content: center;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group:last-of-type .form__text {
    text-align: center;
    margin-bottom: 1.5rem;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group:last-of-type .form__text:last-of-type {
    margin-bottom: 0;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group:last-of-type .form__link {
    color: #fff;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__icon {
    position: absolute;
    top: 0;
    left: 1rem;
    display: flex;
    width: 2rem;
    height: 100%;
    fill: #fff;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input {
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
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input:focus + .form__input-after {
    width: 100%;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input:focus ~ .form__label,
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input:valid ~ .form__label {
    transform: translate3d(4rem, 0, 0);
    font-size: 1.25rem;
    color: rgba(255, 255, 255, .3);
  }

  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input[type="email"]:focus ~ .form__label,
.signup .signup__inner .signup__content .signup__form .form .form__group .form__input[type="email"]:not(:placeholder-shown) ~ .form__label {
    transform: translate3d(4rem, 0, 0);
    font-size: 1.25rem;
    color: rgba(255, 255, 255, .3);
}

  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input:-webkit-autofill,
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input:-webkit-autofill:hover,
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input:-webkit-autofill:focus,
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input:-webkit-autofill:active {
    transition: 0s 50000s ease all;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__input-after {
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
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__label {
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
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__btn {
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
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__btn::after {
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
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__btn:hover::after {
    width: 100%;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__btn:hover .form__btn-text {
    color: #1f2029;
  }
  
  .signup .signup__inner .signup__content .signup__form .form .form__group .form__btn .form__btn-text {
    position: relative;
    z-index: 99;
    font-size: 1.75rem;
    letter-spacing: .25rem;
    color: #fff;
  }
  
  /* Media Queries */
  @media (min-width: 48rem) {
    .signup {
      width: 75%;
    }
  }
  
  @media (min-width: 62rem) {
    .signup {
      width: 50%;
    }
  }
  
  @media (min-width: 75rem) {
    .signup {
      width: 33%;
    }
  
    .signup .signup__inner {
      max-width: 50rem;
      margin: 0 auto;
    }
  }
    </style>
    <title>SignUp</title>
</head>
<body>
    
    

    <div class="signup">
        <div class="signup__inner">
            <div class="signup__header">
                <div class="signup__title">
                    <h1 class="signup__heading">Sign Up</h1>
                </div>
            </div>
            <div class="signup__content">
                <div class="signup__form">
                <form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form__group">
                            <svg class="form__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V7h2v1zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v1zm3 4h-1v-2h2v1c0 1.11-.89 2-2 2z"/>
                            </svg>
                            <input type="text" class="form__input" placeholder="Username" name="username" required>
                            <div class="form__input-after"></div>
                            <label class="form__label">Username</label>
                        </div>
                        <div class="form__group">
                            <svg class="form__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V7h2v1zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v1zm3 4h-1v-2h2v1c0 1.11-.89 2-2 2z"/>
                            </svg>
                            <input type="email" class="form__input" placeholder="Email" name="email" required>
                            <div class="form__input-after"></div>
                            <label class="form__label">Email</label>
                        </div>
                        <div class="form__group">
                            <svg class="form__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V7h2v1zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v1zm3 4h-1v-2h2v1c0 1.11-.89 2-2 2z"/>
                            </svg>
                            <input type="tel" class="form__input" placeholder="Phone Number" name="phone" required>
                            <div class="form__input-after"></div>
                            <label class="form__label">Phone Number</label>
                        </div>
                        <div class="form__group">
                            <svg class="form__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V7h2v1zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v1zm3 4h-1v-2h2v1c0 1.11-.89 2-2 2z"/>
                            </svg>
                            <input type="text" class="form__input" placeholder="Address" name="address" required>
                            <div class="form__input-after"></div>
                            <label class="form__label">Address</label>
                        </div>
                        <div class="form__group">
                            <svg class="form__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V7h2v1zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v1zm3 4h-1v-2h2v1c0 1.11-.89 2-2 2z"/>
                            </svg>
                            <input type="password" class="form__input" placeholder="Password" name="password" required>
                            <div class="form__input-after"></div>
                            <label class="form__label">Password</label>
                        </div>
                        <div class="form__group">
                            <svg class="form__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V7h2v1zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v1zm3 4h-1v-2h2v1c0 1.11-.89 2-2 2z"/>
                            </svg>
                            <input type="password" class="form__input" placeholder="Confirm Password" name="confirm_password" required>
                            <div class="form__input-after"></div>
                            <label class="form__label">Confirm Password</label>
                        </div>
                        <div class="form__group">
                            <button type="submit" class="form__btn">
                                <span class="form__btn-text">Sign Up</span>
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