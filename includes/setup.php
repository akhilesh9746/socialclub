<?php
/*
 * This file is part of SocialClub (http://socialclub.sourceforge.net)
 * Copyright (C) 2004 Baron Schwartz <baron at sequent dot org>
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307  USA
 * 
 * $Id: setup.php,v 1.1 2005/03/27 19:54:21 bps7j Exp $
 *
 * Create the variables and stuff the individual pages need, including
 * setting up error handling and global variables.
 */

# Include some global functions
require_once("functions.php");

# -----------------------------------------------------------------------------
# Miscellaneous stuff
# -----------------------------------------------------------------------------

ignore_user_abort(true);
# Call srand() just once per page invocation.
srand ((double) microtime() * 1000000);

# -----------------------------------------------------------------------------
# There are ONLY FOUR global variables,
# $cfg $res, $err, and $obj.  $cfg holds config information, $res holds generated
# content to send to the browser, and $obj holds global objects.  See the end of
# this file for definitions of what's expected to be in the $res variable.  $err
# holds a list of errors that can be spit out for debugging.
# -----------------------------------------------------------------------------

$cfg = array();
$obj = array();
$err = array();
$res = array();

# Set the level of error that should trigger something to happen.
$cfg['error_types'] = array(
	E_ERROR => "E_ERROR",
	E_WARNING => "E_WARNING",
	E_PARSE => "E_PARSE",
	E_NOTICE => "E_NOTICE",
	E_CORE_ERROR => "E_CORE_ERROR",
	E_CORE_WARNING => "E_CORE_WARNING",
	E_COMPILE_ERROR => "E_COMPILE_ERROR",
	E_COMPILE_WARNING => "E_COMPILE_WARNING",
	E_USER_ERROR => "E_USER_ERROR",
	E_USER_WARNING => "E_USER_WARNING",
	E_USER_NOTICE => "E_USER_NOTICE",
	E_ALL => "E_ALL");
error_reporting(E_ALL);

# Define the levels of errors that I want to cause a webmaster email or log
define("ERROR_EMAILING", E_ERROR | E_WARNING | E_PARSE | E_CORE_ERROR
    | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING | E_USER_ERROR);
define("ERROR_LOGGING", E_ALL);

# Define a function to handle errors.  This will only handle user-defined
# errors.  The built-in errors must be handled by the output buffering.
function userErrorHandler($errno, $errstr, $errfile, $errline) {
    global $cfg;
    $logMessage = "{$cfg['error_types'][$errno]} at line $errline "
        ."in $errfile: $errstr"
        . "\r\non page $_SERVER[REQUEST_URI]"
        . "\r\nbrowser: $_SERVER[HTTP_USER_AGENT]";
    if (isset($_SERVER['HTTP_REFERER'])) {
        $logMessage .= "\r\nreferred from $_SERVER[HTTP_REFERER]";
    }
    if (isset($cfg['user'])) {
        $logMessage .= "\r\nuser: $cfg[user]";
    }
    if ((intval($errno) & ERROR_EMAILING) != 0) {
        error_log($logMessage, 1, $cfg['webmaster_email']);
    }
    if ((intval($errno) & ERROR_LOGGING) != 0) {
        error_log(date("Y-m-d h:i:s", time()) . $logMessage . "\r\n", 3, $cfg['error_log']);
    }
}
set_error_handler("userErrorHandler");

# -----------------------------------------------------------------------------
# Check for GET variables and store them in the $cfg array so there will be no
# attempts to access undefined variables.  The 'object' is initialized from the
# GET first, and if this fails from POST.
# -----------------------------------------------------------------------------
$cfg['action'] = isset($_GET['action']) ? $_GET['action'] : "";
$cfg['page']   = isset($_GET['page'])   ? $_GET['page'] : "";

$cfg['object'] = isset($_GET['object']) 
    ? intval($_GET['object']) 
    : (isset($_POST['object']) 
        ? intval($_POST['object']) 
        : 0);

# -----------------------------------------------------------------------------
# Paths and URLs.  These should NOT have a trailing slash.
# -----------------------------------------------------------------------------

