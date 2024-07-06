<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Prince Tailors - Products</title>
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
             <!-- ======= Breadcrumbs ======= -->

             <?php
include('components/Breadcrumbs.php');

// Define variables for URL, heading, and paragraph
$p_title = "Our Products";
$heading = "Our Products";
$paragraph = "Prince Tailors offers bespoke clothing for men and women, including custom suits, coats, and pants. Our products are crafted from premium fabrics and designed for a perfect fit. Each piece is tailored with meticulous attention to detail, ensuring timeless style, exceptional comfort, and unmatched quality for every occasion.";
$url = "index.php";

// Call the renderBreadcrumbs function with the parameters
renderBreadcrumbs($p_title, $heading, $paragraph, $url);
?>

<!-- End Breadcrumbs -->
  <!-- End Header -->
  <section id="portfolio" class="portfolio sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Products</h2>
          <p>Prince Tailors' products include bespoke suits, elegant dresses, luxury fabrics, professional alterations, and expertly crafted formal wear for discerning clients.</p>
        </div>
        <?php
try {
    $query = "SELECT * FROM Product where status=1  ORDER BY ID DESC";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
        <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

        

          <div class="row gy-4 portfolio-container">
          <?php
while ($row = mysqli_fetch_assoc($query_run)) {
    $fileContent = $row['original_name'];
    $base64Image = base64_decode($fileContent);
    $encodedID = base64_encode($row['ID']); // Encode the ID
?>
    <div class="col-xl-4 col-md-6 portfolio-item filter-app">
        <div class="portfolio-wrap">
            <a href="uploads/<?php echo $base64Image ?>" data-gallery="portfolio-gallery-app" class="glightbox"><img src="uploads/<?php echo $base64Image ?>" class="img-fluid" alt="" width="100%"></a>
      
            <div class="portfolio-info">
                <h4><a href="portfolio-details?id=<?php echo $encodedID; ?>" title="More Details"><?php echo $row['p_name']; ?></a></h4>
                <p><?php echo $row['heading']; ?></p>
            </div>
        </div>
    </div><!-- End Portfolio Item -->         
<?php } ?>

          </div><!-- End Portfolio Container -->

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
    </section>
  
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