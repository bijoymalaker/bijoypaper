<?php include "include/header.php" ?>

<!-- Navbar -->

<?php include "include/topber.php" ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include "include/sidemenu.php" ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section>

    <div class="row m-0">
      <div class="col-md-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Add District</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post">
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Country</label>
                <div class="col-sm-10">
                  <select class="form-select form-control" aria-label="Default select example" name="countryId">
                    <option selected>Select your field</option>
                    <?php
                    $query = "SELECT * FROM country";
                    $allCountries = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($allCountries)) {
                      $countryId = $row['id'];
                      $name = $row['name']
                    ?>

                      <option value="<?php echo $countryId ?>"><?php echo ucfirst($name) ?></option>
                    <?php } ?>

                  </select>
                </div>
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Enter district name" name="name">
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-info float-right" name="submit">Submit</button>
            </div>
            <!-- /.card-footer -->
          </form>
          <?php
          if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $countryId = $_POST['countryId'];
            $sql = "INSERT INTO district (name,country_id) values ('$name','$countryId')";
            $submit = mysqli_query($conn, $sql);
            if (!$submit) {
              die("Query Failed!" . mysqli_error($conn));
            } else {
              header("Location:district.php");
            }
            $conn->close();
          }
          ?>
        </div>
        <?php
            if (isset($_GET['update'])) {
              $district_id = $_GET['update'];
              $update_district_query = "SELECT * FROM district WHERE id = $district_id";
              $update_district = mysqli_query($conn,$update_district_query);
              while ($row = mysqli_fetch_assoc($update_district)) {
                $id = $row['id'];
                $district_name =$row['name'];
              
                ?>
                <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Update District</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post">
            <div class="card-body">
              <div class="form-group row">
                
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Enter district name" name="name" value="<?php echo $district_name;} ?>">
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-info float-right" name="update">Submit</button>
            </div>
            <!-- /.card-footer -->
          </form>
          <?php
              
          if (isset($_POST['update'])) {
            $name = $_POST['name'];
            $sql = "UPDATE `district` SET `name`='$name' WHERE id = '$district_id'";
            $submit = mysqli_query($conn, $sql);
            if (!$submit) {
              die("Query Failed!" . mysqli_error($conn));
            } else {
              header("Location:district.php");
            }
            $conn->close();
          }
        
          ?>
          
        </div>

      <?php } ?>
      </div>
          
        

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">District</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#SL</th>
                  <th>Country Name</th>
                  <th>District</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT * FROM district";
                $allDistrict = mysqli_query($conn, $query);
                $i = 0;
                while ($row = mysqli_fetch_assoc($allDistrict)) {
                  $i++;
                  $id = $row['id'];
                  $name = $row['name'];
                  $countryId =$row['country_id'];
                

                ?>
                
                <tr>
                  <td><?php echo $i ?></td>
                  <?php 
                $countryQuery= "SELECT * FROM country WHERE id = '$countryId'";
                $allCountries = mysqli_query($conn,$countryQuery);
                while ($row=mysqli_fetch_assoc($allCountries)) {
                  $country = $row['name'];
                 ?>

                  <td><?php echo $country; } ?></td>
                  <td><?php echo ucfirst($name) ?></td>
                  <td class="d-flex">
                    <a href="district.php?update=<?php echo $id ?>" class="btn btn-outline-success mr-2"><i class="far fa-edit" title="Update"></i></a>
                    <a href="district.php?delete=<?php echo $id ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt" title="Delete"></i></a>
                  </td>
                </tr>
                <?php } ?>
                
              </tbody>
            </table>
            <?php 
            if (isset($_GET['delete'])) {
              $id = $_GET['delete'];
              $delete_query = "DELETE FROM district WHERE id ='$id'";
              $deleteDistrict = mysqli_query($conn,$delete_query);
                if($deleteDistrict) {
                header("Location:district.php");
              }
              else {
                die('Query Failed!'.mysqli_error($conn));
              }
            }

            ?>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item"><a class="page-link" href="#">«</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>


  </section>
</div>
<!-- /.content-wrapper -->


<!-- Main Footer -->
<?php include "include/footer.php" ?>