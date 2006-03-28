<h1>Final Steps</h1>

<p>Your inactive membership has been saved in the database.  All you need to do
at this point is print and sign the <a
href="members/join/print-waiver">liability waiver</a>, and send it in with your
dues.  <b>Please follow the instructions on the waiver</b>.</p>

<p>You will need <a
href="http://www.adobe.com/products/acrobat/readstep2.html">Adobe Reader</a> or
similar software to view and print the liability waiver.  To print your
liability waiver, <a href="members/join/print-waiver">click here</a>.</p>

<p>We'll activate your membership and send you a welcome email as soon as we
receive everything.</p>

<h2>Amount Due</h2>

<p>Please send payment (instructions are on the waiver) for your membership.
The following is a list of your inactive memberships saved in the database.  If
you see an old membership here, you can <a
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
