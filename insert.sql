-- ============================================================================
-- PHARMACY POS TEST DATA - CAMEROON EDITION
-- Run db.sql first, then run this file.
-- Seeds ten records per core catalog/entity group for the first store.
-- ============================================================================

USE `pharmacy`;
SET NAMES utf8mb4;

SET @store_id = (SELECT `store_id` FROM `store` ORDER BY `store_id` LIMIT 1);

-- Ten medicine categories
INSERT INTO `p_medicine_category` (`store`, `name`, `img`) VALUES
(@store_id, 'Analgesics', 'not-available.png'),
(@store_id, 'Antibiotics', 'not-available.png'),
(@store_id, 'Antimalarials', 'not-available.png'),
(@store_id, 'Antihistamines', 'not-available.png'),
(@store_id, 'Vitamins', 'not-available.png'),
(@store_id, 'Gastrointestinal', 'not-available.png'),
(@store_id, 'Respiratory Care', 'not-available.png'),
(@store_id, 'Skin Care', 'not-available.png'),
(@store_id, 'First Aid', 'not-available.png'),
(@store_id, 'Maternal Care', 'not-available.png');

-- Ten brands
INSERT INTO `p_brand` (`store`, `name`, `details`, `img`) VALUES
(@store_id, 'Sana Pharma', 'Cameroon test brand', 'not-available.png'),
(@store_id, 'Biopharm', 'Cameroon test brand', 'not-available.png'),
(@store_id, 'Pharma Plus', 'Cameroon test brand', 'not-available.png'),
(@store_id, 'Afrimed', 'Cameroon test brand', 'not-available.png'),
(@store_id, 'MediCare', 'Cameroon test brand', 'not-available.png'),
(@store_id, 'HealthFirst', 'Cameroon test brand', 'not-available.png'),
(@store_id, 'WellLife', 'Cameroon test brand', 'not-available.png'),
(@store_id, 'Bonsil Labs', 'Cameroon test brand', 'not-available.png'),
(@store_id, 'CureLine', 'Cameroon test brand', 'not-available.png'),
(@store_id, 'VitalCam', 'Cameroon test brand', 'not-available.png');

-- Ten suppliers
INSERT INTO `p_supplier` (`store`, `name`, `email`, `phone`, `address`, `receivable`, `payable`) VALUES
(@store_id, 'Cameroon Medical Depot', 'depot@example.cm', '677000001', 'Douala', 0, 0),
(@store_id, 'Central Pharma Supply', 'central@example.cm', '677000002', 'Yaounde', 0, 0),
(@store_id, 'Littoral Health Traders', 'littoral@example.cm', '677000003', 'Douala', 0, 0),
(@store_id, 'Mfoundi Medicines', 'mfoundi@example.cm', '677000004', 'Yaounde', 0, 0),
(@store_id, 'West Region Pharma', 'west@example.cm', '677000005', 'Bafoussam', 0, 0),
(@store_id, 'Northwest Medicals', 'northwest@example.cm', '677000006', 'Bamenda', 0, 0),
(@store_id, 'South Health Supply', 'south@example.cm', '677000007', 'Ebolowa', 0, 0),
(@store_id, 'Adamawa Pharma', 'adamawa@example.cm', '677000008', 'Ngaoundere', 0, 0),
(@store_id, 'Far North Medicals', 'farnorth@example.cm', '677000009', 'Maroua', 0, 0),
(@store_id, 'East Region Supply', 'east@example.cm', '677000010', 'Bertoua', 0, 0);

-- Ten customers
INSERT INTO `p_customer` (`store`, `name`, `email`, `phone`, `address`, `customertype`, `customerstatus`, `points`) VALUES
(@store_id, 'Jean Mbarga', 'jean@example.cm', '690000001', 'Douala', 'Regular', 'active', 0),
(@store_id, 'Marie Ngo', 'marie@example.cm', '690000002', 'Yaounde', 'Regular', 'active', 0),
(@store_id, 'Paul Tchami', 'paul@example.cm', '690000003', 'Bafoussam', 'Regular', 'active', 0),
(@store_id, 'Grace Fomukong', 'grace@example.cm', '690000004', 'Bamenda', 'Regular', 'active', 0),
(@store_id, 'Alain Etoa', 'alain@example.cm', '690000005', 'Douala', 'Regular', 'active', 0),
(@store_id, 'Sophie Abena', 'sophie@example.cm', '690000006', 'Yaounde', 'Regular', 'active', 0),
(@store_id, 'David Ekane', 'david@example.cm', '690000007', 'Limbe', 'Regular', 'active', 0),
(@store_id, 'Claudine Essomba', 'claudine@example.cm', '690000008', 'Ebolowa', 'Regular', 'active', 0),
(@store_id, 'Brice Mvondo', 'brice@example.cm', '690000009', 'Bertoua', 'Regular', 'active', 0),
(@store_id, 'Esther Aminata', 'esther@example.cm', '690000010', 'Maroua', 'Regular', 'active', 0);

