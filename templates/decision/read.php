<h1>{C_TITLE}</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

<p>{C_TEXT|_linkify|nl2br|htmlspecialchars}</p>

<table class="verticalHeaders collapsed elbowroom">
  <tr>
    <th>Decision #</th>
    <td>{T_DECISION}</td>
  </tr>
  <tr>
    <th>Category</th>
    <td>{CAT_TITLE}</td>
  </tr>
  <tr>
    <th>Date</th>
    <td>{C_CREATED_DATE|_date_format,'M j, Y'}</td>
  </tr>{XREFS:}
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <th>Cross-References</th>
    <td>{XREF:}
      #{C_UID}: <a href="members/decision/read/{C_UID}">{C_TITLE}</a><br>{:XREF}
    </td>
  </tr>{:XREFS}
</table>

{ADD_XREF:}
<script>
function check(form) {
    if (form.elements['xref'].value.match(/^\d+$/)) {
        return true;
    }
    alert("You must enter a number");
    return false;
}
</script>
<form action="members/decision/add_xref/{OBJECT}" method="GET" onSubmit="return check(this)">
  <p>Add Cross-Reference #
  <input type="text" size="4" name="xref">
  <input type="submit" value="Go">
</form>
{:ADD_XREF}

{actions,{PAGE},{OBJECT},default}

</div>
