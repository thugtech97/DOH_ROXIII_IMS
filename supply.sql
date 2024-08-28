-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 27, 2024 at 02:03 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supply`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int NOT NULL,
  `company_title` varchar(200) NOT NULL,
  `supporting_title` varchar(200) NOT NULL,
  `entity_name` varchar(100) NOT NULL,
  `company_head` varchar(150) NOT NULL,
  `company_logo` varchar(100) NOT NULL,
  `property_custodian` varchar(150) NOT NULL,
  `division_chief` varchar(150) NOT NULL,
  `ppe_prepared_by` varchar(150) NOT NULL,
  `ppe_noted_by` varchar(150) NOT NULL,
  `wi_prepared_by` varchar(150) NOT NULL,
  `wi_reviewed_by` varchar(150) NOT NULL,
  `wi_noted_by` varchar(150) NOT NULL,
  `wi_approved_by` varchar(150) NOT NULL,
  `rpci_prepared_by` varchar(150) NOT NULL,
  `rpci_certified_correct` varchar(150) NOT NULL,
  `rpci_noted_by` varchar(150) NOT NULL,
  `rpci_approved_by` varchar(150) NOT NULL,
  `rpci_coa` varchar(150) NOT NULL,
  `rpci_coa_designation` varchar(150) NOT NULL,
  `warehouse_name` varchar(220) NOT NULL,
  `warehouse_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `company_title`, `supporting_title`, `entity_name`, `company_head`, `company_logo`, `property_custodian`, `division_chief`, `ppe_prepared_by`, `ppe_noted_by`, `wi_prepared_by`, `wi_reviewed_by`, `wi_noted_by`, `wi_approved_by`, `rpci_prepared_by`, `rpci_certified_correct`, `rpci_noted_by`, `rpci_approved_by`, `rpci_coa`, `rpci_coa_designation`, `warehouse_name`, `warehouse_location`) VALUES
