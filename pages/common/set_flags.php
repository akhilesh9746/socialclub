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
 * $Id: set_flags.php,v 1.1 2005/03/27 19:53:25 bps7j Exp $
 */

$template = file_get_contents("templates/common/set_flags.php");

/*Here is a useful query for determining what the status of the object's flags
 * are, as a sanity check (not needed in this code, because we already have all
 * this information in the object and in the $cfg['flag'] array).
 *      select fl.c_title,
 *      case when (fl.c_bitmask & ob.c_flags) then 1 else 0 end as checked
 *      from [_]flag as fl, $object->table as ob
 *      where ob.c_uid = $object->c_uid
*/

# Get an array of checkboxes that the user checked
$checkboxes = postval('flags');
if (!is_array($checkboxes)) {
    $checkboxes = array();
}
$posted = (postval('posted'));

# Whether any modifications were made
$dirty = false;

foreach (array_keys($cfg['flag']) as $flag) {
    # We'll check the checkbox if the flag is set
    $set = $object->getFlag($flag);

    # If the flag is different between the object and the form, update the
    # object to match the form
    if ($posted && (in_array($flag, $checkboxes) xor $set)) {
        $object->setFlag($flag, !$object->getFlag($flag));
        $dirty = true;
        $set = !$set;
    }
    # Plug the info into the template row...
    $template = Template::block($template, "FLAG", array(
        "C_TITLE" => $flag,
        "CHECKED" => ($set ? "checked" : "")));
}

if ($dirty) {
    # Say that the flags were updated
    $object->update();
    $template = Template::unhide($template, "DIRTY");
}

# Plug it all into the template
$res['content'] = Template::replace($template, array(
    "TABLE" => get_class($object)));
$res['title'] = "Set Flags";

?>
