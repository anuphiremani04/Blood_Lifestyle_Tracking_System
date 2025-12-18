# Database Updates Required

To enable the new features (quantity field and hospital-to-hospital requests), you need to run the following SQL scripts:

## 1. Add Quantity Column to bloodinfo Table

Run: `sql/add_quantity_column.sql`

This adds a `quantity` column to the `bloodinfo` table to track how many units of each blood group are in stock.

```sql
ALTER TABLE `bloodinfo` ADD `quantity` INT(11) NOT NULL DEFAULT 1 AFTER `bg`;
UPDATE `bloodinfo` SET `quantity` = 1 WHERE `quantity` = 0 OR `quantity` IS NULL;
```

## 2. Create Hospital-to-Hospital Request Table

Run: `sql/create_hospitalrequest_table.sql`

This creates a new table `hospitalrequest` to handle blood requests between hospitals.

```sql
CREATE TABLE IF NOT EXISTS `hospitalrequest` (
  `reqid` int(11) NOT NULL AUTO_INCREMENT,
  `from_hid` int(11) NOT NULL,
  `to_hid` int(11) NOT NULL,
  `bg` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`reqid`),
  KEY `from_hid` (`from_hid`),
  KEY `to_hid` (`to_hid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## How to Apply

1. Open phpMyAdmin or your MySQL client
2. Select the `bloodbank` database
3. Run each SQL script in order:
   - First: `add_quantity_column.sql`
   - Second: `create_hospitalrequest_table.sql`

Or run them via command line:
```bash
mysql -u your_username -p bloodbank < sql/add_quantity_column.sql
mysql -u your_username -p bloodbank < sql/create_hospitalrequest_table.sql
```

## Features Enabled

After running these scripts:
- ✅ Stock of Blood page now shows quantity for each blood group
- ✅ Can add/edit quantity when adding blood groups
- ✅ Hospital-to-hospital blood request system is fully functional
- ✅ Hospitals can send requests to other hospitals
- ✅ Hospitals can accept/reject incoming requests
- ✅ Track all incoming and outgoing requests in one page

