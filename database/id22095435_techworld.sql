-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2024 at 07:31 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22095435_techworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_Id` int(11) NOT NULL,
  `User_Name` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_Id`, `User_Name`, `Email`, `Password`) VALUES
(1, 'Kishan Kareliya', 'kareliyakishan007@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `Brand_Id` int(11) NOT NULL,
  `Brand_Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`Brand_Id`, `Brand_Name`) VALUES
(2, 'iPhone'),
(3, 'Samsung'),
(4, 'OnePlus'),
(5, 'oppo'),
(6, 'Sony'),
(7, 'JBL'),
(8, 'Fitbit'),
(9, 'Realme'),
(10, 'Lenovo'),
(11, 'Noise'),
(12, 'LG'),
(13, 'Xiaomi');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_id` int(11) NOT NULL,
  `Product_Id` int(11) NOT NULL,
  `Customer_Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` float NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart_id`, `Product_Id`, `Customer_Id`, `Quantity`, `Price`, `DateTime`) VALUES
(12, 3, 1, 2, 80990, '2024-05-08 03:34:52'),
(21, 8, 2, 1, 2999, '2024-05-08 07:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_Id` int(11) NOT NULL,
  `Category_Name` varchar(45) NOT NULL,
  `Category_Image` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_Id`, `Category_Name`, `Category_Image`) VALUES
(3, 'Smartphones', 'category_img_6639cd5dc5dba.jpg'),
(4, 'iPads & Tablets', 'category_img_6639cd7ecabd3.jpg'),
(5, 'Audio Devices', 'category_img_6639cd959f7be.jpg'),
(6, 'Wearables', 'category_img_6639cdad3a07e.jpg'),
(7, 'Accessories', 'category_img_6639cdc7b985d.jpg'),
(8, 'Soundbars', 'category_img_6639cdd3e703a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contacts_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contacts_id`, `name`, `email`, `mobile`, `subject`, `message`) VALUES
(1, 'Bhavesh', 'Bhaveshpanchal123@gmail.com', '123456789', 'Testing', 'Testing the contact us form'),
(2, 'Try', 'Try@gmail.com', '123456789', 'Trial test on mobile', 'This is trial test'),
(3, 'Try', 'Try@gmail.com', '123456789', 'Trial test on mobile', 'This is trial test'),
(4, 'Try', 'Try@gmail.com', '123456789', 'Trial test on mobile', 'This is trial test'),
(5, 'Try', 'Try@gmail.com', '123456789', 'Trial test on mobile', 'This is trial test');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_Id` int(11) NOT NULL,
  `First_Name` varchar(45) NOT NULL,
  `Last_Name` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Mobile_No` varchar(45) NOT NULL,
  `Gender` tinyint(4) NOT NULL,
  `Address` varchar(65) NOT NULL,
  `PostCode` varchar(6) NOT NULL,
  `City` varchar(45) NOT NULL,
  `State` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_Id`, `First_Name`, `Last_Name`, `Email`, `Password`, `Mobile_No`, `Gender`, `Address`, `PostCode`, `City`, `State`) VALUES
(1, 'kishan', 'Kareliya', 'kareliyakishan007@gmail.com', '1234', '8160273697', 1, 'B-28, jagdish park society, viratnagar road, ahmedabadd.', '382350', 'AHMADABAD', 'GUJARAT'),
(2, 'Rahul', 'Ahir', 'rahulahir0116@gmail.com', '1234', '9979974088', 1, 'Trial address', '382350', 'AHMADABAD', 'GUJARAT');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_person`
--

