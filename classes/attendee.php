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
 * $Id: attendee.php,v 1.1 2005/03/27 19:54:30 bps7j Exp $
 */

include_once("database_object.php");

class attendee extends database_object {
    // {{{declarations
    var $c_adventure = null;
    var $c_member = null;
    var $c_amount_paid = null;
    var $c_joined_date = null;
    // }}}

    /* {{{constructor
     *
     */
    function attendee() {
        $this->database_object();
    } //}}}

    /* {{{getAdventure
     *
     */
    function getAdventure() {
        return $this->c_adventure;
    } //}}}

    /* {{{setAdventure
     *
     */
    function setAdventure($value) {
        $this->c_adventure = $value;
    } //}}}

    /* {{{getMember
     *
     */
    function getMember() {
        return $this->c_member;
    } //}}}

    /* {{{setMember
     *
     */
    function setMember($value) {
        $this->c_member = $value;
    } //}}}

    /* {{{getAmountPaid
     */
    function getAmountPaid() {
        return $this->c_amount_paid;
    } //}}}

    /* {{{setAmountPaid
     */
    function setAmountPaid($value) {
        $this->c_amount_paid = $value;
    } //}}}

    /* {{{getJoinedDate
     */
    function getJoinedDate() {
        return $this->c_joined_date;
    } //}}}

    /* {{{setJoinedDate
     */
    function setJoinedDate($value) {
        $this->c_joined_date = $value;
    } //}}}

}
?>
