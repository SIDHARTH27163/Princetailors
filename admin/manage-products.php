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

  <script type="text/javascript" src="assets/ckeditor5/ckeditor.js"></script>
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
      <h1>Manage Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index">Home</a></li>
          <li class="breadcrumb-item active">Manage Products</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <div class="container-fluid p-2">
        <h1 class="text-primary mb-2">Manage Products</h1>

        <div class="container">
        <?php
        
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST["submit"])) {
    $name = $conn->real_escape_string($_POST['product_name']);
    $heading = $conn->real_escape_string($_POST['heading']);
    $desc = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);
    $file = $_FILES['image'];

    if (!empty($name) || !empty($file['name']) || !empty($desc) || !empty($heading)|| !empty($category)) {
        $sql3 = "CREATE TABLE IF NOT EXISTS Product (
            ID int(50) AUTO_INCREMENT,
            p_name varchar(255) NOT NULL,
            file_content LONGBLOB NOT NULL,  -- Changed to BLOB for base64 image data
            file_path varchar(255) NOT NULL, -- Added file_path field for image path
            original_name varchar(555) NOT NULL,
            category varchar(555) NOT NULL,
            heading LONGTEXT NOT NULL,
            description LONGTEXT NOT NULL,
            up_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,  -- Changed to DATETIME
            status varchar(50) DEFAULT NULL,
            PRIMARY KEY (ID),
            CONSTRAINT UC_clientName UNIQUE (p_name),
            CONSTRAINT UC_OriginalName UNIQUE (original_name)
        )";

        if ($conn->query($sql3) !== TRUE) {
            echo '<div class="alert alert-danger" role="alert">
                Error creating table 
            </div>';
        }

        $checkIfExists = "SELECT * FROM Product WHERE p_name = '$name'";
        $result = $conn->query($checkIfExists);

        if ($result->num_rows > 0) {
            echo '<div id="alert" class="alert alert-warning" role="alert">
                Product name already present. Please use a different name.
            </div>';
        } else {
            $uploadDir = '../uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $fileExtension;
            $fileName = $uploadDir . $newFileName;

            // Move the uploaded file to the server
            if (move_uploaded_file($file['tmp_name'], $fileName)) {
                // Encode the image name
                $encodedFileName = base64_encode($newFileName);
                $file_content = file_get_contents($fileName);
                $file_content = $conn->real_escape_string($file_content);
                $file_path = $conn->real_escape_string($fileName);
               

                $sql4 = "INSERT INTO Product (p_name, category ,heading, file_content, file_path, original_name, description) 
                        VALUES ('$name','$category', '$heading' ,'$file_content', '$file_path', '$encodedFileName', '$desc')";

                if ($conn->query($sql4) === TRUE) {
                    echo '<div class="alert alert-primary" role="alert" id="alert">
                        Product Added
                    </div>';
                } else {
                    echo "Error: " . $sql4 . "<br>" . $conn->error;
                }
            } else {
                echo '<div class="alert alert-danger" role="alert" id="alert">
                    Error uploading file
                </div>';
            }
        }
    }
}
?>

          <div class="row align-content-center align-self-center justify-content-center"></div>
          <div class="row align-content-center align-self-center justify-content-center">
            <div class="card col-lg-8 p-3">
              <div class="card-body">
                <h5 class="card-title">Add Details here</h5>

                <!-- Multi Columns Form -->

                <form class="row g-3" action="manage-products" enctype="multipart/form-data" method="post" name="submit" onsubmit="return validateForm(event)">

                  <?php
                  // Define variables for props
                  $input_name = 'product_name';
                  $input_placeholder = 'Enter product name';
                  $input_class = 'form-control'; // Add your desired class
                  $label = "Enter  Name";
                  $type = "text";
                  // Include Common_Input.php and pass props
                  include('Custom/Custom_Input.php');
                  ?>
                  <span class="text-alerts text-danger" id="product_name_error"></span> <!-- Error span for service name -->
                  <div class="col-md-12">
                  <label for="inputName5" class="form-label">Select Category</label>
                  <?php
try {
    $query = "SELECT * FROM Service where status=1 ORDER BY ID DESC";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
<select name="category"class="form-select" aria-label="example" id="category">
                                <option selected value="">Select Category</option>
                                <?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                                <option ><?php echo $row['service_name']; ?></option>
                                <?php
        }
        ?>
</select>


