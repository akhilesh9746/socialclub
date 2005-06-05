update [_]expense as ex
set ex.c_flags = ex.c_flags | 128
where ex.c_uid = {expense,int}
