<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Prince Tailor - Home</title>
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
<?php
if (isset($_GET['category'])) {
    $encodedname = $_GET['category'];
    $category = base64_decode($encodedname);

}
?>
<body>

  <!-- ======= Header ======= -->
  <?php include('components/Topbar.php')?>
  <!-- End Top Bar -->
<!-- headers starts navigation bar -->
<?php include('components/Navbar.php')?>
 <!-- End Header -->
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <?php
// main PHP file

include('components/HeroSection.php');

// Define variables for image URL, heading, and paragraph
$imageUrl = "assets/img/hero-section.png";
$heading = "Welcome to <span>Prince Tailors</span>";
$paragraph = "Welcome to Prince Tailors, where style meets precision. Discover bespoke suits, exquisite fabrics, and impeccable craftsmanship. Our passion for tailoring ensures a perfect fit for every occasion. Explore timeless elegance and modern sophistication with our tailored collections. Elevate your wardrobe with Prince Tailors today!";

// Call the renderHeroSection function with the parameters
renderHeroSection($imageUrl, $heading, $paragraph);
?>

  <!-- End Hero Section -->

  <main id="main">

    

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Products <?php echo($category);?></h2>
          <p>Prince Tailors' products include bespoke suits, elegant dresses, luxury fabrics, professional alterations, and expertly crafted formal wear for discerning clients.</p>
        </div>
        <?php
try {
    $query = "SELECT * FROM product WHERE status = 1 AND category = '$category' ORDER BY p_name";
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
    </section><!-- End Portfolio Section -->

  

  

   
    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="content px-xl-5">
              <h3>Frequently Asked <strong>Questions</strong></h3>
              <p class="faq_desc">
              Explore our Frequently Asked Questions to find quick answers to common inquiries about our services, appointments, turnaround times, alterations, fabric choices, and return policies. We strive to provide clarity and ensure a seamless experience. If you need further assistance, please don't hesitate to contact us.
              </p>
            </div>
          </div>

          <div class="col-lg-8">
    <?php
    try {
        $query = "SELECT * FROM FAQ where status=1 ORDER BY ID DESC";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            if (mysqli_num_rows($query_run) > 0) {
    ?>
                <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">
                <?php
                  $counter = 1;
                  while ($row = mysqli_fetch_assoc($query_run)) {
                      $accordion_id = 'faq-content-' . $counter;
                ?>
                      <div class="accordion-item">
                        <h3 class="accordion-header">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $accordion_id; ?>">
                            <span class="num"><?php echo $counter++; ?>.</span>
                            <?php echo $row['name']; ?>
                          </button>
                        </h3>
                        <div id="<?php echo $accordion_id; ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                          <div class="accordion-body">
                          <?php echo $row['description']; ?>
                          </div>
                        </div>
                      </div><!-- # Faq item-->
                <?php
                  }
                ?>
                </div>
    <?php
            } else {
                echo '<div class="alert alert-warning" role="alert">No records found. Please add details.</div>';
            }
        }
    } catch (mysqli_sql_exception $e) {
        $error_message = $e->getMessage();
        if (strpos($error_message, "Table doesn't exist") !== false) {
            echo '<div class="alert alert-danger" role="alert">Table not found. Please create the table or add the necessary details.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Unexpected database error occurred.</div>';
        }
    }
    ?>
</div>

        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->
  
       <!-- ======= Contact Section ======= -->
       <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Reach out to us for any inquiries or assistance. Our team is here to help you with all your needs. Contact us via phone, email, or visit our store.</p>
        </div>

        <div class="row gx-lg-0 gy-4">

          <div class="col-lg-4">

            <div class="info-container d-flex flex-column align-items-center justify-content-center">
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Location:</h4>
                  <p>Kotwali Bazar, Dharamshala Himachal Pardesh</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Call:</h4>
                  <p>+91 9816170072</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-clock flex-shrink-0"></i>
                <div>
                  <h4>Open Hours:</h4>
                  <p>Mon-Sat: 11AM - 23PM</p>
                </div>
              </div><!-- End Info Item -->
            </div>

          </div>

          <div class="col-lg-8">
  
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
        <div class="loading">Loading</div>
        <div class="error-message"><?php echo isset($err) ? $err : ''; ?></div>
        <div class="sent-message"><?php echo isset($msg) ? $msg : ''; ?></div>
    </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->

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