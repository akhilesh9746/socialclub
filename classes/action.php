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
 * $Id: action.php,v 1.1 2005/03/27 19:54:24 bps7j Exp $
 */

include_once("database_object.php");

class action extends database_object {
    // {{{declarations
    var $c_title = null; // String
    var $c_description = null; // String
    var $c_label = null;
    var $c_row = null;
    var $c_summary = null; // String
    // }}}

    /* {{{constructor
     *
     */
    function action() {
        $this->database_object();
    } //}}}
 
    /* {{{getTitle
     *
     */
    function getTitle() {
        return $this->c_title;
    } //}}}

    /* {{{setTitle
     *
     */
    function setTitle($value) {
        $this->c_title = $value;
    } //}}}

    /* {{{getDescription
     *
     */
    function getDescription() {
        return $this->c_description;
    } //}}}

    /* {{{setDescription
     *
     */
    function setDescription($value) {
        $this->c_description = $value;
    } //}}}

    /* {{{getRow
     *
     */
    function getRow() {
        return $this->c_row;
    } //}}}

    /* {{{setRow
     *
     */
    function setRow($value) {
        $this->c_row = $value;
    } //}}}

    /* {{{getLabel
     *
     */
    function getLabel() {
        return $this->c_label;
    } //}}}

    /* {{{setLabel
     *
     */
    function setLabel($value) {
        $this->c_label = $value;
    } //}}}

    /* {{{getSummary
     *
     */
    function getSummary() {
        return $this->c_summary;
    } //}}}

    /* {{{setSummary
     *
     */
    function setSummary($value) {
        $this->c_summary = $value;
    } //}}}

}
?>
