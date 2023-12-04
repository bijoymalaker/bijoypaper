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
                        <h3 class="card-title">Add New User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Enter your user name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Enter user phone number" name="phone" min="11" max="11" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="mail" class="form-control" placeholder="Enter your Email" name="email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-control" aria-label="Default select example" name="role">
                                        <option selected>Select your field</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Editor</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Is Active</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-control" aria-label="Default select example" name="is_active">
                                        <option selected>Select your field</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-control" aria-label="Default select example" name="category_id">
                                        <option selected>Select your field</option>
                                        <?php
                                        // $query = "SELECT * FROM category";
                                        // $allCategories = mysqli_query($conn, $query);
                                        // while ($row = mysqli_fetch_assoc($allCategories)) {
                                        //     $category_id = $row['id'];
                                        //     $name = $row['name']
                                        ?>

                                        <!-- <option value="">
                                            </option> -->
                                                <?php //} 
                                                ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="Re-password" name="confirm_password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputFile" class="col-sm-2 col-form-label">Image</label>

                                <div class="col-sm-10">
                                    <input type="file" name="image" id="" placeholder="Upload Image">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Enter Address" name="address">
                                </div>
                            </div>
                        </div>
                
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right" name="user_submit">Submit</button>
                    </div>
                <!-- /.card-footer -->
                    </form>
                </div>
                <?php
                if (isset($_POST['user_submit'])) {
                    //    echo var_dump($_POST['user_submit']);
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    $role = $_POST['role'];
                    $is_active = $_POST['is_active'];
                    // $category_id = $_POST['category_id'];
                    $category_id = 1;
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];
                    $address = $_POST['address'];
                    // Image Uploaded code 
                    $image       = $_FILES['image'];
                    $imageName   = $_FILES['image']['name'];
                    $imageSize   = $_FILES['image']['size'];
                    $imageType   = $_FILES['image']['type'];
                    $imageTmp    = $_FILES['image']['tmp_name'];
                    $location    = "dist/img/users";

                    $imageAllowedExtention = array('jpg', 'jpeg', 'png');
                    $imageExtention = strtolower(end(explode('.', $imageName)));

                    $image = rand(0, 200000) . '_' . $imageName;
                    move_uploaded_file($imageTmp, $location / $image);

                    // if ($password!=$confirm_password) {

                    // }


                    //                 if (!empty($imageName)) {

                    //                     if (!empty($imageName ) && !in_array($imageExtention,$imageAllowedExtention)) {
                    //                         $formError= "Please Upload Your Valid Image Format.";
                    //                      }
                    //                      if (!empty($imageName ) && $imageSize > 2097152) {
                    //                         $formError= "Image size larger then 2mb";
                    //                      }
                    //                 }


                    $user_sql = "INSERT INTO users (name,phone,email,role,is_active,address,category_id,image,password, date) values ('$name','$phone','$email','$role','$is_active','$address','$category_id','$image','$password', now())";
                    $user = mysqli_query($conn, $user_sql);
                    if (!$user) {
                        die("Query Failed!" . mysqli_error($conn));
                    } else {
                        header("Location:user.php");
                    }
                    $conn->close();
                }
                ?>
            </div>
            <?php
            // if (isset($_GET['update'])) {
            //     $district_id = $_GET['update'];
            //     $update_district_query = "SELECT * FROM district WHERE id = $district_id";
            //     $update_district = mysqli_query($conn, $update_district_query);
            //     while ($row = mysqli_fetch_assoc($update_district)) {
            //         $id = $row['id'];
            //         $district_name = $row['name'];

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

                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter district name" name="name" value="<?php echo $district_name;
                                                                                                                                // } 
                                                                                                                                ?>">
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

            <?php //} 
            ?>




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
                                    $countryId = $row['country_id'];


                                ?>

                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <?php
                                        $countryQuery = "SELECT * FROM country WHERE id = '$countryId'";
                                        $allCountries = mysqli_query($conn, $countryQuery);
                                        while ($row = mysqli_fetch_assoc($allCountries)) {
                                            $country = $row['name'];
                                        ?>

                                            <td><?php echo $country;
                                            } ?></td>
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
                            $deleteDistrict = mysqli_query($conn, $delete_query);
                            if ($deleteDistrict) {
                                header("Location:district.php");
                            } else {
                                die('Query Failed!' . mysqli_error($conn));
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
</div>


</section>
</div>
<!-- /.content-wrapper -->


<!-- Main Footer -->
<?php include "include/footer.php" ?>