(1, '111', '11', '11', '159|Adrian Joseph P. Bautista', 'userfinal.png', '66|Eleanor D. Lakag, MSBA', '44|Aileen A. Sacol, CPA, MMPSM', '27|Gretchen J. Magaluna', '66|Eleanor D. Lakag, MSBA', '27|Gretchen J. Magaluna', '230|Eden T. Sagunday', '44|Aileen A. Sacol, CPA, MMPSM', 'null|', '27|Gretchen J. Magaluna', '66|Eleanor D. Lakag, MSBA', '44|Aileen A. Sacol, CPA, MMPSM', 'null|', 'Marah M. Mendoza', 'State Auditor IV', '323', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_area`
--

CREATE TABLE `ref_area` (
  `area_id` int NOT NULL,
  `area` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ref_area`
--

INSERT INTO `ref_area` (`area_id`, `area`, `status`) VALUES
(1, 'Regional Office', 0),
(2, 'PDOHO Agusan Del Norte', 0),
(3, 'PDOHO Agusan Del Sur', 0),
(4, 'PDOHO Surigao Del Norte', 0),
(5, 'PDOHO Surigao Del Sur', 0),
(6, 'PDOHO Dinagat Islands', 0),
(7, 'Buenavista, Agusan del Norte', 0),
(8, 'Carmen, Agusan del Norte', 0),
(9, 'Jabonga, Agusan del Norte', 0),
(10, 'Kitcharao, Agusan del Norte', 0),
(11, 'Cabadbaran, Agusan del Norte', 0),
(12, 'Las Nieves, Agusan del Norte', 0),
(13, 'Magallanes, Agusan del Norte', 0),
(14, 'Nasipit, Agusan del Norte', 0),
(15, 'Remedios T. Romualdez, Agusan del Norte', 0),
(16, 'Santiago, Agusan del Norte', 0),
(17, 'Tubay, Agusan del Norte', 0),
(18, 'Prosperidad, Agusan del Sur', 0),
(19, 'Bunawan, Agusan del Sur', 0),
(20, 'Esperanza, Agusan del Sur', 0),
(21, 'La Paz, Agusan del Sur', 0),
(22, 'Loreto, Agusan del Sur', 0),
(23, 'Rosario, Agusan del Sur', 0),
(24, 'San Francisco, Agusan del Sur', 0),
(25, 'San Luis, Agusan del Sur', 0),
(26, 'Santa Josefa, Agusan del Sur', 0),
(27, 'Sibagat, Agusan del Sur', 0),
(28, 'Talacogon, Agusan del Sur', 0),
(29, 'Trento, Agusan del Sur', 0),
(30, 'Veruela, Agusan del Sur', 0),
(31, 'Bayugan, Agusan del Sur', 0),
(32, 'Basilisa, Dinagat Islands', 0),
(33, 'Cagdianao, Dinagat Islands', 0),
(34, 'Dinagat, Dinagat Islands', 0),
(35, 'Libjo, Dinagat Islands', 0),
(36, 'Loreto, Dinagat Islands', 0),
(37, 'San Jose, Dinagat Islands', 0),
(38, 'Tubajon, Dinagat Islands', 0),
(39, 'Alegria, Surigao del Norte', 0),
(40, 'Bacuag, Surigao del Norte', 0),
(41, 'Burgos, Surigao del Norte', 0),
(42, 'Claver, Surigao del Norte', 0),
(43, 'Dapa, Surigao del Norte', 0),
(44, 'Del Carmen, Surigao del Norte', 0),
(45, 'General Luna, Surigao del Norte', 0),
(46, 'Gigaquit, Surigao del Norte', 0),
(47, 'Mainit, Surigao del Norte', 0),
(48, 'Malimono, Surigao del Norte', 0),
(49, 'Pilar, Surigao del Norte', 0),
(50, 'Placer, Surigao del Norte', 0),
(51, 'San Benito, Surigao del Norte', 0),
(52, 'San Francisco, Surigao del Norte', 0),
(53, 'San Isidro, Surigao del Norte', 0),
(54, 'Santa Monica, Surigao del Norte', 0),
(55, 'Sison, Surigao del Norte', 0),
(56, 'Socorro, Surigao del Norte', 0),
(57, 'Surigao City, Surigao del Norte', 0),
(58, 'Tagana-an, Surigao del Norte', 0),
(59, 'Tubod, Surigao del Norte', 0),
(60, 'Barobo, Surigao del Sur', 0),
(61, 'Bayabas, Surigao del Sur', 0),
(62, 'Cagwait, Surigao del Sur', 0),
(63, 'Cantilan, Surigao del Sur', 0),
(64, 'Carmen, Surigao del Sur', 0),
(65, 'Carrascal, Surigao del Sur', 0),
(66, 'Cortes, Surigao del Sur', 0),
(67, 'Hinatuan, Surigao del Sur', 0),
(68, 'Lanuza, Surigao del Sur', 0),
(69, 'Lianga, Surigao del Sur', 0),
(70, 'Lingig, Surigao del Sur', 0),
(71, 'Madrid, Surigao del Sur', 0),
(72, 'Marihatag, Surigao del Sur', 0),
(73, 'San Agustin, Surigao del Sur', 0),
(74, 'San Miguel, Surigao del Sur', 0),
(75, 'Tandag, Surigao del Sur', 0),
(76, 'Tagbina, Surigao del Sur', 0),
(77, 'Tago, Surigao del Sur', 0),
(78, 'Agusan Del Norte', 0),
(79, 'Agusan De Sur', 0),
(80, 'Surigao Del Norte', 0),
(81, 'Surigao Del Sur', 0),
(82, 'Province of Dinagat Islands', 0),
(83, 'Butuan City', 0),
(84, 'Bislig City', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_category`
--

CREATE TABLE `ref_category` (
  `category_id` int NOT NULL,
  `category` varchar(100) NOT NULL,
  `category_code` varchar(10) NOT NULL,
  `account_code` varchar(20) NOT NULL,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ref_category`
--

INSERT INTO `ref_category` (`category_id`, `category`, `category_code`, `account_code`, `status`) VALUES
(1, 'ICT Equipments', 'IT', '10605030', 0),
(2, 'Medical Equipment', 'MEQ', '10402090', 0),
(3, 'Furniture', 'FF', '10607010', 0),
(4, 'Library', 'LIB', '10607020', 0),
(5, 'Drugs and Medicines', 'DM', '10401010', 0),
(6, 'Medical Supplies', 'MS', '10402040', 0),
(7, 'Various Supplies', 'VS', '10402990', 0),
(8, 'Software Application', 'SWA', '10405030', 0),
(9, 'Office Supplies', 'OS', '10404010', 0),
(10, 'Communication Equipments', 'CE', '10605070', 0),
(11, 'Office Equipment', 'OE', '10605020', 0),
(12, 'Housekeeping Supplies', 'HS', '10402990', 0),
(13, 'Other Supplies', 'OTS', '10402990', 0),
(14, 'ICT Supplies', 'ICS', '10405030', 0),
(15, 'Property and Equipment for Distribution', 'PED', '10402090', 0),
(16, 'Motor Vehicle', '10606010 0', '', 0),
(17, 'Office Building', '10604010 0', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_caterer`
--

CREATE TABLE `ref_caterer` (
  `caterer_id` int NOT NULL,
  `caterer` varchar(100) NOT NULL,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_caterer`
--

INSERT INTO `ref_caterer` (`caterer_id`, `caterer`, `status`) VALUES
(1, 'LUCIANA CONVENTION CENTER', 0),
(2, 'LMX CONVENTION CENTER', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_item`
--

CREATE TABLE `ref_item` (
  `item_id` int NOT NULL,
  `item` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ref_item`
--

INSERT INTO `ref_item` (`item_id`, `item`, `category_id`, `status`) VALUES
(1, 'Laptop', 1, 0),
(2, 'Desktop Computer', 1, 0),
(3, 'UPS', 1, 0),
(4, 'CCTV', 1, 0),
(5, 'Printer with Continous Ink', 1, 0),
(6, 'Mouse', 1, 0),
(7, 'FLASH DRIVE', 1, 0),
(8, 'Portable Multimedia Trolly Speaker', 7, 0),
(9, 'Powerbank ', 1, 0),
(10, 'Usb Hub', 1, 0),
(11, 'HDMI Cable', 1, 0),
(12, 'Anti Virus', 8, 0),
(13, 'Printer', 1, 0),
(14, 'Pocket Wifi', 7, 0),
(15, 'External Hard Drive', 1, 0),
(16, 'Speaker', 7, 0),
(17, 'Webcam', 7, 0),
(18, 'UPS (Uninterruptable Power Supply)', 1, 0),
(19, 'AVR', 1, 0),
(20, 'Losartan 50mg tabs', 5, 0),
(21, 'Amlodipine 5mg tabs', 5, 0),
(22, 'LCD Monitor', 1, 0),
(23, 'System Unit', 1, 0),
(24, 'Ergonomic Chair', 3, 0),
(25, 'Ink', 9, 0),
(26, 'Cellphone', 10, 0),
(27, 'Television', 10, 0),
(28, 'Office Table', 3, 0),
(29, 'Clip Backfold', 9, 0),
(30, 'Data File Box', 9, 0),
(31, 'Clip Board', 9, 0),
(32, 'Clearbook', 9, 0),
(33, 'Folder Fancy', 9, 0),
(34, 'Clip Bulldog', 9, 0),
(35, 'Correction Tape', 9, 0),
(36, 'Detergent Powder', 12, 0),
(37, 'Corkboard', 9, 0),
(38, 'Folder Pressboard', 9, 0),
(39, 'Notepad Stick-on', 9, 0),
(40, 'Broomstick', 12, 0),
(41, 'Scouring Powder', 12, 0),
(42, 'Disinfectant Spray', 12, 0),
(43, 'Cotton Rag', 12, 0),
(44, 'Scouring Pad', 12, 0),
(45, 'Disinfectant Bleach', 12, 0),
(46, 'Nylon', 7, 0),
(47, 'Packaging Tape', 9, 0),
(48, 'Scotch Tape', 9, 0),
(49, 'Toner Cart', 9, 0),
(50, 'Ink Cartridge', 14, 0),
(51, 'Thermal Bag', 7, 0),
(52, 'Infant Warmer', 2, 0),
(53, 'Infusion Pump', 2, 0),
(54, 'Document Tray', 9, 0),
(55, 'Puncher', 9, 0),
(56, 'Tape Dispenser', 9, 0),
(57, 'Liquid Hand Soap', 12, 0),
(58, 'Disinfectant Solution', 12, 0),
(59, 'Distilled Water', 13, 0),
(60, 'Light Bulb', 7, 0),
(61, 'Laser Pointer', 1, 0),
(62, 'Microsoft Windows Professional', 8, 0),
(63, 'LED Monitor', 1, 0),
(64, 'USB', 1, 0),
(65, 'Suction Machine', 2, 0),
(66, 'ENT Diagnostic Set', 2, 0),
(67, 'ENT Operating Microscope', 2, 0),
(68, 'Microscope Binocular', 2, 0),
(69, 'Opthalmic Operating Microscope', 2, 0),
(70, 'Wall-Mounted Diagnostic Set', 2, 0),
(71, 'Poster', 13, 0),
(72, 'Portable Drive', 1, 0),
(73, 'Bondpaper', 9, 0),
(74, 'Binder Clip', 9, 0),
(75, 'Sharpener', 9, 0),
(76, 'Photopaper', 9, 0),
(77, 'Signpen', 9, 0),
(78, 'Colored Paper', 9, 0),
(79, 'Pencil', 9, 0),
(80, 'Shirt', 13, 0),
(81, 'Tent', 13, 0),
(82, 'Battery', 9, 0),
(83, 'Envelope', 9, 0),
(84, 'Gloves', 6, 0),
(85, 'Core Switch', 1, 0),
(86, 'HDD', 1, 0),
(87, 'SSD', 1, 0),
(88, 'Ethernet Connector', 14, 0),
(89, 'DIGITAL MEDIA CAMPAIGN', 13, 0),
(90, 'Sea Ambulance', 15, 0),
(91, 'Brown Envelope', 7, 0),
(92, 'Recordbox', 7, 0),
(93, 'Adaptor', 1, 0),
(94, 'Network Wire Tracer', 1, 0),
(95, 'UPS BATTERY', 1, 0),
(103, 'Syringe', 6, 0),
(104, 'Router', 14, 0),
(105, 'USB RJ45 Connector', 14, 0),
(106, 'Headphone', 1, 0),
(107, 'VTM (Virus Specimen Collection Tube)', 6, 0),
(108, 'Progesterone Subdermal Implant', 6, 0),
(109, 'Face Biometric with System and Holder', 1, 0),
(110, 'Face Shield', 6, 0),
(111, 'Disc Pad', 13, 0),
(112, 'Isoprophyl Alcohol', 6, 0),
(113, 'Glass Slides ', 6, 0),
(114, 'Face Mask, disposable ', 6, 0),
(115, 'Netbook', 1, 0),
(116, 'Scanner', 1, 0),
(117, 'BCG Vaccine 20dose w/ diluent', 5, 0),
(118, 'Bivalent Oral Poliomyelites Vaccine (bOPV) ', 5, 0),
(119, 'DTwP-HepB-Hib (PENTA) 1dose', 5, 0),
(120, 'Hepa B Vaccine, 10dose ', 5, 0),
(121, 'Imovax Polio Vaccine (IPV) 10dose', 5, 0),
(122, 'Pneumococcal Conjugate Vaccine (PCV13) 1dose', 5, 0),
(123, 'Pneumococcal Vaccine 1dose (Pneumovax23)', 5, 0),
(124, 'Measles and Rubella Vaccine (MR) 10dose', 5, 0),
(125, 'Measles, Mumps & Rubella Vaccine (MMR) 5dose', 5, 0),
(126, 'Tetanus and Diphteria Vaccine (TD) 10dose', 5, 0),
(127, 'Tetanus Toxoid 0.5ml ', 5, 0),
(128, 'Tetanus Immunoglobulin (Human) 250IU, 1ml (Tetagam)', 5, 0),
(129, 'Influenza (Flu) Vaccine 10dose', 5, 0),
(130, 'Anti Venom', 5, 0),
(131, 'Anti Rabies Serum Vaccine 1dose', 5, 0),
(132, 'Network Attached Storage (NAS)', 1, 0),
(133, 'DVD-RW Burner', 1, 0),
(134, 'OHM Multi Tester', 1, 0),
(135, 'Ethernet Cable Extender Coupler', 1, 0),
(136, 'Cloth Mask', 6, 0),
(137, 'HIV Drugs', 5, 0),
(138, 'Ascorbic', 5, 0),
(139, 'Albendazole', 5, 0),
(140, 'Insulin', 5, 0),
(141, 'Insulin Syringe', 6, 0),
(142, 'Regular Insulin', 5, 0),
(143, 'Isophane Insulin', 5, 0),
(144, 'Biphasic Isophane Human Insulin', 5, 0),
(145, 'Insulin Syringe', 5, 0),
(146, 'Rotor Disc', 13, 0),
(147, 'Digital Voice Recorder', 1, 0),
(148, 'Purified Chick Embryo Cell Vaccine', 5, 0),
(149, 'Purified Vero Cell Rabies Vaccine w/ diluent', 5, 0),
(150, 'Purified Vero Cell Rabies Vaccine w/ diluent', 5, 0),
(151, 'Digital Blood Pressure', 6, 0),
(152, 'Digital Blood Pressure', 6, 0),
(153, 'Digital Blood Pressure', 6, 0),
(154, 'Digital Blood Pressure', 6, 0),
(155, 'Digital Blood Pressure', 6, 0),
(156, 'Digital Blood Pressure', 6, 0),
(157, 'Digital Blood Pressure', 6, 0),
(158, 'Switch Hub', 1, 0),
(159, 'Extension Wire', 13, 0),
(160, 'UTP Cable', 14, 0),
(161, 'Purified Protein Derivatives (PPD)', 5, 0),
(162, 'Efavirenz 600mg tabs', 5, 0),
(163, 'Lamivudine 300mg+Tenofovir 300mg+Efavirenz 600mg', 5, 0),
(164, 'Lamivudine 300mg+Tenofovir 300mg', 5, 0),
(165, 'Lamivudine 150mg tabs', 5, 0),
(166, 'Lamivudine 150mg+Zidovudine 300mg tabs', 5, 0),
(167, 'Lopinavir 200mg+Ritonavir 50mg', 5, 0),
(168, 'Nevirapine 200mg tabs', 5, 0),
(169, 'Nevirapine 200mg tabs', 5, 0),
(170, 'Nevirapine 10mg/ml oral solution', 5, 0),
(171, 'Tenofovir 300mg+Lamivudine 300mg+Dolutegravir 50mg (TLD)', 5, 0),
(172, 'SD Card', 14, 0),
(173, 'DDR3 Memory RAM', 1, 0),
(174, 'Albendazole 400mg tabs', 5, 0),
(175, 'Aluminum Magnesium 200mg/100mg 5ml susp. 60ml', 5, 0),
(176, 'Aluminum Magnesium 200mg/100mg 100\'s', 5, 0),
(177, 'Amlodipine 10mg tabs 100\'s', 5, 0),
(178, 'Amoxicillin 100mg/ml drops 15ml', 5, 0),
(179, 'Amoxicillin 250mg susp. 60ml', 5, 0),
(180, 'Amoxicillin 500mg capsule', 5, 0),
(181, 'Amoxicillin 500mg caps 100\'s', 5, 0),
(182, 'Amoxicillin 500mg caps 100/box', 5, 0),
(183, 'Atenolol 100mg', 5, 0),
(184, 'Aquatabs 33mg tabs', 5, 0),
(185, 'Ascorbic Acid 100mg/ml drops 15ml', 5, 0),
(186, 'Keyboard', 1, 0),
(187, 'Mouse Pad', 14, 0),
(188, 'Asdcorbic Acid 100mg/5ml syrup 60ml', 5, 0),
(189, 'Ascorbic Acid 100mg/ml syrup 120ml', 5, 0),
(190, 'Ascorbic Acid 500mg tabs', 5, 0),
(191, 'Artemether Lumefantrine 24\'s', 5, 0),
(192, 'Azithromycin 500mg tabs', 5, 0),
(193, 'Calcium Carbonate tabs 100\'s', 5, 0),
(194, 'Cefalexin 100mg/ml drops 10ml', 5, 0),
(195, 'Cefalexin 250mg/5ml susp. 60ml', 5, 0),
(196, 'Cefalexin 500mg caps 100\'s', 5, 0),
(197, 'Cefexime 400mg capsule', 5, 0),
(198, 'Job Order', 1, 0),
(199, 'Cetirizine 10mg tabs 100\'s', 5, 0),
(200, 'Cetirizine 10mg/ml drops 10ml', 5, 0),
(201, 'Cetirizine 5mg/5ml syrup 60ml', 5, 0),
(202, 'Chlorphenamine Maleate 4mg tabs', 5, 0),
(203, 'Chloroquine Phosphate 250mg', 5, 0),
(204, 'Ciprofloxacin 500mg tabs', 5, 0),
(205, 'Ciprofloxacin 500mg tabs', 5, 0),
(206, 'Cloxacillin 250mg/5ml susp. 60ml', 5, 0),
(207, 'Cotrimoxazole 400mg/80mg susp. 60ml', 5, 0),
(208, 'Cotrimoxazole 400mg/80mg susp. 60ml', 5, 0),
(209, 'Co-Amoxiclav 250mg/62.5mg susp. 60ml', 5, 0),
(210, 'Co-Amoxiclav 228.5mg/5ml susp. 70ml', 5, 0),
(211, 'Co-Amoxiclav 625mg tabs ', 5, 0),
(212, 'D5 LR 1liter', 5, 0),
(213, 'Doxycycline 100mg tabs', 5, 0),
(214, 'Doxycycline 100mg caps ', 5, 0),
(215, 'Dicycloverine 10mg tabs 100\'s', 5, 0),
(216, 'Clonidine 72mcg tabs', 5, 0),
(217, 'Diphenhydramine 25mg caps 100\'s', 5, 0),
(218, 'Diloxanide 50mg', 5, 0),
(219, 'Diethylcarbamazine 50mg', 5, 0),
(220, 'Epinephrine Hydrochloride 1mg/ml', 5, 0),
(221, 'Ethambutol 400mg tabs', 5, 0),
(222, 'Microphone', 1, 0),
(223, 'Headset', 1, 0),
(224, 'Tablet', 1, 0),
(225, 'Femme Pills 150mcg/30mcg 28\'s', 5, 0),
(226, 'Ferrous Sulfate+Folic Acid 200mg/400mcg tabs', 5, 0),
(227, 'Ferrous Sulfate 325mg tabs 100\'s', 5, 0),
(228, 'Ferrous Sulfate 30mg/5ml syrup 60ml', 5, 0),
(229, 'Ferrous Sulfate 30mg/5ml syrup 60ml', 5, 0),
(230, 'Fluticazone+Salmeterol 125mg+25mcg', 5, 0),
(231, 'Fluticasone+Salmeterol 125mg+25mcg', 5, 0),
(232, 'Fluticasone+Salmeterol 250mg+25mcg', 5, 0),
(233, 'Hydroxychloroquine 200mg', 5, 0),
(234, 'Hyoscine N-Butylbromide 10mg tabs', 5, 0),
(235, 'Ibuprofen 200mg tabs 100\'s', 5, 0),
(236, 'Ibuprofen 200mg/5ml susp. 60ml', 5, 0),
(237, 'Isoniazid 200mg/5ml 120ml', 5, 0),
(238, 'Lagundi 600mg tabs 100\'s', 5, 0),
(239, 'Lagundi 300mg/5ml syrup', 5, 0),
(240, 'Lidocaine 20mg/ml 2% 50ml', 5, 0),
(241, 'Loratadine 5mg/5ml syrup 30ml', 5, 0),
(242, 'Losartan 50mg tabs', 5, 0),
(243, 'Losartan 50mg tabs', 5, 0),
(244, 'Losartan+Hydrochlorothiazide 50mg/12.5mg', 5, 0),
(245, 'Losartan 100mg tabs 100\'s', 5, 0),
(246, 'Lynestrenol Progesteron Only Pills (Daphne 500mcg)', 5, 0),
(247, 'Magnesium Sulfate 250mg/ml ', 5, 0),
(248, 'Mebendazole 100mg/5ml susp. 60ml', 5, 0),
(249, 'Mefenamic Acid 500mg caps', 5, 0),
(250, 'Mefenamic Acid 250mg caps', 5, 0),
(251, 'Metformin 500mg tabs', 5, 0),
(252, 'Metoprolol 100mg tabs 100\'s', 5, 0),
(253, 'Metoprolol 50mg tabs 100\'s', 5, 0),
(254, 'Metronidazole 500mg/100ml ', 5, 0),
(255, 'Metronidazole 500mg tabs', 5, 0),
(256, 'Metronidazole 125mg/5ml susp. 60ml', 5, 0),
(257, 'Multivitamins drops 15ml', 5, 0),
(258, 'Multivitamins syrup 60ml', 5, 0),
(259, 'Multivitamins syrup 120ml', 5, 0),
(260, 'Multivitamins w/ Iron capsule 100\'s', 5, 0),
(261, 'Multivitamins capsule 100\'s', 5, 0),
(262, 'Mupirocin Ointment', 5, 0),
(263, 'Oral Rehydration Salt (ORS) 25\'s', 5, 0),
(264, 'Paracetamol 100mg/ml drops 15ml', 5, 0),
(265, 'Paracetamol 100mg/ml drops 15ml', 5, 0),
(266, 'Paracetamol 100mg/ml drops 15ml', 5, 0),
(267, 'Paracetamol 250mg/5ml syrup 60ml', 5, 0),
(268, 'Paracetamol 500mg tabs 100\'s', 5, 0),
(269, 'Paracetamol 500mg tablet', 5, 0),
(270, 'Povidone Iodine 120ml', 5, 0),
(271, 'Povidone Iodine 1gallon', 5, 0),
(272, 'Praziquantel 600mg tabs 500\'s', 5, 0),
(273, 'Primaquine Phospate 7.5mg', 5, 0),
(274, 'Pyrazinamide 250mg/5ml 120ml', 5, 0),
(275, 'Ranitidine 300mg tabs 100\'s', 5, 0),
(276, 'Rifampicin 250mg/5ml 120ml', 5, 0),
(277, 'Rifampicin 150mg+Isoniazid 75mg+Ethambutol 275mg+Pyrazinamide 400mg (Adult) 672\'s', 5, 0),
(278, 'Rifampicin 150mg+Isoniazid 75mg 2FDC (Adult) 672\'s', 5, 0),
(279, 'Rifampicin 75mg+Isoniazid 50mg+Pyrazinamide 150mg 3FDC (Children) 84\'s', 5, 0),
(280, 'Rifampicin 75mg+Isoniazid 50mg 2FDC (Children) 84\'s', 5, 0),
(281, 'Rimo (Rice & Mongo Blend) Complimentary Food', 5, 0),
(282, 'Risperidone 2mg tabs', 5, 0),
(283, 'Salbutamol 2mg/5ml syrup 60ml', 5, 0),
(284, 'Salbutamol nebule 1mg/ml 2.5ml 30\'s', 5, 0),
(285, 'Salbutamol sulfate 100mcg/dose', 5, 0),
(286, 'Simvastatin 20mg tabs', 5, 0),
(287, 'Sodium Chloride 0.3% L', 5, 0),
(288, 'Fusidic Acid 5g', 5, 0),
(289, 'Stop TB Kit Cat I & III', 5, 0),
(290, 'Sterile Water for Injection 50ml', 5, 0),
(291, 'Tranexamic Acid 500mg caps 100\'s', 5, 0),
(292, 'Vitamin A 100,000IU 100\'s', 5, 0),
(293, 'Vitamin A 200,000IU 100\'s', 5, 0),
(294, 'Vitamin B Compex tabs 100\'s', 5, 0),
(295, 'Zinc Sulfate oral drops 15ml', 5, 0),
(296, 'Alcohol, Isoprophyl 500ml', 6, 0),
(297, 'Alcohol, Isoprophyl 500ml 3bots/set', 6, 0),
(298, 'Alcohol, Isoprophyl 150ml', 6, 0),
(299, 'Alcohol Ethyl 500ml', 6, 0),
(300, 'Alcohol Ethyl 1L', 6, 0),
(301, 'Alcohol 1gallon', 6, 0),
(302, 'DDR4 Memory RAM', 1, 0),
(303, 'Hand Sanitizer 1L', 6, 0),
(304, 'Video Card', 1, 0),
(305, 'Alcohol-Based Sanitizer 250ml', 6, 0),
(306, 'Alcohol Swab ', 6, 0),
(307, 'Apron', 6, 0),
(308, 'Applicator Sticks 1000\'s', 6, 0),
(309, 'Bandage Scissors', 6, 0),
(310, 'Blood Lancet 100\'s', 6, 0),
(311, 'Cholesterol Strips', 6, 0),
(312, 'Condom Male, Plain 72\'s', 6, 0),
(313, 'Composite Restorative Material', 6, 0),
(314, 'Cotton Balls 100\'s', 6, 0),
(315, 'Cotton Balls 200\'s', 6, 0),
(316, 'Cotton Balls 250\'s', 6, 0),
(317, 'Cotton Balls 300\'s', 6, 0),
(318, 'Cotton rolls', 6, 0),
(319, 'Cycle Beads', 6, 0),
(320, 'Cover all and Gown', 6, 0),
(321, 'Chinstrap (PPE)', 6, 0),
(322, 'Chinstrap (PPE)', 6, 0),
(323, 'Cover all (PPE)', 6, 0),
(324, 'Cryovial 2.0ml', 6, 0),
(325, 'Dengue Rapid Test Kit', 6, 0),
(326, 'Disposable Dental Needle Short 100\'s', 6, 0),
(327, 'Disposable Dental Needle Long 100\'s', 6, 0),
(328, 'Digital Thermometer', 6, 0),
(329, 'Drawsheet, plastic', 6, 0),
(330, 'Drug Test kit 25\'s', 6, 0),
(331, 'Disinfectant Solution 500ml (Lysol)', 6, 0),
(332, 'EDTA Tubes Vacutainer 5ml', 6, 0),
(333, 'Elastic Rubber Bandage 6\"', 6, 0),
(334, 'Essential Healthcare Package 1', 6, 0),
(335, 'N95 Face Mask', 6, 0),
(336, 'KN95 Face Mask', 6, 0),
(337, 'Face Mask, N95 Medium', 6, 0),
(338, 'Face Mask, N100 20\'s', 6, 0),
(339, 'Face Shield (PPE)', 6, 0),
(340, 'Face Shield (Visor)', 6, 0),
(341, 'First Aid Kit Bag', 6, 0),
(342, 'Family Kit Bag', 6, 0),
(343, 'First Aid Responder Kit Bag', 6, 0),
(344, 'Flouride Varnish', 6, 0),
(345, 'Glass Ionomer Cement', 6, 0),
(346, 'Glucose Strips', 6, 0),
(347, 'Gloves, Surgical 100\'s', 6, 0),
(348, 'Gloves, disposable 100\'s', 6, 0),
(349, 'Glutaraldehyde solution 2% 5L', 6, 0),
(350, 'Mags Rim', 13, 0),
(351, 'Gloves (PPE)', 6, 0),
(352, 'Gauze Pad 2x2', 6, 0),
(353, 'Gauze Pad sterile 4x4 100\'s', 6, 0),
(354, 'Gauze Pad 4x4', 6, 0),
(355, 'Goggle', 6, 0),
(356, 'High Density Oxygen Mask w/ tubing-pedia', 6, 0),
(357, 'HIV Rapid Diagnostic Test Kits 25\'s', 6, 0),
(358, 'HIV Viral Load Reagents (Point of Care)', 6, 0),
(359, 'Hydrogen Peroxide 120ml', 6, 0),
(360, 'Hard Hat (PPE)', 6, 0),
(361, 'Infusion Set Pedia', 6, 0),
(362, 'Infusion Set Adult', 6, 0),
(363, 'Insulin Syringe 1cc 500\'s', 6, 0),
(364, 'Insulin Syringe 100\'s (2000\'s/carton)', 6, 0),
(365, 'Insulin Syringe .05ml 100\'s/box', 6, 0),
(366, 'Instrument Tray', 6, 0),
(367, 'Kato Katz Kits', 6, 0),
(368, 'Lubricating Jelly (Lubricant) 100\'s', 6, 0),
(369, 'Liquid Hand Soap', 6, 0),
(370, 'Muac Tape', 6, 0),
(371, 'PPE Set', 6, 0),
(372, 'PPE Set Bag, clear with handle', 6, 0),
(373, 'Pit & Fissure Sealant kit', 6, 0),
(374, 'Pipette Tips Yellow 1000\'s', 6, 0),
(375, 'Protective Clothing, ordinary', 6, 0),
(376, 'Progestin Sub-Dermal Implant (PSI)', 6, 0),
(377, 'Povidone Swab', 6, 0),
(378, 'Razor Blade, disposable', 6, 0),
(379, 'Safety Boots (PPE)', 6, 0),
(380, 'Scalpel Blade', 6, 0),
(381, 'Scalpel Holder', 6, 0),
(382, 'Staining Kit 500ml', 6, 0),
(383, 'Syringes & Needle 0.05ml ', 6, 0),
(384, 'Syringes & needle 0.5ml', 6, 0),
(385, 'Syringes 5ml (Mixing Syringes)', 6, 0),
(386, 'Syringes 3cc', 6, 0),
(387, 'Syringes w/ needle 5cc', 6, 0),
(388, 'Syringes w/ needle 20cc', 6, 0),
(389, 'Safety Collector Boxes', 6, 0),
(390, 'Sputum Cups', 6, 0),
(391, 'Stool Collection Container', 6, 0),
(392, 'Surgical Gown', 6, 0),
(393, 'Shoe Cover', 6, 0),
(394, 'Surgical Tape 1x10', 6, 0),
(395, 'Syphilis Rapid Diagnostic Test 30\'s', 6, 0),
(396, 'Test tube', 6, 0),
(397, 'Thermal Scanner', 6, 0),
(398, 'Thermal Gun', 6, 0),
(399, 'Triangular Bandage', 6, 0),
(400, 'Umbilical Cord Clamp', 6, 0),
(401, 'Uric Acid Strips', 6, 0),
(402, 'Urinalysis Strips 100\'s', 6, 0),
(403, 'Visor Bracket (PPE)', 6, 0),
(404, 'Classic Virus Sampling Tube, Preservation Medium Polyster Swab', 6, 0),
(405, 'Universal Transport Medium 20\'s/box (SANLI)', 6, 0),
(406, 'Nasopharyngeal Swab', 6, 0),
(407, 'Oropharyngeal Swab (OPS)', 6, 0),
(408, 'Xpert Xpress SARS-CoV-2 Kit', 6, 0),
(409, 'Sansure Sample Storage Reagent 48\'s', 6, 0),
(410, 'Aqua K-Othrine (Deltamethrin)', 13, 0),
(411, 'Cold Box', 7, 0),
(412, 'Hygiene Kit', 13, 0),
(413, 'Refill Consumables of Hygiene Kit', 13, 0),
(414, 'Etofenprox 20WP (Victor)', 13, 0),
(415, 'Etofenprox 10EW (Vectron)', 13, 0),
(416, 'Gokilath 1liter 5EC', 13, 0),
(417, 'Insecticide Treated Curtains (Olyset Nets)', 13, 0),
(418, 'Interfolded Tissue', 13, 0),
(419, 'Long Lasting Insecticides Nets (Mosquito Bed Nets)', 13, 0),
(420, 'Lighter', 13, 0),
(421, 'Pesguard 1L', 13, 0),
(422, 'Sumilarv', 13, 0),
(423, 'Vaccine Carrier', 13, 0),
(424, 'Mother & Child Booklet', 13, 0),
(425, 'NTD Master Plan', 13, 0),
(426, 'Pocket Guidelines (Lympatic Filariasis)', 13, 0),
(427, 'Muac Tape (Child)', 13, 0),
(428, 'Muac Tape (Adult)', 13, 0),
(429, 'IMCI Chart Booklet', 13, 0),
(430, 'Schistosomiasis Clinical Practice Guidelines', 13, 0),
(431, 'Malaria Free Disease Free Markers', 13, 0),
(432, 'Manual of Operations on the Philippine National Standards for Drinking Water', 13, 0),
(433, 'Smart TV', 1, 0),
(434, 'Personal Protective Equipment (PPE Set)', 6, 0),
(435, 'Levothyroxine sodium 50mcg 90\'s', 5, 0),
(436, 'Filtered Pipette Tips P200', 6, 0),
(437, 'Filtered Pipette Tips P1000', 6, 0),
(438, 'Cryovials tubes 1.5ml', 6, 0),
(439, '1.5ml Micro Tubes', 6, 0),
(440, 'PCR Plates 96 wells Multiplate Bio-Rad', 6, 0),
(441, 'PCR Strips 8 wells Optical 8 cap Strips Bio Rad', 6, 0),
(442, 'PCR Plate Strips DN', 6, 0),
(443, '15ml Conical tube', 6, 0),
(444, 'Bag', 1, 0),
(445, 'Water Dispenser', 11, 0),
(446, 'Electric Stove', 11, 0),
(447, 'Conical Centrifuge Tube 50ml 25\'s', 6, 0),
(448, 'Laboratory Mat', 6, 0),
(449, 'Wooden Applicator Stick 1000\'s', 6, 0),
(450, 'Autoclave tape 1.9cm', 6, 0),
(451, 'Sterile Screw capped bottle 1000ml', 6, 0),
(452, 'Digital timer', 6, 0),
(453, 'Abacavir 300mg tabs', 5, 0),
(454, 'VTM (Virus Specimen Collection Tube)', 6, 0),
(455, 'Wooden Post Bed', 3, 0),
(456, 'Dewfoam', 3, 0),
(457, 'Storage Cabinet', 3, 0),
(458, 'Steel Cabinet', 3, 0),
(459, 'Junior Executive Table', 3, 0),
(460, 'Horn', 7, 0),
(461, 'Pilot Bearing', 7, 0),
(462, 'Power Steering Belt', 7, 0),
(463, 'Clutch Lining', 7, 0),
(464, 'Clutch Pressure Plate', 7, 0),
(465, 'Release Bearing', 7, 0),
(466, 'Shock Absorber', 7, 0),
(467, 'Timing Belt', 7, 0),
(468, 'Timing Belt Tensioner', 7, 0),
(469, 'Camshaft Oil Seal', 7, 0),
(470, 'Brake Pad', 7, 0),
(471, 'Shoe Brake', 7, 0),
(472, 'Training Bag', 13, 0),
(473, 'Trolley Backpack', 13, 0),
(474, 'HEMB Notebook', 13, 0),
(475, 'HEMB Tumbler', 13, 0),
(476, 'Ballpen w/ Laser', 13, 0),
(477, 'Lanyard w/ ID Holder', 9, 0),
(478, 'USB Flashdrive', 14, 0),
(479, 'Hydrocortisone 100mg/ml', 5, 0),
(480, 'Chlorpheniramine Maleate 100mg/ml', 5, 0),
(481, 'COVID-19 VACCINE (Sinovac)', 5, 0),
(482, 'Anti Tetanus 1500IU', 5, 0),
(483, '10% Dextrose in Water 1L', 5, 0),
(484, 'Cover all', 6, 0),
(485, 'LED TV', 1, 0),
(486, 'Dining Set', 3, 0),
(487, 'Motherboard', 1, 0),
(488, 'RJ45', 14, 0),
(489, 'Viral Transport Media (SANLI)', 6, 0),
(490, 'Viral Transport Media (Gen Amplify)', 6, 0),
(491, 'Water Testing Enzymes/Chromogenic Substrate Agar', 6, 0),
(492, 'Covid-19 Vaccine Astrazeneca', 5, 0),
(493, 'Isoniazid 300mg tabs', 5, 0),
(494, 'VGA Cable', 1, 0),
(495, 'Ascorbic Acid 100mg/5ml syrup 60ml', 5, 0),
(496, 'Gauze Pad non sterile 4x4', 6, 0),
(497, 'IP Camera', 1, 0),
(498, 'Camera', 1, 0),
(499, 'Lamp', 11, 0),
(500, 'Cloxacillin 500mg tabs 100\'s', 5, 0),
(501, 'Flexible Hose 3/4', 7, 0),
(502, 'Electric Plastic Molding 1 1/2\"', 7, 0),
(503, 'Electric Plastic Molding 1\"', 7, 0),
(504, 'Adhesive', 7, 0),
(505, 'Screw', 7, 0),
(506, 'Electrical Tape 1 1/2\"', 7, 0),
(507, 'Salbutamol 2mg tabs 100\'s', 5, 0),
(508, 'Extraction Kit Gen Amplify', 6, 0),
(509, 'Extraction Kit XABT', 6, 0),
(510, 'Pipette Tips, 10 ul, sterile, 96rack', 6, 0),
(511, 'Pipette Tips 20ul, sterile 96rack', 6, 0),
(512, 'Pipette Tips 1000ul, 96tips/rack', 6, 0),
(513, 'Vaginal Speculum medium', 6, 0),
(514, 'Vaginal Speculum large', 6, 0),
(515, 'Tenaculum Stainless', 6, 0),
(516, 'Kelly Placenta Forcep', 6, 0),
(517, 'Universal Transport Medium (Bio-teke)', 6, 0),
(518, 'Autoclave Bag small', 6, 0),
(519, 'Autoclave Bag large', 6, 0),
(520, '250ml RNASE Away', 6, 0),
(521, 'D5 0.3 Nacl 500ml', 5, 0),
(522, 'D5 0.3 Nacl 1liter', 5, 0),
(523, 'Computer Table', 11, 0),
(524, 'Label Maker Tape', 13, 0),
(525, 'Cefuroxime 500mg tabs 10\'s', 5, 0),
(526, 'Cotrimoxazole 800mg/160mg tabs 100\'s', 5, 0),
(527, 'Aspirin 80mg tabs 100\'s', 5, 0),
(528, 'Celecoxib 200mg caps 100\'s', 5, 0),
(529, 'Omeprazole 40mg capsule', 5, 0),
(530, 'Paracetamol 125mg/5ml susp. 60ml', 5, 0),
(531, 'Label Printer', 1, 0),
(532, 'Ferrous Sulfate+Folic Acid 300mg/250mcg tabs', 5, 0),
(533, 'Signal Repeater', 1, 0),
(534, 'Parafilm', 6, 0),
(535, 'Internal Hard Drive', 1, 0),
(536, 'Power Cable', 1, 0),
(537, 'Tenofovir 300mg tabs', 5, 0),
(538, 'Paper Shredder', 1, 0),
(539, 'Nevirapine 50mg/5ml 240ml', 5, 0),
(540, 'Fluphenazine Decanoate 25mg/ml', 5, 0),
(541, 'Fluphenazine Decanoate 25mg/ml', 5, 0),
(542, 'Sling Bag', 7, 0),
(543, 'Plastic Bag Zip Lock', 7, 0),
(544, 'Bar Soap', 7, 0),
(545, 'Plastic Draw Sheet', 7, 0),
(546, 'Disposable Razor', 7, 0),
(547, 'Cotton Towel', 7, 0),
(548, 'Cotton Blanket', 7, 0),
(549, 'Triple Blood Bag', 6, 0),
(550, 'Hepatitis B Antigen Rapid Diagnostic Test', 6, 0),
(551, 'Plain Normal Saline Solution 1L', 5, 0),
(552, 'Lactated Ringers Solution 1L', 5, 0),
(553, 'Blood Collection Tube Red Top', 6, 0),
(554, 'Blood Collection Tube Violet Top', 6, 0),
(555, 'Microset', 6, 0),
(556, 'Clozapine 2mg tab 30\'s', 5, 0),
(557, 'Escitalopram 10mg 30\'s', 5, 0),
(558, 'Sertraline 50mg tabs 30\'s', 5, 0),
(559, 'Haloperidol 5mg tabs 100\'s', 5, 0),
(560, 'Surgical Mask 50\'s', 6, 0),
(561, 'Quadrivalent Human Papillomavirus Recombinant Vaccine 1dose', 5, 0),
(562, 'Stethoscope', 6, 0),
(563, 'Intra-Uterine Device (IUD)', 6, 0),
(564, 'Amoxicillin 250mg caps 100\'s', 5, 0),
(565, 'Captopril 25mg tabs ', 5, 0),
(566, 'Cloxacillin 125mg/5ml 60ml', 5, 0),
(567, 'Cotrimoxazole 200mg/40mg 60ml', 5, 0),
(568, 'Diphenhydramine 12.5mg/5ml syrup 60ml', 5, 0),
(569, 'Ibuprofen 400mg tabs ', 5, 0),
(570, 'Loratadine 5mg/5ml syrup 60ml', 5, 0),
(571, 'Telmisartan 40mg tabs', 5, 0),
(572, 'Omeprazole 20mg tabs', 5, 0),
(573, 'Silver Sulfadiazine 10mg/g, 20g', 5, 0),
(574, 'Loratadine 10mg tabs', 5, 0),
(575, 'Olanzapine 10mg tabs 30\'s', 5, 0),
(576, 'Lithium Carbonate 450mg tabs 100\'s', 5, 0),
(577, 'Valproic Acid 250mg tabs 10\'s', 5, 0),
(578, 'Carbamazepine 200mg tabs 100\'s', 5, 0),
(579, 'Oseltamivir Phosphate 75mg tabs 10\'s', 5, 0),
(580, 'Projector', 1, 0),
(581, 'Bilateral Tubal Ligation (BTL Kits)', 6, 0),
(582, 'WD40', 7, 0),
(583, 'Stain Remover', 7, 0),
(584, 'Tint', 7, 0),
(585, 'Plastic Matting', 7, 0),
(586, 'Seat Cover', 7, 0),
(587, 'Rain Visor', 7, 0),
(588, 'Fender Liner Matting', 7, 0),
(589, 'Combo Kit', 7, 0),
(590, 'Dash Cam', 7, 0),
(591, 'Under seat', 7, 0),
(592, 'Fog Lamp', 7, 0),
(593, 'HUb Bearing', 7, 0),
(594, 'Floor Rubber Matting', 7, 0),
(595, 'Labor', 7, 0),
(596, 'Backing Camera', 7, 0),
(597, 'Salbutamol (as sulfate) 1mg/m, 2.5ml 30\'s', 5, 0),
(598, 'Biperiden 2mg tabs', 5, 0),
(599, 'Chlorpromazine 200mg tabs', 5, 0),
(600, 'Clozapine 100mg tablet', 5, 0),
(601, 'Diphenhydramine 50mg/ml, 1ml amp', 5, 0),
(602, 'Clopidogrel 75mg tablet', 5, 0),
(603, 'Alcohol-Based Sanitizer 1L', 6, 0),
(604, 'Alcohol-Based Sanitizer 500ml', 6, 0),
(605, 'Upper Arm Assembly', 7, 0),
(606, 'Upper Arm Bushing', 7, 0),
(607, 'Lower Arm Ball Joint', 7, 0),
(608, 'Draglink Bar Assembly', 7, 0),
(609, 'Tie Rod End Outer', 7, 0),
(610, 'Tie Rod End Inner', 7, 0),
(611, 'Upper Arm Ball Joint', 7, 0),
(612, 'Wheel Cylinder', 7, 0),
(613, 'Hydrovac Assembly', 7, 0),
(614, 'Brake Master Cylinder Assembly', 7, 0),
(615, 'Primary Clutch Assembly', 7, 0),
(616, 'Secondary Clutch Assembly', 7, 0),
(617, 'Caliper Piston', 7, 0),
(618, 'Caliper Kit', 7, 0),
(619, 'Electrical Blower', 7, 0),
(620, 'Rotor Head Assembly', 7, 0),
(621, 'Delivery Valve', 7, 0),
(622, 'Repair Kit', 7, 0),
(623, 'Oil Seal', 7, 0),
(624, 'Nozzle Tip', 7, 0),
(625, 'Injector Oring', 7, 0),
(626, 'Injector Pump Calibrate & Labor', 7, 0),
(627, 'Injector Labor Charge', 7, 0),
(628, 'Nissan Pathfinder - SFM-415', 7, 0),
(629, 'Valve Egr', 7, 0),
(630, 'Bushing Fr Susp Stabilizer', 7, 0),
(631, 'Disc, Fr Brake', 7, 0),
(632, 'Busing RR Susp Spring Long', 7, 0),
(633, 'Bushing RR Susp Spring Short', 7, 0),
(634, 'Shield Kit, Splash, Frt Lh', 7, 0),
(635, 'Shield Kit, Splash, Frt Rh', 7, 0),
(636, 'Seal Kit, Brk Calp Pstn', 7, 0),
(637, 'Pad Set, Fr Brake', 7, 0),
(638, 'Shock Absorber RR Susp', 7, 0),
(639, 'Link Fr Susp Stabilizer', 7, 0),
(640, 'Piston Fr Brake Calpr', 7, 0),
(641, 'Link Fr Susp Stabilizer Lh', 7, 0),
(642, 'Dia - Plus Brake Fluid Dot4 (300ml)', 7, 0),
(643, 'Fuel Filter Assy', 7, 0),
(644, 'Valve Kit Ink Pump Suc Cont Long', 7, 0),
(645, 'Panbio Covid-19 Ag Rapid Test', 6, 0),
(646, 'Photocopier', 11, 0),
(647, 'Computer Case', 1, 0),
(648, 'RAM', 1, 0),
(649, 'Retouch Hood Portion and Lower Whole Side Painting', 15, 0),
(650, 'Step Board', 15, 0),
(651, 'Retouch Hood Portion and Lower Whole Side Painting ➜ Retouch Hood Portion and Lower Whole Side Painting', 7, 0),
(652, 'Repair Rear Bumper', 7, 0),
(653, 'Fuel Gauge', 7, 0),
(654, 'Wiper Blade', 7, 0),
(655, 'Wash Over', 7, 0),
(656, 'Under Coat', 7, 0),
(657, 'Head Light Assy', 7, 0),
(658, 'Fancing By Portion', 7, 0),
(659, 'General Upholstery', 7, 0),
(660, 'Full Tint FR 3M MT RR 3M MB', 7, 0),
(661, 'Body Sticker', 7, 0),
(662, '210,000KM Check up', 7, 0),
(663, 'Apply car body conditioner', 7, 0),
(664, 'Oil Filters', 7, 0),
(665, 'Dia plus windshield washer fluid', 7, 0),
(666, 'Gasket Eng O/pan drain plug', 7, 0),
(667, 'Dia plus brake parts cleaner', 7, 0),
(668, 'Fully Synthetic 5W 30 CJ 4', 7, 0),
(669, 'X1r Engine flush', 7, 0),
(670, 'BTN BG Diesel care', 7, 0),
(671, 'Consumable Materials sundries', 7, 0),
(672, 'Top 1synthetic lethium grease', 7, 0),
(673, 'BG Brake system kit', 7, 0),
(674, 'BG Brake system kit', 7, 0),
(675, 'Mitsubishi 4x4 Hub Bearing Front / LH and RH', 7, 0),
(676, 'Battery Maintenance Free 11 plates 12 volts', 7, 0),
(677, 'Blower Motor Assembly Brand New', 7, 0),
(678, 'Cleaning', 7, 0),
(679, 'Freon Charging', 7, 0),
(680, 'Lubricating Oil', 7, 0),
(681, 'Rubber Oring', 7, 0),
(682, 'Stereo', 7, 0),
(683, 'Speaker 1 set 6', 7, 0),
(684, 'Subwoofer', 7, 0),
(685, 'Inner tie rod end', 7, 0),
(686, 'Outer tie rod end', 7, 0),
(687, 'Brake shoe', 7, 0),
(688, 'Battery N120MP', 7, 0),
(689, 'Alternator Assembly', 7, 0),
(690, 'Wiper Tank', 7, 0),
(691, 'Fuel Pump Assembly', 7, 0),
(692, 'Socket Relay', 7, 0),
(693, 'Relay', 7, 0),
(694, 'Replace Valve cover gasket/ halfmoon', 7, 0),
(695, 'Gasket , Rocket Cover', 7, 0),
(696, 'Oil seal , Rocker Cover', 7, 0),
(697, 'Oil Timing Belt', 7, 0),
(698, 'Oil Timing Belt Tensioner', 7, 0),
(699, 'Alternator Belt', 7, 0),
(700, 'Outer Bearing', 7, 0),
(701, 'Inner Bearing', 7, 0),
(702, 'Grease (National)', 7, 0),
(703, 'Bull bar front and back stainless ', 7, 0),
(704, 'Compressor brand new', 7, 0),
(705, 'Evaporator', 7, 0),
(706, 'Condenser', 7, 0),
(707, 'Filter drier', 7, 0),
(708, 'Expansion valve', 7, 0),
(709, 'Auxilliary fan', 7, 0),
(710, 'Aircon Hose', 7, 0),
(711, 'Hose Crimping', 7, 0),
(712, 'Fitting', 7, 0),
(713, 'Welding Aluminum Tube', 7, 0),
(714, 'Fan belt', 7, 0),
(715, 'Thermostat Control', 7, 0),
(716, 'Labor Install', 7, 0),
(717, 'Rubberized Matting Silver', 7, 0),
(718, 'Fuel for service vehicles', 7, 0),
(719, 'Replace Door Regulation RRH', 7, 0),
(720, 'Replace Engine  Covert FRT', 7, 0),
(721, 'Plate Under Skid', 7, 0),
(722, 'Regulation RR DR WDO REG LH', 7, 0),
(723, 'MOTOR, F/DR PWR WDO REG LH', 7, 0),
(724, 'Replace Tail Light RH', 7, 0),
(725, 'Beat Out Side Panel RH', 7, 0),
(726, 'Paint Repaired Area', 7, 0),
(727, 'Painting Materials', 7, 0),
(728, 'Lamp Assembly , Comb RR RH', 7, 0),
(729, 'Metal Detector', 13, 0),
(730, 'Tripod', 7, 0),
(731, 'Head Cover', 6, 0),
(732, 'Nebulizer', 2, 0),
(733, 'Boufant Cap', 6, 0),
(734, 'Laboratory Smock Gown', 6, 0),
(735, 'Specimen Carrier Small', 6, 0),
(736, 'Tool Box Big', 13, 0),
(737, 'Plastic Ice Pack', 6, 0),
(738, 'Cadaver/Body Bag ', 13, 0),
(739, 'Electric Fan', 11, 0),
(740, 'IV Cannula G24', 6, 0),
(741, 'Processor', 1, 0),
(742, 'Graphic Card', 1, 0),
(743, 'Mouse & Keyboard Bundle', 1, 0),
(744, 'Repair', 7, 0),
(745, 'Manual Breast Pump', 7, 0),
(746, 'Manual Breast Pump', 6, 0),
(747, 'Aluminum Foil', 6, 0),
(748, 'Paper Towel (interfolded)', 6, 0),
(749, 'Marker (textile pen)', 9, 0),
(750, 'Bleach 1Liter', 13, 0),
(751, 'Isopranol 2.5', 6, 0),
(752, 'Disposable Face shield', 6, 0),
(753, 'Power Supply', 1, 0),
(754, 'Charger', 7, 0),
(755, 'Heater', 7, 0),
(756, 'IP PABX Telephony Sets and Installation', 1, 0),
(757, 'WEBEX Bundle', 1, 0),
(758, 'MS Office 2019 Standard License', 8, 0),
(759, 'Windows 10 Pro License', 8, 0),
(760, 'Antivirus Software', 8, 0),
(761, 'ISOPROPYL 70% ALCOHOL SOLUTION 1L FLIP BOTTLE', 5, 0),
(762, 'SAMBONG 250MG (RENALEAF)', 5, 0),
(763, 'PIVODONE IODINE 10% 60ML (BETASOL)', 5, 0),
(764, 'POVIDONE IODINE 10% 60ML (BETASOL)', 5, 0),
(765, 'Isolation Gown', 6, 0),
(766, 'Tie Rod', 7, 0),
(767, 'Consumable Material', 7, 0),
(768, 'Filter', 7, 0),
(769, 'DISPOSAB;E SYRINGE with NEEDLE (3ML, G23)', 6, 0),
(770, 'ANTISEPTIC SWAB (INDIVIDUALLY PACKED)', 6, 0),
(771, 'Fuel Filter', 7, 0),
(772, 'Air Cleaner', 7, 0),
(773, 'Engine Control Unit', 7, 0),
(774, 'STERILE GAUZE, 8 PLY,4X4,INDIVIDUALLY PACKED', 6, 0),
(775, 'ELASTIC BANDAGE, 3\"X5\"', 6, 0),
(776, 'PLASTER (HYPOALLERGENIC, 1 INCH)', 6, 0),
(777, 'SURGICAL BLADE HOLDER (SAME NO. WITH BLADE)', 6, 0),
(778, 'PROVIDONE IODINE, 120ML', 5, 0),
(779, 'COTTON BALLS (200 PCS)', 6, 0),
(780, 'ISOPROPYL ALCOHOL, 500ML', 6, 0),
(781, 'Switch Freewheel Clutch', 7, 0),
(782, 'SURGICALBLADE NO. 11', 6, 0),
(783, 'DOPPLER ', 6, 0),
(784, 'Cellphone Stand', 7, 0),
(785, 'USB Adapter', 1, 0),
(786, 'Wireless USB Adapter', 1, 0),
(787, 'TB DRUGS FOR ADULT CAT1 ', 5, 0),
(788, 'VAGINAL SPECULUM STAINLESS ', 2, 0),
(789, 'PINCKING FORCEPS', 2, 0),
(790, 'OVUM FORCEPS STAINLESS', 2, 0),
(791, 'UTERINE SOUND ', 2, 0),
(792, 'MAYO SCISSORS', 2, 0),
(793, 'VIGINAL SPECULUM STAINLESS', 2, 0),
(794, 'Coupler', 1, 0),
(795, 'Crimping Tool', 1, 0),
(796, 'Connector', 1, 0),
(797, 'LAMIVUDINE 10MG/ML 240ML ORAL SUSPENSION', 5, 0),
(798, 'ZIDOVUDINE 10MG/ML 240ML ORAL SUSPENSION', 5, 0),
(799, 'FLUCONAZOLE 200MG CAPSULE', 5, 0),
(800, 'Malaria RDT Test Kit', 6, 0),
(801, 'Pneumococcal Conjugate Vaccine (PCV13) 4dose', 5, 0),
(802, 'Artesunate 60mg for injection', 5, 0),
(803, 'Motor Vehicle', 15, 0),
(804, 'ICE PACK 0.3 LITRE', 6, 0),
(805, 'ICE PACK 0.6 LITRE', 6, 0),
(806, 'COVID-19 VACCINE (AstraZeneca) viral vector', 5, 0),
(807, 'COVID-19 VACCINE (SPUTNIK V) viral vector', 5, 0),
(808, 'BCG VACCINE 20 DOSES', 5, 0),
(809, 'BCG DILUENT', 5, 0),
(810, 'HEPA B VACCINE 10 DOSES ', 5, 0),
(811, 'DTP-HEPB-HIB VACCINE', 5, 0),
(812, 'MEASLES, MUMPS AND RUBELLA VACCINE (MMR) 10 DOSES', 5, 0),
(813, 'MEASLES, MUMPS AND RUBELLA VACCINE DILUENT', 5, 0),
(814, 'ADULT DENTAL KITS', 6, 0),
(815, 'LANYARD W/ ALCOHOL BOTTLE', 13, 0),
(816, 'LANYARD W/ ALCOHOL BOTTLE', 13, 0),
(817, '(JANSSEN COVID -19 VACCINE) VIRAL VECTOR', 5, 0),
(818, 'ISONIAZID (EMIZID) 120ML SYRUP', 5, 0),
(819, '0.9 % SODIUM CHLORIDE 1L IV', 5, 0),
(820, 'HYDROCORTISONE 100MG VIAL', 5, 0),
(821, 'Biometric', 1, 0),
(822, 'DENGUE RDT WITH CONSUMABLES', 13, 0),
(823, 'HALOPERIDOL 5MG TAB', 5, 0),
(824, 'HALOPERIDOL 50 MG TAB', 5, 0),
(825, 'HALOPERIDOL 50MG AMPULE', 5, 0),
(826, 'Tire', 7, 0),
(827, 'Stick', 7, 0),
(828, 'DENGUE RDT WITH CONSUMABLES', 6, 0),
(829, 'Covid-19 Moderna Vaccine', 5, 0),
(830, 'COVID-19 Vaccine Moderna', 5, 0),
(831, 'BIOTHERMAL PACKAGING SYSTEM ', 13, 0),
(832, 'Surgical Cap', 6, 0),
(833, 'Nebulizing Kit', 6, 0),
(834, 'Enclosure', 13, 0),
(835, 'Adhesive Plaster', 6, 0),
(836, 'Hot Water Bag', 6, 0),
(837, 'Bathroom Weighing Scale', 6, 0),
(838, 'BRACKET', 13, 0),
(839, 'MEDROXYPROGESTERONE ACETATE ( PROVESTINE) VIAL', 5, 0),
(840, 'URINE STRIPS', 5, 0),
(841, 'GLOCUSE STRIPS ', 6, 0),
(842, 'URINALYSIS STRIPS', 6, 0),
(843, 'URIC ACID STRIPS', 6, 0),
(844, 'STERILE LANCET FINE', 6, 0),
(845, 'Thermostat', 7, 0),
(846, 'RAPID ANTIGEN TEST KITS', 6, 0),
(847, 'CEFTRIAXONE 1G VIAL', 5, 0),
(848, 'UTM ', 6, 0),
(849, '0.3ML AUTO DISABLE (TKMD)', 6, 0),
(850, 'OMNIVAN 2ML MIXING SYRINGE', 5, 0),
(851, 'PFIZER DILUENT SONDIUM CHLORIDE INJ. USP 0.9% 2ML', 5, 0),
(852, 'COVID-19 VACCINE (PFIZER-BioNTech) ', 5, 0),
(853, 'SALBUTAMOL NEBULE 1MG/ML', 5, 0),
(854, 'SALBUTAMOL NEBULE 1MG/ML', 5, 0),
(855, '70% ETHYL ALCOHOL 150ML', 6, 0),
(856, 'NIFEDIPINE 10 MG CAPSULE', 5, 0),
(857, 'METHYLERGOMETRINE MALEATE AMPULE', 5, 0),
(858, 'OXYTOCIN 10 I.U./ML AMP', 5, 0),
(859, 'VITAMIN C 500 MG CAPSULE', 5, 0),
(860, 'PHYTOMENADIONE 10MG/ML AMP', 5, 0),
(861, 'MULTIVITAMINS CAPSULE', 5, 0),
(862, 'LIDOCAINE HYDROCHLORIDE  50ML', 5, 0),
(863, 'ENDURE MALE LATEX CONDOM', 6, 0),
(864, 'Light Assembly', 7, 0),
(865, 'Backdoor Glass', 7, 0),
(866, 'Earbuds', 1, 0),
(867, 'Smartphone', 1, 0),
(868, 'AIDEX ACTIVATED GLUTARALDEHYDE SOLUTION 2%', 6, 0),
(869, '(RIMO) RICE +MONGO INFANT CEREAL', 13, 0),
(870, 'FOOT PEDAL SPRAYCAN WITH 1 LITER ALCOHOL', 6, 0),
(871, 'TROLLY BAG', 6, 0),
(872, 'TRAUMA KITS', 6, 0),
(873, 'CEFUROXIME SUSPENSION 250MG/5ML (SQcef)', 5, 0),
(874, 'CLONIDINE 75MCG TABLET (CATAPIN)', 5, 0),
(875, 'ATORVASTATIN CALCIUM (FLORVAST) 40MG', 5, 0),
(876, 'MEFENAMIC ACID 500MG CAP (MEFED)', 5, 0),
(877, 'ASCORBIC ACID (MYREVIT-C) 500MG TAB', 5, 0),
(878, 'PARACETAMOL (CRISTICOL) 500 MG TAB', 5, 0),
(879, 'HEAVY-DUTY COT BEDS', 6, 0),
(880, 'CHLORINE S COMPATOR TEST FOR CHLORINE AND PH', 6, 0),
(881, 'ISOPROPYL ALCOHOL 1L', 6, 0),
(882, 'HYDRALAZINE MG/ML 1 ML AMPULE', 5, 0),
(883, 'BACTIGEL 1L WITH DISPENSER', 6, 0),
(884, 'PFIZER DILUENT SODIUM CHLORIDE INJ. USP 0.9% 2ML ', 6, 0),
(885, 'HIV TESTING KITS ', 6, 0),
(886, 'HYDROCORTISONE 250MG I.V./I.M. POWDER FOR INJ.', 5, 0),
(887, 'CEFUROXIME 500MG TABLET', 5, 0),
(888, 'PULSE OXIMETER', 6, 0),
(889, 'PARACETAMOL 10MG/ML  SOLUTION FOR INJ.', 5, 0),
(890, 'diphenhydramine 50mg capsule', 5, 0),
(891, 'CEFUROXIME 1.5G VIAL', 5, 0),
(892, 'ZINC - MINERAL SYRUP', 5, 0),
(893, 'DICYCLOVERINE SYRUP 60 ML', 5, 0),
(894, 'BP APPARATUS DESKTYPE', 6, 0),
(895, 'License', 1, 0),
(896, 'Co-amoxiclav 200mg + 28.5mg per 5ml granules/powder for suspension 70 ml', 5, 0),
(897, 'AMOXICILLIN 500MG (AS TRIHYDRATE) ', 5, 0),
(898, 'AMOXICILLIN 250MG/5ML, GRANULES POWDER FOR SUSPENSION 60 ML (AS TRIHYDRATE)', 5, 0),
(899, 'SALBUTAMOL (AS SULFATE) 100MCG/DOSE x 200 ACTUATIONS METERED DOSE', 5, 0),
(900, 'SALBUTAMOL (AS SULFATE) 1MG/ML 2.5 ML (UNIT DOSE)', 5, 0),
(901, 'ETHYL ALCOHOL 70% SOLUTION 1 GAL', 6, 0),
(902, 'CLEAN GLOVES 100\'S (SURGITECH) MEDIUM', 6, 0),
(903, 'CLEAN GLOVES 100\'S (SURGITECH) LARGE', 6, 0),
(904, 'IRON + FOLIC ACID (AMECIRON)', 5, 0),
(905, 'EXTRA LONG RUBBER GLOVES', 6, 0),
(906, 'Early Warning Device', 7, 0),
(907, 'Wire', 7, 0),
(908, 'BOLT ON CIRCUIT BREAKER', 7, 0),
(909, 'PVC PIPE', 7, 0),
(910, 'ELBOW', 7, 0),
(911, 'PLASTIC MOLDING  3/4\'\'', 7, 0),
(912, 'ELIGANT BOX', 7, 0),
(913, 'LAMIVUDINE 300MG + TENOFOVIR 300MG + DOLUTEGRAVIR 50MG TABLET', 5, 0),
(914, 'ANEROID BP APPARATUS SET', 6, 0),
(915, 'AZITHROMYCIN 500MG VIAL', 5, 0),
(916, '5% DEXTROSE  IN 0.3 SODIUM CHLORIDE 1L', 5, 0),
(917, '5% DEXTROSE LACTATED RINGER\'S SOLUTION 1L', 5, 0),
(918, '5% DEXTROSE IN 0.9% SODIUM CHLORIDE 1L', 5, 0),
(919, 'BALANCE MULTIPLE REPLACEMENT SOLUTION 1L', 5, 0),
(920, 'PLAIN LACTATED RINGERS SOLUTION 1L', 5, 0),
(921, 'PISTON RING', 7, 0),
(922, 'PISTON ASSEMBLY', 7, 0),
(923, 'CYLINDER LINER SEMI FINISH', 7, 0),
(924, 'CONROD BEARING', 7, 0),
(925, 'MAIN BEARING', 7, 0),
(926, 'WASHER', 7, 0),
(927, 'ENGINE VALVE INTAKE EXHAUSE', 7, 0),
(928, 'OVER HAULING GASKET', 7, 0),
(929, 'VALVE GUIDE', 7, 0),
(930, 'PISTON PIN BUSHING', 7, 0),
(931, 'PEARMEABLE COVERALL SUIT', 6, 0),
(932, 'IMPERMEABLE COVERALL SUIT', 6, 0),
(933, 'PFIZER COMIRNATY VACCINE 6 DOSES/VIAL (DONATION: GOV\'T VIA COVAX)', 5, 0),
(934, 'COMIRNATY VACCINE 6 DOSES/VIAL (PFIZER MANUFACTURING PUURS: GOV\'T PROCUREMENT GOV\'T VIA COVAX)', 5, 0),
(935, 'EGG CRATE ACOUSTIC FOAM TILES', 7, 0),
(936, 'PULL TOWER ANTENNA', 7, 0),
(937, 'WIRELESS RADIO', 7, 0),
(938, 'OPERATING SYSTEM', 1, 0),
(939, 'VIDEO RECORDER', 1, 0),
(940, 'STORAGE SURVEILANCE', 1, 0),
(941, 'RIFAMPICIN 150MG+ ISONIAZID 75MG+PYRAZINAMIDE 400MG+ETHAMBUTOL HCL 275MG BY ZUELLIG PHARMA CORPORATION', 5, 0),
(942, 'RIFAMPICIN 150MG+ISONIAZID 75MG  BY ZUELLING PHARMA CORPORATION', 5, 0),
(943, 'TIRE', 7, 0),
(944, 'SIDE MIRROR', 7, 0),
(945, 'GLICLAZIDE 30MG (AGLIC MR) TABLET', 5, 0),
(946, 'HDMI TO VGA CONNECTOR', 1, 0),
(947, 'USB EXTENSION CABLE', 1, 0),
(948, 'NETWORK ETHERNET CABLE TESTER', 1, 0),
(949, 'COTRIMOXAZOLE (KATHREX) 400MG/80MG TABLET', 5, 0),
(950, 'FOOT COVER', 6, 0),
(951, 'ANEROID SPHYGMOMANOMETER ADULT CUFF WITH STETHOSECOPE HEAVY DUTY', 6, 0),
(952, 'LIQUID CHLORINE BLEACH 1GAL', 6, 0),
(953, 'TYPING SERA ABO/ RH KIT SET OF A, B, AND D', 6, 0),
(954, 'THERMO GUN', 6, 0),
(955, 'THERMOGUN', 6, 0),
(956, 'Battery DIN 76', 7, 0),
(957, 'MAGS', 7, 0),
(958, 'PFIZER COMIRNATY VACCINE 6 DOSES/VIAL.DONATION: US GOV\'T VIA COVAX', 5, 0),
(959, 'Graduated Cylinder', 6, 0),
(960, 'Beaker', 6, 0),
(961, 'Reagent Bottle (Clear)', 6, 0),
(962, 'Reagent Bottle (Amber)', 6, 0),
(963, 'Burret', 6, 0),
(964, 'AUTOMATIC HAND SANITIZER', 7, 0),
(965, 'Nutrient Agar 500g', 6, 0),
(966, 'Lauryl Tryptose Broth 500g', 6, 0),
(967, 'E.C. Broth 500g', 6, 0),
(968, 'BGLB 500g', 6, 0),
(969, 'Denatured Alcohol ', 6, 0),
(970, 'Water Test Kit', 6, 0),
(971, 'Gram Stain Kit 250ml', 6, 0),
(972, 'Enterococcus Aerogenes ATCC 1348', 6, 0),
(973, 'Enterococcus Feacalis ATCC29212', 6, 0),
(974, 'Pseudomonas Aeruginosa ATCC ', 6, 0),
(975, 'Petri Dish', 6, 0),
(976, 'Durham Tubes', 6, 0),
(977, 'Pipettes', 6, 0),
(978, 'Inoculating Loop', 6, 0),
(979, 'Sampling Bottle', 6, 0),
(980, 'Screw Cap Test Tube', 6, 0),
(981, 'Alcohol Lamp', 6, 0),
(982, 'Staphylococcus Aureus ATCC', 6, 0),
(983, ' (FEMME) LEVONORGESTREL+ ETHYLLESTRADIOL+FERROUS FUMARATE TAB', 5, 0),
(984, 'Lapel', 1, 0),
(985, '2-WAY SPLITTER', 1, 0),
(986, 'TUBERCULIN SYRINGE  W/ DETACHABLE NEEDLE', 6, 0),
(987, 'SYRINGE NEEDLE 23GX1', 6, 0),
(988, 'Activated Charcoal Powder 10g', 5, 0),
(989, 'NOVIRAPINE 10MG/ML, ORAL SUSPENSION, 240ML', 5, 0),
(990, 'EFAVIRENZ 600MG + LAMIVUDINE 300MG + TENOFOVIR DISOPROXIL FUMARATE 300MG 30\'S', 5, 0),
(991, 'ABACAVIR 300MG', 5, 0),
(992, 'EFAVIRENZ 600MG + LAMIVUDINE 300MG + TENOFOVIR DISOPROXIL FUMARATE 300MG 30\'S', 5, 0),
(993, 'LAMIVUDINE 10MG/ML,240ML ORAL SUSPENSION', 5, 0),
(994, 'EFAVIRENZ 600MG + LAMIVUDINE 300MG + TENOFOVIR DISOPROXIL FUMARATE 300MG 30\'S', 5, 0),
(995, 'WIPER LINK', 7, 0),
(996, 'TIE ROD END', 7, 0),
(997, 'PRESSURE PLATE', 7, 0),
(998, 'OVEN', 13, 0),
(999, 'DRUG TEST MET/THC CASSETE', 6, 0),
(1000, 'URINE SCREW CUP (120L)', 6, 0),
(1001, 'URINE STRIPS URS-10 100\'S/BOX', 6, 0),
(1002, 'Tower Casing', 7, 0),
(1003, 'PFIZER DILUENT SODIUM CHLORIDE INJ. USP 0.9% 10ML ', 5, 0),
(1004, 'GAMALEYA (SPUTNIK V) COMPONENT I 2DOSE/AMPULE', 5, 0),
(1005, 'GAMALEYA (SPUTNIK V) COMPONENT II  2DOSE/AMPULE', 5, 0),
(1006, 'HDMI EXTENSION PORT', 1, 0),
(1007, 'VACCINE COLD STORAGE UNIT', 2, 0),
(1008, 'VACCINE COLD STORAGE UNIT( FRIDGE-TAG 2 E (TEMPERATURE MONITORING DEVICE, PQS E006/040) DONATION 202616531 WHO)', 2, 0),
(1009, 'FRIDGE-TAG 2 E (TEMPERATURE MONITORING DEVICE, PQS E006/040) DONATION 202616531 WHO)', 6, 0),
(1010, 'AD SYRINGE  (ONEJECT) 0.3ML G24', 6, 0),
(1011, 'ESCITALOPRAM (ESCIVEX 10) 10mg tablet  ', 5, 0),
(1012, 'LAMOTRIGINE (LAMITOR-100) TABLET', 5, 0),
(1013, 'FLUPENTOXOL (FLUANXOL DEPOT) 20MG/ML SOLUTION FOR INJECTION', 5, 0),
(1014, 'DRUG TESTING KITS 25PCS/ BOX', 6, 0),
(1015, 'PREDNISONE 10MG TABLET', 5, 0),
(1016, 'BETHAMETHASONE (BETNODERM)', 5, 0),
(1017, 'MB ADULT 360KIT ', 5, 0),
(1018, 'MB ADULT 360KIT ', 5, 0),
(1019, 'MB CHILD 288 KIT', 5, 0),
(1020, 'PB ADULT 180 KIT', 5, 0),
(1021, 'LAMPRENE 100MG ', 5, 0),
(1022, 'DOCUMENT STERILIZER', 11, 0),
(1023, 'PREGNANCY TEST HCG TEST KIT', 6, 0),
(1024, 'AMLODIPINE (AS BESILATE/CAMSYLATE) 5MG TABLET ', 5, 0),
(1025, 'GLICLAZIDE 30MG MR TABLET ', 5, 0),
(1026, 'COMIRNATY VACCINE 6 DOSES /VIAL PFIZER MANUFACTURING  PURRS GOV\'T PROCUREMENT', 5, 0),
(1027, '0.3ML A.D SYRINGE (YESO-MED) WUXI 3000PCS/CARTOON', 6, 0),
(1028, 'COVID-19 VACCINE ASTRAZENICA 8 DOSES/VIAL UK GOV\'T VIA COVAX NO. 45181107', 5, 0),
(1029, 'COVID-19 VACCINE ASTRAZENICA 10 DOSES/VIAL DONATION: SOUTH KOREA', 5, 0),
(1030, 'COVID-19 VACCINE ASTRAZENICA 10 DOSES/VIAL DONATION: FRENCH GOV\'T', 5, 0),
(1031, 'PPE- SURGICAL MASKS (LEVEL II, NON STERILE)', 6, 0),
(1032, 'PPE- EXAMINATION GLOVES (NITRILE, SIZE 7))', 6, 0),
(1033, 'PPE- EXAMINATION GLOVES (NITRILE, SIZE 7.5)', 6, 0),
(1034, 'PPE- EXAMINATION GLOVES (NITRILE, SIZE 8)', 5, 0),
(1035, 'PPE- EXAMINATION GLOVES (NITRILE, SIZE 8)', 6, 0),
(1036, 'PPE - HEAD COVERS (NON-WOVEN)', 6, 0),
(1037, 'Software', 1, 0),
(1038, 'HEPLOCK 100\'S/BOX', 6, 0),
(1039, 'HYPOALLERGENIC SURGICAL TAPE (1 INCH)', 6, 0),
(1040, 'NEBULIZER MASK ', 6, 0),
(1041, 'NIPRO HYPODERMIC NEEDLE G#23', 6, 0),
(1042, 'SALTER WEIGHING SCALE FOR INFANT', 2, 0),
(1043, 'SALTER WEIGHING SCALE FOR INFANT', 6, 0),
(1044, 'BINDING MACHINE', 11, 0),
(1045, '5% DEXTROSE IN WATER 1L ', 5, 0),
(1046, 'CETIRIZINE 2.5MG DROPS 10ML ', 5, 0),
(1047, 'CETIRIZINE 2.5MG DROPS 10ML ', 5, 0),
(1048, 'CETIRIZINE 2.5MG DROPS 10ML ', 5, 0),
(1049, 'CETIRIZINE 1MG SYRUP 60ML', 5, 0),
(1050, 'DESKTOP COMPUTER MONITOR', 1, 0),
(1051, 'FREEZER', 11, 0),
(1052, 'ISOPROPYL ALCOHOL SOLUTION 370ML', 6, 0),
(1053, '0.3ML A.D SYRINGE (MEDECO) INJECT 3000PCS/CARTON', 6, 0),
(1054, 'AZITHROMYCIN 200MG/5ML SUSPENSION (ROZITAN)', 5, 0),
(1055, 'CO-AMOXICLAV 70ML SUSPENSION', 5, 0),
(1056, 'CO-AMOXICLAV  (AMOXICILLIN + POTASSIUM CLAVULANATE 400MG+ 57MG) TABLET', 5, 0),
(1057, 'CO-AMOXICLAV  (AMOXICILLIN + POTASSIUM CLAVULANATE 400MG+ 57MG) TABLET', 5, 0),
(1058, 'CO-AMOXICLAV  (AMOXICILLIN + POTASSIUM CLAVULANATE 400MG+ 57MG TABLET', 5, 0),
(1059, 'LEVOFLOXACIN (AS HEMIHYDRATE)', 5, 0),
(1060, 'ROSUVASTATIN 100MG TAB', 5, 0),
(1061, 'SALBUTAMOL (AS SULFATE)1 MG/ML NEBULE 30\'S', 5, 0),
(1062, '1 CC DISPOSABLE SYRINGE 100\'S /BOX', 6, 0),
(1063, 'IV CANNULA G22 100\'S BOX', 6, 0),
(1064, 'IV CANNULA G20 100\'S BOX', 6, 0),
(1065, 'IV CANNULA G18 100\'S BOX', 6, 0),
(1066, '02 CANNULA', 6, 0),
(1067, '02 FACE MASK', 6, 0),
(1068, 'Rifapentine 300mg+Isoniazid 300mg', 5, 0),
(1069, 'VIDEO BAR', 1, 0),
(1070, 'VIDEO CONFERENCE EQUIPMENT', 1, 0),
(1071, 'INSTRUMENT STERILIZER', 2, 0),
(1072, 'GLUCOSE MACHINE', 2, 0),
(1073, 'SALBUTAMOL 2MG/ML, 2.5ML NEB ', 5, 0),
(1074, 'LEARNS Toolkit', 7, 0),
(1075, 'MACROSET', 6, 0),
(1076, 'LCD SCREEN', 1, 0),
(1077, 'BACTI-CINERATOR STERILIZER', 2, 0),
(1078, 'TP LINK', 1, 0),
(1079, 'Desktop Calculator', 9, 0),
(1080, 'Isosorbide 30mg tab', 5, 0),
(1081, 'Furosemide 40mg tab', 5, 0),
(1082, 'Gliclazide 80mg tab', 5, 0),
(1083, 'Emergency Light', 11, 0),
(1084, 'Tramadol HCL 50mg/ml', 5, 0),
(1085, 'Vitamin B Complex ampule', 5, 0),
(1086, 'Cefuroxime 750mg', 5, 0),
(1087, 'Digoxin 250mg tab', 5, 0),
(1088, 'Methyldopa 250mg tab', 5, 0),
(1089, 'Ready To Use Therapeutic Food (RUTF)', 5, 0),
(1090, 'Yellow Plastic Bag', 6, 0),
(1091, 'CAR AIR PURIFIER', 7, 0),
(1092, 'CROSS JOINT', 7, 0),
(1093, 'CENTER LINK', 7, 0),
(1094, 'STRAT BAR BUSHING', 7, 0),
(1095, 'STABILIZER BUSHING', 7, 0),
(1096, 'STABILIZER LINK', 7, 0),
(1097, 'AUTOMATED VOLTAGE REGULATOR ', 1, 0),
(1098, 'DIGITAL THERMOSTAT ', 6, 0),
(1099, 'PRINT SERVER', 1, 0),
(1100, 'TABLET CASE', 7, 0),
(1101, 'COMIRNATY VACCINE 10 DOSES/VIAL', 5, 0),
(1102, 'RUP SYRINGE 3ML (ONEJECT G.23)', 6, 0),
(1103, 'GE 500 reagents pack, Electrolyte Analyzer = GE 500 reagent pack', 6, 0),
(1104, 'GE 500 QC SOLUTION, ELECTROLYTE ANALYZER = QC SOLUTION/3X10M', 6, 0),
(1105, 'GE 500 DEPROTEINIZER, ELECTROLYTE ANALYZER = /50ML', 6, 0),
(1106, 'URINALYSIS REAGENT STRIPS', 6, 0),
(1107, 'Generator Sets', 7, 0),
(1108, 'CEFUROXIME (as AXETIL) 500MG', 5, 0),
(1109, 'COTRMOXAZOLE 800MG SULFAMETHOXAZOLE + 160MG TRIMETHOPRIM', 5, 0),
(1110, 'MICRONUTRIENT POWDER', 5, 0),
(1111, 'BREASTFEEDING KIT', 6, 0),
(1112, 'PARACETAMOL 120MG SYRUP 60ML', 5, 0),
(1113, 'Motorcycle Honda XRM', 16, 0),
(1114, 'WASTE HOLDING FACILITY', 17, 0),
(1115, 'SAMPLE STORAGE REAGENT #2, SWABBING KIT', 6, 0),
(1116, 'PARACETAMOL 150MG/ML 2ML AMPULE', 5, 0),
(1117, 'AMPICILLIN + SULBACTAM 1.5G VIAL', 5, 0),
(1118, 'AMPICILLIN + SULBACTAM 500MG + 25OMG', 5, 0),
(1119, 'AMPICILLIN 250MG VIAL', 5, 0),
(1120, 'AMPICILLIN 500MG VIAL', 6, 0),
(1121, 'ISOSORBIDE-5-MONONITRATE 60MG MR', 5, 0),
(1122, 'CEFAZOLIN 1G VIAL', 5, 0),
(1123, 'HYDRALAZINE 20MG/ML 1ML AMPULE', 5, 0),
(1124, 'METHYLPREDNISOLONE 16MG', 5, 0),
(1125, 'DIGITAL VIDEO RECORDER', 1, 0),
(1126, 'AXILLARY THERMOMETER', 6, 0),
(1127, 'CCTV CAMERA', 1, 0),
(1128, 'CAR ALARM', 7, 0),
(1129, 'THRUST WASHER', 7, 0),
(1130, 'OVERHAULING GASKET', 7, 0),
(1131, 'ENGINE OIL', 7, 0),
(1132, 'RADIATOR UPPER HOSE', 7, 0),
(1133, 'HOSE CLIP', 7, 0),
(1134, 'RADIATOR LOWER HOSE', 7, 0),
(1135, 'ALCOHOL 70% ISOPROPYL SOLUTION', 6, 0),
(1136, 'ALCOHOL 70% ISOPROPRYL SOLUTION 1L', 6, 0),
(1137, 'CETIRIZINE 1MG/ML SYRUP 60ML', 5, 0),
(1138, 'ALUMUNINUM MAGNESIUM 200MG/100MG 5ML 120ML', 5, 0),
(1139, 'ALUMINUM MAGNESIUM 200MG/100MG 5ML 120ML', 5, 0),
(1140, 'KETOCONAZOLE', 5, 0),
(1141, 'CLARITHROMYCIN', 5, 0),
(1142, 'SALMONELLA TYHI KITS TYPHOID TEST', 6, 0),
(1143, 'ABSORBENT COTTON BALLS ', 6, 0),
(1144, 'Clindamycin 150mg capsule', 5, 0),
(1145, 'HEAD CAP', 6, 0),
(1146, 'Multivitamins tablet', 5, 0),
(1147, 'GAUZE PAD 4X5', 6, 0),
(1148, 'HEPA Filter', 6, 0),
(1149, 'GAUZE PAD STERILE 4X5', 6, 0),
(1150, 'Ciprofloxacin Vial', 5, 0),
(1151, 'Clindamycin 300mg', 5, 0),
(1152, 'Levofloxacin 750mg', 5, 0),
(1153, 'Clonidine 150mcg tablet', 5, 0),
(1154, 'Rosuvastatin 10mg tablet', 5, 0),
(1155, 'Fluconazole 150mg capsule', 5, 0),
(1156, 'Colchicine 500mcg tablet', 5, 0),
(1157, 'Montelukast 10mg tablet', 5, 0),
(1158, 'Dexamethasone 4mg tablet', 5, 0),
(1159, 'Acetylcysteine 600mg tablet', 5, 0),
(1160, 'Isoxsuprine Hydrochloride 1omg tablet', 5, 0),
(1161, 'Fecal Occult Blood Test', 6, 0),
(1162, 'CREATININE REAGENT', 2, 0),
(1163, 'CHOLESTEROL REAGENT', 2, 0),
(1164, 'TRIGLYCERIDE REAGENT', 2, 0),
(1165, 'DETERMINE HIV 1/2 SERUM/PLASMA 100TEST/K', 6, 0),
(1166, 'INFRADED NON CONTACT THERMOMETER', 6, 0),
(1167, 'CELECOXIB 400MG', 5, 0),
(1168, 'KETOROLAC 30MG/ML', 5, 0),
(1169, 'TRANEXAMIC ACID 100MG/ML', 5, 0),
(1170, 'HYOSCINE 20MG/ML', 5, 0),
(1171, 'OMEPRAZOLE 20MG CAPSULE', 5, 0),
(1172, 'OMEPRAZOLE 40MG POWDER VIAL', 5, 0),
(1173, 'SODIUM BICARBONATE 1mEq/ML', 5, 0),
(1174, 'SODIUM CHLORIDE 2.5 mEq/ML', 5, 0),
(1175, 'HYDROCORTISONE 125MG/ML VIAL', 5, 0),
(1176, 'HYDROCORTISONE 50MG/ML VIAL', 5, 0),
(1177, 'CINNARIZINE 25MG TABLET', 5, 0),
(1178, 'AMIKACIN 125MG/ML VIAL', 5, 0),
(1179, 'AMIKACIN 250MG/ML VIAL', 5, 0),
(1180, 'AMIKACIN 50MG/ML VIAL', 5, 0),
(1181, 'CEFEPIME 500MG VIAL', 5, 0),
(1182, 'CEFOXITIN 1G VIAL', 5, 0),
(1183, 'CEFTAZIDIME 1G VIAL', 5, 0),
(1184, 'CEFTAZIDIME 500MG VIAL', 5, 0),
(1185, 'CHLORAMPHENICOL 1G VIAL', 5, 0),
(1186, 'CHLORPHENIRAMINE 10MG/ML', 5, 0),
(1187, 'GENTAMICIN 40MG/ML AMPULE', 5, 0),
(1188, 'MEROPENEM 1G VIAL', 5, 0),
(1189, 'MEROPENEM 500MG VIAL', 5, 0),
(1190, 'METRONIDAZOLE 5MG/ML VIAL', 5, 0),
(1191, 'MOXIFLOXACIN 5MG/ML SOLUTION', 5, 0),
(1192, 'PIPERACILLIN + TAZOBACTAM 2G + 250MG VIAL', 5, 0),
(1193, 'PIPERACILLIN + TAZOBACTAM VIAL', 5, 0),
(1194, 'ERYTHROMYCIN EYE OINTMENT', 5, 0),
(1195, 'CLONIDINE 150MCG/ML', 5, 0),
(1196, 'AMIODARONE 200MG TABLET', 5, 0),
(1197, 'AMIODARONE 50MG/ML AMPULE', 5, 0),
(1198, 'NICARDIPINE 1MG/ML AMPULE', 5, 0),
(1199, 'NOREPINEPHRINE 1MG/ML AMPULE', 5, 0),
(1200, 'VERAPAMIL 2.5MG/ML AMPULE', 5, 0),
(1201, 'FENOFIBRATE 160MG TABLET', 5, 0),
(1202, 'GABAPENTIN 100MG CAPSULE', 5, 0),
(1203, 'NYSTATIN 100,000 UNITS/ML SUSPENSION', 5, 0),
(1204, 'CILOSTAZOL 100MG TABLET', 5, 0),
(1205, 'CILOSTAZOL 50MG TABLET', 5, 0),
(1206, 'PHENYTOIN 50MG/ML AMPULE', 5, 0),
(1207, 'ACICLOVIR 200MG TABLET', 5, 0),
(1208, 'ACICLOVIR 25MG/ML 10MLVIAL', 5, 0),
(1209, 'VALACICLOVIR 500MG TABLET', 5, 0),
(1210, 'IRON SUCROSE 20MG/ML, AMPULE', 5, 0),
(1211, 'ACETYLCYSTEINE SACHET', 5, 0),
(1212, 'INDACATEROL + GLYCOPYRRONIUM (110MCG/50 MCG', 5, 0),
(1213, 'ALBUMIN HUMAN 20%', 5, 0),
(1214, 'ALBUMIN HUMAN 25%', 5, 0),
(1215, 'METOCLOPRAMIDE 5MG/ML', 5, 0),
(1216, 'ISOXSUPRINE HYDROCHLORIDE 5MG/ML', 5, 0),
(1217, 'POTASSIUM CHLORIDE', 5, 0),
(1218, 'URSODEOXYCHOLIC ACID 250MG CAPSULE', 5, 0),
(1219, 'Clindamycin 150mg/2ml', 5, 0),
(1220, 'Ergonomic Gliding Wrist pag', 1, 0),
(1221, 'Ergonomic Gliding Wrist Pad', 1, 0),
(1222, 'CO-AMOXICLAV (AMOXICILLIN + POTASSIUM CLAVULANATE) 500MG + 125MG TABLET', 5, 0),
(1223, 'CO-AMOXICLAV (AMOXICILLIN + POTASSIUM CLAVULANATE) 200MG + 28.5MG / ML, 70ML SUSPENSION', 5, 0),
(1224, 'TOPICAL ANTIBIOTIC', 5, 0),
(1225, 'Albothyl Vaginal Suppositories', 5, 0),
(1226, 'Tobramycin + Dexamethasone Eye Drops', 5, 0),
(1227, 'Topical Anti-Fungal', 5, 0),
(1228, 'Clotimazole and Clindamycin 300mg capsule', 5, 0),
(1229, '3 in 1 Machine Easy Life GCU', 2, 0),
(1230, 'Rabies Vaccine', 5, 0),
(1231, 'FOOT BATH DISINFECTANT MAT', 6, 0),
(1232, 'CHEMICAL SODIUM HYPOCHLORIDE', 6, 0),
(1233, 'ASCORBIC ACID ORAL DROPS', 5, 0),
(1234, 'PARACETAMOL SUSPENSION', 5, 0),
(1235, 'ALCOHOL 70% ISOPROPYL 500ML', 6, 0),
(1236, 'MIXED SCREEN SAND AND GRAVEL', 13, 0),
(1237, 'HEAVY EQUIPMENT', 13, 0),
(1238, 'TRIGLYCERIDE REAGENT', 5, 0),
(1239, 'CHOLESTEROL REAGENT', 5, 0),
(1240, 'CREATININE REAGENT', 5, 0),
(1241, 'DEPOMEDROXY PROGESTERONE ACETATE (DMPA) INJECTABLE 150MG 1ML VIAL', 5, 0),
(1242, 'COMBINED ORAL CONTRACEPTIVE 30MCG ETHINYLESTRADIOL + FERROUS FUMARATE 75MG', 5, 0),
(1243, 'COMIRNATY VACCINE 10 DOSES/VIAL PFIZER MANUFACTURING PUURS GOV\'T PROCUREMENT', 5, 0),
(1244, 'LEVOFLOXACIN 500MG TAB', 5, 0),
(1245, 'CONNECTING ROD', 7, 0),
(1246, 'PISTON', 7, 0),
(1247, 'LINER', 7, 0),
(1248, 'INTAKE VALVE', 7, 0),
(1249, 'EXHAUST FAN', 7, 0),
(1250, 'CLUTCH COVER', 7, 0),
(1251, 'GASKET CEMENT', 7, 0),
(1252, 'GASKET SEALANT', 7, 0),
(1253, 'AMPICILLIN 500MG VIAL', 5, 0),
(1254, 'COLEMAN SMALL SIZE', 7, 0),
(1255, 'KELLY PADS', 6, 0),
(1256, 'LEVONORGESTREL + ETHINYLESTRADIOL (COMBINED CONTRACEPTIVE) 150MCG/30MG FILM COATED TABLET', 5, 0),
(1257, 'LEVONORGESTREL + ETHINYLESTRADIOL (COMBINED CONTRACEPTIVE) 150MCG/30MCG FILM COATED TABLET', 5, 0),
(1258, 'XN-L CELLPACK DCL 1X20L', 6, 0),
(1259, 'XN-L LYSERCELL WDF 1X2L', 6, 0),
(1260, 'XN-L HEMATOLOGY WASHING SOLUTION 120ML', 6, 0),
(1261, 'LYSERCELL WDF, REAGENT FULLY AUTOMATED HEMATOLOGY ANALYZER MACHINE = SYSMEX LYSERCELL WDL/2L', 6, 0),
(1262, 'PROBE CLEANER / WASHING SOLUTION, REAGENT FULLY AUTOMATED HEMATOLOGY ANALYZER MACHINE=SYSMEX WASHING SOLUTION /120ML', 6, 0),
(1263, 'GE 500 DS-ISE FILLING SOLUTION, ELECTROLYTE ANALYZER = FILING SOLUTION / 10ML', 6, 0),
(1264, 'ESCHERICHIA COLI ATCC 25922', 6, 0),
(1265, 'AUTOMATIC ALCOHOL DISPENSER', 11, 0),
(1266, 'TOOTH MODEL', 2, 0),
(1267, 'WHITFIELDS OINTMENT ANTIFUNGAL TUBES', 5, 0),
(1268, 'FIRST AID KITS', 6, 0),
(1269, 'COVID-19 VACCINE PFIZER (ADULT)', 5, 0),
(1270, 'FRIDTAG TAG-2E, with External sensor and sucker', 6, 0),
(1271, 'VARO AND POPO app connector cable, package of (10) USB OTG adaptor', 1, 0),
(1272, 'CLEAN GLOVES (MEDIUM)', 6, 0),
(1273, 'CLEAN GLOVES (LARGE)', 6, 0),
(1274, 'MIXING SYRINGE 2ML', 6, 0),
(1275, 'ANALOG TELEPHONE', 1, 0),
(1276, 'PATCH PANEL', 1, 0),
(1277, 'RACKMOUNT SWITCH', 1, 0),
(1278, 'NETWORK VIDEO RECORDER', 1, 0),
(1279, 'AMOXICILLIN 500MG ', 5, 0),
(1280, 'AMOXICILLIN 250MG', 5, 0),
(1281, 'CIDEX SOLUTION 1 GAL ', 6, 0),
(1282, 'TOPICAL ANTIBIOTIC', 5, 0),
(1283, 'WBC Diluting Fluid', 6, 0),
(1284, 'CPU (CENTRAL PROCESSING UNIT)', 1, 0),
(1285, 'COAXIAL CABLE', 1, 0),
(1286, 'CENTER TABLE', 3, 0),
(1287, 'Divalproex Sodium 250mg Extended Release 250mg Tablet', 5, 0),
(1288, 'Divalproex Sodium', 5, 0),
(1289, 'Valproic Acid ', 5, 0),
(1290, 'Divalproex Sodium ', 5, 0),
(1291, 'Divalproex Sodium 500mg', 5, 0),
(1292, 'Quetiapine 200mg', 5, 0),
(1293, 'Fluoxetine 20mg', 5, 0),
(1294, 'Leukoplast', 6, 0),
(1295, 'Ciprofloxacin', 5, 0),
(1296, 'Zinc Sulfate', 5, 0),
(1297, 'Sterillium', 6, 0),
(1298, 'Refrigerated Truck', 16, 0),
(1299, '2019 LGU HSC Annual Report', 4, 0),
(1300, 'LGU Health Scorecard Manual of Procedure(MOP)', 4, 0);
INSERT INTO `ref_item` (`item_id`, `item`, `category_id`, `status`) VALUES
(1301, 'MOUSE & MOUSEPAD', 1, 0),
(1302, 'AIR PURIFIER WITH HEPA FILTER', 2, 0),
(1303, 'Flourocell', 6, 0),
(1304, 'Sulfolyser', 6, 0),
(1305, 'Disposable Syringe', 6, 0),
(1306, 'KALINGA KIT', 5, 0),
(1307, 'Manual Transfer Switch', 7, 0),
(1308, 'Zonrox 900ml', 12, 0),
(1309, 'Zonrox ', 12, 0),
(1310, 'Trash Bag', 12, 0),
(1311, 'HEMA QUICK STAIN SET', 6, 0),
(1312, 'BUDESONIDE Nebule', 5, 0),
(1313, 'Male Condom', 6, 0),
(1314, 'Lubricant', 6, 0),
(1315, 'White Tips', 6, 0),
(1316, 'Finecare Kits', 6, 0),
(1317, 'WALLMOUNT', 11, 0),
(1318, 'FETAL DOPPLER', 2, 0),
(1319, 'DENTAL INSTRUMENT SET', 2, 0),
(1320, 'MANUAL RESUSCITATOR, INFANT', 2, 0),
(1321, 'MINOR SURGICAL SET', 2, 0),
(1322, 'SUCTION MACHINE', 2, 0),
(1323, 'CUTDOWN MINOR SET', 2, 0),
(1324, 'MANUAL RESUSCITATOR, ADULT', 2, 0),
(1325, 'BP APPARATUS, STAND TYPE', 2, 0),
(1326, 'AUTOMATIC PIPETTOR SET', 2, 0),
(1327, 'STETHOSCOPE PEDIA', 2, 0),
(1328, 'SPHYGMOMANOMETER', 2, 0),
(1329, 'SPHYGMOMANOMETER (ACCURACY)', 2, 0),
(1330, 'SPHYGMOMANOMETER (ANEROID)', 2, 0),
(1331, 'WEIGHING SCALE, INFANT', 2, 0),
(1332, 'STETHOSCOPE ADULT', 2, 0),
(1333, 'WEIGHING SCALE, ADULT', 2, 0),
(1334, 'SPHYGMOMANOMETER (ALPLC 2)', 2, 0),
(1335, 'CARDIO STETHOSCOPY', 2, 0),
(1336, 'NON CONTACT THERMOMETER', 2, 0),
(1337, 'Pick Up Strada 4x4', 16, 0),
(1338, 'Diluent', 5, 0),
(1339, 'Diluent', 5, 0),
(1340, 'Euromed Diluent', 5, 0),
(1341, '0.9% Sodium Chloride Inj. 2ml', 5, 0),
(1342, 'bOPV BIVALENT ORAL POLIOMYELITIS DROPPER', 6, 0),
(1343, 'PNEUMOCOCCAL POLYSACCHARIDE CONJUGATE VACCINE (PCV10))', 5, 0),
(1344, 'INACTIVATED POLIOMYELITIS (IPV) VACCINE, 10 DOSE', 5, 0),
(1345, 'MEASLES, MUMPS & RUBELLA DILUENT', 5, 0),
(1346, 'PURIFIED VERO CELL RABIES VACCINE', 5, 0),
(1347, 'EQUINE ANTI-RABIES IMMUNOGLOBULIN VACCINE', 5, 0),
(1348, 'Glucose', 5, 0),
(1349, 'Creatinine', 6, 0),
(1350, 'Glucose', 6, 0),
(1351, 'Uric Acid', 6, 0),
(1352, 'Triglycerides', 6, 0),
(1353, 'Urea', 6, 0),
(1354, 'DCL Cellpack', 6, 0),
(1355, 'Sulfolyser', 6, 0),
(1356, 'Flourocell WDF', 6, 0),
(1357, 'Lsercell WDF', 6, 0),
(1358, 'Probe Cleanser/Washing Solution', 6, 0),
(1359, 'Controls (high,low,normal', 6, 0),
(1360, 'Fully Automated Heamtology Analyzer Machine-6 parts ( SYSMEX)', 6, 0),
(1361, 'Lysercell', 6, 0),
(1362, 'Cholesterol', 6, 0),
(1363, 'SGOT/AST', 6, 0),
(1364, 'SGPT/ ALT 4*1 SL', 6, 0),
(1365, 'Control Serum ( Normal & Pathologic )', 6, 0),
(1366, 'Calibrator ', 6, 0),
(1367, 'PIPETTE', 6, 0),
(1368, 'SPECIMEN', 6, 0),
(1369, 'Finecare  kits', 6, 0),
(1370, 'COVER SLIPS', 6, 0),
(1371, 'GAUZE PAD ROLLS', 6, 0),
(1372, 'GE 500 REAGENTS', 6, 0),
(1373, 'F75 THERPEUTICA MILK ', 5, 0),
(1374, 'EVAPORATOR ASSEMBLY', 7, 0),
(1375, 'CAPILLARY TUBE', 6, 0),
(1376, 'CLAY SEALER', 6, 0),
(1377, 'ALLIGATOR FORCEP', 6, 0),
(1378, 'CHART HOLDER', 6, 0),
(1379, 'BLUE TOP', 6, 0),
(1380, 'COVER GLASS', 6, 0),
(1381, 'CRYPTOPLASTIC TUBES', 6, 0),
(1382, 'BETAHISTINE', 5, 0),
(1383, 'SURGICAL BLADE', 6, 0),
(1384, 'TYPING SERA', 6, 0),
(1385, 'IV CANNULA', 6, 0),
(1386, 'Penicillin G Benzathine', 5, 0),
(1387, 'Shrink Banded Vessels', 6, 0),
(1388, 'Coliform Test Reagent', 6, 0),
(1389, 'PLAIN LACTATED RINGERS ', 5, 0),
(1390, 'PNSS ', 5, 0),
(1391, 'D5 IMB', 5, 0),
(1392, 'D5 NM', 5, 0),
(1393, 'D5 NSS', 5, 0),
(1394, 'D5 0.3% NACL', 5, 0),
(1395, 'STERILE WATER', 5, 0),
(1396, 'D5 WATER', 5, 0),
(1397, 'Bifenthrin', 13, 0),
(1398, 'Vectron 10EW', 13, 0),
(1399, 'BIFENTHRIN 10%', 6, 0),
(1400, 'VECTRON 10EW', 6, 0),
(1401, 'DOBUTAMINE', 5, 0),
(1402, 'DOPAMINE', 5, 0),
(1403, 'FUROSEMIDE', 5, 0),
(1404, 'IV FLUIDS', 5, 0),
(1405, 'SIM ROUTER', 1, 0),
(1406, 'AIR PURIFIER', 11, 0),
(1407, 'MANNITOL', 5, 0),
(1408, 'SILK SUTURE', 6, 0),
(1409, 'FEEDING TUBE', 6, 0),
(1410, 'AMPICILLIN 1G', 5, 0),
(1411, 'RANITIDINE 25MG/ML', 5, 0),
(1412, 'USB-TYPE WIFI ADAPTER', 1, 0),
(1413, 'CERVICAL COLLAR', 6, 0),
(1414, 'BEDPAN', 6, 0),
(1415, 'BENEDICT QUAL SOLUTION', 6, 0),
(1416, 'AFB STAIN', 6, 0),
(1417, 'CERVICAL INSPECTION SET', 6, 0),
(1418, 'SURGICAL TRAY', 6, 0),
(1419, 'BLOOD PRESSURE MONITOR', 6, 0),
(1420, 'ICE-LINED REFRIGERATOR', 2, 0),
(1421, 'ULTRA LOW FREEZER', 2, 0),
(1422, 'SPAREPARTS', 2, 0),
(1423, 'EAR PODS', 1, 0),
(1424, 'WIRELESS LASER POINTER PRESENTER', 1, 0),
(1425, 'PVC CARDS', 13, 0),
(1426, 'COLOR RIBBON KIT', 9, 0),
(1427, 'SOUNDBAR', 1, 0),
(1428, 'NIPRO HYPODERMIC NEEDLE G25X1', 6, 0),
(1429, 'IRON = VITAMIN B COMPLEX 120ML SYRUP ', 5, 0),
(1430, 'ZINC 55 MG/5ML ', 5, 0),
(1431, 'FERROUS SULFATE + FOLIC ACID + VITAMIN B COMPLEX ', 5, 0),
(1432, 'ALUMINUM MAGNESIUM 120ML ', 5, 0),
(1433, 'ALUMINUM MAGNESIUM 60ML ', 5, 0),
(1434, 'HIV RDT 1 (CONSUMABLES)', 6, 0),
(1435, 'ENDOTRACHEAL TUBE', 6, 0),
(1436, 'FOLY BAG CATHETER', 6, 0),
(1437, 'THERMAL PAPER', 6, 0),
(1438, 'SPONGE FORCEP', 6, 0),
(1439, 'ERGONOMIC CHAIR WITH ARMREST', 11, 0),
(1440, 'SLEEPING BAG', 13, 0),
(1441, 'LIFE JACKET', 13, 0),
(1442, 'Kiddie Toothbrush', 7, 0),
(1443, 'POCKET WIFI', 1, 0),
(1444, 'COMIRNATY VACCINE 6 DOSES/VIAL Pfizer Manufacturing Puurs DONATION (AUSTRALIA-UNIFCEF)', 5, 0),
(1445, 'RUP 2ml Syringe (Kojak selinge) 2,000pcs per cartoon', 2, 0),
(1446, 'Pfizer Diluent Sodium chloride 0.9% w/v Injection BP, 10ml', 5, 0),
(1447, 'RUP 2ml Syringe (Kojak selinge) ', 6, 0),
(1448, 'Azithromycin', 5, 0),
(1449, 'vitamins B1B2B6B12', 5, 0),
(1450, 'Casing w/ power supply', 1, 0),
(1451, 'AMBULANCE', 16, 0),
(1452, 'READY TO USE SUPPLEMENTARY FOOD FOR 6-59 MONTHS CHILDREN', 5, 0),
(1453, 'LEVEL 3 PPE', 6, 0),
(1454, 'FREON', 13, 0),
(1455, 'SWAGING TOOL', 13, 0),
(1456, 'THERMOSTAT 134A', 13, 0),
(1457, 'MANIFOLD GAUGE', 13, 0),
(1458, 'ACCESS VALVE', 13, 0),
(1459, 'MAPP GAS', 13, 0),
(1460, 'THERMOSTAT 131', 13, 0),
(1461, 'THERMOSTAT 131', 13, 0),
(1462, 'FILTER DRIER', 13, 0),
(1463, '1416 REFRIGERANT SYSTEM FLUSHING', 13, 0),
(1464, 'VL CARTRIDGES ', 2, 0),
(1465, 'VL CARTRIDGES', 6, 0),
(1466, 'TRANSFORMER', 2, 0),
(1467, 'ERGONOMIC CHAIR ARMLESS', 11, 0),
(1468, 'BHW EMERGENCY KIT', 6, 0),
(1469, 'ITRACONAZOLE ', 5, 0),
(1470, 'WADDING SHEET', 6, 0),
(1471, 'WRISTLET', 6, 0),
(1472, 'LOPERAMIDE', 5, 0),
(1473, 'VALGANCICLOVIR', 5, 0),
(1474, 'CABLE WIRE RACK CABINET', 11, 0),
(1475, 'WATER DISPENSER', 11, 0),
(1476, 'RIBBON KIT', 13, 0),
(1477, 'MINI PROJECTOR', 1, 0),
(1478, 'BUTORPHANOL 2MG/ML', 5, 0),
(1479, 'BUPIVACAINE 5ML', 5, 0),
(1480, 'MIDAZOLAM 1MG/5ML, 5ML', 5, 0),
(1481, 'COTTON PREP PADS ', 6, 0),
(1482, 'GAUGE NEEDLE', 6, 0),
(1483, 'TOURNIQUET', 6, 0),
(1484, 'POWER SPRAY HANDLE', 13, 0),
(1485, 'WHISTLE KETTLE', 13, 0),
(1486, 'FRONT BUMPER', 16, 0),
(1487, 'TOILET BOWL', 13, 0),
(1488, 'ECG PAPER', 6, 0),
(1489, 'MICROPORE TAPE 2\'\'', 6, 0),
(1490, 'SPINE BOARD WITH STRAPS', 6, 0),
(1491, 'SURGICAL STERILE GLOVES 7.0, 50\'S', 6, 0),
(1492, 'URINAL PLASTIC (MALE)', 6, 0),
(1493, 'URINAL COLLECTOR, PEDIATRIC', 6, 0),
(1494, 'URINE COLLECTOR', 6, 0),
(1495, 'FERROUS SULFATE + FOLIC ACID 60mg + ELEMENTAL IRON + 400mcg FOLIC ACID CAPSULE 100\'S/BOX', 5, 0),
(1496, 'CONDOM 3PCS/BOX', 6, 0),
(1497, 'CORK BOARD 2X3', 9, 0),
(1498, 'TORNIQUET FLAT', 6, 0),
(1499, 'COLORIMETER', 2, 0),
(1500, 'RESIDUAL CHLORINE COMPARATOR KIT ', 2, 0),
(1501, 'TURBIDITY TUBE', 2, 0),
(1502, 'NITRATE TEST STRIPS', 2, 0),
(1503, 'ARSENIC TEST KIT', 2, 0),
(1504, 'E.COLI TEST KIT', 2, 0),
(1505, 'PORTABLE INCUBATOR', 2, 0),
(1506, 'MULTI-PARAMTER TEST KITS', 2, 0),
(1507, 'ADENOSINE 3MG/ML', 5, 0),
(1508, 'SUTURE', 6, 0),
(1509, 'EXPANDED NEWBORN SCREENING TEST', 6, 0),
(1510, 'RUP SYRINGE 2ML G21 (TKMD) ', 5, 0),
(1511, 'SOUND MIXER', 1, 0),
(1512, 'PODCASTING CONSOLE', 1, 0),
(1513, 'ELITROL', 6, 0),
(1514, 'ELITROL II', 6, 0),
(1515, 'ELICAL II', 6, 0),
(1516, 'System Solution ', 6, 0),
(1517, 'Filter IFL', 6, 0),
(1518, 'Oral Glucose Tolerance Drink', 5, 0),
(1519, 'AHG/Coombs Sera', 6, 0),
(1520, 'LISS', 6, 0),
(1521, 'HEPA C', 6, 0),
(1522, 'H. PYLORI TEST KIT', 6, 0),
(1523, 'ANESTHESIA MASK', 6, 0),
(1524, 'BREATHING CIRCUIT', 6, 0),
(1525, 'Aminophylline 25mg/ml', 5, 0),
(1526, 'Lidocaine+Epinephrine 20mg/ml', 5, 0),
(1527, 'THERMAL PASTE', 7, 0),
(1528, 'Reagent for SARS-COV-2', 6, 0),
(1529, 'Biomedical Refrigerator', 2, 0),
(1530, 'EPIDURAL CATHETER', 6, 0),
(1531, 'EXTENSION TUBING', 6, 0),
(1532, 'ONDANSETRON (AS HCL)', 5, 0),
(1533, 'PIPERACILLIN+TAZOBACTAM', 5, 0),
(1534, 'TERBUTALINE 500MCG/ML', 5, 0),
(1535, 'Praziquantel 600mg tabs 100\'s/box', 5, 0),
(1536, 'CD-4 Reagents Compatible with Pima Machine', 6, 0),
(1537, 'PIMA CD-4 (Consumables)', 6, 0),
(1538, 'Lancing Device', 6, 0),
(1539, 'System Cleaning Solution', 6, 0),
(1540, 'HDL Calibrator', 6, 0),
(1541, 'Cuvette rotor', 6, 0),
(1542, 'Cuvette Washbook', 6, 0),
(1543, 'HDMI SPLITTER', 1, 0),
(1544, 'WATER DRINKING CONTAINERS', 13, 0),
(1545, 'HALOPERIDOL 5MG/ML, 1ML', 5, 0),
(1546, 'FIREWALL', 1, 0),
(1547, 'LAMINATOR', 11, 0),
(1548, 'CALCIUM GLUCONATE', 5, 0),
(1549, 'EPSON INK 664 BLACK', 9, 0),
(1550, 'EPSON INK 664 CYAN', 9, 0),
(1551, 'EPSON INK 664 MAGENTA', 9, 0),
(1552, 'EPSON INK 664 YELLOW', 9, 0),
(1553, 'EPSON INK 664 (BLACK, CYAN, MAGENTA, YELLOW)', 9, 0),
(1554, 'HP LAPTOP DQ2055', 1, 0),
(1555, 'SMARTPHONE - INFINIX NOTE12', 1, 0),
(1556, 'SYPHILIS TEST KIT (CONSUMABLES)', 6, 0),
(1557, 'DOLUTEGRAVIR 50MG TABLET', 5, 0),
(1558, 'MEMANTINE 10MG ', 5, 0),
(1559, 'Height Measure Wall Sticker', 6, 0),
(1560, 'Tablet Cutter', 6, 0),
(1561, 'Plastic Medicine Cup', 6, 0),
(1562, 'EDTA Vaccutainer tube', 6, 0),
(1563, 'UNDERPADS', 6, 0),
(1564, 'FLAT PANEL TV WALL MOUNT FOR 14\'\'-42\'\'', 7, 0),
(1565, 'ACER ASPIRE Z1402-330Q', 1, 0),
(1566, 'FUJI XEROX DOCUCENTRE  S2110 TONER CARTRIDGE', 9, 0),
(1567, 'EDIFIER HEADSET K800', 1, 0),
(1568, 'FUJITSU S1100 DOCUMENT SCANNER', 1, 0),
(1569, 'EXTERNAL HARD DRIVE DISK 1.0TB TOSHIBA', 1, 0),
(1570, 'ROMOSS 20,000MAH PPD20 POWERBANK', 1, 0),
(1571, 'CLONE DESKTOP', 1, 0),
(1572, 'PORTABLE AIR COOLER', 11, 0),
(1573, 'COPY PRINTER INK MASTER ROLL DX2430', 9, 0),
(1574, 'SEAGATE 2TB EXTERNAL HDD ', 1, 0),
(1575, 'ISE ELECTRODES', 6, 0),
(1576, 'URINE CONTROL', 6, 0),
(1577, 'TEST TUBE RACK', 6, 0),
(1578, 'STAINING RACK', 6, 0),
(1579, 'STAINING GLASS', 5, 0),
(1580, 'COPY PRINTER MASTER ROLL SX2430', 9, 0),
(1581, 'EPSON INK 003 BLACK', 9, 0),
(1582, 'EPSON INK 003 CYAN', 9, 0),
(1583, 'EPSON INK 003 MAGENTA', 9, 0),
(1584, 'EPSON INK 003 YELLOW', 9, 0),
(1585, 'IDLER ARM ASSY', 16, 0),
(1586, 'PREDNISONE 20mg tablet', 5, 0),
(1587, 'U BOLT', 7, 0),
(1588, 'SILVER SULFADIAZINE CREAM 1%, 25g', 6, 0),
(1589, 'Cotrimoxazole 960mg', 5, 0),
(1590, 'Troclosene Sodium', 5, 0),
(1591, 'Aidex Solution ', 5, 0),
(1592, 'Calibrated Digital Thermo Hygrometer', 6, 0),
(1593, 'Extraction Chair', 6, 0),
(1594, 'Arm Sling Adult Large', 6, 0),
(1595, 'Arm Sling Adult Medium', 6, 0),
(1596, 'Arm Sling Adult Small', 6, 0),
(1597, 'Switch Transpone', 6, 0),
(1598, 'ECG PADS', 6, 0),
(1599, 'ECG LEAD', 5, 0),
(1600, 'MICROPHONE TAPE', 6, 0),
(1601, 'Micropore Tape', 6, 0),
(1602, 'Transpore Tape', 6, 0),
(1603, 'Blood Typing Sera', 6, 0),
(1604, 'HIV Rapid Test Kit', 6, 0),
(1605, 'HbSAg Test Kit', 5, 0),
(1606, 'Electronic Temperature Logger', 6, 0),
(1607, 'COMIRNATY Vaccine 10Doses/vial Pfizer Manufacturing Puurs (for PEDIA Vaccine ONLY)', 5, 0),
(1608, '0.3ML A.D Syringe (TKMD)', 5, 0),
(1609, 'VANISH POINT SYRINGE 1ML 25G', 5, 0),
(1610, 'PFIZER DILUENT 0.9% SODIUM CHLORIDE, 2ML', 5, 0),
(1611, 'AUTO DISABLE SYRINGE 0.5ML', 6, 0),
(1612, 'HIV RAPID DIAGNOSTIC TEST-2 AND CONSUMABLES', 6, 0),
(1613, 'CD-4 REAGENTS PIMA MACHINE (CONSUMABLES)', 6, 0),
(1614, 'APPLE MACBOOK AIR', 1, 0),
(1615, 'ACER VERITON M200-B350', 1, 0),
(1616, 'METOCLOPRAMIDE 10MG TAB, 100s/box', 5, 0),
(1617, 'Vitamin B1, B6, B12 100mg+5mcg tablet', 5, 0),
(1618, 'MULTIVITAMINS PER 1ML, 15ML DROPS', 5, 0),
(1619, 'LAGUNDI 300MG TABLET, 100s/box', 5, 0),
(1620, 'OLANZAPINE 10mg', 5, 0),
(1621, 'FLUPENTIXOL 20mg/ml', 5, 0),
(1622, 'STERILIZATION PUCH GUSSETTED', 6, 0),
(1623, 'STERILIZATION POUCH GUSSETTED', 6, 0),
(1624, 'LAGUNDI 300MG', 5, 0),
(1625, 'ASCORBIC ACID', 5, 0),
(1626, 'AMOXICILLIN  250mg/5mL SUSPENSION 60mL', 5, 0),
(1627, 'CLONIDINE 75mcg', 5, 0),
(1628, 'HEAVY DUTY COT BED', 6, 0),
(1629, 'VITAMIN B COMPLEX', 5, 0),
(1630, 'ORAL REHYDRATION SALT', 4, 0),
(1631, 'METFORMIN 500mg', 5, 0),
(1632, 'ORAL REHYDRATION SALT', 5, 0),
(1633, 'LAGUNDI SYRUP 120mL', 5, 0),
(1634, 'UNIVERSAL TRANSPORT MEDIUM (BIOSITE)', 6, 0),
(1635, 'EPSON INK T6641 BLACK', 9, 0),
(1636, 'EPSON INK T6642 CYAN', 9, 0),
(1637, 'EPSONK INK T6643 MAGENTA', 9, 0),
(1638, 'EPSONK INK T6644 YELLOW', 9, 0),
(1639, 'HUAWEI MATEBOOK D15', 1, 0),
(1640, 'RBC DILUTING FLUID, 500ML', 6, 0),
(1641, 'HP 26A CF226A TONER', 9, 0),
(1642, 'EPSON L3210', 1, 0),
(1643, 'TOSHIBA 1TB EXTERNAL HDD', 1, 0),
(1644, 'FILARIASIS TEST STRIP', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_lastpn`
--

CREATE TABLE `ref_lastpn` (
  `id` int NOT NULL,
  `property_no` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ref_lastpn`
--

INSERT INTO `ref_lastpn` (`id`, `property_no`) VALUES
(1, '2024-08-0005-IT');

-- --------------------------------------------------------

--
-- Table structure for table `ref_ntc`
--

CREATE TABLE `ref_ntc` (
  `ntc_id` int NOT NULL,
  `ntc_category` varchar(50) NOT NULL,
  `total_contract` double(10,2) NOT NULL,
  `contract_effectivity` varchar(80) NOT NULL,
  `contract_number` varchar(50) NOT NULL,
  `ntc_balance` double(10,2) NOT NULL,
  `actual_balance` double(10,2) NOT NULL,
  `breakfast_ppax` double(10,2) NOT NULL,
  `amsnacks_ppax` double(10,2) NOT NULL,
  `lunch_ppax` double(10,2) NOT NULL,
  `pmsnacks_ppax` double(10,2) NOT NULL,
  `dinner_ppax` double(10,2) NOT NULL,
  `lodging_ppax` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_ntc`
--

INSERT INTO `ref_ntc` (`ntc_id`, `ntc_category`, `total_contract`, `contract_effectivity`, `contract_number`, `ntc_balance`, `actual_balance`, `breakfast_ppax`, `amsnacks_ppax`, `lunch_ppax`, `pmsnacks_ppax`, `dinner_ppax`, `lodging_ppax`) VALUES
(1, 'Category A - 50 PAX AND BELOW', 1645900.00, 'January 1, 2020 - December 31, 2020', '2020-01-001', 1645900.00, 1645900.00, 120.00, 100.00, 270.00, 100.00, 270.00, 400.00),
(2, 'Category B - 51 PAX TO 150 PAX', 4551830.00, 'January 1, 2019 - December 31, 2019', '2020-01-002', 4551830.00, 4551830.00, 120.00, 100.00, 270.00, 100.00, 270.00, 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `ref_rcc`
--

CREATE TABLE `ref_rcc` (
  `id` int NOT NULL,
  `code` varchar(75) NOT NULL,
  `acronym` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_rcc`
--

INSERT INTO `ref_rcc` (`id`, `code`, `acronym`, `description`, `status`) VALUES
(1, '13-001-03-00016', 'RO-XIII', 'Regional Office XIII', 0),
(2, '13-001-03-00016-02', 'SRDS', 'Support to Regional Delivery Services', 0),
(3, '13-001-03-00016-02-01', 'RD', 'Regional Director', 0),
(4, '13-001-03-00016-02-02', 'ARD', 'Assistant Regional Director', 0),
(5, '13-001-03-00016-02-03', 'MSD', 'Management Support Division', 0),
(6, '13-001-03-00016-02-03-01', 'FINANCE', 'FINANCE', 0),
(7, '13-001-03-00016-02-03-02', 'MMS', 'MATERIAL MANAGEMENT SECTION', 0),
(8, '13-001-03-00016-02-03-03', 'GS', 'GENERAL SERVICES', 0),
(9, '13-001-03-00016-02-03-04', 'PROCUREMENT', 'PROCUREMENT', 0),
(10, '13-001-03-00016-02-03-06', 'CASHIER', 'CASHIER', 0),
(11, '13-001-03-00016-02-04', 'Planning', 'Planning', 0),
(12, '13-001-03-00016-02-05', 'COA', 'Commission on Audit', 0),
(13, '13-001-03-00016-03', 'Operation', 'Operation', 0),
(14, '13-001-03-00016-03-01', 'LHSD', 'Local Health System Division', 0),
(15, '13-001-03-00016-03-01-01', 'HRDU', 'Human Resource Development Unit', 0),
(16, '13-001-03-00016-03-01-02', 'HHRDB', 'Health Human Resource Policy Development and Planning for LGU and Regional Support', 0),
(17, '13-001-03-00016-03-01-03', 'RHMPP', 'Rural Health Midwife Placement Program', 0),
(18, '13-001-03-00016-03-01-04', 'ORAL', 'Oral Health', 0),
(19, '13-001-03-00016-03-01-05', 'RNHEALS', 'Elimination of Diseases-RN Heals', 0),
(20, '13-001-03-00016-03-01-06', 'ICU', 'Internal Control Unit', 0),
(21, '13-001-03-00016-03-01-07', 'STATISTIC', 'Statistics', 0),
(22, '13-001-03-00016-03-01-08', 'HIMTS', 'Health Information Management and Technology System', 0),
(23, '13-001-03-00016-03-01-09', 'RESEARCH', 'RESEARCH', 0),
(24, '13-001-03-00016-03-01-10', 'KM', 'Knowledge Management', 0),
(25, '13-001-03-00016-03-01-11', 'ISO', 'International Operational Standards', 0),
(26, '13-001-03-00016-03-01-12', 'PHT-ADN', 'Provincial Health Team-Agusan Del Norte (ADN)', 0),
(27, '13-001-03-00016-03-01-13', 'PHT-ADS', 'Provincial Health Team-Agusan Del Sur (ADS)', 0),
(28, '13-001-03-00016-03-01-14', 'PHT-SDN', 'Provincial Health Team-Surigao Del Norte\r\n(SDN)', 0),
(29, '13-001-03-00016-03-01-15', 'PHT-SDS', 'Provincial Health Team-Surigao Del Sur (SDS)', 0),
(30, '13-001-03-00016-03-01-16', 'PHT-PDI', 'Provincial Health Team-Province of Dinagat Island (PDI)', 0),
(31, '13-001-03-00016-03-01-17', 'HCA', 'Health Care Assistance', 0),
(32, '13-001-03-00016-03-01-17-01', 'BNB', 'Botika ng Barangay', 0),
(33, '13-001-03-00016-03-01-17-02', 'NPPD-Pharmacist', 'National Pharmaceutical Policy Dev\'t.-BNB Pharmacist', 0),
(34, '13-001-03-00016-03-01-17-03', 'NPPD-Encoder', 'National Pharmaceutical Policy Dev\'t.-Data Encoder', 0),
(35, '13-001-03-00016-03-01-18', 'DPC', 'Disease Prevention and Control', 0),
(36, '13-001-03-00016-03-01-19', 'NEC', 'Epidemiology and Disease Surveillance', 0),
(37, '13-001-03-00016-03-01-20', 'Infectious', 'Infectious Disease Prevention and Control', 0),
(38, '13-001-03-00016-03-01-20-01', 'MALARIA', 'Elimination of Malaria', 0),
(39, '13-001-03-00016-03-01-20-02', 'Schisto', 'Elimination of Schisto', 0),
(40, '13-001-03-00016-03-01-20-03', 'Leprosy', 'Elimination of Leprosy', 0),
(41, '13-001-03-00016-03-01-20-04', 'Filaria', 'Elimination of Filaria', 0),
(42, '13-001-03-00016-03-01-21', 'EOH', 'Environmental and Occupational Health', 0),
(43, '13-001-03-00016-03-01-21-01', 'PHSD-Water', 'Public Health System Dev\'t.-Potable', 0),
(44, '13-001-03-00016-03-01-22', 'HEPO', 'Health Promotion', 0),
(45, '13-001-03-00016-03-01-24', 'HEMS', 'Health Emergency Management Services', 0),
(46, '13-001-03-00016-03-01-25', 'NVBSP', 'National Voluntary Blood Services Program and Operation of Blood Centers', 0),
(47, '13-001-03-00016-03-01-26', 'HF', 'Health Facility', 0),
(48, '13-001-03-00016-03-01-27', 'GAD', 'Gender and Development', 0),
(49, '13-001-03-00016-03-02', 'NCPAM', 'National Pharmaceutical Policy Development Including provision of Drugs and Medicines, Medical and Dental Supplies to make affordable quality drug available', 0),
(50, '13-001-03-00016-03-03', 'DTRC', 'Operation of Dangerous Drug Abuse Treatment and Rehabilitation Centers', 0),
(51, '13-001-03-00016-03-04', 'DTTB', 'Doctors to the Barrios', 0),
(52, '13-001-03-00016-03-05', 'ELIM', 'Elimination of Diseases-Malaria, Schisto, Leprosy, and Filaria', 0),
(53, '13-001-03-00016-03-06', 'RABIES', 'RABIES Control Program', 0),
(54, '13-001-03-00016-03-07', 'EPI', 'Expanded Program for Immunization', 0),
(55, '13-001-03-00016-03-08', 'TB', 'Tuberculosis Control Program', 0),
(56, '13-001-03-00016-03-09', 'Other InFECTIOUS', 'Other Infectious Disease Prevention and Control Program and Emerging and Re-emerging Diseases including HIV, AIDS, Dengue, Food, and Water Born Diseases', 0),
(57, '13-001-03-00016-03-10', 'NON-COM', 'Non-Communicable Diseases', 0),
(58, '13-001-03-00016-03-11', 'FAMILY HEALTH', 'Family Health Care Cluster', 0),
(59, '13-001-03-00016-03-11-01', 'CHILD', 'Child Injury', 0),
(60, '13-001-03-00016-03-11-02', 'AFP', 'Artificial Family Program', 0),
(61, '13-001-03-00016-03-11-03', 'NUTRITION', 'NUTRITION', 0),
(62, '13-001-03-00016-03-11-04', 'CHT', 'Community Heat Team', 0),
(63, '13-001-03-00016-03-11-05', 'MNCHN', 'Mother,Nutrition,Child Health', 0),
(64, '13-001-03-00016-03-11-06', 'NBS', 'Newborn System', 0),
(65, '13-001-03-00016-03-11-07', 'AYHDP', 'Adolescent Youth Health Development Program', 0),
(66, '13-001-03-00016-03-12', 'HFEP', 'Health Facility Enhancement Program', 0),
(67, '13-001-03-00016-04', 'HSRS', 'HEALTH SECTOR REGULATORY SERVICES', 0),
(68, '13-001-03-00016-04-01', 'RLED', 'Regulatory, Licensing and Enforcement Division', 0),
(69, '13-001-03-00016-04-01-01', 'LICENSING', 'Licensing', 0),
(70, '13-001-03-00016-04-01-02', 'FDA', 'Food and Regulatory', 0),
(71, '13-001-03-00016-04-02', 'DTRC', 'Drug Treatment and Rehabilitation Center', 0),
(72, '13-001-03-00016-04-02-01', 'TRC', 'Treatment Regulatory Center', 0),
(73, '13-001-03-00016-04-02-02', 'ACP', 'After Care', 0),
(74, '13-001-03-00016-04-03', 'HSPS', 'Health Sector Policy Services', 0),
(75, '13-001-03-00016-04-04', 'BIHC', 'Development Of Policies, Support Mechanisms, and Collaboration for International Health Cooperation', 0),
(76, '13-001-03-00016-04-05', 'HSDP', 'Health System Development Program including Policy Support', 0),
(77, '13-001-03-00016-04-06', 'NCHFD', 'Formulation of Policies, Standards, and Plans for Hospital and Other Health Facilities', 0),
(78, '13-001-03-00016-04-07', 'NCDPC', 'Public Health Development Program including Formulation and Public Health Policies and Quality Assurance', 0),
(79, '13-001-03-00016-04-08', 'HPDP', 'Health Policy Development including Essential National Health Research', 0),
(80, '13-001-03-00017-02-03-05', 'RECORDS', 'RECORDS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_supplier`
--

CREATE TABLE `ref_supplier` (
  `supplier_id` int NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ref_supplier`
--

INSERT INTO `ref_supplier` (`supplier_id`, `supplier`, `status`) VALUES
(0, 'Bal-Fwd', 0),
(1, 'Columbia Computer Center Inc.', 0),
(2, 'Dataworld Computer Center', 0),
(3, 'Tammy Emporium', 0),
(4, 'JMN MULTIMEDIA SALES AND SERVICES', 0),
(5, 'Datalan Communication Services', 0),
(6, 'Central Office', 0),
(7, 'Vocom Enterprises', 0),
(8, 'APTEX TEXTFILE PRINTING CORP', 0),
(9, 'HI-5 SIGNAGES FABRICATOR', 0),
(10, 'KIMSON COMMERCIAL', 0),
(11, 'BOKINGO GENERAL MDSE', 0),
(12, 'ROBUSTAN INCORPORATED', 0),
(13, 'BOSS EXPRESS PRINTING', 0),
(14, 'WIZARD IT SYSTEM CORP', 0),
(15, 'COMPAÑERO COMMERCIAL', 0),
(16, 'VILLA FIDELINA SHOPPING CENTER', 0),
(17, 'GY TRADING', 0),
(18, 'FILRAD CORPORATION', 0),
(19, 'Rinografix Printshop Enterprise', 0),
(20, 'SANDEES PRINT AND COMPUTER SALES', 0),
(21, 'KML GENERAL MERCHANDISE', 0),
(22, 'BIOSITE MEDICAL INSTRUMENTS', 0),
(23, 'FRANCO PHOTOSHOPPE AND ALLIED SERVICES', 0),
(24, 'STONEWORKS  SPECIALIST INTERNATIONAL CORP.', 0),
(25, 'Sungold Commercial', 0),
(27, 'K101 Pharma', 0),
(28, 'G-HOVEN I.T. SOLUTIONS', 0),
(29, 'Isomedical Ventures Inc.', 0),
(30, 'ROADWAY AUTO SUPPLY AND CAR ACCESSORIES', 0),
(31, 'Berovan Marketing Inc.', 0),
(32, 'Carewell Bio-Medical System Co', 0),
(33, 'Q & N Consumer Goods Trading', 0),
(34, 'Mckline Enterprises', 0),
(35, 'Exelmed Pharmatrade', 0),
(36, 'Alantech Enterprises And Services', 0),
(37, 'Libra Car Accessories And Services', 0),
(38, 'Bluedragon Pharmaceuticals', 0),
(39, 'Basvil Pharma', 0),
(40, 'JNK Medical Sales', 0),
(70, 'I Cool Refrigeration Services', 0),
(42, 'Inter-continental Food', 0),
(43, 'DJAR Trades', 0),
(44, 'Endure Medical Inc.', 0),
(45, 'Merk Trading', 0),
(46, 'Fast Tech Computer Parts and Accessories Shop', 0),
(47, 'GSP Enterprises', 0),
(48, 'Sheva Marketing', 0),
(49, 'Nutridense Food Manufacturing Corp.', 0),
(50, 'RDV Pharma', 0),
(51, 'Hi-Seas Pharmacy', 0),
(52, 'G-COR Pharmacy', 0),
(53, 'Medical Center Trading Corp.', 0),
(54, 'Phil. Pharmawealth ', 0),
(55, 'EEA Enterprise', 0),
(56, 'ANB Pharmaceuticals', 0),
(57, 'Colonie Enterprises', 0),
(58, 'Hospital Link', 0),
(59, 'Direct Access Pharmaceutical', 0),
(60, 'G Chem Trading', 0),
(61, 'Irvine True & Frank Carson Phils.', 0),
(62, 'Alog & Company', 0),
(63, 'Deskmark Corporation', 0),
(64, 'Allied Hospital Supply International', 0),
(65, 'Glorso Medica', 0),
(66, 'Krypton International Resources', 0),
(67, 'ANDJ Bright Printing Services', 0),
(68, 'Life Auto Supply & Hardware, Inc.', 0),
(69, 'NEP MINI TRADING', 0),
(71, 'Laserview Trading', 0),
(72, 'BROWNSTONE ASIA-TECH INC.', 0),
(73, 'TESDA CARAGA', 0),
(74, 'Recon Trading', 0),
(75, 'Firstline Pharma', 0),
(76, 'NEXGEN BIODEVICES', 0),
(77, 'MID-TOWN COMPUTERS AND SERVICES', 0),
(78, 'NOVARAE BIOTECH', 0),
(79, 'RUTAQUIO MEDICAL SUPPLIES', 0),
(80, 'AILE BIOLINE MARKETING', 0),
(81, 'CHEMVEST COMMERCIAL TRADING', 0),
(82, 'DOH- MANILA', 0),
(83, 'NEW MARKETLINK PHARMACEUTICAL CORP', 0),
(84, 'Inter-Continental Food and Pharmaceuticals Incorporated', 0),
(85, 'QUICKLINK CONSUMER GOODS TRADING', 0),
(86, 'Power On Enterprises Co.', 0),
(87, 'Philippine Duplicator Inc.', 0),
(88, 'LJ Cars Butuan Corporation', 0),
(89, 'Fast Autoworld Philippines Corporation', 0),
(90, 'Jasper Kissa Computer Center', 0),
(91, 'KABAYANS AUTO REPAIR SHOP', 0),
(92, 'Eco Wheels Car Accessories Marketing', 0),
(93, 'GUG ENTERPRISES', 0),
(94, 'Datan Shell Services Station', 0),
(95, 'GILMED ENTERPRISES AND SERVICES', 0),
(96, 'PRONET SYSTEMS INTEGRATED NETWORK SOLUTION INC.', 0),
(97, 'LUNARMED PHARMA TRADING', 0),
(98, 'PILIPINAS SHELL FOUNDATION', 0),
(99, 'JVM OFFICE AND SCHOOL SUPPLIES TRADING', 0),
(100, 'PBT TECHNOLOGY SOLUTIONS INC.', 0),
(101, 'SURE-FAST MED SOLUTIONS CO.', 0),
(102, 'UNICEF', 0),
(103, 'COVAX', 0),
(104, 'RESEARCH INSTITUTE FOR TROPICAL MEDICINE', 0),
(105, 'COREVISORY ENT. CO.', 0),
(106, 'ADULT DENTAL KITS', 0),
(107, 'ADULT DENTAL KITS', 0),
(108, 'BSU PRINTS AND GARMENTS', 0),
(109, 'DONATION: JANSSEN -US GOVERNMENT', 0),
(110, 'PHILIPPINE BUSINESS FOR SOCIAL PROGRESS', 0),
(111, 'IVAXX MARKETING CORPORATION', 0),
(112, 'MERCURY DRUG CORPORATION', 0),
(113, 'Mandaue Foam Industries Inc.', 0),
(114, 'J & M Shopping Center', 0),
(115, 'RIGHT PHARMA CORPORATION', 0),
(116, 'SAFETY THAT WORKS', 0),
(117, 'SAFETY CENTER COMPANY INC.', 0),
(118, 'COPYLANDIA OFFICE SYSTEMS CORPORATION', 0),
(119, 'DUC-Z PHARMACEUTICAL PRODUCTS TRADING', 0),
(120, 'LIGHT HORIZON MEDICAL SUPPLIES', 0),
(121, 'BUTUAN DIAGNOSTIC & MEDICAL CLINIC', 0),
(122, 'RMS TRADING', 0),
(123, '168 PARAGON INTERNATIONAL GENERAL CONTRACTOR & EQUIPTMENT', 0),
(124, 'OS1 SOLUTION INC.', 0),
(125, 'RADS ENTERPRISES', 0),
(126, 'The Potter\'s House By Chinyu', 0),
(127, 'PHOTOPRO TRADING AND GENERAL MERCHANDISE CO.', 0),
(128, 'RONWOOD CONSTRUCTION & SUPPLY', 0),
(129, 'RONWOOD CONSTRUCTION ', 0),
(130, 'LENLEN\'S MINIMART AND GENERAL MERCHANDISE', 0),
(131, 'A&M COMMERCIAL AND GENERAL MERCHANDISE', 0),
(132, 'FERBENCOM TECHNOLOGIES', 0),
(133, 'CANOMED CORPORATION', 0),
(134, 'UPDATED GLOBAL TECH HUB', 0),
(135, 'DYNAMED HEALTHCARE INCORPORATED', 0),
(136, 'AUTOMATION SPECIALISTS AND POWER EXPONENTS, INC.', 0),
(137, 'AG MEDICAL & DENTAL TRADING', 0),
(138, 'RC2 TRADING', 0),
(139, 'PREGNANCY TEST HCG TEST KITS', 0),
(140, 'KHRIZ PHARMA TRADING INC', 0),
(141, 'DRAKE MARKETING AND EQUIPMENT CORPORATION', 0),
(142, 'SN WIDEREACH MARKETING INC.', 0),
(143, 'ORO HIGH Q TRADING', 0),
(144, 'HARNWELL CHEMICALS CORPORATION', 0),
(145, 'FILDEN CARE ESSENTIALS', 0),
(146, 'SUNEXO INDUSTRIAL RESOURCES', 0),
(147, 'Megamight Enterprises', 0),
(148, '153 GENERIC PHARMACY', 0),
(149, 'RA ESSENTIALS MARKETING', 0),
(150, 'HEALTH MEDICAL SOLUTION INC.', 0),
(151, 'JAYPEES KWALITY KOMM CENTER', 0),
(152, 'LEVINS INTERNATIONAL CORPORATION', 0),
(153, 'RFY MARKETING', 0),
(154, 'MIDTOWN COMPUTERS AND SERVICES', 0),
(155, 'AEROTECH BIOLINE AND GENERAL MERCHANDISE', 0),
(156, 'RM DENTAL LABORATORY AND SUPPLY', 0),
(157, 'HEALTHSETH MEDICAL SOLUTIONS, INC', 0),
(158, 'SILICON VALLEY COMPUTER GROUP PHILS INC.', 0),
(159, 'LG SUPPLIES AND GENERAL MERCHANDISE', 0),
(160, 'SOLIDMARK INC.', 0),
(161, 'BUTUAN AIRCON AND REFRIGERATION PARTS AND SUPPLY', 0),
(162, 'DESMARK COPORATION', 0),
(163, 'JLAN GENERIC DRUG DISTRIBUTOR', 0),
(164, 'Z & Z PHARMAMED DISTRIBUTOR DRUGSTORE', 0),
(165, 'PRIMACURE DRUG AND MEDICAL EQUIPMENT SUPPLIES CO.', 0),
(166, 'HI-SEAS EXPRESS PHARMACY', 0),
(167, 'GODSWILL ENTERPRISE', 0),
(168, 'AXZILY CONSUMER GOODS TRADING', 0),
(169, 'FEDERAL PHARMACEUTICALS INC.', 0),
(170, 'EVERYDAY ENTERPRISES', 0),
(171, 'OLTEN INSTRUMENT PHILS. CORP', 0),
(172, 'SELICA AUTO GLASS SUPPLY', 0),
(173, 'LEOWILLIN ACTA PHARMA AND GENERAL MDSE', 0),
(174, 'NEW HLINK MEDICAL CORPORATION', 0),
(175, 'G-COR PHARMACY', 0),
(176, 'BUPIVACAINE 5ML', 0),
(177, 'JTL WELDING AND MUFFLER SHOP', 0),
(178, 'WORLD HEALTH ORGANIZATION', 0),
(179, 'RBGM MEDICAL EXPRESS SALES, INC.', 0),
(180, 'NEWBORN SCREENING CENTER-MINDANAO', 0),
(181, 'DUKE-R MEDICAL ENTERPRISE', 0),
(182, 'INTERNATIONAL ORGANIZATION FOR MIGRATION (IOM)', 0),
(183, 'CORELAB DIAGNOSTICS MEDICAL SUPPLIES', 0),
(184, 'MANILA AUTO CARE', 0),
(185, 'Harjens Trade Center', 0),
(186, 'BXU COPY TRADING & ENT. CORP.', 0),
(187, 'REDEMP MEDICAL SUPPLY', 0),
(188, 'CAGAYAN DE ORO MEDICAL SUPPLIES AND TRADING OPC', 0),
(189, 'SAVEYOUR HOME ENTERPRISES, INC.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_unit`
--

CREATE TABLE `ref_unit` (
  `unit_id` int NOT NULL,
  `unit` varchar(50) NOT NULL,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ref_unit`
--

INSERT INTO `ref_unit` (`unit_id`, `unit`, `status`) VALUES
(1, 'Unit', 0),
(2, 'Bottle', 0),
(3, 'Pcs', 0),
(4, 'Set', 0),
(5, 'tbl', 0),
(6, 'Book Bound', 0),
(7, 'Lot', 0),
(8, 'Tube', 0),
(9, 'Sachet', 0),
(10, 'Bar', 0),
(11, 'Bot', 0),
(12, 'Kits', 0),
(13, 'Van', 0),
(14, 'Box', 0),
(15, 'Spots', 0),
(16, 'Reams', 0),
(17, 'Liters', 0),
(18, 'Cylinders', 0),
(19, 'Toner', 0),
(20, 'Bundle', 0),
(21, 'Cart', 0),
(22, 'Package', 0),
(23, 'Video Clip', 0),
(24, 'Packs', 0),
(25, 'tps', 0),
(29, 'Pad', 0),
(30, 'Kls', 0),
(31, 'Can', 0),
(32, 'CTR', 0),
(33, 'KG', 0),
(34, 'Gal', 0),
(35, 'Rolls', 0),
(36, 'Envelope', 0),
(37, 'Sea Ambulance', 0),
(38, 'Sea Ambulance', 0),
(39, 'vials', 0),
(40, 'ampule', 0),
(41, 'tablets', 0),
(56, 'Labor', 0),
(55, 'test', 0),
(44, 'Amoxicillin 100mg/ml drops 15ml', 0),
(45, 'capsule', 0),
(46, 'cycles', 0),
(47, 'inhalers', 0),
(48, 'nebule', 0),
(49, 'treatment pack', 0),
(54, 'tray', 0),
(53, 'Meter', 0),
(52, 'racks', 0),
(57, 'ltrs', 0),
(58, 'dozen', 0),
(59, 'pairs', 0),
(60, 'CARTON', 0),
(61, 'SWAB', 0),
(62, '0.3ML A.D SYRINGE (MEDECO) INJECT 3000PCS/CARTON', 0),
(63, 'CU.M.', 0),
(64, 'CENTER TABLE', 0),
(65, 'blister pack', 0),
(66, 'Level 3 PPE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_warehouse`
--

CREATE TABLE `ref_warehouse` (
  `warehouse_id` int NOT NULL,
  `warehouse_name` varchar(50) NOT NULL,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_iar`
--

CREATE TABLE `tbl_iar` (
  `iar_id` int NOT NULL,
  `entity_name` varchar(180) NOT NULL,
  `fund_cluster` varchar(100) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `iar_number` varchar(40) NOT NULL,
  `iar_type` varchar(50) NOT NULL,
  `req_office` varchar(50) NOT NULL,
  `res_cc` varchar(60) NOT NULL,
  `charge_invoice` varchar(50) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `date_inspected` date NOT NULL,
  `inspector` text NOT NULL,
  `inspector_designation` text NOT NULL,
  `inspected` int NOT NULL,
  `date_received` date NOT NULL,
  `property_custodian` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL,
  `partial_specify` varchar(5) NOT NULL,
  `view_iar` varchar(100) NOT NULL,
  `spvs` varchar(200) NOT NULL,
  `spvs_designation` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ics`
--

CREATE TABLE `tbl_ics` (
  `ics_id` int NOT NULL,
  `ics_no` varchar(30) NOT NULL,
  `entity_name` varchar(255) NOT NULL,
  `fund_cluster` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `item` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `unit` varchar(30) NOT NULL,
  `supplier` varchar(80) NOT NULL,
  `serial_no` text NOT NULL,
  `category` varchar(80) NOT NULL,
  `property_no` text NOT NULL,
  `quantity` int NOT NULL,
  `cost` double(10,3) NOT NULL,
  `total` double(10,3) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `received_from` varchar(80) NOT NULL,
  `received_from_designation` varchar(50) NOT NULL,
  `received_by` varchar(80) NOT NULL,
  `received_by_designation` varchar(255) NOT NULL,
  `date_released` datetime NOT NULL,
  `date_supply_received` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `area` varchar(80) NOT NULL,
  `issued` int NOT NULL,
  `view_ics` varchar(100) NOT NULL,
  `po_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `logs_id` int NOT NULL,
  `emp_id` int NOT NULL,
  `description` text NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_par`
--

CREATE TABLE `tbl_par` (
  `par_id` int NOT NULL,
  `par_no` varchar(30) NOT NULL,
  `entity_name` varchar(255) NOT NULL,
  `fund_cluster` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `item` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `unit` varchar(30) NOT NULL,
  `supplier` varchar(80) NOT NULL,
  `serial_no` text NOT NULL,
  `category` varchar(80) NOT NULL,
  `property_no` text NOT NULL,
  `quantity` int NOT NULL,
  `cost` double(10,3) NOT NULL,
  `total` double(10,3) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `received_from` varchar(80) NOT NULL,
  `received_from_designation` varchar(50) NOT NULL,
  `received_by` varchar(80) NOT NULL,
  `received_by_designation` varchar(255) NOT NULL,
  `date_released` datetime NOT NULL,
  `date_supply_received` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `area` varchar(80) NOT NULL,
  `issued` int NOT NULL,
  `view_par` varchar(100) NOT NULL,
  `po_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_po`
--

CREATE TABLE `tbl_po` (
  `po_id` int NOT NULL,
  `po_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `procurement_mode` varchar(50) NOT NULL,
  `date_received` datetime DEFAULT NULL,
  `delivery_term` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `payment_term` varchar(50) NOT NULL,
  `pr_no` varchar(50) NOT NULL,
  `reso_no` varchar(50) NOT NULL,
  `abstract_no` varchar(50) NOT NULL,
  `supplier_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(150) NOT NULL,
  `unit_cost` double(10,3) NOT NULL,
  `sn_ln` varchar(255) NOT NULL,
  `exp_date` date NOT NULL,
  `inspection_status` int NOT NULL,
  `iar_no` varchar(50) NOT NULL,
  `main_stocks` int NOT NULL,
  `quantity` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `end_user` varchar(80) NOT NULL,
  `date_conformed` date NOT NULL,
  `date_delivered` date NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `date_filed` date NOT NULL,
  `control_number` date NOT NULL,
  `activity_title` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `coordinator_id` int NOT NULL,
  `activity_date` date NOT NULL,
  `caterer_id` int NOT NULL,
  `ntc_amount` double(10,2) NOT NULL,
  `po_amount` double(10,2) NOT NULL,
  `supply_received` date NOT NULL,
  `supply_processed` date NOT NULL,
  `finance_forwarded` date NOT NULL,
  `accountant_forwarded` date NOT NULL,
  `ntc_balance` double(10,2) NOT NULL,
  `actual_amount` double(10,2) NOT NULL,
  `remarks` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `po_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `view_po` varchar(255) NOT NULL,
  `entry_type` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ppe`
--

CREATE TABLE `tbl_ppe` (
  `id` int NOT NULL,
  `date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `program` varchar(255) NOT NULL,
  `particular` varchar(255) NOT NULL,
  `par_ptr_reference` varchar(255) NOT NULL,
  `qty` int NOT NULL,
  `unit` varchar(40) NOT NULL,
  `unit_cost` double(10,2) NOT NULL,
  `total_cost` double(10,2) NOT NULL,
  `account_code` varchar(50) NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `type` varchar(5) NOT NULL,
  `control_no` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ptr`
--

CREATE TABLE `tbl_ptr` (
  `ptr_id` int NOT NULL,
  `ptr_no` varchar(30) NOT NULL,
  `entity_name` varchar(255) NOT NULL,
  `fund_cluster` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `transfer_type` varchar(100) NOT NULL,
  `date_delivered` date NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `item` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `stock` int NOT NULL,
  `unit` varchar(30) NOT NULL,
  `supplier` varchar(150) NOT NULL,
  `serial_no` text NOT NULL,
  `exp_date` date NOT NULL,
  `category` varchar(100) NOT NULL,
  `property_no` text NOT NULL,
  `quantity` int NOT NULL,
  `cost` double(10,3) NOT NULL,
  `total` double(10,3) NOT NULL,
  `conditions` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `approved_by` varchar(100) NOT NULL,
  `approved_by_designation` varchar(75) NOT NULL,
  `received_from` varchar(100) NOT NULL,
  `received_from_designation` varchar(75) NOT NULL,
  `date_released` datetime NOT NULL,
  `date_supply_received` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `area` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `issued` int NOT NULL,
  `view_ptr` varchar(100) NOT NULL,
  `alloc_num` varchar(100) NOT NULL,
  `storage_temp` varchar(100) NOT NULL,
  `transport_temp` varchar(100) NOT NULL,
  `po_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ris`
--

CREATE TABLE `tbl_ris` (
  `ris_id` int NOT NULL,
  `ris_no` varchar(50) NOT NULL,
  `entity_name` varchar(80) NOT NULL,
  `fund_cluster` varchar(50) NOT NULL,
  `division` varchar(150) NOT NULL,
  `office` varchar(150) NOT NULL,
  `rcc` varchar(150) NOT NULL,
  `item` varchar(255) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(150) NOT NULL,
  `quantity` int NOT NULL,
  `unit_cost` double(11,3) NOT NULL,
  `total` double(11,3) NOT NULL,
  `available` int NOT NULL,
  `quantity_stocks` int NOT NULL,
  `remarks` varchar(80) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `purpose` varchar(150) NOT NULL,
  `requested_by` varchar(80) NOT NULL,
  `requested_by_designation` varchar(80) NOT NULL,
  `issued_by` varchar(80) NOT NULL,
  `issued_by_designation` varchar(80) NOT NULL,
  `approved_by` varchar(80) NOT NULL,
  `approved_by_designation` varchar(80) NOT NULL,
  `issued` int NOT NULL,
  `date` datetime NOT NULL,
  `date_received` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `view_ris` varchar(100) NOT NULL,
  `supplier` varchar(200) NOT NULL,
  `lot_no` varchar(10) NOT NULL,
  `exp_date` varchar(20) NOT NULL,
  `po_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rsmi`
--

CREATE TABLE `tbl_rsmi` (
  `id` int NOT NULL,
  `date_released` datetime NOT NULL,
  `control_no` varchar(20) NOT NULL,
  `rcc` varchar(50) NOT NULL,
  `account_code` varchar(50) NOT NULL,
  `item` text NOT NULL,
  `unit` varchar(30) NOT NULL,
  `quantity` int NOT NULL,
  `recipients` varchar(200) NOT NULL,
  `unit_cost` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sai`
--

CREATE TABLE `tbl_sai` (
  `id` int NOT NULL,
  `sai_no` varchar(50) NOT NULL,
  `pr_code` varchar(50) NOT NULL,
  `division` varchar(100) NOT NULL,
  `office` varchar(100) NOT NULL,
  `purpose` text NOT NULL,
  `inquired_by` varchar(100) NOT NULL,
  `inquired_by_designation` varchar(100) NOT NULL,
  `wfp_code` varchar(50) NOT NULL,
  `wfp_act` varchar(100) NOT NULL,
  `item_description` text NOT NULL,
  `unit` varchar(50) NOT NULL,
  `quantity` int NOT NULL,
  `stock_status` varchar(50) NOT NULL,
  `pr_details_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_serial`
--

CREATE TABLE `tbl_serial` (
  `serial_id` int NOT NULL,
  `inventory_id` int NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `is_issued` varchar(1) NOT NULL DEFAULT 'N',
  `date_waste` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stockcard`
--

CREATE TABLE `tbl_stockcard` (
  `id` int NOT NULL,
  `date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `quantity` int NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `po_ref` varchar(50) NOT NULL,
  `office` varchar(100) NOT NULL,
  `remarks` varchar(80) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_area`
--
ALTER TABLE `ref_area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `ref_category`
--
ALTER TABLE `ref_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `ref_caterer`
--
ALTER TABLE `ref_caterer`
  ADD PRIMARY KEY (`caterer_id`);

--
-- Indexes for table `ref_item`
--
ALTER TABLE `ref_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `ref_lastpn`
--
ALTER TABLE `ref_lastpn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_ntc`
--
ALTER TABLE `ref_ntc`
  ADD PRIMARY KEY (`ntc_id`);

--
-- Indexes for table `ref_rcc`
--
ALTER TABLE `ref_rcc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_supplier`
--
ALTER TABLE `ref_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `ref_unit`
--
ALTER TABLE `ref_unit`
  ADD PRIMARY KEY (`unit_id`) USING BTREE;

--
-- Indexes for table `ref_warehouse`
--
ALTER TABLE `ref_warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- Indexes for table `tbl_iar`
--
ALTER TABLE `tbl_iar`
  ADD PRIMARY KEY (`iar_id`);

--
-- Indexes for table `tbl_ics`
--
ALTER TABLE `tbl_ics`
  ADD PRIMARY KEY (`ics_id`) USING BTREE;

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`logs_id`) USING BTREE;

--
-- Indexes for table `tbl_par`
--
ALTER TABLE `tbl_par`
  ADD PRIMARY KEY (`par_id`) USING BTREE;

--
-- Indexes for table `tbl_po`
--
ALTER TABLE `tbl_po`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `tbl_ppe`
--
ALTER TABLE `tbl_ppe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ptr`
--
ALTER TABLE `tbl_ptr`
  ADD PRIMARY KEY (`ptr_id`) USING BTREE;

--
-- Indexes for table `tbl_ris`
--
ALTER TABLE `tbl_ris`
  ADD PRIMARY KEY (`ris_id`);

--
-- Indexes for table `tbl_rsmi`
--
ALTER TABLE `tbl_rsmi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sai`
--
ALTER TABLE `tbl_sai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_serial`
--
ALTER TABLE `tbl_serial`
  ADD PRIMARY KEY (`serial_id`) USING BTREE;

--
-- Indexes for table `tbl_stockcard`
--
ALTER TABLE `tbl_stockcard`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_area`
--
ALTER TABLE `ref_area`
  MODIFY `area_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `ref_category`
--
ALTER TABLE `ref_category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ref_caterer`
--
ALTER TABLE `ref_caterer`
  MODIFY `caterer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_item`
--
ALTER TABLE `ref_item`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1645;

--
-- AUTO_INCREMENT for table `ref_lastpn`
--
ALTER TABLE `ref_lastpn`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ref_ntc`
--
ALTER TABLE `ref_ntc`
  MODIFY `ntc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_rcc`
--
ALTER TABLE `ref_rcc`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `ref_supplier`
--
ALTER TABLE `ref_supplier`
  MODIFY `supplier_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `ref_unit`
--
ALTER TABLE `ref_unit`
  MODIFY `unit_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `ref_warehouse`
--
ALTER TABLE `ref_warehouse`
  MODIFY `warehouse_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_iar`
--
ALTER TABLE `tbl_iar`
  MODIFY `iar_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ics`
--
ALTER TABLE `tbl_ics`
  MODIFY `ics_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `logs_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_par`
--
ALTER TABLE `tbl_par`
  MODIFY `par_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_po`
--
ALTER TABLE `tbl_po`
  MODIFY `po_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ppe`
--
ALTER TABLE `tbl_ppe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ptr`
--
ALTER TABLE `tbl_ptr`
  MODIFY `ptr_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ris`
--
ALTER TABLE `tbl_ris`
  MODIFY `ris_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rsmi`
--
ALTER TABLE `tbl_rsmi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sai`
--
ALTER TABLE `tbl_sai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_serial`
--
ALTER TABLE `tbl_serial`
  MODIFY `serial_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_stockcard`
--
ALTER TABLE `tbl_stockcard`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
