<h1>Check in Inventory</h1>

<table class="tabbedBox" border="0" cellpadding="0" cellspacing="0">
{TABS}
</table>
<div class="box">

<p>Mark below the equipment that you are checking back in.</p>

<form action="members/checkout/check_in/{OBJECT}" method="POST">

<p><b>Items</b> that are checked out:</p>

<table class="cleanHeaders compact top">
  <tr>
    <th colspan="2">Item #</th>
    <th>Type</th>
    <th>Details 1</th>
    <th>Details 2</th>
  </tr>{item:}
  <tr>
    <td>
      <input type="checkbox" name="item[]" value="{c_uid}" id="item{c_uid}" />
    </td>
    <td>
      <label for="item{c_uid}">{it_uid}</label>
    </td>
    <td>{ty_title}</td>
    <td>{c_primary}</td>
    <td>{c_secondary}</td>
  </tr>{:item}
</table>

<p><b>Gear</b> that is checked out:</p>

<table class="cleanHeaders compact top">
  <tr>
    <th colspan="2">Type</th>
    <th>Qty</th>
    <th>Description</th>
  </tr>{gear:}
  <tr>
    <td>
      <input type="checkbox" name="gear[]" value="{c_uid}" id="gear{c_uid}" />
    </td>
    <td>
      <label for="gear{c_uid}">{ic_title} &raquo; {it_title}</label>
    </td>
    <td>{c_qty}</td>
    <td>{c_description}</td>
  </tr>{:gear}
</table>

<p><input type="submit" name="submitted" value="Check in Selected Equipment"></p>

</form>

</div>
