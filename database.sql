CREATE TABLE `_Role` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL
);

CREATE TABLE `_User` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50),
  `email` varchar(150),
  `phone` varchar(20),
  `pass` varchar(32),
  `role_id` int,
  `created_at` datetime,
  `updated_at` datetime,
  `deleted` int
);

CREATE TABLE `_Category` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) NOT NULL
);

CREATE TABLE `_Product` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `category_id` int,
  `title` varchar(350),
  `price` int,
  `discount` int,
  `thumbnail` varchar(500),
  `description` longtext,
  `created_at` datetime,
  `updated_at` datetime,
  `deleted` int
);

CREATE TABLE `_FeedBack` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `firstname` varchar(30),
  `lastname` varchar(30),
  `email` varchar(150),
  `phone_number` varchar(20),
  `subject_name` varchar(200),
  `note` varchar(500),
  `created_at` datetime,
  `updated_at` datetime,
  `status` int default 0
);

CREATE TABLE `_Orders` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `fullname` varchar(50),
  `email` varchar(150),
  `phone_number` varchar(20),
  `address` varchar(200),
  `note` varchar(255),
  `order_date` datetime,
  `status` int default 0,
  `total_money` int
);

CREATE TABLE `_Order_Details` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `order_id` int,
  `product_id` int,
  `price` int,
  `num` int,
  `total_money` int
);

ALTER TABLE `_User` ADD FOREIGN KEY (`role_id`) REFERENCES `_Role` (`id`);

ALTER TABLE `_Product` ADD FOREIGN KEY (`category_id`) REFERENCES `_Category` (`id`);

ALTER TABLE `_Order_Details` ADD FOREIGN KEY (`product_id`) REFERENCES `_Product` (`id`);

ALTER TABLE `_Order_Details` ADD FOREIGN KEY (`order_id`) REFERENCES `_Orders` (`id`);

ALTER TABLE `_Orders` ADD FOREIGN KEY (`user_id`) REFERENCES `_User` (`id`);
