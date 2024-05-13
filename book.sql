-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 01:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'story', '2024-03-17 03:41:10', '2024-03-17 03:41:10'),
(3, 'horror', '2024-03-27 06:00:51', '2024-03-27 06:00:51'),
(4, 'lkmk', '2024-03-27 06:03:27', '2024-03-27 06:03:27'),
(5, 'romannk', '2024-03-27 06:03:27', '2024-03-27 06:03:27'),
(6, 'poetry', '2024-03-27 06:03:27', '2024-03-27 06:03:27');

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
-- Table structure for table `homepage`
--

CREATE TABLE `homepage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hero_heading` varchar(255) NOT NULL,
  `hero_paragraph` text NOT NULL,
  `hero_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`id`, `hero_heading`, `hero_paragraph`, `hero_image`, `created_at`, `updated_at`) VALUES
(1, 'SIngle place for downloading your digital products', '<p>This is a dummy description for the hero section for the landing page, its dynamic section&nbsp;</p>', '66015d38d0c9f-hero_image.png', '2024-03-25 06:17:12', '2024-03-25 06:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `slug`, `image`, `file`, `description`, `category`, `created_at`, `updated_at`) VALUES
(316, 'The Art of War', 100, 'art-of-war', 'http://127.0.0.1:8000/uploads/3e2ef494-ed00-4232-a65e-08e834bf4d6c.png', 'http://127.0.0.1:8000/uploads/175ad157-14e3-41d3-9005-eabf94ced83f.pdf', '<p>The Art of War\" is a timeless masterpiece written by the ancient Chinese military strategist Sun Tzu. Composed over 2,500 years ago, it remains one of the most influential works on strategy and warfare ever written. Despite its origins in military tactics, its profound insights extend far beyond the battlefield, making it applicable to various aspects of life, including business, politics, and personal development.</p><p>In this classic text, Sun Tzu presents a comprehensive guide to achieving victory through strategic planning, cunning tactics, and psychological manipulation. Divided into thirteen chapters, each containing valuable principles and strategies, \"The Art of War\" covers essential topics such as assessing the enemy, understanding terrain, leveraging strengths, exploiting weaknesses, and the importance of adaptability.</p>', 1, '2024-03-27 06:29:14', '2024-04-03 06:31:50'),
(317, 'The Alchemist', 20, 'alchmsit', 'http://127.0.0.1:8000/uploads/1f75b8c5-69e5-47a5-8d15-8b0922ba7d9a.jpg', 'http://127.0.0.1:8000/uploads/175ad157-14e3-41d3-9005-eabf94ced83f.pdf', '<p>The Alchemist\" is a captivating and philosophical novel written by Brazilian author Paulo Coelho. It tells the story of Santiago, a young Andalusian shepherd who embarks on a journey to follow his dreams and discover the true meaning of life. Set against the backdrop of the mystical Sahara Desert and other enchanting locations, the novel weaves together themes of destiny, personal legend, and the pursuit of one\'s dreams.</p><p>As Santiago travels across the vast expanse of the desert, he encounters a series of characters who impart wisdom and guidance, including a mysterious king, an enigmatic alchemist, and the love of his life, Fatima. Along the way, Santiago learns valuable lessons about courage, perseverance, and the interconnectedness of all things.</p><p>At its core, \"The Alchemist\" is a story about the transformative power of self-discovery and the importance of listening to one\'s heart. Santiago\'s journey serves as a metaphor for the universal quest for purpose and fulfillment, inspiring readers to pursue their own dreams and embrace the journey, no matter how challenging or uncertain it may be.</p>', 1, '2024-03-27 06:37:39', '2024-04-03 06:33:02'),
(318, '1984\" by George Orwell', 55, 'newtest', 'http://127.0.0.1:8000/uploads/095b6544-356e-4c06-9a51-ad6734d8b3a7.png', 'http://127.0.0.1:8000/uploads/175ad157-14e3-41d3-9005-eabf94ced83f.pdf', '<p>1984\" is a dystopian novel by George Orwell that presents a chilling vision of a totalitarian society where individual freedom is severely restricted, and government control is absolute. Set in a bleak future world, the story follows Winston Smith, a low-ranking member of the ruling Party who rebels against the oppressive regime led by Big Brother.</p><p>Through Winston\'s eyes, readers are introduced to the grim reality of life under constant surveillance, where even thoughts are monitored and dissent is swiftly punished. As Winston begins to question the Party\'s propaganda and seek out forbidden truths, he risks everything to resist the dehumanizing forces of tyranny.</p><p>\"1984\" explores themes of power, surveillance, propaganda, and the manipulation of truth, offering a stark warning about the dangers of unchecked authoritarianism. Orwell\'s prophetic vision of a society controlled by government surveillance and propaganda continues to resonate with readers, serving as a powerful reminder of the importance of safeguarding individual liberty and resisting oppression.</p><p>With its thought-provoking narrative and incisive social commentary, \"1984\" remains one of the most influential and widely read novels of the 20th century, inspiring countless readers to contemplate the nature of freedom, truth, and the human spirit.</p>', 1, '2024-03-28 02:08:36', '2024-04-03 06:41:07'),
(337, 'To Kill a Mockingbird', 50, 'to-kill-a-mockingbird', 'http://127.0.0.1:8000/uploads/fbb78b81-8a38-4f40-9c5d-9b7a8823d696.png', 'http://127.0.0.1:8000/uploads/175ad157-14e3-41d3-9005-eabf94ced83f.pdf', '<p>To Kill a Mockingbird\" is a Pulitzer Prize-winning novel written by Harper Lee, published in 1960. Set in the racially divided American South during the 1930s, the story is narrated by Scout Finch, a young girl growing up in the fictional town of Maycomb, Alabama.</p><p>The novel revolves around the Finch family, particularly Scout\'s father, Atticus Finch, a lawyer tasked with defending Tom Robinson, a black man falsely accused of raping a white woman. Through Scout\'s innocent perspective, readers witness the moral and social complexities of small-town life, as well as the pervasive racism and prejudice that permeate society.</p><p>As the trial unfolds, \"To Kill a Mockingbird\" explores themes of racial injustice, empathy, and the loss of innocence. Atticus Finch emerges as a symbol of integrity and moral courage, standing firm in his commitment to uphold justice and defend the oppressed, despite facing backlash and hostility from his community.</p><p>Throughout the novel, Scout and her brother Jem learn valuable lessons about empathy and compassion, grappling with the harsh realities of discrimination and injustice. Their friendship with Boo Radley, a reclusive neighbor, serves as a poignant reminder of the importance of seeing beyond stereotypes and embracing the humanity of others.</p><p>\"To Kill a Mockingbird\" is celebrated for its poignant portrayal of social issues and its timeless message of tolerance and empathy. Harper Lee\'s powerful storytelling and vivid characters have made the novel a classic of American literature, inspiring generations of readers to confront prejudice and injustice, and to strive for a more just and compassionate society.</p>', 1, '2024-04-03 06:47:57', '2024-04-03 06:47:57');

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
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(36, '2019_08_19_000000_create_failed_jobs_table', 1),
(37, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(38, '2024_02_15_094030_create_homepage_table', 1),
(39, '2024_02_17_084142_create_categories_table', 1),
(40, '2024_02_18_082242_create_items_table', 1),
(41, '2024_03_13_075102_create_uploads_table', 1),
(42, '2024_03_17_085650_create_purchases_table', 2),
(43, '2024_03_17_173021_create_users_table', 3),
(44, '2024_03_21_072727_create_settings_table', 4),
(45, '2024_03_21_075344_create_settings_table', 5),
(46, '2024_03_21_082351_create_settings_table', 6),
(47, '2024_03_21_084450_create_settings_table', 7);

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
('maqsood.123@gmail.com', '$2y$12$a0dxvU6Dvtg5paIHZkF0lOJ5Vn45IAOcwZz3khMtWDTvfh7JODG6q', '2024-03-18 06:47:29'),
('maqsood.123kjijiljio@gmail.com', '$2y$12$FCabZ1fhrb5agU6NARj2uuFau4ljYZH79eKEV2MCfGiFEB4eRPKtW', '2024-03-19 06:45:03'),
('maqsood.123ojkljmiumomui@gmail.com', '$2y$12$XuGAfsda0/5D7OAhuCQh3u4TKxO.LAO9AGoKnEnaUEHem01zGwlpa', '2024-03-19 06:10:40'),
('maqsood.123ojmiimkjikmui@gmail.com', '$2y$12$8qBYv7MXYxg18knAd2R4m.xQYgqxE2R2t0ftpEhNqG9X93dKo4Q8C', '2024-03-19 06:07:02'),
('maqsood.12lkjmi@gmail.com', '$2y$12$doJyGOR4LIxTdI44pBvlVe2hwCHvh6MR.46nKmyC3U650Sx7ptDWK', '2024-03-19 07:02:31'),
('maqsood.1kiki@gmail.com', '$2y$12$Yofu.OqYubwzZjY56RO7s.7OHsw1FU6WclP19MgcWiW12AxI7jMjO', '2024-03-20 04:38:16'),
('maqsood.1test@gmail.com', '$2y$12$iXcakHhhXsKs.JvH1BJBBeR2uc4YeAZSxbo70angmr1uWXGD9g29u', '2024-03-19 06:23:33'),
('maqsood.1test13@gmail.com', 'U8IYEnHDgzTNj5cIAVH2uNVZqrjB8f6rgwbtqU9NkFIybhqP4XU7Lu4De076', '2024-03-21 06:43:03'),
('maqsood.1test7@gmail.com', '$2y$12$ySHAMwSwFzCIQaTyRqkm.uy0rbyhvxCWDnvPsoFBkTG0y9RqFLMXG', '2024-03-20 06:41:28'),
('maqsood.1test8@gmail.com', 'nFRN6AP59bxiAOuo9eGNt9ovuuZQZ927c1okmCP0slRjWLiEDhAI38ljhRQm', '2024-03-20 06:44:24'),
('maqsood.1test9@gmail.com', 'OGzc3oue38HSnSprAiyJkgovr3iF6kbfJXuNJvmopRFpVyZNKuEAKuWm8Unl', '2024-03-20 07:04:22'),
('maqsood.23@gmail.com', '$2y$12$u6spiLgPsKqOBs30aAcBHeAul6R8mot1bayXdhLpcnBsDzggxMwBe', '2024-03-20 01:49:23'),
('maqsood.test2@gmail.com', '$2y$12$BqiYxf/DXXJMipUa5O59..BIJ1kcU9sOFpxlSjEeYLWS3V0cfqzRW', '2024-03-19 06:31:30'),
('maqsood1@gmail.com', '$2y$12$vawqtDK0rELx5HXHTIMTj.SsZhz0x493Ub0LIlDK64SmXHk7RLryW', '2024-03-18 06:47:45'),
('maqsood18l;lko979@gmail.com', '$2y$12$enZeykGNuB/zlSaLiI38ieYXqfgqZ5cuIJODindwI.x7OH6LrTreS', '2024-03-19 06:51:53'),
('maqsood1jmiuui@gmail.com', '$2y$12$9izETP3L8y7fMc7Etp9hVujjs5zdqcPZZgxQcDTCQuecHyB8LIJ3O', '2024-03-19 06:18:23'),
('maqsood1ojjlkjkoi79@gmail.com', '$2y$12$Ui957NDGb7SYjantPO2KPO1RMieN0TZ0OPItc1Hl8wQIfUNv4tLze', '2024-03-19 06:55:07'),
('maqsood1ojoilmloll@gmail.com', '$2y$12$BxYSRcWpsyFZHeqpDY8tw.9.9o0/yUD3ZRgvEbGbVR4VlK5fEuVF6', '2024-03-19 06:39:13'),
('maqsood1test10@gmail.com', 'CBLCD7dw93WlTuUFx20fELLh4y4Cd56ejVz216dOkzRy9uLr8mFFXhteewZr', '2024-03-21 02:07:23'),
('maqsood1test11@gmail.com', 'rsOUzOCmWvlJk3gIx00YgM6B7OOiMZjHtCCfbJ6l8oSW23kL3ykN9C1RW8cM', '2024-03-21 02:21:11'),
('maqsood1test8@gmail.com', '6VPAILYcGXm86nIN0n47e0510vdlBvP8TuvcrHpyQ6ezbpOb6h36BYgrFKD3', '2024-03-20 07:01:41'),
('maqsood1token3@gmail.com', 'okjNuWkpRx3QCnGLtytVOwDkuls80LtvUiEDzg1rFZMq4zYtflhydHibac6Q', '2024-03-20 05:52:47'),
('maqsood1token5@gmail.com', 'nSEeqVk5Vu8ylJ7sb6uYM6CR1gNEknA293RVJtZiCoB7WWuffQYR36CkCW6A', '2024-03-20 06:01:18'),
('maqsoodmn03@gmail.com', '$2y$12$Ty4kIqQbOf2ezZJ6IzU/weiVJMuiWNw5R2gTVowHxkmUN8NalpS82', '2024-04-03 06:53:51'),
('maqsoodojioii@gmail.com', '$2y$12$xl49vB/DgM7zyghMBilQduoa/B0fshZTzF6roU9blC74Nj33s1f86', '2024-03-19 06:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `item_id`, `created_at`, `updated_at`) VALUES
(168, 139, 318, '2024-03-25 03:03:56', '2024-03-30 03:03:56'),
(169, 139, 317, '2024-03-31 03:03:56', '2024-03-30 03:03:56'),
(170, 143, 320, '2024-03-30 03:06:07', '2024-03-30 03:06:07'),
(171, 143, 318, '2024-03-30 03:06:07', '2024-03-30 03:06:07'),
(172, 139, 319, '2024-03-30 03:10:16', '2024-03-30 03:10:16'),
(173, 139, 317, '2024-03-30 03:10:16', '2024-03-30 03:10:16'),
(174, 144, 320, '2024-03-30 03:13:02', '2024-03-30 03:13:02'),
(175, 144, 319, '2024-03-30 03:13:02', '2024-03-30 03:13:02'),
(176, 139, 319, '2024-03-30 03:14:49', '2024-03-30 03:14:49'),
(177, 139, 318, '2024-03-30 03:14:49', '2024-03-30 03:14:49'),
(178, 145, 320, '2024-04-03 01:46:37', '2024-04-03 01:46:37'),
(179, 145, 318, '2024-04-03 01:46:37', '2024-04-03 01:46:37'),
(180, 145, 319, '2024-04-03 01:46:37', '2024-04-03 01:46:37'),
(181, 146, 320, '2024-04-03 06:19:12', '2024-04-03 06:19:12'),
(182, 146, 319, '2024-04-03 06:19:12', '2024-04-03 06:19:12'),
(183, 146, 318, '2024-04-03 06:19:12', '2024-04-03 06:19:12'),
(184, 147, 318, '2024-04-03 06:20:43', '2024-04-03 06:20:43'),
(185, 147, 317, '2024-04-03 06:20:43', '2024-04-03 06:20:43'),
(186, 148, 318, '2024-04-03 06:24:32', '2024-04-03 06:24:32'),
(187, 148, 316, '2024-04-03 06:24:32', '2024-04-03 06:24:32'),
(188, 148, 317, '2024-04-03 06:24:32', '2024-04-03 06:24:32'),
(189, 149, 318, '2024-04-03 06:25:48', '2024-04-03 06:25:48'),
(190, 149, 317, '2024-04-03 06:25:48', '2024-04-03 06:25:48'),
(191, 149, 316, '2024-04-03 06:25:48', '2024-04-03 06:25:48'),
(192, 150, 318, '2024-04-03 06:28:58', '2024-04-03 06:28:58'),
(193, 150, 317, '2024-04-03 06:28:58', '2024-04-03 06:28:58'),
(194, 151, 337, '2024-04-03 06:49:24', '2024-04-03 06:49:24'),
(195, 151, 318, '2024-04-03 06:49:24', '2024-04-03 06:49:24'),
(196, 151, 316, '2024-04-03 06:49:24', '2024-04-03 06:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'STRIPE_KEY', 'Stripe key', 'pk_test_51OmC8HArvCxUsgFQGaCMoZ300O7dNIFbzlTZYXdXpJYAVCymHSmyKlVhUCGtJ1zQpFmvC1bc2eKiSWU3SCNdouQb00G13BjFQF', '2024-03-21 03:47:53', '2024-03-21 06:16:30'),
(2, 'STRIPE_SECRET', 'Stripe secret', 'sk_test_51OmC8HArvCxUsgFQ95QRFQ3WRLPDJaFgDE2UxNGhIhWjb6H8E4Ocznx6ZsrdW70RDDfZClyf8szzhMOjvWP5t2Db00krvcyWTl', '2024-03-21 03:47:53', '2024-03-21 06:16:30'),
(3, 'PAYPAL_KEY', 'Paypal key', 'sb-kzyl130111673@business.example.com', '2024-03-21 03:47:53', '2024-03-24 05:01:27'),
(4, 'PAYPAL_SECRET', 'Paypal secret', 'access_token$sandbox$ps7g7wcpzkpz2b86$a2e02d00f567d58a7b08c2106d5045ae', '2024-03-21 03:47:53', '2024-03-24 05:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file`, `created_at`, `updated_at`) VALUES
(1, '82e1528f-08d7-4a33-b420-6f9e112a49ba.jpg', '2024-03-27 02:51:55', '2024-03-27 02:51:55'),
(2, '3e2ef494-ed00-4232-a65e-08e834bf4d6c.png', '2024-03-27 02:51:55', '2024-03-27 02:51:55'),
(3, '175ad157-14e3-41d3-9005-eabf94ced83f.pdf', '2024-03-27 06:23:11', '2024-03-27 06:23:11'),
(4, '24018745-f34c-40b6-98cb-4793cff9974a.png', '2024-03-27 06:31:25', '2024-03-27 06:31:25'),
(5, '3273ce81-b4d2-44cd-b5d5-bd3a0ec95150.jpg', '2024-03-27 06:34:53', '2024-03-27 06:34:53'),
(6, '1f75b8c5-69e5-47a5-8d15-8b0922ba7d9a.jpg', '2024-03-27 06:37:09', '2024-03-27 06:37:09'),
(7, '095b6544-356e-4c06-9a51-ad6734d8b3a7.png', '2024-04-03 06:40:45', '2024-04-03 06:40:45'),
(8, 'fbb78b81-8a38-4f40-9c5d-9b7a8823d696.png', '2024-04-03 06:40:45', '2024-04-03 06:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state/country` varchar(255) DEFAULT NULL,
  `postal/zip` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `address`, `state/country`, `postal/zip`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(57, 'maqsood', NULL, NULL, NULL, NULL, 'maqsoodmn03@gmail.com', NULL, 1, NULL, '$2y$12$2wZz1XGtqA5KTJdpYclqCee2sYnve.XKttUdXeoj5nZaYuhEjiIDS', '', '2024-03-18 04:52:18', '2024-03-20 06:30:20'),
(139, 'maqsood', 'khan', 'jarwar', 'pakistan', 657, 'maqsood@gmail.com', NULL, 0, NULL, '$2y$12$7QM80GmCw/mFTQbdm0/FmuIKzuNWYAXVDdqkMtR2.Vk5HpKShWelq', '', '2024-03-25 06:32:25', '2024-03-25 06:58:20'),
(140, 'maqsood', 'khan', 'jarwar', 'pakistan', 657, 'maqsood1@gmail.com', NULL, 0, NULL, '$2y$12$HOf51jFOsCgwIcFcWQ6uNeLFX6SVKN2UoeIUScl.n0K1cttPDY06K', NULL, '2024-03-26 03:37:44', '2024-03-26 03:37:44'),
(141, 'maqsood', 'khan', 'jarwar', 'pakistan', 657, 'maqsood.123@gmail.com', NULL, 0, NULL, '$2y$12$PJGG9WOa29K9DVMgW.Kbqe1rVZjcWYIJZ1rkursAqmUHvz40i8wzi', NULL, '2024-03-28 04:06:04', '2024-03-28 04:06:04'),
(142, 'maqsood', 'khan', 'jarwar', 'pakistan', 657, 'maqsoodggtkjjji@gmail.com', NULL, 0, NULL, '$2y$12$jDvMxnMDCGo0Vo1Tq/b.VOxYKiOvFwKKYiq.l6K1jiYBxTVqy7LkW', NULL, '2024-03-30 02:17:27', '2024-03-30 02:17:27'),
(143, 'maqsood', 'khan', 'jarwar', 'pakistan', 657, 'maqsoodj9ojknki@gmail.com', NULL, 0, NULL, '$2y$12$v3TQuJ1zg8GPw8kEq.m4SOhNUuu3YACN1obS6S6P0.PCKG3Sl68q.', NULL, '2024-03-30 03:06:07', '2024-03-30 03:06:07'),
(144, 'maqsood', 'khan', 'jarwar', 'pakistan', 657, 'maqsoodljjoiji@gmail.com', NULL, 0, NULL, '$2y$12$z/1KN4SkGH.plVCXetU6NOhc1UlhfNFHA3Cxz2GaxpYZP6S4q8hYe', NULL, '2024-03-30 03:13:02', '2024-03-30 03:13:02'),
(145, 'maqsood', 'ali', 'jarwar', 'pakistan', 657, 'maqsood.1tuy@gmail.com', NULL, 0, NULL, '$2y$12$AIgGeuI2ea6M0yN9NCxnZui78JVZwaUHQhrBgW36WDfg58UO3iVMu', NULL, '2024-04-03 01:46:37', '2024-04-03 01:46:37'),
(146, 'maqsood', 'ali', 'jarwar', 'pakistan', 657, 'maqsoodhiuimuig@gmail.com', NULL, 0, NULL, '$2y$12$mGc7r1HZ56UcZWjJ5wg5g.nzKLSgTZx8tv2jXnWhURViWBi2B10rK', NULL, '2024-04-03 06:19:12', '2024-04-03 06:19:12'),
(147, 'maqsood', 'ali', 'jarwar', 'pakistan', 657, 'maqsoodoljm89ewa@gmail.com', NULL, 0, NULL, '$2y$12$f3DqDDjG0m61eN4Z1vCaO.LuqXKk8egzuasVfUoJA7S1fhR.oK9Im', NULL, '2024-04-03 06:20:43', '2024-04-03 06:20:43'),
(148, 'maqsood', 'khan', 'jarwar', 'pakistan', 657, 'maqsood.1lmkjnk3@gmail.com', NULL, 0, NULL, '$2y$12$hDkwly99CUIlBYxEaGNoqenJV.jpTgs6U5hDrGyrOxaZMCMUMNWgq', NULL, '2024-04-03 06:24:32', '2024-04-03 06:24:32'),
(149, 'maqsood', 'khan', 'jarwar', 'pakistan', 657, 'maqsooduhjyf5tswa@gmail.com', NULL, 0, NULL, '$2y$12$rGdsEsYSrW.SnXxGkrjTQ.ql1TcgSeM9y55PBNtkWrlkMseLWFTjm', NULL, '2024-04-03 06:25:48', '2024-04-03 06:25:48'),
(150, 'maqsood', 'khan', 'jarwar', 'pakistan', 657, 'maqsoodtywqfdydq@gmail.com', NULL, 0, NULL, '$2y$12$Z.Hgm.G1VzvlXCZUt3lnZ.NxGRbpr.v9vvLwzf7CQktaB1q7S8ING', NULL, '2024-04-03 06:28:58', '2024-04-03 06:28:58'),
(151, 'maqsood', 'ali', 'jarwar', 'pakistan', 657, 'maqsood.12lrssekojojioj@gmail.com', NULL, 0, NULL, '$2y$12$tTbHDByGOLr66iRgbnbsJ.hvFZIrbHGm/0tBkN.O.ScVbd8fdfVH6', NULL, '2024-04-03 06:49:24', '2024-04-03 06:49:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
