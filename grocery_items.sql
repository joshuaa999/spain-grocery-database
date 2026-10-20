CREATE TABLE IF NOT EXISTS grocery_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    brand_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    country_of_origin VARCHAR(50) NOT NULL DEFAULT 'Spain',
    price_eur DECIMAL(8,2) NOT NULL,
    stock_quantity INT NOT NULL DEFAULT 0,
    expiry_date DATE NULL
);


INSERT INTO grocery_items
(item_name, brand_name, category, country_of_origin,
 price_eur, stock_quantity, expiry_date)
VALUES
('Spaghetti No. 3', 'Gallo', 'Pasta', 'Spain',
 1.20, 40, '2027-12-31'),

('Macaroni', 'Gallo', 'Pasta', 'Spain',
 1.10, 35, '2027-12-31'),

('Pasta Plumas', 'Gallo', 'Pasta', 'Spain',
 1.15, 28, '2027-12-31'),

('Fideo No. 0', 'Gallo', 'Pasta', 'Spain',
 1.00, 30, '2027-12-31'),

('Fideo No. 4', 'Gallo', 'Pasta', 'Spain',
 1.30, 25, '2027-12-31'),

('Whole Wheat Spaghetti', 'Gallo', 'Pasta', 'Spain',
 1.80, 20, '2027-12-31'),

('Lasagna Sheets', 'Gallo', 'Pasta', 'Spain',
 1.90, 18, '2027-12-31'),

('Fideua Pasta', 'Gallo', 'Pasta', 'Spain',
 1.30, 22, '2027-12-31'),

('Extra Virgin Olive Oil', 'Carbonell', 'Olive Oil', 'Spain',
 8.50, 15, '2027-10-31'),

('Extra Mild Olive Oil', 'Carbonell', 'Olive Oil', 'Spain',
 7.20, 20, '2027-10-31'),

('Carbonell 0.4 Olive Oil', 'Carbonell', 'Olive Oil', 'Spain',
 7.50, 18, '2027-10-31'),

('Oro Verde Olive Oil', 'Carbonell', 'Olive Oil', 'Spain',
 9.00, 12, '2027-10-31'),

('Galletas Creme Coco', 'Gullón', 'Biscuits', 'Spain',
 1.80, 25, '2027-06-30'),

('Galletas Creme Junior', 'Gullón', 'Biscuits', 'Spain',
 1.60, 30, '2027-06-30'),

('Galletas Tostada', 'Gullón', 'Biscuits', 'Spain',
 1.50, 24, '2027-06-30');

 -- Batch 2: Additional Spanish grocery products
-- Prices and stock quantities are sample values.

INSERT INTO grocery_items
(item_name, brand_name, category, country_of_origin,
 price_eur, stock_quantity, expiry_date)
VALUES
('Carbonell Arbequina Extra Virgin Olive Oil', 'Carbonell',
 'Olive Oil', 'Spain', 9.50, 16, '2027-10-31'),

('Carbonell Hojiblanca Extra Virgin Olive Oil', 'Carbonell',
 'Olive Oil', 'Spain', 9.50, 14, '2027-10-31'),

('Carbonell Picual Extra Virgin Olive Oil', 'Carbonell',
 'Olive Oil', 'Spain', 9.50, 12, '2027-10-31'),

('Carbonell Extra Virgin Olive Oil Organic', 'Carbonell',
 'Olive Oil', 'Spain', 10.50, 10, '2027-10-31'),

('Carbonell Extra Virgin Olive Oil Spray', 'Carbonell',
 'Olive Oil', 'Spain', 4.50, 20, '2027-10-31'),

('Carbonell Extra Mild Olive Oil', 'Carbonell',
 'Olive Oil', 'Spain', 7.20, 18, '2027-10-31'),

('Carbonell Green Olives with Anchovies', 'Carbonell',
 'Olives', 'Spain', 2.50, 24, '2027-06-30'),

('Carbonell Seasoned Green Olives', 'Carbonell',
 'Olives', 'Spain', 2.30, 22, '2027-06-30'),

('Carbonell Pitted Black Olives', 'Carbonell',
 'Olives', 'Spain', 2.10, 20, '2027-06-30'),

