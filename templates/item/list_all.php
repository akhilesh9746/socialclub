<h1>Items</h1>

<style type="text/css">
.sort{SORT_COL} {
    background: #EEE;
}
tr.checked_out td {
    color:#008080;
}
tr.missing td {
    color:#808080;
    text-decoration: line-through;
}
</style>

{FORM}

{NONE:}
<p class="notice">There were no results.</p>
{:NONE}

{GENERIC:}

<p>{NUM_ROWS} items found.  Color key: <span style="color:#008080">checked
out</span>, <span style="color:#808080; text-decoration:
line-through">missing</span></p>

<table class="borders collapsed elbowroom compact top">
  <tr>
    <th>ID#</th>
    <th>Qty</th>
    <th>Condition</th>
    <th>Type</th>
    <th>Details 1</th>
    <th>Details 2</th>
  </tr>{item:}
  <tr class="{status}">
    <td class="sortID">
      <a href="members/item/read/{ID}">{ID}</a>
    </td>
    <td class="sortqty">{qty}</td>
    <td class="sortcondition">{condition}</td>
    <td class="sorttype">{type}</td>
    <td class="sortdetails1">{details1}</td>
    <td class="sortdetails2">{details2}</td>
  </tr>{:item}
</table>
{:GENERIC}

{BY_TYPE:}

<p>{NUM_ROWS} items matched your query.  Color key: <span
style="color:#008080">checked out</span>, <span style="color:#808080;
text-decoration: line-through">missing</span>.</p>

<table class="borders collapsed elbowroom compact top" style="background:white">
  <tr>
    <th>ID#</th>
    <th>Qty</th>
    <th>Condition</th>{header:}
    <th>{c_name}</th>{:header}
  </tr>{item:}
  <tr class="{status_table}">
    <td class="sortID">
      <a href="members/item/read/{ID_table}">{ID_table}</a>
    </td>
    <td class="sortqty">{qty_table}</td>
    <td class="sortcondition">{condition_table}</td>{bodyrow:}
    <td class="sort{c_name}">{{c_name}_table}</td>{:bodyrow}
  </tr>{:item}
</table>
{:BY_TYPE}
