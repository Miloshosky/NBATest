<?php
	require_once('../../includes/config.php');
	require_once('../adminInclude/head.php');
	require_once('../adminInclude/navbar.php');

	if(isset($_POST['submit']))
	{
		$_POST = array_map('stripslashes', $_POST);
	}
	extract($_POST);

	if($playerFirstName == '')
	{
		$error[] = 'Please enter first name!';
	}
	if($playerLastName == '')
	{
		$error[] = 'Please enter last name!';
	}
	if($playerNumber == '')
	{
		$error[] = 'Please enter player number!';
	}
	if($playerBirthDate == '')
	{
		$error[] = 'Please enter date of birth!';
	}
	if($playerHeight == '')
	{
		$error[] = 'Please enter player height!';
	}
	if($playerWeight == '')
	{
		$error[] = 'Please enter player weight!';
	}

	if(!isset($error))
	{
		try
		{
			$selPlayer = $db->prepare('INSERT INTO players (playerFirstName, playerLastName, playerBirthDate, playerHeight, playerWeight, playerNumber, playerPosition, playerBio) VALUES (:playerFirstName, :playerLastName, :playerBirthDate, :playerHeight, :playerWeight, :playerNumber, :playerPosition, :playerBio)');
			$selPlayer->execute(array(
				':playerFirstName' => $playerFirstName,
				':playerLastName' => $playerLastName,
				':playerNumber' => $playerNumber,
				':playerBirthDate' => $playerBirthDate,
				':playerHeight' => $playerHeight,
				':playerWeight' => $playerWeight,
				':playerPosition' => $playerPosition,
				':playerBio' => $playerBio,
			));
			header('Location: ../view/players.php');
			exit;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

?>

<div id="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="../">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Add player</li>
		</ol>
<br>
			<div class="card mb-3">
				<div class="card-header">
				<i class="fa fa-user-plus"></i>
					Add player
				</div>
				<div class="card-body">
					<form action="" method='post'>
						<div class="form-row">
							<div class="form-group col-md-4">
								<input type="text" placeholder="First Name" class="form-control" name="playerFirstName" required value='<?php if(isset($error)) {echo $_POST['playerFirstName'];} ?>'>
							</div>
							<div class="form-group col-md-4">
								<input type="text" name="playerLastName" placeholder="Last Name" class="form-control" required>
							</div>
							<div class="form-group col-md-4">
								<input type="number" min="0" max="99" name="playerNumber" placeholder="Player number" class="form-control" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<input type="date" name="playerBirthDate" max="2005-01-01" placeholder="Date of birth" class="form-control" required>
							</div>
							<div class="form-group col-md-4">
								<input type="number" name="playerHeight" placeholder="Height" class="form-control" required="">
							</div>
							<div class="form-group col-md-4">
								<input type="number" name="playerWeight" placeholder="Weight" class="form-control" required>
							</div>
						</div>
						<h5>Select player position</h5>
						<div class="form-row">
							<div class="form-check form-check-inline col-md-1">
								<input class="form-check-input" type="radio" name="playerPosition" value="d" checked>
								<label class="form-check-label" for="d">Defence</label>
							</div>
							<div class="form-check form-check-inline col-md-1">
								<input class="form-check-input" type="radio" name="playerPosition" value="c">
								<label class="form-check-label">Center</label>
							</div>
							<div class="form-check form-check-inline col-md-1">
								<input class="form-check-input" type="radio" name="playerPosition" value="f">
								<label class="form-check-label">Forward</label>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label>Player Bio</label>
							<textarea class="form-control" row="10" name="playerBio"></textarea>
						</div>
						<div class="form-row">
							<button class="btn btn-info col-md-3" style="color:black; font-weight: bold; margin-right:5px;" name="submit">Submit</button> 
							<button class="btn btn-danger col-md-3" style="color:black; font-weight: bold" onclick="this.form.reset();">Reset</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>