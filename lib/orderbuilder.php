<?php
	
	function buildOrder($paramarray)
	{
		
		$add = 0;
		
		// to prevent injection during what we'll do next, we need to limit valid keys
		$acceptedIncomingVars = 'orderby';

		
		// loop through request as array
		foreach ($paramarray as $key => $value) {
			// lowercase it
			$key = strtolower($key);
			// if it's acceptable
			if ($key === $acceptedIncomingVars) {
				// allow us to reference it by the key
				$add = 1;
				$orderby = $value;
			}
		}
		
		
		if ($add)
		{
			return " ORDER BY " . $orderby . " ASC ";
		}
		
		
	}
?>