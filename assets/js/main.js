/**
 * LEHULUM PAN-AFRICAN TELE-ENT
 * Main JavaScript File
 * Version 1.0
 */

$(document).ready(function() {
    'use strict';

    // =====================
    // Newsletter Form Handler
    // =====================
    $('#newsletterForm').on('submit', function(e) {
        e.preventDefault();
        
        const email = $(this).find('input[type="email"]').val();
        
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'pages/subscribe-newsletter.php',
            data: {
                email: email
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', 'Thank you for subscribing!');
                    $('#newsletterForm')[0].reset();
                } else {
                    showAlert('error', response.message || 'Subscription failed');
                }
            },
            error: function() {
                showAlert('error', 'An error occurred. Please try again.');
            }
        });
    });

    // =====================
    // Alert Helper Function
    // =====================
    window.showAlert = function(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('body').prepend(alertHtml);
        
        setTimeout(() => {
            $('.alert').fadeOut(function() {
                $(this).remove();
            });
        }, 4000);
    };

    // =====================
    // Smooth Scroll Links
    // =====================
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        
        const target = $(this).attr('href');
        if ($(target).length) {
            $('html, body').animate({
                scrollTop: $(target).offset().top - 80
            }, 800);
        }
    });

    // =====================
    // Active Navigation Link
    // =====================
    const currentLocation = location.pathname;
    $('.navbar-nav a').each(function() {
        const href = $(this).attr('href');
        if (currentLocation.includes(href)) {
            $(this).addClass('active');
        }
    });

    // =====================
    // Form Validation
    // =====================
    window.validateForm = function(formId) {
        const form = document.getElementById(formId);
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
        return form.checkValidity();
    };

    // =====================
    // Image Lazy Loading
    // =====================
    if ('IntersectionObserver' in window) {
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        images.forEach(img => imageObserver.observe(img));
    }

    // =====================
    // Counter Animation
    // =====================
    window.animateCounter = function(element, target) {
        const duration = 2000;
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;

        const counter = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(counter);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    };

    // =====================
    // Contact Form Handler
    // =====================
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'pages/process-contact.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    showAlert('success', 'Message sent successfully!');
                    form[0].reset();
                } else {
                    showAlert('error', response.message || 'Failed to send message');
                }
            },
            error: function() {
                showAlert('error', 'An error occurred. Please try again.');
            }
        });
    });

    // =====================
    // Back to Top Button
    // =====================
    const backToTopBtn = document.getElementById('backToTop');
    
    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.style.display = 'block';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // =====================
    // Toast Notifications
    // =====================
    window.showToast = function(message, type = 'info') {
        const toastHtml = `
            <div class="toast align-items-center text-white bg-${type}" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `;
        
        const toastContainer = document.getElementById('toastContainer') || 
            $('<div id="toastContainer" class="position-fixed bottom-0 end-0 p-3"></div>').appendTo('body');
        
        const toast = new bootstrap.Toast($(toastHtml).appendTo(toastContainer)[0]);
        toast.show();
    };

    // =====================
    // Initialize Tooltips & Popovers
    // =====================
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(tooltipTriggerEl => {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.querySelectorAll('[data-bs-toggle="popover"]').forEach(popoverTriggerEl => {
        new bootstrap.Popover(popoverTriggerEl);
    });

    // =====================
    // AJAX Setup for CSRF Token
    // =====================
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    console.log('Lehulum Application Initialized');
});
