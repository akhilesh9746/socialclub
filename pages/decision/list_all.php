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
 * $Id: list_all.php,v 1.1 2005/03/27 19:53:25 bps7j Exp $
 */

# Create template
$template = file_get_contents("templates/decision/list_all.php");

$obj['table'] =& new table("[_]$cfg[page]");
if ($obj['table']->permits($cfg['action_id']['create'])) {
    $template = Template::unhide($template, "CREATE");
}

$cmd =& $obj['conn']->createCommand();
$cmd->loadQuery("sql/decision/list_all.sql");
$result =& $cmd->executeReader();

if ($result->numRows()) {
    $chunk = Template::extract($template, "CHUNK");
    $template = Template::delete($template, "CHUNK");
    $thisCat = "";
    $thisChunk = "";

    while ($row =& $result->fetchRow()) {
        if ($row['c_category'] != $thisCat) {
            $thisCat = $row['c_category'];
            $template = Template::replace($template,
                array("CATEGORY" => $thisChunk), 1);
            $thisChunk = Template::replace($chunk, array(
                "CATEGORY_NAME" => $row['c_category']));;
        }

        $thisChunk = Template::block($thisChunk, "ROW",
            array_change_key_case($row, 1));
    }
    $template = Template::replace($template,
        array("CATEGORY" => $thisChunk), 1);

}
else {
    $template = Template::unhide($template, "NONE");
}

$res['content'] = $template;
$res['title'] = "Officer Decisions";

?>
