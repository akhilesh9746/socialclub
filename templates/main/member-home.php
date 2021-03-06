<h1>Member Home Page</h1>

{NEED_TO_RENEW:}
<p class="notice">Your membership is expiring in {DAYS_LEFT} days.  You should
<a href="members/join/renew">renew your membership</a> now!</p>
{:NEED_TO_RENEW}

<table class="top collapsed">
  <tr>

    <td colspan="2">
      <ul>
      <li>Please <a href="members/main/feedback">give us feedback</a></li>
      <li>You can <a href="members/main/email">email the club list</a></li>
{APPLICATIONS:}
      <li>We're accepting officer applications! <a href="members/application/create">Apply today!</a></li>
{:APPLICATIONS}
{RECENT_APPS_SINGLE:}
      <li>There is a recent application! <a href="members/application/list_all">Check it out!</a></li>
{:RECENT_APPS_SINGLE}
{RECENT_APPS_MULTIPLE:}
      <li>There are {NUM_APPS} recent applications!  <a href="members/application/list_all">Check 'em out!</a></li>
{:RECENT_APPS_MULTIPLE}
      </ul>
    </td>

  </tr>
  <tr>
    <td width="60%" style="padding-right:10px">

      <!-- Begin Upcoming Adventures -->
      <h4 class="boxed">A Few Upcoming Adventures</h4>
      <table class="compact collapsed elbowroom" width="100%">
        {UPCOMING:}<tr>
          <td>{img}</td>
          <td nowrap>{c_start_date|_date_format,'M j'}</td>
          <td>
            <a href="members/adventure/read/{c_uid}">{c_title}</a><br>
          </td>
        </tr>{:UPCOMING}
      </table>
      <div align="right" class="tiny">
        <a href="members/adventure">More Adventures</a> |
        <a href="members/adventure/list_all?criteria=joined">Adventures You've Attended</a> |
        <a href="members/calendar">Calendar of Events</a>
        <br>
        <img src="assets/smiley-tiny.png" height="12" width="12" alt="Favorites"> These upcoming adventures match your
        <a href="members/member/choose_activities/{MEMBER}">interests</a>.
      </div>
      <!-- End Upcoming Adventures -->

      <!-- Begin Classified Ads -->
      <h4 class="boxed">Classifieds</h4>
      <table class="compact collapsed elbowroom" width="100%">{CLASSIFIEDS:}
        <tr>
          <td nowrap>{C_CREATED_DATE|_date_format,'M j'}</td>
          <td>
            <a href="members/classified_ad/read/{C_UID}">{C_TITLE}</a><br>
          </td>
        </tr>{:CLASSIFIEDS}
      </table>
      <div align="right" class="tiny">
        <a href="members/classified_ad/list_all">View All</a> |
        <a href="members/classified_ad/create">Post an Ad</a>
      </div>
      <!-- End Classified Ads -->

      <!-- Begin Favorite Locations -->
      <h4 class="boxed">Popular Locations By Activity Type</h4>
      {CHOOSE_INTERESTS:}
      <p class="notice">Hey you!  You need to 
      <a href="members/member/choose_activities/{MEMBER}">choose
      your interests</a> and then I can show you something cool here.</p>
      {:CHOOSE_INTERESTS}
      {FAV_LOCATIONS:}
      <div class="tiny">These are the most popular destinations for your favorite
      activities.</div>
      <table class="compact elbowroom collapsed ruled cleanHeaders" width="100%">
        <tr>
          <th>#trips</th>
          <th>Activity</th>
          <th>Location</th>
        </tr>{pop_loc:}
        <tr class='{CLASS}'>
          <td>{num}</td>
          <td>{ac_title}</td>
          <td><a href="members/location/read/{loc_uid}">{loc_title}</a></td>
        </tr>{:pop_loc}
      </table>
      <div align="right" class="tiny">
        {MORE_ACTIVITIES:}
        <a href="members/main/member-home?limit=1000">Show more</a> |
        {:MORE_ACTIVITIES}
        <a href="members/location/list_all">All Locations</a> |
        <a href="members/member/choose_activities/{MEMBER}">Choose Interests</a>
      </div>
      {:FAV_LOCATIONS}
      <!-- End Favorite Locations -->

      <!-- Begin Calendar -->

      <h4 class="boxed">Calendar of Events</h4>

      <p>Days that are bold have adventures scheduled.  To see the full
      calendar, <a href="members/calendar">click
      here</a>.</p>

      <div align="center">
      {CALENDAR}
      </div>

      <!-- End Calendar -->

    </td>
    <td width="40%">

      <!-- Begin Search Form -->
      <h4 class="boxed">Search</h4>
      <form action="members/member/list_all" method="GET">
        <p>Search for members by name:<br>
        <input type="hidden" name="go" value="1" />
        <input type="text" name="name" value="">
        <input type="submit" value="Go">
        </p>
      </form>
      <form action="members/adventure/list_all" method="GET">
        <p>Search for adventures by title:<br>
        <input type="hidden" name="form-name" id="form-name" value="1" />
        <input type="text" name="title" value="">
        <input type="submit" value="Go">
        </p>
      </form>
      <form action="members/location/list_all" method="GET">
        <p>Search for locations by title:<br>
        <input type="hidden" name="form-name" id="form-name" value="1" />
        <input type="text" name="title" value="">
        <input type="submit" value="Go">
        </p>
      </form>
      <!-- End Search Form -->

      <h4 class="boxed">Your Profile (<a href="members/profile">Manage</a>)</h4>

      <h5>Addresses</h5>
      <div class="indented">
      {ADDRESS:}
      - <a href="members/address/read/{T_ADDRESS}">{C_TITLE}</a><br>
      &raquo; <a href="members/address/write/{T_ADDRESS}">update</a><br>
      {:ADDRESS}
      &raquo; <a href="members/address">manage addresses</a><br>
      </div>

      <h5>Phone Numbers</h5>
      <div class="indented">
      {PHONE:}
      - <a href="members/phone_number/read/{T_PHONE_NUMBER}">{C_PHONE_NUMBER}</a><br>
      &raquo; <a href="members/phone_number/write/{T_PHONE_NUMBER}">update</a><br>
      {:PHONE}
      &raquo; <a href="members/phone_number">manage phone numbers</a><br>
      </div>

      <h5>Chat Identities</h5>
      <div class="indented">
      {CHAT:}
      - <a
        href="members/chat/read/{T_CHAT}">{C_SCREENNAME}</a> ({C_ABBREVIATION})<br>
      &raquo; <a href="members/chat/write/{T_CHAT}">update</a><br>
      {:CHAT}
      &raquo; <a href="members/chat">manage chat identities</a><br>
      </div>

      <h5>Other</h5>
      <div class="indented">
      &raquo; <a href="members/member/optout/{MEMBER}">opt out of emails</a><br>
      &raquo; <a href="members/member/change_password/{MEMBER}">change your password</a><br>
      &raquo; <a href="members/member/choose_activities/{MEMBER}">choose favorite activities</a><br>
      &raquo; <a href="members/subscription/list_owned_by">your email list subscriptions</a><br>
      &raquo; <a href="members/member/view_history/{MEMBER}">view membership history</a><br>
      &raquo; <a href="members/join/renew">renew your membership</a><br>
      </div>

    </td>
  </tr>
</table>
