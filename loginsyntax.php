<?php

/**
 * 
 * Blanchy Polangcos
 * 
 * Checks for correct syntax.
 * 
 */

    function isEmail($em) {
        if ($em == "") return "Please enter a valid email.\n";
        if (!preg_match('/[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+.[a-zA-Z0-9]+/', $em)) return "Please enter a valid email.\n";
        return "";
    }
    
    function isUsername($un) {
        if ($un == "") return "Please enter a valid username.\n";
        if (strlen($un) < 3 ) return "Username must be at least 3 characters. \n";
        if (preg_match('/[^a-zA-Z0-9_-]/', $un)) return "Username can only be alphanumeric with numbers and dashes. \n";
        return "";
    }
    
    function isPassword($pw) {
        if ($pw == "") return "Please enter a valid password.\n";
        if (strlen($pw) < 6 ) return "Password must be at least 6 characters. \n";
        if (preg_match('/[^a-zA-Z0-9!#$]/', $pw) || !preg_match('/[a-z]/',$pw) || !preg_match('/[A-Z]/',$pw) ||!preg_match('/[0-9]/',$pw) ||!preg_match('/[!#$]/',$pw)) 
            return "Passwords must be a mixture of capital, lowercase, and numeric characters, and at least one character from these: !, #, or $. \n";
        return "";
    }
    
    function valSignup($un, $pw, $pw2, $em) {
        $msg = "";
        $msg .= isUsername($un);
        $msg .= isEmail($em);
        $msg .= isPassword($pw);
        if ($pw != $pw2) $msg .= "Passwords do not match.\n";
        if ($msg == "") { return true; }
        else { echo $msg ; return false; }
    }

    function valSignin($un, $pw) {
        $msg = "";
        $msg .= isUsername($un);
        $msg .= isPassword($pw);
        if ($msg == "") return true; 
        else { echo $msg ; return false; }
    }
?>