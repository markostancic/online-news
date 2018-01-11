-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2018 at 03:32 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `ime` varchar(128) DEFAULT NULL,
  `prezime` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `korisnicko_ime` varchar(128) DEFAULT NULL,
  `sifra` varchar(128) DEFAULT NULL,
  `sifra2` varchar(128) DEFAULT NULL,
  `tip` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `ime`, `prezime`, `email`, `korisnicko_ime`, `sifra`, `sifra2`, `tip`) VALUES
(1, 'mika', 'mikic', 'mika@gmail.com', 'mika', '81dc9bdb52d04dc20036dbd8313ed055', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(12, 'mirko', 'mirkovic', 'mirko@gmail.com', 'mirko', 'fcea920f7412b5da7be0cf42b8c93759', 'fcea920f7412b5da7be0cf42b8c93759', 'upravnik'),
(15, 'aca', 'anic', 'aca@gmail.com', 'aca', 'b2d1bcdc698b0ff497ed80d68fd0b13c', '1e0e62b646502d5aed9b4d11e895b473', 'upravnik'),
(18, 'stefan', 'stefanovic', 'stefan@gmail.com', 'stefan', '81dc9bdb52d04dc20036dbd8313ed055', '1e0e62b646502d5aed9b4d11e895b473', 'upravnik'),
(19, 'Ana', 'anic', 'ana@gmail.com', 'ana', 'd1659f8a4945d81e506e5fee09867042', 'd1659f8a4945d81e506e5fee09867042', 'upravnik');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(11) NOT NULL,
  `korisnik` varchar(128) NOT NULL,
  `text` text NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `korisnik`, `text`, `datum`) VALUES
(10, 'stefan', 'lepa vest', '2018-01-09'),
(12, 'nikola', 'stravaaa', '2018-01-10'),
(17, 'sofija', 'topp', '2018-01-10'),
(25, 'slavko', 'lepo izgleda', '2018-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `korisnicko_ime` varchar(20) NOT NULL,
  `sifra` text NOT NULL,
  `sifra2` text NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `broj` int(11) NOT NULL,
  `telefon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `email`, `korisnicko_ime`, `sifra`, `sifra2`, `ulica`, `broj`, `telefon`) VALUES
(2, 'simo', 'miric', 'stefan@gmail.com', 'simo', '49f0bad299687c62334182178bfd75d8', '3ce29d141a63973c4fad0d7ee4218db2', 'Ljubicka', 12, 6546456),
(4, 'andrija', 'mirkovic', 'andrija@gmail.com', 'andrija', '81dc9bdb52d04dc20036dbd8313ed055', 'd1659f8a4945d81e506e5fee09867042', 'Ljubicka', 12, 1231231),
(5, 'aca', 'anic', 'aca@gmail.com', 'aca', 'b2d1bcdc698b0ff497ed80d68fd0b13c', '1e0e62b646502d5aed9b4d11e895b473', 'Ljubicka', 12, 123121),
(7, 'nikola', 'nikolic', 'nikola@gmail.com', 'nikola1', 'e8f8b0cf7e6f4267e0bce864db0ac20c', 'e8f8b0cf7e6f4267e0bce864db0ac20c', 'Ljubicka', 12, 1231231);

-- --------------------------------------------------------

--
-- Table structure for table `vest`
--

CREATE TABLE `vest` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `naslov` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `datum` date NOT NULL,
  `text` text NOT NULL,
  `slika` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vest`
--

INSERT INTO `vest` (`id`, `admin_id`, `naslov`, `autor`, `datum`, `text`, `slika`) VALUES
(8, 0, 'Facebook', 'Stefan', '2017-12-31', 'Facebook ima uvid u sve naše podatke', 'fb.png'),
(9, 0, 'Prvaci sveta', 'Marko', '2017-12-31', 'Rusija gori', 'srbija.png'),
(11, 0, 'Gde voditi decu', 'Ema', '2017-12-02', 'Prelep novonapravljeni park', 'slika8.jpg'),
(12, 0, 'Kako do posla', 'Ćira', '2017-12-31', 'Brzo i lako do posla uz samo 2 klika', 'inn.png'),
(13, 0, 'Engleski', 'Nevena', '2017-12-31', 'Novi sistem ucenja jezika ', 'english.png'),
(14, 0, 'Instagram', 'Pera', '2017-12-31', 'Nova funkcija na instagramu (obavezno pogledati)', 'instagram.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vest`
--
ALTER TABLE `vest`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vest`
--
ALTER TABLE `vest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
