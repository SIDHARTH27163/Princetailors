<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Prince Tailors - Portfolio details</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/favicon.png?v=<?php echo time(); ?>" rel="icon">
  <link href="assets/img/apple-touch-icon.png?v=<?php echo time(); ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <link href="assets/css/main.css" rel="stylesheet">

 
</head>
<?php include('inlcudes/db.php') ?>

<?php
if (isset($_GET['id'])) {
    $encodedID = $_GET['id'];
    $decodedID = base64_decode($encodedID);

}
?>
<body>

  


  <main id="main">
  <!-- ======= Header ======= -->
  <?php include('components/Topbar.php')?>
  <!-- End Top Bar -->
<!-- headers starts navigation bar -->
<?php include('components/Navbar.php')?>
 <!-- End Header -->
  <!-- End Header -->
    
    <!-- ======= Portfolio Details Section ======= -->
    <?php
try {
    // $cat = mysqli_real_escape_string($conn, $_GET['id']); // Sanitize the input
    // Debug: Check the category received

    $query = "SELECT * FROM Product WHERE id = $decodedID";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>

   
      <?php
            while ($row = mysqli_fetch_assoc($query_run)) {

              $fileContent = $row['original_name'];
              $base64Image = base64_decode($fileContent);
            ?>
            <!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2><?php echo $row['p_name'] ?> Detail</h2>
              <p>Welcome to Prince Tailors, where style meets precision. Discover bespoke suits, exquisite fabrics, and impeccable craftsmanship. Our passion for tailoring ensures a perfect fit for every occasion. Explore timeless elegance and modern sophistication with our tailored collections. Elevate your wardrobe with Prince Tailors today!</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index">Home</a></li>
            <li>Portfolio Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

 <section id="portfolio-details" class="portfolio-details">
      <div class="container" data-aos="fade-up">

        <div class="row justify-content-between gy-4 ">

          <div class="col-lg-8">
            <div class="portfolio-description">
              <h2><?php echo $row['p_name'] ?></h2>
              <h3 >
              <?php echo $row['heading'] ?>
              </h3>
            <div class="container d-flex justify-content-center align-items-center">
            <div class="col-xl-6 col-md-6 portfolio-item filter-app">
        <div class="portfolio-wrap">
              <a href="uploads/<?php echo $base64Image ?>" data-gallery="portfolio-gallery-app" class="glightbox"><img src="uploads/<?php echo $base64Image ?>" class="img-fluid" alt="" width="100%"></a>
        </div>
              </div>
            </div>
              <p >
              <?php echo $row['description'] ?>

            </p>

            </div>
          </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>Product information</h3>
              <ul>
                <li><strong>Category</strong> <span><?php echo $row['category'] ?></span></li>
                <li><strong>Client</strong> <span>Multiple</span></li>
                <li><strong>Project date</strong> <span><?php echo $row['up_date'] ?></span></li>
             
               
              </ul>
            </div>
          </div>

        </div>
        </div>
    </section>
<?php  } ?>
     <!-- End Portfolio Details Section -->
    <?php
        } else {
            echo '<div class="alert alert-warning" role="alert">
            No records found. Please add details.
            </div>';
        }
    } else {
        throw new Exception(mysqli_error($conn)); // Throw an exception for database errors
    }
} catch (Exception $e) {
    // Handle exceptions or errors
    echo '<div class="alert alert-danger" role="alert">
    Error occurred: ' . $e->getMessage() . '
    </div>';
}
?>
  </main><!-- End #main -->
<?php include('components/Footer.php')?>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>