# The base path on the filesystem where the website's files live
$cfg['base_path'] = str_replace("\\", "/", dirname($_SERVER['SCRIPT_FILENAME']));

# The address to the webserver that the site is hosted on.
$cfg['site_url'] = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];

# The base URL to the site.
$cfg['base_url'] = dirname($_SERVER['PHP_SELF']);
if ($cfg['base_url'] == "/") {
    $cfg['base_url'] = "";
}

# The path to any page file's action directory, assuming that $cfg[page] is
# set... this is a safe assumption as long as this variable is only used from a
# /pages/something page, which only runs if $cfg[page] is actually set.
$cfg['page_path'] = "$cfg[base_path]/pages/$cfg[page]";

# A magic value for the filename of the current page (this is the current
# page that should be executed, NOT the same as any of the built-in PHP
# variables).
$cfg['page_file'] = "$cfg[base_path]/pages/$cfg[page].php";

# Include user-defined settings.
require("includes/config.php");

# ------------------------------------------------------------------------------
# Start output buffering and name a function to be called when the buffer is
# ready for output to the browser.
# ------------------------------------------------------------------------------
ob_start('fatalErrorHandler');

# ------------------------------------------------------------------------------
# Define an error handling function.  This gets called in case the buffer, which
# the system inspects before it flushes it to the browser, contains an error.
# This is for "emergency" errors that the normal PHP error handling mechanisms
# didn't catch, and is just an intervention to make sure *something* gets done
# with the error besides just barfing all sorts of stuff out to the user.
# ------------------------------------------------------------------------------
function fatalErrorHandler(&$buffer) {
    global $cfg;

    if (ereg("error</b>:(.+)<br", $buffer, $regs)) {

        # Build error message
        $time = date("Y-m-d H:i:s");
        $userid = serialize($cfg['auth']);

        $logMessage = "
            [$time] $regs[1]
            URL:           $_SERVER[REQUEST_URI]
            Referring URL: $_SERVER[HTTP_REFERER]
            User Cookie:   $userid
            ";
        # Trim leading space off the message and log it
        $logMessage = preg_replace('/(?m)^\s*/', "", $logMessage);
        error_log($logMessage . "\r\n", 1, $cfg['webmaster_email']);
        error_log($logMessage, 3, $cfg['error_log']);
        
        # Display a friendly error message
        return "<html><head><title>Error</title></head><body>
        <h1>Fatal Error</h1>
        <p>We're sorry, but there was a fatal error while processing your 
        request.  You don't need to do anything.  The website has already
        emailed the error to the webmasters.</p></body></html>";
    }
    else {
        # All is well, so return the buffer itself; the buffer is safe to
        # display to the user.
        return $buffer;
    }
}

# Login mode.  See the comments in the header of includes/authorize.php.  Pages
# that want to require someone to log in should include authorize.php.  The
# login status indicates success or failure of the login attempt.  The
# login_password indicates if the user entered the right password.  The
# login_exists indicates if the email address even exists in the database.
$cfg['login_mode'] = "full";
$cfg['login_status'] = true;
$cfg['login_password'] = true;
$cfg['login_exists'] = true;

# The user and password
if (isset($_COOKIE['auth'])) {
    $cfg['auth'] = unserialize(base64_decode($_COOKIE['auth']));
}
else {
    $cfg['auth'] = array("user" => "", "pass" => "");
}

# Holds a list of references to objects that have been 'visited' before.  This
# is to avoid cycling when deciding which objects to delete (when cascading
# deletes).
$obj['visited-objects'] = array();

# -----------------------------------------------------------------------------
# Arrays of data that are initialized from the database.  These arrays could be
# hard coded into the pages, but for flexibility it is better to retrieve them
# from the database.  They enable you to refer to an action, status or group by
# title instead of number.  Use them like $cfg['group_id']['root']
# -----------------------------------------------------------------------------

# The status codes, created from [_]status.
$cfg['status_id'] = array();

