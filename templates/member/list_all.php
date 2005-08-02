<h1>Member Directory</h1>

{form}

{SOME:}
<p>{NUM} members found.</p>

<table class="compact collapsed elbowroom cleanHeaders">
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Chat</th>
  </tr>{ROW:}
  <tr>
    <td><a href="members/member/read/{c_uid}">{c_last_name}, {c_first_name}</a></td>
    <td><a href="mailto:{c_email}">{c_email}</a></td>
    <td>{phone_number}</td>
    <td>{c_screenname} ({c_abbreviation})</td>
  </tr>{:ROW}
</table>
{:SOME}

{NONE:}
<p class="notice">No members matched your criteria.</p>
{:NONE}
