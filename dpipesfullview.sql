SELECT dpipesnew.id, units.name as unit, areas.name as area, dpipesnew.tag, diameters.dn as diameter,
(SELECT CASE WHEN (dpipesnew.calc_notes=1) THEN 2
 WHEN (diameters.dn>=50) THEN 1
 ELSE 0
END) AS 'tpipes_id',
(SELECT tpipes.code FROM tpipes WHERE tpipes_id=tpipes.id) AS type,
dpipesnew.ppipe_pids_id as pid,
dpipesnew.ppipe_isos_id as iso,
dpipesnew.ppipe_stresses_id as stress,
dpipesnew.ppipe_supports_id as supports
 FROM units JOIN areas JOIN dpipesnew 
JOIN diameters WHERE dpipesnew.units_id=units.id AND dpipesnew.areas_id=areas.id AND dpipesnew.diameters_id=diameters.id