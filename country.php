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
            <h3 class="card-title">Add Country</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post">
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control text-capitalize" placeholder="Enter Country Name" name="name">
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
            $sql = "INSERT INTO country (name) values ('$name')";
            $submit = mysqli_query($conn, $sql);
            if (!$submit) {
              die("Query Failed!" . mysqli_error($conn));
            } else {
              header("Location:country.php");
            }
            $conn->close();
          }
          ?>

        </div>
        <?php 
        if (isset($_GET['update'])) {
          //echo var_dump($_GET['update']);
          $country_id = $_GET['update'];
          $update_country_query = "SELECT * FROM country WHERE id =$country_id";
          $update_country = mysqli_query($conn, $update_country_query);
          while($row = mysqli_fetch_assoc($update_country)){
            $id = $row['id'];
            $name = $row['name'];
          
          ?>
        
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Update Country</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post">
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control text-capitalize" placeholder="Enter Country Name" name="name" value="<?php echo $name ?>">
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
          }
          if (isset($_POST['update'])) {
            $name = $_POST['name'];
            $sql = "UPDATE `country` SET `name`='$name' WHERE id = $country_id";
            $submit = mysqli_query($conn, $sql);
            if (!$submit) {
              die("Query Failed!" . mysqli_error($conn));
            } else {
              header("Location:country.php");
            }
            $conn->close();
          }
          ?>

        </div>
     <?php }
        
      ?>





      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Country</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#SL</th>
                  <th>Country Name</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT * FROM country";
                $allCountries = mysqli_query($conn, $query);
                $i = 0;
                while ($row = mysqli_fetch_assoc($allCountries)) {
                  $i++;
                  //echo var_dump($row);
                  $id = $row['id'];
                  $name = $row['name'];
                  //echo var_dump($name); 
                ?>
                  <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo ucfirst($name); ?></td>
                    <td class="d-flex">
                      <a href="country.php?update=<?php if (isset($id)) {
                                                  echo $id;
                                                } ?>" class="btn btn-outline-success"><i class="far fa-edit" title="Update"></i></a>
                      <a href="country.php?delete=<?php echo $id ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt" title="Delete"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php
            if (isset($_GET['delete'])) {
              $id = $_GET['delete'];
              $delete_query = "DELETE FROM country WHERE id = '$id'";
              $deleteCountry = mysqli_query($conn, $delete_query);
              if ($deleteCountry) {
                header("Location:country.php");
              } else {
                die("Delete Query Failed! " . mysqli_error($conn));
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