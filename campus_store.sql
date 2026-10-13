-- =========================================================
-- SEA-RIOUSLY STATIONERY DATABASE
-- How I went about creating my database.
-- =========================================================

-- I started by creating the database (if it does not already exist depending on when you created yours and whether you went straigh to myPHPadmin.)
CREATE DATABASE IF NOT EXISTS campus_store;

-- I then select the database I wanted to use.
USE campus_store;

-- I removed old tables when this SQL file was imported again.
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

-- I created the users table required by the project brief.
CREATE TABLE users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- I create the products table required by the project brief.
CREATE TABLE products (
    productid INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    Image VARCHAR(500) NOT NULL
);

-- I then Inserted one sample registered user.
-- Username: octavia
-- email: octavia@example.com
-- Password is: octavia123
-- I do reccommend creating a new user when playing around with the website because it simplifies the login process, when using a simple password to play around google gives you a pop-up about your password not being secure.
INSERT INTO users (username, email, password)
VALUES (
    'seastar',
    'seastar@example.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCkzj7h8mJ9X7J0K0v7a'
);

-- I then inserted stationery products with fun under-the-sea names.
INSERT INTO products (name, description, price, Image) VALUES
(
    'Octo-Pen-sational Highlighters',
    'A colourful set of highlighters with enough bright colours to highlight all your best ideas. These little octopus-inspired highlighters are perfect for notes, doodles and making important information stand out.',
    49.99,
    'https://media.giphy.com/media/R8UuotHLiwBZuCqvVX/giphy.gif'
),
(
    'Whale Hello Notebook',
    'A cute everyday notebook for lectures, lists, sketches and all your big-brain ideas.',
    79.99,
    'https://media.giphy.com/media/NlwwQYekhfVxlKAR0E/giphy.gif'
),
(
    'Shell Yeah! Sticker Sheet',
    'A bubbly sticker sheet packed with ocean-inspired decorations for your laptop, planner and notebooks.',
    29.99,
    'https://media.giphy.com/media/2Oi6uci1Yuq8XDs0OQ/giphy.gif'
),
(
    'Jelly Good Pen Pack',
    'A fun pack of colourful pens inspired by jellyfish drifting through the deep blue. Perfect for writing notes, doodling and adding a splash of colour to your stationery collection.',
    59.99,
    'https://media.giphy.com/media/Z1f6CP1e5D6Ltp5hev/giphy.gif'
),
(
    'Seas The Day Desk Set',
    'A fun mini stationery set to keep your desk organised while you make waves with your work.',
    119.99,
    'https://media.giphy.com/media/DMLFppfUHbr7use8E8/giphy.gif'
),
(
    'Shark-Tastic Pencil Pouch',
    'A roomy pencil pouch for pens, pencils and all the little stationery treasures you do not want to lose.',
    89.99,
    'https://media.giphy.com/media/50iG3D9eBtg5iWVDw7/giphy.gif'
);
