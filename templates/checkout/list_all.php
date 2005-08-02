<h1>Checked-Out Equipment</h1>

<p>The following people have equipment checked out:</p>

{FORM}
<br>

{SOME:}
<table class="borders collapsed">
  <tr>
    <th>Member</th>
    <th>Officer</th>
    <th>Date</th>
    <th>Status</th>
  </tr>{checkout:}
  <tr>
    <td><a href="members/checkout/read/{c_uid}">{c_last_name}, {c_first_name}</a></td>
    <td>{officer_name}</td>
    <td>{c_created_date|_date_format,'n/j/Y'}</td>
    <td>{c_status|bitmaskString,'status_id'}</td>
  </tr>{:checkout}
</table>
{:SOME}

{NONE:}
<p class="notice">No matching records found.</p>
{:NONE}
