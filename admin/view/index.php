<?php
  require_once('../../includes/config.php');
  require_once('../../includes/dispErrors.php');


  if(!$user->is_logged())
  {
    header('Location: login.php');
  }

?>

<!DOCTYPE html>
<html lang="en">

    <?php
    require('../adminInclude/head.php');
      // <!-- Sidebar -->
    require('../adminInclude/navbar.php');
    ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-6 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-user-plus"></i>
                  </div>
                  <div class="mr-5">Add new player!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="../mod/addPlayer.php">
                   <i class="fa fa-user-plus"></i>
                  <span class="float-right">
                   <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            
            <div class="col-xl-6 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fa fa-flag-checkered"></i>
                  </div>
                  <div class="mr-5">Add new team!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="../mod/addTeam.php">
                  <i class="fa fa-flag-checkered"></i>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Recently added players</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th>Birth Date</th>
                      <th>Age</th>
                      <th>Height</th>
                      <th>Weight</th>
                      <th>Player Number</th>
                      <th>Player Position</th>
                      <th>Team</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th>Birth Date</th>
                      <th>Age</th>
                      <th>Height</th>
                      <th>Weight</th>
                      <th>Player Number</th>
                      <th>Player Position</th>
                      <th>Team</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                    <?php

                      $selPlayer = $db->query('SELECT * FROM players ORDER BY playerLastName');
                      while($row = $selPlayer->fetch())
                      {
                        echo '<tr>';
                        echo '<td>' . $row['playerLastName'] . '</td>';
                        echo '<td>' . $row['playerFirstName'] . '</td>';
                        echo '<td>' . $row['playerBirthDate'] . '</td>';
                        $bDay = $row['playerBirthDate'];
                        $pbDay = new DateTime($bDay);
                        $now = new DateTime();
                        $dif = $now->diff($pbDay);
                        $age = $dif->y;
                        echo '<td>' . '<p hidden>'.$row['playerBirthDate'].'</p>' . $age . '</td>';
                        
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
                        //echo '<td>' . $row['team'] . '</td>';
                        echo '</tr>';
                      }

                    ?>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updating every hour</div>
          </div>

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

      require('../adminInclude/footer.php');

    ?>
