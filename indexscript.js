function togglePassword(fieldId, iconId) {
    let field = document.getElementById(fieldId);
    let icon = document.getElementById(iconId);
    if (field.type === "password") {
        field.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        field.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}


function validateForm() {
    let name = document.getElementById("name").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm-password").value;

    let nameError = document.getElementById("name-error");
    let phoneError = document.getElementById("phone-error");
    let passwordError = document.getElementById("password-error");
    let confirmPasswordError = document.getElementById("confirm-password-error");

    nameError.innerText = "";
    phoneError.innerText = "";
    passwordError.innerText = "";
    confirmPasswordError.innerText = "";

    let valid = true;

    if (!/^[a-zA-Z\s]+$/.test(name)) {
        nameError.innerText = "Name can only contain letters and spaces.";
        valid = false;
    }
    if (!/^\d{10}$/.test(phone)) {
        phoneError.innerText = "Phone number must be a 10-digit number.";
        valid = false;
    }
    if (password.length < 8 || !/[A-Z]/.test(password) || !/\d/.test(password) || !/[\W_]/.test(password)) {
        passwordError.innerText = "Password must be at least 8 characters long and include an uppercase letter, a number, and a special character.";
        valid = false;
    }
    if (password !== confirmPassword) {
        confirmPasswordError.innerText = "Passwords do not match.";
        valid = false;
    }

    return valid;
}
