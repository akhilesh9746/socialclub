<h1>{CLUB_NAME}'s Past Adventures</h1>

<p>The following list of adventures is retrieved live from our database and
shows all adventures we have led in the past year.</p>

<table class="ruled compact collapsed cleanHeaders">
  <tr>
    <th>Title</th>
    <th>Location</th>
    <th>Date</th>
  </tr>
{ROW:}
  <tr{CLASS}>
    <td>
      {C_TITLE}
    </td>
    <td>
      {LOC_TITLE}
    </td>
    <td nowrap>{C_START_DATE|_date_format,'M j, Y'}</td>
  </tr>
{:ROW}
</table>
