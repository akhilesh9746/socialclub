<h1>Location: {C_TITLE}</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

{C_DESCRIPTION|nl2br|_linkify|htmlspecialchars}

{WEATHER:}
<p><b>Weather Forecast:</b><br>
You can view a
<a target="_blank" href="http://www.weather.com/weather/print/{C_ZIP_CODE}">weather
forecast</a> for this location.</p>
{:WEATHER}

{ACTS:}
<p><b>Activity Types:</b><br>
You can do the following types of outdoor activities at this location:</p>
 <ul>{ACTIVITY:}
   <li>{C_TITLE}</li>{:ACTIVITY}
 </ul>
{:ACTS}

{actions,{PAGE},{OBJECT},default}

{SOME:}
<h2>Adventures</h2>

<p>The following adventures went to this location:</p>

<ol>
{ADVENTURE:}
  <li>
    <a href="members/adventure/read/{C_UID}">{C_TITLE}</a>
  </li>{:ADVENTURE}
</ol>
{:SOME}

</div>
