<h1>View Group Members</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

{NONE:}
<p class="notice">This group, <b>{C_TITLE}</b>, has no members.</p>
{:NONE}

{SOME:}
<p>Members that belong to group <b>{C_TITLE}</b>:</p>

<ol>{ROW:}
  <li><a href="members/member/read/{C_UID}">{C_LAST_NAME}, {C_FIRST_NAME}</a></li>{:ROW}
</ol>
{:SOME}

</div>
