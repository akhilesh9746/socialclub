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
 * $Id: create.php,v 1.2 2005/08/02 03:05:05 bps7j Exp $
 */

# Create templates
$template = file_get_contents("templates/checkout_item/create.php");

$form =& new XMLForm("forms/checkout_item/create.xml");
$form->snatch();
$form->validate();

$found = false;

if ($form->isValid()) {
    $cmd = $obj['conn']->createCommand();
    $cmd->loadQuery("sql/item/check-can-checkout.sql");
    $cmd->addParameter("item", $form->getValue("item"));
    $cmd->addParameter("checkout", $form->getValue("checkout"));
    $cmd->addParameter("checked_in", $cfg['status_id']['checked_in']);
    $found = ($cmd->executeScalar() > 0);
    if ($found) {
        # Add the new checkout_item to the checkout, then redirect back to the checkout
        $object =& new checkout_item();
        $object->setCheckout($form->getValue("checkout"));
        $object->setItem($form->getValue("item"));
        $object->insert();
        redirect("$cfg[base_url]/members/checkout/write/" . $form->getValue("checkout"));
    }
}

# Display the form and force the user to fix the mistake.
if (!$found) {
    $template = Template::unhide($template, "notfound");
}

$res['content'] = Template::replace($template, array(
    "form" => $form->toString()));

$res['title'] = "Add an Item to Check Out";

?>
