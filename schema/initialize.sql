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
 * $Id: initialize.sql,v 1.1 2005/03/27 19:54:06 bps7j Exp $
 *
 */

insert into [_]table
    (c_name)
    values
    ("[_]absence"),
    ("[_]action"),
    ("[_]activity"),
    ("[_]activity_category"),
    ("[_]address"),
    ("[_]adventure"),
    ("[_]adventure_activity"),
    ("[_]adventure_comment"),
    ("[_]answer"),
    ("[_]attendee"),
    ("[_]chat"),
    ("[_]chat_type"),
    ("[_]checkout"),
    ("[_]checkout_gear"),
    ("[_]checkout_item"),
    ("[_]classified_ad"),
    ("[_]condition"),
    ("[_]decision"),
    ("[_]decision_category"),
    ("[_]decision_xref"),
    ("[_]email_list"),
    ("[_]expense"),
    ("[_]expense_category"),
    ("[_]expense_report"),
    ("[_]expense_report_note"),
    ("[_]expense_submission"),
    ("[_]expense_submission_expense"),
    ("[_]group"),
    ("[_]interest"),
    ("[_]item"),
    ("[_]item_note"),
    ("[_]item_feature"),
    ("[_]item_category"),
    ("[_]item_type_feature"),
    ("[_]item_type"),
    ("[_]location"),
    ("[_]location_activity"),
    ("[_]member"),
    ("[_]member_group"),
    ("[_]member_note"),
    ("[_]membership"),
    ("[_]membership_type"),
    ("[_]optout"),
    ("[_]phone_number"),
    ("[_]phone_number_type"),
    ("[_]privilege"),
    ("[_]question"),
    ("[_]rating"),
    ("[_]report"),
    ("[_]status"),
    ("[_]subscription"),
    ("[_]transaction");

-- These values must NOT be changed.  They define the bitmasks that give meaning
-- to the c_unixperms column on tables.  They are in descending order to match
-- the way you would read the bits (from left to right).
insert into [_]unixperm
    (c_title, c_bitmask)
    values
    ("owner_read",  256),
    ("owner_write", 128),
    ("owner_delete", 64),
    ("group_read",   32),
    ("group_write",  16),
    ("group_delete",  8),
    ("other_read",    4),
    ("other_write",   2),
    ("other_delete",  1);

-- These values must NOT be changed.  They define various bitmasks on lots of
-- different objects, via the c_flags column.
insert into [_]flag (c_title, c_bitmask) values
    ("private",                   1),
    ("email_private",             2),
    ("imported",                  4),
    ("student",                   8),
    ("flexible",                 16),
    ("has_photo",                32),
    ("receive_email",            64),
    ("reimbursable",            128),
    ("applies_to_object",       256),
    ("primary",                 512),
    ("member_agreement",       1024),
    ("generic",                2048);

