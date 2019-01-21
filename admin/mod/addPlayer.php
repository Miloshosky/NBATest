<?php
	require_once('../../includes/config.php');
	require_once('../adminInclude/head.php');
	require_once('../adminInclude/navbar.php');
	if(isset($_POST['submit']))
	{
	
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
		if($playerNumber == '')
		{
			$error[] = 'Please enter player number!';
		}
		if($playerPosition == '')
		{
			$error[] = 'Please enter player position!';
		}
	
		if(!isset($error))
		{
			try
			{
				$selPlayer = $db->prepare('INSERT INTO players (playerFirstName, playerLastName, playerBirthDate, playerHeight, playerWeight, playerNumber, playerPosition, playerBio, ptID) VALUES (:playerFirstName, :playerLastName, :playerBirthDate, :playerHeight, :playerWeight, :playerNumber, :playerPosition, :playerBio, :teamName)');
				$selPlayer->execute(array(
					':playerFirstName' => $playerFirstName,
					':playerLastName' => $playerLastName,
					':playerNumber' => $playerNumber,
					':playerBirthDate' => $playerBirthDate,
					':playerHeight' => $playerHeight,
					':playerWeight' => $playerWeight,
					':playerPosition' => $playerPosition,
					':playerBio' => $playerBio,
					':teamName' => $_POST['teamID']
				));
				header('Location: ../view/players.php');
				exit;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	if(isset($error))
	{
		foreach($error as $err)
		{
			echo '<p class="error">' . $err . '</p>';
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
							<input type="text" placeholder="First Name" class="form-control" name="playerFirstName" value='<?php if(isset($error)) { echo $_POST['playerFirstName'];} ?>' required alt="First Name">
						</div>
						<div class="form-group col-md-4">
							<input type="text" name="playerLastName" placeholder="Last Name" class="form-control" value='<?php if(isset($error)) { echo $_POST['playerLastName'];} ?>' required>
						</div>
						<div class="form-group col-md-4">
							<input type="number" min="0" max="99" name="playerNumber" placeholder="Player number" class="form-control" value='<?php if(isset($error)) { echo $_POST['playerNumber'];} ?>' required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<input type="date" name="playerBirthDate" max="2005-01-01" placeholder="Date of birth" class="form-control" value='<?php if(isset($error)) { echo $_POST['playerBirthDate'];} ?>' required>
						</div>
						<div class="form-group col-md-4">
							<input type="number" name="playerHeight" placeholder="Height" class="form-control" value='<?php if(isset($error)) { echo $_POST['playerHeight'];} ?>' required>
						</div>
						<div class="form-group col-md-4">
							<input type="number" name="playerWeight" placeholder="Weight" class="form-control" value='<?php if(isset($error)) { echo $_POST['playerWeight'];} ?>' required>
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
					<div class="form-row">
						<?php
						try
						{
							$sql = $db->query("SELECT * FROM teams ORDER BY teamName");
						}
						catch(PDOException $e)
						{
							echo $e->getMessage();
						}
						?>
						<select name="team" required class="form-control col-md-6">
							<option disabled hidden required selected>Select Team</option>
							<?php foreach ($sql->fetchAll() as $option) : ?>
							<option value="<?php echo $option['teamID']; ?>"><?php echo $option['teamName']; ?></option>
							<?php endforeach; ?>
						</select>

						<?php

							if(isset($_FILES['playerPicture']))
							{
								printf($_FILES)
							}

						?>

						<label class="form-control col-md-6 btn btn-success"> Upload <input type="file" hidden name="playerPicture"></label>
					</div>
					<br>
					<div class="form-group">
						<label>Player Bio</label>
						<textarea class="form-control" row="10" name="playerBio" value='<?php if(isset($error)) { echo $_POST['playerBio'];} ?>'></textarea>
					</div>
					<div class="form-row">
						<input type='submit' class="btn btn-info col-md-3" style="color:black; font-weight: bold; margin-right:5px;" name="submit">
						<button class="btn btn-danger col-md-3" style="color:black; font-weight: bold" onclick="this.form.reset();">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<?php
	require('../adminInclude/footer.php');
?>