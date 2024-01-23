-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 08:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backpacker_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'mail.rownok@gmail.com', '76bbaf8c1cdd3d23b27d49686437d0d3');

-- --------------------------------------------------------

--
-- Table structure for table `bookhotels`
--

CREATE TABLE `bookhotels` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL,
  `phone` varchar(254) NOT NULL,
  `address` varchar(254) NOT NULL,
  `book_date` date NOT NULL,
  `amount` varchar(254) NOT NULL,
  `bkash_number` varchar(254) NOT NULL,
  `transaction_number` varchar(254) NOT NULL,
  `status` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `booktour`
--

CREATE TABLE `booktour` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tour_date` date NOT NULL,
  `amount` varchar(255) NOT NULL,
  `bkash_number` varchar(255) NOT NULL,
  `transaction_number` varchar(255) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booktour`
--

INSERT INTO `booktour` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `tour_date`, `amount`, `bkash_number`, `transaction_number`, `booking_date`, `status`) VALUES
(9, 9, 'Rownok Ripon', 'sb.rownokripon@gmail.com', '01749475566', 'Kalabagan,Dhaka-Bngladesh', '2023-10-27', '6500', '01749475566', 'TSIPSJ784456', '2023-10-14 06:35:47', 'Approved'),
(10, 10, 'Al Amin Hossain', 'alamin521@gmail.com', '01601424748', 'Hazaribag,Dhaka-Bangladesh', '2023-10-24', '16500', '01601424748', 'JKDHUIA6844', '2023-10-14 06:39:13', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `title`, `description`, `location`, `image`, `price`) VALUES
(4, 'Jatra Flagship Sylhet City Centre', 'Jatra Flagship Sylhet City Centre is located in Sylhet. With free WiFi, this 4-star hotel offers room service and a 24-hour front desk.\r\n\r\nAt the hotel each room is equipped with air conditioning, a desk, a flat-screen TV, a private bathroom, bed linen, towels and a balcony with a city view. Guest rooms will provide guests with a fridge.\r\n\r\nGuests at Jatra Flagship Sylhet City Centre can enjoy an Asian or a halal breakfast.\r\n\r\nThe nearest airport is Osmani International Airport, 11 km from the accommodation.\r\n\r\nCouples particularly like the location — they rated it 8.2 for a two-person trip.\r\n\r\nDistance in property description is calculated using © OpenStreetMap', 'Road # 2, Block # E, Shajalal Upashahar Flat # 4A, 4B & 5A, House # 61, Forida Villa, 3100 Sylhet,', '296026830.jpg', '6500.00'),
(5, 'Hotel Royal Beach & Restaurant', 'Facing the beachfront, Hotel Royal Beach & Restaurant offers 2-star accommodation in Jaliapāra and has a terrace and restaurant. Free private parking is available and the hotel also features bike hire for guests who want to explore the surrounding area.\r\n\r\nGuests at the hotel can enjoy a continental breakfast.\r\n\r\nGuests at Hotel Royal Beach & Restaurant will be able to enjoy activities in and around Jaliapāra, like hiking and cycling.\r\n\r\nThe nearest airport is Cox\'s Bazar Airport, 114 km from the accommodation.\r\n\r\nDistance in property description is calculated using © OpenStreetMap', ' Al-Goni Road, North Beach, West Area Saint Martin Island, PS: Teknaf,, 4762 Jaliapāra, Bangladesh', '340270188.jpg', '5457.00'),
(6, 'Britannia Beach Resort- Inani Beach, Cox\'sbazar', 'The holiday home is fitted with 4 bedrooms, 6 bathrooms, bed linen, towels, a flat-screen TV with satellite channels, a dining area, a fully equipped kitchen, and a terrace with sea views. The air-conditioned holiday home also offers a seating area, washing machine and 6 bathrooms with a walk-in shower and a bidet.\r\n\r\nThe holiday home offers a children\'s playground. A car rental service is available at Britannia Beach Resort- Inani Beach, Cox\'sbazar, while cycling and walking tours can be enjoyed nearby.\r\n\r\nThe nearest airport is Cox\'s Bazar Airport, 26 km from the accommodation.\r\n\r\nDistance in property description is calculated using © OpenStreetMap', ' Inani-Court Bazar Road, 4750 Nidānia, Bangladesh', '381804968.jpg', '3969.00'),
(7, 'Hotel Orchid Blue', 'Set in Ināni, Hotel Orchid Blue has a restaurant. With a garden, the 3-star hotel has air-conditioned rooms with free WiFi, each with a private bathroom. The hotel offers sea views, a terrace and a 24-hour front desk.\r\n\r\nAt the hotel, the rooms come with a desk. All guest rooms in Hotel Orchid Blue are fitted with a flat-screen TV and free toiletries.\r\n\r\nThe daily breakfast offers buffet, Asian or vegetarian options.\r\n\r\nThe nearest airport is Cox\'s Bazar Airport, 25 km from the accommodation.\r\n\r\nDistance in property description is calculated using © OpenStreetMap', ' Marine Drive Road, Cadet College Complex, Inani, Cox\'s Bazar, 4700 Ināni, Bangladesh', '478849783.jpg', '2536.00'),
(8, 'Hotel Sonar Bangla Sundarban', 'Located in Gosāba, Hotel Sonar Bangla Sundarban offers 4-star accommodation with a garden, a terrace and a restaurant. Private parking can be arranged at an extra charge.\r\n\r\nAt the hotel, each room is fitted with a balcony. Complete with a private bathroom equipped with free toiletries, guest rooms at Hotel Sonar Bangla Sundarban have a flat-screen TV and air conditioning, and selected rooms come with a seating area. The units will provide guests with a wardrobe and a kettle.\r\n\r\nAt the accommodation guests are welcome to take advantage of a hot tub.\r\n\r\nHotel Sonar Bangla Sundarban can conveniently provide information at the reception to help guests to get around the area.', ' Village - Dulki PO/PS- Gosaba, 743370 Gosāba, India', '337406036.jpg', '9500.00'),
(9, 'Long Beach Hotel', 'You\'re eligible for a Genius discount at Long Beach Hotel! To save at this property, all you have to do is sign in.\r\n\r\nOffering an indoor pool, a fitness centre and a spa and wellness centre, Long Beach Hotel is located 3.3 km from the Cox\'s Bazar Airport and Local Bus Station. Free wired internet is available in the rooms of the property.\r\n\r\nEach air-conditioned room here will provide you with a satellite TV, seating area and a balcony. There is also a minibar. Featuring a shower, private bathroom also comes with bathrobes and free toiletries.\r\n\r\nAt Long Beach Hotel you will find a 24-hour front desk, BBQ facilities and garden. Other facilities offered at the property include meeting facilities, a shared lounge and a ticket service. The property offers free parking.\r\n\r\nThe Barmiz Market Cox’s Bazar is 3 km, the Himchari National Park is 8 km and the Binani Beach is 24 km away.', ' 14 Kalatoli, Hotel-Motel Zone, 4700 Cox\'s Bazar, Bangladesh', '283183777.jpg', '10500.00'),
(10, 'Castle Bay Touch Cox\'s Bazar', 'Castle Bay Touch Cox\'s Bazar is offering accommodation in Cox\'s Bazar. Featuring a restaurant, the 3-star hotel has air-conditioned rooms with free WiFi, each with a private bathroom. The accommodation offers room service and a 24-hour front desk for guests.\r\n\r\nAt the hotel, each room is equipped with a desk and a flat-screen TV. At Castle Bay Touch Cox\'s Bazar the rooms come with bed linen and towels.\r\n\r\nAn Asian breakfast is available every morning at the accommodation.\r\n\r\nThe nearest airport is Cox\'s Bazar Airport, 3 km from Castle Bay Touch Cox\'s Bazar.\r\n\r\nDistance in property description is calculated using © OpenStreetMap', ' Plot-63, Block-B, PWD Housing Kolatoli Sungandha point, 4700 Cox\'s Bazar, Bangladesh', '494020890.jpg', '12500.00'),
(11, 'Royal Pearl Suites Hotel', 'Royal Pearl Suites features accommodation in Cox\'s Bazar. This 5-star hotel offers room service, a 24-hour front desk and free WiFi. There is a restaurant serving Chinese cuisine, and free private parking is available.\r\n\r\nAll rooms are fitted with air conditioning, a flat-screen TV with satellite channels, a microwave, a kettle, a shower, free toiletries and a desk. All guest rooms have a private bathroom, a hairdryer and bed linen.\r\n\r\nA buffet breakfast is available each morning at the hotel.\r\n\r\nRoyal Pearl Suites offers an indoor pool.\r\n', ' Kolatoli Road, 4700 Cox\'s Bazar, Bangladesh', '479123307.jpg', '6500.00');

