<?php

/**
 * Process.php
 * 
 * The Process class is meant to simplify the task of processing
 * user submitted forms, redirecting the user to the correct
 * pages if errors are found, or if form is successful, either
 * way. Also handles the logout procedure.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: September 22, 2015
 * Modified by: Arman G. de Castro, October 3, 2008
 * email: armandecastro@gmail.com
 */
include "include/classes/session.php";

class Process {
    /* Class constructor */

    function Process() {
        global $session;
        /* User submitted login form */
        if (isset($_POST['sublogin'])) {
            $this->procLogin();
        }
        /* User submitted registration form */ else if (isset($_POST['subjoin'])) {
            $this->procRegister();
        }

        /* User submitted registration form */ else if (isset($_POST['member_subjoin'])) {
            $this->procMemberRegister();
        }

        /* User submitted registration form */ else if (isset($_POST['master_subjoin'])) {
            $this->procMasterRegister();
        }

        /* User submitted registration form */ else if (isset($_POST['agent_subjoin'])) {
            $this->procAgentRegister();
        }

        /* User submitted forgot password form */ else if (isset($_POST['subforgot'])) {
            $this->procForgotPass();
        }
        /* User submitted edit account form */ else if (isset($_POST['subedit'])) {
            $this->procEditAccount();
        }
        /**
         * The only other reason user should be directed here
         * is if he wants to logout, which means user is
         * logged in currently.
         */ else if ($session->logged_in) {
            $this->procLogout();
        }
        /**
         * Should not get here, which means user is viewing this page
         * by mistake and therefore is redirected.
         */ else {
            header("Location: main.php");
        }
    }

