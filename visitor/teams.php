<?php
	require_once('../includes/config.php');
	require('navbar.php');
	$selTeamNames = $db->query('SELECT * FROM teams ORDER BY teamName');
	$selTeamPlayers = $db->query('SELECT * FROM players JOIN teams ON players.ptID = teams.teamID');

?>
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<aside>
					<div class="card">
						<div class="card-body">
							<?php
							while($crow = $selTeamNames->fetch())
							{
								echo '<a href=teams.php?id=' . $crow['teamID'] . '>' . $crow['teamName'] .'</a>' . '<span style="float:right;">' . $crow['teamShortName'] . '</span>' . '<hr>';
							}
							?>
						</div>
					</div>
				</aside>
			</div>
			<div class="col-md-9">
				<div class="row">
					<?php
						while($row = $selTeamPlayers->fetch())
						{
							if($row['ptID'] == $_GET['id'])
							{
								echo '<a href="players.php?id=' . $row['playerID'] . '">';
										echo '<section class="col-md-2 playerCard" name="player" >';
											echo '<span class="playerNumberCard">' . $row['playerNumber'] . '</span>';
											echo '<img class="avatar" src="img/playa.png" alt="Card image cap">';
											echo '<p>' . $row['playerFirstName'] . ' ' . $row['playerLastName'] . '</p>';
											
											switch($row['playerPosition'])
											{
												case 'c':
												echo '<strong><p>Center</p></strong>';
												break;
												case 'd':
												echo '<strong><p>Defence</p></strong>';
												break;
												case 'f':
												echo '<strong><p>Forward</p></strong>';
												break;
												default:
												echo '<strong><p>N/A</p></strong>';
											}
											echo '<p class="playerHeight"><strong>' . $row['playerHeight'] . '</strong>cm | <strong>' . $row['playerWeight'] . '</strong>kg' . '</p>';
											echo '<p>' . $row['teamName'] . '</p>';
										echo '</section>';
								echo '</a>';
							}
						}
					?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require('footer.php');
?>