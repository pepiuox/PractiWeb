<?php

/**
 * AdminProcess.php
 * 
 * The AdminProcess class is meant to simplify the task of processing
 * admin submitted forms from the Centro de Administración, these deal with
 * member system adjustments.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 2, 2009 by Ivan Novak
 */
include '../include/classes/session.php';

class AdminProcess {
    /* Class constructor */

    function AdminProcess() {
        global $session;
        /* Make sure administrator is accessing page */
        if (!$session->isAdmin()) {
            header("Location: ../index.php");
            return;
        }

        /* Admin submitted update user valid form */
        if (isset($_POST['subjoin'])) {
            $this->procRegisterUser();
        }
        /* Admin submitted update user valid form */ 
        else if (isset($_POST['subupdvalid'])) {
            $this->procUpdateValid();
        }
        /* Admin submitted update user level form */ 
        else if (isset($_POST['subupdlevel'])) {
            $this->procUpdateLevel();
        }
        /* Admin submitted Eliminar Usuario form */ 
        else if (isset($_POST['subdeluser'])) {
            $this->procDeleteUser();
        }
        /* Admin submitted delete inactive users form */ 
        else if (isset($_POST['subdelinact'])) {
            $this->procDeleteInactive();
        }
        /* Admin submitted ban user form */ 
        else if (isset($_POST['subbanuser'])) {
            $this->procBanUser();
        }
        /* Admin submitted delete banned user form */ 
        else if (isset($_POST['subdelbanned'])) {
            $this->procDeleteBannedUser();
        }
        /* Should not get here, redirect to home page */ 
        else {
            header("Location: ../index.php");
        }
    }

    function procRegisterUser() {
        global $session, $form;
        $_POST = $session->cleanInput($_POST);
        /* Convert username to all lowercase (by option) */
        if (ALL_LOWERCASE) {
            $_POST['user'] = strtolower($_POST['user']);
        }
        /* Registration attempt */
        $retval = $session->register($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['name']);

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

    /**
     * procUpdateValid - If the submitted username is correct,
     * their user valid is updated according to the admin's
     * request.
     */
    function procUpdateValid() {
        global $session, $database, $form;
        /* Username error checking */
        $subuser = $this->checkUsername("valuser");

        /* Errors exist, have user correct them */
        if ($form->num_errors > 0) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
        /* Update user valid */ else {
            $database->validUserField($subuser, "valid", (int) $_POST['updvalid']);
            header("Location: " . $session->referrer);
        }
    }

    /**
     * procUpdateLevel - If the submitted username is correct,
     * their user level is updated according to the admin's
     * request.
     */
    function procUpdateLevel() {
        global $session, $database, $form;
        /* Username error checking */
        $subuser = $this->checkUsername("upduser");

        /* Errors exist, have user correct them */
        if ($form->num_errors > 0) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
        /* Update user level */ else {
            $database->updateUserField($subuser, "userlevel", (int) $_POST['updlevel']);
            header("Location: " . $session->referrer);
        }
    }

    /**
     * procDeleteUser - If the submitted username is correct,
     * the user is deleted from the database.
     */
    function procDeleteUser() {
        global $session, $database, $form;
        /* Username error checking */
        $subuser = $this->checkUsername("deluser");

        /* Errors exist, have user correct them */
        if ($form->num_errors > 0) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
        /* Eliminar Usuario from database */ else {
            $q = "DELETE FROM " . TBL_USERS . " WHERE username = '$subuser'";
            $database->query($q);
            header("Location: " . $session->referrer);
        }
    }

    /**
     * procDeleteInactive - All inactive users are deleted from
     * the database, not including administrators. Inactivity
     * is defined by the number of days specified that have
     * gone by that the user has not logged in.
     */
    function procDeleteInactive() {
        global $session, $database;
        $inact_time = $session->time - $_POST['inactdays'] * 24 * 60 * 60;
        $q = "DELETE FROM " . TBL_USERS . " WHERE timestamp < $inact_time "
                . "AND userlevel != " . ADMIN_LEVEL;
        $database->query($q);
        header("Location: " . $session->referrer);
    }

    /**
     * procBanUser - If the submitted username is correct,
     * the user is banned from the member system, which entails
     * removing the username from the users table and adding
     * it to the banned users table.
     */
    function procBanUser() {
        global $session, $database, $form;
        /* Username error checking */
        $subuser = $this->checkUsername("banuser");

        /* Errors exist, have user correct them */
        if ($form->num_errors > 0) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
        /* Ban user from member system */ else {
            $q = "DELETE FROM " . TBL_USERS . " WHERE username = '$subuser'";
            $database->query($q);

            $q = "INSERT INTO " . TBL_BANNED_USERS . " VALUES ('$subuser', $session->time)";
            $database->query($q);
            header("Location: " . $session->referrer);
        }
    }

    /**
     * procDeleteBannedUser - If the submitted username is correct,
     * the user is deleted from the banned users table, which
     * enables someone to register with that username again.
     */
    function procDeleteBannedUser() {
        global $session, $database, $form;
        /* Username error checking */
        $subuser = $this->checkUsername("delbanuser", true);

        /* Errors exist, have user correct them */
        if ($form->num_errors > 0) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
        /* Eliminar Usuario from database */ else {
            $q = "DELETE FROM " . TBL_BANNED_USERS . " WHERE username = '$subuser'";
            $database->query($q);
            header("Location: " . $session->referrer);
        }
    }

    /**
     * checkUsername - Helper function for the above processing,
     * it makes sure the submitted username is valid, if not,
     * it adds the appropritate error to the form.
     */
    function checkUsername($uname, $ban = false) {
        global $database, $form;
        /* Username error checking */
        $subuser = $_POST[$uname];
        $field = $uname;  //Use field name for username
        if (!$subuser || strlen($subuser = trim($subuser)) == 0) {
            $form->setError($field, "* Usuario no aceptado<br>");
        } else {
            /* Make sure username is in database */
            $subuser = stripslashes($subuser);
            if (strlen($subuser) < 5 || strlen($subuser) > 30 ||
                    !preg_match("/^([0-9a-z])+$/i", $subuser) ||
                    (!$ban && !$database->usernameTaken($subuser))) {
                $form->setError($field, "* El usuario no existe<br>");
            }
        }
        return $subuser;
    }

}

;

/* Initialize process */
$adminprocess = new AdminProcess;
?>
