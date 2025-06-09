<?php
include_once "include/conn.php"; // Include the database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Manage Account</title>
    <?php include 'include/navbar.php'; ?>
    <style>
       /* Same design for manage_account.php form */
.manage-account {
    display: flex;
    width: 100%;
    flex-direction: column;
    margin: 0 auto;
    margin-bottom: 5rem; /* Adding margin at the bottom */
}

.manage-account .manage-account__inner {
    display: flex;
    width: 100%;
    flex-wrap: wrap;
    align-content: center;
    padding: 0 2rem;
}

.manage-account .manage-account__inner .manage-account__header {
    display: flex;
    width: 100%;
    margin-bottom: 10rem;
}

.manage-account .manage-account__inner .manage-account__header .manage-account__title {
    display: flex;
    width: 100%;
}

.manage-account .manage-account__inner .manage-account__header .manage-account__title h1.manage-account__heading {
    font-size: 5.5rem;
    font-weight: 100;
    color: #fff;
    text-align: center;
    margin: 5rem 0 2.5rem 0;
    width: 100%;
}

.manage-account .manage-account__inner .manage-account__content {
    display: flex;
    width: 100%;
    flex-wrap: wrap;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form {
    display: flex;
    width: 100%;
    justify-content: center;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form {
    display: flex;
    width: 100%;
    flex-wrap: wrap;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group {
    position: relative;
    display: flex;
    width: 100%;
    margin-bottom: 5rem;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group:last-of-type {
    margin-bottom: 0;
    flex-direction: column;
    justify-content: center;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group:last-of-type .form__text {
    text-align: center;
    margin-bottom: 1.5rem;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group:last-of-type .form__text:last-of-type {
    margin-bottom: 0;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group:last-of-type .form__link {
    color: #fff;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__icon {
    position: absolute;
    top: 0;
    left: 1rem;
    display: flex;
    width: 2rem;
    height: 100%;
    fill: #fff;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input:focus {
    border-bottom-color: #fff; /* Change border color when focused */
    transition: .25s cubic-bezier(.694, .048, .335, 1) all;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input {
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

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input:focus + .form__input-after {
    width: 100%;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input:focus ~ .form__label,
.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input:valid ~ .form__label,
.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input:not(:placeholder-shown) ~ .form__label {
    transform: translate3d(4rem, 0, 0);
    font-size: 1.25rem;
    color: rgba(255, 255, 255, .3);

}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input:-webkit-autofill,
.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input:-webkit-autofill:hover,
.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input:-webkit-autofill:focus,
.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input:-webkit-autofill:active {
    transition: 0s 50000s ease all;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__input-after {
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

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__label {
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

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__btn {
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

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__btn::after {
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

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__btn:hover::after {
    width: 100%;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__btn:hover .form__btn-text {
    color: #1f2029;
}

.manage-account .manage-account__inner .manage-account__content .manage-account__form .form .form__group .form__btn .form__btn-text {
    position: relative;
    z-index: 99;
    font-size: 1.75rem;
    letter-spacing: .25rem;
    color: #fff;
}


/* CSS for Update Button */
.form__btn-update {
    display: block; /* Change this line */
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    text-align: center;
    text-decoration: none;
    color: #fff;
    background-color: #007BFF;
    border: none;
    border-radius: 0.25rem;
    transition: background-color 0.3s ease;
    margin: 2rem auto 0; /* Modify this line */
    position: relative;
    z-index: 99;
    font-size: 1.75rem;
    letter-spacing: .25rem;
}

.form__btn-update:hover {
    background-color: #0056b3;
}

.form__btn-update:active {
    background-color: #003d80;
}

/* Media Queries */
@media (min-width: 48rem) {
    .manage-account {
        width: 75%;
    }
}

@media (min-width: 62rem) {
    .manage-account {
        width: 50%;
    }
}

@media (min-width: 75rem) {
    .manage-account {
        width: 33%;
    }

    .manage-account .manage-account__inner {
        max-width: 50rem;
        margin: 0 auto;
    }
}

    </style>
</head>
<body>
    <div class="manage-account">
        <div class="manage-account__inner">
            <div class="manage-account__header">
                <div class="manage-account__title">
                    <h1 class="manage-account__heading">Manage Personal Profile </h1>
                </div>
            </div>
            <div class="manage-account__content">
                <div class="manage-account__form">
                    <form class="form" method="post" action="update_account.php">
                        <div class="form__group">
                            <input type="text" class="form__input" name="new_username" placeholder="Enter new username" required >
                            <label class="form__label">Enter new username</label>
                        </div>
                        <div class="form__group">
                            <input type="email" class="form__input" name="new_email" placeholder="Enter new email" required>
                            <label class="form__label">Enter new email</label>
                        </div>
                        <div class="form__group">
                            <input type="tel" class="form__input" name="new_phone" placeholder="Enter new phone" required>
                            <label class="form__label">Enter new phone</label>
                        </div>
                        <button type="submit" name="update" class="form__btn form__btn-update">Update Account</button>
                    </form>
                </div>
            </div>
            <button onclick="confirm_edit(this)" class="edit-button">Edit</button>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>
    <!-- JavaScript functionality provided by the assistant -->
    <script>
        function confirm_edit(btn) {
            var username = document.getElementsByName("new_username")[0];
            var email = document.getElementsByName("new_email")[0];
            var phone = document.getElementsByName("new_phone")[0];
            var submitBtn = document.querySelector(".form__btn");

            username.disabled = !username.disabled;
            email.disabled = !email.disabled;
            phone.disabled = !phone.disabled;
            submitBtn.disabled = !submitBtn.disabled;

            if (username.disabled) {
                btn.textContent = "Edit";
            } else {
                btn.textContent = "Done";
            }
        }
    </script>
</body>
</html>
