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
 * $Id: read.php,v 1.1 2005/03/27 19:53:36 bps7j Exp $
 */

include_once("location.php");

# Create a member object that's the leader
$leader =& new member();
$leader->select($object->getOwner());

$now = date("Y-m-d H:i:s");

$template = file_get_contents("templates/adventure/read.php");

# If the member is attending the adventure, show a link to edit/view answers to
# questions
if (JoinAdventure::checkIfMemberIsAttending($object, $obj['user'])
        && $now < $object->getStartDate()) {
    $obj['attendee'] = JoinAdventure::getAttendee($obj['user'], $object);
    $template = Template::unhide($template, "VIEW_ANSWERS");
    $template = Template::replace($template, array(
        "ATTENDEE" => $obj['attendee']->getUID()));
}

# If the adventure is cancelled, display a message on the page
if ($object->getStatus() == $cfg['status_id']['cancelled']) {
    $template = Template::unhide($template, "CANCELLED");
}

# Get a list of locations so we can show their names instead of their ID
# numbers in the location field...
$result =& $obj['conn']->query("select * from [_]location "
    . "where c_uid in ($object->c_destination, $object->c_departure)");
$locations = array();
while ($row =& $result->fetchRow()) {
    $locations[$row['c_uid']] =& $row;
}

# If the member is allowed to comment, display links to do so
if (JoinAdventure::checkIfMemberIsAttending($object, $obj['user']) 
        && $now > $object->getEndDate()
        && !JoinAdventure::checkIfMemberCommented($object, $obj['user'])) {
    $template = Template::unhide($template, "COMMENT_LINK");
}

# Plug in activity types for the adventure:
$result =& $obj['conn']->query("select ac.* "
    . "from [_]adventure_activity as aa "
    . "inner join [_]activity as ac on ac.c_uid = aa.c_activity "
    . "where aa.c_adventure = " . $cfg['object']);
while ($row =& $result->fetchRow()) {
    $template = Template::block($template, "CAT",
        array_change_key_case($row, 1));
}

# If the adventure has any comments, display them
$comment = Template::extract($template, "COMMENT");
$cmd =& $obj['conn']->createCommand();
$cmd->loadQuery("sql/adventure/comment-select-for-read.sql");
$cmd->addParameter("adventure", $cfg['object']);
$result =& $cmd->executeReader();

while ($row =& $result->fetchRow()) {
    $thisComment = Template::replace($comment,
        array_change_key_case($row, 1));
    if ($row['c_flags'] & $cfg['flag']['private']) {
        $thisComment = Template::unhide($thisComment, "HIDE_NAME");
    }
    else {
        $thisComment = Template::unhide($thisComment, "SHOW_NAME");
    }
    $template = Template::replace($template, array(
        "COMMENT" => $thisComment), true);
}

if ($result->numRows()) {
    $template = Template::unhide($template, "SOME");
}

if ($object->isFull()) {
    $template = Template::unhide($template, "FULL");
}

$template = Template::replace($template, array(
    "DESTINATION_TITLE" => $locations[$object->getDestination()]['c_title'],
    "DESTINATION_ZIP" => $locations[$object->getDestination()]['c_zip_code'],
    "DEPARTURE_TITLE" => $locations[$object->getDeparture()]['c_title']));

# Show a link to the weather reports if the destination has a zip code
if ($locations[$object->getDestination()]['c_zip_code']) {
    $template = Template::unhide($template, "WEATHER");
}

$template = $object->insertIntoTemplate($template);
$res['content'] = $leader->insertIntoTemplate($template);

$res['title'] = "Adventure : "
    . substr($object->getTitle(), 0, 45)
    . (strlen($object->getTitle()) > 45 ? "..." : "");

?>
