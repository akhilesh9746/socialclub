<h1>{C_TITLE}</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

{VIEW_ANSWERS:}
<p class="notice">You have joined this adventure.  If you wish, you may
<a href="members/attendee/view_answers/{ATTENDEE}">
view and edit the answers you gave to the adventure's questions when you joined</a>.</p>
{:VIEW_ANSWERS}

{COMMENT_LINK:}
<p class="notice">You can
<a href="members/adventure/comment/{OBJECT}">comment
on this adventure</a> if you wish.</p>
{:COMMENT_LINK}

{CANCELLED:}
<p class="notice">This adventure is cancelled.</p>
{:CANCELLED}

<p>{C_DESCRIPTION|smiley|nl2br|_linkify|htmlspecialchars}</p>

<table class="verticalHeaders collapsed elbowroom compact classic">
  <tr>
    <th>Who</th>
    <td>
      <a href="members/member/read/{C_OWNER}">{C_FULL_NAME}</a>
      is leading this trip; there is space for {C_MAX_ATTENDEES} people.{FULL:}
      The trip is currently full, but you may join the waitlist.{:FULL}</p>
    </td>
  </tr>
  <tr>
    <th>Where</th>
    <td>
      <a href="members/location/read/{C_DESTINATION}">{DESTINATION_TITLE}</a>{WEATHER:}
      (<a target="_blank"
      href="http://www.weather.com/weather/print/{DESTINATION_ZIP}">Weather
      Forecast</a>){:WEATHER}.  We depart from <a
      href="members/location/read/{C_DEPARTURE}">{DEPARTURE_TITLE}</a>.
    </td>
  </tr>
  <tr>
    <th>Start</th>
    <td>{C_START_DATE|_date_format,'D n/j/y \a\t g:i A'}</td>
  </tr>
  <tr>
    <th>End</th>
    <td>{C_END_DATE|_date_format,'D n/j \a\t g:i A'}</td>
  </tr>
  <tr>
    <th>Signup&nbsp;Deadline</th>
    <td>{C_SIGNUP_DATE|_date_format,'D n/j \a\t g:i A'}</td>
  </tr>
  <tr>
    <th>Fee</th>
    <td>${C_FEE|number_format,2}</td>
  </tr>
</table>

<p><b>Activity Categories:</b></p>

<ul>{CAT:}
  <li>{C_TITLE}</li>{:CAT}
</ul>

{actions,{PAGE},{OBJECT},default}

</div>

{SOME:}
<h2>Comments</h2>

<p>Here's what attendees had to say about this adventure{COMMENT_LINK:} (<a
href="members/adventure/comment/{OBJECT}">add your
own comment</a>){:COMMENT_LINK}:</p>

<table width="100%" class="compact collapsed elbowroom cleanHeaders">
  <tr><th>Author</th><th>Comment</th></tr>
{COMMENT:}
  <tr>
    <td width="20%" style="vertical-align:top">
      {SHOW_NAME:}
      <a href="members/member/read/{T_MEMBER}">{C_FULL_NAME}</a><br>
      {:SHOW_NAME}
      {HIDE_NAME:}Anonymous Coward<br>{:HIDE_NAME}
      Posted: {C_CREATED_DATE|_date_format,'M j, Y'}<br>
      Rating: {C_TITLE}
      <!-- photo goes here eventually -->
    </td>
    <td width="80%" style="vertical-align:top">
      <b>{C_SUBJECT|htmlspecialchars}</b><br>
      {C_TEXT|nl2br|htmlspecialchars}
    </td>
  </tr>
    <td colspan="2"><hr size="1"></td>
  </tr>
{:COMMENT}
</table>

{:SOME}

