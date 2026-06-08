<?php
/**
 * LEHULUM PAN-AFRICAN TELE-ENT
 * Contact Page
 * Version 1.0
 */

$page_title = "Contact Us";
$meta_description = "Get in touch with Lehulum Pan-African Tele-ENT";

require_once 'includes/header.php';

$settings = get_settings();
?>

    <!-- Page Header -->
    <section class="hero-section" style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%); padding: 60px 0;">
        <div class="container hero-content">
            <h1>Contact Us</h1>
            <p>We'd Love to Hear From You</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- Contact Form -->
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h3 class="mb-4">Send us a Message</h3>
                    <form id="contactForm" method="POST" action="process-contact.php">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address *</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" name="phone">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject *</label>
                                <select class="form-select" name="subject" required>
                                    <option value="">-- Select Subject --</option>
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Consultation Request">Consultation Request</option>
                                    <option value="Volunteer Request">Volunteer Request</option>
                                    <option value="Partnership Inquiry">Partnership Inquiry</option>
                                    <option value="Feedback">Feedback</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message *</label>
                            <textarea class="form-control" name="message" rows="6" required></textarea>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="privacyCheck" required>
                            <label class="form-check-label" for="privacyCheck">
                                I agree to the <a href="privacy-policy.php">Privacy Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="col-lg-4">
                    <h3 class="mb-4">Contact Information</h3>

                    <div class="mb-4">
                        <h6 class="mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i> Address
                        </h6>
                        <p class="text-muted"><?php echo $settings['address'] ?? 'Address not available'; ?></p>
                    </div>

                    <div class="mb-4">
                        <h6 class="mb-2">
                            <i class="fas fa-phone text-primary me-2"></i> Phone
                        </h6>
                        <p class="text-muted"><a href="tel:<?php echo $settings['phone']; ?>"><?php echo $settings['phone']; ?></a></p>
                    </div>

                    <div class="mb-4">
                        <h6 class="mb-2">
                            <i class="fas fa-envelope text-primary me-2"></i> Email
                        </h6>
                        <p class="text-muted"><a href="mailto:<?php echo $settings['email']; ?>"><?php echo $settings['email']; ?></a></p>
                    </div>

                    <div class="mb-4">
                        <h6 class="mb-2">
                            <i class="fas fa-clock text-primary me-2"></i> Working Hours
                        </h6>
                        <p class="text-muted">
                            Monday - Friday: 9:00 AM - 6:00 PM<br>
                            Saturday: 10:00 AM - 4:00 PM<br>
                            Sunday: Closed
                        </p>
                    </div>

                    <hr>

                    <h6 class="mb-3">Follow Us</h6>
                    <div>
                        <?php if (!empty($settings['facebook'])): ?>
                            <a href="<?php echo $settings['facebook']; ?>" class="btn btn-outline-primary btn-sm me-2 mb-2" target="_blank">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($settings['linkedin'])): ?>
                            <a href="<?php echo $settings['linkedin']; ?>" class="btn btn-outline-primary btn-sm me-2 mb-2" target="_blank">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($settings['twitter'])): ?>
                            <a href="<?php echo $settings['twitter']; ?>" class="btn btn-outline-primary btn-sm me-2 mb-2" target="_blank">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($settings['youtube'])): ?>
                            <a href="<?php echo $settings['youtube']; ?>" class="btn btn-outline-primary btn-sm me-2 mb-2" target="_blank">
                                <i class="fab fa-youtube"></i> YouTube
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="section bg-light">
        <div class="container">
            <h3 class="mb-4">Our Location</h3>
            <div class="ratio ratio-16x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.702769932101!2d38.74676!3d9.03212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwMDEnNTIuMyJOIDM4wrAyMyc0Mi4zIkU!5e0!3m2!1sen!2set!4v1234567890" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
