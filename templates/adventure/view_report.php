<h1>View Report</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

Adventure: <b>{C_TITLE}</b>

{FORM}

{SOME:}

<p>{NUM_ATTENDEES} attendees shown, in the order they joined<sup>[1]</sup>.  The first column
shows whether the member is joined or waitlisted.  The last shows the number of
absences and times the member has been waitlisted.  Use the radio button in the
left column, and the buttons at the bottom of the table, to manage
attendees.</p>

<form action="members.php" method="GET">
  <input type="hidden" name="page" value="attendee">
<table class="compact cleanHeaders top">
  <tr>
    <td>&nbsp;</td>
    <th>J/W</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Sex</th>
    <th>Birthdate</th>
    <th>Abs/Wtlst</th>
  </tr>{ROW:}
  <tr>
    <td>
      <input type="radio" class="compact" name="object" value="{C_UID}">
    </td>
    <td>{C_STATUS}</td>
    <td>
      <a href="members/member/read/{C_MEMBER}" title="View details for this member">{C_FULL_NAME}</a>
    </td>
    <td><a href="mailto:{C_EMAIL}">{C_EMAIL}</a></td>
    <td nowrap>{NUMBERS}</td>
    <td>{C_GENDER}</td>
    <td>{C_BIRTH_DATE|_date_format,'n/j/y'}</td>
    <td>
      <a href="members/member/view_absences/{C_MEMBER}"
        title="View absences for {C_FULL_NAME}">{C_ABSENCES}</a>/<a
        href="members/member/view_waitlist/{C_MEMBER}">{C_WAITLISTS}</a>
    </td>
  </tr>
{:ROW}
  <tr><td colspan="8" style="border-top:1px solid #000; text-align:right">
  <input type="radio" name="action" value="{ACTION_WITHDRAW}" id="action1">
  <label for="action1">Withdraw</label>
  <input type="radio" name="action" value="{ACTION_WAITLIST}" id="action2">
  <label for="action2">Waitlist</label>
  <input type="radio" name="action" value="{ACTION_JOIN}" id="action3">
  <label for="action3">Join from Waitlist</label>
  <input type="radio" name="action" value="{ACTION_MARK_ABSENT}" id="action4">
  <label for="action4">Mark Absent</label>
  <input type="submit" value="Go">
  </td></tr>
</table>
</form>

{QUESTIONS:}
<h1>Questions</h1>

<table class="borders compact collapsed top" style="background:white">
  <tr>
    <td>&nbsp;</td>{HEADER_V:}
    <td title="{C_TEXT|htmlspecialchars}"><img title="{C_TEXT|htmlspecialchars}"
    alt="{C_TEXT|htmlspecialchars}" src="assets/vertical-text.php?text={C_TEXT|urlencode}"></td>{:HEADER_V}{HEADER_H:}
    <td>{C_TEXT|htmlspecialchars}</td>{:HEADER_H}
  </tr>
{ROWS}
{QUESTION:}
  <tr>
    <td>{C_FULL_NAME}</td>{ANSWER:}
    <td>{C_ANSWER_TEXT}</td>{:ANSWER}
  </tr>
{:QUESTION}
</table>
{:QUESTIONS}

{:SOME}

{NONE:}
<p class="notice">There is nothing to display.</p>
{:NONE}

<p><sup>[1]</sup>After a member is automatically removed from the waitlist
his/her joined date is reset, so s/he appears at the end of the roster.  This is
correct behavior.  It doesn't mean that people who joined later are getting off
the waitlist first.</p>

</div>
