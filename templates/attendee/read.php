<h1>Attendee Details</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

<table class="collapsed elbowroom verticalHeaders">
  <tr>
    <th>Member</th>
    <td><a href="members/member/read/{T_MEMBER}">{C_FULL_NAME}</a></td>
  </tr>
  <tr>
    <th>Adventure</th>
    <td><a href="members/adventure/read/{T_ADVENTURE}">{C_TITLE}</a></td>
  </tr>
  <tr>
    <th>Amount Paid</th>
    <td>${C_AMOUNT_PAID}</td>
  </tr>
  <tr>
    <th>Date Joined</th>
    <td>{C_JOINED_DATE}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>{STATUS}</td>
  </tr>
</table>

{actions,{PAGE},{OBJECT},default}

</div>
