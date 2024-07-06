<?php
// components/Breadcrumbs.php

function renderBreadcrumbs($p_title, $heading, $paragraph, $url) {
    ?>
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2><?php echo htmlspecialchars($heading); ?></h2>
                        <p><?php echo htmlspecialchars($paragraph); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="<?php echo htmlspecialchars($url); ?>">Home</a></li>
                    <li><?php echo htmlspecialchars($p_title); ?></li>
                </ol>
            </div>
        </nav>
    </div>
    <?php
}
?>