# Actions.  The codes are in the form title => uid, and the labels are in the
# form uid => "human-readable-description".  The flipped codes are in reverse
# order so you can look up the title from the uid.  Created from [_]action.
$cfg['action_id'] = array();
$cfg['action_summary'] = array();
$cfg['action_title'] = array();

# This is a list of actions that simply can't be done without an object.  It is
# initialized from the c_flags field on [_]action in the database.
$cfg['require_object_actions'] = array();

# Usergroups, created from [_]group.
$cfg['group_id'] = array();

# Flags, set in an object's c_flags value.  Use getFlag($flagName) and
# setFlag($flagName, bool) on any DatabaseObject class.  Populated from [_]flags.
$cfg['flag'] = array();

# Unix permission bitmasks, set in an object's c_unixperms and used the same as
# flags.  Populated from [_]unixperms.
$cfg['perm'] = array();

# Tables in the database.  There are actually a few other tables that are "meta"
# tables; these are the ones that hold information the PHP can manipulate in a
# uniform way.
$cfg['tables'] = array();

# Require various classes
include_once("table.php");
include_once("Template.php");
include_once("XmlForm.php");

# You need to include this file after the ones above or PHP will throw an
# "undefined class DatabaseObject" from Privilege.php
include_once("member.php");

# ------------------------------------------------------------------------------
# The following indices are defined in the $res array:
# Index         Meaning
# -----         -------
# title         Page title
# content       Content that the page generates; higher-level pages can handle
#               it as they see fit.
# description   The description META tag
# keywords      The keywords META tag
# navbar        The navbar contents
# tabs          The tabbed-box tabs HTML
# ------------------------------------------------------------------------------
$res['keywords'] = "";
$res['description'] = "";
$res['title'] = "";
$res['navbar'] = "Home";
$res['tabs'] = "";
$res['meta'] = "";

# ------------------------------------------------------------------------------
# Create global objects
# ------------------------------------------------------------------------------

# Create the database connection
include_once("{$cfg['db']['type']}.php");
$obj['conn'] =& new $cfg['db']['type']($cfg['db']);
$obj['conn']->open();

# ----------------------------------------------------------------------------
# Perform any Magical Initialization that needs to be done.
# ----------------------------------------------------------------------------
# Set up the flags
$result =& $obj['conn']->query("select c_title, c_bitmask from [_]flag");
while ($row =& $result->fetchRow()) {
    $cfg['flag'][$row['c_title']] = intval($row['c_bitmask']);
}

# Set up the permission flags
$result =& $obj['conn']->query("select c_title, c_bitmask from [_]unixperm");
while ($row =& $result->fetchRow()) {
    $cfg['perm'][$row['c_title']] = intval($row['c_bitmask']);
}

# Set up the status codes
$result =& $obj['conn']->query("select c_title, c_uid from [_]status order by c_uid");
while ($row =& $result->fetchRow()) {
    $cfg['status_id'][$row['c_title']] = $row['c_uid'];
}

# Set up the action codes and labels, and list of actions that require
# an object
$result =& $obj['conn']->query("select c_title, c_uid, c_flags, "
    . "c_summary from [_]action order by c_uid");
while ($row =& $result->fetchRow()) {
    $cfg['action_id'][$row['c_title']] = $row['c_uid'];
    $cfg['action_summary'][$row['c_uid']] = $row['c_summary'];
    if (intval($row['c_flags']) & $cfg['flag']['applies_to_object']) {
        $cfg['require_object_actions'][] = $row['c_uid'];
    }
}

# Set up the flipped action codes
$cfg['action_title'] = array_flip($cfg['action_id']);

# Set up the group codes
$result =& $obj['conn']->query("select c_title, c_uid from [_]group order by c_uid");
while ($row =& $result->fetchRow()) {
    $cfg['group_id'][$row['c_title']] = $row['c_uid'];
}

# Set up tables
$result =& $obj['conn']->query("select c_name from [_]table order by c_name");
while ($row =& $result->fetchRow()) {
    $cfg['tables'][] = $row['c_name'];
}

?>