-- Ten products priced in XAF
INSERT INTO `p_medicine` (`store`, `expiredate`, `abroad`, `name`, `details`, `category`, `brand`, `strength`, `unit`, `code`, `shelf`, `cost`, `price`, `qty`, `img`) VALUES
(@store_id, '2027-12-31', 'No', 'Paracetamol 500mg', 'Pain and fever relief', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='Analgesics' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='Sana Pharma' LIMIT 1), '500mg', 1, 'CM-PAR-001', 'A1', 75, 100, 100, 'bonsil.jpg'),
(@store_id, '2027-11-30', 'No', 'Amoxicillin 500mg', 'Antibiotic capsules', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='Antibiotics' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='Biopharm' LIMIT 1), '500mg', 1, 'CM-AMX-002', 'A2', 250, 350, 80, 'bonsil.jpg'),
(@store_id, '2028-02-28', 'No', 'Artemether Lumefantrine', 'Antimalarial tablets', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='Antimalarials' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='Pharma Plus' LIMIT 1), '80/480mg', 1, 'CM-ART-003', 'A3', 1200, 1500, 60, 'bonsil.jpg'),
(@store_id, '2027-09-30', 'No', 'Cetirizine 10mg', 'Allergy relief tablets', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='Antihistamines' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='Afrimed' LIMIT 1), '10mg', 1, 'CM-CET-004', 'B1', 150, 250, 90, 'bonsil.jpg'),
(@store_id, '2028-04-30', 'No', 'Vitamin C 1000mg', 'Vitamin supplement', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='Vitamins' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='MediCare' LIMIT 1), '1000mg', 1, 'CM-VIT-005', 'B2', 900, 1200, 50, 'bonsil.jpg'),
(@store_id, '2027-10-31', 'No', 'Omeprazole 20mg', 'Gastric acid relief', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='Gastrointestinal' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='HealthFirst' LIMIT 1), '20mg', 1, 'CM-OMP-006', 'B3', 300, 450, 70, 'bonsil.jpg'),
(@store_id, '2028-01-31', 'No', 'Salbutamol Syrup', 'Respiratory support syrup', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='Respiratory Care' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='WellLife' LIMIT 1), '2mg/5ml', 1, 'CM-SAL-007', 'C1', 500, 750, 45, 'bonsil.jpg'),
(@store_id, '2027-08-31', 'No', 'Hydrocortisone Cream', 'Topical skin cream', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='Skin Care' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='Bonsil Labs' LIMIT 1), '1%', 1, 'CM-HYD-008', 'C2', 600, 900, 40, 'bonsil.jpg'),
(@store_id, '2028-03-31', 'No', 'Antiseptic Solution', 'First aid antiseptic', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='First Aid' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='CureLine' LIMIT 1), '100ml', 1, 'CM-ANT-009', 'C3', 400, 600, 55, 'bonsil.jpg'),
(@store_id, '2027-12-31', 'No', 'Iron and Folic Acid', 'Maternal supplement', (SELECT id FROM p_medicine_category WHERE store=@store_id AND name='Maternal Care' LIMIT 1), (SELECT id FROM p_brand WHERE store=@store_id AND name='VitalCam' LIMIT 1), '60mg', 1, 'CM-IFA-010', 'C4', 700, 1000, 35, 'bonsil.jpg');

-- Ten expense categories for a newly seeded store
INSERT INTO `p_expense_category` (`store`, `category`) VALUES
(@store_id, 'Electricity'), (@store_id, 'Water'), (@store_id, 'Internet'), (@store_id, 'Rent'), (@store_id, 'Salaries'),
(@store_id, 'Transport'), (@store_id, 'Cleaning'), (@store_id, 'Security'), (@store_id, 'Marketing'), (@store_id, 'Repairs');

-- Ten Cameroon payment methods are created during registration; this keeps older stores complete.
INSERT IGNORE INTO `payment_method` (`store`, `method_name`, `method_code`, `category`, `is_active`) VALUES
(@store_id, 'MTN Mobile Money', 'mtn_mobile_money', 'mobile_money', 1),
(@store_id, 'Orange Mobile Money', 'orange_mobile_money', 'mobile_money', 1),
(@store_id, 'Mobile Money - Other', 'other_mobile_money', 'mobile_money', 1),
(@store_id, 'Bank Transfer', 'bank_transfer', 'bank', 1),
(@store_id, 'Card Payment', 'card_payment', 'card', 1),
(@store_id, 'Binance Pay', 'binance_pay', 'crypto', 1),
(@store_id, 'Hand Cash', 'hand_cash', 'cash', 1),
(@store_id, 'Cheque', 'cheque', 'bank', 1),
(@store_id, 'Express Union', 'express_union', 'bank', 1),
(@store_id, 'Cash Express', 'cash_express', 'mobile_money', 1);
