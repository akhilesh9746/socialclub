<!-- title=Manage Groups -->
<h1>Manage Groups</h1>

<p>This part of the website manages groups.  Members can belong to any number of
groups.  Groups are a tightly integrated part of the system's permissions; half
of the permission system is based on users, and the other half on groups.

<p class="notice">Before you do anything with groups, you need to be clear about
the difference between group membership and group ownership.  Each object in the
database is owned by both a user and a group, similar to the way Unix
permissions work (read the <tt>ls</tt> man page for a very good explanation;
this website emulates this permission scheme).  Members, however, may also be
<b>in</b> groups.  This is the difference between group ownership and group
membership.  A member's groups are totally, completely separate from the group
that owns the member object.</p>

<p>Use the links below to manage groups.</p>

<ul>{actions:}
  <li><a href="members/{PAGE}/{c_title}">{c_summary}</a></li>{:actions}
</ul>
