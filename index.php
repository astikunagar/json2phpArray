<?php
	/**
	 *
	 * Recursion alert!
	 * This function  will traverse through the object and the child beneath the node to extract data.
	 *
	 */
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
?>


<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>Json-Beautify</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.min.css" />
		<style>
		.input, .output{
			border : 1px solid orange;
			border-radius: 10px;
			margin: 1%;
			box-shadow: 5px 5px;
		}
		.bg-gradient {
			background-image: -moz-linear-gradient( 135deg, rgba(60, 8, 118, 0.8) 0%, rgba(250, 0, 118, 0.8) 100%);
			background-image: -webkit-linear-gradient( 135deg, rgba(60, 8, 118, 0.8) 0%, rgba(250, 0, 118, 0.8) 100%);
			background-image: -ms-linear-gradient( 135deg, rgba(60, 8, 118, 0.8) 0%, rgba(250, 0, 118, 0.8) 100%);
			background-image: linear-gradient( 135deg, #29abe0 0%, #d9534f 100%);
		}
		.whiteTitle{
			    font-family: "Comic Sans MS", cursive, sans-serif;
			    color: #FEFEFE;
		}
		.greenTitle{
			    font-family: "Comic Sans MS", cursive, sans-serif;
			    color: #93c54b;
			    font-weight: bold;
		}
		</style>
	</head>
	<body class="bg-gradient">
		<section class="col-lg-12">
			<center><h1 class='whiteTitle'>Json/Serialized Encoded String 2 Php Array</h1></center>
		</section>
		<section class="col-lg-4 input">
			<form class="form-horizontal" name="check_array" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<fieldset>
					<legend></legend>
					<div class="form-group">
						<label for="josn_array" class="col-lg-4 control-label whiteTitle" name="array_label"> Input Json Array </label>
						<div class="col-lg-7">
							<textarea name="use_array[value]" class="form-control" cols="100" rows="15">
								<?php 
									if(isset($_REQUEST['use_array']['value']) && $_REQUEST['use_array']['value']!=="")
									{
										echo $_REQUEST['use_array']['value'];
									}
								?>
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="textArea" class="col-lg-4 control-label whiteTitle">Is is a Serialized String?</label>
						<div class="col-lg-7">
							<input type="radio" name="use_array[unserialize]" value="1">Yes
							<input type="radio" name="use_array[unserialize]" value="0">No
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12 col-lg-offset-2">
							<button type="reset" class="btn btn-default">Cancel</button>
							<button type="submit" class="btn btn-primary" name="use_array[submit]">Submit</button>
						</div>
					</div>
				</fieldset>
			</form>
		</section>
		<?php 
			if(isset($_REQUEST['use_array']))
			{
		?>
				<section class="col-lg-7 output">
				<?php

					if(isset($_REQUEST['use_array']['unserialize']) && $_REQUEST['use_array']['unserialize']=="1")
					{
						$arr_value = unserialize($_REQUEST['use_array']['value']);
					}
					else
					{
						$arr_value = json_decode($_REQUEST['use_array']['value']);
					}

					$trav = traverse_array($arr_value);
					if(is_array($trav) && !empty($trav))
					{
			 			echo '<p><h4 class="greenTitle"><center>PHP Array</center></h4></p><textarea cols=85 rows=23>';
						print_r($trav);echo "</textarea>";
					}
					else
					{
			 	?>			
			 		<center> <p class="text-warning whiteTitle"> Please insert a valid encoded string!</p><center>
			 		<?php
					}
					?>
				</section>
		<?php
			}
		?>
	</body>
</html>
