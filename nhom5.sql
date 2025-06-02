-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 18, 2024 lúc 11:56 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhom5`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id_user`, `id_product`, `soluong`) VALUES
(6, 10, 1),
(6, 1, 2),
(6, 82, 1),
(5, 10, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufactures`
--

CREATE TABLE `manufactures` (
  `id_manu` int(11) NOT NULL,
  `name_manu` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manufactures`
--

INSERT INTO `manufactures` (`id_manu`, `name_manu`, `icon`, `created_at`) VALUES
(1, 'SamSung', '', '2024-12-05'),
(2, 'Oppo', '', '2024-12-05'),
(3, 'Apple', '', '2024-12-05'),
(4, 'Realme', '', '2024-12-05'),
(5, 'Sony', '', '2024-12-05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tongtien` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `id_user`, `tongtien`, `created_at`) VALUES
(11, 5, 6990000, '2024-12-18 00:00:00'),
(12, 5, 4690000, '2024-12-18 17:33:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_details`
--

INSERT INTO `payment_details` (`id`, `payment_id`, `id_product`, `soluong`, `price`) VALUES
(4, 11, 10, 2, 4800000),
(5, 11, 81, 1, 2190000),
(6, 12, 1, 1, 2400000),
(7, 12, 64, 1, 2290000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `manu_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `feature` tinyint(4) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `manu_id`, `price`, `image`, `description`, `feature`, `create_at`, `type_id`) VALUES
(1, 'SamSung galaxys24 ultra', 1, 2400000, '10a224fce53bf7fb48c745c6d63284243eee1036_1.jpg', 'Galaxy S24 và S24+ là thiết bị điện thoại mới nhất của Samsung, với màn hình lớn, pin lớn, khung kim loại và Galaxy AI dung lượng bộ nhớ tới 128GB. Xem thông tin chi tiết, màu sắc, đặc biệt và thanh toán trước giảm 1 triệu.', 0, '2024-10-26 14:32:36', 1),
(2, 'OppoA92', 2, 600000, 'oppo-a92-tim-600x600.jpg', 'Điện thoại OPPO A92 – Hệ thống 4 camera sau 48MP chụp ảnh ấn tượng. OPPO A92 là mẫu smartphone tầm trung vừa mới được OPPO cho ra mắt, gây ấn tượng với thiết kế màn hình khoét luoon', 0, '2024-10-26 14:32:36', 1),
(3, 'Iphone 16ProMax', 3, 2600000, 'iPhone-16-Pro-Series-Desert11345601058.jpg', 'Tất cả các trung tâm dữ liệu Apple đều sử dụng 100% điện tái tạo. iPhone 16 sử dụng nhiều kim loại tái chế nhất từ trước đến nay: hơn 95% lithium trong pin là lithium tái chế. 9 100% vàng', 0, '2024-10-26 14:32:36', 1),
(4, 'Realme gt neo6', 4, 700000, 'realme-gt-neo6-se-1.png', 'alme là thương hiệu công nghệ chuyên cung cấp điện thoại thông minh chất lượng cao, tập trung vào nhu cầu của người dùng và đưa ra sản phẩm với hiệu suất mạnh mẽ ', 0, '2024-10-26 14:32:36', 1),
(5, 'Redme note 11 pro', 4, 8000000, 'note-11-pro-_1684227634.jpg.jpg', 'Mua online điện thoại, smartphone Xiaomi Redmi chính hãng, giá rẻ. Giao nhanh, đem nhiều mẫu chọn, tháng đầu lỗi 1 đổi 1, trả góp 0%, bảo hành tại hơn 2000 điểm toàn quốc', 0, '2024-10-26 14:32:36', 1),
(6, 'Redme note 12 pro', 4, 8000000, 'xiaomi-redmi-12-pro-4g-xanh-thumb-600x600.jpg', 'Mua online điện thoại, smartphone Xiaomi Redmi chính hãng, giá rẻ. Giao nhanh, đem nhiều mẫu chọn, tháng đầu lỗi 1 đổi 1, trả góp 0%, bảo hành tại hơn 2000 điểm toàn quốc', 0, '2024-10-26 14:32:36', 1),
(7, 'Redme note 13 pro', 4, 8000000, 'xiaomi-redmi-note-13-pro-5g-xanhla-thumb-600x600.jpg', 'Mua online điện thoại, smartphone Xiaomi Redmi chính hãng, giá rẻ. Giao nhanh, đem nhiều mẫu chọn, tháng đầu lỗi 1 đổi 1, trả góp 0%, bảo hành tại hơn 2000 điểm toàn quốc', 0, '2024-10-26 14:32:36', 1),
(8, 'Redme note 10 pro', 4, 8000000, 'xiaomi-redmi-note-10-pro-thumb-xam-600x600-600x600.jpg', 'Mua online điện thoại, smartphone Xiaomi Redmi chính hãng, giá rẻ. Giao nhanh, đem nhiều mẫu chọn, tháng đầu lỗi 1 đổi 1, trả góp 0%, bảo hành tại hơn 2000 điểm toàn quốc', 0, '2024-10-26 14:32:36', 1),
(9, 'Redme note 9 pro', 4, 8000000, '10046259-dien-thoai-xiaomi-redmi-note-9-pro-6gb-128gb-xanh-la-1.jpg', 'Mua online điện thoại, smartphone Xiaomi Redmi chính hãng, giá rẻ. Giao nhanh, đem nhiều mẫu chọn, tháng đầu lỗi 1 đổi 1, trả góp 0%, bảo hành tại hơn 2000 điểm toàn quốc', 0, '2024-10-26 14:32:36', 1),
(10, 'SamSung galaxys23 ultra', 1, 2400000, '50244_samsung_galaxy_s23_ultra_den_7.jpg', 'Galaxy S24 và S24+ là thiết bị điện thoại mới nhất của Samsung, với màn hình lớn, pin lớn, khung kim loại và Galaxy AI. Xem thông tin chi tiết, màu sắc, đặc biệt và thanh toán trước giảm 1 triệu.', 0, '2024-10-26 14:32:36', 1),
(11, 'SamSung galaxys22 ultra', 1, 2400000, 'sm-s908_galaxys22ultra_front_burgundy_211119_2.png', 'Galaxy S24 và S24+ là thiết bị điện thoại mới nhất của Samsung, với màn hình lớn, pin lớn, khung kim loại và Galaxy AI. Xem thông tin chi tiết, màu sắc, đặc biệt và thanh toán trước giảm 1 triệu.', 0, '2024-10-26 14:32:36', 1),
(12, 'SamSung galaxys20ultra', 1, 2400000, 'sm-s908_galaxys22ultra_front_burgundy_211119_2.png', 'Galaxy S24 và S24+ là thiết bị điện thoại mới nhất của Samsung, với màn hình lớn, pin lớn, khung kim loại và Galaxy AI. Xem thông tin chi tiết, màu sắc, đặc biệt và thanh toán trước giảm 1 triệu.', 0, '2024-10-26 14:32:36', 1),
(13, 'SamSung galaxys19ultra', 1, 2400000, 'samsung-galaxy-s20-ultra-600x600-1-400x400.jpg', 'Galaxy S24 và S24+ là thiết bị điện thoại mới nhất của Samsung, với màn hình lớn, pin lớn, khung kim loại và Galaxy AI. Xem thông tin chi tiết, màu sắc, đặc biệt và thanh toán trước giảm 1 triệu.', 0, '2024-10-26 14:32:36', 1),
(14, 'Iphone 12 Pro Max', 3, 2400000, 'thumb_IP12Pro_4.png', 'iPhone 12 Pro Max 128GB tiếp tục khẳng định vị thế của mình như một trong những sản phẩm cao cấp và đẳng cấp nhất. Với công nghệ 5G tiên tiến, camera chất lượng cao, và thiết kế sang trọng, chiếc điện thoại này chắc chắn xứng đáng là lựa chọn hàng đầu cho những người dùng khó tính nhất.', 0, '2024-10-26 14:32:36', 1),
(15, 'Iphone 8 Plus', 3, 2400000, 'iphone-8-plus-hh-600x600-400x400.jpg', 'Thừa hưởng những thiết kế đã đạt đến độ chuẩn mực, thế hệ iPhone 8 Plus thay đổi phong cách bóng bẩy hơn và bổ sung hàng loạt tính năng cao cấp cho trải nghiệm sử dụng vô cùng tuyệt vời.', 0, '2024-10-26 14:32:36', 1),
(16, 'Iphone 11', 3, 2400000, 'iphone-11-trang-600x600.jpg', 'Apple đã chính thức trình làng bộ 3 siêu phẩm iPhone 11, trong đó phiên bản iPhone 11 64GB có mức giá rẻ nhất nhưng vẫn được nâng cấp mạnh mẽ như iPhone Xr ra mắt trước đó.', 0, '2024-10-26 14:32:36', 1),
(17, 'Sony Xperia 5 mark 3', 5, 2400000, 'sony-xperia-5-mark-3-8gb-128gb-ban-my-cu-99-xtmobile.jpg', 'Sony Xperia 5 Mark 3 - Công nghệ tiên phong, thiết kế tuyệt đẹp\r\nCùng Clickbuy khám phá Sony Xperia 5 Mark 3 – sự kết hợp hoàn hảo giữa công nghệ tiên phong và thiết kế tuyệt đẹp. Được trang bị những công nghệ mới nhất từ Sony, chiếc điện thoại này mang đến hiệu suất vượt trội cùng trải nghiệm hình ảnh và âm thanh tuyệt hảo. Với thiết kế tinh tế và màn hình OLED sắc nét, Xperia 5 Mark 3 không chỉ là một thiết bị di động mà còn là một tác phẩm nghệ thuật. Hãy trải nghiệm đỉnh cao của công nghệ và thiết kế của thiết bị này.', 0, '2024-10-26 14:32:36', 1),
(18, 'OppoA91', 2, 600000, 'oppo-a91-trang-600x600-600x600.jpg', 'Điện thoại OPPO A91 – Hệ thống 4 camera sau 48MP chụp ảnh ấn tượng. OPPO A92 là mẫu smartphone tầm trung vừa mới được OPPO cho ra mắt, gây ấn tượng với thiết kế màn hình khoét luoon', 0, '2024-10-26 14:32:36', 1),
(19, 'OppoA90', 2, 600000, 'oppo-a9-600x600-trang-600x600.jpg', 'Điện thoại OPPO A91 – Hệ thống 4 camera sau 48MP chụp ảnh ấn tượng. OPPO A92 là mẫu smartphone tầm trung vừa mới được OPPO cho ra mắt, gây ấn tượng với thiết kế màn hình khoét luoon', 0, '2024-10-26 14:32:36', 1),
(20, 'OppoA55', 2, 600000, 'oppo-a55-4g-thumb-new-600x600.jpg', 'Điện thoại OPPO A91 – Hệ thống 4 camera sau 48MP chụp ảnh ấn tượng. OPPO A92 là mẫu smartphone tầm trung vừa mới được OPPO cho ra mắt, gây ấn tượng với thiết kế màn hình khoét luoon', 0, '2024-10-26 14:32:36', 1),
(21, 'OppoA54', 2, 600000, 'oppo-a54-4g-black-600x600.jpg', 'Điện thoại OPPO A91 – Hệ thống 4 camera sau 48MP chụp ảnh ấn tượng. OPPO A92 là mẫu smartphone tầm trung vừa mới được OPPO cho ra mắt, gây ấn tượng với thiết kế màn hình khoét luoon', 0, '2024-10-26 14:32:36', 1),
(22, 'Sony Xperia 1 Mark 4', 5, 2600000, 'sony-xperia-1-iv-white-digiphone_2e4d7f92adad4b56b68c99668038e3bd.png', 'Sony Xperia 1 IV là một chiếc điện thoại thông minh chạy hệ điều hành Android được sản xuất bởi Sony. Ra mắt vào ngày 11 tháng 5 năm 2022, nó là phiên bản cao cấp mới nhất trong dòng Xperia của Sony 2022 , kế thừa Xperia 1 III', 0, '2024-10-26 14:32:36', 1),
(23, 'Sony Xperia XA1', 5, 2600000, 'sony-xperia-xa1-hh-400x400.jpg', 'Xperia XA1 là bản nâng cấp của chiếc Xperia XA đã khá thành công ở thị trường nước ta, với thiết kế khá tương đồng siêu phẩm Xperia XZ, cấu hình được trang bị cao hơn và camera có chất lượng tốt hơn.', 0, '2024-10-26 14:32:36', 1),
(24, 'Sony Xperia XZ2', 5, 2600000, 'sony-xperia-xz2-cu (1).jpg', 'Cuối cùng Sony đã thỏa hiệp trong việc làm mới thiết kế cho dòng Xperia. Một vài tinh chỉnh nhỏ giúp model XZ2 trở nên thời thượng và sang trong hơn. ', 0, '2024-10-26 14:32:36', 1),
(25, '', 2, 600000, 'oppo-a55-4g-thumb-new-600x600 (1).jpg', 'Điện thoại OPPO A91 – Hệ thống 4 camera sau 48MP chụp ảnh ấn tượng. OPPO A92 là mẫu smartphone tầm trung vừa mới được OPPO cho ra mắt, gây ấn tượng với thiết kế màn hình khoét ', 1, '0000-00-00 00:00:00', 1),
(26, 'MacBook Air 13 inch M1 2020 8CPU 7GPU', 3, 18000000, 'dell_latitude_15_3540_9950b79986.png', 'Chiếc MacBook Air có hiệu năng đột phá nhất từ trước đến nay đã xuất hiện. Bộ vi xử lý Apple M1 hoàn toàn mới đưa sức mạnh của MacBook Air M1 13 inch 2020 vượt xa khỏi mong đợi người dùng, có thể chạy được những tác vụ nặng và thời lượng pin đáng kinh ngạc.', 0, '2024-11-19 07:37:43', 2),
(27, 'Google Tivi Sony 2K 32 inch KD-32W830K', 5, 6450000, 'google-tivi-sony-2k-32-inch-kd-32w830k.png', '-  Tivi sở hữu thiết kế màn hình phẳng, viền đen mềm mại.Với  kích thước màn hình 32 inch tivi được nâng đỡ chắc chắn trên chân đế chữ V úp ngược bằng nhựa.\r\n\r\n- Tivi  là sự chọn phù hợp cho các không gian phòng khách, phòng ngủ nhỏ, đặc biệt phù hợp với không gian phòng khách sạn, nhà nghỉ,...', 0, '2024-11-19 08:17:54', 3),
(28, 'Samsung Galaxy Book4 Ultra 16 inch 2024 - Ultra 7', 1, 52500000, 'galaxy-book4-ultra-768x768.jpg', 'Samsung Galaxy Book4 Ultra đánh dấu một bước ngoặt trong thị trường máy tính xách tay. Sản phẩm mới với những cải tiến đột phá và khả năng vượt trội, dẫn đầu xu thế công nghệ. Trong bối cảnh công nghệ ngày càng phát triển, Galaxy Book4 Ultra không chỉ đáp ứng mà còn vượt xa kỳ vọng về một chiếc laptop hiện đại. Mời bạn cùng LaptopVANG tìm hiểu những nâng cấp đáng chú ý và những đột phá mới làm nên tên tuổi của Galaxy Book4 Ultra trong thế giới công nghệ.', 0, '2024-11-19 08:32:20', 2),
(29, 'Smart Tivi Samsung 4K Crystal UHD 70 inch UA70DU7000', 1, 14000000, 'tivisamsung1.jpg', 'Smart Tivi Samsung 4K Crystal UHD 70 inch UA70DU7000 tôn lên vẻ đẹp của không gian nội thất với thiết kế sang trọng, màn hình 70 inch với độ phân giải 4K mang lại những thước phim sống động và chân thực, bộ xử lý Crystal 4K tăng cường chất lượng hiển thị, tái tạo hình ảnh với độ chi tiết vượt trội.', 0, '2024-11-19 08:48:14', 3),
(30, 'Smart Tivi Samsung 4K 75 inch UA75CU8000', 1, 25400000, 'tivisamsung2.jpg', 'Smart Tivi Samsung 4K 75 inch UA75CU8000 có kiểu dáng và viền siêu mỏng mang lại trải nghiệm xem phim đỉnh cao, sở hữu màn hình Crystal UHD 4K cho hình ảnh sắc nét, sống động với Dynamic Crystal Color​, bộ xử lý Crystal 4K hỗ trợ tối ưu hoá màu sắc hiển thị, hệ điều hành Tizen™ trực quan dễ sử dụng.', 0, '2024-11-19 08:54:10', 3),
(31, 'Smart Tivi Neo QLED 4K 75 inch Samsung QA75QN85B', 1, 30400000, 'tivisamsung2.jpg', 'Smart Tivi Samsung 4K 75 inch UA75CU8000 có kiểu dáng và viền siêu mỏng mang lại trải nghiệm xem phim đỉnh cao, sở hữu màn hình Crystal UHD 4K cho hình ảnh sắc nét, sống động với Dynamic Crystal Color​, bộ xử lý Crystal 4K hỗ trợ tối ưu hoá màu sắc hiển thị, hệ điều hành Tizen™ trực quan dễ sử dụng.', 0, '2024-11-19 08:54:10', 3),
(32, 'Smart Tivi Samsung 4K 75 inch UA75CU8000', 1, 30400000, 'tivisamsung1.jpg', 'Smart Tivi Samsung 4K 75 inch UA75CU8000 có kiểu dáng và viền siêu mỏng mang lại trải nghiệm xem phim đỉnh cao, sở hữu màn hình Crystal UHD 4K cho hình ảnh sắc nét, sống động với Dynamic Crystal Color​, bộ xử lý Crystal 4K hỗ trợ tối ưu hoá màu sắc hiển thị, hệ điều hành Tizen™ trực quan dễ sử dụng.', 0, '2024-11-19 08:54:10', 3),
(34, 'Google Tivi OLED Sony 4K 65 inch K-65XR80', 5, 68090000, 'tivisony2.jpg', 'Cảm nhận mỗi khung hình sống động với Google Tivi OLED Sony 4K 65 inch K-65XR80, nơi những công nghệ hình ảnh XR Triluminos Pro và XR Contrast Booster 15 kết hợp cùng bộ xử lý XR Processor để làm nên sự khác biệt. Âm thanh từ công nghệ Acoustic Surface Audio+ sẽ đưa bạn vào một thế giới giải trí chân thực, ngoài ra bạn còn có thể điều khiển tivi chỉ bằng giọng nói của mình.', 0, '2024-11-19 08:17:54', 3),
(33, 'Smart Tivi Neo QLED 4K 75 inch Samsung QA75QN85B', 5, 6650000, 'google-tivi-sony-2k-32-inch-kd-32w830k.png', '-  Tivi sở hữu thiết kế màn hình phẳng, viền đen mềm mại.Với  kích thước màn hình 32 inch tivi được nâng đỡ chắc chắn trên chân đế chữ V úp ngược bằng nhựa.\r\n\r\n- Tivi  là sự chọn phù hợp cho các không gian phòng khách, phòng ngủ nhỏ, đặc biệt phù hợp với không gian phòng khách sạn, nhà nghỉ,...', 0, '2024-11-19 08:17:54', 3),
(35, 'Google Tivi Sony 4K 85 inch K-85S30', 5, 68090000, 'tivisony2.jpg', 'Cảm nhận mỗi khung hình sống động với Google Tivi OLED Sony 4K 65 inch K-65XR80, nơi những công nghệ hình ảnh XR Triluminos Pro và XR Contrast Booster 15 kết hợp cùng bộ xử lý XR Processor để làm nên sự khác biệt. Âm thanh từ công nghệ Acoustic Surface Audio+ sẽ đưa bạn vào một thế giới giải trí chân thực, ngoài ra bạn còn có thể điều khiển tivi chỉ bằng giọng nói của mình.', 0, '2024-11-19 08:17:54', 3),
(36, 'Samsung Galaxy Book4 15 inch 2024 - Core 7', 1, 16500000, 'samsung-galaxy-book4-768x768.jpg', 'Samsung Galaxy Book4 Ultra đánh dấu một bước ngoặt trong thị trường máy tính xách tay. Sản phẩm mới với những cải tiến đột phá và khả năng vượt trội, dẫn đầu xu thế công nghệ. Trong bối cảnh công nghệ ngày càng phát triển, Galaxy Book4 Ultra không chỉ đáp ứng mà còn vượt xa kỳ vọng về một chiếc laptop hiện đại. Mời bạn cùng LaptopVANG tìm hiểu những nâng cấp đáng chú ý và những đột phá mới làm nên tên tuổi của Galaxy Book4 Ultra trong thế giới công nghệ.', 0, '2024-11-19 08:32:20', 2),
(37, 'Samsung Galaxy Book4 Edge 14 inch (2024) - X Elite/16GB/512GB/3K - NEW', 1, 29500000, 'samsung-galaxy-book4-edge-14-x-elite-768x768.jpg', 'Hãy cùng khám phá Samsung Galaxy Book4 Edge 14 inch – chiếc laptop được thiết kế để đáp ứng nhu cầu của các chuyên gia sáng tạo hay doanh nhân. Với công nghệ tiên tiến, thiết kế tinh tế và hiệu suất mạnh mẽ. Chiếc laptop này chắc chắn sẽ trở thành người bạn đồng hành đáng tin cậy của bạn.', 0, '2024-11-19 08:32:20', 2),
(39, 'Macbook Pro 14 inch M3 16GB 512GB OpenBox', 3, 28000000, 'macbook_pro_14_inch_2023_545l-pr_nw13-2n_kf2p-6r_65iy-wx_xuze-7u_fm2z-8p_1fsf-4s_2ooa-bv.png', 'Chiếc MacBook Air có hiệu năng đột phá nhất từ trước đến nay đã xuất hiện. Bộ vi xử lý Apple M1 hoàn toàn mới đưa sức mạnh của MacBook Air M1 13 inch 2020 vượt xa khỏi mong đợi người dùng, có thể chạy được những tác vụ nặng và thời lượng pin đáng kinh ngạc.', 0, '2024-11-19 07:37:43', 2),
(42, 'Pin Oppo F5 Plus Chính hãng', 2, 120000, 'pin-oppo.png', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(43, 'Ốp lưng iPhone 15 Pro Silicone', 3, 1290000, '2023_9_18_638306599194535947_op-lung-iphone-15-pro-clear-case-with-magsafe-dd.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(44, 'Kính cường lực Realme Q5 Pro', 4, 190000, 'kinh-cuong-luc-realme-q5-pro-9.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(54, 'Pin máy ảnh Sony NP-FZ100, Pin Chính hãng', 5, 1190000, 'zin_fz100_e3e3e25d52ec4189b01a55f5c8243471.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(45, 'Samsung Galaxy Buds 2 Pro', 1, 2190000, '9_5.jpg', 'Bộ sản phẩm bao gồm:\r\n\r\nTai nghe, 3 cặp đệm tai nghe, Dây cáp Type-C\r\n\r\nTHÔNG TIN SẢN PHẨM:\r\n\r\n- Thiết kế chuẩn công thái học phong cách, ôm khít vào tai, hạn chế rơi khi di chuyển\r\n\r\n- Đắm chìm trong không gian âm nhạc riêng với tính năng chống ồn ANC và 360 Audio\r\n\r\n- Không ngại mưa rơi hay tập luyện cường độ cao khi sở hữu chuẩn kháng nước IPX7\r\n\r\n- Đạt chuẩn Bluetooth 5.3 mới nhất cho kết nối ổn định, nhận diện thiết bị nhanh chóng', 0, '2024-11-19 11:34:49', 5),
(46, 'Tai nghe OPPO Enco Buds2 Pro - Chính hãng', 2, 1200000, 'cauchy-passport-deep-grey-04-b-earphone-cover-opening-combination-b-rgb.png', 'Tai nghe OPPO được trang bị trình điều khiển 12.4mm cực lớn cùng công nghệ Enco Master, mang đến âm thanh mạnh mẽ, chi tiết và sống động. Bạn có thể tùy chỉnh âm thanh theo sở thích của mình với ba cấu hình âm thanh độc đáo (Cân bằng, Bass Boost, Clear Voice). Với thuật toán cuộc gọi AI và công nghệ Bluetooth 5.3® mới nhất, bạn có thể dễ dàng trò chuyện với người khác ngay cả ở những nơi ồn ào mà không lo bị nhiễu. Bên cạnh đó, với thiết kế nhỏ gọn cùng thời lượng pin lên đến 38 giờ và khả năng chống nước IP55, bạn có thể thoải mái sử dụng tai nghe suốt cả ngày dài.', 0, '2024-11-19 11:34:49', 5),
(47, 'Tai nghe Apple AirPods Pro 2 2023 Magsafe USB-C | Chính hãng Apple Việt Nam', 3, 3500000, 'apple-airpods-pro-2-2023-magsafe-1_1725508847.jpg', 'Tai nghe Apple AirPods Pro 2 2023 Magsafe được ra mắt chính thức ở sự kiện Wonderlust. Cũng như iPhone 15 Series, chiếc tai nghe mới nhất của Apple chuyển sang dây sạc Type-C, tăng sự đồng nhất với tính năng sạc của các sản phẩm khác thuộc Apple. Ngoài ra, AirPods Pro 2 2023 được trang bị và cải tiến nhiều chức năng mới nhằm nâng cao trải nghiệm âm thanh của người dùng. ', 0, '2024-11-19 11:34:49', 5),
(48, 'realme Buds T110 with AI ENC for calls,ast Charging Bluetooth Headset(Black)', 4, 1240000, 's-l1600.jpg', 'Tai nghe Realme là một dòng sản phẩm tai nghe của thương hiệu điện thoại Realme. Dòng sản phẩm này được thiết kế với tính năng âm thanh chất lượng cao, khả năng kết nối tiện lợi và thiết kế hiện đại.', 0, '2024-11-19 11:34:49', 5),
(49, 'Loa Sony ULT Tower 10 (SRS ULT1000) Âm Thanh 360 Độ, LED Đẹp, Bluetooth, USB, Micro, Guitar, Optical', 5, 22240000, 'avt-loa-sony-ult-tower-10.jpg', 'Thiết kế kích thước lớn cùng hệ thống đèn LED tích hợp ánh sáng đa màu sắc.\r\nTích hợp bánh xe và tay cầm để người dùng có thể dễ dàng di chuyển loa đến bất cứ đâu. \r\nLoa trầm có kích thước lên đến 320 mm x 320 mm giúp tạo ra âm thanh bass rõ ràng.\r\nÂm thanh tiệc tùng 360° cùng bộ loa cân bằng X lớn mạnh mẽ lan tỏa đến mọi góc phòng.\r\nTính năng TV Sound Booster cho phép tăng cường âm thanh TV với âm vòm sống động.\r\nNhấn nút ULT trên bảng điều khiển loa để tạo ra âm trầm sâu và mạnh mẽ hơn.\r\nLiên kết tối đa 100 loa tương thích thông qua công nghệ Party Connect đồng bộ dễ dàng.\r\nTrang bị micro đi kèm cùng đầu vào có dây cho micrô hoặc ghi-ta thứ hai.\r\nCho phép ghép nối Bluetooth nhanh chóng, dễ dàng với thiết bị của bạn. \r\nỨng dụng Sony | Music Center cho phép bạn quản lý cài đặt âm thanh, chọn danh sách phát và điều khiển Party Connect tiện lợi.', 0, '2024-11-19 11:34:49', 5),
(60, 'Laptop Samsung Galaxy Chromebook Go XE310XDA N4500/4GB/32GB/ChromeOS', 1, 7900000, 'vi-vn-samsung-galaxy-chromebook-go-xe310xda-n4500-slider-1.jpg', 'Samsung là một trong những thương hiệu laptop hàng đầu thế giới, cung cấp các mẫu laptop đa dạng với các tính năng hiện đại. Các mẫu laptop Samsung phổ biến bao gồm Galaxy Book, Notebook 9, và Series 9. Chúng thường được trang bị chip Intel Core, RAM và bộ nhớ lưu trữ mạnh mẽ, màn hình sắc nét và thời lượng pin lâu dài.', 0, '2024-11-19 08:32:20', 2),
(61, '', 3, 40000000, 'macbook_pro_14_inch_2021_m1_pro-768x768.png', 'Chiếc MacBook Air có hiệu năng đột phá nhất từ trước đến nay đã xuất hiện. Bộ vi xử lý Apple M1 hoàn toàn mới đưa sức mạnh của MacBook Air M1 13 inch 2020 vượt xa khỏi mong đợi người dùng, có thể chạy được những tác vụ nặng và thời lượng pin đáng kinh ngạc.', 3, '2024-11-19 07:37:43', 2),
(62, 'MacBook Pro 16 inch 2021 – (M1 Pro/16GB/512GB) - Used', 3, 18000000, 'MacBook-Pro-16-inch-M1-Pro-M1-Max-768x768.png', 'Chiếc MacBook Air có hiệu năng đột phá nhất từ trước đến nay đã xuất hiện. Bộ vi xử lý Apple M1 hoàn toàn mới đưa sức mạnh của MacBook Air M1 13 inch 2020 vượt xa khỏi mong đợi người dùng, có thể chạy được những tác vụ nặng và thời lượng pin đáng kinh ngạc.', 0, '2024-11-19 07:37:43', 2),
(63, 'Sạc nhanh Type C to Type C PD 45W Samsung EP-T4510X chính hãng', 1, 290000, 'cu-sac-nhanh-samsung-45w-chinh-hang(2).jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(64, 'Màn hình Samsung Galaxy Note 20 5G/Samsung Galaxy Note 20 Chính hãng', 1, 2290000, 'man-hinh-samsung-galaxy-note-20.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(65, 'Thay kính lưng OPPO Reno8', 2, 800000, 'thay-kinh-lung-oppo-reno-8-5.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(66, 'Mặt kính Oppo Reno5 5G Chính hãng', 2, 600000, 'mat-kinh-oppo.png', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(67, 'Màn hình Oppo F1 Plus X9009/Oppo R9 Chính hãng', 2, 900000, 'man-hinh-oppo.png', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(68, 'Ốp lưng iPhone 16 Pro Max UAG Plyo Magsafe', 3, 1280000, 'op-lung-iphone-16-pro-max-uag-plyo-magsafe1727666902.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(69, 'Sạc Macbook Pro 16 Inch Model A2485', 3, 1280000, 'sac-macbook-pro-16-inch-model-a2485-(6).jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(70, 'Cốc sạc nhanh Apple 20W Type-C Chính Hãng MUVV3ZA', 3, 4900000, 'coc-sac-nhanh-apple-20w-type-c-chinh-hang-mhje3za--240222084205.png', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(71, 'TDCL Realme C53 Full', 4, 290000, '1161385752.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(72, 'Kính cường lực Realme GT Neo 5', 4, 290000, 'kinh-cuong-luc-realme-gt-neo-5-5.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 1, '2024-11-19 11:34:49', 4),
(73, 'Kính cường lực Realme 9i', 4, 590000, 'kinh-cuong-luc-realme-9i-1.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(74, 'Kính cường lực Realme GT Neo', 4, 29000, 'kinh-cuong-luc-realme-gt-neo-21d.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(75, 'Kính cường lực Realme GT Neo 2T', 4, 39000, 'kinh-cuong-luc-realme-gt-neo-2t-2-1.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(76, 'Ống Kính 16mm cho Module Camera HQ của Raspberry Pi (ngàm C)', 5, 5290000, 'RPI-LENS-16MM (10)-800x800.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(77, 'Máy trợ giảng có dây Sony SN-898', 5, 4190000, 'sony-sn-898-bluetooth.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(78, 'Sạc máy ảnh BC-QZ1 Cho Pin Sony NP-FZ100, Sạc dây', 5, 11190000, '20201009083935_bo_sac_pin_danh_cho_np_fz100_jpg_21eec2c306cb474c8670c802c800b4be.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(79, 'Ống kính Sony FE 200-600mm (99%)', 5, 32020000, '2_a3dcd3474b384ef6b7440bdb5d9df173_1024x1024.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(80, 'Sony FE 50mm f/1.8 (Chính hãng)\r\n', 5, 5020000, '1459265698000_1242613.jpg', 'Những Ưu Điểm Tại Trung Tâm Laptop Thiên Ân\r\n\r\nThay thế linh kiện quý khách có thể ngồi quan sát trực tiếp.\r\nThay thế linh kiện từ 30 Phút – 1 Giờ tùy tình trạng và đời máy.\r\nGiá cả phải chăng, hợp lý, cam kết không vẽ bệnh chặt chém, báo giá trước khi làm.\r\nLinh Kiện Chính Hãng Bảo hành từ 6 Tháng – 12 Tháng.\r\nNhân viên tư vấn tận tình, chu đáo, trách nhiệm được đặt lên hàng đầu.', 0, '2024-11-19 11:34:49', 4),
(81, 'Samsung Galaxy Buds 2 Pro', 1, 2190000, 'samsung-galaxy-buds-2-pro-thumb.jpg', 'Bộ sản phẩm bao gồm:\r\n\r\nTai nghe, 3 cặp đệm tai nghe, Dây cáp Type-C\r\n\r\nTHÔNG TIN SẢN PHẨM:\r\n\r\n- Thiết kế chuẩn công thái học phong cách, ôm khít vào tai, hạn chế rơi khi di chuyển\r\n\r\n- Đắm chìm trong không gian âm nhạc riêng với tính năng chống ồn ANC và 360 Audio\r\n\r\n- Không ngại mưa rơi hay tập luyện cường độ cao khi sở hữu chuẩn kháng nước IPX7\r\n\r\n- Đạt chuẩn Bluetooth 5.3 mới nhất cho kết nối ổn định, nhận diện thiết bị nhanh chóng', 0, '2024-11-19 11:34:49', 5),
(82, 'Tai nghe Bluetooth True Wireless Samsung Galaxy Buds 3 Pro', 1, 2190000, 'tai-nghe-samsung-galaxy-buds-3-pro-spa_1.jpg', 'Bộ sản phẩm bao gồm:\r\n\r\nTai nghe, 3 cặp đệm tai nghe, Dây cáp Type-C\r\n\r\nTHÔNG TIN SẢN PHẨM:\r\n\r\n- Thiết kế chuẩn công thái học phong cách, ôm khít vào tai, hạn chế rơi khi di chuyển\r\n\r\n- Đắm chìm trong không gian âm nhạc riêng với tính năng chống ồn ANC và 360 Audio\r\n\r\n- Không ngại mưa rơi hay tập luyện cường độ cao khi sở hữu chuẩn kháng nước IPX7\r\n\r\n- Đạt chuẩn Bluetooth 5.3 mới nhất cho kết nối ổn định, nhận diện thiết bị nhanh chóng', 0, '2024-11-19 11:34:49', 5),
(83, 'Tai nghe Bluetooth True Wireless Samsung Galaxy Buds 3\r\n', 1, 2190000, 'samsung-galaxy-buds-3-spa_2.jpg', 'Bộ sản phẩm bao gồm:\r\n\r\nTai nghe, 3 cặp đệm tai nghe, Dây cáp Type-C\r\n\r\nTHÔNG TIN SẢN PHẨM:\r\n\r\n- Thiết kế chuẩn công thái học phong cách, ôm khít vào tai, hạn chế rơi khi di chuyển\r\n\r\n- Đắm chìm trong không gian âm nhạc riêng với tính năng chống ồn ANC và 360 Audio\r\n\r\n- Không ngại mưa rơi hay tập luyện cường độ cao khi sở hữu chuẩn kháng nước IPX7\r\n\r\n- Đạt chuẩn Bluetooth 5.3 mới nhất cho kết nối ổn định, nhận diện thiết bị nhanh chóng', 0, '2024-11-19 11:34:49', 5),
(84, 'Tai nghe Bluetooth True Wireless Samsung Galaxy Buds FE\r\n', 1, 3190000, 'samsung-galaxy-buds-fe.jpg', 'Bộ sản phẩm bao gồm:\r\n\r\nTai nghe, 3 cặp đệm tai nghe, Dây cáp Type-C\r\n\r\nTHÔNG TIN SẢN PHẨM:\r\n\r\n- Thiết kế chuẩn công thái học phong cách, ôm khít vào tai, hạn chế rơi khi di chuyển\r\n\r\n- Đắm chìm trong không gian âm nhạc riêng với tính năng chống ồn ANC và 360 Audio\r\n\r\n- Không ngại mưa rơi hay tập luyện cường độ cao khi sở hữu chuẩn kháng nước IPX7\r\n\r\n- Đạt chuẩn Bluetooth 5.3 mới nhất cho kết nối ổn định, nhận diện thiết bị nhanh chóng', 0, '2024-11-19 11:34:49', 5),
(85, 'Tai nghe Bluetooth TWS OPPO ENCO Air 4 Pro ETEA1', 2, 1940000, 'tai-nghe-bluetooth-tws-oppo-enco-air-4-pro-etea1-den-1-750x500.jpg', 'Tai nghe OPPO được trang bị trình điều khiển 12.4mm cực lớn cùng công nghệ Enco Master, mang đến âm thanh mạnh mẽ, chi tiết và sống động. Bạn có thể tùy chỉnh âm thanh theo sở thích của mình với ba cấu hình âm thanh độc đáo (Cân bằng, Bass Boost, Clear Voice). Với thuật toán cuộc gọi AI và công nghệ Bluetooth 5.3® mới nhất, bạn có thể dễ dàng trò chuyện với người khác ngay cả ở những nơi ồn ào mà không lo bị nhiễu. Bên cạnh đó, với thiết kế nhỏ gọn cùng thời lượng pin lên đến 38 giờ và khả năng chống nước IP55, bạn có thể thoải mái sử dụng tai nghe suốt cả ngày dài.', 0, '2024-11-19 11:34:49', 5),
(86, '', 2, 1640000, 'tai-nghe-bluetooth-true-wireless-oppo-enco-air-4-etee1-trang-2-638669293678400176-750x500.jpg ', 'Tai nghe OPPO được trang bị trình điều khiển 12.4mm cực lớn cùng công nghệ Enco Master, mang đến âm thanh mạnh mẽ, chi tiết và sống động. Bạn có thể tùy chỉnh âm thanh theo sở thích của mình với ba cấu hình âm thanh độc đáo (Cân bằng, Bass Boost, Clear Voice). Với thuật toán cuộc gọi AI và công nghệ Bluetooth 5.3® mới nhất, bạn có thể dễ dàng trò chuyện với người khác ngay cả ở những nơi ồn ào mà không lo bị nhiễu. Bên cạnh đó, với thiết kế nhỏ gọn cùng thời lượng pin lên đến 38 giờ và khả năng chống nước IP55, bạn có thể thoải mái sử dụng tai nghe suốt cả ngày dài.', 5, '2024-11-19 11:34:49', 5),
(87, 'Tai nghe Bluetooth True Wireless OPPO Enco Buds 2 Pro E510A', 2, 1740000, 'tai-nghe-bluetooth-true-wireless-oppo-enco-buds-2-pro-e510a-trang-1-1-750x500.jpg', 'Tai nghe OPPO được trang bị trình điều khiển 12.4mm cực lớn cùng công nghệ Enco Master, mang đến âm thanh mạnh mẽ, chi tiết và sống động. Bạn có thể tùy chỉnh âm thanh theo sở thích của mình với ba cấu hình âm thanh độc đáo (Cân bằng, Bass Boost, Clear Voice). Với thuật toán cuộc gọi AI và công nghệ Bluetooth 5.3® mới nhất, bạn có thể dễ dàng trò chuyện với người khác ngay cả ở những nơi ồn ào mà không lo bị nhiễu. Bên cạnh đó, với thiết kế nhỏ gọn cùng thời lượng pin lên đến 38 giờ và khả năng chống nước IP55, bạn có thể thoải mái sử dụng tai nghe suốt cả ngày dài.', 0, '2024-11-19 11:34:49', 5),
(88, 'Tai Nghe Phiên Dịch Vtalk Ear – Tai Nghe Phiên Dịch Mang Thương Hiệu Việt Nam\r\n\r\nGiá niêm yết:\r\n3.89', 3, 520000, 'vtalk-ear.jpg', 'Tai nghe Apple AirPods Pro 2 2023 Magsafe được ra mắt chính thức ở sự kiện Wonderlust. Cũng như iPhone 15 Series, chiếc tai nghe mới nhất của Apple chuyển sang dây sạc Type-C, tăng sự đồng nhất với tính năng sạc của các sản phẩm khác thuộc Apple. Ngoài ra, AirPods Pro 2 2023 được trang bị và cải tiến nhiều chức năng mới nhằm nâng cao trải nghiệm âm thanh của người dùng. ', 0, '2024-11-19 11:34:49', 5),
(89, 'Tai Nghe Phiên Dịch Vtalk Ear – Tai Nghe Phiên Dịch Mang Thương Hiệu Việt Nam\r\n\r\nGiá niêm yết:\r\n3.89', 3, 420000, 'vtalk-ear.jpg', 'Tai nghe Apple AirPods Pro 2 2023 Magsafe được ra mắt chính thức ở sự kiện Wonderlust. Cũng như iPhone 15 Series, chiếc tai nghe mới nhất của Apple chuyển sang dây sạc Type-C, tăng sự đồng nhất với tính năng sạc của các sản phẩm khác thuộc Apple. Ngoài ra, AirPods Pro 2 2023 được trang bị và cải tiến nhiều chức năng mới nhằm nâng cao trải nghiệm âm thanh của người dùng. ', 0, '2024-11-19 11:34:49', 5),
(90, 'Apple Airpods 4 Chống Ồn chính hãng', 3, 4520000, 'audio_airpod__fxaq33c1a7iy_large.jpg', 'Tai nghe Apple AirPods Pro 2 2023 Magsafe được ra mắt chính thức ở sự kiện Wonderlust. Cũng như iPhone 15 Series, chiếc tai nghe mới nhất của Apple chuyển sang dây sạc Type-C, tăng sự đồng nhất với tính năng sạc của các sản phẩm khác thuộc Apple. Ngoài ra, AirPods Pro 2 2023 được trang bị và cải tiến nhiều chức năng mới nhằm nâng cao trải nghiệm âm thanh của người dùng. ', 0, '2024-11-19 11:34:49', 5),
(91, 'Pin sạc dự phòng Innostyle PowerMax 20.000 mAh 20W IP20KPD', 4, 1240000, 'pin-sac-du-phong-innostyle-powermax-20-000-mah-20w-240419053351.png', 'Tai nghe Realme là một dòng sản phẩm tai nghe của thương hiệu điện thoại Realme. Dòng sản phẩm này được thiết kế với tính năng âm thanh chất lượng cao, khả năng kết nối tiện lợi và thiết kế hiện đại.', 0, '2024-11-19 11:34:49', 5),
(92, 'Pin sạc dự phòng Innostyle 10.000 mAh 20W PowerMag 2 in 1 Stand - IS20PDBLK', 4, 3240000, 'pin-sac-du-phong-innostyle-10-000-mah-20w-powermag-240420041433.png', 'Tai nghe Realme là một dòng sản phẩm tai nghe của thương hiệu điện thoại Realme. Dòng sản phẩm này được thiết kế với tính năng âm thanh chất lượng cao, khả năng kết nối tiện lợi và thiết kế hiện đại.', 1, '2024-11-19 11:34:49', 5),
(93, 'Pin Realme 8 RMX3085 Zin', 4, 3240000, 'pin-realme-8-rmx3085-blp841-zin2-hongchi-1-550x550.jpg', 'Tai nghe Realme là một dòng sản phẩm tai nghe của thương hiệu điện thoại Realme. Dòng sản phẩm này được thiết kế với tính năng âm thanh chất lượng cao, khả năng kết nối tiện lợi và thiết kế hiện đại.', 0, '2024-11-19 11:34:49', 5),
(94, 'SONY Handy Portable FM/AM/Wide FM Radio ICF-P27 Black ICF-P27 BC', 5, 22240000, 'sony-handy-portable-fmamwide-fm-radio-icf-p27-black-icf-p27-bc-135572_1080x.jpg', 'Thiết kế kích thước lớn cùng hệ thống đèn LED tích hợp ánh sáng đa màu sắc.\r\nTích hợp bánh xe và tay cầm để người dùng có thể dễ dàng di chuyển loa đến bất cứ đâu. \r\nLoa trầm có kích thước lên đến 320 mm x 320 mm giúp tạo ra âm thanh bass rõ ràng.\r\nÂm thanh tiệc tùng 360° cùng bộ loa cân bằng X lớn mạnh mẽ lan tỏa đến mọi góc phòng.\r\nTính năng TV Sound Booster cho phép tăng cường âm thanh TV với âm vòm sống động.\r\nNhấn nút ULT trên bảng điều khiển loa để tạo ra âm trầm sâu và mạnh mẽ hơn.\r\nLiên kết tối đa 100 loa tương thích thông qua công nghệ Party Connect đồng bộ dễ dàng.\r\nTrang bị micro đi kèm cùng đầu vào có dây cho micrô hoặc ghi-ta thứ hai.\r\nCho phép ghép nối Bluetooth nhanh chóng, dễ dàng với thiết bị của bạn. \r\nỨng dụng Sony | Music Center cho phép bạn quản lý cài đặt âm thanh, chọn danh sách phát và điều khiển Party Connect tiện lợi.', 0, '2024-11-19 11:34:49', 5),
(95, 'Máy ảnh Sony Alpha ILCE-6700L/ A6700 Kit 16-50mm F3.5-5.6 OSS', 5, 10240000, 'storedata.jpg', 'Thiết kế kích thước lớn cùng hệ thống đèn LED tích hợp ánh sáng đa màu sắc.\r\nTích hợp bánh xe và tay cầm để người dùng có thể dễ dàng di chuyển loa đến bất cứ đâu. \r\nLoa trầm có kích thước lên đến 320 mm x 320 mm giúp tạo ra âm thanh bass rõ ràng.\r\nÂm thanh tiệc tùng 360° cùng bộ loa cân bằng X lớn mạnh mẽ lan tỏa đến mọi góc phòng.\r\nTính năng TV Sound Booster cho phép tăng cường âm thanh TV với âm vòm sống động.\r\nNhấn nút ULT trên bảng điều khiển loa để tạo ra âm trầm sâu và mạnh mẽ hơn.\r\nLiên kết tối đa 100 loa tương thích thông qua công nghệ Party Connect đồng bộ dễ dàng.\r\nTrang bị micro đi kèm cùng đầu vào có dây cho micrô hoặc ghi-ta thứ hai.\r\nCho phép ghép nối Bluetooth nhanh chóng, dễ dàng với thiết bị của bạn. \r\nỨng dụng Sony | Music Center cho phép bạn quản lý cài đặt âm thanh, chọn danh sách phát và điều khiển Party Connect tiện lợi.', 0, '2024-11-19 11:34:49', 5),
(96, 'Sony GP-VPT2BT Wireless Shooting Grip', 5, 2240000, 'sony-gp-vpt2bt-wireless-shooting-grip-377129_1080x.jpg', 'Thiết kế kích thước lớn cùng hệ thống đèn LED tích hợp ánh sáng đa màu sắc.\r\nTích hợp bánh xe và tay cầm để người dùng có thể dễ dàng di chuyển loa đến bất cứ đâu. \r\nLoa trầm có kích thước lên đến 320 mm x 320 mm giúp tạo ra âm thanh bass rõ ràng.\r\nÂm thanh tiệc tùng 360° cùng bộ loa cân bằng X lớn mạnh mẽ lan tỏa đến mọi góc phòng.\r\nTính năng TV Sound Booster cho phép tăng cường âm thanh TV với âm vòm sống động.\r\nNhấn nút ULT trên bảng điều khiển loa để tạo ra âm trầm sâu và mạnh mẽ hơn.\r\nLiên kết tối đa 100 loa tương thích thông qua công nghệ Party Connect đồng bộ dễ dàng.\r\nTrang bị micro đi kèm cùng đầu vào có dây cho micrô hoặc ghi-ta thứ hai.\r\nCho phép ghép nối Bluetooth nhanh chóng, dễ dàng với thiết bị của bạn. \r\nỨng dụng Sony | Music Center cho phép bạn quản lý cài đặt âm thanh, chọn danh sách phát và điều khiển Party Connect tiện lợi.', 0, '2024-11-19 11:34:49', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `protypes`
--

CREATE TABLE `protypes` (
  `id_type` int(11) NOT NULL,
  `name_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `protypes`
--

INSERT INTO `protypes` (`id_type`, `name_type`, `icon`, `created_at`) VALUES
(1, 'Điện Thoại', 'fas fa-mobile-alt me-2', '2024-12-05'),
(2, 'LapTop', 'fas fa-laptop me-2', '2024-12-05'),
(3, 'TV', 'fas fa-tv me-2', '2024-12-05'),
(4, 'Phụ Kiện', 'fas fa-mouse me-2', '2024-12-05'),
(5, 'Âm Thanh', 'fas fa-headphones me-2', '2024-12-05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(3, 'aa', '$2y$10$lrOfILJv1blqb5Zifr4gFulc/tAhGqoWfDEQTYihidDmiBY3MI9ea', 'buonthimikkhoc@gmail.com', 0, '2024-11-22 11:27:41'),
(4, '123', '$2y$10$foJRwlx6YeyQ/UEtylh0J.Q56X8BHx5Ltp/tIf1CRXh8qHtHpc8Wq', '22211tt2302@mail.tdc.edu.vn', 0, '2024-11-22 11:34:58'),
(5, 'Duy Huỳnh', '$2y$10$o3XP6Fn3UGQ3kN/LOTAy6unAwzx0d7//jEr0pwNVG6vqI0awe1Q9e', 'duyhuynh19042004@gmail.com', 1, '2024-12-01 10:30:15'),
(6, 'Duy', '$2y$10$6DkywTgSFULAeo/V6kj6ue5WMVbfpeY8bQg74cwfVjx95QtohPkhq', 'duy@gmail.com', 0, '2024-12-01 11:07:14');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `manufactures`
--
ALTER TABLE `manufactures`
  ADD PRIMARY KEY (`id_manu`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `protypes`
--
ALTER TABLE `protypes`
  ADD PRIMARY KEY (`id_type`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `manufactures`
--
ALTER TABLE `manufactures`
  MODIFY `id_manu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT cho bảng `protypes`
--
ALTER TABLE `protypes`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
