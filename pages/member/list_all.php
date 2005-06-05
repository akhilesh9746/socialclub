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
 * $Id: list_all.php,v 1.2 2005/06/05 18:03:36 bps7j Exp $
 */

$template = file_get_contents("templates/member/list_all.php");

# Create the form
$formT = file_get_contents("forms/member/list_all.xml");
if ($obj['user']->isInGroup('root') || $obj['user']->isInGroup('officer')) {
    $formT = Template::unhide($formT, "HIDDEN");
}

$form =& new XmlForm(Template::finalize($formT), true);
$form->snatch();

# Show the members in a list.  Don't show information that the user isn't
# supposed to see if it's private (email address, primary phone number).  Also
# don't show members that don't have an active membership.

$cmd =& $obj['conn']->createCommand();
$cmd->loadQuery("sql/member/list_all.sql");

# Add filter criteria.
$nameCrit = $form->getValue("name");
$emailCrit = $form->getValue("email");
if ($nameCrit != '' && $nameCrit != '[name]') {
    $cmd->addParameter("name", "%$nameCrit%");
}
if ($emailCrit != '' && $emailCrit != '[email]') {
    $cmd->addParameter("email", "%$emailCrit%");
}
if ($obj['user']->isInGroup('root') || $obj['user']->isInGroup('officer')) {
    if ($form->getValue("view_inactive")) {
        $cmd->addParameter("view_inactive", 1);
    }
    if ($form->getValue("view_private")) {
        $cmd->addParameter("view_private", 1);
    }
}

# Add constants.
$cmd->addParameter("email_private", $cfg['flag']['email_private']);
$cmd->addParameter("private", $cfg['flag']['private']);
$cmd->addParameter("primary", $cfg['flag']['primary']);
$cmd->addParameter("active", $cfg['status_id']['active']);
$cmd->addParameter("hide_info", 
    (($obj['user']->isRootUser() || $obj['user']->isInGroup("leader")) ? 0 : 1));

$result =& $cmd->executeReader();

while ($row =& $result->fetchRow()) {
    $template = Template::block($template, "ROW", $row);
}

if ($result->numRows()) {
    $template = Template::unhide($template, "SOME");
}
else {
    $template = Template::unhide($template, "NONE");
}

$res['title'] = "Member Directory";
$res['content'] = Template::replace($template, array(
    "form" => $form->toString()));

?>
