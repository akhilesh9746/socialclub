<h1>Items Checked Out to {name}</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

<p>The following inventory is checked out to {name}:</p>

<h2>Items</h2>

<style type="text/css">
tr.checked_out td {
    color:#008080;
}
</style>

<table class="borders collapsed compact top">
  <tr>
    <th>Item #</th>
    <th>Type</th>
    <th>Details 1</th>
    <th>Details 2</th>
    <th>Status</th>
  </tr>{item:}
  <tr class="{st_title}">
    <td>
      <a href="members/item/read/{it_uid}">{it_uid}</a>
    </td>
    <td>{ty_title}</td>
    <td>{c_primary}</td>
    <td>{c_secondary}</td>
    <td>{st_title}</td>
  </tr>{:item}
</table>

<h2>Gear</h2>

<table class="borders collapsed compact top">
  <tr>
    <th>Type</th>
    <th>Qty</th>
    <th>Description</th>
    <th>Status</th>
  </tr>{gear:}
  <tr>
    <td>{ic_title} &raquo; {it_title}</td>
    <td>{c_qty}</td>
    <td>{c_description}</td>
    <td>{st_title}</td>
  </tr>{:gear}
</table>

</div>
