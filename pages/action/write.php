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
 * $Id: write.php,v 1.1 2005/03/27 19:53:21 bps7j Exp $
 */

$template = file_get_contents("templates/action/write.php");

# Create the form.  Initialize it, then overwrite that with form data.
$form =& new XmlForm("forms/action/write.xml");

$form->setValue("title", $object->getTitle());
$form->setValue("summary", $object->getSummary());
$form->setValue("label", $object->getLabel());
$form->setValue("row", $object->getRow());
$form->setValue("description", $object->getDescription());
$form->setValue("apply-object", (int) $object->getFlag("applies_to_object"));

$form->snatch();
$form->validate();

if ($form->isValid()) {
    $object->setTitle($form->getValue("title"));
    $object->setSummary($form->getValue("summary"));
    $object->setLabel($form->getValue("label"));
    $object->setRow($form->getValue("row"));
    $object->setDescription($form->getValue("description"));
    $object->setFlag("applies_to_object", $form->getValue("apply-object"));
    $object->update();

    $template = Template::unhide($template, "SUCCESS");
}

$res['content'] = Template::replace($template,
    array("FORM" => $form->toString()));
$res['title'] = "Edit Action Details";

?>
