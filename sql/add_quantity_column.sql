-- Add quantity column to bloodinfo table
ALTER TABLE `bloodinfo` ADD `quantity` INT(11) NOT NULL DEFAULT 1 AFTER `bg`;

-- Update existing records to have quantity 1
UPDATE `bloodinfo` SET `quantity` = 1 WHERE `quantity` = 0 OR `quantity` IS NULL;