insert into [_]action (c_created_date, c_title, c_summary, c_label, c_description) values
      (now(), 'read', "View Details", '&Details', 'Read and display the contents of an object'),
      (now(), 'write', "Edit or Update", 'Edit', 'Edit (modify or update) the object'),
      (now(), 'delete', "Delete", 'De&lete', 'Delete the object or mark it as deleted'),
      (now(), 'list_all', 'List All Objects', "List All Objects", 'List all objects of the given type'),
      (now(), 'list_owned_by', 'List Objects I Own', "List Objects I Own", 'List all objects of the given type that the member owns'),
      (now(), 'view_history', "View History", 'Histor&y', 'View a history of the object'),
      (now(), 'create', "Create", 'Create', 'Create an object of the given type'),
      (now(), 'activate', "Activate", 'A&ctivate', 'Activate the object'),
      (now(), 'deactivate', "Deactivate", "Deactiv&ate", 'Deactivate the object'),
      (now(), 'join', "Join", "&Join", 'Join the adventure'),
      (now(), 'copy', 'Copy Object', 'Cop&y', "Make another object with identical data"),
      (now(), 'withdraw', "Withdraw", '&Withdraw', 'The opposite of join'),
      (now(), 'edit_questions', "Edit Questions", 'Edit &Questions', 'Create or edit questions for an adventure'),
      (now(), 'choose_activities', "Choose Activities", 'C&hoose Activities', 'Choose which type(s) of activity applies to this adventure'),
      (now(), 'view_report', "View Report", "View Re&port", 'View a report on attendees'),
      (now(), 'announce', "Announce", "A&nnounce", 'Announce the adventure to the main email list'),
      (now(), 'stat', "View Properties", 'P&roperties', "View meta-data about an object, such as its owner and date of creation"),
      (now(), 'chmod', "Change Permissions", "&Change Permissions", 'Change Unix-style permissions for an object'),
      (now(), 'chgrp', "Change Group", "Change &Group", "Change the object's primary group"),
      (now(), "chown", "Change Owner", "Cha&nge Owner", "Change the object's owner"),
      (now(), "chmeta", "Change Meta-Data", "Edit &Properties", "Change the object's attributes, such as status, owner, and so forth"),
      (now(), "view_acl", "View ACL", "View &ACL", "View the object's Access Control List (Privileges)"),
      (now(), 'chgrp_secondary', "Change Group Memberships", "Change Group Memberships", "Change the member's secondary groups"),
      (now(), "change_password", "Change Password", "Change &Password", "Change a member's password"),
      (now(), "view_waitlist", "View Waitlist", "View Wait&list", "View the adventure's waitlist"),
      (now(), "execute", "Execute", "E&xecute", "Execute the object (mostly used for reports)"),
      (now(), "email_attendees", "Email Attendees", "Emai&l Attendees", "Email all attendees for an adventure"),
      (now(), "waitlist", "Waitlist", "W&aitlist", "Move an attendee onto an adventure's waitlist"),
      (now(), "mark_absent", "Mark Absent", "Mar&k Absent", "Mark an attendee as absent from an adventure"),
      (now(), "view_absences", "View Absences", "View A&bsences", "View all times this member has been absent from an adventure"),
      (now(), "view_members", "View Members", "View &Members", "View members that belong to this group"),
      (now(), "view_notes", "View Notes", "View &Notes", "View notes on the object"),
      (now(), "view_answers", "View Answers", "View An&swers", "View answers to the questions for this adventure"),
      (now(), "comment", "Comment", "Commen&t", "Comment on this item"),
      (now(), "set_flags", "Set Flags", "Set &Flags", "Set preference flags on this item"),
      (now(), "cancel", "Cancel", "Cancel", "Cancel"),
      (now(), "add_privilege", "Add Privilege", "Add Pri&vilege", "Add Privilege"),
      (now(), "subscribe", "Subscribe", "Subscribe", "Subscribe"),
      (now(), "su", "Switch User", "&Switch User", "Become another member"),
      (now(), "edit_features", "Edit Features", "Edit Feat&ures", "Edit the object's features"),
      (now(), 'add_xref', "Add X-Ref", 'Add &X-Ref', 'Add a cross-reference'),
      (now(), "unsubscribe", "Unsubscribe", "&Unsubscribe", "Unsubscribe"),
      (now(), 'optout', "Opt Out", '&Opt Out', 'Opt out of emails'),
      (now(), 'submit', "Submit", '&Submit', 'Submit an Expense Report'),
      (now(), 'accept', "Accept", '&Accept', 'Accept an Expense Report');

update [_]action as ac
    inner join [_]flag as fl on fl.c_title = 'applies_to_object'
set ac.c_flags = ac.c_flags | fl.c_bitmask
    where ac.c_title not in ('list_all', 'list_owned_by', 'create');

insert into [_]decision_category (c_created_date, c_title)
    values (now(), "General");

insert into [_]expense_category (c_title)
    values
    ("Food"),
    ("Gas"),
    ("Lodging"),
    ("Other"),
    ("Registration Fee"),
    ("Equipment"),
    ("Membership Dues"),
    ("Rental Fee"),
    ("Postage"),
    ("Participation Fee"),
    ("Equipment Repair");

-- Specify which actions should appear on the 'generic' set of tabs, and which
-- should appear on the tabs specific to the object:

update [_]action, [_]flag set c_flags = c_flags | c_bitmask
where [_]action.c_title in ("stat", "chmod", "chmeta", "delete",
        "view_acl", "chgrp", "chown", "set_flags", "add_privilege")
    and [_]flag.c_title = 'generic';

update [_]action, [_]flag, [_]flag as object_flag set c_flags = c_flags | [_]flag.c_bitmask
where [_]action.c_title not in ("chmod", "chmeta", "delete", "add_xref",
        "view_acl", "chgrp", "chown", "set_flags", "add_privilege")
    and [_]flag.c_title = 'specific'
    and object_flag.c_title = 'applies_to_object';

