<h1>Change Group Memberships for {C_FULL_NAME}</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

{SUCCESS:}
<p class="notice">Your changes were saved.</p>
{:SUCCESS}

<p>Choose groups that {C_FULL_NAME} should belong to:</p>

<form method="POST" action="members/member/chgrp_secondary/{T_MEMBER}">
<input type="hidden" name="posted" value="1">

<p>
{GROUP:}
  <input type="checkbox" name="groups[]" value="{c_uid}" id="group{c_uid}" {CHECKED}>
  <a title="View details for this group" href="members/group/read/{c_uid}">&raquo;</a>
  <label for="group{c_uid}"><b>{c_title}</b> {c_description}</label><br>
{:GROUP}
</p>

<p>
  <input type="reset" value="Reset">
  <input type="submit" value="Save">
</p>

</form>

</div>
