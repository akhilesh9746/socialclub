-- Updates a given row in a tale to have the primary flag, and all others to have it
-- unset.
-- Parameters:
-- {table,none}  The table to update
-- {object,int}  The object to make primary
-- {primary,int} The bitmask value for primary
-- {member,int}  The member for which to update the objects
update {table,none}
    set c_flags = case
    when (c_uid = {object,int}) then c_flags | {primary,int}
    else c_flags & ~{primary,int} end
    where c_owner = {member,int}
