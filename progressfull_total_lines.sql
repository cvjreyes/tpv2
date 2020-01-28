SELECT (((pid*w_pid)+(iso*w_iso)+(stress*w_stress)+(support*w_support))/(weight)) as progress 
FROM dpipesfullview
GROUP BY dpipesfullview.id;