

SELECT unit, area, ((sum((pid*w_pid)+(iso*w_iso)+(stress*w_stress)+(support*w_support)))/(sum(weight))) as progress 
FROM dpipesfullview group by area