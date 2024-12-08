-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2024 at 11:43 PM
-- Server version: 10.6.20-MariaDB-cll-lve
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_loker`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant_profiles`
--

CREATE TABLE `applicant_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `education` text NOT NULL,
  `experience` text NOT NULL,
  `skills` text NOT NULL,
  `resume` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicant_profiles`
--

INSERT INTO `applicant_profiles` (`id`, `uuid`, `user_id`, `full_name`, `date_of_birth`, `phone_number`, `address`, `education`, `experience`, `skills`, `resume`, `image`, `created_at`, `updated_at`) VALUES
(1, 'eb09de40-0423-467b-963e-90eb7d3757d3', 1, 'Muhammad Faiz', '1945-01-30', '968', 'Laudantium libero d', 'Qui nobis maxime aut', 'Ea numquam eum moles', 'Debitis quidem eos a', 'resumes/5Y1ICZ7gvORUM5Xai56mYQOiBK16d5yzFATrHPB7.pdf', 'images/ra2XYaMpzBQ3k6Bj80IJu2QOYJLvIBzZBzvy6k6g.jpg', '2024-11-25 14:10:37', '2024-11-25 14:10:37'),
(2, '0febe3e8-cb52-4e00-ba27-01b2a285d949', 3, 'Vod Voldigoad', '1995-11-26', '5345345', 'bednerne', 'rgnetnrtn', 'thrbeee', 'btherhethe', 'resumes/LeSGide00MMthcOHqWCg394ezho3oF7ATJqS2TvO.pdf', 'images/VITei3hmoQkdL4YbM9cZRgpEjUmauUeo269Cazki.png', '2024-11-25 14:16:46', '2024-11-25 14:16:46'),
(3, 'b4fd74b9-9faf-402d-9130-bd0b332fa455', 2, 'Shilfaa Shaphiera', '2000-06-27', '089238238323', 'Jauh banget', 'S1', 'Ga ada', 'GA ADA JUGA', 'resumes/fhF7tFOjivmbjSCjpk4UATAvQ1sStX9pJ86y62da.pdf', 'images/28K8AV6SXRhSpEXGfSXVFGkuajfeiTxkpNJh7Etm.png', '2024-12-04 09:43:40', '2024-12-04 10:03:17'),
(5, 'e7d65c4a-c882-45a8-ab1a-ec16fb06c19c', 5, 'Rama Haddaf Syachriza', '2002-02-04', '123456789', 'bintara', 'smk', 'banyak', 'banyak', 'resumes/Y9i61iN3LxwWe6yyF4jadNbqcKIiiylfiNpu0Tqi.pdf', 'images/5f0oOg7CkWqHs1dakHpQrg5BUE6L3Bmadu3QZu2I.jpg', '2024-12-04 13:06:59', '2024-12-04 13:06:59'),
(6, '5ba9c2cf-9a20-4e31-a040-3b79defad22a', 6, 'Anantha Marcellino Hidayat', '2003-03-12', '08999391798', 'Perum. Surya Mandala, Bekasi, Jawa barat', 'S1', 'PKL di PT.Windu Dasa Agung, Magang di program Bangkit', 'node.js, Cloud Computing, python', 'resumes/ezzYXFcggdtsEqIsofGdDcGjZE1ZfVHpQK2KTMZJ.pdf', 'images/cGkdinzHxznBrj9R4kAoWo6fuS3AMWttAQ5BllJN.jpg', '2024-12-06 22:05:29', '2024-12-06 22:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `jobdesc_id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','reviewed','accepted','rejected') NOT NULL DEFAULT 'pending',
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `uuid`, `jobdesc_id`, `applicant_id`, `status`, `date`, `created_at`, `updated_at`) VALUES
(9, '2ca8645e-14ac-47fd-a59e-710b9c3d9fdf', 3, 3, 'accepted', '2024-12-04', '2024-12-04 09:37:04', '2024-12-04 09:38:08'),
(10, 'da64df39-f2ac-4720-aa89-79286a09bada', 2, 5, 'accepted', '2024-12-05', '2024-12-04 13:07:10', '2024-12-07 10:27:57'),
(12, 'd53724c4-2b08-4ff8-b2e5-4a89954adcbd', 4, 6, 'accepted', '2024-12-07', '2024-12-06 22:16:01', '2024-12-06 23:36:17'),
(14, '3897a0ff-56e1-475e-89a2-9f15681c3c92', 3, 2, 'accepted', '2024-12-08', '2024-12-08 07:44:06', '2024-12-08 07:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('anontester69@gmail.com|2001:448a:2016:5145:f15b:c6d8:ba96:93f3', 'i:1;', 1733389491),
('anontester69@gmail.com|2001:448a:2016:5145:f15b:c6d8:ba96:93f3:timer', 'i:1733389491;', 1733389491),
('cleora99@ifastnet1.com|198.44.131.133', 'i:1;', 1733355428),
('cleora99@ifastnet1.com|198.44.131.133:timer', 'i:1733355428;', 1733355428),
('coba123@gmail.com|103.3.220.93', 'i:1;', 1733545586),
('coba123@gmail.com|103.3.220.93:timer', 'i:1733545586;', 1733545586),
('feifeyfry@gmail.com|2001:448a:2016:5145:107f:316e:9638:2e40', 'i:1;', 1733336038),
('feifeyfry@gmail.com|2001:448a:2016:5145:107f:316e:9638:2e40:timer', 'i:1733336038;', 1733336038),
('ip_location_103.3.220.93', 'O:29:\"Stevebauman\\Location\\Position\":16:{s:2:\"ip\";s:12:\"103.3.220.93\";s:6:\"driver\";s:34:\"Stevebauman\\Location\\Drivers\\IpApi\";s:11:\"countryName\";s:9:\"Indonesia\";s:12:\"currencyCode\";s:3:\"IDR\";s:11:\"countryCode\";s:2:\"ID\";s:10:\"regionCode\";s:2:\"YO\";s:10:\"regionName\";s:10:\"Yogyakarta\";s:8:\"cityName\";s:11:\"Gamping Lor\";s:7:\"zipCode\";s:0:\"\";s:7:\"isoCode\";N;s:10:\"postalCode\";N;s:8:\"latitude\";s:8:\"-7.79556\";s:9:\"longitude\";s:7:\"110.326\";s:9:\"metroCode\";N;s:8:\"areaCode\";s:2:\"YO\";s:8:\"timezone\";s:12:\"Asia/Jakarta\";}', 1733549057),
('ip_location_103.78.115.235', 'O:29:\"Stevebauman\\Location\\Position\":16:{s:2:\"ip\";s:14:\"103.78.115.235\";s:6:\"driver\";s:34:\"Stevebauman\\Location\\Drivers\\IpApi\";s:11:\"countryName\";s:9:\"Indonesia\";s:12:\"currencyCode\";s:3:\"IDR\";s:11:\"countryCode\";s:2:\"ID\";s:10:\"regionCode\";s:2:\"JK\";s:10:\"regionName\";s:7:\"Jakarta\";s:8:\"cityName\";s:7:\"Jakarta\";s:7:\"zipCode\";s:5:\"11730\";s:7:\"isoCode\";N;s:10:\"postalCode\";N;s:8:\"latitude\";s:7:\"-6.2056\";s:9:\"longitude\";s:8:\"106.8376\";s:9:\"metroCode\";N;s:8:\"areaCode\";s:2:\"JK\";s:8:\"timezone\";s:12:\"Asia/Jakarta\";}', 1733590281),
('ip_location_127.0.0.1', 'b:0;', 1732617794),
('ip_location_2001:448a:2016:5042:31b6:483d:c5ee:d134', 'O:29:\"Stevebauman\\Location\\Position\":16:{s:2:\"ip\";s:39:\"2001:448a:2016:5042:31b6:483d:c5ee:d134\";s:6:\"driver\";s:34:\"Stevebauman\\Location\\Drivers\\IpApi\";s:11:\"countryName\";s:9:\"Indonesia\";s:12:\"currencyCode\";s:3:\"IDR\";s:11:\"countryCode\";s:2:\"ID\";s:10:\"regionCode\";s:2:\"JK\";s:10:\"regionName\";s:7:\"Jakarta\";s:8:\"cityName\";s:7:\"Jakarta\";s:7:\"zipCode\";s:5:\"11730\";s:7:\"isoCode\";N;s:10:\"postalCode\";N;s:8:\"latitude\";s:7:\"-6.2056\";s:9:\"longitude\";s:8:\"106.8376\";s:9:\"metroCode\";N;s:8:\"areaCode\";s:2:\"JK\";s:8:\"timezone\";s:12:\"Asia/Jakarta\";}', 1733670350),
('ip_location_2001:448a:2016:5145:107f:316e:9638:2e40', 'O:29:\"Stevebauman\\Location\\Position\":16:{s:2:\"ip\";s:39:\"2001:448a:2016:5145:107f:316e:9638:2e40\";s:6:\"driver\";s:34:\"Stevebauman\\Location\\Drivers\\IpApi\";s:11:\"countryName\";s:9:\"Indonesia\";s:12:\"currencyCode\";s:3:\"IDR\";s:11:\"countryCode\";s:2:\"ID\";s:10:\"regionCode\";s:2:\"JK\";s:10:\"regionName\";s:7:\"Jakarta\";s:8:\"cityName\";s:7:\"Jakarta\";s:7:\"zipCode\";s:5:\"11730\";s:7:\"isoCode\";N;s:10:\"postalCode\";N;s:8:\"latitude\";s:7:\"-6.2056\";s:9:\"longitude\";s:8:\"106.8376\";s:9:\"metroCode\";N;s:8:\"areaCode\";s:2:\"JK\";s:8:\"timezone\";s:12:\"Asia/Jakarta\";}', 1733339016),
('ip_location_2001:448a:2016:5145:92fb:ce9a:e0e3:cfee', 'O:29:\"Stevebauman\\Location\\Position\":16:{s:2:\"ip\";s:39:\"2001:448a:2016:5145:92fb:ce9a:e0e3:cfee\";s:6:\"driver\";s:34:\"Stevebauman\\Location\\Drivers\\IpApi\";s:11:\"countryName\";s:9:\"Indonesia\";s:12:\"currencyCode\";s:3:\"IDR\";s:11:\"countryCode\";s:2:\"ID\";s:10:\"regionCode\";s:2:\"JK\";s:10:\"regionName\";s:7:\"Jakarta\";s:8:\"cityName\";s:7:\"Jakarta\";s:7:\"zipCode\";s:5:\"11730\";s:7:\"isoCode\";N;s:10:\"postalCode\";N;s:8:\"latitude\";s:7:\"-6.2056\";s:9:\"longitude\";s:8:\"106.8376\";s:9:\"metroCode\";N;s:8:\"areaCode\";s:2:\"JK\";s:8:\"timezone\";s:12:\"Asia/Jakarta\";}', 1733361984),
('isobel72@hotmail.com|192.158.226.23', 'i:3;', 1733351125),
('isobel72@hotmail.com|192.158.226.23:timer', 'i:1733351125;', 1733351125),
('isobel72@hotmail.com|198.44.131.133', 'i:2;', 1733355431),
('isobel72@hotmail.com|198.44.131.133:timer', 'i:1733355431;', 1733355431),
('isobel72@hotmail.com|2604:a880:400:d0::1df1:4001', 'i:3;', 1733351202),
('isobel72@hotmail.com|2604:a880:400:d0::1df1:4001:timer', 'i:1733351202;', 1733351202),
('janet1@ifastnet1.com|192.158.226.23', 'i:1;', 1733351120),
('janet1@ifastnet1.com|192.158.226.23:timer', 'i:1733351120;', 1733351120),
('parkercatherine622@gmail.com|192.158.226.23', 'i:1;', 1733351128),
('parkercatherine622@gmail.com|192.158.226.23:timer', 'i:1733351128;', 1733351128),
('parkercatherine622@gmail.com|198.44.131.133', 'i:2;', 1733355434),
('parkercatherine622@gmail.com|198.44.131.133:timer', 'i:1733355434;', 1733355434),
('parkercatherine622@gmail.com|2604:a880:400:d0::1df1:4001', 'i:1;', 1733351205),
('parkercatherine622@gmail.com|2604:a880:400:d0::1df1:4001:timer', 'i:1733351205;', 1733351205),
('rama@example.com|103.78.115.235', 'i:1;', 1733589965),
('rama@example.com|103.78.115.235:timer', 'i:1733589965;', 1733589965),
('rama@gmail.com|103.78.115.235', 'i:1;', 1733589972),
('rama@gmail.com|103.78.115.235:timer', 'i:1733589972;', 1733589972),
('rzayn127@gmail.com|103.78.115.235', 'i:2;', 1733589951),
('rzayn127@gmail.com|103.78.115.235:timer', 'i:1733589951;', 1733589951),
('thaddeus74@ifastnet1.com|2604:a880:400:d0::1df1:4001', 'i:1;', 1733351199),
('thaddeus74@ifastnet1.com|2604:a880:400:d0::1df1:4001:timer', 'i:1733351199;', 1733351199),
('user_info_103.3.220.93_85HcfyUYoiPn7mPYkH5i8C8fc12E8e34LZYlNtth', 'a:8:{s:10:\"ip_address\";s:12:\"103.3.220.93\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:11:\"Gamping Lor\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:36:\"https://loker.vespertine.my.id/login\";}', 1733548582),
('user_info_103.3.220.93_C6Slr5KQcuGup7I6tgt5QzrkTHiaGlhMNO4Q1dOP', 'a:8:{s:10:\"ip_address\";s:12:\"103.3.220.93\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:11:\"Gamping Lor\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:44:\"https://loker.vespertine.my.id/panel/profile\";}', 1733548355),
('user_info_103.3.220.93_r3LCxzreIdf4gIVe1BBHXybe45VyKAxI2ZNyuDlh', 'a:8:{s:10:\"ip_address\";s:12:\"103.3.220.93\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:11:\"Gamping Lor\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:31:\"https://loker.vespertine.my.id/\";}', 1733548618),
('user_info_103.3.220.93_W4lcVD48lKShAo8emcwxrJxQXgh0XfOnM3TOJMki', 'a:8:{s:10:\"ip_address\";s:12:\"103.3.220.93\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:11:\"Gamping Lor\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:46:\"https://loker.vespertine.my.id/panel/interview\";}', 1733548866),
('user_info_103.78.115.235_G67dLc5rsFvm3ZG2H6XWwOmVeHxI9LFZfYM12uL7', 'a:8:{s:10:\"ip_address\";s:14:\"103.78.115.235\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:36:\"https://loker.vespertine.my.id/login\";}', 1733589981),
('user_info_103.78.115.235_jFnZbOZGJ6wA1gz3tZ05gcZmPkXTu9AsdyQNXl9S', 'a:8:{s:10:\"ip_address\";s:14:\"103.78.115.235\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:41:\"https://loker.vespertine.my.id/panel/list\";}', 1733342902),
('user_info_127.0.0.1_aU6iCMsdIXwIX3JkZpKLnpq7b5fsn6WHluLKThVB', 'a:8:{s:10:\"ip_address\";s:9:\"127.0.0.1\";s:7:\"country\";s:7:\"Unknown\";s:4:\"city\";s:7:\"Unknown\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:41:\"http://127.0.0.1:8000/panel/notifications\";}', 1732573687),
('user_info_127.0.0.1_N35tLyYfHtNxn7AlBIJcAMvtSfPY4OZvtoiCv7ZK', 'a:8:{s:10:\"ip_address\";s:9:\"127.0.0.1\";s:7:\"country\";s:7:\"Unknown\";s:4:\"city\";s:7:\"Unknown\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:41:\"http://127.0.0.1:8000/panel/notifications\";}', 1732572837),
('user_info_127.0.0.1_SZ6xZdqEa5jWRiPTguqQi9OAtIiK3lkoVcTTybwk', 'a:8:{s:10:\"ip_address\";s:9:\"127.0.0.1\";s:7:\"country\";s:7:\"Unknown\";s:4:\"city\";s:7:\"Unknown\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:32:\"http://127.0.0.1:8000/panel/list\";}', 1732574105),
('user_info_127.0.0.1_vzt0uZhiliHx2yKEUzeP5XuTIElS1kXE2rK2wfA1', 'a:8:{s:10:\"ip_address\";s:9:\"127.0.0.1\";s:7:\"country\";s:7:\"Unknown\";s:4:\"city\";s:7:\"Unknown\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:22:\"http://127.0.0.1:8000/\";}', 1732617494),
('user_info_2001:448a:2016:5042:31b6:483d:c5ee:d134_Juo75a2axP2u4ZnL5jJ5FpDXSr4ncoqt3IGLYBoV', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5042:31b6:483d:c5ee:d134\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:83:\"https://loker.vespertine.my.id/panel/interview/cb5bde2a-b536-459a-8117-89f08ac46cbb\";}', 1733670050),
('user_info_2001:448a:2016:5145:107f:316e:9638:2e40_AghtgOV5cqvjZtYUQFF0Fsuk7ZGXnhcwBUOwBVHy', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:107f:316e:9638:2e40\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:36:\"https://loker.vespertine.my.id/login\";}', 1733338716),
('user_info_2001:448a:2016:5145:107f:316e:9638:2e40_H8F61cT003jcdxciH2NjstY4hWXMqQlo4HMbfkvA', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:107f:316e:9638:2e40\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:36:\"https://loker.vespertine.my.id/login\";}', 1733336403),
('user_info_2001:448a:2016:5145:107f:316e:9638:2e40_HsYtZm8Tyz4LIdOFHKoaMh1PoybivTCJmkPWa7ZJ', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:107f:316e:9638:2e40\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:46:\"https://loker.vespertine.my.id/panel/interview\";}', 1733332194),
('user_info_2001:448a:2016:5145:107f:316e:9638:2e40_P7XUh3p4lxFr84fQ7qX02a3wIbzTRSyVMxiEpeJz', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:107f:316e:9638:2e40\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:41:\"https://loker.vespertine.my.id/panel/list\";}', 1733332178),
('user_info_2001:448a:2016:5145:107f:316e:9638:2e40_xWmNbRk6NGTLkJH3dPFukbkNV7DaOITUkMaioV8c', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:107f:316e:9638:2e40\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:31:\"https://loker.vespertine.my.id/\";}', 1733336048),
('user_info_2001:448a:2016:5145:107f:316e:9638:2e40_YbJbgPOFbkTPtj8l0UB2wrjaksw5tbuPk2Vx1cSt', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:107f:316e:9638:2e40\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:31:\"https://loker.vespertine.my.id/\";}', 1733336654),
('user_info_2001:448a:2016:5145:107f:316e:9638:2e40_YD9FU573tHMx9J6NXscCG1EZankKB3EZjRtIhD8t', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:107f:316e:9638:2e40\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"Windows 10.0\";s:11:\"device_type\";s:7:\"Desktop\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36\";s:8:\"referrer\";s:36:\"https://loker.vespertine.my.id/login\";}', 1733338823),
('user_info_2001:448a:2016:5145:92fb:ce9a:e0e3:cfee_gGzGPT5nVaaozIQ7D2PJD2ee4FniDnvwjQAFBUNf', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:92fb:ce9a:e0e3:cfee\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:16:\"Chrome 131.0.0.0\";s:8:\"platform\";s:12:\"AndroidOS 10\";s:11:\"device_type\";s:6:\"Mobile\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36\";s:8:\"referrer\";s:83:\"https://loker.vespertine.my.id/panel/interview/623fd55b-ed15-4879-a43f-10d4e7e8f091\";}', 1733360770),
('user_info_2001:448a:2016:5145:92fb:ce9a:e0e3:cfee_lbkzVq0Xk3si5K3CepvH1rWATCkQsk7qbap9UaaZ', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:92fb:ce9a:e0e3:cfee\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:21:\"Chrome 130.0.6723.108\";s:8:\"platform\";s:12:\"AndroidOS 14\";s:11:\"device_type\";s:6:\"Mobile\";s:10:\"user_agent\";s:142:\"Mozilla/5.0 (Linux; Android 14; V2231 Build/UP1A.231005.007) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.6723.108 Mobile Safari/537.36\";s:8:\"referrer\";s:46:\"https://loker.vespertine.my.id/panel/interview\";}', 1733361786),
('user_info_2001:448a:2016:5145:92fb:ce9a:e0e3:cfee_TQkWyqWD5srkEASIiySuPZ5QLyWDbEnGFfKRD7zG', 'a:8:{s:10:\"ip_address\";s:39:\"2001:448a:2016:5145:92fb:ce9a:e0e3:cfee\";s:7:\"country\";s:9:\"Indonesia\";s:4:\"city\";s:7:\"Jakarta\";s:7:\"browser\";s:21:\"Chrome 130.0.6723.108\";s:8:\"platform\";s:12:\"AndroidOS 14\";s:11:\"device_type\";s:6:\"Mobile\";s:10:\"user_agent\";s:142:\"Mozilla/5.0 (Linux; Android 14; V2231 Build/UP1A.231005.007) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.6723.108 Mobile Safari/537.36\";s:8:\"referrer\";s:31:\"https://loker.vespertine.my.id/\";}', 1733361867),
('user_lamaran_2', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:18:\"App\\Models\\Lamaran\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"applications\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:14;s:4:\"uuid\";s:36:\"3897a0ff-56e1-475e-89a2-9f15681c3c92\";s:10:\"jobdesc_id\";i:3;s:12:\"applicant_id\";i:2;s:6:\"status\";s:8:\"accepted\";s:4:\"date\";s:10:\"2024-12-08\";s:10:\"created_at\";s:19:\"2024-12-08 14:44:06\";s:10:\"updated_at\";s:19:\"2024-12-08 14:44:38\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:14;s:4:\"uuid\";s:36:\"3897a0ff-56e1-475e-89a2-9f15681c3c92\";s:10:\"jobdesc_id\";i:3;s:12:\"applicant_id\";i:2;s:6:\"status\";s:8:\"accepted\";s:4:\"date\";s:10:\"2024-12-08\";s:10:\"created_at\";s:19:\"2024-12-08 14:44:06\";s:10:\"updated_at\";s:19:\"2024-12-08 14:44:38\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:7:\"jobdesc\";O:16:\"App\\Models\\Loker\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"job_descs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:3;s:4:\"uuid\";s:36:\"e88597ba-16d2-4bf0-8c36-cecdd3891d85\";s:9:\"posted_by\";i:1;s:5:\"title\";s:22:\"Cyber Security Analyst\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:12:\"Jakarta Raya\";s:8:\"position\";s:43:\"Keamanan (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:8:\"12000000\";s:16:\"salary_range_max\";s:8:\"17000000\";s:11:\"description\";s:548:\"We are seeking a skilled and experienced Cyber Security Analyst to join our Security Operations Center team. The ideal candidate will be responsible for monitoring, detecting, and responding to security incidents, ensuring the integrity and confidentiality of our network and data. This role requires a strong technical background in cybersecurity and the ability to work collaboratively in a fast-paced environment.\r\n\r\nWe are looking for both senior level and junior level. fresh graduates with passion and knowledge in cyber security are welcome.\";s:12:\"requirements\";s:1439:\"Incident Detection and Response:\r\n\r\nMonitor security alerts and investigate potential security incidents using various security tools and platforms.\r\nAnalyze and respond to security incidents, including malware infections, network intrusions, and data breaches.\r\nPerform initial triage, containment, eradication, and recovery of security incidents.\r\nThreat Investigation and Analysis:\r\n\r\nConduct in-depth analysis of security incidents to identify potential security risks and vulnerabilities.\r\nAnalyze network traffic, system logs, and other data sources to identify anomalous activity.\r\nDevelop and refine detection rules and signatures to improve the accuracy of security monitoring.\r\nReporting and Documentation:\r\n\r\nDocument security incidents, findings, and actions taken in incident management systems.\r\nPrepare and deliver detailed incident reports and recommendations for remediation.\r\nCollaborate with other teams to implement security controls and improvements based on incident findings.\r\nContinuous Improvement:\r\n\r\nStay updated on the latest cybersecurity trends, threats, and technologies.\r\nParticipate in post-incident reviews and contribute to lessons learned and process improvements.\r\nProvide guidance and mentorship to junior team members.\r\n\r\nPassionate in the field of cyber/Network Security.\r\nCandidate must be quick learner, hard worker, multitasker, Good English, have good communication skill and presentation skill.\";s:9:\"questions\";s:532:\"Berapa gaji bulanan yang kamu inginkan?\r\nKualifikasi mana yang kamu miliki?\r\nHow many years\' experience do you have as a Cyber Security Analyst?\r\nBahasa pemrograman apa saja di bawah ini yang bisa kamu gunakan?\r\nBerapa tahun pengalaman kerjamu di bidang manajemen proyek?\r\nApakah kamu bersedia bepergian untuk pekerjaan ini saat dibutuhkan?\r\nApakah kamu bersedia bekerja di luar jam kerja biasa saat dibutuhkan? (cth. akhir pekan, malam hari, hari libur nasional)\r\nApakah kamu bersedia menjalani pemeriksaan latar belakang prakerja?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:08:11\";s:10:\"updated_at\";s:19:\"2024-11-26 10:08:11\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:3;s:4:\"uuid\";s:36:\"e88597ba-16d2-4bf0-8c36-cecdd3891d85\";s:9:\"posted_by\";i:1;s:5:\"title\";s:22:\"Cyber Security Analyst\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:12:\"Jakarta Raya\";s:8:\"position\";s:43:\"Keamanan (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:8:\"12000000\";s:16:\"salary_range_max\";s:8:\"17000000\";s:11:\"description\";s:548:\"We are seeking a skilled and experienced Cyber Security Analyst to join our Security Operations Center team. The ideal candidate will be responsible for monitoring, detecting, and responding to security incidents, ensuring the integrity and confidentiality of our network and data. This role requires a strong technical background in cybersecurity and the ability to work collaboratively in a fast-paced environment.\r\n\r\nWe are looking for both senior level and junior level. fresh graduates with passion and knowledge in cyber security are welcome.\";s:12:\"requirements\";s:1439:\"Incident Detection and Response:\r\n\r\nMonitor security alerts and investigate potential security incidents using various security tools and platforms.\r\nAnalyze and respond to security incidents, including malware infections, network intrusions, and data breaches.\r\nPerform initial triage, containment, eradication, and recovery of security incidents.\r\nThreat Investigation and Analysis:\r\n\r\nConduct in-depth analysis of security incidents to identify potential security risks and vulnerabilities.\r\nAnalyze network traffic, system logs, and other data sources to identify anomalous activity.\r\nDevelop and refine detection rules and signatures to improve the accuracy of security monitoring.\r\nReporting and Documentation:\r\n\r\nDocument security incidents, findings, and actions taken in incident management systems.\r\nPrepare and deliver detailed incident reports and recommendations for remediation.\r\nCollaborate with other teams to implement security controls and improvements based on incident findings.\r\nContinuous Improvement:\r\n\r\nStay updated on the latest cybersecurity trends, threats, and technologies.\r\nParticipate in post-incident reviews and contribute to lessons learned and process improvements.\r\nProvide guidance and mentorship to junior team members.\r\n\r\nPassionate in the field of cyber/Network Security.\r\nCandidate must be quick learner, hard worker, multitasker, Good English, have good communication skill and presentation skill.\";s:9:\"questions\";s:532:\"Berapa gaji bulanan yang kamu inginkan?\r\nKualifikasi mana yang kamu miliki?\r\nHow many years\' experience do you have as a Cyber Security Analyst?\r\nBahasa pemrograman apa saja di bawah ini yang bisa kamu gunakan?\r\nBerapa tahun pengalaman kerjamu di bidang manajemen proyek?\r\nApakah kamu bersedia bepergian untuk pekerjaan ini saat dibutuhkan?\r\nApakah kamu bersedia bekerja di luar jam kerja biasa saat dibutuhkan? (cth. akhir pekan, malam hari, hari libur nasional)\r\nApakah kamu bersedia menjalani pemeriksaan latar belakang prakerja?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:08:11\";s:10:\"updated_at\";s:19:\"2024-11-26 10:08:11\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:13:{i:0;s:4:\"uuid\";i:1;s:9:\"posted_by\";i:2;s:5:\"title\";i:3;s:12:\"company_name\";i:4;s:8:\"location\";i:5;s:8:\"position\";i:6;s:4:\"type\";i:7;s:16:\"salary_range_min\";i:8;s:16:\"salary_range_max\";i:9;s:11:\"description\";i:10;s:12:\"requirements\";i:11;s:9:\"questions\";i:12;s:6:\"status\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"uuid\";i:1;s:10:\"jobdesc_id\";i:2;s:12:\"applicant_id\";i:3;s:6:\"status\";i:4;s:4:\"date\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1733670020),
('user_lamaran_3', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:18:\"App\\Models\\Lamaran\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"applications\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:9;s:4:\"uuid\";s:36:\"2ca8645e-14ac-47fd-a59e-710b9c3d9fdf\";s:10:\"jobdesc_id\";i:3;s:12:\"applicant_id\";i:3;s:6:\"status\";s:8:\"accepted\";s:4:\"date\";s:10:\"2024-12-04\";s:10:\"created_at\";s:19:\"2024-12-04 16:37:04\";s:10:\"updated_at\";s:19:\"2024-12-04 16:38:08\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:9;s:4:\"uuid\";s:36:\"2ca8645e-14ac-47fd-a59e-710b9c3d9fdf\";s:10:\"jobdesc_id\";i:3;s:12:\"applicant_id\";i:3;s:6:\"status\";s:8:\"accepted\";s:4:\"date\";s:10:\"2024-12-04\";s:10:\"created_at\";s:19:\"2024-12-04 16:37:04\";s:10:\"updated_at\";s:19:\"2024-12-04 16:38:08\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:7:\"jobdesc\";O:16:\"App\\Models\\Loker\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"job_descs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:3;s:4:\"uuid\";s:36:\"e88597ba-16d2-4bf0-8c36-cecdd3891d85\";s:9:\"posted_by\";i:1;s:5:\"title\";s:22:\"Cyber Security Analyst\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:12:\"Jakarta Raya\";s:8:\"position\";s:43:\"Keamanan (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:8:\"12000000\";s:16:\"salary_range_max\";s:8:\"17000000\";s:11:\"description\";s:548:\"We are seeking a skilled and experienced Cyber Security Analyst to join our Security Operations Center team. The ideal candidate will be responsible for monitoring, detecting, and responding to security incidents, ensuring the integrity and confidentiality of our network and data. This role requires a strong technical background in cybersecurity and the ability to work collaboratively in a fast-paced environment.\r\n\r\nWe are looking for both senior level and junior level. fresh graduates with passion and knowledge in cyber security are welcome.\";s:12:\"requirements\";s:1439:\"Incident Detection and Response:\r\n\r\nMonitor security alerts and investigate potential security incidents using various security tools and platforms.\r\nAnalyze and respond to security incidents, including malware infections, network intrusions, and data breaches.\r\nPerform initial triage, containment, eradication, and recovery of security incidents.\r\nThreat Investigation and Analysis:\r\n\r\nConduct in-depth analysis of security incidents to identify potential security risks and vulnerabilities.\r\nAnalyze network traffic, system logs, and other data sources to identify anomalous activity.\r\nDevelop and refine detection rules and signatures to improve the accuracy of security monitoring.\r\nReporting and Documentation:\r\n\r\nDocument security incidents, findings, and actions taken in incident management systems.\r\nPrepare and deliver detailed incident reports and recommendations for remediation.\r\nCollaborate with other teams to implement security controls and improvements based on incident findings.\r\nContinuous Improvement:\r\n\r\nStay updated on the latest cybersecurity trends, threats, and technologies.\r\nParticipate in post-incident reviews and contribute to lessons learned and process improvements.\r\nProvide guidance and mentorship to junior team members.\r\n\r\nPassionate in the field of cyber/Network Security.\r\nCandidate must be quick learner, hard worker, multitasker, Good English, have good communication skill and presentation skill.\";s:9:\"questions\";s:532:\"Berapa gaji bulanan yang kamu inginkan?\r\nKualifikasi mana yang kamu miliki?\r\nHow many years\' experience do you have as a Cyber Security Analyst?\r\nBahasa pemrograman apa saja di bawah ini yang bisa kamu gunakan?\r\nBerapa tahun pengalaman kerjamu di bidang manajemen proyek?\r\nApakah kamu bersedia bepergian untuk pekerjaan ini saat dibutuhkan?\r\nApakah kamu bersedia bekerja di luar jam kerja biasa saat dibutuhkan? (cth. akhir pekan, malam hari, hari libur nasional)\r\nApakah kamu bersedia menjalani pemeriksaan latar belakang prakerja?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:08:11\";s:10:\"updated_at\";s:19:\"2024-11-26 10:08:11\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:3;s:4:\"uuid\";s:36:\"e88597ba-16d2-4bf0-8c36-cecdd3891d85\";s:9:\"posted_by\";i:1;s:5:\"title\";s:22:\"Cyber Security Analyst\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:12:\"Jakarta Raya\";s:8:\"position\";s:43:\"Keamanan (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:8:\"12000000\";s:16:\"salary_range_max\";s:8:\"17000000\";s:11:\"description\";s:548:\"We are seeking a skilled and experienced Cyber Security Analyst to join our Security Operations Center team. The ideal candidate will be responsible for monitoring, detecting, and responding to security incidents, ensuring the integrity and confidentiality of our network and data. This role requires a strong technical background in cybersecurity and the ability to work collaboratively in a fast-paced environment.\r\n\r\nWe are looking for both senior level and junior level. fresh graduates with passion and knowledge in cyber security are welcome.\";s:12:\"requirements\";s:1439:\"Incident Detection and Response:\r\n\r\nMonitor security alerts and investigate potential security incidents using various security tools and platforms.\r\nAnalyze and respond to security incidents, including malware infections, network intrusions, and data breaches.\r\nPerform initial triage, containment, eradication, and recovery of security incidents.\r\nThreat Investigation and Analysis:\r\n\r\nConduct in-depth analysis of security incidents to identify potential security risks and vulnerabilities.\r\nAnalyze network traffic, system logs, and other data sources to identify anomalous activity.\r\nDevelop and refine detection rules and signatures to improve the accuracy of security monitoring.\r\nReporting and Documentation:\r\n\r\nDocument security incidents, findings, and actions taken in incident management systems.\r\nPrepare and deliver detailed incident reports and recommendations for remediation.\r\nCollaborate with other teams to implement security controls and improvements based on incident findings.\r\nContinuous Improvement:\r\n\r\nStay updated on the latest cybersecurity trends, threats, and technologies.\r\nParticipate in post-incident reviews and contribute to lessons learned and process improvements.\r\nProvide guidance and mentorship to junior team members.\r\n\r\nPassionate in the field of cyber/Network Security.\r\nCandidate must be quick learner, hard worker, multitasker, Good English, have good communication skill and presentation skill.\";s:9:\"questions\";s:532:\"Berapa gaji bulanan yang kamu inginkan?\r\nKualifikasi mana yang kamu miliki?\r\nHow many years\' experience do you have as a Cyber Security Analyst?\r\nBahasa pemrograman apa saja di bawah ini yang bisa kamu gunakan?\r\nBerapa tahun pengalaman kerjamu di bidang manajemen proyek?\r\nApakah kamu bersedia bepergian untuk pekerjaan ini saat dibutuhkan?\r\nApakah kamu bersedia bekerja di luar jam kerja biasa saat dibutuhkan? (cth. akhir pekan, malam hari, hari libur nasional)\r\nApakah kamu bersedia menjalani pemeriksaan latar belakang prakerja?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:08:11\";s:10:\"updated_at\";s:19:\"2024-11-26 10:08:11\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:13:{i:0;s:4:\"uuid\";i:1;s:9:\"posted_by\";i:2;s:5:\"title\";i:3;s:12:\"company_name\";i:4;s:8:\"location\";i:5;s:8:\"position\";i:6;s:4:\"type\";i:7;s:16:\"salary_range_min\";i:8;s:16:\"salary_range_max\";i:9;s:11:\"description\";i:10;s:12:\"requirements\";i:11;s:9:\"questions\";i:12;s:6:\"status\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"uuid\";i:1;s:10:\"jobdesc_id\";i:2;s:12:\"applicant_id\";i:3;s:6:\"status\";i:4;s:4:\"date\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1733361837),
('user_lamaran_4', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:18:\"App\\Models\\Lamaran\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"applications\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:11;s:4:\"uuid\";s:36:\"2c3c327d-e96f-47c7-8f15-26cd7d8ba91b\";s:10:\"jobdesc_id\";i:4;s:12:\"applicant_id\";i:4;s:6:\"status\";s:7:\"pending\";s:4:\"date\";s:10:\"2024-12-05\";s:10:\"created_at\";s:19:\"2024-12-05 01:21:52\";s:10:\"updated_at\";s:19:\"2024-12-05 01:21:52\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:11;s:4:\"uuid\";s:36:\"2c3c327d-e96f-47c7-8f15-26cd7d8ba91b\";s:10:\"jobdesc_id\";i:4;s:12:\"applicant_id\";i:4;s:6:\"status\";s:7:\"pending\";s:4:\"date\";s:10:\"2024-12-05\";s:10:\"created_at\";s:19:\"2024-12-05 01:21:52\";s:10:\"updated_at\";s:19:\"2024-12-05 01:21:52\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:7:\"jobdesc\";O:16:\"App\\Models\\Loker\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"job_descs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:4;s:4:\"uuid\";s:36:\"1e36ae89-6637-48b3-93d8-77cff69de772\";s:9:\"posted_by\";i:1;s:5:\"title\";s:33:\"IT Security Governance Specialist\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:29:\"Jakarta Selatan, Jakarta Raya\";s:8:\"position\";s:55:\"Analis Bisnis/Sistem (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:8:\"12500000\";s:16:\"salary_range_max\";s:8:\"18500000\";s:11:\"description\";s:628:\"Ensure the strategy and implementation of information security in accordance with the needs & applicable regulations\r\nDevelop an information security framework and architecture in accordance with the Company\'s needs\r\nDevelop and maintain policies, standards, and procedures that support the information security framework in accordance with best practices and applicable regulations\r\nActively identify, analyze, measure, provide control recommendations, and monitor follow-up on risk control & information security\r\nCarry out regular evaluations of the implementation of IT security management policies, standards and procedures\";s:12:\"requirements\";s:433:\"Minimum Bachelors degree of Information Technology\r\nMinimum 3 years Experience in Multifinance Company as IT Security Governance\r\nFamiliar and able to implement various best practices & regulations for IT Security & Cyber Security such as ISO 27000, CIS, NIST, GDPR, etc\r\nFamiliar and understand the work logic of various IT Security Tools & IT Security Devices\r\nAble to do basic testing of IT security with various IT Security tools\";s:9:\"questions\";s:202:\"Lamaran kamu akan mencakup pertanyaan-pertanyaan berikut:\r\nKualifikasi mana yang kamu miliki?\r\nBerapa gaji bulanan yang kamu inginkan?\r\nHow many years\' experience do you have as a Governance Specialist?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:09:39\";s:10:\"updated_at\";s:19:\"2024-11-26 10:09:39\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:4;s:4:\"uuid\";s:36:\"1e36ae89-6637-48b3-93d8-77cff69de772\";s:9:\"posted_by\";i:1;s:5:\"title\";s:33:\"IT Security Governance Specialist\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:29:\"Jakarta Selatan, Jakarta Raya\";s:8:\"position\";s:55:\"Analis Bisnis/Sistem (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:8:\"12500000\";s:16:\"salary_range_max\";s:8:\"18500000\";s:11:\"description\";s:628:\"Ensure the strategy and implementation of information security in accordance with the needs & applicable regulations\r\nDevelop an information security framework and architecture in accordance with the Company\'s needs\r\nDevelop and maintain policies, standards, and procedures that support the information security framework in accordance with best practices and applicable regulations\r\nActively identify, analyze, measure, provide control recommendations, and monitor follow-up on risk control & information security\r\nCarry out regular evaluations of the implementation of IT security management policies, standards and procedures\";s:12:\"requirements\";s:433:\"Minimum Bachelors degree of Information Technology\r\nMinimum 3 years Experience in Multifinance Company as IT Security Governance\r\nFamiliar and able to implement various best practices & regulations for IT Security & Cyber Security such as ISO 27000, CIS, NIST, GDPR, etc\r\nFamiliar and understand the work logic of various IT Security Tools & IT Security Devices\r\nAble to do basic testing of IT security with various IT Security tools\";s:9:\"questions\";s:202:\"Lamaran kamu akan mencakup pertanyaan-pertanyaan berikut:\r\nKualifikasi mana yang kamu miliki?\r\nBerapa gaji bulanan yang kamu inginkan?\r\nHow many years\' experience do you have as a Governance Specialist?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:09:39\";s:10:\"updated_at\";s:19:\"2024-11-26 10:09:39\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:13:{i:0;s:4:\"uuid\";i:1;s:9:\"posted_by\";i:2;s:5:\"title\";i:3;s:12:\"company_name\";i:4;s:8:\"location\";i:5;s:8:\"position\";i:6;s:4:\"type\";i:7;s:16:\"salary_range_min\";i:8;s:16:\"salary_range_max\";i:9;s:11:\"description\";i:10;s:12:\"requirements\";i:11;s:9:\"questions\";i:12;s:6:\"status\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"uuid\";i:1;s:10:\"jobdesc_id\";i:2;s:12:\"applicant_id\";i:3;s:6:\"status\";i:4;s:4:\"date\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1733361756);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('user_lamaran_5', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:18:\"App\\Models\\Lamaran\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"applications\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:10;s:4:\"uuid\";s:36:\"da64df39-f2ac-4720-aa89-79286a09bada\";s:10:\"jobdesc_id\";i:2;s:12:\"applicant_id\";i:5;s:6:\"status\";s:8:\"reviewed\";s:4:\"date\";s:10:\"2024-12-05\";s:10:\"created_at\";s:19:\"2024-12-04 20:07:10\";s:10:\"updated_at\";s:19:\"2024-12-05 01:01:33\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:10;s:4:\"uuid\";s:36:\"da64df39-f2ac-4720-aa89-79286a09bada\";s:10:\"jobdesc_id\";i:2;s:12:\"applicant_id\";i:5;s:6:\"status\";s:8:\"reviewed\";s:4:\"date\";s:10:\"2024-12-05\";s:10:\"created_at\";s:19:\"2024-12-04 20:07:10\";s:10:\"updated_at\";s:19:\"2024-12-05 01:01:33\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:7:\"jobdesc\";O:16:\"App\\Models\\Loker\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"job_descs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:2;s:4:\"uuid\";s:36:\"f52b0508-2355-4f1a-b50d-6b495b4680cf\";s:9:\"posted_by\";i:1;s:5:\"title\";s:32:\"Web Developer (Spring Framework)\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:12:\"Jakarta Raya\";s:8:\"position\";s:62:\"Pengembangan & Produksi Web (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:7:\"7000000\";s:16:\"salary_range_max\";s:8:\"10000000\";s:11:\"description\";s:465:\"Developing fintech services using backend framework\r\nDeveloping administrative pages for various security products\r\nDeveloping various database tables to optimally manage large-scale logs\r\nConducting DB analysis and research for various products and related systems to design databases and process data according to objectives and environments.\r\nDeveloping an engine for searching personal and specific information within web services using web crawling techniques.\";s:12:\"requirements\";s:461:\"Bachelor’s degree in Computer Science, Engineering, or related field\r\nProficiency in Spring Framework\r\nCommitment to a 3-month training program\r\nAvailability for an online coding assessment (with screen and camera recording)\r\n\r\n1-3 years of back-end development experience\r\nPassion for the fintech industry  & Security\r\nList Additional qualifications:\r\nAdaptability and eagerness to learn\r\nStrong teamwork and collaboration skills\r\nProactive and quick learner\";s:9:\"questions\";s:424:\"What\'s your expected monthly basic salary?\r\nWhich of the following types of qualifications do you have?\r\nHow many years\' experience do you have as a web developer?\r\nWhich of the following programming languages are you experienced in?\r\nWhich of the following Relational Database Management Systems (RDBMS) are you experienced with?\r\nWhich of the following front end development libraries and frameworks are you proficient in?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:06:41\";s:10:\"updated_at\";s:19:\"2024-11-26 10:06:41\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:2;s:4:\"uuid\";s:36:\"f52b0508-2355-4f1a-b50d-6b495b4680cf\";s:9:\"posted_by\";i:1;s:5:\"title\";s:32:\"Web Developer (Spring Framework)\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:12:\"Jakarta Raya\";s:8:\"position\";s:62:\"Pengembangan & Produksi Web (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:7:\"7000000\";s:16:\"salary_range_max\";s:8:\"10000000\";s:11:\"description\";s:465:\"Developing fintech services using backend framework\r\nDeveloping administrative pages for various security products\r\nDeveloping various database tables to optimally manage large-scale logs\r\nConducting DB analysis and research for various products and related systems to design databases and process data according to objectives and environments.\r\nDeveloping an engine for searching personal and specific information within web services using web crawling techniques.\";s:12:\"requirements\";s:461:\"Bachelor’s degree in Computer Science, Engineering, or related field\r\nProficiency in Spring Framework\r\nCommitment to a 3-month training program\r\nAvailability for an online coding assessment (with screen and camera recording)\r\n\r\n1-3 years of back-end development experience\r\nPassion for the fintech industry  & Security\r\nList Additional qualifications:\r\nAdaptability and eagerness to learn\r\nStrong teamwork and collaboration skills\r\nProactive and quick learner\";s:9:\"questions\";s:424:\"What\'s your expected monthly basic salary?\r\nWhich of the following types of qualifications do you have?\r\nHow many years\' experience do you have as a web developer?\r\nWhich of the following programming languages are you experienced in?\r\nWhich of the following Relational Database Management Systems (RDBMS) are you experienced with?\r\nWhich of the following front end development libraries and frameworks are you proficient in?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:06:41\";s:10:\"updated_at\";s:19:\"2024-11-26 10:06:41\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:13:{i:0;s:4:\"uuid\";i:1;s:9:\"posted_by\";i:2;s:5:\"title\";i:3;s:12:\"company_name\";i:4;s:8:\"location\";i:5;s:8:\"position\";i:6;s:4:\"type\";i:7;s:16:\"salary_range_min\";i:8;s:16:\"salary_range_max\";i:9;s:11:\"description\";i:10;s:12:\"requirements\";i:11;s:9:\"questions\";i:12;s:6:\"status\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"uuid\";i:1;s:10:\"jobdesc_id\";i:2;s:12:\"applicant_id\";i:3;s:6:\"status\";i:4;s:4:\"date\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1733590009),
('user_lamaran_6', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:18:\"App\\Models\\Lamaran\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"applications\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:12;s:4:\"uuid\";s:36:\"d53724c4-2b08-4ff8-b2e5-4a89954adcbd\";s:10:\"jobdesc_id\";i:4;s:12:\"applicant_id\";i:6;s:6:\"status\";s:8:\"accepted\";s:4:\"date\";s:10:\"2024-12-07\";s:10:\"created_at\";s:19:\"2024-12-07 05:16:01\";s:10:\"updated_at\";s:19:\"2024-12-07 05:19:56\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:12;s:4:\"uuid\";s:36:\"d53724c4-2b08-4ff8-b2e5-4a89954adcbd\";s:10:\"jobdesc_id\";i:4;s:12:\"applicant_id\";i:6;s:6:\"status\";s:8:\"accepted\";s:4:\"date\";s:10:\"2024-12-07\";s:10:\"created_at\";s:19:\"2024-12-07 05:16:01\";s:10:\"updated_at\";s:19:\"2024-12-07 05:19:56\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:7:\"jobdesc\";O:16:\"App\\Models\\Loker\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"job_descs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:4;s:4:\"uuid\";s:36:\"1e36ae89-6637-48b3-93d8-77cff69de772\";s:9:\"posted_by\";i:1;s:5:\"title\";s:33:\"IT Security Governance Specialist\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:29:\"Jakarta Selatan, Jakarta Raya\";s:8:\"position\";s:55:\"Analis Bisnis/Sistem (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:8:\"12500000\";s:16:\"salary_range_max\";s:8:\"18500000\";s:11:\"description\";s:628:\"Ensure the strategy and implementation of information security in accordance with the needs & applicable regulations\r\nDevelop an information security framework and architecture in accordance with the Company\'s needs\r\nDevelop and maintain policies, standards, and procedures that support the information security framework in accordance with best practices and applicable regulations\r\nActively identify, analyze, measure, provide control recommendations, and monitor follow-up on risk control & information security\r\nCarry out regular evaluations of the implementation of IT security management policies, standards and procedures\";s:12:\"requirements\";s:433:\"Minimum Bachelors degree of Information Technology\r\nMinimum 3 years Experience in Multifinance Company as IT Security Governance\r\nFamiliar and able to implement various best practices & regulations for IT Security & Cyber Security such as ISO 27000, CIS, NIST, GDPR, etc\r\nFamiliar and understand the work logic of various IT Security Tools & IT Security Devices\r\nAble to do basic testing of IT security with various IT Security tools\";s:9:\"questions\";s:202:\"Lamaran kamu akan mencakup pertanyaan-pertanyaan berikut:\r\nKualifikasi mana yang kamu miliki?\r\nBerapa gaji bulanan yang kamu inginkan?\r\nHow many years\' experience do you have as a Governance Specialist?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:09:39\";s:10:\"updated_at\";s:19:\"2024-11-26 10:09:39\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:4;s:4:\"uuid\";s:36:\"1e36ae89-6637-48b3-93d8-77cff69de772\";s:9:\"posted_by\";i:1;s:5:\"title\";s:33:\"IT Security Governance Specialist\";s:12:\"company_name\";s:27:\"Vespertine Security Startup\";s:8:\"location\";s:29:\"Jakarta Selatan, Jakarta Raya\";s:8:\"position\";s:55:\"Analis Bisnis/Sistem (Teknologi Informasi & Komunikasi)\";s:4:\"type\";s:9:\"full-time\";s:16:\"salary_range_min\";s:8:\"12500000\";s:16:\"salary_range_max\";s:8:\"18500000\";s:11:\"description\";s:628:\"Ensure the strategy and implementation of information security in accordance with the needs & applicable regulations\r\nDevelop an information security framework and architecture in accordance with the Company\'s needs\r\nDevelop and maintain policies, standards, and procedures that support the information security framework in accordance with best practices and applicable regulations\r\nActively identify, analyze, measure, provide control recommendations, and monitor follow-up on risk control & information security\r\nCarry out regular evaluations of the implementation of IT security management policies, standards and procedures\";s:12:\"requirements\";s:433:\"Minimum Bachelors degree of Information Technology\r\nMinimum 3 years Experience in Multifinance Company as IT Security Governance\r\nFamiliar and able to implement various best practices & regulations for IT Security & Cyber Security such as ISO 27000, CIS, NIST, GDPR, etc\r\nFamiliar and understand the work logic of various IT Security Tools & IT Security Devices\r\nAble to do basic testing of IT security with various IT Security tools\";s:9:\"questions\";s:202:\"Lamaran kamu akan mencakup pertanyaan-pertanyaan berikut:\r\nKualifikasi mana yang kamu miliki?\r\nBerapa gaji bulanan yang kamu inginkan?\r\nHow many years\' experience do you have as a Governance Specialist?\";s:6:\"status\";s:4:\"open\";s:10:\"created_at\";s:19:\"2024-11-26 10:09:39\";s:10:\"updated_at\";s:19:\"2024-11-26 10:09:39\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:13:{i:0;s:4:\"uuid\";i:1;s:9:\"posted_by\";i:2;s:5:\"title\";i:3;s:12:\"company_name\";i:4;s:8:\"location\";i:5;s:8:\"position\";i:6;s:4:\"type\";i:7;s:16:\"salary_range_min\";i:8;s:16:\"salary_range_max\";i:9;s:11:\"description\";i:10;s:12:\"requirements\";i:11;s:9:\"questions\";i:12;s:6:\"status\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:4:\"uuid\";i:1;s:10:\"jobdesc_id\";i:2;s:12:\"applicant_id\";i:3;s:6:\"status\";i:4;s:4:\"date\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1733548836),
('user_lamaran_7', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1733548552);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interview_schedules`
--

CREATE TABLE `interview_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `interview_date` datetime NOT NULL,
  `interview_method` enum('online','offline') NOT NULL DEFAULT 'offline',
  `interview_location` varchar(255) DEFAULT NULL,
  `interviewer_name` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('scheduled','completed','cancelled') NOT NULL DEFAULT 'scheduled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview_schedules`
--

INSERT INTO `interview_schedules` (`id`, `uuid`, `application_id`, `interview_date`, `interview_method`, `interview_location`, `interviewer_name`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(3, '623fd55b-ed15-4879-a43f-10d4e7e8f091', 9, '2024-12-05 01:30:00', 'offline', 'Jl. Taman Malaka Selatan No.8, RT.8/RW.6, Pd. Klp., Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450', 'Papah Faiz Ganteng', 'Berpakaian Rapih, Kemeja Putih, Sepatu Pantompel, Celana Panjang Hitam...HARUS GANTENG', 'scheduled', '2024-12-04 09:40:33', '2024-12-04 09:40:33'),
(6, '091f4332-a777-489e-ac8c-6af89e1cb780', 10, '2024-12-20 12:12:00', 'offline', 'Kantor', 'Michael', NULL, 'scheduled', '2024-12-07 10:28:48', '2024-12-07 10:28:48'),
(7, 'cb5bde2a-b536-459a-8117-89f08ac46cbb', 14, '2024-12-09 03:00:00', 'offline', 'Jl. Taman Malaka Selatan No.8, RT.8/RW.6, Pd. Klp., Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450', 'Mas Faiz Ganteng', 'Wajib Datang Berpakaian Rapih', 'scheduled', '2024-12-08 07:45:52', '2024-12-08 07:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_descs`
--

CREATE TABLE `job_descs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `posted_by` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `type` enum('full-time','part-time','contract','internship') NOT NULL DEFAULT 'full-time',
  `salary_range_min` varchar(255) DEFAULT NULL,
  `salary_range_max` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `requirements` text NOT NULL,
  `questions` text NOT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_descs`
--

INSERT INTO `job_descs` (`id`, `uuid`, `posted_by`, `title`, `company_name`, `location`, `position`, `type`, `salary_range_min`, `salary_range_max`, `description`, `requirements`, `questions`, `status`, `created_at`, `updated_at`) VALUES
(2, 'f52b0508-2355-4f1a-b50d-6b495b4680cf', 1, 'Web Developer (Spring Framework)', 'Vespertine Security Startup', 'Jakarta Raya', 'Pengembangan & Produksi Web (Teknologi Informasi & Komunikasi)', 'full-time', '7000000', '10000000', 'Developing fintech services using backend framework\r\nDeveloping administrative pages for various security products\r\nDeveloping various database tables to optimally manage large-scale logs\r\nConducting DB analysis and research for various products and related systems to design databases and process data according to objectives and environments.\r\nDeveloping an engine for searching personal and specific information within web services using web crawling techniques.', 'Bachelor’s degree in Computer Science, Engineering, or related field\r\nProficiency in Spring Framework\r\nCommitment to a 3-month training program\r\nAvailability for an online coding assessment (with screen and camera recording)\r\n\r\n1-3 years of back-end development experience\r\nPassion for the fintech industry  & Security\r\nList Additional qualifications:\r\nAdaptability and eagerness to learn\r\nStrong teamwork and collaboration skills\r\nProactive and quick learner', 'What\'s your expected monthly basic salary?\r\nWhich of the following types of qualifications do you have?\r\nHow many years\' experience do you have as a web developer?\r\nWhich of the following programming languages are you experienced in?\r\nWhich of the following Relational Database Management Systems (RDBMS) are you experienced with?\r\nWhich of the following front end development libraries and frameworks are you proficient in?', 'open', '2024-11-26 03:06:41', '2024-11-26 03:06:41'),
(3, 'e88597ba-16d2-4bf0-8c36-cecdd3891d85', 1, 'Cyber Security Analyst', 'Vespertine Security Startup', 'Jakarta Raya', 'Keamanan (Teknologi Informasi & Komunikasi)', 'full-time', '12000000', '17000000', 'We are seeking a skilled and experienced Cyber Security Analyst to join our Security Operations Center team. The ideal candidate will be responsible for monitoring, detecting, and responding to security incidents, ensuring the integrity and confidentiality of our network and data. This role requires a strong technical background in cybersecurity and the ability to work collaboratively in a fast-paced environment.\r\n\r\nWe are looking for both senior level and junior level. fresh graduates with passion and knowledge in cyber security are welcome.', 'Incident Detection and Response:\r\n\r\nMonitor security alerts and investigate potential security incidents using various security tools and platforms.\r\nAnalyze and respond to security incidents, including malware infections, network intrusions, and data breaches.\r\nPerform initial triage, containment, eradication, and recovery of security incidents.\r\nThreat Investigation and Analysis:\r\n\r\nConduct in-depth analysis of security incidents to identify potential security risks and vulnerabilities.\r\nAnalyze network traffic, system logs, and other data sources to identify anomalous activity.\r\nDevelop and refine detection rules and signatures to improve the accuracy of security monitoring.\r\nReporting and Documentation:\r\n\r\nDocument security incidents, findings, and actions taken in incident management systems.\r\nPrepare and deliver detailed incident reports and recommendations for remediation.\r\nCollaborate with other teams to implement security controls and improvements based on incident findings.\r\nContinuous Improvement:\r\n\r\nStay updated on the latest cybersecurity trends, threats, and technologies.\r\nParticipate in post-incident reviews and contribute to lessons learned and process improvements.\r\nProvide guidance and mentorship to junior team members.\r\n\r\nPassionate in the field of cyber/Network Security.\r\nCandidate must be quick learner, hard worker, multitasker, Good English, have good communication skill and presentation skill.', 'Berapa gaji bulanan yang kamu inginkan?\r\nKualifikasi mana yang kamu miliki?\r\nHow many years\' experience do you have as a Cyber Security Analyst?\r\nBahasa pemrograman apa saja di bawah ini yang bisa kamu gunakan?\r\nBerapa tahun pengalaman kerjamu di bidang manajemen proyek?\r\nApakah kamu bersedia bepergian untuk pekerjaan ini saat dibutuhkan?\r\nApakah kamu bersedia bekerja di luar jam kerja biasa saat dibutuhkan? (cth. akhir pekan, malam hari, hari libur nasional)\r\nApakah kamu bersedia menjalani pemeriksaan latar belakang prakerja?', 'open', '2024-11-26 03:08:11', '2024-11-26 03:08:11'),
(4, '1e36ae89-6637-48b3-93d8-77cff69de772', 1, 'IT Security Governance Specialist', 'Vespertine Security Startup', 'Jakarta Selatan, Jakarta Raya', 'Analis Bisnis/Sistem (Teknologi Informasi & Komunikasi)', 'full-time', '12500000', '18500000', 'Ensure the strategy and implementation of information security in accordance with the needs & applicable regulations\r\nDevelop an information security framework and architecture in accordance with the Company\'s needs\r\nDevelop and maintain policies, standards, and procedures that support the information security framework in accordance with best practices and applicable regulations\r\nActively identify, analyze, measure, provide control recommendations, and monitor follow-up on risk control & information security\r\nCarry out regular evaluations of the implementation of IT security management policies, standards and procedures', 'Minimum Bachelors degree of Information Technology\r\nMinimum 3 years Experience in Multifinance Company as IT Security Governance\r\nFamiliar and able to implement various best practices & regulations for IT Security & Cyber Security such as ISO 27000, CIS, NIST, GDPR, etc\r\nFamiliar and understand the work logic of various IT Security Tools & IT Security Devices\r\nAble to do basic testing of IT security with various IT Security tools', 'Lamaran kamu akan mencakup pertanyaan-pertanyaan berikut:\r\nKualifikasi mana yang kamu miliki?\r\nBerapa gaji bulanan yang kamu inginkan?\r\nHow many years\' experience do you have as a Governance Specialist?', 'open', '2024-11-26 03:09:39', '2024-11-26 03:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_16_214912_create_applicant_profiles_table', 1),
(5, '2024_10_16_215025_create_job_descs_table', 1),
(6, '2024_10_16_215110_create_applications_table', 1),
(7, '2024_10_16_215211_create_notifications_table', 1),
(8, '2024_10_24_162614_create_user_activities_table', 1),
(9, '2024_11_12_100929_create_interview_schedules_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `uuid`, `user_id`, `title`, `message`, `type`, `data`, `link`, `is_read`, `created_at`, `updated_at`) VALUES
(24, 'fa351321-ea09-4607-9cfc-9e5fb95c60f8', 1, 'Lamaran Baru', 'Vod Voldigoad telah melamar untuk posisi Cyber Security Analyst', 'lamaran', '{\"lamaran_id\":9,\"loker_id\":3}', 'https://loker.vespertine.my.id/panel/lamaran/2ca8645e-14ac-47fd-a59e-710b9c3d9fdf', 1, '2024-12-04 09:37:08', '2024-12-04 18:00:56'),
(25, 'b4125247-9d8a-4d6d-ba60-399dee89fff5', 3, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi Cyber Security Analyst telah diubah menjadi Reviewed', 'status_lamaran', '{\"lamaran_id\":9,\"status\":\"reviewed\"}', 'https://loker.vespertine.my.id/panel/list/e88597ba-16d2-4bf0-8c36-cecdd3891d85', 1, '2024-12-04 09:37:54', '2024-12-04 18:05:41'),
(26, '57342c2b-f7b3-45ce-aa67-a3822b69da71', 3, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi Cyber Security Analyst telah diubah menjadi Accepted', 'status_lamaran', '{\"lamaran_id\":9,\"status\":\"accepted\"}', 'https://loker.vespertine.my.id/panel/list/e88597ba-16d2-4bf0-8c36-cecdd3891d85', 1, '2024-12-04 09:38:11', '2024-12-04 18:05:41'),
(27, '5439b4ef-de5f-4c9d-8a97-b21b629718bb', 3, 'Jadwal Interview', 'Anda telah dijadwalkan untuk interview pada 05 December 2024 01:30', 'interview', '{\"interview_id\":3,\"date\":\"2024-12-05T01:30\",\"method\":\"offline\",\"location\":\"Jl. Taman Malaka Selatan No.8, RT.8\\/RW.6, Pd. Klp., Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450\",\"interviewer\":\"Papah Faiz Ganteng\"}', 'https://loker.vespertine.my.id/panel/interview/623fd55b-ed15-4879-a43f-10d4e7e8f091', 1, '2024-12-04 09:40:33', '2024-12-04 18:05:41'),
(28, 'b7db02e6-285d-405d-8345-ba561167e50d', 1, 'Lamaran Baru', 'Sinatra telah melamar untuk posisi Web Developer (Spring Framework)', 'lamaran', '{\"lamaran_id\":10,\"loker_id\":2}', 'https://loker.vespertine.my.id/panel/lamaran/da64df39-f2ac-4720-aa89-79286a09bada', 1, '2024-12-04 13:07:13', '2024-12-04 18:00:56'),
(29, '7f290ca5-f318-4c96-8fdf-752808a124a9', 5, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi Web Developer (Spring Framework) telah diubah menjadi Reviewed', 'status_lamaran', '{\"lamaran_id\":10,\"status\":\"reviewed\"}', 'https://loker.vespertine.my.id/panel/list/f52b0508-2355-4f1a-b50d-6b495b4680cf', 0, '2024-12-04 18:02:08', '2024-12-04 18:02:08'),
(31, '6377b80a-32b0-4828-b4dc-a84ec9871743', 1, 'Lamaran Baru', 'Anantha Marcellino Hidayat telah melamar untuk posisi IT Security Governance Specialist', 'lamaran', '{\"lamaran_id\":12,\"loker_id\":4}', 'https://loker.vespertine.my.id/panel/lamaran/d53724c4-2b08-4ff8-b2e5-4a89954adcbd', 0, '2024-12-06 22:16:05', '2024-12-06 22:16:05'),
(32, '7e17126e-aac2-4f0d-a797-f0e86cf8545f', 6, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi IT Security Governance Specialist telah diubah menjadi Reviewed', 'status_lamaran', '{\"lamaran_id\":12,\"status\":\"reviewed\"}', 'https://loker.vespertine.my.id/panel/list/1e36ae89-6637-48b3-93d8-77cff69de772', 0, '2024-12-06 22:17:56', '2024-12-06 22:17:56'),
(33, '4d653049-b1e3-44f2-a374-9f75643ec6ad', 6, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi IT Security Governance Specialist telah diubah menjadi Accepted', 'status_lamaran', '{\"lamaran_id\":12,\"status\":\"accepted\"}', 'https://loker.vespertine.my.id/panel/list/1e36ae89-6637-48b3-93d8-77cff69de772', 0, '2024-12-06 22:20:00', '2024-12-06 22:20:00'),
(34, '84c258d7-59dd-4b4c-90ee-76c4b43d09ff', 6, 'Jadwal Interview', 'Anda telah dijadwalkan untuk interview pada 10 December 2024 13:00', 'interview', '{\"interview_id\":4,\"date\":\"2024-12-10T13:00\",\"method\":\"online\",\"location\":null,\"interviewer\":\"Herianto\"}', 'https://loker.vespertine.my.id/panel/interview/e839798e-79a8-4b01-b66a-fea6aeb0bff4', 0, '2024-12-06 22:21:22', '2024-12-06 22:21:22'),
(35, '3fc45d3d-4d18-4a42-8304-fd4f73cb194c', 6, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi IT Security Governance Specialist telah diubah menjadi Reviewed', 'status_lamaran', '{\"lamaran_id\":12,\"status\":\"reviewed\"}', 'https://loker.vespertine.my.id/panel/list/1e36ae89-6637-48b3-93d8-77cff69de772', 0, '2024-12-06 23:36:04', '2024-12-06 23:36:04'),
(36, '0592f8bf-6661-4f15-b94a-751c61359ac8', 6, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi IT Security Governance Specialist telah diubah menjadi Accepted', 'status_lamaran', '{\"lamaran_id\":12,\"status\":\"accepted\"}', 'https://loker.vespertine.my.id/panel/list/1e36ae89-6637-48b3-93d8-77cff69de772', 0, '2024-12-06 23:36:20', '2024-12-06 23:36:20'),
(37, '81c95945-7836-4c0e-afd5-262bcc8a529d', 1, 'Lamaran Baru', 'Anantha Marcellino Hidayat telah melamar untuk posisi Web Developer (Spring Framework)', 'lamaran', '{\"lamaran_id\":13,\"loker_id\":2}', 'https://loker.vespertine.my.id/panel/lamaran/d97b8212-68e3-4245-9fc9-efa64154a49b', 0, '2024-12-06 23:36:33', '2024-12-06 23:36:33'),
(38, '5fd52295-50a2-4fdc-a71d-ee1d6a8c2962', 6, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi Web Developer (Spring Framework) telah diubah menjadi Reviewed', 'status_lamaran', '{\"lamaran_id\":13,\"status\":\"reviewed\"}', 'https://loker.vespertine.my.id/panel/list/f52b0508-2355-4f1a-b50d-6b495b4680cf', 0, '2024-12-06 23:36:45', '2024-12-06 23:36:45'),
(39, 'a0025f6d-dd3c-4343-80df-6ce79478de88', 6, 'Jadwal Interview', 'Anda telah dijadwalkan untuk interview pada 10 December 2024 13:00', 'interview', '{\"interview_id\":5,\"date\":\"2024-12-10T13:00\",\"method\":\"online\",\"location\":\"https:\\/\\/meet.google.com\\/rpu-mwbg-dqj\",\"interviewer\":\"Rama Haddaf\"}', 'https://loker.vespertine.my.id/panel/interview/fb1d013e-4eb0-4fe3-bd75-fa2fa1076806', 0, '2024-12-06 23:53:51', '2024-12-06 23:53:51'),
(40, '10953217-e92d-4a27-8ff4-60a62984ad8b', 6, 'Perubahan Jadwal Interview', 'Jadwal interview Anda telah diperbarui menjadi 11 December 2024 14:00', 'interview_update', '{\"interview_id\":5,\"date\":\"2024-12-11T14:00\",\"method\":\"online\",\"location\":\"https:\\/\\/meet.google.com\\/rpu-mwbg-dqj\",\"interviewer\":\"Rama Haddaf\",\"status\":\"scheduled\"}', 'https://loker.vespertine.my.id/panel/interview/fb1d013e-4eb0-4fe3-bd75-fa2fa1076806', 0, '2024-12-06 23:55:47', '2024-12-06 23:55:47'),
(41, '93deec94-b1ab-4656-aade-e36a2650572c', 5, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi Web Developer (Spring Framework) telah diubah menjadi Accepted', 'status_lamaran', '{\"lamaran_id\":10,\"status\":\"accepted\"}', 'https://loker.vespertine.my.id/panel/list/f52b0508-2355-4f1a-b50d-6b495b4680cf', 0, '2024-12-07 10:28:01', '2024-12-07 10:28:01'),
(42, 'e17d32f1-068d-4458-b057-4a31f1d17e0d', 5, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi Web Developer (Spring Framework) telah diubah menjadi Accepted', 'status_lamaran', '{\"lamaran_id\":10,\"status\":\"accepted\"}', 'https://loker.vespertine.my.id/panel/list/f52b0508-2355-4f1a-b50d-6b495b4680cf', 0, '2024-12-07 10:28:02', '2024-12-07 10:28:02'),
(43, 'acd685a9-4d0b-477f-a0f4-0bd3bfd8392d', 5, 'Jadwal Interview', 'Anda telah dijadwalkan untuk interview pada 20 December 2024 12:12', 'interview', '{\"interview_id\":6,\"date\":\"2024-12-20T12:12\",\"method\":\"offline\",\"location\":\"Kantor\",\"interviewer\":\"Michael\"}', 'https://loker.vespertine.my.id/panel/interview/091f4332-a777-489e-ac8c-6af89e1cb780', 0, '2024-12-07 10:28:48', '2024-12-07 10:28:48'),
(44, '97104479-1ff9-4e11-9ff9-fe3fc83a3251', 1, 'Lamaran Baru', 'Shilfaa Shaphiera telah melamar untuk posisi Cyber Security Analyst', 'lamaran', '{\"lamaran_id\":14,\"loker_id\":3}', 'https://loker.vespertine.my.id/panel/lamaran/3897a0ff-56e1-475e-89a2-9f15681c3c92', 0, '2024-12-08 07:44:10', '2024-12-08 07:44:10'),
(45, '56bf995e-3968-4cad-b190-fb1288c739d3', 2, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi Cyber Security Analyst telah diubah menjadi Reviewed', 'status_lamaran', '{\"lamaran_id\":14,\"status\":\"reviewed\"}', 'https://loker.vespertine.my.id/panel/list/e88597ba-16d2-4bf0-8c36-cecdd3891d85', 0, '2024-12-08 07:44:28', '2024-12-08 07:44:28'),
(46, '71351804-dd16-429d-bdf5-5659b649eba3', 2, 'Status Lamaran Diperbarui', 'Status lamaran Anda untuk posisi Cyber Security Analyst telah diubah menjadi Accepted', 'status_lamaran', '{\"lamaran_id\":14,\"status\":\"accepted\"}', 'https://loker.vespertine.my.id/panel/list/e88597ba-16d2-4bf0-8c36-cecdd3891d85', 0, '2024-12-08 07:44:41', '2024-12-08 07:44:41'),
(47, 'ffd13f0c-d551-4bf7-bf92-32fdc7e99a86', 2, 'Jadwal Interview', 'Anda telah dijadwalkan untuk interview pada 09 December 2024 03:00', 'interview', '{\"interview_id\":7,\"date\":\"2024-12-09T03:00\",\"method\":\"offline\",\"location\":\"Jl. Taman Malaka Selatan No.8, RT.8\\/RW.6, Pd. Klp., Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450\",\"interviewer\":\"Mas Faiz Ganteng\"}', 'https://loker.vespertine.my.id/panel/interview/cb5bde2a-b536-459a-8117-89f08ac46cbb', 0, '2024-12-08 07:45:52', '2024-12-08 07:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('anontester69@gmail.com', '$2y$12$1MhpJ0P0VDEtyQOAa3wwAea5GqWMbiAVNuAc0cU/pys7T5k/pNz3W', '2024-12-04 11:59:39'),
('bitcoin.centralpark@gmail.com', '$2y$12$7QTMZz3NNCFf8Vj8Og0.i.q8k2uHPFc2HCQQB0PxUjTR5DizV7Fx2', '2024-12-04 12:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Juo75a2axP2u4ZnL5jJ5FpDXSr4ncoqt3IGLYBoV', 2, '2001:448a:2016:5042:31b6:483d:c5ee:d134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUEJZV3RZYWlNNHVuTGdoT1BzaXk0REhXRGE0STZ5RmxodkVDQzVQaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vbG9rZXIudmVzcGVydGluZS5teS5pZC9wYW5lbC9pbnRlcnZpZXciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTczMzY2ODk0Nzt9czo5OiJ1c2VyX3JvbGUiO3M6NzoicGVsYW1hciI7fQ==', 1733670322),
('soFBbmplbjeanalKyMPjXz7nPitwbx89N3AbPJgp', NULL, '85.208.96.195', 'Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1BKcDd2TTVRR2NmOXdvejBYcHJBZno3eTY0MjNxU1pSZm91YlJVUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vbG9rZXIudmVzcGVydGluZS5teS5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733671325),
('zGowZRMwvdsZushapWtqKVgluUk2JH3BXXVXAk8A', 1, '180.244.163.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiYUNIY2hJczVxQ2VlUnR5eGlzWUZpSlVROVBodzh3UDVMZXpJdUpQRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3MzM2Njc3ODU7fXM6OToidXNlcl9yb2xlIjtzOjU6ImFkbWluIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MzoiaHR0cHM6Ly9sb2tlci52ZXNwZXJ0aW5lLm15LmlkL3BhbmVsL2tlbG9sYS1pbnRlcnZpZXciO319', 1733675400);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pelamar') NOT NULL DEFAULT 'pelamar',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'faiz', 'feifeifry@gmail.com', NULL, '$2y$12$KhCFexMI8pAXK6ZRz6UxHeoqN8Q.4GlRnUO5P0hnJGea4YyTBwpmS', 'admin', NULL, NULL, NULL),
(2, 'shilfaa', 'shilfaashaphiera@gmail.com', NULL, '$2y$12$HAMlYl7Do.duMJg0OxDeA.u9fCBc/FRMAfBKgJqJExcYCG0/AQXAa', 'pelamar', NULL, NULL, NULL),
(3, 'xearch', 'bitcoin.centralpark@gmail.com', NULL, '$2y$12$BXYkjYh8e7v.Q6HzCCm.CuonUh5kG2De09E4FQtXK9ohoZE8Xzltu', 'pelamar', NULL, '2024-11-25 14:11:13', '2024-11-25 14:11:13'),
(5, 'rama', 'yoonionk@gmail.com', NULL, '$2y$12$/pmyVSCckzuCWYEBJBIaiOAOmp2D7JEk4q03NAQPq/vC9EFJwKsiq', 'pelamar', 'hQihlgtxWs2LK8UzBwS4fLXMzNWjiAZz7IoJ3Jhx47AC0ZXSL40ZcUGNLGSW', '2024-12-04 13:05:54', '2024-12-04 13:05:54'),
(6, 'anantha', 'ananthamarcellino@gmail.com', NULL, '$2y$12$637t2QHGAVnlGKKAIHADI.5NsTsn/qoVGFCyMI3bBmJDug4339t6u', 'pelamar', NULL, '2024-12-06 21:32:23', '2024-12-06 21:32:23'),
(7, 'masbro', 'masbro.am88@gmail.com', NULL, '$2y$12$kERK4ILfheLUfu1.MSCWzOEAHqN2ikxGvz8Fnvjd0Vgv36jpYzV2m', 'pelamar', NULL, '2024-12-06 22:15:14', '2024-12-06 22:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `location` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`location`)),
  `browser` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`browser`)),
  `user_agent` text DEFAULT NULL,
  `last_page` text DEFAULT NULL,
  `referrer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant_profiles`
--
ALTER TABLE `applicant_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applicant_profiles_phone_number_unique` (`phone_number`),
  ADD KEY `applicant_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_jobdesc_id_foreign` (`jobdesc_id`),
  ADD KEY `applications_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interview_schedules`
--
ALTER TABLE `interview_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interview_schedules_application_id_foreign` (`application_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_descs`
--
ALTER TABLE `job_descs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_descs_posted_by_foreign` (`posted_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activities_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant_profiles`
--
ALTER TABLE `applicant_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interview_schedules`
--
ALTER TABLE `interview_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_descs`
--
ALTER TABLE `job_descs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant_profiles`
--
ALTER TABLE `applicant_profiles`
  ADD CONSTRAINT `applicant_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `applications_jobdesc_id_foreign` FOREIGN KEY (`jobdesc_id`) REFERENCES `job_descs` (`id`);

--
-- Constraints for table `interview_schedules`
--
ALTER TABLE `interview_schedules`
  ADD CONSTRAINT `interview_schedules_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_descs`
--
ALTER TABLE `job_descs`
  ADD CONSTRAINT `job_descs_posted_by_foreign` FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
