update [_]expense as ex
    inner join [_]flag as fl on fl.c_title = 'reimbursable'
set ex.c_flags = ex.c_flags | fl.c_bitmask
where ex.c_uid = {expense,int}
