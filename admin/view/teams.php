<?php

    require_once('../../includes/config.php');

    if(!$user->is_logged())
    {
      header('Location: login.php');
    }

?><!DOCTYPE html>
<html lang="en">

  <head>

  <?php
    require_once('../adminInclude/head.php');
  ?>

  </head>
      <!-- Sidebar AND Navbar -->
      <?php
        include('../adminInclude/navbar.php')
      ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Teams</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Teams</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      <th>Team Name</th>
                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                    <tr>
                      <th>Team Name</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    <?php

                      try
                      {
                        $selTeam = $db->query('SELECT * FROM teams ORDER BY teamName');
                        while($row = $selTeam->fetch())
                        {
                          echo '<tr>';
                          echo '<td>' . $row['teamName'] . '</td>';
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