-- --------------------------------------------------------

--
-- Table structure for table `shared_tickets`
--

CREATE TABLE `shared_tickets` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `shared_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shared_tickets`
--

INSERT INTO `shared_tickets` (`id`, `ticket_id`, `sender_id`, `recipient_id`, `shared_date`) VALUES
(3, 9, 9, 10, '2023-10-14 06:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

CREATE TABLE `tour_packages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tourist_spot` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`id`, `title`, `description`, `tourist_spot`, `price`, `image`, `created_at`, `updated_at`) VALUES
(11, 'Sajek Valley Tour Package', '\r\nSightseeing as per our itinerary\r\n\r\nMeal Included as per our itinerary\r\n\r\nTour Spot Entry Fee\r\n\r\nDaily Breakfast , Lunch & Diner at Local Restaurant\r\n\r\nHotel Accommodation Non AC (Twin/Double Share)\r\n\r\nDhaka-Khagrachori-Dhaka Non AC Bus Ticket\r\n\r\nKhagrachori-Sajek Vally-Khagrachori by Chander Gari', 'Sajek , Khagrachori', '6500.00', '1658569515_event.jpg', '2023-10-14 06:03:54', '2023-10-14 06:03:54'),
(12, 'Dhaka - Sundarban - Dhaka', '\r\nSightseeing as per our itinerary\r\n\r\nMeal Included as per our itinerary\r\n\r\nDhaka – Khulna – Dhaka AC Bus Ticket\r\n\r\n02 Night Stay in Sundarban Ship with Cabin with Meals', 'Khulna,Harbaria, Sundarbans Forest, Kotka wildlife sanctuary', '16500.00', 'tiger.jpg', '2023-10-14 06:07:30', '2023-10-14 06:07:30'),
(13, 'Dhaka - Bandarban - Dhaka', '\r\nHotel Accommodation (3* Hotel & Twin Basis)\r\n\r\nSightseeing as per our itinerary\r\n\r\nMeal Included as per our itinerary\r\n\r\nDhaka – Bandarban– Dhaka AC Bus Ticket\r\n\r\nDaily Breakfast , Lunch & Diner at Local Restaurant', 'Bandarban , Nilachal, Meghla, Golden Temple by Jeep, Nilgiri, Shoilopropat, Chimbuk Hills, ', '10600.00', '196920_178.jpg', '2023-10-14 06:09:52', '2023-10-14 06:09:52'),
(14, 'Cox’s Bazar – Saint Martins Island Package (Non AC)', 'Sightseeing as per our itinerary\r\n\r\nMeal Included as per our itinerary\r\n\r\nNon A/C Bus Tickets\r\n\r\nDaily Breakfast , Lunch & Diner at Local Restaurant\r\n\r\nTeknaf-St.Martin-Teknaf Ship Ticket\r\n\r\nNon Ace Hotel Accommodation (3* Hotel & Twin Basis)', ' Cox’s Bazar , Teknaf, Chhera Dwip, St. Martins Island', '9800.00', 'maxresdefault.jpg', '2023-10-14 06:11:44', '2023-10-14 06:11:44'),
(15, 'Dhaka – Rangamati – Bandaran - Coxs’bazar – Dhaka', '\r\nHotel Accommodation (3* Hotel & Twin Basis)\r\n\r\nSightseeing as per our itinerary\r\n\r\nMeal Included as per our itinerary\r\n\r\nA/C Bus tickets\r\n\r\nDaily Breakfast , Lunch & Diner at Local Restaurant', 'Rangamati , Bandaran , Coxs’bazar ', '15200.00', 'suspension-bridge-5297744_1280.jpg', '2023-10-14 06:13:42', '2023-10-14 06:13:42'),
(16, 'Dhaka – Sylhet – Dhaka Tour Package', 'Daily Buffet Breakfast at Hotel\r\n\r\nSightseeing as per our itinerary\r\n\r\nMeal Included as per our itinerary\r\n\r\nDhaka – Sylhet – Dhaka AC Bus Ticket\r\n\r\nLunch & Diner at Local Restaurant', 'Sylhet, Ratargul & Bichanakandi, Jaflong Tour. ', '12000.00', '00.jpg', '2023-10-14 06:15:32', '2023-10-14 06:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `conpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `conpassword`) VALUES
(9, 'Rownok Ripon', 'sb.rownokripon@gmail.com', '$2y$10$4XMbQ9nAyuPWmj0Nd0w7n.plrqiECRuZIAgni./Uk7LOPMgbvcnpK', '$2y$10$HRKCmCsFvhEz5vzD4eoTpeWaCo5Gajr756RAGIPXxqvOz2lnwkgJq'),
(10, 'Al Amin Hossain', 'alamin521@gmail.com', '$2y$10$gqdEfoX/z9iFNRG/VJGvxenfDvcPSNOJfr5ucCGG6ItiS8QncHkqW', '$2y$10$8H55CJkAgC6VjqIRzZUTruxV23ckffuJO85aqROlvWHTesZy1deE2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookhotels`
--
ALTER TABLE `bookhotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booktour`
--
ALTER TABLE `booktour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shared_tickets`
--
ALTER TABLE `shared_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookhotels`
--
ALTER TABLE `bookhotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booktour`
--
ALTER TABLE `booktour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shared_tickets`
--
ALTER TABLE `shared_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shared_tickets`
--
ALTER TABLE `shared_tickets`
  ADD CONSTRAINT `shared_tickets_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `booktour` (`id`),
  ADD CONSTRAINT `shared_tickets_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `shared_tickets_ibfk_3` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
