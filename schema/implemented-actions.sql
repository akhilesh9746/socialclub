/*
 * This file is part of SocialClub (http://socialclub.sourceforge.net)
 * Copyright (C) 2004 Baron Schwartz <baron at sequent dot org>
 *
 * This program is free software.  You can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation, either version 2 of the License, or (at your option) any
 * later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY, without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program.  If not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307  USA
 *
 * $Id: implemented-actions.sql,v 1.1 2005/03/27 19:54:11 bps7j Exp $
 *
 * Create correspondences between tables and actions to say which actions apply
 * to which tables.
 */

delete from [_]implemented_action;

insert into [_]implemented_action (c_table, c_action)
    select "[_]checkout", c_uid from [_]action
    where c_title in ("accept", "check_in");

insert into [_]implemented_action (c_table, c_action)
    select "[_]expense_submission", c_uid from [_]action
    where c_title in ("submit", "accept");

insert into [_]implemented_action (c_table, c_action)
    select "[_]adventure", c_uid from [_]action
    where c_title in ("join", "withdraw", "edit_questions", "choose_activities",
        "view_report", "announce", "activate", "deactivate", "email_attendees",
        "comment", "view_waitlist");

insert into [_]implemented_action (c_table, c_action)
    select "[_]attendee", c_uid from [_]action
    where c_title in ("withdraw", "join", "waitlist", "mark_absent", "list_debts",
        "view_answers");

insert into [_]implemented_action (c_table, c_action)
    select "[_]item_type", c_uid from [_]action
    where c_title in ("edit_features");

insert into [_]implemented_action (c_table, c_action)
    select "[_]item", c_uid from [_]action
    where c_title in ("edit_features", "view_notes", "view_history");

insert into [_]implemented_action (c_table, c_action)
    select "[_]location", c_uid from [_]action
    where c_title in ("choose_activities");

insert into [_]implemented_action (c_table, c_action)
    select "[_]membership", c_uid from [_]action
    where c_title in ("activate");

insert into [_]implemented_action (c_table, c_action)
    select "[_]member", c_uid from [_]action
    where c_title in ("chgrp_secondary", "view_absences", "su",
        "change_password", "view_history", "choose_activities", "view_notes",
        "optout", "view_waitlist");

insert into [_]implemented_action (c_table, c_action)
    select "[_]report", c_uid from [_]action
    where c_title in ("execute");

insert into [_]implemented_action (c_table, c_action)
    select "[_]group", c_uid from [_]action
    where c_title in ("view_members");

insert into [_]implemented_action (c_table, c_action)
    select "[_]subscription", c_uid from [_]action
    where c_title in ("unsubscribe");

insert into [_]implemented_action (c_table, c_action)
    select "[_]email_list", c_uid from [_]action
    where c_title in ("subscribe", "view_members");

insert into [_]implemented_action (c_table, c_action)
    select "[_]classified_ad", c_uid from [_]action
    where c_title in ("deactivate");

insert into [_]implemented_action (c_table, c_action)
    select "[_]decision", c_uid from [_]action
    where c_title in ("add_xref");

insert into [_]implemented_action (c_table, c_action)
    select "[_]expense_report", c_uid from [_]action
    where c_title in ("submit", "accept", "view_notes");

-- These actions apply to ALL tables
insert into [_]implemented_action (c_table, c_action)
    select "", c_uid from [_]action
    where c_title in ("read", "write", "delete", "list_all", "list_owned_by",
        "create", "stat", "chmod", "chgrp", "chown", "chmeta", "view_acl",
        "set_flags", "copy", "add_privilege");
