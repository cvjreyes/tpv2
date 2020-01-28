select units.name as units, areas.name as areas, tpipes.code, epipesnew.qty
from epipesnew join units join areas join tpipes where epipesnew.units_id=units.id and epipesnew.areas_id=areas.id and epipesnew.tpipes_id=tpipes.id
order by areas.name