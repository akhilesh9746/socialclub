<h1>Email Adventure Attendees</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

<p>Use this page to send an email to attendees for adventure <b>{C_TITLE}</b>.</p>

{ACTIVE:}
<p class="error">This adventure is not active.  You cannot email attendees for 
this adventure.</p>
{:ACTIVE}

{SUCCESS:}
<p class="notice">You have successfully emailed attendees for this
adventure.</p>

<p>The following is the message you sent:</p>
<pre style="border:1px dotted black; background:white; color:green">{MESSAGE}</pre>
{:SUCCESS}

{FORM}

</div>
