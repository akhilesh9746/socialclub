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
 * $Id: accept.php,v 1.2 2005/08/02 03:05:22 bps7j Exp $
 */

# The lifecycle of an expense report is in its statuses.  It goes from default
# to pending to paid.  At each step a note is added.  When it goes from default
# to pending, its owner is set to root so the original owner can no longer edit
# it (and the expenses themselves are chowned root).  When it goes from pending
# to paid, the treasurer can mark the expenses as reimbursable.

if (isset($_POST['submitted'])) {
    if (isset($_POST['expense']) && is_array($_POST['expense'])) {
        $cmd = $obj['conn']->createCommand();
        $cmd->loadQuery("sql/expense/mark-reimbursable.sql");
        foreach ($_POST['expense'] as $id) {
            $cmd->addParameter("expense", $id);
            $cmd->executeNonQuery();
        }
    }

    # Add transactions to record that the expenses were paid
    $cmd = $obj['conn']->createCommand();
    $cmd->loadQuery("sql/expense_report/accept-to-paid.sql");
    $cmd->addParameter("report", $cfg['object']);
    $cmd->addParameter("member", $cfg['user']);
    $cmd->addParameter("from", $cfg['root_uid']);
    $cmd->executeNonQuery();

    $object->setStatus($cfg['status_id']['paid']);
    $object->addNote();
    $object->update();
}

if ($object->getStatus() != $cfg['status_id']['pending']
    || isset($_POST['submitted']))
{
    redirect("$cfg[base_url]/members/expense_report/read/$cfg[object]");
}

$template = file_get_contents("templates/expense_report/accept.php");
$cmd = $obj['conn']->createCommand();
$cmd->loadQuery("sql/expense_report/select-expenses.sql");
$cmd->addParameter("report", $cfg['object']);
$result = $cmd->executeReader();
while ($row = $result->fetchRow()) {
    $template = Template::block($template, "expense", $row);
}

$res['content'] = $template;
$res['title'] = "Accept Expense Report";

?>
