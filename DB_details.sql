-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 22, 2015 at 06:01 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(10) NOT NULL,
  `album_name` varchar(512) NOT NULL,
  `album_year` varchar(128) NOT NULL,
  `album_img` varchar(512) NOT NULL,
  `music_director` varchar(50) NOT NULL,
  `album_desc` varchar(10000) NOT NULL,
  `language` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `album_name`, `album_year`, `album_img`, `music_director`, `album_desc`, `language`, `date_created`) VALUES
(8, 'Annakili', '1976', '00album6.jpg', 'arr', 'This os a slkdnfksdlnflsdknflksndfllk oksndfklsdnf', 'tamil', '2015-06-26 13:30:48'),
(9, 'karakattakaran', '1989', '00ilayaraaja.png', 'arr', 'karakattakaranalsjkdlksdflsdk osidhfkjsdn osidhfosdi sdoifsoid f', 'hindi', '2015-06-26 13:30:48'),
(10, 'Koyil Kaalai', '1993', '00album1.jpg', 'arr', 'Koyil Kaalaislkm saondfsoknf oasndoas dopasjas asonda', 'tamil', '2015-06-26 13:30:48'),
(11, 'sup', '1922', '0logo123.png', 'arr', 'sdklj okansdosan dsaond osaindsa doiasn dasoijdasoi dasoid asodijasoidh saoidas jdoi', 'tamil', '2015-06-26 13:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `song_id` int(10) NOT NULL,
  `album_id` int(10) NOT NULL,
  `user_id` int(100) NOT NULL,
  `is_downloaded` tinyint(1) NOT NULL DEFAULT '0',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `cart_only`
--
CREATE TABLE `cart_only` (
`id` int(11)
,`song_id` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `song_session` varchar(16) NOT NULL,
  `browser` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `email`, `login_at`, `song_session`, `browser`) VALUES
(1, 'arvind.mib@gmail.com', '2015-07-22 15:53:08', '07a95d1ab25c5e38', NULL),
(2, 'arvind.mib@live.com', '2015-06-26 16:38:45', 'ad454ace762900b1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_slider`
--

CREATE TABLE `main_slider` (
  `id` int(11) NOT NULL,
  `image_name` varchar(40) NOT NULL,
  `show_hide` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_slider`
--

INSERT INTO `main_slider` (`id`, `image_name`, `show_hide`) VALUES
(1, 'test1.jpg', 1),
(2, 'test2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `song_id` int(10) NOT NULL,
  `album_id` int(10) NOT NULL,
  `song_name` varchar(10000) NOT NULL,
  `demo_song` varchar(50) NOT NULL,
  `main_song` varchar(50) NOT NULL,
  `demo_song_duration` time NOT NULL,
  `main_song_duration` time NOT NULL,
  `price` varchar(10000) NOT NULL,
  `artist_details` varchar(10000) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `album_id`, `song_name`, `demo_song`, `main_song`, `demo_song_duration`, `main_song_duration`, `price`, `artist_details`, `added_at`) VALUES
(1, 8, 'Mental Manadhil', '1.Mental_Manadhil.mp3', '1.Mental_Manadhil.mp3', '00:02:02', '00:05:25', '10.00', 'Arr', '2015-06-26 15:15:42'),
(2, 8, 'Bagulu Odayum', 'Bagulu Odayum Dagulu Mari.mp3', 'Bagulu Odayum Dagulu Mari.mp3', '00:03:09', '00:17:02', '20.00', 'test, test, test', '2015-06-26 15:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `songs_details`
--

CREATE TABLE `songs_details` (
  `song_id` int(10) NOT NULL,
  `album_id` int(10) NOT NULL,
  `song_name` varchar(10000) NOT NULL,
  `price` varchar(10000) NOT NULL,
  `artist_details` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` text NOT NULL,
  `api_key` varchar(32) NOT NULL,
  `verification_code` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `api_key`, `verification_code`, `status`, `created_at`) VALUES
(3, 'arvind', 'arvind.mib@gmail.com', '$2a$10$64036d2f2de8bb5af7fe3umw8uHl/2/LJdoyaH5n8svkmuqW7xefu', '9da19af4383942e0a5b8b3004550704d', '', 1, '2015-07-16 17:23:00'),
(4, 'arvind1', 'arvind.mib@live.com', '$2a$10$e40b9bf4cb512aa0ee19fOWqZompO2kVSml2Esx0F6QCznDdQpEJi', '29f299e8e1f0297a6bd7bb780ebddedb', '', 1, '2015-07-17 08:25:58'),
(5, 'arvind', 'arvind.mib@sample.com', '$2a$10$2ba9289c1d3b2e797807buXOh4qTClGWtz8YCl1IDPJDHnE.iX3mm', '55ef5c28d965fbfc569f38de1776c668', '', 1, '2015-07-17 08:31:01'),
(6, 'arvind12', 'arvind.mib@test.com', '$2a$10$be703613da87d04051bfeOMFIIOF25kgalQaAXgAkYoGYBhPgyBo2', '8e3acbbc0581837453a6f21a32c64275', '', 1, '2015-07-17 08:32:25'),
(7, 'test', 'test@test.com', '$2a$10$6d456e2a41c67a66e57faumVpqpt9cLaBR1dE.bs/xAs0i8dqqRLy', '2319d9440fb979ceb3c628e294e37b46', '', 1, '2015-07-17 08:34:13'),
(8, 'arvind', 'arvind.mib@lll.com', '$2a$10$e25199e5fea96407f4859eutpuG0fsUd4aiVv5FbUIGQrR6rAN7L.', 'e651afc61b1900451c2c45fab29c86cf', '', 1, '2015-07-17 08:35:01'),
(9, 'test1234', 'arvind.mib@test1234.com', '$2a$10$e19bcf38daca1abd34538unYJelRLQd6vuw2YPuY7U6EL/4grbArS', 'ebc8a93440fc1f78418b90a0e49b6575', '', 1, '2015-07-17 15:44:45'),
(10, 'ttretstt', 'arvind.mib@skldfmsldkmfsd.com', '$2a$10$42d769cb99a01b6bae74buKcEjUmTlpm6cGozJRVAihAr1HZz4Ch.', '8111625a138dd6ee8f32e243f74de422', '', 1, '2015-07-17 15:46:19'),
(11, 'aaaaaa', 'aaaaa@ttte.com', '$2a$10$55f9ce18a31a6dc9d0574uJ3w73D2BwWNKXuWOidgryyU48Qkivn.', '2edb617c1ae2db598ac585969e762041', '', 1, '2015-07-17 15:52:21'),
(12, 'ttretstt', 'arvind.mib@skdnfsdknfdslksd.com', '$2a$10$3b75f8548786b6b8c71c7eB373b85ARoAFfRIxe2rlbGDt8v5.rFO', '6f05baf801f11fc568c9a0cee66c7f2b', '', 1, '2015-07-17 15:56:45'),
(13, 'ttretstt2', 'alkdlk@ttt2398.com', '$2a$10$6a3d2bdca4732ee259f25uZxqgz6B4lA.UkdtoNy.cARPoIteEoeK', 'd83c0e5e3a511b9e54a68c291dec2462', '', 1, '2015-07-17 15:59:27'),
(14, 'sldkm', 'lsdkm@sdlkmf.com', '$2a$10$ddeee3f65e9d5934d2259uBmMw.MjUNJSrFSJTob5Odst1mBPtjc2', '974dcf39afa14b837ae39ca2ca68fe29', '', 1, '2015-07-17 16:01:16'),
(15, 'arvind21312', 'lsdkm@sdlkmwef.com', '$2a$10$c1fd1fac3f64552e06fe0uoceBSBhBc3ScYxDvo.gLEJxy20x80Ae', '151a0c69a2a79d437ce60eda79aac580', '', 1, '2015-07-17 16:03:14'),
(16, 'ttretstt2q', 'asdad@12.com', '$2a$10$d623f2fe27dd3fbbb5b85uPAwphGIqQFH0JWMNDywo5IuDXgdrnai', '53d5d46a3258680e2b03a8c26edb104e', '', 1, '2015-07-17 16:06:27'),
(17, 'arvinddslknfdslknf', 'saasd@re.com', '$2a$10$27f2f3d3fd3813ff8461auEazvG/PV5XecuKDNkl7JgQ7I/zOUNvy', '4b1f46f043e37f98afe982e79e26abc4', '', 1, '2015-07-17 16:09:03'),
(18, 'sdlkmf', 'alkdlk@tttw2398.com', '$2a$10$543d559a0ee67091747eaOeCLbl6OJI3bDpt0mLQoeC/0teMotx5u', 'db1e31158696d6f1f31350ae377525ca', '', 1, '2015-07-17 16:10:29'),
(19, 'sddsf', 'dsdsf@23s234.com', '$2a$10$6927ad4dfa6a78c29a30bulDWlav/0emUbzzOkQj7YPoDROX8D6sm', 'f5c64535a3587a4be0d4d1d0e97b05e7', '', 1, '2015-07-17 16:22:40'),
(20, 'sdkln', 'lksdn@ttt.com', '$2a$10$73e9d5ec2c2e83d1486a6u4kxRCcSWX3.RlwM9C0.65g6rPNFbsPW', '65833de78b92a769b3f9a761551c8e89', '', 1, '2015-07-17 16:26:43'),
(21, 'aslkdnflkdsnf', 'sdlknfldskn@ttsjdlf.com', '$2a$10$d76918f5e169454f03a32uO5ptLcUtgZrCPLbRT0XWtoraobTo6BC', '95fff6d4d6815ba4a98156c0cfe587b3', 'c9387904820386648b9a9bbcd6cc2f9b', 0, '2015-07-17 16:58:52'),
(22, 'dslkmfsdlkmf', 'arvind.mib@skldfsdlkmmsldkmfsd.com', '$2a$10$cae415ef3ed76f51022e8e.6ZGQHJDJo17Lf9BViERCY//AH9.ty.', 'be6c5108f5cdbe3b356d1915e1fe0ddf', '6a4387b6c57688ed16f0bcdf416023a3', 0, '2015-07-17 17:00:34'),
(23, 'aslkdfnsldkn', 'sdlkfnldsknf@12.com', '$2a$10$3798fd49697f29efe49eaOgJH2ZlNFiIztFxHiizWEXzXALWtUc26', '7b55a185ff7b21564bd6d2c6101505a3', '0b895763c5ab97104340af048e4b3d63', 1, '2015-07-17 17:17:39'),
(24, 'tttttt', 'asjhdsakjn@lksndf.com', '$2a$10$d0fc0b8bb9cb6e99e7caau/UleeuVjY9wGeprvrBTQ0Kx5uB6fmPe', 'af4a0be27ea41dda082f0f10a25fdf61', 'c26102f73ab704007a02d120f5f61c78', 1, '2015-07-20 15:31:54'),
(25, 'sdlkmf', 'sdlkmf@ttt.com', '$2a$10$835aa585791a63518b9e0e2D9pYrURPO0OKIE5PdQieVoY8.piEvW', '0ae8c83cf0171695aced0308d3ac4194', '19a95ec83de532ecad4ebe567ce2c649', 1, '2015-07-20 18:07:42'),
(26, 'sdlknflksdn', 'slkndf@1223.com', '$2a$10$50f4e507231faa9a32c8dOq3xtXszdFprXtA67cn4ZVSomAi3KiMm', 'e4189dcc6f0686223b200e3fb71536be', 'a265b303ee68f179786c75e109e2b112', 1, '2015-07-20 18:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_tasks`
--

CREATE TABLE `user_tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `cart_only`
--
DROP TABLE IF EXISTS `cart_only`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cart_only` AS select `users`.`id` AS `id`,`cart`.`song_id` AS `song_id` from (`users` join `cart`) where (`users`.`id` = `cart`.`user_id`);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_slider`
--
ALTER TABLE `main_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `main_slider`
--
ALTER TABLE `main_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user_tasks`
--
ALTER TABLE `user_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD CONSTRAINT `user_tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_tasks_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
