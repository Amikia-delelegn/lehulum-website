<?php
/**
 * LEHULUM PAN-AFRICAN TELE-ENT
 * Specialist Profile Page
 * Version 1.0
 */

require_once 'includes/header.php';

// Get specialist ID from URL
$specialist_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($specialist_id === 0) {
    header('Location: specialists.php');
    exit();
}

// Fetch specialist details
$specialist = get_specialist($specialist_id);

if (!$specialist) {
    header('Location: specialists.php');
    exit();
}

$page_title = $specialist['full_name'];
$meta_description = "Profile of " . $specialist['full_name'] . " - " . $specialist['specialty'];
?>

    <!-- Page Header -->
    <section class="hero-section" style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%); padding: 60px 0;">
        <div class="container hero-content">
            <h1><?php echo $specialist['full_name']; ?></h1>
            <p><?php echo $specialist['specialty']; ?></p>
        </div>
    </section>

    <!-- Specialist Profile -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- Left Column: Photo and Quick Info -->
                <div class="col-md-4 mb-4">
                    <div class="card sticky-top" style="top: 100px;">
                        <img src="<?php echo BASE_URL . 'uploads/specialists/' . $specialist['photo']; ?>" 
                             alt="<?php echo $specialist['full_name']; ?>" 
                             class="card-img-top"
                             data-src="<?php echo BASE_URL . 'uploads/specialists/' . $specialist['photo']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $specialist['full_name']; ?></h5>
                            <p class="text-primary mb-3"><strong><?php echo $specialist['specialty']; ?></strong></p>
                            
                            <div class="mb-4">
                                <h6 class="mb-3">Quick Info</h6>
                                <p class="small mb-2">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <strong>Location:</strong> <?php echo $specialist['country']; ?>
                                </p>
                                <p class="small mb-2">
                                    <i class="fas fa-globe text-primary me-2"></i>
                                    <strong>Languages:</strong> <?php echo $specialist['languages']; ?>
                                </p>
                                <p class="small mb-2">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <strong>Availability:</strong> <?php echo $specialist['availability']; ?>
                                </p>
                                <?php if (!empty($specialist['consultation_fee'])): ?>
                                <p class="small mb-2">
                                    <i class="fas fa-dollar-sign text-success me-2"></i>
                                    <strong>Consultation Fee:</strong> $<?php echo number_format($specialist['consultation_fee'], 2); ?>
                                </p>
                                <?php endif; ?>
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-3">Contact</h6>
                                <?php if (!empty($specialist['email'])): ?>
                                <p class="small mb-2">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    <a href="mailto:<?php echo $specialist['email']; ?>"><?php echo $specialist['email']; ?></a>
                                </p>
                                <?php endif; ?>
                                <?php if (!empty($specialist['phone'])): ?>
                                <p class="small mb-2">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <a href="tel:<?php echo $specialist['phone']; ?>"><?php echo $specialist['phone']; ?></a>
                                </p>
                                <?php endif; ?>
                            </div>

                            <div class="d-grid">
                                <a href="contact.php?specialist=<?php echo $specialist['id']; ?>" class="btn btn-primary btn-lg">
                                    <i class="fas fa-video"></i> Book Consultation
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Detailed Info -->
                <div class="col-md-8">
                    <!-- Biography -->
                    <div class="mb-5">
                        <h3>About</h3>
                        <p><?php echo $specialist['biography']; ?></p>
                    </div>

                    <!-- Education -->
                    <?php if (!empty($specialist['education'])): ?>
                    <div class="mb-5">
                        <h3>Education</h3>
                        <p><?php echo nl2br($specialist['education']); ?></p>
                    </div>
                    <?php endif; ?>

                    <!-- Certifications -->
                    <?php if (!empty($specialist['certifications'])): ?>
                    <div class="mb-5">
                        <h3>Certifications & Credentials</h3>
                        <div class="list-group list-group-flush">
                            <?php 
                            $certs = array_filter(array_map('trim', explode(',', $specialist['certifications'])));
                            foreach ($certs as $cert): 
                            ?>
                                <div class="list-group-item">
                                    <i class="fas fa-certificate text-success me-2"></i> <?php echo $cert; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Services -->
                    <div class="mb-5">
                        <h3>Specialization Areas</h3>
                        <div class="alert alert-light">
                            <p class="mb-0"><?php echo $specialist['specialty']; ?></p>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="mb-5">
                        <h3>Connect</h3>
                        <div class="social-links">
                            <?php if (!empty($specialist['facebook'])): ?>
                                <a href="<?php echo $specialist['facebook']; ?>" target="_blank" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fab fa-facebook"></i> Facebook
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($specialist['linkedin'])): ?>
                                <a href="<?php echo $specialist['linkedin']; ?>" target="_blank" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($specialist['twitter'])): ?>
                                <a href="<?php echo $specialist['twitter']; ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section bg-light">
        <div class="container text-center">
            <h3 class="mb-4">Ready to consult with <?php echo $specialist['full_name']; ?>?</h3>
            <p class="lead mb-4">Schedule your appointment today</p>
            <a href="contact.php?specialist=<?php echo $specialist['id']; ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-calendar"></i> Book Consultation
            </a>
        </div>
    </section>

    <!-- Related Specialists -->
    <section class="section">
        <div class="container">
            <h3 class="mb-4">Other Specialists in <?php echo $specialist['specialty']; ?></h3>
            <div class="row">
                <?php 
                $related = get_specialists(3, $specialist['specialty']);
                foreach ($related as $rel_specialist):
                    if ($rel_specialist['id'] === $specialist['id']) continue;
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo BASE_URL . 'uploads/specialists/' . $rel_specialist['photo']; ?>" 
                             alt="<?php echo $rel_specialist['full_name']; ?>" 
                             class="card-img-top"
                             style="height: 250px; object-fit: cover;"
                             data-src="<?php echo BASE_URL . 'uploads/specialists/' . $rel_specialist['photo']; ?>">
                        <div class="card-body">
                            <h6 class="card-title"><?php echo $rel_specialist['full_name']; ?></h6>
                            <p class="small text-muted"><?php echo $rel_specialist['country']; ?></p>
                            <a href="specialist-profile.php?id=<?php echo $rel_specialist['id']; ?>" class="btn btn-sm btn-primary">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
