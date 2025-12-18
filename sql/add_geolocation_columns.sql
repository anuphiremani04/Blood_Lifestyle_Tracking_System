-- Add geolocation columns to hospitals table
ALTER TABLE `hospitals` 
ADD COLUMN `latitude` DECIMAL(10, 8) NULL AFTER `hcity`,
ADD COLUMN `longitude` DECIMAL(11, 8) NULL AFTER `latitude`,
ADD COLUMN `address` VARCHAR(255) NULL AFTER `longitude`;

-- Add geolocation columns to receivers table
ALTER TABLE `receivers` 
ADD COLUMN `latitude` DECIMAL(10, 8) NULL AFTER `rcity`,
ADD COLUMN `longitude` DECIMAL(11, 8) NULL AFTER `latitude`,
ADD COLUMN `address` VARCHAR(255) NULL AFTER `longitude`;

