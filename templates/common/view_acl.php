<h1>View Object ACL</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

<p>Below is a list of all privileges that apply to object <b>{OBJECT}</b> in
table <b>{PAGE}</b>.  A privilege specifes <i>who</i> is allowed to take
<i>what action</i> on <i>what</i>.  If the privilege is granted globally, then
it is granted on every object in that table.  If it is granted to <i>self</i>,
then it specifies an action a member can perform on himself.</p>

<p>You may also <a
href="members/{PAGE}/add_privilege/{OBJECT}">define
a new privilege for this object</a>.</p>

{SOME:}
<table class="cleanHeaders">
  <tr>
    <th>ID</th>
    <th>Who</th>
    <th>What Action</th>
    <th>Granted on What</th>
  </tr>
  {ROWS:}
  <tr>
    <td><a href="members/privilege/read/{C_UID}">{C_UID}</a></td>
    <td>{C_WHO_TYPE} {C_WHO_UID} ({C_WHO})</td>
    <td><a href="members/action/read/{C_ACTION}">{C_ACTION_TITLE}</a></td>
    <td><b>{C_GRANTED_ON}</b> {C_TABLE}({C_RELATED_UID})</td>
  </tr>
    </tr>
  {:ROWS}
</table>
{:SOME}

{NONE:}
<p class="notice">There are no privileges for this object.</p>
{:NONE}

</div>