('Gullon Chocolate Wafer Rolls Zero', 'Gullón',
 'Biscuits', 'Spain', 2.05, 18, '2027-06-30'),

('Gullon Karamel Speculoos Wafer Rolls Zero', 'Gullón',
 'Biscuits', 'Spain', 2.10, 16, '2027-06-30'),

('Gullon Vanilla Wafer Rolls Zero', 'Gullón',
 'Biscuits', 'Spain', 2.05, 20, '2027-06-30'),

('Gullon Wafer Mix Chocolate and Hazelnut', 'Gullón',
 'Biscuits', 'Spain', 1.65, 25, '2027-06-30'),

('Gullon Orange Oat Snack Bars Zero', 'Gullón',
 'Snack Bars', 'Spain', 2.20, 15, '2027-06-30'),

('Gullon Topping Digestive Biscuits', 'Gullón',
 'Biscuits', 'Spain', 1.80, 22, '2027-06-30');

 -- Batch 3: Spanish cocoa drinks and chocolate spreads
-- Prices and stock quantities are sample values.

INSERT INTO grocery_items
(item_name, brand_name, category, country_of_origin,
 price_eur, stock_quantity, expiry_date)
VALUES
('ColaCao Original', 'ColaCao', 'Cocoa Drink', 'Spain',
 4.99, 25, '2027-06-30'),

('ColaCao Turbo', 'ColaCao', 'Cocoa Drink', 'Spain',
 5.20, 20, '2027-06-30'),

('ColaCao Cero', 'ColaCao', 'Cocoa Drink', 'Spain',
 5.50, 18, '2027-06-30'),

('ColaCao Noir', 'ColaCao', 'Cocoa Drink', 'Spain',
 5.75, 15, '2027-06-30'),

('ColaCao Puro', 'ColaCao', 'Cocoa Drink', 'Spain',
 6.20, 12, '2027-06-30'),

('ColaCao Avena', 'ColaCao', 'Cocoa Drink', 'Spain',
 5.80, 14, '2027-06-30'),

('ColaCao Complet', 'ColaCao', 'Cocoa Drink', 'Spain',
 5.60, 16, '2027-06-30'),

('ColaCao Energy', 'ColaCao', 'Cocoa Drink', 'Spain',
 5.40, 13, '2027-06-30'),

('Nocilla Original', 'Nocilla', 'Chocolate Spread', 'Spain',
 3.99, 22, '2027-06-30'),

('Nocilla Chocomix', 'Nocilla', 'Chocolate Spread', 'Spain',
 4.20, 18, '2027-06-30'),

('Nocilla Avellanas', 'Nocilla', 'Chocolate Spread', 'Spain',
 4.10, 20, '2027-06-30'),

('Nocilla Original 0% Azucares', 'Nocilla',
 'Chocolate Spread', 'Spain', 4.50, 14, '2027-06-30'),

('Nocilla Noir', 'Nocilla', 'Chocolate Spread', 'Spain',
 4.30, 16, '2027-06-30'),

('Nocilla Cookies and Cream', 'Nocilla',
 'Chocolate Spread', 'Spain', 4.60, 12, '2027-06-30'),

('Nocilla Crunchy', 'Nocilla', 'Chocolate Spread', 'Spain',
 4.40, 15, '2027-06-30');

-- Batch 4: Spanish meat products
-- Prices and stock quantities are sample values.

INSERT INTO grocery_items
(item_name, brand_name, category, country_of_origin,
 price_eur, stock_quantity, expiry_date)
VALUES
('Cooking Chorizo', 'ElPozo', 'Processed Meat', 'Spain',
 3.50, 20, '2027-01-31'),

('Spicy Chorizo', 'ElPozo', 'Processed Meat', 'Spain',
 3.80, 15, '2027-01-31'),

('Iberico Chorizo', 'ElPozo', 'Processed Meat', 'Spain',
 5.50, 12, '2027-01-31'),

('Chorizo Extra', 'ElPozo', 'Processed Meat', 'Spain',
 3.20, 18, '2027-01-31'),

('Mini Cooking Chorizo', 'ElPozo', 'Processed Meat', 'Spain',
 3.60, 16, '2027-01-31'),

