<h1>Membership History for {C_FULL_NAME}</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

{SOME:}

<p>The following is a list of all memberships for <b>{C_FULL_NAME}</b>.</p>

<table class="cleanHeaders compact">
  <tr>
    <th>Membership</th>
    <th>Created</th>
    <th>Total Cost</th>
    <th>Status</th>
    <th>Begins</th>
    <th>Expires</th>
  </tr>
  <tr>{MEMBERSHIP:}
    <td><a href="members/membership/read/{C_UID}">{C_TITLE}</a></td>
    <td nowrap>{C_CREATED_DATE|_date_format,'M j, Y'}</td>
    <td align="right">${C_TOTAL_COST|number_format,2}</td>
    <td>{ST_TITLE}</td>
    <td nowrap>{C_BEGIN_DATE|_date_format,'M j, Y'}</td>
    <td nowrap>{C_EXPIRATION_DATE|_date_format,'M j, Y'}</td>
  </tr>{:MEMBERSHIP}
</table>
{:SOME}

{NONE:}
<p class="notice">{C_FULL_NAME} has no memberships.</p>
{:NONE}

</div>
