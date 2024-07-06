<?php
// components/HeroSection.php

function renderHeroSection($imageUrl, $heading, $paragraph) {
    ?>
    <section id="hero" class="hero">
        <div class="container position-relative">
            <div class="row gy-5" data-aos="fade-in">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2><?php echo $heading; ?></h2>
                    <p class="para-text"><?php echo $paragraph; ?></p>
                    
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <img src="<?php echo $imageUrl; ?>" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
