<?php
	require_once('../includes/config.php');
	require('navbar.php');
	$selPlayer = $db->query('SELECT players.*, teams.teamID, teams.teamName FROM players RIGHT JOIN teams ON players.ptID = teams.teamID ORDER BY players.playerID');
	$selPlayerNames = $db->query('SELECT players.*, teams.teamID, teams.teamName, teams.teamShortName FROM players RIGHT JOIN teams ON players.ptID = teams.teamID ORDER BY players.playerLastName');
?>
<style>
body
{
	/*background:gray;*/
}
</style>
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<aside>
					<div class="card">
						<div class="card-body">
							<?php
							while($prow = $selPlayerNames->fetch())
							{
								echo '<a href=players.php?id=' . $prow['playerID'] . '>' . $prow['playerLastName'] . ', ' . $prow['playerFirstName'] . '</a>' . '<span style="float:right;">' . $prow['teamShortName'] . '</span>' . '<hr>';
							}
							?>
						</div>
					</div>
				</aside>
				</div> <!-- col-md-2 -->
				<div class="col-md-9">
					<div class="row">
						<?php
							
							while($row = $selPlayer->fetch())
							{
								if(!isset($_GET['id']))
									{
									echo '<a href="players.php?id=' . $row['playerID'] . '">';
											echo '<section class="col-md-2 playerCard" name="player">';
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
								else if($row['playerID'] == $_GET['id'])
								{
									echo '<div class="card">';
										echo '<div class="card-head">';
										;
											echo '<img class="playerPageAvatar" src="img/playa.png">';
											echo '<div class="namePosition">';
											echo '<p style="text-transform: uppercase">' . $row['playerPosition'] . ' | #' . $row['playerNumber'] . '</p>';
											echo '<h4>' . $row['playerFirstName'] .'</h4>' . '<br>';
											echo '<h2>' . $row['playerLastName'] . '</h2>';
											echo '</div>';
										echo '</div>';
										echo '<div class="card-body">';
											echo $row['playerHeight'];
											echo $row['playerWeight'];
										echo '</div>';
									echo '</div>';
									
								}
							}
							
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	require('footer.php');
	?>