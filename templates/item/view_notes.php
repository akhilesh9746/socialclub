<h1>Item Notes</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

<table class="cleanHeaders top">
  <tr>
    <th>Date</th>
    <th>Member</th>
    <th>Note</th>
    <th>Condition</th>
    <th>Status</th>
  </tr>{NOTE:}
  <tr>
    <td>{C_CREATED_DATE|_date_format,'n/j/y'}</td>
    <td nowrap>
      <a href="members/member/read/{C_CREATOR}">{C_FULL_NAME}</a>
    </td>
    <td>{C_NOTE}</td>
    <td>{C_TITLE}</td>
    <td>{STATUS_TITLE}</td>
  </tr>{:NOTE}
</table>

</div>
