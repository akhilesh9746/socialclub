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
 * $Id: JoinClub.php,v 1.1 2005/03/27 19:54:05 bps7j Exp $
 */
// {{{require statements
include_once("Email.php");
include_once("membership_type.php");
include_once("member_group.php");
include_once("membership.php");
//}}}

class JoinClub {
    /* {{{checkIfMemberExists
     *
     */
    function checkIfMemberExists($email) {
        global $obj;
        $select = "select c_uid from [_]member where c_email={email,char,60} "
            . "and c_deleted <> 1";
        $result = $obj['conn']->query($select, array('email' => $email));
        return ($result->numRows() > 0);
    } //}}}

    /* {{{createAndStoreObjects
     *
     */
    function createAndStoreObjects(&$form) {
        global $obj;
        global $cfg;

        $member =& new member();
        $member->setOwner($cfg['root_uid']);
        $member->setCreator($cfg['root_uid']);
        $member->setEmail($form->getValue('emailAddress'));
        $member->setPassword($form->getValue('password1'));
        $member->setFirstName($form->getValue('firstName'));
        $member->setLastName($form->getValue('lastName'));
        $member->setBirthDate($form->getValue('dob'));
        $member->setGender($form->getValue('gender'));
        $member->setFlag("receive_email", true);
        $member->setFlag("student", $form->getValue("student"));
        $member->insert();

        # Set the user's ID
        $cfg['user'] = $member->getUID();

        # Insert a new member_group for the user
        $mg =& new member_group();
        $mg->setOwner($cfg['root_uid']);
        $mg->setMember($member->getUID());
        $mg->setRelatedGroup($cfg['group_id']['member']);
        $mg->insert();

        $address =& new address();
        $address->setTitle("Main Address");
        $address->setStreet($form->getValue('street'));
        $address->setCity($form->getValue('city'));
        $address->setState($form->getValue('state'));
        $address->setZIP($form->getValue('zip'));
        $address->setCountry('US');
        $address->setFlag("primary", true);
        $address->insert();

        $phone =& new phone_number();
        $phone->setTitle("Phone Number");
        $phone->setAreaCode($form->getValue('areaCode'));
        $phone->setExchange($form->getValue('exchange'));
        $phone->setNumber($form->getValue('number'));
        $phone->setType($form->getValue("phoneNumberType"));
        $phone->setFlag("primary", true);
        $phone->insert();

        # Insert the chat identity, if it exists
        if ($form->getValue("chat")) {
            $chat =& new chat();
            $chat->setType($form->getValue("chatType"));
            $chat->setScreenName($form->getValue("chat"));
            $chat->setFlag("primary", true);
            $chat->insert();
        }

        # Create a new membership
        $type =& new membership_type();
        $type->select($form->getValue("membership-plan"));
        $mem =& new membership();
        $mem->setOwner($cfg['root_uid']);
        $mem->setType($form->getValue("membership-plan"));
        $mem->setBeginDate($type->getBeginDate());
        $mem->setExpirationDate($type->getExpirationDate());
        $mem->setTotalCost($type->getTotalCost());
        $mem->setUnitsGranted($type->getUnitsGranted());
        $mem->setUnit($type->getUnit());
        $mem->setMember($member->getUID());
        $mem->insert();

        # Send an email to the member
        $body = file_get_contents("templates/emails/final-instructions.txt");
        $email =& new Email();
        $email->setFrom($cfg['club_admin_email_name']);
        $email->addHeader("Return-Path", $cfg['club_admin_email']);
        $email->setSubject("Your $cfg[club_name] Membership");
        $email->addTo($member->getEmail());
        $emailVals = array(
            "C_FULL_NAME" => $member->getFullName(),
            "CLUB_NAME" => $cfg['club_name'],
            "MEMBERSHIP" => $type->getTitle(),
            "FEE" => $type->getTotalCost());
        $body = Template::replace($body, $emailVals);
        $email->setBody(Template::finalize($body));
        $email->loadFooter("templates/emails/footer.txt");
        $email->send();

        # Redirect the user to the next step!
        # Set a cookie first, so he doesn't have to log in to get there...
        setcookie("user", $member->getUID(), null, "/");
        redirect("$cfg[base_url]/members/join/final-instructions");
    } //}}}

}
?>
