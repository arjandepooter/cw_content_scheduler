 AND IF(
	NOT(%1$s.%5$s = '')
	AND %1$s.%4$s > 0
	AND %1$s.%3$s > 0
	AND %1$s.%2$s < %6$d
    AND %1$s.%3$s < %6$d,
	TIMESTAMPDIFF(SECOND, FROM_UNIXTIME(%1$s.%2$s), FROM_UNIXTIME(%6$d)) DIV
	(%1$s.%4$s * (CASE %1$s.%5$s
		WHEN 'm' THEN 60
		WHEN 'h' THEN 60*60
		WHEN 'd' THEN 24*60*60
		WHEN 'w' THEN 7*24*60*60
		ELSE 1
	END)) <>
	TIMESTAMPDIFF(SECOND, FROM_UNIXTIME(%1$s.%3$s), FROM_UNIXTIME(%6$d)) DIV
	(%1$s.%4$s * (CASE %1$s.%5$s
		WHEN 'm' THEN 60
		WHEN 'h' THEN 60*60
		WHEN 'd' THEN 24*60*60
		WHEN 'w' THEN 7*24*60*60
		ELSE 1
	END)),
	%1$s.%2$s < %6$d
	AND (%1$s.%3$s > %6$d OR %1$s.%3$s = 0)
)