update [_]action set c_row = 1 where c_title in ("chmod", "chgrp", "chown",
        "view_acl", "add_privilege");

-- Adventure ratings

insert into [_]rating
    (c_title)
    values
    ("Poor"), ("Fair"), ("Average"), ("Good"), ("Excellent");

insert into [_]address
    (c_title, c_street, c_city, c_state, c_zip, c_country, c_flags)
    select
    "Main Club Address", "SocialClub", "SomeTown", "VA",
    12345, "US", c_bitmask
    from [_]flag where c_title = "primary";

insert into [_]phone_number_type
    (c_owner, c_created_date, c_title, c_description, c_abbreviation)
    values
    (1, now(), "Default", "Default phone number type", ""),
    (1, now(), "Cell", "Cellular phone", "(c)"),
    (1, now(), "Work", "Work phone", "(w)"),
    (1, now(), "School", "School phone", "(sch)"),
    (1, now(), "Home", "Home phone", "(h)");

insert into [_]phone_number
    (c_title, c_country_code, c_area_code, c_exchange, c_number,
    c_flags, c_phone_number)
    select
        "Main Club Phone Number", "1", "123", "456", "7890",
        c_bitmask, "(123) 456-7890"
    from [_]flag where c_title = 'primary';

-- Making a group private means it does not show up as an option in
-- chmod_secondary unless you are a root user.
insert into [_]group
    (c_owner, c_created_date, c_title, c_description, c_flags)
    values
    (1, now(), "root", "Administrative user (use with caution!)", 1),
    (1, now(), "officer", "Club officer", 0),
    (1, now(), "treasurer", "Responsible for finances, can activate members", 0),
    (1, now(), "leader", "Can create and lead adventures", 0),
    (1, now(), "quartermaster", "Manages equipment and inventory", 0),
    (1, now(), "member", "Ordinary member of the Club", 0),
    (1, now(), "guest", "Restricted user for demonstration purposes", 0),
    (1, now(), "wheel", "Allowed to take the su (switch user) action (caution!)", 1);

insert into [_]activity_category
    (c_created_date, c_title)
    values
    (now(), "Everything Else"),
    (now(), "Biking"),
    (now(), "Camping and Backpacking"),
    (now(), "Climbing"),
    (now(), "Day Hiking and Running"),
    (now(), "Service"),
    (now(), "Winter Sports"),
    (now(), "Water Sports");

insert into [_]condition
    (c_owner, c_created_date, c_title, c_rank, c_description)
    values
    (1, now(), "unknown", 0, "Unknown"),
    (1, now(), "unsafe", 1, "Unsafe"),
    (1, now(), "unusable", 2, "Unusable"),
    (1, now(), "poor", 3, "Extremely poor condition"),
    (1, now(), "dirty", 4, "Dirty condition"),
    (1, now(), "fair", 5, "Fair condition"),
    (1, now(), "good", 6, "Good condition"),
    (1, now(), "excellent", 7, "Almost mint, but not quite"),
    (1, now(), "mint", 8, "Absolutely factory new, except not brand new"),
    (1, now(), "brand_new", 9, "Brand new");

insert into [_]status
    (c_owner, c_created_date, c_title, c_description)
    values
    (1, now(), "default", "The item exists"),
    (1, now(), "deleted", "The item is marked as deleted"),
    (1, now(), "inactive", "The item is inactive"),
    (1, now(), "active", "The item is active"),
    (1, now(), "waitlisted", "The member is on the adventure's waitlist"),
    (1, now(), "cancelled", "The object (probably an adventure) is cancelled"),
    (1, now(), "pending", "The object is pending, such as a membership that is pending activation"),
    (1, now(), "paid", "The object is paid for"),
    (1, now(), "checked_out", "The object is checked out"),
    (1, now(), "checked_in", "The object is checked in"),
    (1, now(), "missing", "The object is missing or lost"),
    (1, now(), "submitted", "The object has been submitted");

insert into [_]item_category
    (c_created_date, c_title)
    values
    (now(), "No Category");

insert into [_]member
    (c_created_date, c_status, c_first_name, c_last_name, c_email, c_password,
    c_gender, c_birth_date, c_full_name, c_flags)
    select now(), c_uid, "Club", "Manager", "admin@socialclub.org", "root",
      "m", '2001-01-01', "Club Manager", c_bitmask
    from [_]status inner join [_]flag
    where [_]status.c_title = "active" and [_]flag.c_title = "private";

