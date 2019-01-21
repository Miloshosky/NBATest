<?php
	require_once('../../includes/config.php');
	require_once('../adminInclude/head.php');
	require_once('../adminInclude/navbar.php');

	if(isset($_POST['submit']))
	{
		extract($_POST);
		if($teamName == '')
		{
			$error[] = 'Please enter team name!';
		}
		if(!isset($error))
		{
			try
			{
				$selTeam = $db->prepare("INSERT INTO teams (teamName, teamShortName) VALUES (:teamName, :shortName)");
				$selTeam->execute(array(
					':teamName' => $teamName,
					':shortName' => $tsNamell
				));
				$row = $selTeam->fetch();
			header('Location: ../view/teams.php');
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
			echo '<p class="alert alert-danger error"' . $err . '</p>';
		}
	}
	


?>

	<div id="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="../">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Add team</li>
		</ol>
<br>
			<div class="card mb-3">
				<div class="card-header">
				<i class="fa fa-user-plus"></i>
					Add team
				</div>
				<div class="card-body">
					<form action="" method='post'>
						<div class="form-row">
							<div class="form-group col-md-6">
								<input type="text" placeholder="Team Name" class="form-control" name='teamName' required value='<?php if(isset($error)) {echo $_POST['teamName'];} ?>'>
								<input type="text" placeholder="Short Name" class="form-control" name='tsName' required value='<?php if(isset($error)) {echo $_POST['teamShortName'];} ?>'>
							</div>
							
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