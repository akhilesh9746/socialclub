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
 * $Id: implemented-actions.sql,v 1.2 2005/06/05 18:07:47 bps7j Exp $
 *
 * Create correspondences between tables and actions to say which actions apply
 * to which tables.
 */

delete from [_]implemented_action;

-- These actions apply to ALL tables.  These are the defaults.
insert into [_]implemented_action (c_table, c_action)
    select c_name, c_title
    from [_]action, [_]table
    where c_title in ("read", "write", "delete", "list_all", "list_owned_by",
        "create", "stat", "chmod", "chgrp", "chown", "chmeta", "view_acl",
        "set_flags", "copy", "add_privilege");

insert into [_]implemented_action (c_table, c_action, c_status)
values 
    ("[_]checkout", "accept", 1),
    ("[_]checkout", "check_in", 256);
-- Only allow editing when it is in default status.
update [_]implemented_action set c_status = 1
where c_table = "[_]checkout" and c_action = "write";

insert into [_]implemented_action (c_table, c_action, c_status)
values
    ("[_]expense_submission", "accept", 2048),
    ("[_]expense_submission", "submit", 1);
-- Only allow editing when it is in default status.
update [_]implemented_action set c_status = 1
where c_table = "[_]expense_submission" and c_action = "write";

insert into [_]implemented_action (c_table, c_action, c_status)
values
    ("[_]adventure", "join", 9),
    ("[_]adventure", "withdraw", 8),
    ("[_]adventure", "edit_questions", 0),
    ("[_]adventure", "choose_activities", 0),
    ("[_]adventure", "view_report", 0),
    ("[_]adventure", "announce", 8),
    ("[_]adventure", "activate", 5),
    ("[_]adventure", "email_attendees", 8),
    ("[_]adventure", "comment", 8),
    ("[_]adventure", "view_waitlist", 8);

insert into [_]implemented_action (c_table, c_action, c_status)
values
    ("[_]attendee", "withdraw", 1),
    ("[_]attendee", "join", 16),
    ("[_]attendee", "waitlist", 1),
    ("[_]attendee", "mark_absent", 1),
    ("[_]attendee", "view_answers", 0);

insert into [_]implemented_action (c_table, c_action)
    select "[_]item_type", c_title from [_]action
    where c_title in ("edit_features");

insert into [_]implemented_action (c_table, c_action)
    select "[_]item", c_title from [_]action
    where c_title in ("edit_features", "view_notes", "view_history");

insert into [_]implemented_action (c_table, c_action)
    select "[_]location", c_title from [_]action
    where c_title in ("choose_activities");

insert into [_]implemented_action (c_table, c_action, c_status)
values
    ("[_]membership", "activate", 4);

insert into [_]implemented_action (c_table, c_action)
    select "[_]member", c_title from [_]action
    where c_title in ("chgrp_secondary", "view_absences", "su",
        "change_password", "view_history", "choose_activities", "view_notes",
        "optout", "view_waitlist");

insert into [_]implemented_action (c_table, c_action)
    select "[_]report", c_title from [_]action
    where c_title in ("execute");

insert into [_]implemented_action (c_table, c_action)
    select "[_]subscription", c_title from [_]action
    where c_title in ("unsubscribe");

insert into [_]implemented_action (c_table, c_action)
    select "[_]email_list", c_title from [_]action
    where c_title in ("subscribe", "view_members");

insert into [_]implemented_action (c_table, c_action, c_status)
values
    ("[_]classified_ad", "deactivate", 9);

insert into [_]implemented_action (c_table, c_action, c_status)
values
    ("[_]expense_report", "submit", 1),
    ("[_]expense_report", "accept", 64),
    ("[_]expense_report", "view_notes", 0);