<?php
        } else {
            echo '<div class="alert alert-warning" role="alert">
            No records found. Please add details.
            </div>';
        }
    }
} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    if (strpos($error_message, "Table 'sharma.services' doesn't exist") !== false) {
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
                  
                  </div>
                  <span class="text-alerts text-danger" id="category_error"></span>
                  <?php
                  // Define variables for props
                  $input_name = 'image';
                  $input_placeholder = '';
                  $input_class = 'form-control'; // Add your desired class
                  $label = "Choose Image For Product";
                  $type = "file";
                  // Include Common_Input.php and pass props
                  include('Custom/Custom_Input.php');
                  ?>
                  <span class="text-alerts text-danger" id="image_error"></span> <!-- Error span for image -->

                  <?php
                  // Define variables for props
                  $input_name = 'heading';
                  $input_placeholder = 'Enter Heading For Product';
                  $input_class = 'form-control'; // Add your desired class
                  $label = "Enter Heading Here ";
                  $type = "text";
                  $rows = "3";
                  // Include Common_Input.php and pass props
                  include('Custom/Custom_textarea.php');
                  ?>
                  <span class="text-alerts text-danger" id="heading_error"></span> <!-- Error span for description -->
                
   
                  <?php
                  // Define variables for props
                  $input_name = 'description';
                  $input_placeholder = 'Enter Description For Product';
                  $input_class = 'form-control'; // Add your desired class
                  $label = "Enter Desciription Here";
                  $type = "text";
                  $rows = "3";
                  // Include Common_Input.php and pass props
                  include('Custom/Editor.php');
                  ?>
                  <span class="text-alerts text-danger" id="description_error"></span> <!-- Error span for description -->
                
   
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form>
              </div>
            </div>



          </div>
        </div>



      </div>
   <!-- table container starts here -->
   <div class="container">
        <!-- database data -->
        <?php
if (isset($_POST['delete_profile'])) {
    $id = $_POST['delete_id'];

    $query = "SELECT * FROM Product WHERE ID='$id'";
    $query_run = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($query_run);
    $fileToDelete = $row['file_path'];

    $deleteQuery = "DELETE FROM Product WHERE ID='$id'";
    $deleteQuery_run = mysqli_query($conn, $deleteQuery);

    if ($deleteQuery_run) {
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete); // Delete the associated file
        }

        echo '<div class="alert alert-danger" role="alert" id="alert">
            Product Deleted. ID: ' . $id . '
        </div>';
    } else {
        echo '<div class="alert alert-warning" role="alert" id="alert">
            Product Not Deleted. ID: ' . $id . '
        </div>';
    }
}
?>

  <?php
if (isset($_POST['change_status'])) {
    $id = $_POST['id'];

    // Assuming $conn is your database connection
    // Fetch the current status from the database for the given ID
    $statusQuery = "SELECT status FROM Product WHERE ID = $id";
    $statusResult = $conn->query($statusQuery);

    if ($statusResult) {
        $row = $statusResult->fetch_assoc();
        $currentStatus = $row['status'];

        // Toggle the status based on the current value
        $newStatus = ($currentStatus === '1') ? 'NULL' : '1';

        // Update the status for the given ID
        $updateQuery = "UPDATE Product SET status = $newStatus WHERE ID = $id";
        $updateResult = $conn->query($updateQuery);

        if ($updateResult) {
           
            echo'<div class="alert alert-primary" role="alert" id="alert">
            Status for ID: '.$id.' changed successfully !
</div>';
        } else {
           
            echo'<div class="alert alert-warning" role="alert" id="alert">
            Error updating status: '. $conn->error.' !
</div>';
        }
    } else {
     
        echo'<div class="alert alert-warning" role="alert" id="alert">
        Error fetching status:: '. $conn->error.' !
</div>';
    }
}
?>
<!-- delte selectedcode -->
<?php
if (isset($_POST['delete_selected'])) {
    if (!empty($_POST['delete_id'])) {
        $deleteIDs = implode(",", $_POST['delete_id']);

        // Establish database connection - $conn should be your database connection object
        $deleteQuery = "SELECT file_path FROM Product WHERE ID IN ($deleteIDs)";
        $result = mysqli_query($conn, $deleteQuery);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $filePath = $row['file_path'];
                if (file_exists($filePath)) {
                    unlink($filePath); // This deletes the file
                }
            }

            // Now, perform the database deletion
            $deleteQuery = "DELETE FROM Product WHERE ID IN ($deleteIDs)";
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
    $query = "SELECT * FROM Product ORDER BY id DESC";
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
               
                <th scope="col">image</th>
                <th scope="col">Heading</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($query_run)) {
          $fileContent = $row['original_name'];
$base64Image = base64_decode($fileContent);


            ?>
            <tr>
                <td> <input class="form-check-input" type="checkbox" name="delete_id[]" value="<?php echo $row['ID']; ?>"></td>
                <td><?php echo $row['up_date']; ?></td>
                <td><?php echo $row['p_name']; ?></td>
              
                <td>
                <img src='../uploads/<?php echo $base64Image ?>' class="img-fluid" alt="..."  style="max-width: 100%; height: auto;">
            </td>
                <td ><p class="text-justify"><?php echo $row['heading']; ?></p></td>
                <td> <?php
                        if ($row['status'] === null) {
                          
                            echo '<span class="badge bg-danger">
                            Private
                          </span>';
                        } else {
                             echo '<div class="badge bg-primary">
                         Public
                          </div>';
                        }
                        ?></td>
                <td>
            
                    <form action="" class="mt-1" onclick="return confirm('Are you sure you wish to change status of this Album ?');" method="POST"> 
                <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                <button type ="submit" name="change_status" class="btn btn-sm btn-warning" >Activate/Deactivate</button>  </form>
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
   <!-- table container ends here -->
    </section>

  </main><!-- End #main -->

 
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/timeout.js"></script>
  <script src="assets/js/productsvalidation.js?v=<?php echo time(); ?>"></script>
  <script src="assets/js/editor.js?v=<?php echo time(); ?>"></script>
</body>

</html>