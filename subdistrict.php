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
            <h3 class="card-title">Add Sub-district</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post">
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">District</label>
                <div class="col-sm-10">
                  <select class="form-select form-control" aria-label="Default select example" name="districtId">
                    <option selected>Select your field</option>
                    <?php
                    $query = "SELECT * FROM district";
                    $allDistrict = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($allDistrict)) {
                      $districtId = $row['id'];
                      $name = $row['name'];
                    ?>
                      <option value="<?php echo $districtId ?>"><?php echo ucfirst($name) ?></option>
                    <?php } ?>

                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Enter Sub-district name" name="name">
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
            $district_id = $_POST['districtId'];
            $sql = "INSERT INTO sub_district (name,district_id) values ('$name','$district_id')";
            $submit = mysqli_query($conn, $sql);
            if (!$submit) {
              die("Query Failed!" . mysqli_error($conn));
            } else {
              header("Location:subdistrict.php");
            }
            $conn->close();
          }
          ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Sub-District</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#SL</th>
                  <th>Country Name</th>
                  <th>District</th>
                  <th>Sub-District</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT * FROM sub_district";
                $allSubDistrict = mysqli_query($conn, $query);
                $i = 0;
                while ($row = mysqli_fetch_assoc($allSubDistrict)) {
                  $i++;
                  $subDistrict_id = $row['id'];
                  $subDistrict_name = $row['name'];
                  $districtId = $row['district_id'];
                ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <?php
                    $districtQuery= "SELECT * FROM district WHERE id =$districtId";
                    $allDistrict = mysqli_query($conn,$districtQuery);
                    while ($row = mysqli_fetch_assoc($allDistrict)) {
                      $district_name = $row['name'];
                      $country_id = $row['country_id'];
                      $countryQuery = "SELECT * FROM country WHERE id =$country_id";
                      $allCountry = mysqli_query($conn,$countryQuery);
                    while ($row = mysqli_fetch_assoc($allCountry)){
                      $country_name = $row['name'];
                    
                  ?>
                  

                    <td><?php echo $country_name; } ?> </td>
                    <td><?php echo $district_name; } ?> </td>
                    <td><?php echo ucfirst($subDistrict_name) ?></td>
                    <td class="d-flex">
                      <a href="#" class="btn btn-outline-success mr-2"><i class="far fa-edit" title="Update"></i></a>
                      <a href="subdistrict.php?delete=<?php echo $id ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt" title="Delete"></i></a>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>
            <?php
            if (isset($_GET['delete'])) {
              $id = $_GET['delete'];
              $delete_query = "DELETE FROM sub_district WHERE id = '$id'";
              $deleteSubDistrict = mysqli_query($conn,$delete_query);
              if ($deleteSubDistrict) {
                header("Location:subdistrict.php");
              } else {
                die("Delete Query Failed!" . mysqli_error($conn));
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