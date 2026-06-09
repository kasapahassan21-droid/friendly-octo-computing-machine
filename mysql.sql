CREATE DATABASE IF NOT EXISTS smart_fundi
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE smart_fundi;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  full_name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin', 'staff', 'fundi', 'customer') NOT NULL DEFAULT 'staff',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS technicians (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id INT UNSIGNED DEFAULT NULL,
  skill VARCHAR(120) NOT NULL,
  area VARCHAR(120) NOT NULL,
  rating DECIMAL(2,1) NOT NULL DEFAULT 0.0,
  jobs_completed INT UNSIGNED NOT NULL DEFAULT 0,
  available TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_technicians_user_id (user_id),
  CONSTRAINT fk_technicians_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS service_requests (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  customer_name VARCHAR(120) NOT NULL,
  customer_phone VARCHAR(40) NOT NULL,
  service_type VARCHAR(80) NOT NULL,
  location VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  status ENUM('open', 'assigned', 'done', 'cancelled') NOT NULL DEFAULT 'open',
  urgency VARCHAR(30) NOT NULL DEFAULT 'Kawaida',
  estimated_price DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  technician_id INT UNSIGNED DEFAULT NULL,
  requested_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  scheduled_for DATETIME DEFAULT NULL,
  completed_at DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_service_requests_status (status),
  KEY idx_service_requests_technician_id (technician_id),
  CONSTRAINT fk_service_requests_technician
    FOREIGN KEY (technician_id) REFERENCES technicians(id)
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS payments (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  request_id INT UNSIGNED NOT NULL,
  amount DECIMAL(12,2) NOT NULL,
  currency CHAR(3) NOT NULL DEFAULT 'TZS',
  payment_status ENUM('pending', 'paid', 'refunded') NOT NULL DEFAULT 'pending',
  reference_code VARCHAR(120) DEFAULT NULL,
  paid_at DATETIME DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_payments_request_id (request_id),
  CONSTRAINT fk_payments_request
    FOREIGN KEY (request_id) REFERENCES service_requests(id)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS audit_logs (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id INT UNSIGNED DEFAULT NULL,
  action VARCHAR(120) NOT NULL,
  payload JSON DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_audit_logs_user_id (user_id),
  CONSTRAINT fk_audit_logs_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (full_name, email, password_hash, role) VALUES
  ('Admin Smart Fundi', 'admin@smartfundi.local', '$2y$10$smartfundi.demo.hash', 'admin'),
  ('Asha M.', 'asha@example.com', '$2y$10$smartfundi.demo.hash', 'customer')
ON DUPLICATE KEY UPDATE
  full_name = VALUES(full_name),
  role = VALUES(role);

INSERT INTO technicians (user_id, skill, area, rating, jobs_completed, available) VALUES
  (NULL, 'Umeme', 'Mbezi', 4.8, 204, 1),
  (NULL, 'Plumbing', 'Sinza', 4.8, 146, 1),
  (NULL, 'AC', 'Masaki', 4.9, 82, 1),
  (NULL, 'Seremala', 'Kijitonyama', 4.7, 118, 0)
ON DUPLICATE KEY UPDATE
  skill = VALUES(skill),
  area = VALUES(area),
  rating = VALUES(rating),
  jobs_completed = VALUES(jobs_completed),
  available = VALUES(available);
