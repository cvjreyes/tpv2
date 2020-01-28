SET @line_id=3;

SELECT pid,iso,stress,support, (((pid*w_pid)+(iso*w_iso)+(stress*w_stress)+(support*w_support))/(weight)) as progress 
FROM dpipesfullview
WHERE id=@line_id 