insert into [_]member
    (c_created_date, c_status, c_first_name, c_last_name, c_email, c_password,
    c_gender, c_birth_date, c_full_name, c_flags)
    select now(), c_uid, "Guest", "Guest", "guest@socialclub.org", "guest",
      "m", '2000-01-01', "Guest Guest", c_bitmask
    from [_]status inner join [_]flag
    where [_]status.c_title = "active" and [_]flag.c_title = "private";

insert into [_]member_group
    (c_created_date, c_member, c_related_group)
    select now(), me.c_uid, gr.c_uid
    from [_]member as me
        inner join [_]group as gr on gr.c_title = 'root'
    where me.c_email = "admin@socialclub.org";

insert into [_]member_group
    (c_created_date, c_member, c_related_group)
    select now(), me.c_uid, gr.c_uid
    from [_]member as me
        inner join [_]group as gr on gr.c_title = 'guest'
    where me.c_email = "guest@socialclub.org";

insert into [_]chat_type
    (c_owner, c_created_date, c_title, c_abbreviation, c_description)
    values
    (1, now(), "AIM", "AIM", "AOL Instant Messenger"),
    (1, now(), "Yahoo! Messenger", "YM", "Yahoo! Messenger"),
    (1, now(), "MSN Messenger", "MSN", "MSN Messenger"),
    (1, now(), "ICQ", "ICQ", "ICQ");

insert into [_]membership_type
    (c_owner, c_created_date, c_title, c_description, c_flags,
    c_begin_date, c_expiration_date, c_show_date, c_hide_date,
    c_units_granted, c_unit, c_unit_cost, c_total_cost)
    values
    ( -- Lifetime membership for system accounts
      1,
      now(),
      "Lifetime membership",
      "Membership for system accounts such as root",
      1,
      '2000-01-01',
      '2020-01-01',
      '0000-00-00',
      '0000-00-00',
      0,
      'month',
      0.00,
      0.00);

insert into [_]membership
    (c_created_date, c_status, c_member, c_type, c_begin_date,
    c_expiration_date, c_units_granted, c_unit, c_total_cost, c_amount_paid)
    select now(), st.c_uid, me.c_uid, mt.c_uid, mt.c_begin_date,
    mt.c_expiration_date, c_units_granted, c_unit, c_total_cost, 0
    from [_]status as st, [_]member as me, [_]membership_type as mt
    where st.c_title = "active"
        and me.c_email in ("admin@socialclub.org", "guest@socialclub.org")
        and mt.c_title = "Lifetime Membership";

insert into [_]activity
    (c_created_date, c_title)
    values
    (now(), "Biking (Mountain)"),
    (now(), "Biking (Road)"),
    (now(), "Camping"),
    (now(), "Canoeing"),
    (now(), "Caving"),
    (now(), "Climbing (Bouldering)"),
    (now(), "Climbing (Indoor Bouldering)"),
    (now(), "Climbing (Indoor Sport)"),
    (now(), "Climbing (Indoor Top Rope)"),
    (now(), "Climbing (Indoor)"),
    (now(), "Climbing (Sport)"),
    (now(), "Climbing (Top Rope)"),
    (now(), "Climbing (Trad)"),
    (now(), "Disc (Frisbee) Golf"),
    (now(), "Fishing"),
    (now(), "Hang gliding"),
    (now(), "High ropes and challenge courses"),
    (now(), "Highway Cleanup"),
    (now(), "Hiking (Backpacking)"),
    (now(), "Hiking (Day Hikes)"),
    (now(), "Horseback Riding"),
    (now(), "Hot air ballooning"),
    (now(), "Kayaking (Instruction Only)"),
    (now(), "Kayaking (River)"),
    (now(), "Kayaking (Sea)"),
    (now(), "Kayaking (Whitewater)"),
    (now(), "Picnics"),
    (now(), "River Tubing"),
    (now(), "Sailing"),
    (now(), "Scuba diving"),
    (now(), "Service Projects"),
    (now(), "Skiing (Cross-Country)"),
    (now(), "Skiing (Downhill)"),
    (now(), "Skydiving"),
    (now(), "Snow Tubing"),
    (now(), "Snowboarding"),
    (now(), "Snowshoeing"),
    (now(), "Social Events, Potlucks, etc."),
    (now(), "Stargazing "),
    (now(), "Sunbathing"),
    (now(), "Swimming"),
    (now(), "Whitewater rafting");
