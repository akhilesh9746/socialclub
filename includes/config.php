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
 * $Id: config.php,v 1.1 2005/03/27 19:54:20 bps7j Exp $
 *
 * Create the variables and stuff the individual pages need, including
 * setting up error handling and global variables.
 */

# Organization name.
$cfg['club_name'] = "SocialClub";

# The email address for whoever's in charge of the club operation
$cfg['club_admin_email'] = "admin@socialclub.org";
$cfg['webmaster_email'] = "webmaster@socialclub.org";
// TODO: replace this with the members of the treasurer group
$cfg['treasurer_email'] = array("treasurer@socialclub.org");
$cfg['error_log'] = ".hterror";
$cfg['club_admin_email_name'] = 'Socialclub Administrator <admin@socialclub.org>';

# Whether the system should send emails when requested to do so.
$cfg['send_emails'] = true;

# The prefix for database table names.
$cfg['table_prefix'] = "t_";

# How to connect to the database.
$cfg['db'] = array(
    'type' => 'MySqlConnection',
    'persistent' => true,
    'user' => 'socialclub',
    'pass' => 'onyx',
    'db' => 'socialclub',
    'host' => 'localhost',
    'debug' => false,
    'dump' => false,
    'errlevel' => E_USER_ERROR,
    'prefix' => $cfg['table_prefix']);

# UIDs for important members.
$cfg['root_uid'] = 1;
$cfg['expense_from_uid'] = 2;

?>