('Spicy Cooking Chorizo', 'ElPozo', 'Processed Meat', 'Spain',
 3.90, 14, '2027-01-31'),

('Chistorra', 'ElPozo', 'Sausage', 'Spain',
 8.50, 10, '2027-01-31'),

('Longaniza', 'ElPozo', 'Sausage', 'Spain',
 4.20, 15, '2027-01-31'),

('Fuetec Mediterraneo', 'ElPozo', 'Meat Snack', 'Spain',
 2.80, 20, '2027-01-31'),

('Fuetec Snack', 'ElPozo', 'Meat Snack', 'Spain',
 2.50, 22, '2027-01-31'),

('Fuetec Truffle', 'ElPozo', 'Meat Snack', 'Spain',
 3.20, 12, '2027-01-31'),

('Serrano Ham', 'ElPozo', 'Cured Meat', 'Spain',
 4.50, 18, '2027-01-31'),

('Serrano Reserva Ham', 'ElPozo', 'Cured Meat', 'Spain',
 5.80, 12, '2027-01-31'),

('Gran Serrano Ham', 'ElPozo', 'Cured Meat', 'Spain',
 6.50, 10, '2027-01-31'),

('Iberico Cured Ham', 'ElPozo', 'Cured Meat', 'Spain',
 9.50, 8, '2027-01-31');

-- Batch 5: Spanish jams and fruit spreads
-- Prices and stock quantities are sample values.

INSERT INTO grocery_items
(item_name, brand_name, category, country_of_origin,
 price_eur, stock_quantity, expiry_date)
VALUES
('Mermelada Classica Fresa', 'Hero', 'Jam', 'Spain',
 2.20, 20, '2027-06-30'),

('Mermelada Classica Melocoton', 'Hero', 'Jam', 'Spain',
 2.20, 18, '2027-06-30'),

('Mermelada Classica Ciruela', 'Hero', 'Jam', 'Spain',
 2.30, 16, '2027-06-30'),

('Mermelada Classica Albaricoque', 'Hero', 'Jam', 'Spain',
 2.30, 17, '2027-06-30'),

('Mermelada Classica Tomate', 'Hero', 'Jam', 'Spain',
 2.50, 12, '2027-06-30'),

('Mermelada de Temporada de Mango', 'Hero', 'Jam', 'Spain',
 2.60, 14, '2027-06-30'),

('Mermelada de Temporada de Higos', 'Hero', 'Jam', 'Spain',
 2.60, 13, '2027-06-30'),

('Mermelada de Temporada de Frambuesa', 'Hero', 'Jam', 'Spain',
 2.70, 15, '2027-06-30'),

('Mermelada de Temporada de Arandanos', 'Hero', 'Jam', 'Spain',
 2.70, 12, '2027-06-30'),

('Mermelada de Temporada Frutos Rojos', 'Hero', 'Jam', 'Spain',
 2.80, 11, '2027-06-30'),

('Confitura Diet de Fresa', 'Hero', 'Sugar-Free Spread', 'Spain',
 2.50, 16, '2027-06-30'),

('Confitura Diet de Melocoton', 'Hero', 'Sugar-Free Spread', 'Spain',
 2.50, 15, '2027-06-30'),

('Confitura Diet de Ciruela', 'Hero', 'Sugar-Free Spread', 'Spain',
 2.50, 14, '2027-06-30'),

('Confitura Diet de Albaricoque', 'Hero', 'Sugar-Free Spread', 'Spain',
 2.60, 13, '2027-06-30'),

('Confitura Diet de Naranja Amarga', 'Hero', 'Sugar-Free Spread', 'Spain',
 2.60, 12, '2027-06-30');

-- Batch 6: Additional products from Spanish brand Gullón
-- Prices and stock quantities are sample values.

INSERT INTO grocery_items
(item_name, brand_name, category, country_of_origin,
 price_eur, stock_quantity, expiry_date)
VALUES
('Digestive Biscuits', 'Gullón', 'Biscuits', 'Spain',
 1.80, 25, '2027-06-30'),

('Sugar-Free Maria Biscuits', 'Gullón', 'Biscuits', 'Spain',
 2.00, 20, '2027-06-30'),

