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
 * $Id: email_attendees.php,v 1.1 2005/03/27 19:53:34 bps7j Exp $
 */

include_once("Email.php");
include_once("location.php");

$template = file_get_contents("templates/adventure/email_attendees.php");

$error = false;

# Ensure that the adventure is active.
if ($object->getStatus() != $cfg['status_id']['active']) {
    $template = Template::unhide($template, "ACTIVE");
    $error = true;
}

# Create the form.
$form =& new XMLForm("forms/adventure/email_attendees.xml");

# Validate the form
$form->snatch();
$form->validate();

if (!$error && $form->isValid()) {
    $leader =& new member();
    $leader->select($object->getOwner());

    $email =& new Email();
    $email->setFrom($obj['user']->getEmail());
    $email->addTo($leader->getEmail());
    foreach ($object->getChildren("attendee") as $key => $attendee) {
        if ($form->getValue("who") == "all"
            || ($form->getValue("who") == "joined"
                && $attendee->getStatus() == $cfg['status_id']['default'])
            || ($form->getValue("who") == "waitlisted"
                && $attendee->getStatus() == $cfg['status_id']['waitlisted']))
        {
            $member =& new member();
            $member->select($attendee->getMember());
            $email->addBCC($member->getEmail());
        }
    }
    $email->setSubject($form->getValue("subject"));
    $email->setBody($form->getValue("message"));
    $email->setWordWrap(TRUE);
    $email->loadFooter("templates/emails/footer.txt");
    $email->send();
    $template = Template::unhide($template, "SUCCESS");
    $template = Template::replace($template, array("MESSAGE" => $email->toString()));
}
elseif (!$error) {
    $template = Template::unhide($template, "CONFIRM");
    $template = Template::replace($template, array("FORM" => $form->toString()));
}

$res['content'] = $object->insertIntoTemplate($template);
$res['title'] = "Email Adventure Attendees";

?>
