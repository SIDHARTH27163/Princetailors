<header id="header" class="header d-flex align-items-center">

<div class="container-fluid container-xl d-flex align-items-center justify-content-between">
  <a href="index" class="logo d-flex align-items-center">
   
    <img src="assets/img/logo.png" alt="">
    <!-- <h1>Impact<span>.</span></h1> -->
  </a>
  <?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
  <nav id="navbar" class="navbar">
    <ul>
      <li><a href="index" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a></li>
     
      <li><a href="services" class="<?php echo $current_page == 'services.php' ? 'active' : ''; ?>">Services</a></li>
      <li><a href="products" class="<?php echo $current_page == 'products.php' ? 'active' : ''; ?>">Products</a></li>
    
      <li><a href="about-us" class="<?php echo $current_page == 'about-us.php' ? 'active' : ''; ?>">About</a></li>

     
      <li><a href="contact">Contact</a></li>
    </ul>
  </nav><!-- .navbar -->

  <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
  <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

</div>
</header>