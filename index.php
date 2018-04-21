<?php
/*$time_slot_arr = Array
(
    "timeslot_0" => Array
        (
            "sort_period" => "1",
            "start_time" => "04:00 PM",
            "end_time" => "07:00 PM",
            "order_type" => "0",
            "express_order_limit" => "100",
            "express_order_price" => "1",
            "standard_order_limit" => "100 ",
            "standard_order_price" => "1"
        ),

    "timeslot_1" => Array
        (
            "sort_period" => "2",
            "start_time" => "07:00 PM",
            "end_time" => "10:00 PM",
            "order_type" => "0",
            "express_order_limit" => "100",
            "express_order_price" => "1",
            "standard_order_limit" => "100",
            "standard_order_price" => "1"
        ),

    "timeslot_2" => Array
        (
            "sort_period" => "3",
            "start_time" => "07:00 AM",
            "end_time" => "07:00 AM",
            "order_type" => "0",
            "express_order_limit" => "100",
            "express_order_price" => "1",
            "standard_order_limit" => "100",
            "standard_order_price" =>  "1"
        )

);

echo serialize($time_slot_arr);exit;*/
if(isset($_REQUEST['use_array']))
{
	
	function traverse_array($arrVal=array())
	{
		//var_dump($arrVal)."<hr>";
		//echo "<b style='color:lightblue;'>recursion : demo"."</b><hr>";
		$result = array();
		if(!empty($arrVal) && (is_object($arrVal) || is_array($arrVal)))
		{
			foreach ($arrVal as $key => $arrValue) 
			{
				if(!empty($arrValue) && (is_object($arrValue) || is_array($arrValue)))
				{

					$result[$key]=traverse_array($arrValue);
				}	
				else
				{
					$result[$key]=$arrValue;
				}
			}
		}
		return $result;

	}
	if(isset($_REQUEST['use_array']['unserialize']) && $_REQUEST['use_array']['unserialize']=="1")
	{
		$arr_value = unserialize($_REQUEST['use_array']['value']);
	}
	else
	{
		$arr_value = json_decode($_REQUEST['use_array']['value']);
	}

	$trav = traverse_array($arr_value);
	echo "---::---<pre>"; print_r($trav);echo "</pre><hr>";
}
?>
<html>
<head runat="server">
    <title>Json-Beautify</title>
    <link runat="server" rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link runat="server" rel="icon" href="favicon.ico" type="image/ico"/>
</head>
<body>
	<form name="check_array" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="josn_array" name="array_label"> Input Json Array </label>	
		<textarea name="use_array[value]" col="100" row="5"></textarea>
		<br>
		<label for="josn_array" name="array_label"> Input comma separated Keys to display </label>	
		<textarea name="use_array[keys]" col="100" row="5"></textarea>
		<br>
		<input type="radio" name="use_array[unserialize]" value="1">Yes
		&nbsp;
		<input type="radio" name="use_array[unserialize]" value="0">No
		<br>
		<input type='submit' name="use_array[submit]" value="Visit array">
	</form>
</body>
</html>
