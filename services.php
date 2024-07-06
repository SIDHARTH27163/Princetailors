<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Prince Tailors - Services </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png?v=<?php echo time(); ?>" rel="icon">
  <link href="assets/img/apple-touch-icon.png?v=<?php echo time(); ?>" rel="apple-touch-icon">


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">


  <link href="assets/vendor/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  
  <link href="assets/css/main.css?v=<?php echo time(); ?>" rel="stylesheet">

 
</head>
<?php include('inlcudes/db.php') ?>
<body>

  <!-- ======= Header ======= -->
  <?php include('components/Topbar.php')?>
  <!-- End Top Bar -->
<!-- headers starts navigation bar -->
<?php include('components/Navbar.php')?>
 <!-- End Header -->
  <!-- End Header -->


  <main id="main">
<!-- breadcrumbs -->
 

    <?php
include('components/Breadcrumbs.php');

// Define variables for URL, heading, and paragraph
$p_title = "Our Services";
$heading = "Our Services";
$paragraph = "At Prince Tailors, we offer bespoke tailoring for men and women, specializing in custom suits, coats, and pants. Our services include fabric selection, precise measurements, personalized design, expert craftsmanship, and fittings. We ensure a perfect fit and timeless style with ongoing support for alterations and future custom pieces.";
$url = "index.php";

// Call the renderBreadcrumbs function with the parameters
renderBreadcrumbs($p_title, $heading, $paragraph, $url);
?><!-- End Breadcrumbs -->
    <section id="services" class="services sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Services</h2>
          <p>Prince Tailors offers bespoke tailoring, alterations, custom suits, dresses, luxury fabrics, and flawless craftsmanship for timeless style and personalized elegance.</p>
        </div>
        <?php
try {
    $query = "SELECT * FROM Service where status=1  ORDER BY service_name";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

        <?php
while ($row = mysqli_fetch_assoc($query_run)) {
 
    $encodedname = base64_encode($row['service_name']); // Encode the ID
?>



          <div class="col-lg-4 col-md-6">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="bi bi-gear"></i>
              </div>
              <h3><a href="filter-product?category=<?php echo $encodedname; ?>"><?php echo $row['service_name']; ?></a></h3>
              <p><?php echo $row['description']; ?></p>
            
            </div>
          </div><!-- End Service Item -->

     
     
          <?php } ?>
        


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
    </section><!-- End Our Services Section -->

   <!-- ======= Clients Section ======= -->
   <section id="clients" class="clients">
    <?php
try {
    $query = "SELECT * FROM Client WHERE status = '1' ORDER BY client_name "; // Fetching data from Review table where status is 2, limited to 10 records
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
      <div class="container" data-aos="zoom-out">

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
          <?php
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                  $fileContent = $row['original_name'];
                                  $base64Image = base64_decode($fileContent);
                            ?>
          <div class="swiper-slide"><img src="uploads/<?php echo $base64Image ?>" class="img-fluid" alt="<?php echo $row['client_name']; ?>"></div>
           <?php } ?>
          </div>
        </div>

      </div>
      <?php
        } else {
            echo '<div class="alert alert-warning" role="alert">
            No records found. Please add details.
            </div>';
        }
    } else {
        // Handle SQL query error
        throw new Exception(mysqli_error($conn));
    }
} catch (Exception $e) {
    $error_message = $e->getMessage();
    echo '<div class="alert alert-danger" role="alert">
            Unexpected error occurred: ' . $error_message . '
        </div>';
}
?>
    </section><!-- End Clients Section -->

    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4 align-items-center">

          <div class="col-lg-6">
            <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6">

            <div class="stats-item d-flex align-items-center">
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Happy Clients</strong> consequuntur quae diredo para mesta</p>
            </div>

            <div class="stats-item d-flex align-items-center">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Projects</strong> adipisci atque cum quia aut</p>
            </div>

            <div class="stats-item d-flex align-items-center">
              <span data-purecounter-start="0" data-purecounter-end="453" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Hours Of Support</strong> aut commodi quaerat</p>
            </div>

          </div>

        </div>

      </div>
    </section>

   
    <!-- ======= Our Services Section ======= -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('components/Footer.php')?>
  <!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js?v=<?php echo time(); ?>"></script>
  <script src="assets/vendor/aos/aos.js?v=<?php echo time(); ?>"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js?v=<?php echo time(); ?>"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>

</body>

</html>