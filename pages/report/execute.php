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
 * $Id: execute.php,v 1.1 2005/03/27 19:53:33 bps7j Exp $
 */

$template = file_get_contents("templates/report/execute.php");

$execute = true;
$datatypes = array(
    "number" => "Example: 293",
    "date" => "Example: 2003-12-12",
    "words" => "Example: \'This is a sentence\'",
    "email" => "Example: " . $obj['user']->getEmail(), 
    "datetime" => "Example: 2003-12-12 5:00 PM",
    "" => "Enter anything you wish"
    );

$params = $object->getParameters();
if (count($params)) {

    # This report has parameters that must be replaced.  We'll need to generate
    # a form and validate it.  This form won't get output to the browser; it's
    # only used to validate the data the user submits.

    $formTemplate = file_get_contents("forms/report/execute.xml");
    foreach ($params as $name => $datatype) {
        # Add the parameter's name and datatype to the page
        $template = Template::block($template, "ITEM", 
                array("DATA" => "<tt>$datatype</tt> $datatypes[$datatype]"));
        # Add the parameter to the form
        $formTemplate = Template::block($formTemplate, "CONFIG",
            array("NAME" => $name, "TYPE" => $datatype));
        $formTemplate = Template::block($formTemplate, "ELEMENT",
            array("NAME" => $name));
    }

    # Finalize the template and create the form from it
    $form =& new XmlForm(Template::finalize($formTemplate), true);
    $form->snatch();
    $form->validate();

    if (!$form->isValid()) {
        $execute = false;
        $template = Template::unhide($template, "PARAMS");
        $template = Template::replace($template, 
                array("C_INSTRUCTIONS" => $object->getInstructions()));

        # Replace parameters in the query with HTML form elements and present to
        # the user.  Make the form elements on the fly; this is plain HTML form
        # stuff now, not fancy XML form stuff.
        $string = $object->insertIntoTemplate(file_get_contents("templates/report/execute-form.php"));
        $string = Template::replace($string, array(
            "QUERY" => highlightSql(htmlspecialchars($object->getQuery()))));
        foreach ($params as $name => $datatype) {
            $value = htmlspecialchars($form->getValue($name));
            $elem = "<input type=\"text\" "
                . "title=\"$datatypes[$datatype]\" "
                . "class=\"parameter\" name=\"$name\" value=\"$value\">";
            $string = str_replace("\{$name,$datatype}", $elem, $string);
        }
        $template = Template::replace($template, array("FORM" => $string));
    }
    else {
        $execute = true;
        # Replace parameters in the query with the form's values and execute
        foreach ($params as $name => $datatype) {
            $object->replaceParameter($name, $form->getValue($name));
        }
    }
}
if ($execute) {
    $template = Template::unhide($template, "RESULTS");
    $result =& $object->execute();
    # The rest of the page is simple.  Just print out headers and rows
    $header = true;
    $count = 0;
    while ($row =& $result->fetchRow()) {
        if ($header) {# This only happens once... print out a header row
            $header = false;
            $template = Template::replace($template, array(
                "HEADER" => "<tr><th>" . implode("</th><th>", array_keys($row))
                    . "</th></tr>"));
        }
        $template = Template::replace($template, array(
            "ROW" => "<tr class='" . (($count++ % 2) ? "even" : "odd")
            . "'><td>" . implode("</td><td>", $row) . "</td></tr>"), 1);
    }
    $template = Template::replace($template, array(
        "COUNT" => $result->numRows()));
}

$res['content'] = $object->insertIntoTemplate($template);
$res['title'] = "View Report Results";

?>
