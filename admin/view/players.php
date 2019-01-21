<?php
  
  require_once('../../includes/config.php');


?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <?php
    require_once('../adminInclude/head.php');
    ?>

  </head>

      <!-- Sidebar AND Navbar -->
     <?php
     	require('../adminInclude/navbar.php');
     ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Players</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Players</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th>Birth Date</th>
                      <th>Height <i>(cm)</i></th>
                      <th>Weight <i>(kg)</i></th>
                      <th>Number</th>
                      <th>Position</th>
                      <th>Team</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                    <tr>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th>Birth Date</th>
                      <th>Height <i>(cm)</i></th>
                      <th>Weight <i>(kg)</i></th>
                      <th>Number</th>
                      <th>Position</th>
                      <th>Team</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php

                      try
                      {
                        $selPlayer = $db->query('SELECT players.*, teams.teamID, teams.teamName FROM players RIGHT JOIN teams ON players.ptID = teams.teamID ORDER BY players.playerLastName');
                       

                        while($row = $selPlayer->fetch())
                        {
                          echo '<tr>';
                          echo '<td>' . $row['playerLastName'] . '</td>';
                          echo '<td>' . $row['playerFirstName'] . '</td>';
                          echo '<td>' . $row['playerBirthDate'] . '</td>';
                          echo '<td>' . $row['playerHeight'] . '</td>';
                          echo '<td>' . $row['playerWeight'] . '</td>';
                          echo '<td>' . $row['playerNumber'] . '</td>';
                          switch($row['playerPosition'])
                          {
                            case 'c':
                            echo '<td>Center</td>';
                            break;
                            case 'd':
                            echo '<td>Defence</td>';
                            break;
                            case 'f':
                            echo '<td>Forward</td>';
                            break;
                            default:
                            echo '<td>N/A</td>';
                          }
                          echo '<td>' . $row['teamName'] . '</td>';
                          ?>
                          <td>
                          <a href="../mod/editPlayer.php?id=<?php echo $row['playerID'];?>"><i class="fa fa-address-card"></i></a> | <a href="delete.php?id=<?php echo $row['playerID'];?>"><i class="fa fa-user-times"></i></a>
                          </td>
                          <?php
                          echo '</tr>';
                      
                        }
                      }

                      catch(PDOException $e)
                      {
                        echo $e->getMessage();
                      }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

          <p class="small text-center text-muted my-5">
            <em>More table examples coming soon...</em>
          </p>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
    
<?php
  include('../adminInclude/footer.php');
?>