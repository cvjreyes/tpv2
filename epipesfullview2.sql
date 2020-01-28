select areas.name, sum(epipesnew.qty) as weight
from epipesnew join areas where epipesnew.areas_id=areas.id group by epipesnew.areas_id 