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
 * $Id: create.php,v 1.1 2005/03/27 19:53:21 bps7j Exp $
 */

$template = file_get_contents("templates/action/create.php");

$form =& new XmlForm("forms/action/create.xml");
$form->snatch();
$form->validate();

if ($form->isValid()) {
    $object =& new action();
    $object->setTitle($form->getValue("title"));
    $object->setSummary($form->getValue("summary"));
    $object->setLabel($form->getValue("label"));
    $object->setRow($form->getValue("row"));
    $object->setDescription($form->getValue("description"));
    $object->setFlag("applies_to_object", intval($form->getValue("apply-object")));
    $object->insert();
    redirect("$cfg[base_url]/members/action/read/$object->c_uid");
}
else {
    $template = Template::unhide($template, "INSTRUCTIONS");
    $res['content'] = Template::replace($template, array(
        "FORM" => $form->toString()));
    $res['title'] = "Create New Action";
}


?>
