<h1>Execute Report</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

<p><i>{C_DESCRIPTION}</i></p>

{PARAMS:}
<p>You need to replace some parameters in the query with values.  The parameters
below have the following data types (see the instructions below for more help):</p>
<ol>
  {ITEM:}
  <li>{DATA}</li>
  {:ITEM}
</ol>
<p class="notice">Instructions: {C_INSTRUCTIONS}</p>

{FORM}

{:PARAMS}

{RESULTS:}
<p>There were {COUNT} rows in the result set.</p>

<table class="borders collapsed compact">
  {HEADER}
  {ROW}
</table>
{:RESULTS}

</div>
