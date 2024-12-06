-- Use the database
USE room_management_system;

-- Insert employees with user_id = 1
INSERT INTO `employees` (`user_id`, `organization_name`, `position`, `created_at`, `updated_at`)
VALUES
(1, 'ABC Corp', 'Manager', NOW(), NOW()),
(1, 'XYZ Ltd', 'Assistant', NOW(), NOW());

-- Insert rooms
INSERT INTO `rooms` (`employee_id`, `room_name`, `capacity`, `description`, `created_at`, `updated_at`)
VALUES
(1, 'Conference Room 1', 10, 'A large conference room for meetings', NOW(), NOW()),
(1, 'Conference Room 2', 8, 'A medium-sized conference room', NOW(), NOW()),
(2, 'Meeting Room 1', 4, 'A small meeting room for team discussions', NOW(), NOW());

-- Insert amenities
INSERT INTO `amenities` (`name`, `created_at`, `updated_at`)
VALUES
('Projector', NOW(), NOW()),
('Whiteboard', NOW(), NOW()),
('WiFi', NOW(), NOW());

-- Insert room_amenities
INSERT INTO `room_amenities` (`room_id`, `amenity_id`, `created_at`, `updated_at`)
VALUES
(1, 1, NOW(), NOW()), -- Projector for Conference Room 1
(1, 2, NOW(), NOW()), -- Whiteboard for Conference Room 1
(2, 1, NOW(), NOW()), -- Projector for Conference Room 2
(2, 3, NOW(), NOW()), -- WiFi for Conference Room 2
(3, 2, NOW(), NOW()); -- Whiteboard for Meeting Room 1

-- Insert bookings (spread out times)
INSERT INTO `bookings` (`room_id`, `employee_id`, `start_time`, `end_time`, `bookingStatus`, `created_at`, `updated_at`)
VALUES
(1, 1, '2024-12-01 10:00:00', '2024-12-01 12:00:00', 'confirmed', NOW(), NOW()),
(2, 2, '2024-12-01 14:00:00', '2024-12-01 16:00:00', 'pending', NOW(), NOW()),
(3, 1, '2024-12-02 09:00:00', '2024-12-02 11:00:00', 'cancelled', NOW(), NOW()),
(1, 2, '2024-12-02 13:00:00', '2024-12-02 15:00:00', 'confirmed', NOW(), NOW());
