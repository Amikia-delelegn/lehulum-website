<?php
/**
 * LEHULUM PAN-AFRICAN TELE-ENT
 * Homepage
 * Version 1.0
 */

$page_title = "Home";
$meta_description = "Lehulum Pan-African Tele-ENT - Advanced ENT Care Reaching Every Ethiopian";

require_once 'includes/header.php';
?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <h1>Lehulum Pan-African Tele-ENT</h1>
            <p>Advanced ENT Care Reaching Every Ethiopian</p>
            <div class="mt-4">
                <a href="pages/contact.php?type=consultation" class="btn btn-light btn-lg">
                    <i class="fas fa-video"></i> Request Consultation
                </a>
                <a href="pages/outreach.php" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-map-marker-alt"></i> Join Outreach Mission
                </a>
                <a href="pages/donate.php" class="btn btn-danger btn-lg">
                    <i class="fas fa-heart"></i> Donate
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="stat-box">
                        <div class="stat-number" data-count="5000">0</div>
                        <div class="stat-label">Patients Served</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-box">
                        <div class="stat-number" data-count="150">0</div>
                        <div class="stat-label">Specialists</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-box">
                        <div class="stat-number" data-count="25">0</div>
                        <div class="stat-label">Regions Reached</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-box">
                        <div class="stat-number" data-count="45">0</div>
                        <div class="stat-label">Outreach Missions</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Welcome Message Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="assets/images/logo/welcome.png" alt="Executive Director" class="img-fluid rounded-custom shadow-custom" data-src="assets/images/logo/welcome.png">
                </div>
                <div class="col-md-6">
                    <h2>Welcome to Lehulum</h2>
                    <h5 class="text-muted mb-3">Message from Executive Director</h5>
                    <p>
                        <?php 
                        $settings = get_settings();
                        echo !empty($settings['about_text']) ? $settings['about_text'] : 'Lehulum is committed to providing accessible, quality ENT care services across Africa through innovative telemedicine solutions and community outreach programs.';
                        ?>
                    </p>
                    <a href="pages/about.php" class="btn btn-primary mt-3">Learn More About Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Specialists Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Meet Our Specialists</h2>
                <p>Expert ENT professionals ready to serve you</p>
            </div>
            <div class="row">
                <?php 
                $specialists = get_specialists(6);
                foreach ($specialists as $specialist): 
                ?>
                <div class="col-md-4 col-lg-2 mb-4">
                    <div class="card">
                        <img src="<?php echo BASE_URL . 'uploads/specialists/' . $specialist['photo']; ?>" 
                             alt="<?php echo $specialist['full_name']; ?>" 
                             class="card-img-top" 
                             data-src="<?php echo BASE_URL . 'uploads/specialists/' . $specialist['photo']; ?>">
                        <div class="card-body text-center">
                            <h6 class="card-title"><?php echo $specialist['full_name']; ?></h6>
                            <p class="small text-muted"><?php echo $specialist['specialty']; ?></p>
                            <p class="small">
                                <i class="fas fa-map-marker-alt"></i> <?php echo $specialist['country']; ?>
                            </p>
                            <a href="pages/specialist-profile.php?id=<?php echo $specialist['id']; ?>" class="btn btn-sm btn-primary">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="pages/specialists.php" class="btn btn-outline-primary">Browse All Specialists</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Our Services</h2>
                <p>Comprehensive ENT care solutions for everyone</p>
            </div>
            <div class="row">
                <?php 
                $services = get_services();
                $count = 0;
                foreach ($services as $service): 
                    if ($count >= 6) break;
                    $count++;
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas <?php echo $service['icon']; ?> fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title"><?php echo $service['title']; ?></h5>
                            <p class="card-text text-muted"><?php echo substr($service['description'], 0, 100); ?>...</p>
                            <a href="pages/services.php#<?php echo strtolower(str_replace(' ', '-', $service['title'])); ?>" class="btn btn-sm btn-primary">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="pages/services.php" class="btn btn-outline-primary">View All Services</a>
            </div>
        </div>
    </section>

    <!-- Upcoming Missions Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Upcoming Outreach Missions</h2>
                <p>Join us in bringing healthcare to underserved communities</p>
            </div>
            <div class="row">
                <?php 
                $missions = get_upcoming_missions(3);
                foreach ($missions as $mission): 
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if (!empty($mission['photo'])): ?>
                            <img src="<?php echo BASE_URL . 'uploads/missions/' . $mission['photo']; ?>" 
                                 alt="<?php echo $mission['title']; ?>" 
                                 class="card-img-top" 
                                 data-src="<?php echo BASE_URL . 'uploads/missions/' . $mission['photo']; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $mission['title']; ?></h5>
                            <p class="small text-muted">
                                <i class="fas fa-map-marker-alt"></i> <?php echo $mission['location']; ?>
                            </p>
                            <p class="small text-muted">
                                <i class="fas fa-calendar"></i> <?php echo date('M d, Y', strtotime($mission['mission_date'])); ?>
                            </p>
                            <p class="card-text text-muted"><?php echo substr($mission['description'], 0, 80); ?>...</p>
                            <a href="pages/outreach.php#mission-<?php echo $mission['id']; ?>" class="btn btn-sm btn-primary">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="pages/outreach.php" class="btn btn-outline-primary">View All Missions</a>
            </div>
        </div>
    </section>

    <!-- Success Stories Carousel -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Success Stories</h2>
                <p>Real stories from real patients</p>
            </div>
            <div id="successStoriesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php 
                    $stories = get_upcoming_missions(5); // Using missions as placeholder
                    $active = true;
                    foreach ($stories as $story): 
                    ?>
                    <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <img src="assets/images/success-stories/default.jpg" 
                                     alt="Success Story" 
                                     class="img-fluid rounded-custom"
                                     data-src="assets/images/success-stories/default.jpg">
                            </div>
                            <div class="col-md-6">
                                <h4>Patient Success Story</h4>
                                <p class="text-muted">
                                    Through our telemedicine platform, we've been able to provide critical care to patients in remote areas...
                                </p>
                                <blockquote class="blockquote">
                                    <p class="mb-0">"Lehulum changed my life by giving me access to world-class ENT care from my village."</p>
                                    <footer class="blockquote-footer">Patient Name</footer>
                                </blockquote>
                                <a href="pages/gallery.php" class="btn btn-sm btn-primary">View More Stories</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                    $active = false;
                    endforeach; 
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#successStoriesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#successStoriesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Our Partners</h2>
                <p>Collaborating with leading organizations across Africa</p>
            </div>
            <div id="partnersCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php 
                    $partners = get_partners();
                    $chunked = array_chunk($partners, 4);
                    $active = true;
                    foreach ($chunked as $chunk): 
                    ?>
                    <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                        <div class="row align-items-center">
                            <?php foreach ($chunk as $partner): ?>
                            <div class="col-md-3 text-center mb-3">
                                <img src="<?php echo BASE_URL . 'uploads/partners/' . $partner['logo']; ?>" 
                                     alt="<?php echo $partner['organization_name']; ?>" 
                                     class="img-fluid" 
                                     style="max-height: 80px;"
                                     data-src="<?php echo BASE_URL . 'uploads/partners/' . $partner['logo']; ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php 
                    $active = false;
                    endforeach; 
                    ?>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="pages/partners.php" class="btn btn-outline-primary">View All Partners</a>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Latest News</h2>
                <p>Stay updated with our latest announcements</p>
            </div>
            <div class="row">
                <?php 
                $latest_news = get_latest_news(3);
                foreach ($latest_news as $news): 
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if (!empty($news['featured_image'])): ?>
                            <img src="<?php echo BASE_URL . 'uploads/news/' . $news['featured_image']; ?>" 
                                 alt="<?php echo $news['title']; ?>" 
                                 class="card-img-top"
                                 data-src="<?php echo BASE_URL . 'uploads/news/' . $news['featured_image']; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $news['title']; ?></h5>
                            <p class="small text-muted">
                                <i class="fas fa-calendar"></i> <?php echo date('M d, Y', strtotime($news['publish_date'])); ?>
                            </p>
                            <p class="card-text text-muted"><?php echo substr(strip_tags($news['content']), 0, 100); ?>...</p>
                            <a href="pages/news.php?id=<?php echo $news['id']; ?>" class="btn btn-sm btn-primary">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="pages/news.php" class="btn btn-outline-primary">View All News</a>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="section bg-primary text-white">
        <div class="container text-center">
            <h2>Ready to Get Expert ENT Care?</h2>
            <p class="lead mt-3">Schedule a consultation with our specialists today</p>
            <div class="mt-4">
                <a href="pages/contact.php?type=consultation" class="btn btn-light btn-lg">
                    <i class="fas fa-video"></i> Book a Consultation
                </a>
                <a href="pages/specialists.php" class="btn btn-outline-light btn-lg ms-2">
                    <i class="fas fa-user-md"></i> Browse Specialists
                </a>
            </div>
        </div>
    </section>

    <!-- Back to Top Button -->
    <button id="backToTop" style="display: none;">
        <i class="fas fa-chevron-up"></i>
    </button>

    <style>
        #backToTop {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            z-index: 999;
            transition: all 0.3s ease;
        }
        
        #backToTop:hover {
            background-color: #2c3e50;
            transform: translateY(-3px);
        }
    </style>

    <script>
        // Animate counters on page load
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                animateCounter(counter, target);
            });
        });
    </script>

<?php require_once 'includes/footer.php'; ?>
