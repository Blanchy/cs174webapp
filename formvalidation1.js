// Blanchy Polangcos

function isEmail(em) {
    if (em == "") return "Please enter a valid email.\n"
    //if (!((em.indexOf(".") > 0) && em.indexOf("@") > 0 && em.indexOf("@") < em.length-1 && em.indexOf(".") < em.length-1))
    else if (!/[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+.[a-zA-Z0-9]+/.test(em)) return "Please enter a valid email.\n"
    return ""
}

function isUsername(un) {
    msg = ""
    if (un == "") return "Please enter a valid username.\n"
    if (un.length < 3 ) msg += "Username must be at least 3 characters. \n"
    if (/[^a-zA-Z0-9_-]/.test(un)) msg += "Username can only be alphanumeric with numbers and dashes. \n"
    return msg
}

function isPassword(pw) {
    msg = ""
    if (pw == "") msg += "Please enter a valid password.\n"
    if (pw.length < 6 ) return "Password must be at least 6 characters. \n"
    //else if (/[^a-zA-Z0-9!#$]/.test(pw)) return "Invalid password characters found; use alphanumeric characters and !,#, or $.\n"
    if (!/[a-z]/.test(pw)) msg += "Passwords must have at least one lowercase letter.\n"
    if (!/[A-Z]/.test(pw)) msg += "Passwords must have at least one uppercase letter.\n"
    if (!/[0-9]/.test(pw)) msg += "Passwords must have at least one digit."
    if (!/[!#$]/.test(pw)) msg += "Passwords have at least one character from these: !, #, or $. \n"
    return msg
}

function valSignup(form) {
    msg = ""
    msg += isUsername(form.nuname.value)
    msg += isEmail(form.emaddr.value)
    msg += isPassword(form.npword.value)
    if (form.npword.value !== form.npword2.value) msg += "Passwords do not match.\n"
    if (msg.length < 1) return true
    else { alert(msg) ; return false }
}

function valSignin(form) {
    msg = ""
    msg += isUsername(form.uname.value)
    msg += isPassword(form.pword.value)
    if (msg.length < 1) return true
    else { alert(msg) ; return false }
}

function valAlphanumeric(form) {
    if (/[^A-Za-z0-9]/.test(form.mname.value)) {
        msg = "Name must be alphanumeric."
        alert(msg)
    }
    else { return true; }
}