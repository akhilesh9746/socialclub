<h1>Set Flags</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

<p>Use this page to set true/false flag values on object <b>{OBJECT}</b> in
table <b>{TABLE}</b>.  You can set any flag that's defined, but it may not have
any meaning for the object you're setting it on.  Be careful about unsetting
flags; some of the flags are member preferences and so forth.</p>

{DIRTY:}
<p class="notice">This object's flags have been updated.</p>
{:DIRTY}

<form action="members/{PAGE}/set_flags/{OBJECT}" method="POST">
<input type="hidden" name="posted" value="1">

<table>
  {FLAG:}
  <tr>
    <td>
      <input type="checkbox" name="flags[]" value="{C_TITLE}" id="flag{C_TITLE}"
      {CHECKED}>
    </td>
    <td>
      <label for="flag{C_TITLE}">{C_TITLE}</label>
    </td>
  </tr>
  {:FLAG}
  <tr>
    <td colspan="2" align="right">
      <input type="reset" value="Reset">
      <input type="submit" value="Update Flags">
    </td>
  </tr>
</table>

</form>

</div>
