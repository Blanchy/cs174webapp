function isEmail(em) {
    if (em == "") return "Please enter a valid email.\n"
}

function isUsername(un) {
    if (un == "") return "Please enter a valid username.\n"
}

function isPassword(pw) {
    if (pw == "") return "Please enter a valid password.\n"
}

function valSignup(form) {
    if (!isUsername(form.uname)) return "Please enter a valid username.\n"
    if (!isEmail(emaddr)) return "Please enter a valid email.\n"
    if (!isPassword(form.pword)) return "Please enter a valid password. \n"
    return ""
}

function valSignin(form) {
    if (!isUsername(form.nuname)) return "Please enter a valid username.\n"
    if (!isPassword(form.pword)) return "Please enter a valid password. \n"
    if (form.npw != form.npword2) return "Passwords do not match.\n"
    return ""
}