-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-01-25 16:53:04
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `wip`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(8) NOT NULL COMMENT 'ユーザーID',
  `parking_id_1` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID➀',
  `parking_id_2` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID②',
  `parking_id_3` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID③',
  `parking_id_4` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID④',
  `parking_id_5` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID⑤',
  `parking_id_6` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID⑥',
  `parking_id_7` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID⑦',
  `parking_id_8` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID⑧',
  `parking_id_9` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID⑨',
  `parking_id_10` int(16) DEFAULT NULL COMMENT 'お気に入り駐車場ID⑩'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `favorites`
--

INSERT INTO `favorites` (`user_id`, `parking_id_1`, `parking_id_2`, `parking_id_3`, `parking_id_4`, `parking_id_5`, `parking_id_6`, `parking_id_7`, `parking_id_8`, `parking_id_9`, `parking_id_10`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--
-- テーブル wip.migrations の構造の読み取りエラー: #1932 - Table 'wip.migrations' doesn't exist in engine
-- テーブル wip.migrations のデータ読み取りエラー: #1064 - SQL構文エラーです。バージョンに対応するマニュアルを参照して正しい構文を確認してください。 : 'FROM `wip`.`migrations`' 付近 1 行目

-- --------------------------------------------------------

--
-- テーブルの構造 `parkings`
--

CREATE TABLE `parkings` (
  `id` int(16) NOT NULL COMMENT '駐車場ID',
  `spot_id` int(16) NOT NULL COMMENT '観光地ID',
  `name` varchar(32) NOT NULL COMMENT '駐車場名',
  `postal_code` int(7) NOT NULL COMMENT '郵便番号',
  `address` varchar(128) NOT NULL COMMENT '住所',
  `time_price` varchar(512) NOT NULL COMMENT '利用時間と料金',
  `capacity` int(8) DEFAULT NULL COMMENT '台数',
  `remarks` varchar(512) DEFAULT NULL COMMENT '注意事項等',
  `distance` varchar(8) NOT NULL COMMENT '観光地との距離'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `parkings`
--

INSERT INTO `parkings` (`id`, `spot_id`, `name`, `postal_code`, `address`, `time_price`, `capacity`, `remarks`, `distance`);

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
--
-- テーブル wip.personal_access_tokens の構造の読み取りエラー: #1932 - Table 'wip.personal_access_tokens' doesn't exist in engine
-- テーブル wip.personal_access_tokens のデータ読み取りエラー: #1064 - SQL構文エラーです。バージョンに対応するマニュアルを参照して正しい構文を確認してください。 : 'FROM `wip`.`personal_access_tokens`' 付近 1 行目

-- --------------------------------------------------------

--
-- テーブルの構造 `prefectures`
--

CREATE TABLE `prefectures` (
  `id` int(2) NOT NULL COMMENT '都道府県ID',
  `name` varchar(5) NOT NULL COMMENT '都道府県名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `prefectures`
--

INSERT INTO `prefectures` (`id`, `name`) VALUES
(1, '群馬県'),
(2, '栃木県'),
(3, '茨城県'),
(4, '埼玉県'),
(5, '東京都'),
(6, '神奈川県'),
(7, '千葉県');

-- --------------------------------------------------------

--
-- テーブルの構造 `spots`
--

CREATE TABLE `spots` (
  `id` int(16) NOT NULL COMMENT '観光地ID',
  `name` varchar(16) NOT NULL COMMENT '観光地名',
  `latitude` double NOT NULL COMMENT '観光地緯度',
  `longitude` double NOT NULL COMMENT '観光地経度',
  `prefecture_id` int(2) NOT NULL COMMENT '都道府県ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `spots`
--

INSERT INTO `spots` (`id`, `name`, `latitude`, `longitude`, `prefecture_id`) VALUES
(1, '草津湯畑', 36.62303435089775, 138.59670104469762, 1),
(2, '伊香保温泉　石段街', 36.49833267428463, 138.91654548162825, 1),
(3, '日光東照宮', 36.75782456380179, 139.59937238666035, 2),
(4, '鬼怒川温泉', 36.82407174900673, 139.71222589202293, 2),
(5, '宇都宮駅', 36.559178501500774, 139.89851546998383, 2),
(6, '那珂湊おさかな市場', 36.339946033263026, 140.59438359079337, 3),
(7, '川越 時の鐘', 35.92366692087243, 139.48332426811547, 4),
(8, '浅草寺', 35.71482716654325, 139.79664311507972, 5),
(9, '横浜中華街', 35.44367381176758, 139.64610568516716, 6),
(10, '鎌倉小町通り', 35.32228296927104, 139.55269457756307, 6),
(11, '幕張メッセ', 35.64844168686726, 140.03534922899266, 7),
(12, '築地場外市場', 35.66500692894595, 139.76982513410644, 5),
(13, 'さいたまスーパーアリーナ', 35.89526349816161, 139.6307211682244, 4),
(14, '成田山新勝寺', 35.78625135578107, 140.31828008358212, 7);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL COMMENT 'ユーザーID',
  `name` varchar(128) NOT NULL COMMENT 'ユーザー名',
  `email` varchar(128) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(128) NOT NULL COMMENT 'パスワード',
  `role` int(1) NOT NULL DEFAULT 0 COMMENT 'ロール',
  `created_at` datetime DEFAULT NULL COMMENT '作成日',
  `ban` int(1) NOT NULL DEFAULT 0 COMMENT 'BAN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `ban`) VALUES
(1, 'kanri', 'kanri@gmail.com', '$2y$10$ETxQCxZTEmuUls58SFFcfu6BKjhwoA3zR0RpA1QQ9fgmI.UZy/f/K', 1, '2023-01-15 02:53:03', 0),
(2, 'user001', 'user001@gmail.com', '$2y$10$Rs9WD5tH0/1i8hyK/dVtROqPUQAij.5o72w67hnf7cEhqHAykt8ZW', 0, '2023-01-15 02:53:57', 0),
(3, 'user002', 'user002@gmail.com', '$2y$10$W4aKjhNc.S08YQwLiMOFEe1mnR2RPBgmJWdAKVrQpFRjG03GdhJ2e', 0, '2023-01-15 02:54:15', 0),
(4, 'ban', 'ban@gmail.com', '$2y$10$rUQULhn2Ons.ULH7Jypih.zBTQd75MjV/GkmObT9jQp.ZqdBqthMS', 0, '2023-01-15 02:54:34', 1),
(5, 'guest', 'guest@gmail.com', '$2y$10$mzx31TQYlcyhklRt8fnQuOlax2i8qvlCUzkpQLUEQkXey5zQV1AUO', 2, '2023-01-15 02:59:10', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`);

--
-- テーブルのインデックス `parkings`
--
ALTER TABLE `parkings`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `prefectures`
--
ALTER TABLE `prefectures`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `spots`
--
ALTER TABLE `spots`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `favorites`
--
ALTER TABLE `favorites`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ユーザーID', AUTO_INCREMENT=20;

--
-- テーブルの AUTO_INCREMENT `parkings`
--
ALTER TABLE `parkings`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '駐車場ID', AUTO_INCREMENT=22;

--
-- テーブルの AUTO_INCREMENT `prefectures`
--
ALTER TABLE `prefectures`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT COMMENT '都道府県ID', AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `spots`
--
ALTER TABLE `spots`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '観光地ID', AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ユーザーID', AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
