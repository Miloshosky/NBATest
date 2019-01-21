<?php
	require_once('../../includes/config.php');
	require_once('../adminInclude/head.php');
	require_once('../adminInclude/navbar.php');
	if(isset($_POST['submit']))
	{
		$_POST = array_map('stripslashes', $_POST);
		extract($_POST);
		if($playerFirstName == '')
		{
			$error[] = 'Please enter first name';
		}
		if($playerLastName == '')
		{
			$error[] = 'Please enter last name';
		}
		if($playerNumber == '')
		{
			$error[] = 'Please enter number';
		}
		if($playerBirthDate == '')
		{
			$error[] = 'Please enter date of birth';
		}
		if($playerHeight == '')
		{
			$error[] = 'Please enter height';
		}
		if($playerWeight == '')
		{
			$error[] = 'Please enter weight';
		}
		if($playerPosition == '')
		{
			$error[] = 'Please enter position';
		}
		if(!isset($error))
		{
			try
			{
				$selPlayer = $db->prepare('UPDATE players SET playerFirstName = :playerFirstName, playerLastName = :playerLastName, playerBirthDate = :playerBirthDate, playerHeight = :playerHeight, playerWeight = :playerWeight, playerNumber = :playerNumber, playerPosition = :playerPosition, playerBio = :playerBio, ptID = :team WHERE playerID = :playerID');
				$selPlayer->execute(array(
					':playerFirstName' => $playerFirstName,
					':playerLastName' => $playerLastName,
					':playerBirthDate' => $playerBirthDate,
					':playerHeight' => $playerHeight,
					':playerWeight' => $playerWeight,
					':playerNumber' => $playerNumber,
					':playerPosition' => $playerPosition,
					':playerBio' => $playerBio,
					':team' => $team,
					':playerID' => $playerID
					));
				header('Location: ../view/index.php');
				exit;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	try
	{
		
		$selPlayer = $db->prepare('SELECT * FROM players WHERE playerID = :playerID');
		$selPlayer->execute(array(':playerID' => $_GET['id']));
		$row = $selPlayer->fetch();
		// $cdRow = $selTeam->fetch();
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	
?>
<div id="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="../">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Edit player</li>
		</ol>
		
		<br>
		<div class="card mb-3">
			<div class="card-header">
				<i class="fa fa-user-plus"></i>
				Edit player
			</div>
			<div class="card-body">
				<form action="" method='post'>
					<div class="form-row">
						<input type='hidden' name='playerID' value='<?php echo $row['playerID'];?>'>
						<div class="form-group col-md-4">
							<input type="text" placeholder="First Name" class="form-control" name="playerFirstName" required value='<?php echo $row['playerFirstName']; ?>'>
						</div>
						<div class="form-group col-md-4">
							<input type="text" name="playerLastName" placeholder="Last Name" class="form-control" required value='<?php echo $row['playerLastName']; ?>'>
						</div>
						<div class="form-group col-md-4">
							<input type="number" min="0" max="99" name="playerNumber" placeholder="Player number" class="form-control" required value='<?php echo $row['playerNumber']; ?>'>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<input type="date" name="playerBirthDate" max="2005-01-01" placeholder="Date of birth" class="form-control" required value='<?php echo $row['playerBirthDate']; ?>'>
						</div>
						<div class="form-group col-md-4">
							<input type="number" name="playerHeight" placeholder="Height" class="form-control" required value='<?php echo $row['playerHeight']; ?>'>
						</div>
						<div class="form-group col-md-4">
							<input type="number" name="playerWeight" placeholder="Weight" class="form-control" required value='<?php echo $row['playerWeight']; ?>'>
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
							<input class="form-check-input" type="radio" name="playerPosition" value="f" >
							<label class="form-check-label">Forward</label>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="dropdown col-md-12">
							<!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> -->
							<!-- <a class="dropdown-item" href="#">Action</a> -->
							<?php
							$sql = $db->query('SELECT * FROM teams ORDER BY teamName');
							
							?>
							<select name="team" class="form-control" required   style="margin-right:0;">
								<option selected hidden disabled>Select Team</option>
								<?php foreach ($sql->fetchAll() as $option) : ?>
								<option value="<?php echo $option['teamID']; ?>"><?php echo $option['teamName']; ?></option>
								<?php endforeach; ?>
							</select>
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
<?php
	require('../adminInclude/footer.php');
?>