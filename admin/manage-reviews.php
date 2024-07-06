<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Prince Tailors</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png?v=<?php echo time(); ?>" rel="icon">
  <link href="assets/img/apple-touch-icon.png?v=<?php echo time(); ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css?v=<?php echo time(); ?>" rel="stylesheet">


  <!-- main cssfile -->
  <link href="assets/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">


</head>
<?php include('../inlcudes/db.php') ?>

<body>

  <!-- ======= Header ======= -->
  <!-- End Header -->
  <?php include('components/Header.php') ?>
  <!-- ======= Sidebar ======= -->
  <?php include('components/sidebar.php') ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index">Home</a></li>
          <li class="breadcrumb-item active">Manage Reviews</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="container-fluid p-2">
        <h1 class="text-primary mb-2">Manage Reviews</h1>

      
      <div class="container">
        <!-- database data -->
        <?php
if (isset($_POST['delete_profile'])) {
    $id = $_POST['delete_id'];

    $query = "SELECT * FROM Review WHERE ID='$id'";
    $query_run = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($query_run);

    $deleteQuery_run = mysqli_query($conn, $deleteQuery);

    if ($deleteQuery_run) {
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete); // Delete the associated file
        }

        echo '<div class="alert alert-danger" role="alert" id="alert">
            Service Deleted. ID: ' . $id . '
        </div>';
    } else {
        echo '<div class="alert alert-warning" role="alert" id="alert">
            Service Not Deleted. ID: ' . $id . '
        </div>';
    }
}
?>

<?php
if (isset($_POST['change_status'])) {
    $id = $_POST['id'];

    // Get current status
    $sql_get_status = "SELECT status FROM Review WHERE ID = $id";
    $result_get_status = $conn->query($sql_get_status);
   
    if ($result_get_status->num_rows > 0) {
        $row = $result_get_status->fetch_assoc();
        $current_status = $row["status"];
   
        // Update status based on current status
        if ($current_status == 1 || $current_status == 2) {
            $new_status = 0;
        } elseif ($current_status == 0) {
            $new_status = 1;
        }else{
            $new_status = 2;
        }
   
        // Update status in the database
        $sql_update_status = "UPDATE Review SET status = $new_status WHERE ID = $id";
   
        if ($conn->query($sql_update_status) === TRUE) {
            echo'<div class="alert alert-primary" role="alert" id="alert">
            Status for ID: '.$id.' changed successfully !
</div>';
        } else {
            echo "Error updating status: " . $conn->error;
        }
    } else {
        echo "No record found for the provided ID";
    }
   }
?>
<?php
if (isset($_POST['change_p_status'])) {
    $id = $_POST['id'];

 // Get current status
 $sql_get_status = "SELECT status FROM Review WHERE ID = $id";
 $result_get_status = $conn->query($sql_get_status);

 if ($result_get_status->num_rows > 0) {
     $row = $result_get_status->fetch_assoc();
     $current_status = $row["status"];

     // Update status based on current status
   

     // Update status in the database
     $sql_update_status = "UPDATE Review SET status = 2 WHERE ID = $id";

     if ($conn->query($sql_update_status) === TRUE) {
        echo'<div class="alert alert-primary" role="alert" id="alert">
        Status for ID: '.$id.' changed successfully !
</div>';
     } else {
         echo "Error updating status: " . $conn->error;
     }
 } else {
     echo "No record found for the provided ID";
 }
}
?>



<!-- delte selectedcode -->
<?php
if (isset($_POST['delete_selected'])) {
    if (!empty($_POST['delete_id'])) {
        $deleteIDs = implode(",", $_POST['delete_id']);

        // Establish database connection - $conn should be your database connection object
        $deleteQuery = "SELECT file_path FROM Review WHERE ID IN ($deleteIDs)";
        $result = mysqli_query($conn, $deleteQuery);

        if ($result) {
        

            // Now, perform the database deletion
            $deleteQuery = "DELETE FROM Review WHERE ID IN ($deleteIDs)";
            $deleteResult = mysqli_query($conn, $deleteQuery);

            if ($deleteResult) {
                echo '<div id="alert" class="alert alert-success" role="alert">Selected entries deleted successfully.</div>';
                // Redirect to a different page or refresh the current page after deletion
                // header("Location: yourpage.php");
            } else {
                echo '<div id="alert" class="alert alert-danger" role="alert">Error deleting selected entries.</div>';
            }
        } else {
            echo '<div id="alert" class="alert alert-danger" role="alert">Error fetching file paths for deletion.</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">No entries selected for deletion.</div>';
    }
}
?>


<!-- delete selected code  -->
        <form action="" method="POST">
                    <?php
try {
    $query = "SELECT * FROM Review ORDER BY id DESC";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="text-dark">
                <th scope="col">Select</th>
                <th scope="col">Date</th>
                <th scope="col"> Name</th>
                <th scope="col"> Email</th>
              
                <th scope="col">Message</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($query_run)) {
       


            ?>
            <tr>
                <td> <input class="form-check-input" type="checkbox" name="delete_id[]" value="<?php echo $row['ID']; ?>"></td>
                <td><?php echo $row['up_date']; ?></td>
                <td><?php echo $row['name']; ?></td>
              
                <td><?php echo $row['email']; ?></td>
                <td ><p class="text-justify"><?php echo $row['message']; ?></p></td>
                <td> 
<?php
$status = $row['status'];
switch ($status) {
    case '0':
        echo '<span class="badge bg-danger">Not Activated</span>';
        break;
    case '1':
        echo '<div class="badge bg-primary">Activated</div>';
        break;
    case '2':
        echo '<div class="badge bg-warning">Priority</div>';
        break;
    default:
        echo '<span class="badge bg-secondary">Unknown Status</span>';
        break;
}
?>
</td>
                <td>
             
                    <form action="" class="mt-1" onclick="return confirm('Are you sure you wish to change status of this Album ?');" method="POST"> 
                <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                <button type ="submit" name="change_status" class="btn btn-sm btn-warning" >Activate/Deactivate</button>  </form>
             
               <?php   
                if ($row['status'] == 1) {?>
                     
                          <form action="" class="mt-1" onclick="return confirm('Are you sure you wish to change status of this Album to priority ?');" method="POST"> 
                <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                <button type ="submit" name="change_p_status" class="btn btn-sm btn-primary" >Set to Priority</button>  </form>
                <?php }
               ?>
               
                <form action="" class="mt-1" onclick="return confirm('Are you sure you wish to delete this Album ?');" method="POST"> 
                <input type="hidden" name="delete_id" value="<?php echo $row['ID'] ?>">
                <button type ="submit" name="delete_profile" class="btn btn-sm btn-danger mt-1" >Delete</button>  </form>
            </td>
          
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
                        <h6 class="mb-0">Delete Selected Entries</h6>
                        <button type="submit" name="delete_selected" class="btn btn-sm btn-danger mt-1">Delete Selected</button>
                    </div>
   
<?php
        } else {
            echo '<div class="alert alert-warning" role="alert">
            No records found. Please add details.
            </div>';
        }
    }
} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    if (strpos($error_message, "Table  doesn't exist") !== false) {
        echo '<div class="alert alert-danger" role="alert">
        Table not found. Please create the table or add the necessary details.
        </div>';
    } else {
        // For any other unexpected database error
        echo '<div class="alert alert-danger" role="alert">
        Unexpected database error occurred.
        </div>';
    }
}
?>
</form>
        <!-- ends -->
      </div>
    </section>

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>

  <script src="assets/js/validation.js?v=<?php echo time(); ?>"></script>

  <script src="assets/js/timeout.js"></script>


</body>

</html>