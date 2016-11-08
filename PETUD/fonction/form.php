<?php
	function keepSelected($value)
	{
		if(isset($_GET['liste']))
		{
			if($_GET['liste'] == $value)
			{
				echo 'selected="selected"';
			}
		}
	}
?>