CREATE TABLE `delivery_person` (
  `Delivery_Person_Id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `License_Number` varchar(45) NOT NULL,
  `Gender` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_person`
--

INSERT INTO `delivery_person` (`Delivery_Person_Id`, `Name`, `Email`, `Password`, `License_Number`, `Gender`) VALUES
(1, 'Rahul', 'rahul@gmail.com', 'test', 'GJ01 20245678981', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `Id` int(11) NOT NULL,
  `Order_Id` int(11) NOT NULL,
  `Product_Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`Id`, `Order_Id`, `Product_Id`, `Quantity`, `Price`) VALUES
(1, 2, 4, 1, 1200),
(2, 3, 4, 1, 1200),
(3, 4, 4, 1, 1200),
(4, 5, 2, 1, 20999),
(5, 6, 3, 1, 80990),
(6, 7, 2, 1, 20999),
(7, 7, 3, 1, 80990),
(8, 7, 4, 1, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Id` int(11) NOT NULL,
  `Payment_Id` varchar(45) NOT NULL,
  `Payment_Status` varchar(45) NOT NULL,
  `Transaction_Id` varchar(200) NOT NULL,
  `Payment_Date` date NOT NULL DEFAULT current_timestamp(),
  `Total_Amount` float NOT NULL,
  `Customer_Id` int(11) NOT NULL,
  `Order_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Id`, `Payment_Id`, `Payment_Status`, `Transaction_Id`, `Payment_Date`, `Total_Amount`, `Customer_Id`, `Order_Id`) VALUES
(1, 'MT588778004', 'pending', '', '2024-05-07', 0, 1, 1),
(2, 'MT327841435', 'pending', '', '2024-05-07', 0, 1, 1),
(3, 'MT484631293', 'pending', '', '2024-05-07', 0, 1, 1),
(4, 'MT517816966', 'pending', '', '2024-05-07', 0, 1, 1),
(5, 'MT685678927', 'pending', '', '2024-05-07', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_Id` int(11) NOT NULL,
  `Product_Name` varchar(45) NOT NULL,
  `Price` float NOT NULL,
  `Mrp` float NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Brand_Id` int(11) NOT NULL,
  `Category_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_Id`, `Product_Name`, `Price`, `Mrp`, `Quantity`, `Description`, `Brand_Id`, `Category_Id`) VALUES
(2, 'Realme NARZO 70', 20999, 16999, 13, '45W SUPERVOOC Charge provide Charging up to 50% in 27 mins. 5000mAh Massive Battery provide upto Standby 518 hours or Youtube Video 17hours;\r\nDimensity 7050 5G, Support Dual Carrier Aggregation Technology,Smart switch between 4G/5G networks according to your usage scenarios, saving up to 30% power consumption;\r\nVapor Chamber Cooling System,The heat dissipation area is large and the heat dissipation efficiency is significantly enhanced, bringing a more stable performance;\r\n120Hz AMOLED Display,Screen-to-body ratio: 92.65%, Brightness: Maximum 1200 nits, Supports touch input even with wet hands. Rainwater Touch & IP54 Water Resistance\r\n50MP Primary Camera, Provide Night Mode,Street Mode,Photograph mode,Portrait Mode,Adapts to a wider range of photographic scenarios;', 9, 3),
(3, 'Apple iPad Pro', 80990, 75990, 10, 'WHY IPAD PRO — iPad Pro is the ultimate iPad experience, with the astonishing performance of the M2 chip, superfast wireless connectivity and next-generation Apple Pencil experience. Plus powerful productivity features in iPadOS.\r\niPadOS + APPS — iPadOS makes iPad more productive, intuitive and versatile. With iPadOS, run multiple apps at once, use Apple Pencil to write in any text field with Scribble, and edit and share photos. Stage Manager makes multitasking easy with resizable, overlapping apps and external display support. iPad Pro comes with essential apps like Safari, Messages and Keynote, with over a million more apps available on the App Store.', 2, 4),
(4, 'Noise Watch', 1200, 999, 13, '1.81 inches(4.59cms) TFT display, 240*280px, Always on display - No, 550 nits brightness - Enjoy clear and vibrant visuals on its big and bright TFT display.\r\nUp to 7-day battery life - Get up to 7 days of battery life & up to 2 days of power with calling activated. (Battery life can vary due to multiple factors such as turning on continuous HR tracking or turning up the brightness)\r\nCharging - The smartwatch features a 260mAh battery that takes approx. 2.5 hours to fully charge. It is recommended that you use a 5W power adapter. Please avoid using a fast-charging adapter to prevent future watch damage.', 11, 6),
(5, 'Apple iPhone 15 Pro ', 134900, 127900, 12, 'FORGED IN TITANIUM — iPhone 15 Pro has a strong and light aerospace-grade titanium design with a textured matte-glass back. It also features a Ceramic Shield front that’s tougher than any smartphone glass. And it’s splash, water, and dust resistant.\r\nADVANCED DISPLAY — The 6.1” Super Retina XDR display with ProMotion ramps up refresh rates to 120Hz when you need exceptional graphics performance. Dynamic Island bubbles up alerts and Live Notifications. Plus, with Always-On display, your Lock Screen stays glanceable, so you don’t have to tap it to stay in the know.\r\nGAME-CHANGING A17 PRO CHIP — A Pro-class GPU makes mobile games feel so immersive, with rich environments and realistic characters. A17 Pro is also incredibly efficient and helps to deliver amazing all-day battery life.', 2, 3),
(6, 'Samsung Galaxy S24 Ultra', 129999, 134000, 15, 'Meet Galaxy S24 Ultra, the ultimate form of Galaxy Ultra with a new titanium exterior and a 17.25cm (6.8\") flat display. It\'s an absolute marvel of design.\r\nThe legacy of Galaxy Note is alive and well. Write, tap and navigate with precision your fingers wish they had on the new, flat display.\r\nWith the most megapixels on a smartphone and AI processing, Galaxy S24 Ultra sets the industry standard for image quality every time you hit the shutter. What\'s more, the new ProVisual engine recognizes objects — improving colour tone, reducing noise and bringing out detail.', 3, 3),
(7, 'OnePlus Buds 3', 5499, 6599, 25, '[Best-in-class Sound Quality]: 10.4mm+6mm dynamic dual driver, LHDC5.0 Bluetooth CODEC and high resolution certification makes the product best in its sound quality with deeper bass, delicate treble and clear vocals; [Sliding Volume Control]: Slide on the surface of touch area of buds to adjust the volume.Sliding up increases the volume, while sliding down decreases the volume\r\n[49dB Adaptive Nosie Cancellation]: Advanced noise-cancelling technology,coupled with a high-performance chip,elevates the depth of noise cancellation upto 49dB.This reduces noise and blocks out chaos and allows users to enjoy music immersively', 4, 5),
(8, 'OPPO Enco Air 2 Pro', 2999, 3999, 22, 'Refractive bubble case\r\n12.4 mm titanized diaphragm driver\r\nActive noise cancellation\r\nAI noise cancellation for calls\r\nUp to 28 hours of listening time', 5, 5),
(9, 'Samsung Galaxy Tab S9', 47999, 52999, 12, 'Outstanding vividness with 27.69 cm (10.9”) display, 90 Hz Refresh Rate, 2304 x 1440 (WQXGA, 249 PPI)\r\nPowerful Performance with Exynos 1380 chip\r\n8 MP Rear Camera, 12 MP Ultra wide Front camera, Dual Speakers by AKG\r\n8000 mAh Battery, Dual Sim pSIM + eSIM\r\nWeatherproof & DurableTablet and S Pen with IP68', 3, 4),
(10, 'JBL Cinema SB271', 10998, 12999, 5, 'Free Installation, Replacement & On-Site Repair within 24 hours ( in Select cities).T&C Apply;220W SOUNDBAR WITH WIRELESS SUBWOOFER: JBL Cinema SB271 delivers a massive 220 Watt of powerful sound from two full range drivers. The wireless subwoofer delivers deep and thumping bass and a clutter-free experience\r\nDOLBY DIGITAL AUDIO: Bring the theater to your home with 2.1 Channel Dolby Digital audio improving the immersive feeling in the world of movies and music;FLEXIBILITY OF WIRELESS MUSIC STREAMING & CABLE CONNECTION: Stream music from your Mobile or Tablet via Bluetooth Connectivity. HDMI ARC & Optical connection allows a versatile setup options providing an ease to user accessibility\r\nDEDICATED SOUND MODE TO ENHANCE VOICE CLARITY: Just press the Voice button on the remote control to enhance voice clarity, which brings dialogues to the front, allowing your favorite voices to stand out against background noise', 7, 8),
(11, 'MI Power Bank 3i ', 1899, 2200, 25, '20000mAh Lithium Polymer battery\r\n18W Fast Charging\r\nTriple port output\r\nDual input port (Micro-USB/USB-C, Charging Time : 6.9 hours\r\nPower Delivery\r\nAdvanced 12 Layer chip protection\r\nSmart power management\r\n6 months domestic warranty', 13, 7),
(12, 'Apple Magic Mouse', 7299, 8599, 15, 'Magic Mouse is wireless and rechargeable, with an optimised foot design that lets it glide smoothly across your desk\r\nThe Multi-Touch surface allows you to perform simple gestures such as swiping between web pages and scrolling through documents.\r\nThe incredibly long-lasting internal battery will power your Magic Mouse for about a month or more between charges\r\nIt’s ready to go straight out of the box and pairs automatically with your Mac, and it includes a woven USB-C to Lightning Cable that lets you pair and charge by connecting to a USB-C port on your Mac.', 2, 7),
(13, 'Sony Headphone', 3989, 4299, 15, 'With up to 50-hour battery life and quick charging, you ll have enough power for multi-day road trips and long festival weekends.;Great sound quality customizable to your music preference with EQ Custom on the Sony | Headphones Connect App.\r\nBoost the quality of compressed music files and enjoy streaming music with high quality sound through DSEE.;Designed to be lightweight and comfortable for all-day use.\r\nCrystal clear hands-free calling with built-in mic.\r\nMultipoint connection allows you to quickly switch between two devices at once.; Find your headphones easily with Fast Pair\r\nModel: Whch520/B', 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

CREATE TABLE `product_features` (
  `Product_Features_Id` int(11) NOT NULL,
  `Product_Features_Name` varchar(45) NOT NULL,
  `Category_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`Product_Features_Id`, `Product_Features_Name`, `Category_Id`) VALUES
(1, 'Model', 3),
(2, 'Operating System', 3),
(3, 'Screen Size', 3),
(4, 'Storage Capacity', 3),
(5, 'RAM', 3),
(6, 'Camera', 3),
(7, 'Processor', 3),
(8, '5G support', 3),
(9, 'Model', 4),
(10, 'Keyboard Compatibility', 4),
(11, 'Apple Pencil Support', 4),
(12, 'Screen Size', 4),
(13, 'Storage Capacity', 4),
(14, 'RAM', 4),
(15, 'Connectivity', 4),
(16, 'Type', 5),
(17, 'Model', 5),
(18, 'Connectivity', 5),
(19, 'Battery Life', 5),
(20, 'Noise Cancelling', 5),
(21, 'With Mic', 5),
(22, 'Type', 6),
(23, 'Model', 6),
(24, 'Heart rate monitor', 6),
(25, 'GPS', 6),
(26, 'Battery Life', 6),
(27, 'Type', 7),
(28, 'Compatibility', 7),
(29, 'Material', 7),
(30, 'Features', 7),
(31, 'Connectivity Technology', 8),
(32, 'Special Feature', 8);

-- --------------------------------------------------------

--
-- Table structure for table `product_has_product_features`
--

CREATE TABLE `product_has_product_features` (
  `Product_Id` int(11) NOT NULL,
  `Product_Features_Id` int(11) NOT NULL,
  `Features_Value` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_has_product_features`
--

INSERT INTO `product_has_product_features` (`Product_Id`, `Product_Features_Id`, `Features_Value`) VALUES
(2, 1, 'realme narzo 70 5G'),
(2, 2, 'Android 14'),
(2, 3, '17.07 cm (6.72 inch) Full HD+ Display'),
(2, 4, '512gb'),
(2, 5, '6 GB'),
(2, 6, '50MP + 2MP | 8MP Front Camera'),
(2, 7, 'Dimensity 6100+ Processor'),
(2, 8, 'YES'),
(3, 9, 'iPad Pro'),
(3, 10, 'YES'),
(3, 11, 'YES'),
(3, 12, '11 Inches'),
(3, 13, '256 GB'),
(3, 14, '8 GB'),
(3, 15, '5G + WIFI'),
(4, 22, 'Smart Watch'),
(4, 23, 'ColorFit Quad Call'),
(4, 24, 'YES'),
(4, 25, 'YES'),
(4, 26, 'Up to 7-day battery life '),
(5, 1, 'iPhone 15 Pro'),
(5, 2, ' iOS'),
(5, 3, '6.1” Super Retina XDR display'),
(5, 4, '128gb'),
(5, 5, ' 8 GB'),
(6, 1, 'Samsung Galaxy S24 Ultra 5G'),
(6, 2, 'Android 14.0'),
(6, 3, '17.25cm (6.8\") flat display'),
(6, 4, '256 GB'),
(6, 5, ' 8 GB'),
(6, 6, '200 MP, f/1.7, 24mm (wide)'),
(7, 16, 'In Ear'),
(7, 17, 'Buds 3'),
(7, 18, 'Wireless'),
(8, 16, 'In Ear'),
(8, 17, 'OPPO Enco Air 2 Pro'),
(8, 18, 'Wireless'),
(8, 19, 'Up to 28 hours of listening time'),
(8, 20, 'YES'),
(8, 21, 'YES'),
(9, 9, 'Galaxy Tab S9 FE'),
(9, 10, 'YES'),
(9, 11, 'NO'),
(9, 12, '27.69 Centimetres'),
(9, 13, '256 GB'),
(9, 14, '4 GB'),
(9, 15, '5G + WIFI'),
(10, 31, 'Bluetooth, Optical, HDMI'),
(10, 32, 'Subwoofer, Remote Control, Bass Boost'),
(11, 27, 'Power Bank'),
(11, 28, 'USB, Micro USB'),
(11, 29, 'Advanced 12 Layer chip protection'),
(11, 30, 'Short Circuit Protection, Fast Charging'),
(12, 27, 'Apple Mouse'),
(13, 16, 'Headphone'),
(13, 17, 'WH-CH520'),
(13, 18, 'Wireless + Wired'),
(13, 19, 'up to 50-hour battery life'),
(13, 20, 'NO'),
(13, 21, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `Product_Image_Id` int(11) NOT NULL,
  `Product_Image_Path` varchar(45) NOT NULL,
  `Product_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`Product_Image_Id`, `Product_Image_Path`, `Product_Id`) VALUES
(5, '1_img_6639f0942eabe.jpg', 2),
(6, '2_img_6639f0942eac2.jpg', 2),
(7, '3_img_6639f0942eac3.jpg', 2),
(8, '4_img_6639f0942eac4.jpg', 2),
(9, '1_img_6639f2317757f.jpg', 3),
(10, '2_img_6639f23177582.jpg', 3),
(11, '3_img_6639f23177583.jpg', 3),
(12, '4_img_6639f23177584.jpg', 3),
(13, '1_img_6639f431958a8.jpg', 4),
(14, '2_img_6639f431958ac.jpg', 4),
(15, '3_img_6639f431958ad.jpg', 4),
(16, '4_img_6639f431958ae.jpg', 4),
(17, '1_img_663b1d9663718.jpg', 5),
(18, '2_img_663b1d966371d.jpg', 5),
(19, '3_img_663b1d966371e.jpg', 5),
(20, '4_img_663b1d966371f.jpg', 5),
(21, '1_img_663b1ea3005c9.jpg', 6),
(22, '2_img_663b1ea3005cd.jpg', 6),
(23, '3_img_663b1ea3005ce.jpg', 6),
(24, '4_img_663b1ea3005cf.jpg', 6),
(25, '1_img_663b20259e3f1.jpg', 7),
(26, '2_img_663b20259e3f5.jpg', 7),
(27, '3_img_663b20259e3f6.jpg', 7),
(28, '4_img_663b20259e3f7.jpg', 7),
(29, '1_img_663b21325db65.jpg', 8),
(30, '2_img_663b21325db68.jpg', 8),
(31, '3_img_663b21325db69.jpg', 8),
(32, '4_img_663b21325db6a.jpg', 8),
(33, '1_img_663b22056136a.jpg', 9),
(34, '2_img_663b22056136e.jpg', 9),
(35, '3_img_663b22056136f.jpg', 9),
(36, '4_img_663b220561370.jpg', 9),
(37, '1_img_663b231f9f7db.jpg', 10),
(38, '2_img_663b231f9f7e2.jpg', 10),
(39, '3_img_663b231f9f7e3.jpg', 10),
(40, '4_img_663b231f9f7e4.jpg', 10),
(41, '1_img_663b2519c3765.jpg', 11),
(42, '2_img_663b2519c3768.jpg', 11),
(43, '3_img_663b2519c3769.jpg', 11),
(44, '4_img_663b2519c376a.jpg', 11),
(45, '1_img_663b2669988ad.jpg', 12),
(46, '2_img_663b2669988b0.jpg', 12),
(47, '3_img_663b2669988b1.jpg', 12),
(48, '4_img_663b2669988b2.jpg', 12),
(49, '1_img_663b2774344b7.jpg', 13),
(50, '2_img_663b2774344bc.jpg', 13),
(51, '3_img_663b2774344bd.jpg', 13),
(52, '4_img_663b2774344be.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `Order_Id` int(11) NOT NULL,
  `Order_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Total_Amount` float NOT NULL,
  `CGST` float NOT NULL,
  `SGST` float NOT NULL,
  `Delivery_Status` varchar(45) NOT NULL,
  `Customer_Id` int(11) NOT NULL,
  `Delivery_Person_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`Order_Id`, `Order_Date`, `Total_Amount`, `CGST`, `SGST`, `Delivery_Status`, `Customer_Id`, `Delivery_Person_Id`) VALUES
(2, '2024-05-07 16:35:05', 1200, 92, 92, 'Pending', 1, 0),
(3, '2024-05-07 16:36:47', 1200, 92, 92, 'Pending', 1, 0),
(4, '2024-05-07 16:37:29', 1200, 92, 92, 'Pending', 1, 0),
(5, '2024-05-07 16:42:08', 20999, 1602, 1602, 'Delivered', 1, 1),
(6, '2024-05-08 04:21:50', 80990, 6177, 6177, 'Pending', 2, 0),
(7, '2024-05-08 04:36:32', 103189, 7870, 7870, 'Pending', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `Wishlist_Id` int(11) NOT NULL,
  `Product_Id` int(11) NOT NULL,
  `Customer_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`Wishlist_Id`, `Product_Id`, `Customer_Id`) VALUES
(1, 3, 1),
(2, 4, 1),
(3, 2, 2),
(4, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`Brand_Id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_Id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contacts_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_Id`);

--
-- Indexes for table `delivery_person`
--
ALTER TABLE `delivery_person`
  ADD PRIMARY KEY (`Delivery_Person_Id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_Id`);

--
-- Indexes for table `product_features`
--
ALTER TABLE `product_features`
  ADD PRIMARY KEY (`Product_Features_Id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`Product_Image_Id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`Order_Id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`Wishlist_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `Brand_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contacts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_person`
--
ALTER TABLE `delivery_person`
  MODIFY `Delivery_Person_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_features`
--
ALTER TABLE `product_features`
  MODIFY `Product_Features_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `Product_Image_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `Order_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `Wishlist_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
