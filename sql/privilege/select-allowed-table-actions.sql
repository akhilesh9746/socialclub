-- Selects a list of all actions that the member is allowed to do on the table.
-- Parameters:
--      member: The UID of the member.
--      table:  The table in question.
--      applies_to_object: flag
--      root_group: The UID of the root group
select ac.*
from
    [_]action as ac
    -- Filter out actions that do not apply to this object type
    inner join [_]implemented_action as ia
        on ia.c_action = ac.c_uid and ia.c_table in({table,char}, '')
    -- Privileges that apply to the table and grant the given action
    -- Not an inner join because the action may be granted even if there is no
    -- privilege granting it.  For example, root users can take all actions.
    left outer join [_]privilege as pr
        on pr.c_related_table = {table,char}
            and pr.c_deleted <> 1
            and pr.c_action = ac.c_uid
            and pr.c_what_relates_to = 'table'
    -- Groups that the member belongs to, which may be null if he doesn't belong
    -- to any
    left outer join [_]member_group as mg on mg.c_member = {member,int}
        and mg.c_deleted <> 1
where
    -- The action must apply to tables (NOT apply to objects)
    (ac.c_flags & {applies_to_object,int} = 0) and (
        -- Members of the 'root' group are always allowed to do everything
        mg.c_related_group = {root_group,int}
        -- user privileges
        or (pr.c_what_granted_to = 'user' and pr.c_who_granted_to = {member,int})
        -- group privileges
        or (pr.c_what_granted_to = 'group' and pr.c_who_granted_to = mg.c_related_group))
order by ac.c_summary
