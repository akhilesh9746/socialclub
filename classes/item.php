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
 * $Id: item.php,v 1.1 2005/03/27 19:54:26 bps7j Exp $
 */

include_once("database_object.php");

class item extends database_object {
    // {{{declarations
    var $c_purchase_date = null;
    var $c_type = null;
    var $c_description = null;
    var $c_condition = null;
    var $c_qty = null;
    // }}}

    /* {{{constructor
     *
     */
    function item() {
        $this->database_object();
    } //}}}

    /* {{{getPurchaseDate
     *
     */
    function getPurchaseDate() {
        return $this->c_purchase_date;
    } //}}}
    
    /* {{{setPurchaseDate
     *
     */
    function setPurchaseDate($value) {
        $this->c_purchase_date = date("Y-m-d", strtotime($value));
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

    /* {{{getCondition
     *
     */
    function getCondition() {
        return $this->c_condition;
    } //}}}
    
    /* {{{setCondition
     *
     */
    function setCondition($value) {
        $this->c_condition = $value;
    } //}}}

    /* {{{getType
     *
     */
    function getType() {
        return $this->c_type;
    } //}}}
    
    /* {{{setType
     *
     */
    function setType($value) {
        $this->c_type = $value;
    } //}}}

    /* {{{getQty
     *
     */
    function getQty() {
        return $this->c_qty;
    } //}}}
    
    /* {{{setQty
     *
     */
    function setQty($value) {
        $this->c_qty = $value;
    } //}}}

}
?>