    /**
     * procLogin - Processes the user submitted login form, if errors
     * are found, the user is redirected to correct the information,
     * if not, the user is effectively logged in to the system.
     */
    function procLogin() {
        global $session, $form;
        /* Login attempt */
        $retval = $session->login($_POST['user'], $_POST['pass'], isset($_POST['remember']));

        /* Login successful */
        if ($retval) {
            header("Location: " . $session->referrer);
        }
        /* Login failed */ else {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
    }

    /**
     * procLogout - Simply attempts to log the user out of the system
     * given that there is no logout form to process.
     */
    function procLogout() {
        global $session;
        $retval = $session->logout();
        header("Location: main.php");
    }

    /**
     * procRegister - Processes the user submitted registration form,
     * if errors are found, the user is redirected to correct the
     * information, if not, the user is effectively registered with
     * the system and an email is (optionally) sent to the newly
     * created user.
     */
    function procRegister() {
        global $session, $form;
        /* Convert username to all lowercase (by option) */
        if (ALL_LOWERCASE) {
            $_POST['user'] = strtolower($_POST['user']);
        }
        /* Registration attempt */
        $retval = $session->register($_POST['user'], $_POST['pass'], $_POST['email']);

        /* Registration Successful */
        if ($retval == 0) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = true;
            header("Location: " . $session->referrer);
        }
        /* Error found with form */ else if ($retval == 1) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
        /* Registration attempt failed */ else if ($retval == 2) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = false;
            header("Location: " . $session->referrer);
        }
    }

    function procMasterRegister() {
        global $session, $form;
        /* Convert username to all lowercase (by option) */
        if (ALL_LOWERCASE) {
            $_POST['user'] = strtolower($_POST['user']);
        }
        /* Registration attempt */
        $retval = $session->SessionMasterRegister($_POST['user'], $_POST['pass'], $_POST['email']);

        /* Registration Successful */
        if ($retval == 0) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = true;
            header("Location: " . $session->referrer . '?' . $session->username);
        }
        /* Error found with form */ else if ($retval == 1) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer . '?' . $session->username);
        }
        /* Registration attempt failed */ else if ($retval == 2) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = false;
            header("Location: " . $session->referrer . '?' . $session->username);
        }
    }

    function procMemberRegister() {
        global $session, $form;
        /* Convert username to all lowercase (by option) */
        if (ALL_LOWERCASE) {
            $_POST['user'] = strtolower($_POST['user']);
        }
        /* Registration attempt */
        $retval = $session->SessionMemberRegister($_POST['user'], $_POST['pass'], $_POST['email']);

        /* Registration Successful */
        if ($retval == 0) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = true;
            header("Location: " . $session->referrer . '?' . $session->username);
        }
        /* Error found with form */ else if ($retval == 1) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer . '?' . $session->username);
        }
        /* Registration attempt failed */ else if ($retval == 2) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = false;
            header("Location: " . $session->referrer . '?' . $session->username);
        }
    }

    function procAgentRegister() {
        global $session, $form;
        /* Convert username to all lowercase (by option) */
        if (ALL_LOWERCASE) {
            $_POST['user'] = strtolower($_POST['user']);
        }
        /* Registration attempt */
        $retval = $session->SessionAgentRegister($_POST['user'], $_POST['pass'], $_POST['email']);

        /* Registration Successful */
        if ($retval == 0) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = true;
            header("Location: " . $session->referrer . '?' . $session->username);
        }
        /* Error found with form */ else if ($retval == 1) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer . '?' . $session->username);
        }
        /* Registration attempt failed */ else if ($retval == 2) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = false;
            header("Location: " . $session->referrer . '?' . $session->username);
        }
    }

    /**
     * procForgotPass - Validates the given username then if
     * everything is fine, a new password is generated and
     * emailed to the address the user gave on sign up.
     */
    function procForgotPass() {
        global $database, $session, $mailer, $form;
        /* Username error checking */
        $subuser = $_POST['user'];
        $field = "user";  //Use field name for username
        if (!$subuser || strlen($subuser = trim($subuser)) == 0) {
            $form->setError($field, "* Username not entered<br>");
        } else {
            /* Make sure username is in database */
            $subuser = stripslashes($subuser);
            if (strlen($subuser) < 5 || strlen($subuser) > 30 ||
                    !preg_match("/^([0-9a-z])+$/", $subuser) ||
                    (!$database->usernameTaken($subuser))) {
                $form->setError($field, "* Username does not exist<br>");
            }
        }

        /* Errors exist, have user correct them */
        if ($form->num_errors > 0) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
        }
        /* Generate new password and email it to user */ else {
            /* Generate new password */
            $newpass = $session->generateRandStr(8);

            /* Get email of user */
            $usrinf = $database->getUserInfo($subuser);
            $email = $usrinf['email'];

            /* Attempt to send the email with new password */
            if ($mailer->sendNewPass($subuser, $email, $newpass)) {
                /* Email sent, update database */
                $database->updateUserField($subuser, "password", md5($newpass));
                $_SESSION['forgotpass'] = true;
            }
            /* Email failure, do not change password */ else {
                $_SESSION['forgotpass'] = false;
            }
        }

        header("Location: " . $session->referrer);
    }

    /**
     * procEditAccount - Attempts to edit the user's account
     * information, including the password, which must be verified
     * before a change is made.
     */
    function procEditAccount() {
        global $session, $form;
        /* Account edit attempt */
        $retval = $session->editAccount($_POST['curpass'], $_POST['newpass'], $_POST['email'], $_POST['name']);

        /* Account edit successful */
        if ($retval) {
            $_SESSION['useredit'] = true;
            header("Location: " . $session->referrer);
        }
        /* Error found with form */ else {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
    }
    
     /**
     * procSendConfirm - only needs to be used if the administrator
     * changes the EMAIL_WELCOME from false to true and wants
     * the users to confirm themselves. (why not?!)
     */
    public function procSendConfirm() {
        global $session, $form, $database, $mailer;
        $_POST = $session->cleanInput($_POST);

        $user = $_POST['user'];
        $pass = $_POST['pass'];

        /* Checks that username is in database and password is correct */
        $user = stripslashes($user);
        $result = $database->confirmUserPass($user, md5($pass));

        /* Check error codes */
        if ($result == 1) {
            $field = "user";
            $form->setError($field, "* Usuario no encontrado");
        } elseif ($result == 2) {
            $field = "pass";
            $form->setError($field, "* Contraseña invalida");
        }

        /* Check to see if the user is already valid */
        $q = "SELECT valid FROM " . TBL_USERS . " WHERE username='$user'";
        $valid = $database->query($q);
        $valid = mysqli_fetch_array($valid);
        $valid = $valid['valid'];

        if ($valid == 1) {
            $field = 'user';
            $form->setError($field, "* Usuario ya ha confirmado.");
        }

        /* Return if form errors exist */
        if ($form->num_errors > 0) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        } else {
            $q = "SELECT username, userid, email FROM " . TBL_USERS . " WHERE username='$user'";
            $info = $database->query($q) or die($database->error);
            $info = mysqli_fetch_array($info);

            $username = $info['username'];
            $userid = $info['userid'];
            $email = $info['email'];

            if ($mailer->sendConfirmation($username, $userid, $email)) {
                echo "Tu confirmación ha sido enviado al dirección de correo electrónico ! Volver a <a href='http://$bUrl/'>Principal</a>";
            }
        }
    }

    public function procHashLogin($hash) {
        global $session, $database;
        if (substr($hash, 0, 1) === "#") {
            $hash = substr($hash, 1);
        }

        $user_info = $database->getUserInfoFromHash($hash);

        if ($user_info['hash_generated'] < (time() - (60 * 60 * 24 * 3))) {
            // if the hash was generated more than 3 days ago, the hash is invalid.
            // let's invalidate and refuse the hash.
            $database->updateUserField($user_info['username'], 'hash', $session->generateRandID());
            $database->updateUserField($user_info['username'], 'hash_generated', time());
            return false;
        }

        if ($user_info['username'] && $user_info['userid']) {
            $_SESSION['username'] = $user_info['username'];
            $_SESSION['userid'] = $user_info['userid'];
            $session->checkLogin();
            die("Logging In...");
        } else {
            die();
        }
    }
}

/* Initialize process */
$process = new Process;
?>