('Sugar-Free Digestive Biscuits', 'Gullón', 'Biscuits', 'Spain',
 2.20, 18, '2027-06-30'),

('Chocolate Chip Cookies', 'Gullón', 'Biscuits', 'Spain',
 2.10, 22, '2027-06-30'),

('Oatmeal Biscuits', 'Gullón', 'Biscuits', 'Spain',
 1.90, 20, '2027-06-30'),

('Whole Wheat Maria Biscuits', 'Gullón', 'Biscuits', 'Spain',
 1.70, 24, '2027-06-30'),

('Sugar-Free Chocolate Biscuits', 'Gullón', 'Biscuits', 'Spain',
 2.30, 16, '2027-06-30'),

('Digestive Biscuits with Chocolate', 'Gullón', 'Biscuits', 'Spain',
 2.40, 18, '2027-06-30'),

('Coconut Biscuits', 'Gullón', 'Biscuits', 'Spain',
 1.80, 21, '2027-06-30'),

('Vanilla Wafer Biscuits', 'Gullón', 'Biscuits', 'Spain',
 1.90, 20, '2027-06-30'),

('Chocolate Wafer Biscuits', 'Gullón', 'Biscuits', 'Spain',
 2.00, 19, '2027-06-30'),

('Cream-Filled Biscuits', 'Gullón', 'Biscuits', 'Spain',
 1.80, 22, '2027-06-30'),

('Breakfast Biscuits', 'Gullón', 'Biscuits', 'Spain',
 2.10, 17, '2027-06-30'),

('Cracker Biscuits', 'Gullón', 'Biscuits', 'Spain',
 1.60, 23, '2027-06-30'),

('Mini Chocolate Cookies', 'Gullón', 'Biscuits', 'Spain',
 2.20, 15, '2027-06-30');

-- Batch 7: Spanish canned seafood from Calvo
-- Prices and stock quantities are sample values.

INSERT INTO grocery_items
(item_name, brand_name, category, country_of_origin,
 price_eur, stock_quantity, expiry_date)
VALUES
('Light Tuna in Olive Oil', 'Calvo', 'Canned Seafood', 'Spain',
 2.50, 25, '2028-06-30'),

('Light Tuna in Extra Virgin Olive Oil', 'Calvo',
 'Canned Seafood', 'Spain', 2.80, 20, '2028-06-30'),

('Light Tuna in Sunflower Oil', 'Calvo', 'Canned Seafood', 'Spain',
 2.30, 24, '2028-06-30'),

('Light Tuna in Olive Oil Low Salt', 'Calvo',
 'Canned Seafood', 'Spain', 2.60, 18, '2028-06-30'),

('Light Tuna in Brine', 'Calvo', 'Canned Seafood', 'Spain',
 2.20, 22, '2028-06-30'),

('Light Tuna in Brine +PRO', 'Calvo', 'Canned Seafood', 'Spain',
 2.90, 16, '2028-06-30'),

('Salmon in Natural Juice', 'Calvo', 'Canned Seafood', 'Spain',
 4.50, 12, '2028-06-30'),

('Mussels in Pickled Sauce', 'Calvo', 'Canned Seafood', 'Spain',
 3.20, 18, '2028-06-30'),

('Sardines in Olive Oil', 'Calvo', 'Canned Seafood', 'Spain',
 2.40, 20, '2028-06-30'),

('Sardines in Tomato Sauce', 'Calvo', 'Canned Seafood', 'Spain',
 2.50, 17, '2028-06-30'),

('Squid in Ink', 'Calvo', 'Canned Seafood', 'Spain',
 3.10, 14, '2028-06-30'),

('Tuna and Vegetable Salad', 'Calvo', 'Canned Salad', 'Spain',
 3.50, 15, '2028-06-30'),

('Tuna and Pasta Salad', 'Calvo', 'Canned Salad', 'Spain',
 3.40, 16, '2028-06-30'),

('Light Tuna in Olive Oil La Española', 'Calvo',
 'Canned Seafood', 'Spain', 2.70, 19, '2028-06-30'),

('Light Tuna in Sunflower Oil La Española', 'Calvo',
 'Canned Seafood', 'Spain', 2.50, 18, '2028-06-30');