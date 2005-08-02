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
 * $Id: MassEmail.php,v 1.2 2005/08/02 02:34:36 bps7j Exp $
 */

include_once("Email.php");

class MassEmail {

    function sendMassEmail($user, $subject, $message, $category) {
        global $obj;
        global $cfg;

        $email =& new Email();
        $email->setFrom($user->getFullName() . " <" . $user->getEmail() . ">");
        $email->addTo($user->getFullName() . " <" . $user->getEmail() . ">");
        if (strpos($subject, "$cfg[club_name]: ") == FALSE) {
            $subject = "$cfg[club_name]: $subject";
        }
        $email->setSubject($subject);
        $email->setBody($message);
        $email->addHeader("X-$cfg[club_name]-Category", $category);
        $email->addHeader("X-$cfg[club_name]-Email", "true");
        $email->loadFooter("templates/emails/main-footer.txt");
        $email->setWordWrap(false);

        $cmd = $obj['conn']->createCommand();
        $cmd->loadQuery("sql/misc/select-opted-in-emails.sql");
        $cmd->addParameter("category", $category);
        $cmd->addParameter("active", $cfg['status_id']['active']);
        $cmd->addParameter("member", $user->getUID());
        $result = $cmd->executeReader();
        while ($row = $result->fetchRow()) {
            $email->addBCC($row['c_email']);
        }

        $email->send();
    }

}

?>
