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
 * $Id: chgrp_secondary.php,v 1.1 2005/03/27 19:53:29 bps7j Exp $
 */

$template = file_get_contents("templates/member/chgrp_secondary.php");

# Build an array of groups to let the user choose from.
$groups = array();
$cmd =& $obj['conn']->createCommand();
$cmd->loadQuery("sql/generic-select.sql");
$cmd->addParameter("table", "[_]group");
$cmd->addParameter("orderby", "c_title");
$result =& $cmd->executeReader();
while ($row =& $result->fetchRow()) {
    # 'Private' groups are not shown because they may allow privilege escalation
    # (unless the current user is root anyway)
    if ($obj['user']->isRootUser()
        || (intval($row['c_flags']) & intval($cfg['flag']['private'])) == 0)
    {
        $groups[$row['c_uid']] = $row;
    }
}

# Get a list of groups that the member already belongs to (these are MemberGroup
# objects, not Group objects), and re-key it by GROUP not by c_uid
$existing = array();
foreach ($object->getChildren("member_group", "c_member") as $key => $mg) {
    # Don't assign by reference.  Objects are already references and this will
    # cause subtle bugs (all re-keyed elements will point to the same object).
    $existing[$mg->getRelatedGroup()] = $mg;
}

# Get an array of checkboxes that the user checked
$checkboxes = postval('groups');
$posted = postval('posted');

if ($posted && !is_array($checkboxes)){
    $checkboxes = array();
}

$dirty = false;

foreach (array_keys($groups) as $group) {
    # We'll check the checkbox if the member is in the group...
    $inGroup = array_key_exists($group, $existing);
    # If the member is already in the group, and the form is submitted but the
    # checkbox isn't checked, delete the member from that group.
    if ($inGroup && $posted && !in_array($group, $checkboxes)) {
        $existing[$group]->delete(TRUE);
        $dirty = TRUE;
        $inGroup = false;
    }
    # If the member isn't already in the group, and the form is submitted and
    # the checkbox is checked, add the member to the group.
    elseif (!array_key_exists($group, $existing)
        && $posted
        && in_array($group, $checkboxes))
    {
        $mg =& new member_group();
        $mg->setMember($cfg['object']);
        $mg->setRelatedGroup($group);
        $mg->insert();
        $dirty = TRUE;
        $inGroup = true;
    }
    # Plug the info into the template row...
    $template = Template::block($template, "GROUP",
        $groups[$group]
        + array("CHECKED" => ($inGroup ? "checked" : "")));
}

if ($dirty) {
    # Say that the groups were updated.
    $template = Template::unhide($template, "SUCCESS");
}

$res['content'] = $object->insertIntoTemplate($template);
$res['title'] = "Change Group Memberships";

?>
