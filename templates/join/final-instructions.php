<h1>Final Steps</h1>

<p>Your inactive membership has been saved in the database.</p>

<h2>Amount Due</h2>

<p>The following is a list of your inactive memberships saved in the database.
If you see an old membership here, you can <a
href="members/join/delete-old">delete unwanted memberships</a>.</p>

<table align="center" class="cleanHeaders" width="400">
  <tr>
    <th>Membership</th>
    <th>Amount Due</th>
  </tr>{MEMBERSHIPS:}
  <tr>
    <td>{C_TITLE}</td>
    <td align="right">${C_TOTAL_COST}</td>
  </tr>{:MEMBERSHIPS}
  <tr>
    <td colspan="2"><hr noshade="true" size="1"></td>
  </tr>
  <tr>
    <td><b>Total Amount Due</b></td>
    <td align="right"><b>${TOTAL|number_format,2}</b></td>
  </tr>
</table>
