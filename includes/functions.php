<?php
/**
 * LEHULUM PAN-AFRICAN TELE-ENT
 * Helper Functions
 * Version 1.0
 */

require_once dirname(__FILE__) . '/../database/config.php';

/**
 * Sanitize user input
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Validate email
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Hash password
 */
function hash_password($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
}

/**
 * Verify password
 */
function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Generate CSRF token
 */
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Start secure session
 */
function start_secure_session() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        
        // Check session timeout
        if (isset($_SESSION['last_activity'])) {
            if (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT) {
                session_destroy();
                return false;
            }
        }
        $_SESSION['last_activity'] = time();
    }
    return true;
}

/**
 * Upload file with validation
 */
function upload_file($file, $upload_dir, $allowed_types) {
    global $conn;
    
    if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'File upload error'];
    }
    
    if ($file['size'] > MAX_FILE_SIZE) {
        return ['success' => false, 'message' => 'File size exceeds limit'];
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mime_type, $allowed_types)) {
        return ['success' => false, 'message' => 'File type not allowed'];
    }
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $filename = uniqid() . '_' . basename($file['name']);
    $filepath = $upload_dir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return ['success' => true, 'filename' => $filename, 'path' => $filepath];
    }
    
    return ['success' => false, 'message' => 'Failed to move uploaded file'];
}

/**
 * Get settings from database
 */
function get_settings() {
    global $conn;
    $result = $conn->query("SELECT * FROM settings LIMIT 1");
    return $result->fetch_assoc();
}

/**
 * Get all specialists
 */
function get_specialists($limit = null, $specialty = null, $country = null) {
    global $conn;
    
    $query = "SELECT * FROM specialists WHERE status = 'active'";
    
    if ($specialty) {
        $specialty = $conn->real_escape_string($specialty);
        $query .= " AND specialty = '$specialty'";
    }
    
    if ($country) {
        $country = $conn->real_escape_string($country);
        $query .= " AND country = '$country'";
    }
    
    if ($limit) {
        $query .= " LIMIT $limit";
    }
    
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get specialist by ID
 */
function get_specialist($id) {
    global $conn;
    $id = intval($id);
    $result = $conn->query("SELECT * FROM specialists WHERE id = $id AND status = 'active'");
    return $result->fetch_assoc();
}

/**
 * Get all services
 */
function get_services() {
    global $conn;
    $result = $conn->query("SELECT * FROM services WHERE status = 'active' ORDER BY id");
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get latest news
 */
function get_latest_news($limit = 5) {
    global $conn;
    $limit = intval($limit);
    $result = $conn->query("SELECT * FROM news WHERE status = 'published' ORDER BY publish_date DESC LIMIT $limit");
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get upcoming missions
 */
function get_upcoming_missions($limit = 3) {
    global $conn;
    $limit = intval($limit);
    $result = $conn->query("SELECT * FROM outreach_missions WHERE status IN ('active', 'completed') ORDER BY mission_date DESC LIMIT $limit");
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get partners
 */
function get_partners() {
    global $conn;
    $result = $conn->query("SELECT * FROM partners ORDER BY organization_name");
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Send email
 */
function send_email($to, $subject, $message, $headers = '') {
    $default_headers = "From: " . get_settings()['email'] . "\r\n";
    $default_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $default_headers .= $headers;
    
    return mail($to, $subject, $message, $default_headers);
}

/**
 * Log error
 */
function log_error($message, $context = []) {
    $log_file = dirname(__FILE__) . '/../logs/error.log';
    $timestamp = date('Y-m-d H:i:s');
    $log_message = "[$timestamp] $message";
    
    if (!empty($context)) {
        $log_message .= " | Context: " . json_encode($context);
    }
    
    error_log($log_message . "\n", 3, $log_file);
}

/**
 * Check admin authentication
 */
function is_admin_authenticated() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

/**
 * Redirect to login if not authenticated
 */
function require_admin_login() {
    if (!is_admin_authenticated()) {
        header('Location: ' . ADMIN_URL . 'login.php');
        exit();
    }
}

?>
