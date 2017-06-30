-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2017 at 10:53 AM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.19-1+deb.sury.org~xenial+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livewimeaDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `archieve`
--

CREATE TABLE `archieve` (
  `id` int(11) NOT NULL,
  `Form` varchar(25) NOT NULL,
  `StationName` varchar(25) NOT NULL,
  `StationNumber` int(12) NOT NULL,
  `FromPeriod` date NOT NULL,
  `ToPeriod` date NOT NULL,
  `Description` varchar(25) NOT NULL,
  `FileName` varchar(255) NOT NULL,
  `CreationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archieve`
--

INSERT INTO `archieve` (`id`, `Form`, `StationName`, `StationNumber`, `FromPeriod`, `ToPeriod`, `Description`, `FileName`, `CreationDate`) VALUES
(1, 'Synoptics', 'Makerere', 0, '0000-00-00', '0000-00-00', 'TESTing', 'TESTing', '2015-07-21'),
(2, 'Dekadal', 'Makerere', 0, '0000-00-00', '0000-00-00', 'AGAIN TESTing', 'AGAIN TESTing', '2015-07-21'),
(3, 'Synoptic', 'Makerere', 0, '0000-00-00', '0000-00-00', 'WEATHER', 'recent-001.jpg', '2015-07-21'),
(4, 'Metar', 'Makerere', 0, '2016-01-01', '0000-00-00', 'Test Archieving', 'Test Archieving', '2016-12-06'),
(5, 'Metar', 'Makerere', 0, '2016-01-01', '0000-00-00', 'Test Archieving', '', '0000-00-00'),
(6, 'Metar', 'Makerere', 0, '2016-01-01', '0000-00-00', 'Test Archieving', '', '0000-00-00'),
(7, 'Dekadal', 'Makerere', 0, '2016-12-01', '2016-12-05', 'Coming', 'Coming', '2016-12-07'),
(8, 'Rainfall card', 'Makerere', 0, '2016-12-01', '2016-12-02', 'Rainfall', 'Jellyfish.jpg', '2016-12-07'),
(9, 'Synoptic register', 'Gulu', 10098, '2016-12-01', '2016-12-30', 'Blady', 'Hydrangeas.jpg', '2016-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `archivedekadalformreportdata`
--

CREATE TABLE `archivedekadalformreportdata` (
  `id` bigint(255) NOT NULL,
  `Date` date NOT NULL,
  `StationName` varchar(255) NOT NULL,
  `StationNumber` bigint(255) NOT NULL,
  `MAX_TEMP` varchar(255) DEFAULT NULL,
  `MIN_TEMP` varchar(255) DEFAULT NULL,
  `DRY_BULB_0600Z` varchar(255) DEFAULT NULL,
  `WET_BULB_0600Z` varchar(255) DEFAULT NULL,
  `DEW_POINT_0600Z` varchar(255) DEFAULT NULL,
  `RELATIVE_HUMIDITY_0600Z` varchar(255) DEFAULT NULL,
  `WIND_DIRECTION_0600Z` varchar(255) DEFAULT NULL,
  `WIND_SPEED_0600Z` varchar(255) DEFAULT NULL,
  `RAINFALL_0600Z` varchar(255) DEFAULT NULL,
  `DRY_BULB_1200Z` varchar(255) DEFAULT NULL,
  `WET_BULB_1200Z` varchar(255) DEFAULT NULL,
  `DEW_POINT_1200Z` varchar(255) DEFAULT NULL,
  `RELATIVE_HUMIDITY_1200Z` varchar(255) DEFAULT NULL,
  `WIND_DIRECTION_1200Z` varchar(255) DEFAULT NULL,
  `WIND_SPEED_1200Z` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(255) NOT NULL,
  `Approved` varchar(225) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `archivemetarformdata`
--

CREATE TABLE `archivemetarformdata` (
  `Date` date NOT NULL,
  `id` bigint(225) NOT NULL,
  `StationName` varchar(225) NOT NULL,
  `StationNumber` bigint(225) NOT NULL,
  `TIME` varchar(225) NOT NULL,
  `METARSPECI` varchar(225) NOT NULL,
  `CCCC` varchar(225) DEFAULT NULL,
  `YYGGgg` varchar(225) DEFAULT NULL,
  `Dddfffmfm` varchar(225) DEFAULT NULL,
  `WWorCOVAK` varchar(225) DEFAULT NULL,
  `W1W1` varchar(225) DEFAULT NULL,
  `NlCCNmCCNhCC` varchar(225) DEFAULT NULL,
  `TTTdTd` varchar(225) DEFAULT NULL,
  `Qnhhpa` varchar(225) DEFAULT NULL,
  `Qnhin` varchar(225) DEFAULT NULL,
  `Qfehpa` varchar(225) DEFAULT NULL,
  `Qfein` varchar(225) DEFAULT NULL,
  `REW1W1` varchar(225) DEFAULT NULL,
  `Approved` varchar(225) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `SubmittedBy` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `archivemonthlyrainfallformreportdata`
--

CREATE TABLE `archivemonthlyrainfallformreportdata` (
  `id` bigint(225) NOT NULL,
  `Date` date NOT NULL,
  `StationName` varchar(225) NOT NULL,
  `StationNumber` bigint(225) NOT NULL,
  `Rainfall` varchar(225) NOT NULL,
  `SubmittedBy` varchar(225) NOT NULL,
  `Approved` varchar(225) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `archiveobservationslipformdata`
--

CREATE TABLE `archiveobservationslipformdata` (
  `Date` date NOT NULL,
  `id` bigint(225) NOT NULL,
  `StationName` varchar(225) NOT NULL,
  `StationNumber` bigint(225) NOT NULL,
  `TIME` varchar(225) NOT NULL,
  `TotalAmountOfAllClouds` varchar(225) DEFAULT NULL,
  `TotalAmountOfLowClouds` varchar(225) DEFAULT NULL,
  `TypeOfLowClouds` varchar(225) DEFAULT NULL,
  `OktasOfLowClouds` varchar(225) DEFAULT NULL,
  `HeightOfLowClouds` varchar(225) DEFAULT NULL,
  `CLCODEOfLowClouds` varchar(225) DEFAULT NULL,
  `TypeOfMediumClouds` varchar(225) DEFAULT NULL,
  `OktasOfMediumClouds` varchar(225) DEFAULT NULL,
  `HeightOfMediumClouds` varchar(225) DEFAULT NULL,
  `CLCODEOfMediumClouds` varchar(225) DEFAULT NULL,
  `TypeOfHighClouds` varchar(225) DEFAULT NULL,
  `OktasOfHighClouds` varchar(225) DEFAULT NULL,
  `HeightOfHighClouds` varchar(225) DEFAULT NULL,
  `CLCODEOfHighClouds` varchar(225) DEFAULT NULL,
  `CloudSearchLightReading` varchar(225) DEFAULT NULL,
  `Rainfall` varchar(225) DEFAULT NULL,
  `Dry_Bulb` varchar(225) DEFAULT NULL,
  `Wet_Bulb` varchar(225) DEFAULT NULL,
  `Max_Read` varchar(225) DEFAULT NULL,
  `Max_Reset` varchar(225) DEFAULT NULL,
  `Min_Read` varchar(225) DEFAULT NULL,
  `Min_Reset` varchar(225) DEFAULT NULL,
  `Piche_Read` varchar(225) DEFAULT NULL,
  `Piche_Reset` varchar(225) DEFAULT NULL,
  `TimeMarksThermo` varchar(225) DEFAULT NULL,
  `TimeMarksHygro` varchar(225) DEFAULT NULL,
  `TimeMarksRainRec` varchar(225) DEFAULT NULL,
  `Present_Weather` varchar(225) DEFAULT NULL,
  `Visibility` varchar(225) DEFAULT NULL,
  `Wind_Direction` varchar(225) DEFAULT NULL,
  `Wind_Speed` varchar(225) DEFAULT NULL,
  `Gusting` varchar(225) DEFAULT NULL,
  `AttdThermo` varchar(225) DEFAULT NULL,
  `PrAsRead` varchar(225) DEFAULT NULL,
  `Correction` varchar(225) DEFAULT NULL,
  `CLP` varchar(225) DEFAULT NULL,
  `MSLPr` varchar(225) DEFAULT NULL,
  `TimeMarksBarograph` varchar(225) DEFAULT NULL,
  `TimeMarksAnemograph` varchar(225) DEFAULT NULL,
  `OtherTMarks` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(225) NOT NULL,
  `Approved` varchar(225) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `archivesynopticformreportdata`
--

CREATE TABLE `archivesynopticformreportdata` (
  `id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `StationName` varchar(25) NOT NULL,
  `StationNumber` bigint(20) NOT NULL,
  `TIME` varchar(50) NOT NULL,
  `UWS` varchar(11) DEFAULT NULL,
  `BN` int(11) DEFAULT NULL,
  `IOOP` int(11) DEFAULT NULL,
  `TSPPW` varchar(20) DEFAULT NULL,
  `HLC` int(11) DEFAULT NULL,
  `HV` int(11) DEFAULT NULL,
  `TCC` int(11) DEFAULT NULL,
  `WD` int(11) DEFAULT NULL,
  `WS` int(11) DEFAULT NULL,
  `GI1_1` int(11) DEFAULT NULL,
  `SignOfData_1` double DEFAULT NULL,
  `Air_temperature` int(11) DEFAULT NULL,
  `GI2_1` int(11) DEFAULT NULL,
  `SignOfData_2` int(15) DEFAULT NULL,
  `Dewpoint_temperature` int(11) DEFAULT NULL,
  `GI3_1` int(11) DEFAULT NULL,
  `PASL` int(11) DEFAULT NULL,
  `GI4_1` int(11) DEFAULT NULL,
  `SIS` int(11) DEFAULT NULL,
  `GSIS` int(11) DEFAULT NULL,
  `GI6_1` int(11) DEFAULT NULL,
  `AOP` int(11) DEFAULT NULL,
  `DPOP` int(11) DEFAULT NULL,
  `GI7_1` int(11) DEFAULT NULL,
  `Present_Weather` varchar(25) DEFAULT NULL,
  `Past_Weather` varchar(25) DEFAULT NULL,
  `GI8_1` int(11) DEFAULT NULL,
  `AOC` varchar(25) DEFAULT NULL,
  `CLOG` varchar(25) DEFAULT NULL,
  `CGOG` varchar(25) DEFAULT NULL,
  `CHOG` varchar(25) DEFAULT NULL,
  `Section_Indicator333` int(11) DEFAULT NULL,
  `GI0_1` int(11) DEFAULT NULL,
  `GMT` int(12) DEFAULT NULL,
  `CIOP` int(12) DEFAULT NULL,
  `BEOP` int(12) DEFAULT NULL,
  `ThunderStorm` varchar(11) DEFAULT NULL,
  `HailStorm` varchar(11) DEFAULT NULL,
  `Fog` varchar(11) DEFAULT NULL,
  `EarthQuake` varchar(11) DEFAULT NULL,
  `Anemometer_Reading` varchar(11) DEFAULT NULL,
  `Actual_Rainfall` varchar(10) DEFAULT NULL,
  `GI1_2` int(15) DEFAULT NULL,
  `SignOfData_3` int(15) DEFAULT NULL,
  `Max_TempTx` int(25) DEFAULT NULL,
  `GI2_2` int(12) DEFAULT NULL,
  `SignOfData_4` int(12) DEFAULT NULL,
  `Max_TempTn` int(12) DEFAULT NULL,
  `GI5_1` int(15) DEFAULT NULL,
  `AOE` int(12) DEFAULT NULL,
  `ITI` varchar(25) DEFAULT NULL,
  `GI55` int(12) DEFAULT NULL,
  `DOS` int(12) DEFAULT NULL,
  `GI5_2` int(12) DEFAULT NULL,
  `SPC` varchar(12) DEFAULT NULL,
  `PCI24Hrs` int(12) DEFAULT NULL,
  `GI6_2` int(12) DEFAULT NULL,
  `AOP_2` int(12) DEFAULT NULL,
  `DPOP_2` int(12) DEFAULT NULL,
  `GI8_2` int(12) DEFAULT NULL,
  `AICL` int(25) DEFAULT NULL,
  `GOC` varchar(12) DEFAULT NULL,
  `HBCLOM` int(12) DEFAULT NULL,
  `GI8_3` int(12) DEFAULT NULL,
  `AICL_2` int(12) DEFAULT NULL,
  `GOC_2` int(12) DEFAULT NULL,
  `HBCLOM_2` int(12) DEFAULT NULL,
  `GI8_4` int(12) DEFAULT NULL,
  `AICL_3` int(12) DEFAULT NULL,
  `GOC_3` int(12) DEFAULT NULL,
  `HBCLOM_3` int(12) DEFAULT NULL,
  `GI8_5` int(12) DEFAULT NULL,
  `AICL_4` int(12) DEFAULT NULL,
  `GOC_4` int(12) DEFAULT NULL,
  `HBCLOM_4` int(12) DEFAULT NULL,
  `GI9` int(11) DEFAULT NULL,
  `Supp_Info` varchar(25) DEFAULT NULL,
  `Section_Indicator555` int(12) DEFAULT NULL,
  `GI1_3` int(12) DEFAULT NULL,
  `SignOfData_5` int(12) DEFAULT NULL,
  `Wetbulb_Temp` int(12) DEFAULT NULL,
  `R_Humidity` int(12) DEFAULT NULL,
  `V_Pressure` int(12) DEFAULT NULL,
  `Approved` varchar(15) NOT NULL,
  `SubmittedBy` varchar(20) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `archiveweathersummaryformreportdata`
--

CREATE TABLE `archiveweathersummaryformreportdata` (
  `id` bigint(255) NOT NULL,
  `Date` date NOT NULL,
  `StationName` varchar(255) NOT NULL,
  `StationNumber` bigint(255) NOT NULL,
  `TEMP_MAX` varchar(255) DEFAULT NULL,
  `TEMP_MIN` varchar(255) DEFAULT NULL,
  `SUNSHINE` varchar(255) DEFAULT NULL,
  `DB_0600Z` varchar(255) DEFAULT NULL,
  `WB_0600Z` varchar(255) DEFAULT NULL,
  `DP_0600Z` varchar(255) DEFAULT NULL,
  `VP_0600Z` varchar(255) DEFAULT NULL,
  `RH_0600Z` varchar(255) DEFAULT NULL,
  `CLP_0600Z` varchar(255) DEFAULT NULL,
  `GPM_0600Z` varchar(255) DEFAULT NULL,
  `WIND_DIR_0600Z` varchar(255) DEFAULT NULL,
  `FF_0600Z` varchar(255) DEFAULT NULL,
  `DB_1200Z` varchar(255) DEFAULT NULL,
  `WB_1200Z` varchar(255) DEFAULT NULL,
  `DP_1200Z` varchar(255) DEFAULT NULL,
  `VP_1200Z` varchar(255) DEFAULT NULL,
  `RH_1200Z` varchar(255) DEFAULT NULL,
  `CLP_1200Z` varchar(255) DEFAULT NULL,
  `GPM_1200Z` varchar(255) DEFAULT NULL,
  `WIND_DIR_1200Z` varchar(255) DEFAULT NULL,
  `FF_1200Z` varchar(255) DEFAULT NULL,
  `WIND_RUN` varchar(255) DEFAULT NULL,
  `R_F` varchar(255) DEFAULT NULL,
  `ThunderStorm` text,
  `Fog` text,
  `Haze` text,
  `HailStorm` text,
  `EarthQuake` text,
  `SubmittedBy` varchar(255) NOT NULL,
  `Approved` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aws`
--

CREATE TABLE `aws` (
  `id` int(255) NOT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `StationName` varchar(25) DEFAULT NULL,
  `StationNumber` bigint(20) NOT NULL,
  `TXT` varchar(255) DEFAULT NULL,
  `E64` varchar(255) DEFAULT NULL,
  `IdOfTransmittingNode` int(255) DEFAULT NULL,
  `Temperature` int(255) DEFAULT NULL,
  `SoilTemperature` int(255) DEFAULT NULL,
  `T_mcu` int(255) DEFAULT NULL,
  `V_MCU` varchar(255) DEFAULT NULL,
  `P0` int(25) DEFAULT NULL,
  `P0_lst60_02` int(255) DEFAULT NULL,
  `P1` int(255) DEFAULT NULL,
  `P1_t` int(255) DEFAULT NULL,
  `P1_lst` int(255) DEFAULT NULL,
  `Uptime` int(255) DEFAULT NULL,
  `Error` varchar(255) DEFAULT NULL,
  `V_IN` int(15) DEFAULT NULL,
  `A1` int(255) DEFAULT NULL,
  `A2` int(25) DEFAULT NULL,
  `A3` int(255) DEFAULT NULL,
  `GW_LON` int(255) DEFAULT NULL,
  `GW_LAT` int(255) DEFAULT NULL,
  `P_MS5611` int(255) DEFAULT NULL,
  `UT` int(255) DEFAULT NULL,
  `RH_SHT2X` int(255) DEFAULT NULL,
  `T_SHT2X` int(255) DEFAULT NULL,
  `ADC1` int(255) DEFAULT NULL,
  `ADC2` int(255) DEFAULT NULL,
  `DOMAIN` varchar(25) DEFAULT NULL,
  `TZ` varchar(25) DEFAULT NULL,
  `UP` varchar(25) DEFAULT NULL,
  `T` int(255) DEFAULT NULL,
  `PS` varchar(255) DEFAULT NULL,
  `RH` varchar(255) DEFAULT NULL,
  `V_a1` int(25) DEFAULT NULL,
  `P0_T` int(25) DEFAULT NULL,
  `V_A1_V_A2_005_400` int(255) DEFAULT NULL,
  `V_AD1_100` int(255) DEFAULT NULL,
  `V_AD2_100` int(25) DEFAULT NULL,
  `V_AD3_100` int(25) DEFAULT NULL,
  `V_AD1_1000` int(255) DEFAULT NULL,
  `V_AD2_1000` int(255) DEFAULT NULL,
  `V_AD3_1000` int(255) DEFAULT NULL,
  `ADDR` varchar(255) DEFAULT NULL,
  `V_AD1` varchar(255) DEFAULT NULL,
  `V_AD2` varchar(255) DEFAULT NULL,
  `V_AD3` varchar(255) DEFAULT NULL,
  `SEQ` varchar(255) DEFAULT NULL,
  `TTL` varchar(255) DEFAULT NULL,
  `RSSI` varchar(255) DEFAULT NULL,
  `LQI` varchar(255) DEFAULT NULL,
  `DRP` varchar(255) DEFAULT NULL,
  `SRC` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aws`
--

INSERT INTO `aws` (`id`, `Date`, `Time`, `StationName`, `StationNumber`, `TXT`, `E64`, `IdOfTransmittingNode`, `Temperature`, `SoilTemperature`, `T_mcu`, `V_MCU`, `P0`, `P0_lst60_02`, `P1`, `P1_t`, `P1_lst`, `Uptime`, `Error`, `V_IN`, `A1`, `A2`, `A3`, `GW_LON`, `GW_LAT`, `P_MS5611`, `UT`, `RH_SHT2X`, `T_SHT2X`, `ADC1`, `ADC2`, `DOMAIN`, `TZ`, `UP`, `T`, `PS`, `RH`, `V_a1`, `P0_T`, `V_A1_V_A2_005_400`, `V_AD1_100`, `V_AD2_100`, `V_AD3_100`, `V_AD1_1000`, `V_AD2_1000`, `V_AD3_1000`, `ADDR`, `V_AD1`, `V_AD2`, `V_AD3`, `SEQ`, `TTL`, `RSSI`, `LQI`, `DRP`, `SRC`) VALUES
(1, '2017-01-03', '06:15:15', 'Makerere', 400098, 'Ground', 'mac address', 12, 12, 12, 12, '12', 12, 12, 12, 12, 12, 12, 'Bad', 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 'good', 'good', 'good', 12, '', NULL, 12, 12, 12, 12, 12, 12, 12, 12, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2017-01-04', '04:30:00', 'Entebbe', 900098, 'node', 'mac', 23, 24, 25, 26, '27', 28, NULL, NULL, NULL, 32, 33, 'Not Bad', 34, 35, 36, 37, 38, 39, NULL, 41, 42, 43, 44, 45, 'domain', 'tz', 'up', 46, '', NULL, 47, 48, 0, 50, 51, 52, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2016-07-27', '02:12:12', 'Makerere', 400098, '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 5, 60, 0, 1469578332, NULL, NULL, NULL, NULL, NULL, 'CEST', '0x314DC', 12, '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '162.156', '0.000000', '0.000000', '0.000000', '39', '15', '33', '255', '0.00', '129.177.63.214');

-- --------------------------------------------------------

--
-- Table structure for table `dailyperiodicrainfall`
--

CREATE TABLE `dailyperiodicrainfall` (
  `id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Rainfall` varchar(24) NOT NULL,
  `StationName` varchar(50) NOT NULL,
  `StationNumber` bigint(20) NOT NULL,
  `SubmittedBy` varchar(25) NOT NULL,
  `Approved` varchar(10) NOT NULL,
  `CreationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dailyperiodicrainfall`
--

INSERT INTO `dailyperiodicrainfall` (`id`, `Date`, `Rainfall`, `StationName`, `StationNumber`, `SubmittedBy`, `Approved`, `CreationDate`) VALUES
(1, '2016-10-19', '54', 'Makerere', 400098, '', 'false', '0000-00-00'),
(2, '2016-12-08', '31.5', 'Makerere', 400098, '', 'true', '2016-12-08'),
(3, '2016-12-10', '10', 'Makerere', 400098, 'Mars Mart', 'false', '2016-12-11'),
(4, '2016-12-11', '0.1', 'Makerere', 400098, 'Mars Mart', 'false', '2016-12-11'),
(5, '2016-12-29', '30', 'Makerere', 400098, 'Admin Admin', 'false', '2016-12-29'),
(6, '2017-02-23', 'NIL', 'Entebbe', 900098, 'Admin Admin', 'false', '2017-02-23'),
(7, '2017-02-24', '34', 'Gulu', 10098, 'Admin Admin', 'false', '2017-02-23'),
(8, '2017-02-24', '', 'Makerere', 400098, 'Admin Admin', 'false', '2017-02-24');

-- --------------------------------------------------------

--
-- Table structure for table `dailyprevious`
--

CREATE TABLE `dailyprevious` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `station` varchar(50) NOT NULL,
  `max` double DEFAULT NULL,
  `min` double DEFAULT NULL,
  `actual` double DEFAULT NULL,
  `rainfall` double NOT NULL,
  `anemometer` double DEFAULT NULL,
  `wind` double DEFAULT NULL,
  `user` text NOT NULL,
  `submitted` date NOT NULL,
  `approved` text NOT NULL,
  `rain` text,
  `thunder` text,
  `fog` text,
  `haze` text,
  `storm` text,
  `quake` text,
  `height` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `sunshine` varchar(50) DEFAULT NULL,
  `radiationtype` varchar(50) DEFAULT NULL,
  `radiation` varchar(50) DEFAULT NULL,
  `evaptype1` varchar(50) DEFAULT NULL,
  `evap1` varchar(50) DEFAULT NULL,
  `evaptype2` varchar(50) DEFAULT NULL,
  `evap2` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dailyprevious`
--

INSERT INTO `dailyprevious` (`id`, `date`, `station`, `max`, `min`, `actual`, `rainfall`, `anemometer`, `wind`, `user`, `submitted`, `approved`, `rain`, `thunder`, `fog`, `haze`, `storm`, `quake`, `height`, `duration`, `sunshine`, `radiationtype`, `radiation`, `evaptype1`, `evap1`, `evaptype2`, `evap2`) VALUES
(2, '2015-07-14', 'Makerere', 22, 19.7, 0.1, 0, 32456, 23, 'test', '2015-07-08', 'false', 'true', '', '', '', 'true', 'true', '0', '', '', '', '', '', '', '', ''),
(3, '2015-07-13', 'Makerere', 18, 12, 0.2, 0, 45678, 12, 'test', '2015-07-14', 'false', 'true', 'true', 'true', 'true', 'true', 'true', '0', '', '', '', '', '', '', '', ''),
(4, '2015-07-08', 'Makerere', 32, 16, 0.5, 0, 67889, 0, 'test', '2015-07-14', 'false', 'true', 'true', 'true', 'true', 'true', 'true', '0', '', '', '', '', '', '', '', ''),
(5, '2015-07-15', 'Makerere', 26, 0.22, 0.4, 0, 6789, 4, 'test', '2015-07-16', 'false', '', '', 'true', '', 'true', 'true', '0', '', '', '', '', '', '', '', ''),
(9, '2016-10-19', 'Makerere', 23, 22, 0, 34, 45, 34, 'Bwire Brian', '2016-10-29', 'true', 'true', 'true', 'true', 'false', 'false', 'false', '33', '3', '4', '34', '33', '23', '33', '33', '54');

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

CREATE TABLE `elements` (
  `id` int(11) NOT NULL,
  `ElementName` text NOT NULL,
  `InstrumentName` varchar(25) NOT NULL,
  `StationName` varchar(25) NOT NULL,
  `StationNumber` bigint(20) NOT NULL,
  `Abbrev` varchar(25) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Units` varchar(50) NOT NULL,
  `Scale` varchar(50) NOT NULL,
  `Limits` varchar(50) NOT NULL,
  `Description` varchar(25) NOT NULL,
  `CreationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elements`
--

INSERT INTO `elements` (`id`, `ElementName`, `InstrumentName`, `StationName`, `StationNumber`, `Abbrev`, `Type`, `Units`, `Scale`, `Limits`, `Description`, `CreationDate`) VALUES
(1, 'Rainfall', 'Rainguage', 'Entebbe', 900098, 'FR', 'Monthly', 'Cm3', 'C', '20', 'This is  a test', '2015-07-21'),
(2, 'Sunshine', 'Barometer', 'Makerere', 400098, 'SR', 'Monthly', 'Cm3', 'C', '20', 'This is  a test sunshine', '2015-07-21'),
(3, 'Test', 'Tester', 'Makerere', 400098, 'TRi', 'Good', 'mm', 'cm', '2', 'Testing', '2016-12-06'),
(4, 'Ddd', 'Barometer', 'Makerere', 0, 'fff', 'ffff', 'ffff', 'rr', '44', 'fff', '2017-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `instruments`
--

CREATE TABLE `instruments` (
  `id` int(11) NOT NULL,
  `InstrumentName` varchar(25) NOT NULL,
  `StationName` varchar(25) NOT NULL,
  `StationNumber` bigint(20) NOT NULL,
  `DateRegistered` date NOT NULL,
  `ExpirationDate` date NOT NULL,
  `InstrumentCode` varchar(50) NOT NULL,
  `Manufacturer` varchar(25) NOT NULL,
  `Description` varchar(25) NOT NULL,
  `CreationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instruments`
--

INSERT INTO `instruments` (`id`, `InstrumentName`, `StationName`, `StationNumber`, `DateRegistered`, `ExpirationDate`, `InstrumentCode`, `Manufacturer`, `Description`, `CreationDate`) VALUES
(2, 'Tester', 'Makerere', 400098, '0000-00-00', '2015-07-21', 'werwe', 'werwe', 'werwerw', '2015-07-21'),
(3, 'Winter', 'Makerere', 400098, '0000-00-00', '2015-07-21', 'WaT56E', 'MajoE', 'for weather', '2015-07-21'),
(4, 'Rain guage', 'Entebbe', 900098, '2016-01-01', '2016-01-10', 'HK9034', 'MUK', 'Google', '2016-12-05'),
(5, 'Sunshine decoder', 'Entebbe', 900098, '2016-01-01', '2016-01-10', 'HK9034', 'MUK', 'GoogleAdsdd', '2016-12-05'),
(6, 'Rainguage', 'Entebbe', 900098, '2017-05-01', '2017-05-31', '4545', 'MUK', 'Viii', '2017-05-01'),
(7, 'Barometer', 'Makerere', 400098, '2017-05-01', '2017-05-03', '5666', 'mukff', 'fffff', '2017-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `Date` datetime NOT NULL,
  `id` bigint(225) NOT NULL,
  `StationName` varchar(225) DEFAULT NULL,
  `StationNumber` bigint(225) DEFAULT NULL,
  `User` varchar(225) NOT NULL,
  `UserRole` varchar(225) NOT NULL,
  `Action` varchar(225) NOT NULL,
  `Details` varchar(225) NOT NULL,
  `IP` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`Date`, `id`, `StationName`, `StationNumber`, `User`, `UserRole`, `Action`, `Details`, `IP`) VALUES
('2017-05-26 12:52:35', 137, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added metar book info', 'Micheal Lubega added metar book info into the system', '10.150.51.144'),
('2017-05-26 13:36:04', 138, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.150.51.144'),
('2017-05-26 13:37:40', 139, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added metar book info', 'Micheal Lubega added metar book info into the system', '10.150.51.144'),
('2017-05-26 13:38:09', 140, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added More Form Fields book info', 'Micheal Lubega added More Form Fields info into the system', '10.150.51.144'),
('2017-05-26 14:56:37', 141, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-05-26 15:03:44', 142, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-05-26 15:10:07', 143, 'Makerere', 400098, 'Agnes Nalukwago', 'Observer', 'Added More Form Fields book info', 'Agnes Nalukwago added More Form Fields info into the system', '10.10.16.165'),
('2017-05-26 15:19:11', 144, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-05-26 15:35:08', 145, 'Makerere', 400098, 'Agnes Nalukwago', 'Observer', 'Added metar book info', 'Agnes Nalukwago added metar book info into the system', '10.10.16.165'),
('2017-05-26 15:37:09', 146, 'Makerere', 400098, 'Agnes Nalukwago', 'Observer', 'Added More Form Fields book info', 'Agnes Nalukwago added More Form Fields info into the system', '10.10.16.165'),
('2017-05-26 15:37:18', 147, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-06-06 12:16:37', 148, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-06-06 12:33:51', 149, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-06-06 12:46:20', 150, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-06-06 12:54:57', 151, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-06-06 13:03:17', 152, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-06-06 13:14:17', 153, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-06-06 13:23:43', 154, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-06-06 15:56:14', 155, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added Observation Slip info', 'Micheal Lubega added Observation Slip info into the system', '10.10.16.156'),
('2017-06-06 16:02:15', 156, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added metar book info', 'Micheal Lubega added metar book info into the system', '10.10.16.156'),
('2017-06-06 16:07:39', 157, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added metar book info', 'Micheal Lubega added metar book info into the system', '10.10.16.156'),
('2017-06-06 16:22:47', 158, 'Makerere', 400098, 'Micheal Lubega', 'OC', 'Added More Form Fields book info', 'Micheal Lubega added More Form Fields info into the system', '10.10.16.156');

-- --------------------------------------------------------

--
-- Table structure for table `metar`
--

CREATE TABLE `metar` (
  `Date` date NOT NULL,
  `id` bigint(225) NOT NULL,
  `StationName` varchar(225) NOT NULL,
  `StationNumber` bigint(225) NOT NULL,
  `TIME` varchar(225) NOT NULL,
  `METARSPECI` varchar(225) NOT NULL,
  `CCCC` varchar(225) DEFAULT NULL,
  `YYGGgg` varchar(225) DEFAULT NULL,
  `Dddfffmfm` varchar(255) DEFAULT NULL,
  `WWorCOVAK` varchar(225) DEFAULT NULL,
  `W1W1` varchar(225) DEFAULT NULL,
  `NlCCNmCCNhCC` varchar(225) DEFAULT NULL,
  `Air_temperature` varchar(225) DEFAULT NULL,
  `Dew_temperature` varchar(225) DEFAULT NULL,
  `Wet_bulb` varchar(225) DEFAULT NULL,
  `TTTdTd` varchar(255) DEFAULT NULL,
  `Qnhhpa` varchar(225) DEFAULT NULL,
  `Qnhin` varchar(225) DEFAULT NULL,
  `Qfehpa` varchar(225) DEFAULT NULL,
  `Qfein` varchar(225) DEFAULT NULL,
  `REW1W1` varchar(225) DEFAULT NULL,
  `Approved` varchar(225) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `SubmittedBy` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metar`
--

INSERT INTO `metar` (`Date`, `id`, `StationName`, `StationNumber`, `TIME`, `METARSPECI`, `CCCC`, `YYGGgg`, `Dddfffmfm`, `WWorCOVAK`, `W1W1`, `NlCCNmCCNhCC`, `Air_temperature`, `Dew_temperature`, `Wet_bulb`, `TTTdTd`, `Qnhhpa`, `Qnhin`, `Qfehpa`, `Qfein`, `REW1W1`, `Approved`, `CreationDate`, `SubmittedBy`) VALUES
('2017-05-01', 4, 'Makerere', 400098, '0600Z', 'METAR', 'HUKA', '010500', '18004KT', '7000', 'RA', 'BKN016 FEW018CB OVC090', NULL, NULL, NULL, '19/19', '1020.5', '30', '881.5', '', '', 'false', '2017-05-26 15:35:08', 'Agnes Nalukwago'),
('2017-05-02', 5, 'Makerere', 400098, '0500Z', 'METAR', 'HUKA', '020500Z', '00000KT', '1000', 'FG', 'SCT020 FEW022CB', NULL, NULL, NULL, '20/19', '1018.2', '30', '879.5', '', '', 'false', '2017-06-06 16:02:15', 'Micheal Lubega'),
('2017-05-02', 6, 'Makerere', 400098, '0600Z', 'METAR', 'HUKA', '020700Z', '27004KT', '9000', '', 'BKN020 FEW022CB', NULL, NULL, NULL, '22/20', '1018.8', '30', '880.0', '', '', 'false', '2017-06-06 16:07:39', 'Micheal Lubega');

-- --------------------------------------------------------

--
-- Table structure for table `moreformfields`
--

CREATE TABLE `moreformfields` (
  `Date` date NOT NULL,
  `id` bigint(225) NOT NULL,
  `StationName` varchar(225) NOT NULL,
  `StationNumber` bigint(225) NOT NULL,
  `TIME` varchar(225) NOT NULL,
  `UnitOfWindSpeed` varchar(255) DEFAULT NULL,
  `IndOrOmissionOfPrecipitation` varchar(255) DEFAULT NULL,
  `TypeOfStation_Present_Past_Weather` varchar(255) DEFAULT NULL,
  `HeightOfLowestCloud` varchar(225) DEFAULT NULL,
  `StandardIsobaricSurface` varchar(255) DEFAULT NULL,
  `GPM` varchar(225) DEFAULT NULL,
  `DurationOfPeriodOfPrecipitation` varchar(225) DEFAULT NULL,
  `Past_Weather` varchar(225) DEFAULT NULL,
  `GrassMinTemp` varchar(225) DEFAULT NULL,
  `CI_OfPrecipitation` varchar(225) DEFAULT NULL,
  `BE_OfPrecipitation` varchar(225) DEFAULT NULL,
  `IndicatorOfTypeOfIntrumentation` varchar(255) DEFAULT NULL,
  `DurationOfSunshine` varchar(255) DEFAULT NULL,
  `SignOfPressureChange` varchar(255) DEFAULT NULL,
  `Supp_Info` varchar(255) DEFAULT NULL,
  `VapourPressure` varchar(255) DEFAULT NULL,
  `Wind_Run` varchar(225) DEFAULT NULL,
  `T_H_Graph` varchar(225) DEFAULT NULL,
  `Approved` varchar(225) NOT NULL,
  `SubmittedBy` varchar(225) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moreformfields`
--

INSERT INTO `moreformfields` (`Date`, `id`, `StationName`, `StationNumber`, `TIME`, `UnitOfWindSpeed`, `IndOrOmissionOfPrecipitation`, `TypeOfStation_Present_Past_Weather`, `HeightOfLowestCloud`, `StandardIsobaricSurface`, `GPM`, `DurationOfPeriodOfPrecipitation`, `Past_Weather`, `GrassMinTemp`, `CI_OfPrecipitation`, `BE_OfPrecipitation`, `IndicatorOfTypeOfIntrumentation`, `DurationOfSunshine`, `SignOfPressureChange`, `Supp_Info`, `VapourPressure`, `Wind_Run`, `T_H_Graph`, `Approved`, `SubmittedBy`, `CreationDate`) VALUES
('2017-05-01', 2, 'Makerere', 400098, '0500Z', NULL, NULL, NULL, '5', NULL, '///', '4', '44', '', '', '', NULL, NULL, NULL, '', NULL, '', '', 'FALSE', 'Agnes Nalukwago', '2017-05-26 00:00:00'),
('2017-05-01', 3, 'Makerere', 400098, '0600Z', NULL, NULL, NULL, '4', NULL, '///', '4', '62', '', '', '', NULL, NULL, NULL, '', NULL, '', '', 'FALSE', 'Agnes Nalukwago', '2017-05-26 15:37:09'),
('2017-05-02', 4, 'Makerere', 400098, '0600Z', '3', '1', '1', '5', '', '', '4', '44', '', '', '', '', '038', '', '', '236', '96.8', '', 'FALSE', 'Micheal Lubega', '2017-06-06 16:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `observationslip`
--

CREATE TABLE `observationslip` (
  `Date` date NOT NULL,
  `id` bigint(225) NOT NULL,
  `StationName` varchar(225) NOT NULL,
  `StationNumber` bigint(225) NOT NULL,
  `TIME` varchar(225) NOT NULL,
  `TotalAmountOfAllClouds` varchar(225) DEFAULT NULL,
  `TotalAmountOfLowClouds` varchar(225) DEFAULT NULL,
  `TypeOfLowClouds` varchar(225) DEFAULT NULL,
  `OktasOfLowClouds` varchar(225) DEFAULT NULL,
  `HeightOfLowClouds` varchar(225) DEFAULT NULL,
  `CLCODEOfLowClouds` varchar(225) DEFAULT NULL,
  `TypeOfMediumClouds` varchar(225) DEFAULT NULL,
  `OktasOfMediumClouds` varchar(225) DEFAULT NULL,
  `HeightOfMediumClouds` varchar(225) DEFAULT NULL,
  `CLCODEOfMediumClouds` varchar(225) DEFAULT NULL,
  `TypeOfHighClouds` varchar(225) DEFAULT NULL,
  `OktasOfHighClouds` varchar(225) DEFAULT NULL,
  `HeightOfHighClouds` varchar(225) DEFAULT NULL,
  `CLCODEOfHighClouds` varchar(225) DEFAULT NULL,
  `CloudSearchLightReading` varchar(225) DEFAULT NULL,
  `Rainfall` varchar(225) DEFAULT NULL,
  `Dry_Bulb` varchar(225) DEFAULT NULL,
  `Wet_Bulb` varchar(225) DEFAULT NULL,
  `Max_Read` varchar(225) DEFAULT NULL,
  `Max_Reset` varchar(225) DEFAULT NULL,
  `Min_Read` varchar(225) DEFAULT NULL,
  `Min_Reset` varchar(225) DEFAULT NULL,
  `Piche_Read` varchar(225) DEFAULT NULL,
  `Piche_Reset` varchar(225) DEFAULT NULL,
  `TimeMarksThermo` varchar(225) DEFAULT NULL,
  `TimeMarksHygro` varchar(225) DEFAULT NULL,
  `TimeMarksRainRec` varchar(225) DEFAULT NULL,
  `Present_Weather` varchar(225) DEFAULT NULL,
  `Visibility` varchar(225) DEFAULT NULL,
  `Wind_Direction` varchar(225) DEFAULT NULL,
  `Wind_Speed` varchar(225) DEFAULT NULL,
  `Gusting` varchar(225) DEFAULT NULL,
  `AttdThermo` varchar(225) DEFAULT NULL,
  `PrAsRead` varchar(225) DEFAULT NULL,
  `Correction` varchar(225) DEFAULT NULL,
  `CLP` varchar(225) DEFAULT NULL,
  `MSLPr` varchar(225) DEFAULT NULL,
  `TimeMarksBarograph` varchar(225) DEFAULT NULL,
  `TimeMarksAnemograph` varchar(225) DEFAULT NULL,
  `OtherTMarks` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(225) NOT NULL,
  `Approved` varchar(225) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `observationslip`
--

INSERT INTO `observationslip` (`Date`, `id`, `StationName`, `StationNumber`, `TIME`, `TotalAmountOfAllClouds`, `TotalAmountOfLowClouds`, `TypeOfLowClouds`, `OktasOfLowClouds`, `HeightOfLowClouds`, `CLCODEOfLowClouds`, `TypeOfMediumClouds`, `OktasOfMediumClouds`, `HeightOfMediumClouds`, `CLCODEOfMediumClouds`, `TypeOfHighClouds`, `OktasOfHighClouds`, `HeightOfHighClouds`, `CLCODEOfHighClouds`, `CloudSearchLightReading`, `Rainfall`, `Dry_Bulb`, `Wet_Bulb`, `Max_Read`, `Max_Reset`, `Min_Read`, `Min_Reset`, `Piche_Read`, `Piche_Reset`, `TimeMarksThermo`, `TimeMarksHygro`, `TimeMarksRainRec`, `Present_Weather`, `Visibility`, `Wind_Direction`, `Wind_Speed`, `Gusting`, `AttdThermo`, `PrAsRead`, `Correction`, `CLP`, `MSLPr`, `TimeMarksBarograph`, `TimeMarksAnemograph`, `OtherTMarks`, `Remarks`, `SubmittedBy`, `Approved`, `CreationDate`) VALUES
('2017-05-01', 1, 'Makerere', 400098, '0500Z', '34', '34', '4', '3', '1600', 'SC', '3', '5', '900', 'AS', '', '', '', '', '34', '34', '19.4', '18.5', '', '', '', '', '', '', '', '', '', 'FOG', '4000', '0000', '000KT', '', '', '', '', '', '', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-05-26 00:00:00'),
('2017-05-01', 2, 'Makerere', 400098, '0700Z', '8', '6', '5', '6', '1600', 'SC', '2', '8', '9000', 'AS', '', '', '', '', '', '', '18.6', '18.5', '', '', '', '', '', '', '', '', '', '', '8000', '140', '06KT', '', '', '', '', '881.6', '1020.6', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-05-26 00:00:00'),
('2017-05-01', 3, 'Makerere', 400098, '0800Z', '8', '5', '5', '5', '1600', 'SC', '2', '8', '10000', 'AS', '', '', '', '', '', '', '19.3', '18.8', '', '', '', '', '', '', '', '', '', '', '9000', '110', '04KT', '', '', '', '', '881.4', '1020.4', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-05-26 00:00:00'),
('2017-05-01', 4, 'Makerere', 400098, '0900Z', '7', '4', '5', '4', '1700', 'SC', '2', '7', '11000', 'AS', '', '', '', '', '', '', '20.4', '18.8', '', '', '', '', '', '', '', '', '', '', '9999', '000', '00KT', '', '', '', '', '880.9', '1019.8', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-05-26 00:00:00'),
('2017-05-01', 5, 'Makerere', 400098, '0600Z', '8', '6', '5', '6', '1600', 'SC', '2', '8', '9000', 'AS', '', '', '', '', '', '1.1', '18.5', '18.5', '26.6', '19.2', '17.8', '18.0', '', '', '', '', '', '', '7000', '180', '04KT', '', '', '', '', '881.5', '1020.5', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-05-26 15:37:18'),
('2017-05-01', 6, 'Makerere', 400098, '1000Z', '7', '4', '5', '4', '1700', 'SC', '1', '7', '11000', 'AS', '', '', '', '', '', '', '20.4', '18.8', '', '', '', '', '', '', '', '', '', 'DZ', '9999', '090', '04KT', '', '', '', '', '879.5', '1018.3', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-06-06 12:16:37'),
('2017-05-01', 7, 'Makerere', 400098, '1100Z', '7', '4', '8', '4', '2000', 'CU', '1', '7', '14000', 'AS', '', '', '', '', '', '', '22.5', '19.6', '', '', '', '', '', '', '', '', '', '', '9999', '000', '00KT', '', '', '', '', '878.9', '1017.5', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-06-06 12:33:51'),
('2017-05-01', 8, 'Makerere', 400098, '1200Z', '6', '2', '2', '2', '2000', 'CU', '7', '6', '14000', 'AS', '', '', '', '', '', '', '23.0', '19.5', '24.6', '', '', '', '', '', '', '', '', '', '9999', '160', '02KT', '', '', '', '', '878.1', '1016.6', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-06-06 12:46:20'),
('2017-05-01', 9, 'Makerere', 400098, '1300Z', '3', '2', '8', '2', '2100', 'CU', '', '', '', '', '9', '3', '25000', 'CC', '', '', '24.0', '19.8', '', '', '', '', '', '', '', '', '', '', '9999', '180', '03KT', '', '', '', '', '877.2', '1015.5', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-06-06 12:54:57'),
('2017-05-01', 10, 'Makerere', 400098, '1400Z', '2', '2', '8', '2', '2100', 'CU', '', '', '', '', '', '', '', '', '', '', '23.8', '19.8', '', '', '', '', '', '', '', '', '', '', '9999', '000', '00KT', '', '', '', '', '877.4', '1015.7', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-06-06 13:03:17'),
('2017-05-01', 11, 'Makerere', 400098, '1500Z', '2', '2', '8', '2', '2100', 'CU', '', '', '', '', '', '', '', '', '', '', '24.0', '19.5', '24.6', '', '', '', '', '', '', '', '', '', '9999', '180', '03KT', '', '', '', '', '877.7', '1016.1', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-06-06 13:14:17'),
('2017-05-02', 12, 'Makerere', 400098, '0500Z', '4', '4', '8', '4', '2000', 'CU', '', '', '', '', '', '', '', '', '', '', '20.0', '19.6', '', '', '', '', '', '', '', '', '', 'FOG', '1000', '000', '00KT', '', '', '', '', '879.5', '1018.2', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-06-06 13:23:43'),
('2017-05-02', 13, 'Makerere', 400098, '0600Z', '3', '3', '8', '3', '2100', 'CU', '', '', '', '', '', '', '', '', '', 'TR', '22.0', '20.8', '26.4', '23.8', '17.8', '21.8', '', '', '', '', '', 'FOG', '3000', '200', '02KT', '', '', '', '', '879.9', '1018.6', '', '', '', '', 'Micheal Lubega', 'FALSE', '2017-06-06 15:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `observationslippreviousone`
--

CREATE TABLE `observationslippreviousone` (
  `Date` date NOT NULL,
  `id` int(11) NOT NULL,
  `StationName` varchar(25) NOT NULL,
  `StationNumber` bigint(20) NOT NULL,
  `TIME` varchar(25) NOT NULL,
  `VVVV` int(11) DEFAULT NULL,
  `TTT` int(11) DEFAULT NULL,
  `TwTw` int(11) DEFAULT NULL,
  `TdTd` int(25) DEFAULT NULL,
  `Tmax` int(11) DEFAULT NULL,
  `Tmin` int(11) DEFAULT NULL,
  `Actual_Rainfall` int(11) DEFAULT NULL,
  `VP` int(11) DEFAULT NULL,
  `RH` int(11) DEFAULT NULL,
  `PPPP` int(11) DEFAULT NULL,
  `WIND_DDD` int(11) DEFAULT NULL,
  `WIND_FF` int(11) DEFAULT NULL,
  `Officers_Sign` varchar(255) DEFAULT NULL,
  `Approved` varchar(25) NOT NULL,
  `SubmittedBy` varchar(25) NOT NULL,
  `CreationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `observationslippreviousone`
--

INSERT INTO `observationslippreviousone` (`Date`, `id`, `StationName`, `StationNumber`, `TIME`, `VVVV`, `TTT`, `TwTw`, `TdTd`, `Tmax`, `Tmin`, `Actual_Rainfall`, `VP`, `RH`, `PPPP`, `WIND_DDD`, `WIND_FF`, `Officers_Sign`, `Approved`, `SubmittedBy`, `CreationDate`) VALUES
('2017-02-22', 1, 'Makerere', 400098, '0500Z', 23, 23, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 'hi hello hello', 'TRUE', 'Admin Admin', '2017-02-22'),
('2017-02-22', 2, 'Makerere', 400098, '0600Z', 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 'ffffff', 'FALSE', 'Admin Admin', '2017-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `scannedarchivedekadalformreportcopydetails`
--

CREATE TABLE `scannedarchivedekadalformreportcopydetails` (
  `id` bigint(225) NOT NULL,
  `Form` varchar(225) NOT NULL,
  `StationName` varchar(225) NOT NULL,
  `StationNumber` bigint(225) NOT NULL,
  `FromDate` date DEFAULT NULL,
  `ToDate` date DEFAULT NULL,
  `Description` varchar(225) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(255) NOT NULL,
  `Approved` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scannedarchivedekadalformreportcopydetails`
--

INSERT INTO `scannedarchivedekadalformreportcopydetails` (`id`, `Form`, `StationName`, `StationNumber`, `FromDate`, `ToDate`, `Description`, `FileName`, `SubmittedBy`, `Approved`, `CreationDate`) VALUES
(1, 'Dekadal form', 'Makerere', 400098, '2017-05-11', '2017-05-12', 'hh', 'eTicket_Itinerary_and_Receipt.pdf', 'Andrew Mwesigwa', 'FALSE', '2017-05-31 21:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `scannedarchivemetarformcopydetails`
--

CREATE TABLE `scannedarchivemetarformcopydetails` (
  `id` bigint(255) NOT NULL,
  `Form` varchar(255) NOT NULL,
  `StationName` varchar(255) NOT NULL,
  `StationNumber` bigint(255) NOT NULL,
  `Date` date DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(255) NOT NULL,
  `Approved` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scannedarchivemonthlyrainfallformreportcopydetails`
--

CREATE TABLE `scannedarchivemonthlyrainfallformreportcopydetails` (
  `id` bigint(255) NOT NULL,
  `Form` varchar(255) NOT NULL,
  `StationName` varchar(255) NOT NULL,
  `StationNumber` bigint(225) NOT NULL,
  `Month` varchar(255) DEFAULT NULL,
  `Year` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(255) NOT NULL,
  `Approved` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scannedarchiveobservationslipformcopydetails`
--

CREATE TABLE `scannedarchiveobservationslipformcopydetails` (
  `id` bigint(255) NOT NULL,
  `Form` varchar(255) NOT NULL,
  `StationName` varchar(255) NOT NULL,
  `StationNumber` bigint(225) NOT NULL,
  `Date` date NOT NULL,
  `TIME` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(255) NOT NULL,
  `Approved` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scannedarchiveobservationslipformcopydetails`
--

INSERT INTO `scannedarchiveobservationslipformcopydetails` (`id`, `Form`, `StationName`, `StationNumber`, `Date`, `TIME`, `Description`, `FileName`, `SubmittedBy`, `Approved`, `CreationDate`) VALUES
(3, 'Observation slip form', 'Makerere', 400098, '2017-05-04', '0100Z', 'www', 'Ethiopian_Web_Check-in_–_Confirmation.pdf', 'Andrew Mwesigwa', 'FALSE', '2017-05-31 21:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `scannedarchivesynopticformreportcopydetails`
--

CREATE TABLE `scannedarchivesynopticformreportcopydetails` (
  `id` bigint(255) NOT NULL,
  `Form` varchar(255) NOT NULL,
  `StationName` varchar(255) NOT NULL,
  `StationNumber` bigint(255) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `FileName_FirstPage` varchar(255) DEFAULT NULL,
  `FileName_SecondPage` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(255) NOT NULL,
  `Approved` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scannedarchiveweathersummaryformreportcopydetails`
--

CREATE TABLE `scannedarchiveweathersummaryformreportcopydetails` (
  `id` bigint(255) NOT NULL,
  `Form` varchar(255) NOT NULL,
  `StationName` varchar(255) NOT NULL,
  `StationNumber` bigint(255) NOT NULL,
  `Month` varchar(255) DEFAULT NULL,
  `Year` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `SubmittedBy` varchar(255) NOT NULL,
  `Approved` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scannedarchiveyearlyrainfallformreportcopydetails`
--

CREATE TABLE `scannedarchiveyearlyrainfallformreportcopydetails` (
  `id` bigint(255) NOT NULL,
  `Form` varchar(255) NOT NULL,
  `StationName` varchar(255) NOT NULL,
  `StationNumber` bigint(255) NOT NULL,
  `Year` varchar(225) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `FileName` varchar(255) NOT NULL,
  `SubmittedBy` varchar(255) NOT NULL,
  `Approved` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int(11) NOT NULL,
  `StationName` varchar(25) NOT NULL,
  `StationNumber` varchar(50) NOT NULL,
  `Location` varchar(25) NOT NULL,
  `Country` varchar(25) NOT NULL,
  `Region` varchar(25) NOT NULL,
  `Code` varchar(20) NOT NULL,
  `City` varchar(25) NOT NULL,
  `Latitude` varchar(25) NOT NULL,
  `Longitude` varchar(50) NOT NULL,
  `Altitude` varchar(50) NOT NULL,
  `Opened` date NOT NULL,
  `Closed` date NOT NULL,
  `Status` varchar(25) NOT NULL,
  `Type` varchar(25) NOT NULL,
  `CreationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `StationName`, `StationNumber`, `Location`, `Country`, `Region`, `Code`, `City`, `Latitude`, `Longitude`, `Altitude`, `Opened`, `Closed`, `Status`, `Type`, `CreationDate`) VALUES
(1, 'Makerere', '400098', 'Kampala', 'Uganda', 'Central', 'HK63', 'Kampala', '90.09 08', '78 00 00', '4000', '0000-00-00', '0000-00-00', 'active', 'Agro', '2015-07-07'),
(2, 'Entebbe', '900098', 'Entebbe', 'Uganda', 'Entebbe', 'HK634', 'Entebbe', '90.09 08', '78 00 00', '4000', '2016-12-05', '2016-12-01', 'Active', 'Agro', '2016-12-05'),
(3, 'Gulu', '10098', 'Gulu', 'Uganda', 'Gulu', 'HRF45', 'Gulu', '456333', '4333', '3244', '2016-12-01', '2016-12-07', 'Active', 'Agro', '2016-12-05'),
(4, 'Kabale', '50098', 'Kabale', 'Uganda', 'Kabale', 'HRF45', 'Kabale', '45', '34', '34', '2016-12-04', '2016-12-04', 'Active', 'Agro', '2016-12-11'),
(5, 'Mbale', '70098', 'Mbale', 'Uganda', 'Mbale', '567', 'Mbale', '34', '45', '45', '2017-05-14', '2017-05-09', 'Active', 'Agro', '2017-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `synoptic`
--

CREATE TABLE `synoptic` (
  `id` int(11) NOT NULL,
  `StationName` varchar(25) NOT NULL,
  `Date` date NOT NULL,
  `Time` varchar(50) NOT NULL,
  `UWS` varchar(11) DEFAULT NULL,
  `BN` int(11) DEFAULT NULL,
  `StationNumber` bigint(20) NOT NULL,
  `IOOP` int(11) DEFAULT NULL,
  `TSPPW` varchar(20) DEFAULT NULL,
  `HLC` int(11) DEFAULT NULL,
  `HV` int(11) DEFAULT NULL,
  `TCC` int(11) DEFAULT NULL,
  `WD` int(11) DEFAULT NULL,
  `WS` int(11) DEFAULT NULL,
  `GI1_1` int(11) DEFAULT NULL,
  `SignOfData_1` double DEFAULT NULL,
  `Air_temperature` int(11) DEFAULT NULL,
  `GI2_1` int(11) DEFAULT NULL,
  `SignOfData_2` int(15) DEFAULT NULL,
  `Dewpoint_temperature` int(11) DEFAULT NULL,
  `GI3_1` int(11) DEFAULT NULL,
  `PASL` int(11) DEFAULT NULL,
  `GI4_1` int(11) DEFAULT NULL,
  `SIS` int(11) DEFAULT NULL,
  `GSIS` int(11) DEFAULT NULL,
  `GI6_1` int(11) DEFAULT NULL,
  `AOP` int(11) DEFAULT NULL,
  `DPOP` int(11) DEFAULT NULL,
  `GI7_1` int(11) DEFAULT NULL,
  `Present_Weather` varchar(25) DEFAULT NULL,
  `Past_Weather` varchar(25) DEFAULT NULL,
  `GI8_1` int(11) DEFAULT NULL,
  `AOC` varchar(25) DEFAULT NULL,
  `CLOG` varchar(25) DEFAULT NULL,
  `CGOG` varchar(25) DEFAULT NULL,
  `CHOG` varchar(25) DEFAULT NULL,
  `Section_Indicator333` int(11) DEFAULT NULL,
  `GI0_1` int(11) DEFAULT NULL,
  `GMT` int(12) DEFAULT NULL,
  `CIOP` int(12) DEFAULT NULL,
  `BEOP` int(12) DEFAULT NULL,
  `Thunder` varchar(11) DEFAULT NULL,
  `Hail` varchar(11) DEFAULT NULL,
  `Fog` varchar(11) DEFAULT NULL,
  `Quake` varchar(11) DEFAULT NULL,
  `Anemometer_Reading` varchar(11) DEFAULT NULL,
  `Actual_Rainfall` varchar(10) DEFAULT NULL,
  `GI1_2` int(15) DEFAULT NULL,
  `SignOfData_3` int(15) DEFAULT NULL,
  `Max_TempTx` int(25) DEFAULT NULL,
  `GI2_2` int(12) DEFAULT NULL,
  `SignOfData_4` int(12) DEFAULT NULL,
  `Max_TempTn` int(12) DEFAULT NULL,
  `GI5_1` int(15) DEFAULT NULL,
  `AOE` int(12) DEFAULT NULL,
  `ITI` varchar(25) DEFAULT NULL,
  `GI55` int(12) DEFAULT NULL,
  `DOS` int(12) DEFAULT NULL,
  `GI5_2` int(12) DEFAULT NULL,
  `SPC` varchar(12) DEFAULT NULL,
  `PCI24Hrs` int(12) DEFAULT NULL,
  `GI6_2` int(12) DEFAULT NULL,
  `AOP_2` int(12) DEFAULT NULL,
  `DPOP_2` int(12) DEFAULT NULL,
  `GI8_2` int(12) DEFAULT NULL,
  `AICL` int(25) DEFAULT NULL,
  `GOC` varchar(12) DEFAULT NULL,
  `HBCLOM` int(12) DEFAULT NULL,
  `GI8_3` int(12) DEFAULT NULL,
  `AICL_2` int(12) DEFAULT NULL,
  `GOC_2` int(12) DEFAULT NULL,
  `HBCLOM_2` int(12) DEFAULT NULL,
  `GI8_4` int(12) DEFAULT NULL,
  `AICL_3` int(12) DEFAULT NULL,
  `GOC_3` int(12) DEFAULT NULL,
  `HBCLOM_3` int(12) DEFAULT NULL,
  `GI8_5` int(12) DEFAULT NULL,
  `AICL_4` int(12) DEFAULT NULL,
  `GOC_4` int(12) DEFAULT NULL,
  `HBCLOM_4` int(12) DEFAULT NULL,
  `GI9` int(11) DEFAULT NULL,
  `Supp_Info` varchar(25) DEFAULT NULL,
  `Section_Indicator555` int(12) DEFAULT NULL,
  `GI1_3` int(12) DEFAULT NULL,
  `SignOfData_5` int(12) DEFAULT NULL,
  `Wetbulb_Temp` int(12) DEFAULT NULL,
  `R_Humidity` int(12) DEFAULT NULL,
  `V_Pressure` int(12) DEFAULT NULL,
  `Approved` varchar(15) NOT NULL,
  `SubmittedBy` varchar(20) NOT NULL,
  `CreationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `synoptic`
--

INSERT INTO `synoptic` (`id`, `StationName`, `Date`, `Time`, `UWS`, `BN`, `StationNumber`, `IOOP`, `TSPPW`, `HLC`, `HV`, `TCC`, `WD`, `WS`, `GI1_1`, `SignOfData_1`, `Air_temperature`, `GI2_1`, `SignOfData_2`, `Dewpoint_temperature`, `GI3_1`, `PASL`, `GI4_1`, `SIS`, `GSIS`, `GI6_1`, `AOP`, `DPOP`, `GI7_1`, `Present_Weather`, `Past_Weather`, `GI8_1`, `AOC`, `CLOG`, `CGOG`, `CHOG`, `Section_Indicator333`, `GI0_1`, `GMT`, `CIOP`, `BEOP`, `Thunder`, `Hail`, `Fog`, `Quake`, `Anemometer_Reading`, `Actual_Rainfall`, `GI1_2`, `SignOfData_3`, `Max_TempTx`, `GI2_2`, `SignOfData_4`, `Max_TempTn`, `GI5_1`, `AOE`, `ITI`, `GI55`, `DOS`, `GI5_2`, `SPC`, `PCI24Hrs`, `GI6_2`, `AOP_2`, `DPOP_2`, `GI8_2`, `AICL`, `GOC`, `HBCLOM`, `GI8_3`, `AICL_2`, `GOC_2`, `HBCLOM_2`, `GI8_4`, `AICL_3`, `GOC_3`, `HBCLOM_3`, `GI8_5`, `AICL_4`, `GOC_4`, `HBCLOM_4`, `GI9`, `Supp_Info`, `Section_Indicator555`, `GI1_3`, `SignOfData_5`, `Wetbulb_Temp`, `R_Humidity`, `V_Pressure`, `Approved`, `SubmittedBy`, `CreationDate`) VALUES
(1, 'Makerere', '2015-07-08', '0600Z', '1', 2, 0, 3, '8', 60, 3, 8, 90, 54, 3, 884.5, 48, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 3, '', '', '', '', 0, 0, 0, 0, 0, 'true', 'true', 'false', 'false', 'true', 'true', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 'test', '08:19:52', '0000-00-00'),
(2, 'Makerere', '2015-07-08', '122000Z', '1', 2, 0, 5, '3', 70, 6, 8, 180, 3, 3, 858.8, 48, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 3, '', '', '', '', 0, 0, 0, 0, 0, '1', '9', '23', '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 'test', '21:00:31', '0000-00-00'),
(3, 'Makerere', '2015-07-16', '0600Z', '3', 2, 0, 5, '66', 65, 3, 4, 245, 55, 23, 886.7, 48, 0, 0, 0, 76, 0, 0, 0, 0, 271, 0, 0, 0, '', '', 5, '', '', '', '', 0, 0, 0, 0, 0, 'true', 'false', 'true', 'false', 'true', 'false', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 'test', '17:45:41', '0000-00-00'),
(4, 'Makerere', '2015-10-23', '231200Z', '0', 0, 400098, 0, '0', 0, 0, 10, 120, 3, 0, 886.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', 0, '0', '0', '0', '0', 0, 0, 0, 0, 0, 'false', 'false', 'false', 'false', 'false', 'false', 0, 0, 0, 0, 0, 0, 0, 0, '34', 0, 0, 0, '7', 0, 0, 0, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Now', 0, 0, 0, 0, 0, 0, 'TRUE', '12:36:42', '0000-00-00'),
(5, 'Entebbe', '2016-12-14', '0600Z', '23', 63, 900098, 33, 'good', 33, 33, 33, 33, 33, 1, 0, 33, 2, 0, 33, 3, 33, 4, 8, 33, 6, 33, 33, 7, 'good', 'good', 8, 'good', 'good', 'good', 'good', 333, 0, 33, 3333, 33, 'false', 'false', 'false', 'false', 'false', 'false', 1, 0, 33, 2, 0, 33, 5, 33, 'good', 55, 33, 5, 'good', 23, 6, 33, 33, 8, 5, 'good', 33, 8, 23, 23, 20, 23, 3, 3, 2, 2, 22, 3, 3, 9, 'good', 555, 1, 0, 33, 33, 33, 'FALSE', 'Mars Mart', '2016-12-14'),
(6, 'Gulu', '2016-12-13', '0900Z', '32', 63, 10098, 33, 'good', 33, 33, 33, 33, 33, 1, 0, 33, 2, 0, 33, 3, 33, 4, 8, 33, 6, 5, 33, 7, 'good', 'good', 8, 'good', 'good', 'good', 'good', 333, 0, 33, 3333, 33, 'false', 'true', 'false', 'false', 'true', 'true', 1, 0, 22, 2, 0, 22, 5, 22, 'good', 55, 33, 5, 'good', 53, 6, 44, 33, 8, 33, 'good', 33, 8, 33, 0, 33, 8, 33, 0, 33, 8, 33, 0, 33, 9, 'good', 555, 1, 0, 33, 33, 33, 'TRUE', 'Mars Mart', '2016-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `synopticprevious`
--

CREATE TABLE `synopticprevious` (
  `id` int(11) NOT NULL,
  `station` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `ir` int(11) DEFAULT NULL,
  `ix` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `www` int(11) DEFAULT NULL,
  `vv` int(11) DEFAULT NULL,
  `n` int(11) DEFAULT NULL,
  `dd` int(11) DEFAULT NULL,
  `ff` int(11) DEFAULT NULL,
  `t` int(11) DEFAULT NULL,
  `td` int(11) DEFAULT NULL,
  `Po` double DEFAULT NULL,
  `gisis` int(11) DEFAULT NULL,
  `hhh` int(11) DEFAULT NULL,
  `rrr` int(11) DEFAULT NULL,
  `tr` int(11) DEFAULT NULL,
  `present` int(11) DEFAULT NULL,
  `past` int(11) DEFAULT NULL,
  `nh` int(11) DEFAULT NULL,
  `cl` int(11) DEFAULT NULL,
  `cm` int(11) DEFAULT NULL,
  `ch` int(11) DEFAULT NULL,
  `Tq` int(11) DEFAULT NULL,
  `Ro` int(11) DEFAULT NULL,
  `R1` int(11) DEFAULT NULL,
  `Tx` int(11) DEFAULT NULL,
  `Tm` int(11) DEFAULT NULL,
  `EE` int(11) DEFAULT NULL,
  `E` int(11) DEFAULT NULL,
  `sss` int(11) DEFAULT NULL,
  `pchange` int(11) DEFAULT NULL,
  `p24` int(11) DEFAULT NULL,
  `rr` int(11) DEFAULT NULL,
  `tr1` int(11) DEFAULT NULL,
  `ns` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `hs` int(11) DEFAULT NULL,
  `ns1` int(11) DEFAULT NULL,
  `c1` int(11) DEFAULT NULL,
  `hs1` int(11) DEFAULT NULL,
  `ns2` int(11) DEFAULT NULL,
  `c2` int(11) DEFAULT NULL,
  `hs2` int(11) DEFAULT NULL,
  `supplementary` text,
  `wb` double DEFAULT NULL,
  `rh` double DEFAULT NULL,
  `vap` double DEFAULT NULL,
  `user` text NOT NULL,
  `submitted` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `synopticprevious`
--

INSERT INTO `synopticprevious` (`id`, `station`, `date`, `time`, `ir`, `ix`, `h`, `www`, `vv`, `n`, `dd`, `ff`, `t`, `td`, `Po`, `gisis`, `hhh`, `rrr`, `tr`, `present`, `past`, `nh`, `cl`, `cm`, `ch`, `Tq`, `Ro`, `R1`, `Tx`, `Tm`, `EE`, `E`, `sss`, `pchange`, `p24`, `rr`, `tr1`, `ns`, `c`, `hs`, `ns1`, `c1`, `hs1`, `ns2`, `c2`, `hs2`, `supplementary`, `wb`, `rh`, `vap`, `user`, `submitted`) VALUES
(1, 'Makerere', '2015-07-08', '120800Z', 1, 2, 3, NULL, 60, 3, 8, 90, NULL, NULL, 884.5, 48, NULL, 0, NULL, 4, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 19, 0, 0, 0, 9, 3, 0, 0, 3, 8, 20, 1, 9, 22, 0, 0, 0, 'none', 16, 61, 178, 'test', '08:19:52'),
(2, 'Makerere', '2015-07-08', '122000Z', 1, 2, 5, NULL, 70, 6, 8, 180, NULL, NULL, 858.8, 48, NULL, 0, NULL, 4, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 19, 0, 0, 0, 8, 3, 0, 0, 3, 6, 23, 1, 9, 23, 0, 0, 0, 'nothing', 18, 63, 272.16, 'test', '21:00:31'),
(3, 'Makerere', '2015-07-16', '161700Z', 3, 2, 5, NULL, 65, 3, 4, 245, NULL, NULL, 886.7, 48, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 271, 0, 0, 0, 0, 9, 5, 0, 0, 3, 6, 23, 1, 9, 25, 5, 3, 63, '', 12, 34, 89.76, 'test', '17:45:41'),
(4, 'Makerere', '2015-10-23', '231200Z', 0, 0, 0, NULL, 0, 0, 10, 120, NULL, NULL, 886.5, 0, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 11, 32, 73.92, 'test', '12:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `systemusers`
--

CREATE TABLE `systemusers` (
  `Userid` bigint(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `SurName` varchar(100) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserStation` varchar(25) NOT NULL,
  `StationNumber` bigint(20) NOT NULL,
  `UserRole` varchar(50) NOT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `UserPhone` varchar(50) NOT NULL,
  `Active` bit(1) NOT NULL,
  `LoggedOn` bit(1) DEFAULT NULL,
  `Reset` bit(1) NOT NULL,
  `LastPasswdChange` datetime NOT NULL,
  `LastLoggedIn` datetime NOT NULL,
  `CreationDate` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemusers`
--

INSERT INTO `systemusers` (`Userid`, `FirstName`, `SurName`, `UserName`, `UserPassword`, `UserStation`, `StationNumber`, `UserRole`, `UserEmail`, `UserPhone`, `Active`, `LoggedOn`, `Reset`, `LastPasswdChange`, `LastLoggedIn`, `CreationDate`, `CreatedBy`) VALUES
(13, 'Admin', 'Admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'Manager', 'antheamarthy@gmail.com', '0779081833', b'0', NULL, b'0', '2016-12-19 08:59:51', '2016-12-19 08:59:51', '2016-11-26 03:23:00', ''),
(23, 'Micheal', 'Lubega', 'm.lubega', 'e10adc3949ba59abbe56e057f20f883e', 'Makerere', 400098, 'OC', 'antheamarthy@gmail.com', '0779081833', b'1', NULL, b'0', '2017-05-15 03:13:38', '2017-05-15 03:13:38', '2017-05-15 03:13:34', 'Manager'),
(24, 'Juliet', 'Alitubeera', 'j.alitubeera', '25c1410cfb54d062f2238ef0d602ca92', 'Makerere', 400098, 'Observer', 'alitubeeraj@gmail.com', '0778527414', b'1', NULL, b'1', '2017-05-18 15:34:11', '2017-05-18 15:34:11', '2017-05-18 15:34:02', 'OC'),
(25, 'Jasper', 'Ainebyona', 'j.ainebyona', 'bdcbbefad096df5ca3214c97129b50aa', 'Makerere', 400098, 'Observer', 'jainebyona@yahoo.com', '0775342633', b'1', NULL, b'0', '2017-05-18 16:50:45', '2017-05-18 16:50:45', '2017-05-18 15:41:02', 'OC'),
(26, 'Agnes', 'Nalukwago', 'a.nalukwago', '1c6cf6ed0473f36bcbb736dfefe4722d', 'Makerere', 400098, 'Observer', 'nakagie12@gmail.com', '0703733945', b'1', NULL, b'0', '2017-05-19 13:21:11', '2017-05-19 13:21:11', '2017-05-18 15:44:52', 'OC'),
(27, 'Jaspers', 'Ainebyona', 'j.ainebyona', 'b7bd2325c796690e3c75d7fa70891b2c', 'Makerere', 400098, 'ObserverArchive', 'jainebyona@yahoo.com', '0775342633', b'1', NULL, b'1', '2017-05-23 10:33:20', '2017-05-23 10:33:20', '2017-05-23 10:33:12', 'OC'),
(28, 'Andrew', 'Mwesigwa', 'a.mwesigwa', '477d32c4345256810277a7d074ac1c05', 'Makerere', 400098, 'ObserverDataEntrant', 'lubmick@yahoo.com', '0772594891', b'1', NULL, b'1', '2017-05-23 12:43:50', '2017-05-23 12:43:50', '2017-05-23 12:43:41', 'OC'),
(29, 'Andrew', 'Mwesigwa', 'a.mwesigwa', '52d2305b658cd05bef76c21e56fa6c3a', 'Makerere', 400098, 'OC', 'andrewmwesigwa3@gmail.com', '0712131871', b'1', NULL, b'0', '2017-05-23 17:50:13', '2017-05-23 17:50:13', '2017-05-23 17:48:54', 'Manager'),
(30, 'Andrews', 'Mwesigwa', 'a.mwesigwa', 'e10adc3949ba59abbe56e057f20f883e', 'Makerere', 400098, 'Observer', 'andrewmwesigwa3@gmail.com', '0712131871', b'1', NULL, b'0', '2017-05-23 17:53:26', '2017-05-23 17:53:26', '2017-05-23 17:52:17', 'OC'),
(31, 'Andrew', 'Mwesigwa', 'a.mwesigwa', '9bc73a34913700e9d752d5d2d00187cd', 'Makerere', 400098, 'OC', 'amwesigwa@mulib.mak.ac.ug', '0712131871', b'1', NULL, b'0', '2017-05-23 18:04:13', '2017-05-23 18:04:13', '2017-05-23 18:02:51', 'Manager'),
(32, 'Andrew', 'Mwesigwa', 'a.mwesigwa', '2323327a001f60d1b529b3d64a164043', 'Makerere', 400098, 'ObserverArchive', 'andrewmwesigwa1@gmail.com', '0712131871', b'1', NULL, b'0', '2017-05-23 18:08:34', '2017-05-23 18:08:34', '2017-05-23 18:07:32', 'OC'),
(33, 'Emmy', 'Mwesigwa', 'e.mwesigwa', '9bc73a34913700e9d752d5d2d00187cd', 'Makerere', 400098, 'ObserverDataEntrant', 'andrewmwesigwa3@gmail.com', '0712131871', b'1', NULL, b'0', '2017-05-23 18:29:40', '2017-05-23 18:29:40', '2017-05-23 18:27:33', 'OC');

-- --------------------------------------------------------

--
-- Table structure for table `testaws`
--

CREATE TABLE `testaws` (
  `FirstName` varchar(12) NOT NULL,
  `SurName` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testaws`
--

INSERT INTO `testaws` (`FirstName`, `SurName`) VALUES
('Test', 'Testing'),
('Test', 'Testing'),
('BBBBB', 'BBBBB');

-- --------------------------------------------------------

--
-- Table structure for table `testnamesdb`
--

CREATE TABLE `testnamesdb` (
  `id` int(12) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `SurName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testnamesdb`
--

INSERT INTO `testnamesdb` (`id`, `FirstName`, `SurName`) VALUES
(1, 'Test', 'Testing'),
(2, 'Test', 'Testing'),
(3, 'Test', 'Testing'),
(4, 'Test', 'Testing'),
(5, 'Test', 'Testing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archieve`
--
ALTER TABLE `archieve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archivedekadalformreportdata`
--
ALTER TABLE `archivedekadalformreportdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archivemetarformdata`
--
ALTER TABLE `archivemetarformdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archivemonthlyrainfallformreportdata`
--
ALTER TABLE `archivemonthlyrainfallformreportdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archiveobservationslipformdata`
--
ALTER TABLE `archiveobservationslipformdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archivesynopticformreportdata`
--
ALTER TABLE `archivesynopticformreportdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archiveweathersummaryformreportdata`
--
ALTER TABLE `archiveweathersummaryformreportdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aws`
--
ALTER TABLE `aws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailyperiodicrainfall`
--
ALTER TABLE `dailyperiodicrainfall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailyprevious`
--
ALTER TABLE `dailyprevious`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metar`
--
ALTER TABLE `metar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moreformfields`
--
ALTER TABLE `moreformfields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observationslip`
--
ALTER TABLE `observationslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observationslippreviousone`
--
ALTER TABLE `observationslippreviousone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scannedarchivedekadalformreportcopydetails`
--
ALTER TABLE `scannedarchivedekadalformreportcopydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scannedarchivemetarformcopydetails`
--
ALTER TABLE `scannedarchivemetarformcopydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scannedarchivemonthlyrainfallformreportcopydetails`
--
ALTER TABLE `scannedarchivemonthlyrainfallformreportcopydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scannedarchiveobservationslipformcopydetails`
--
ALTER TABLE `scannedarchiveobservationslipformcopydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scannedarchivesynopticformreportcopydetails`
--
ALTER TABLE `scannedarchivesynopticformreportcopydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scannedarchiveweathersummaryformreportcopydetails`
--
ALTER TABLE `scannedarchiveweathersummaryformreportcopydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scannedarchiveyearlyrainfallformreportcopydetails`
--
ALTER TABLE `scannedarchiveyearlyrainfallformreportcopydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `synoptic`
--
ALTER TABLE `synoptic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `synopticprevious`
--
ALTER TABLE `synopticprevious`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemusers`
--
ALTER TABLE `systemusers`
  ADD PRIMARY KEY (`Userid`);

--
-- Indexes for table `testnamesdb`
--
ALTER TABLE `testnamesdb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archieve`
--
ALTER TABLE `archieve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `archivedekadalformreportdata`
--
ALTER TABLE `archivedekadalformreportdata`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `archivemetarformdata`
--
ALTER TABLE `archivemetarformdata`
  MODIFY `id` bigint(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `archivemonthlyrainfallformreportdata`
--
ALTER TABLE `archivemonthlyrainfallformreportdata`
  MODIFY `id` bigint(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `archiveobservationslipformdata`
--
ALTER TABLE `archiveobservationslipformdata`
  MODIFY `id` bigint(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `archivesynopticformreportdata`
--
ALTER TABLE `archivesynopticformreportdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `archiveweathersummaryformreportdata`
--
ALTER TABLE `archiveweathersummaryformreportdata`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aws`
--
ALTER TABLE `aws`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dailyperiodicrainfall`
--
ALTER TABLE `dailyperiodicrainfall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `dailyprevious`
--
ALTER TABLE `dailyprevious`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `metar`
--
ALTER TABLE `metar`
  MODIFY `id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `moreformfields`
--
ALTER TABLE `moreformfields`
  MODIFY `id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `observationslip`
--
ALTER TABLE `observationslip`
  MODIFY `id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `observationslippreviousone`
--
ALTER TABLE `observationslippreviousone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `scannedarchivedekadalformreportcopydetails`
--
ALTER TABLE `scannedarchivedekadalformreportcopydetails`
  MODIFY `id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `scannedarchivemetarformcopydetails`
--
ALTER TABLE `scannedarchivemetarformcopydetails`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scannedarchivemonthlyrainfallformreportcopydetails`
--
ALTER TABLE `scannedarchivemonthlyrainfallformreportcopydetails`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scannedarchiveobservationslipformcopydetails`
--
ALTER TABLE `scannedarchiveobservationslipformcopydetails`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `scannedarchivesynopticformreportcopydetails`
--
ALTER TABLE `scannedarchivesynopticformreportcopydetails`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scannedarchiveweathersummaryformreportcopydetails`
--
ALTER TABLE `scannedarchiveweathersummaryformreportcopydetails`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scannedarchiveyearlyrainfallformreportcopydetails`
--
ALTER TABLE `scannedarchiveyearlyrainfallformreportcopydetails`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `synoptic`
--
ALTER TABLE `synoptic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `synopticprevious`
--
ALTER TABLE `synopticprevious`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `systemusers`
--
ALTER TABLE `systemusers`
  MODIFY `Userid` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `testnamesdb`
--
ALTER TABLE `testnamesdb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
