-- Copy the c_flags from the expenses into the transactions to preserve the fact
-- that they are reimbursable
insert into [_]transaction
    (c_owner, c_creator, c_created_date, c_flags, c_category,
     c_amount, c_from, c_to, c_expense)
select
    {member,int}, {member,int}, now(), ex.c_flags, ex.c_category,
    abs(ex.c_amount), 
    case when (c_amount >= 0) then {from,int} else re.c_member end,
    case when (c_amount >= 0) then re.c_member else {from,int} end,
    ex.c_uid
from [_]expense as ex
    inner join [_]expense_report as re on ex.c_report = re.c_uid
where ex.c_report = {report,int}
    and ex.c_deleted <> 1
    and re.c_deleted <> 1
