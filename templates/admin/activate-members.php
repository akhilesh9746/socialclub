<h1>Activate Members</h1>

{SUCCESS:}

<p class="notice">The selected memberships were activated.  Below is a count of
how many memberships you activated:</p>

<table class="cleanHeaders">
  <tr>
    <th>Membership Type</th>
    <th>Number</th>
  </tr>{RESULTS:}
  <tr>
    <td>{MEMBERSHIP_TITLE}</td>
    <td>{NUM}</td>
  </tr>{:RESULTS}
</table>
{:SUCCESS}

{SOME:}

<p>The following memberships need to be activated.  Check the checkbox next to a
member to activate that membership.  Be sure to check for an adult's signature
if the member is underage (bold, red text).</p>

<p>If you have a signed waiver for a membership but don't see that member below,
    try searching for the member and then clicking on the "History" tab.  You
    can see all the memberships, active and inactive, from that page; you can
    click on a membership and activate it.  To keep this page uncluttered, some
    inactive memberships that are very old may not be displayed.</p>

<form method="post" action="members/admin/activate-members">
<input type="hidden" name="submitted" value="1">

<table>
  <tr>
    <th colspan="2">Member</th>
    <th>Membership</th>
  </tr>{ROW:}
  <tr{UNDERAGE}>
    <td>
      <input type="checkbox" name="membership[]" id="check{MEMBERSHIP_UID}" value="{MEMBERSHIP_UID}">
    </td>
    <td><label for="check{MEMBERSHIP_UID}">{C_LAST_NAME}, {C_FIRST_NAME}</label></td>
    <td>{C_TITLE}</td>
  </tr>{:ROW}
</table>

<input type="submit" value="Activate Selected Members">

{:SOME}

</form>

