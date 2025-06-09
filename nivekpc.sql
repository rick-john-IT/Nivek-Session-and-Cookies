-- Create a table for storing user information
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL, -- Add phone column
    address VARCHAR(255) NOT NULL -- Add address column
);

INSERT INTO users (username, email, password, phone, address) 
VALUES ('admin', 'admin@gmail.com', 'admin123', '', '');


-- Create a table for storing password reset requests
CREATE TABLE password_reset (
    reset_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_price DECIMAL(10,2) NOT NULL,
    description TEXT NOT NULL,
    stock INT NOT NULL,
    product_img VARCHAR(255) NOT NULL
);

INSERT INTO products (product_name, product_price, description, stock, product_img)
VALUES 
('AMD Ryzen 7 5800X', 399.99, 'Introducing the AMD Ryzen 7 5800X, a high-performance desktop processor with 8 cores and 16 threads. Built on the Zen 3 architecture, it delivers blazing speeds of up to 4.7 GHz...', 100, 'AMD Ryzen 7 5800X.jpg'),
('AMD Ryzen 5 3600', 199.99, 'The AMD Ryzen 5 3600 desktop processor offers 6 native and 12 logical cores for smooth multitasking...', 150, 'AMD Ryzen 5 3600.jpg'),
('AMD Ryzen 5 5600', 279.99, 'The AMD Ryzen 5 5600 is a high-performance desktop processor featuring 6 cores and 12 threads, built on the efficient Zen 3 architecture...', 120, 'AMD Ryzen 5 5600.jpg'),
('AMD Ryzen Threadripper 3990X', 2999.99, 'Introducing the AMD Ryzen Threadripper 3990X: a powerhouse desktop processor with an astounding 64 cores and 128 threads, designed for uncompromising performance...', 50, 'AMD Ryzen Threadripper 3990X.jpg'),
('AMD Ryzen 7 4700G', 249.99, 'Introducing the AMD Ryzen 7 4700G, a high-performance desktop processor featuring 8 cores and 16 threads, launched in July 2020...', 80, 'AMD Ryzen 7 4700G.jpg'),
('Ryzen 5 5500', 229.99, 'Introducing the AMD Ryzen 5 5500, a cutting-edge desktop processor launched in April 2022...', 100, 'Ryzen 5 5500.jpg'),
('ZOTAC RTX 3060 Twin Edge OC', 499.99, 'Get Amplified with the ZOTAC GAMING GeForce RTX™ 30 Series based on the NVIDIA Ampere architecture...', 200, 'ZOTAC RTX 3060 Twin Edge OC.jpg'),
('Sapphire RX470', 199.99, 'the Sapphire Radeon RX 470 OC Graphics Card provides smooth gameplay at HD resolutions on DirectX 12, Vulkan, and e-Sports titles...', 150, 'Sapphire RX470.jpg'),
('Gigabyte GTX 1660 Super', 299.99, 'The graphics card uses 4+2 power phases design to allow the MOSFET to operate at lower temperature...', 120, 'Gigabyte GTX 1660 Super.jpg'),
('PNY GFORCE RTX 3060 DDR6', 499.99, 'The GeForce RTX™ 3060 lets you take on the latest games using the power of Ampere...', 200, 'PNY GFORCE RTX 3060 DDR6.jpg'),
('PNY RTX A6000 48GB DDR6', 2999.99, 'CUDA Cores 10752 Tensor Cores	336 RT Cores 84
Single Precision Performance	38.7 TFLOPS
RT Core Performance	75.6 TFLOPS
Tensor Performance	309.7 TFLOPS...', 50, 'PNY RTX A6000 48GB DDR6.jpg'),
('AMD Radeon Vega 8', 99.99, 'The Radeon Vega 8 is an integrated graphics solution by AMD, launched on February 12th, 2018...', 150, 'AMD Radeon Vega 8.jpg'),
('GALAX GTX 1660 Super', 299.99, 'With dual 90 mm fans and fans stop to assure the temperature is maintained at a reasonable level...', 120, 'GALAX GTX 1660 Super.jpg'),
('GTX 1070Ti', 449.99, 'The GeForce GTX 1070 Ti, released in November 2017, is a high-end graphics card by NVIDIA...', 100, 'GTX 1070Ti.jpg'),
('GTX 1080Ti', 599.99, 'The GeForce GTX 1080 Ti, released in March 2017, is a top-tier graphics card by NVIDIA...', 80, 'GTX 1080Ti.jpg'),
('Asus GTX 1660 Super', 329.99, 'The GeForce GTX 1660 SUPER is up to 20% faster than the original GTX 1660 and up to 1.5X faster than the previous-generation GTX 1060 6GB...', 150, 'Asus GTX 1660 Super.jpg'),
('ASUS TUF Gaming B450 Pro II', 129.99, 'Comprehensive cooling: VRM heatsinks, PCH heatsink, Fan Xpert 2+...', 200, 'ASUS TUF Gaming B450 Pro II.jpg'),
('Onda A520SD4 White', 79.99, 'Chipset:A520 CPU pin:Supports AMD AM4 processors (Ryzen 3000 series, 4000 series, 5000 series cpus; 4000G series, 5000G series APUs)...', 150, 'Onda A520SD4 White.jpg'),
('MSI B550m P GEN 3', 149.99, 'Supports AMD Ryzen™ 5000 & 3000 Series desktop processors (not compatible with AMD Ryzen™ 5 3400G & Ryzen™ 3 3200G)...', 180, 'MSI B550m P GEN 3.jpg'),
('Gigabyte B550M DS3H AC', 119.99, 'Key Features Supports AMD Ryzen™ 5000 Series/ Ryzen™ 5000 G-Series/ Ryzen™ 4000 G-Series/ Ryzen™ 3000 and Ryzen™ 3000 G-Series Processors...', 200, 'Gigabyte B550M DS3H AC.jpg'),
('A320m Motherboard', 69.99, 'Supports AMD 5000 Series/ 5000 G-Series/ 4000 G-Series/ 3rd Gen Ryzen™/ 2nd Gen Ryzen™/ 1st Gen Ryzen™/ 2nd Gen Ryzen™ with Radeon™ Vega Graphics/ 1st Gen Ryzen™ with Radeon™ Vega Graphics/ Athlon™ with Radeon™ Vega Graphics/ 7th Gen A-series/ Athlon X4 Processors...', 250, 'A320m Motherboard.jpg'),
('Asus B550M-A WiFi', 139.99, 'MD B550 (Ryzen AM4) micro ATX motherboard with dual M.2, PCIe 4.0, Intel® WiFi 6, 1 Gb Ethernet, HDMI/D-Sub/DVI, SATA 6 Gbps, USB 3.2 Gen 2 Type-A, and Aura Sync RGB lighting support...', 200, 'Asus B550M-A WiFi.jpg'),
('Gigabyte B450 AORUS M', 99.99, 'Supports AMD 2nd Generation Ryzen™/ Ryzen™ with Radeon™ Vega Graphics/ 1st Generation Ryzen™/ 7th Generation A-Series/ Athlon™ X4 Processors...', 180, 'Gigabyte B450 AORUS M.jpg'),
('T-Force Vulcan Z 16GB (2 x 8GB)', 69.99, 'Dual Channel Kit Configuration. Aluminum heat spreader. Selected high-quality IC chips. 1.2V low working voltage...', 300, 'T-Force Vulcan Z 16GB (2 x 8GB).jpg'),
('Crucial Ballistix RGB 16GB (2 x 8GB)', 79.99, 'Modern aluminum heat spreader available in multiple colors to match your system build or style...', 280, 'Crucial Ballistix RGB 16GB (2 x 8GB).jpg'),
('Corsair Vengeance LPX 16GB (2 x 8GB)', 89.99, 'Designed for high-performance overclocking. Each Vengeance LPX module is built with a pure aluminum heat spreader...', 250, 'Corsair Vengeance LPX 16GB (2 x 8GB).jpg'),
('HyperX Fury RGB 16GB (2 x 8GB)', 99.99, 'Stunning RGB lighting with a bold, aggressive style. Patent-pending HyperX Infrared Sync Technology...', 220, 'HyperX Fury RGB 16GB (2 x 8GB).jpg'),
('ADATA XPG Spectrix D60G 16GB (2 x 8GB)', 119.99, 'Mesmerizing RGB lighting – supports software from major motherboard makers, fully customizable and programmable...', 200, 'ADATA XPG Spectrix D60G 16GB (2 x 8GB).jpg'),
('Samsung 970 EVO Plus 1TB', 149.99, 'Sequential Read/Write speeds up to 3,500/3,300 MB/s. An industry-leading 1.5M hours MTBF and up to 600 TBW for enhanced reliability...', 150, 'Samsung 970 EVO Plus 1TB.jpg'),
('Crucial P1 1TB', 119.99, 'Capacity: 1TB. Form Factor: M.2 (2280). Sequential Read/Write Speeds up to 2,000/1,750 MB/s...', 180, 'Crucial P1 1TB.jpg'),
('WD Blue SN550 1TB', 109.99, 'NVMe goes mainstream with a powerful, cost-effective storage solution that adds to the reliability of an SSD...', 200, 'WD Blue SN550 1TB.jpg'),
('Kingston A2000 1TB', 119.99, 'NVMe PCIe performance at a fraction of the cost. A2000 is an affordable solution with impressive read/write speeds...', 180, 'Kingston A2000 1TB.jpg'),
('Sabrent Rocket Q 1TB', 129.99, 'The NVMe PCIe Gen3x4 interface delivers exceptional performance with up to 3200MB/s seq. read and 2000MB/s seq. write speeds...', 160, 'Sabrent Rocket Q 1TB.jpg');


CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    delivery_address VARCHAR(255) NOT NULL,
    order_date DATE NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL
);


CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE cart_items ADD COLUMN client_id INT;


CREATE TABLE order_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    address VARCHAR(255),
    phone VARCHAR(20),
    date_ordered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_status VARCHAR(20),
    total DECIMAL(10, 2),
    payment_method VARCHAR(50),
    order_status VARCHAR(50),
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



