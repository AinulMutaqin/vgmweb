-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04 Agu 2016 pada 12.31
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vgmsolas2`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_gate` (`pTerminal` VARCHAR(50))  BEGIN
    INSERT INTO lane (lane, terminal)
  SELECT GATE_LANE, TERMINAL FROM tempgate
  WHERE TERMINAL = pTerminal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_trx_api` (`pTerminal` VARCHAR(50))  BEGIN
  DECLARE vIdApi INT;

    INSERT INTO trx_api_terminal
  (idTerminal, idApi)
  VALUES (pTerminal, vIdApi);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_users` (`pTerminal` VARCHAR(50))  BEGIN
  DECLARE vIdTerminal INT; #variable untuk menampung foreign key idTerminal
  
  #variable bantuan
  DECLARE vUserid INT;
  DECLARE n INT DEFAULT 0;
  DECLARE i INT DEFAULT 0;
  
  /*
  core logic -> cek berdasarkan userid pada table users
  1 jika userid ada, maka lakukan update,
  2 jika userid tidak ada, maka lakukan insert
  
  table yang dependency dgn procedure ini
  1 table tempuser
  2 table users
  3 table trx_user_terminal
  */
  
  /* inisialisasi variable utk idTerminal berdasarkan parameter terminal
  value 1 => TO3 => Tanjung Priok ; 2 => PLG => Palembang ; 3 => PJG => Panjang ; 4 => PNK => Pontianak */
  IF pTerminal = 'TO3' THEN SET vIdTerminal = 1;
    ELSEIF pTerminal = 'PLG' THEN SET vIdTerminal = 2;
    ELSEIF pTerminal = 'PJG' THEN SET vIdTerminal = 3;
    ELSEIF pTerminal = 'PNK' THEN SET vIdTerminal = 4;
  END IF;
  
  # cek userid nya terlebih dulu pada table users
  IF EXISTS(SELECT userid FROM users WHERE terminal = pTerminal) THEN
  
    /* # create temp table for this result
    CREATE TEMPORARY TABLE IF NOT EXISTS resultsetUsers AS (
      SELECT USER_1STNAME, USER_LASTNAME, PASSWORD, TERMINAL FROM tempuser WHERE TERMINAL = pTerminal
    ); */
    
    # insert into table temp resultsetUsers sebagai acuan update record user yang akan dilakukan
    INSERT INTO resultsetusers (USER_ID, USER_1STNAME, USER_LASTNAME, PASSWORD, TERMINAL)
    # cek perubahan yang terjadi pada setiap row users
    SELECT *
    FROM
     (
        SELECT USER_ID, USER_1STNAME, USER_LASTNAME, PASSWORD, TERMINAL
        FROM tempuser
          UNION ALL
        SELECT userid, username, lastname, password, terminal
        FROM users
    ) compareuser
    WHERE TERMINAL = pTerminal AND
    USER_1STNAME NOT IN (SELECT username FROM users WHERE username IN ('PARDAMEAN', 'ORDONA'))
    GROUP BY USER_1STNAME, USER_LASTNAME, PASSWORD, TERMINAL
    HAVING COUNT(*) = 1
    ORDER BY USER_1STNAME;
    
    #1 lakukan update jika userid ada pada table users
    SELECT COUNT(*) FROM resultsetusers INTO n;
    
    SET i = 0;
    WHILE i < n DO
      UPDATE users
      SET username = (SELECT USER_1STNAME FROM resultsetusers),
      lastname = (SELECT USER_LASTNAME FROM resultsetusers),
      password = (SELECT PASSWORD FROM resultsetusers);
      
      SET i = i + 1;
    END WHILE;
    
    DELETE FROM resultsetusers;
    
  ELSE
    #2 lakukan insert jika userid tidak ada pada table users
    INSERT INTO users (userid, username, lastname, password, terminal)
    SELECT USER_ID, USER_1STNAME, USER_LASTNAME, PASSWORD, TERMINAL FROM tempuser
    WHERE TERMINAL = pTerminal;
    
    UPDATE users 
    SET authorization = 1, idTerminal = vIdTerminal
    WHERE terminal = pTerminal;
    
    INSERT INTO trx_user_terminal (userid, terminalId)
    SELECT USER_ID, TERMINAL FROM tempuser
    WHERE TERMINAL = pTerminal;
      
  END IF;
END$$

CREATE DEFINER=`root`@`%` PROCEDURE `sp_update_users_all` ()  BEGIN
  
    INSERT INTO users (userid, username, lastname, password, terminal)
  SELECT USER_ID, USER_1STNAME, USER_LASTNAME, PASSWORD, TERMINAL FROM tempuser;
  
    UPDATE users
  SET authorization = 1;
  
    INSERT INTO trx_user_terminal (userid, terminalId)
  SELECT USER_ID, TERMINAL FROM tempuser;
  
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api`
--

CREATE TABLE `api` (
  `url` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `api_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `api`
--

INSERT INTO `api` (`url`, `type`, `api_id`) VALUES
('http://10.10.31.36/opus_vgmapps/index.php', 'tca', 1),
('http://10.10.12.251:7310/HESSIAN/HESSIAN_AUTOGATE', 'hessian', 2),
('http://10.10.12.251:7110/HESSIAN/HESSIAN_AUTOGATE', 'hessian', 3),
('http://opuspjg.indonesiaport.co.id/HESSIAN/HESSIAN', 'hessianProd', 4),
('http://10.10.31.36/opus_vgmapps_prod/index.php', 'tcaProd', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lane`
--

CREATE TABLE `lane` (
  `lane` varchar(50) NOT NULL,
  `terminal` varchar(50) NOT NULL,
  `laneid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lane`
--

INSERT INTO `lane` (`lane`, `terminal`, `laneid`) VALUES
('GATE00', 'PJG', 1),
('GATE13', 'PJG', 2),
('ECO', 'PJG', 3),
('GATE01', 'PJG', 4),
('GATE02', 'PJG', 5),
('GATE03', 'PJG', 6),
('GATE04', 'PJG', 7),
('GATE05', 'PJG', 8),
('GATE06', 'PJG', 9),
('GATE07', 'PJG', 10),
('GATE08', 'PJG', 11),
('GATE09', 'PJG', 12),
('GATE10', 'PJG', 13),
('GATE11', 'PJG', 14),
('GATE12', 'PJG', 15),
('INSP', 'PJG', 16),
('GATE20', 'PJG', 17),
('GATE21', 'PJG', 18),
('GATE22', 'PJG', 19),
('GATE23', 'PJG', 20),
('GATE24', 'PJG', 21),
('GATE25', 'PJG', 22),
('GATE26', 'PJG', 23),
('GATE27', 'PJG', 24),
('GATE28', 'PJG', 25),
('GATE29', 'PJG', 26),
('IN01', 'PJG', 27),
('OUT02', 'PJG', 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_transaction`
--

CREATE TABLE `log_transaction` (
  `id` int(11) NOT NULL,
  `transaction_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_transaction`
--

INSERT INTO `log_transaction` (`id`, `transaction_name`) VALUES
(1, '{"datetime":"28-06-2016","messageLog":"Hardcode Test","terminal":"PLG","userId":"324636","truckId":"IN01"}'),
(2, '{"datetime":"28-06-2016","messageLog":"Hardcode Test","terminal":"PLG","userId":"324636","truckId":"IN01"}'),
(3, '{"datetime":"29-06-2016","messageLog":"Hardcode Test","terminal":"PLG","userId":"324636","truckId":"IN01"}'),
(4, '{"datetime":"01-07-2016","messageLog":"Hardcode First July","terminal":"PLG","userId":"324636","truckId":"IN01"}'),
(5, '{"datetime":"01-07-2016","messageLog":"Hardcode First July","terminal":"PLG","userId":"324636","truckId":"IN01"}'),
(6, '{"datetime":"01-07-2016","messageLog":"Hardcode First July","terminal":"PLG","userId":"324636","truckId":"IN01"}'),
(7, '{"datetime":"01-07-2016","messageLog":"Hardcode First July Server","terminal":"PLG","userId":"324636","truckId":"IN01"}'),
(8, '{"datetime":"12-07-2016","messageLog":"Hardcode July 12 th","terminal":"PJG","userId":"324636","truckId":"IN01"}'),
(9, '{"datetime":"12-07-2016","messageLog":"Hardcode July 12 th","terminal":"PJG","userId":"324636","truckId":"IN01"}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resultsetusers`
--

CREATE TABLE `resultsetusers` (
  `USER_ID` varchar(100) NOT NULL,
  `USER_1STNAME` varchar(100) NOT NULL,
  `USER_LASTNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `TERMINAL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `resultsetusers`
--

INSERT INTO `resultsetusers` (`USER_ID`, `USER_1STNAME`, `USER_LASTNAME`, `PASSWORD`, `TERMINAL`) VALUES
('1456', 'AINUL', 'MUTAQIN', '1111', 'PJG'),
('1462', 'ARIANTO', 'SITOHANG', '1111', 'PJG'),
('1456', 'AINUL', 'MUTAQIN', '1111', 'PJG'),
('1462', 'ARIANTO', 'SITOHANG', '1111', 'PJG'),
('1456', 'AINUL', 'MUTAQIN', '1111', 'PJG'),
('1462', 'ARIANTO', 'SITOHANG', '1111', 'PJG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempgate`
--

CREATE TABLE `tempgate` (
  `GATE_LANE` varchar(100) NOT NULL,
  `GATE_MODE` varchar(100) NOT NULL,
  `TERMINAL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tempgate`
--

INSERT INTO `tempgate` (`GATE_LANE`, `GATE_MODE`, `TERMINAL`) VALUES
('IN01', 'I', 'TO3'),
('OUT05', 'O', 'TO3'),
('GATE00', 'I', 'PJG'),
('GATE13', 'O', 'PJG'),
('ECO', 'I', 'PJG'),
('GATE01', 'I', 'PJG'),
('GATE02', 'I', 'PJG'),
('GATE03', 'I', 'PJG'),
('GATE04', 'I', 'PJG'),
('GATE05', 'I', 'PJG'),
('GATE06', 'I', 'PJG'),
('GATE07', 'I', 'PJG'),
('GATE08', 'O', 'PJG'),
('GATE09', 'O', 'PJG'),
('GATE10', 'O', 'PJG'),
('GATE11', 'O', 'PJG'),
('GATE12', 'O', 'PJG'),
('INSP', 'I', 'PJG'),
('GATE20', 'I', 'PJG'),
('GATE21', 'I', 'PJG'),
('GATE22', 'I', 'PJG'),
('GATE23', 'I', 'PJG'),
('GATE24', 'I', 'PJG'),
('GATE25', 'O', 'PJG'),
('GATE26', 'O', 'PJG'),
('GATE27', 'O', 'PJG'),
('GATE28', 'O', 'PJG'),
('GATE29', 'O', 'PJG'),
('IN01', 'I', 'PJG'),
('OUT02', 'O', 'PJG'),
('IN01', 'I', 'PLG'),
('IN02', 'I', 'PLG'),
('OUT01', 'O', 'PLG'),
('OUT02', 'O', 'PLG'),
('UAT-OUT', 'O', 'PNK'),
('IN05', 'I', 'PNK'),
('IN07', 'I', 'PNK'),
('OUT05', 'O', 'PNK'),
('ÙAT-IN', 'I', 'PNK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempuser`
--

CREATE TABLE `tempuser` (
  `USER_ID` varchar(100) NOT NULL,
  `USER_1STNAME` varchar(100) NOT NULL,
  `USER_LASTNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `TERMINAL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tempuser`
--

INSERT INTO `tempuser` (`USER_ID`, `USER_1STNAME`, `USER_LASTNAME`, `PASSWORD`, `TERMINAL`) VALUES
('90866', 'CAPRI', 'SUDARMONO', '123456', 'TO3'),
('90895', 'Satria', 'Tumenggala', '90895', 'TO3'),
('90984', 'david', 'david', '123456', 'TO3'),
('105240', 'Tunggal', 'Sukira', '105240', 'TO3'),
('085963', 'Rucikman', 'Gultom', '123456', 'TO3'),
('0984', 'EL', 'David', '230367', 'TO3'),
('90352', 'Misykatul', 'Anwar', '123456', 'TO3'),
('90969', 'RUDI', 'RIAWAN', '123456', 'TO3'),
('056067', 'Eko', 'Prayitno', '056067', 'TO3'),
('065972', 'Sugianto', '.', '065972', 'TO3'),
('26925336', 'RISTON', 'PANGARIBUAN', '123456', 'TO3'),
('90951', 'Darwin', 'Lukas H.', '90951', 'TO3'),
('91444', 'REZY', 'PERDANA', '123456', 'TO3'),
('91213', 'Sobri .', '.', '123456', 'TO3'),
('90956', 'Deden', 'Tambose', '90956', 'TO3'),
('90661', 'Setyo', 'Triatmadji', '90661', 'TO3'),
('90940', 'Syaiful', 'Bahri', '211290', 'TO3'),
('90934', 'Riswi Rizki', 'Rakasiwi', '170193', 'TO3'),
('067465', 'Setiya', 'Budi', '067465', 'TO3'),
('116168', 'Rahmat', 'Khaerudin', '116168', 'TO3'),
('91203', 'Maududi .', '.', '91203', 'TO3'),
('117443', 'Novriansyah .', '.', '300305', 'TO3'),
('056697', 'M.', 'Sutriyono', '056697', 'TO3'),
('90899', 'SATRIONO', 'SATRIONO', '123456', 'TO3'),
('3115', 'Idham', 'Kholiq', '1111', 'PJG'),
('1464', 'BAGUS', 'NURMANYSAH', '1111', 'PJG'),
('1868', 'M', 'FAISAL', '1111', 'PJG'),
('1492', 'NANANG', 'S', '1111', 'PJG'),
('1462', 'ARIANTO', 'SITOHANG', '1111', 'PJG'),
('1456', 'AINUL', 'MUTAQIN', '1111', 'PJG'),
('093320', 'M. HUSNI', 'THAMRIN', '1111', 'PJG'),
('1740', 'ESRON', 'SITOHANG', '1111', 'PJG'),
('1509', 'SURATNO', 'SURATNO', '1111', 'PJG'),
('1543', 'DENY', 'SUPRIANTO', '1111', 'PJG'),
('1580', 'M', 'ROZZI', '1111', 'PJG'),
('1538', 'M', 'LUTFI ALI F', '1111', 'PJG'),
('1513', 'SUTARNO', 'SUTARNO', '1111', 'PJG'),
('1754', 'TOTOK', 'S', '1111', 'PJG'),
('1488', 'YAH', 'AMBARWANTO', '1111', 'PJG'),
('1736', 'WAHYUDIN', 'WAHYUDIN', '1111', 'PJG'),
('1525', 'RIO', 'RAHMADANI', '1111', 'PJG'),
('093131', 'YADI', 'MULYANA', '1111', 'PJG'),
('093119', 'HERI', 'SUBAGIO', '1111', 'PJG'),
('093118', 'SOPIAN', 'SOPIAN', '1111', 'PJG'),
('093241', 'AHMAD', 'SULAIMAN', '1111', 'PJG'),
('093445', 'NURJAMIL', 'NURJAMIL', '1111', 'PJG'),
('093453', 'BAGUS TRI', 'WINARKO', '1111', 'PJG'),
('093432', 'RISWAL', 'RAIYAL', '1111', 'PJG'),
('093143', 'JOHANES', 'T', '1111', 'PJG'),
('093230', 'SAMID', 'SAMID', '1111', 'PJG'),
('092115', 'LEONALDI', 'AHMAD', '1111', 'PJG'),
('093457', 'UCE', 'SUPRIYADI', '1111', 'PJG'),
('091576', 'M. IAN', 'P', '1111', 'PJG'),
('093108', 'Agun', 'Mulyana', '1111', 'PJG'),
('093418', 'BAMBANG', 'SUDIMAN', '1111', 'PJG'),
('093229', 'SARYONO', 'SARYONO', '1111', 'PJG'),
('093232', 'ARIPIN', 'ARIPIN', '1111', 'PJG'),
('093404', 'SAFRUDIN', 'SAFRUDIN', '1111', 'PJG'),
('093121', 'RANDU', 'RANDU', '1111', 'PJG'),
('093434', 'DODI', 'RIANSYAH', '1111', 'PJG'),
('093446', 'ZAKARIA', 'ZAKARIA', '1111', 'PJG'),
('093314', 'KM. SULAIMAN', 'SULAIMAN', '1111', 'PJG'),
('092118', 'YASIN', 'YASIN', '1111', 'PJG'),
('093252', 'SUSILO', 'CAHYADI', '1111', 'PJG'),
('093258', 'BIMA NUR', 'ROHMAN', '1111', 'PJG'),
('093142', 'SURIP', 'SURIP', '1111', 'PJG'),
('093402', 'ABDUL', 'JAWAD', '1111', 'PJG'),
('3261', 'RUSTAM', 'EFFENDI', '1111', 'PJG'),
('093159', 'YULI', 'WARSITO', '1111', 'PJG'),
('093426', 'DWI', 'PRIYONO', '1111', 'PJG'),
('093157', 'DASUKI', 'DASUKI', '1111', 'PJG'),
('093144', 'SALIRI', 'SALIRI', '1111', 'PJG'),
('093237', 'GUNTORO', 'GUNTORO', '1111', 'PJG'),
('093233', 'MARYAMIN', 'MARYAMIN', '1111', 'PJG'),
('093318', 'M. LATIF', 'LATIF', '1111', 'PJG'),
('093116', 'AGUS', 'PURWANTO', '1111', 'PJG'),
('017863', 'WAHID', 'RAHMAT S', '123456', 'PJG'),
('093349', 'SLAMET', 'ARTOMORO', '1111', 'PJG'),
('3335', 'DEDI', 'SUHADA', '1111', 'PJG'),
('093164', 'HERMAWAN', 'HERMAWAN', '1111', 'PJG'),
('093147', 'M. IQBAL', 'IQBAL', '1111', 'PJG'),
('093416', 'ZAENAL', 'ARIFIN', '1111', 'PJG'),
('093117', 'JANES', 'SETIO', '1111', 'PJG'),
('093449', 'RIYANTO', 'NAINGGOLAN', '1111', 'PJG'),
('093317', 'YUSUF', 'YUSUF', '1111', 'PJG'),
('093451', 'JAMALUDIN', 'JAMALUDIN', '1111', 'PJG'),
('093240', 'TARMIDI', 'TARMIDI', '1111', 'PJG'),
('112233', 'Tes', 'Pager', '112233', 'PJG'),
('324636', 'Chairil', 'Fajri', '123456', 'PLG'),
('325521', 'Agus', 'Winarso', '123456', 'PLG'),
('325530', 'Lefran', 'Falia', '123456', 'PLG'),
('325535', 'Andi', 'Tanzili', '123456', 'PLG'),
('340024', 'Satim', 'Satim', '123456', 'PLG'),
('340025', 'Yan', 'Parmadi', '123456', 'PLG'),
('340026', 'Amizar', 'Amizar', '1980', 'PLG'),
('340027', 'Eko', 'Gustian', '123456', 'PLG'),
('990001', 'AJI WEDHAR', 'WEDHAR', '123456', 'PLG'),
('26925337', 'admin', 'admin', 'admin', 'PJG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `terminal`
--

CREATE TABLE `terminal` (
  `terminalId` int(11) NOT NULL,
  `terminal` varchar(50) NOT NULL,
  `terminal_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `terminal`
--

INSERT INTO `terminal` (`terminalId`, `terminal`, `terminal_name`) VALUES
(1, 'TO3', 'Tanjung Priok'),
(2, 'PLG', 'Palembang'),
(3, 'PJG', 'Panjang'),
(4, 'PNK', 'Pontianak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_api_terminal`
--

CREATE TABLE `trx_api_terminal` (
  `idTerminal` varchar(50) NOT NULL,
  `idApi` int(11) NOT NULL,
  `trxid_api_terminal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trx_api_terminal`
--

INSERT INTO `trx_api_terminal` (`idTerminal`, `idApi`, `trxid_api_terminal`) VALUES
('TO3', 1, 1),
('TO3', 2, 2),
('PLG', 1, 3),
('PLG', 3, 4),
('PJG', 1, 5),
('PJG', 2, 6),
('PNK', 1, 7),
('PNK', 2, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_truck_terminal`
--

CREATE TABLE `trx_truck_terminal` (
  `truck_id` int(11) NOT NULL,
  `terminal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gross_weight` int(11) NOT NULL,
  `container_id` int(11) NOT NULL,
  `voy_in` int(11) NOT NULL,
  `voy_out` int(11) NOT NULL,
  `trx_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_user_terminal`
--

CREATE TABLE `trx_user_terminal` (
  `userid` int(11) NOT NULL,
  `terminalId` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trx_user_terminal`
--

INSERT INTO `trx_user_terminal` (`userid`, `terminalId`) VALUES
(3115, 'PJG'),
(1464, 'PJG'),
(1868, 'PJG'),
(1492, 'PJG'),
(1462, 'PJG'),
(1456, 'PJG'),
(93320, 'PJG'),
(1740, 'PJG'),
(1509, 'PJG'),
(1543, 'PJG'),
(1580, 'PJG'),
(1538, 'PJG'),
(1513, 'PJG'),
(1754, 'PJG'),
(1488, 'PJG'),
(1736, 'PJG'),
(1525, 'PJG'),
(93131, 'PJG'),
(93119, 'PJG'),
(93118, 'PJG'),
(93241, 'PJG'),
(93445, 'PJG'),
(93453, 'PJG'),
(93432, 'PJG'),
(93143, 'PJG'),
(93230, 'PJG'),
(92115, 'PJG'),
(93457, 'PJG'),
(91576, 'PJG'),
(93108, 'PJG'),
(93418, 'PJG'),
(93229, 'PJG'),
(93232, 'PJG'),
(93404, 'PJG'),
(93121, 'PJG'),
(93434, 'PJG'),
(93446, 'PJG'),
(93314, 'PJG'),
(92118, 'PJG'),
(93252, 'PJG'),
(93258, 'PJG'),
(93142, 'PJG'),
(93402, 'PJG'),
(3261, 'PJG'),
(93159, 'PJG'),
(93426, 'PJG'),
(93157, 'PJG'),
(93144, 'PJG'),
(93237, 'PJG'),
(93233, 'PJG'),
(93318, 'PJG'),
(93116, 'PJG'),
(17863, 'PJG'),
(93349, 'PJG'),
(3335, 'PJG'),
(93164, 'PJG'),
(93147, 'PJG'),
(93416, 'PJG'),
(93117, 'PJG'),
(93449, 'PJG'),
(93317, 'PJG'),
(93451, 'PJG'),
(93240, 'PJG'),
(112233, 'PJG'),
(26925337, 'PJG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authorization` int(11) NOT NULL,
  `idTerminal` int(11) NOT NULL,
  `terminal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userid`, `username`, `lastname`, `password`, `authorization`, `idTerminal`, `terminal`) VALUES
(1456, 'PARDAMEAN', 'PARDAMEAN', '1111', 1, 3, 'PJG'),
(1462, 'ORDONA', 'SITORUS', '1111', 1, 3, 'PJG'),
(1464, 'BAGUS', 'NURMANYSAH', '1111', 1, 3, 'PJG'),
(1488, 'YAH', 'AMBARWANTO', '1111', 1, 3, 'PJG'),
(1492, 'NANANG', 'S', '1111', 1, 3, 'PJG'),
(1509, 'SURATNO', 'SURATNO', '1111', 1, 3, 'PJG'),
(1513, 'SUTARNO', 'SUTARNO', '1111', 1, 3, 'PJG'),
(1525, 'RIO', 'RAHMADANI', '1111', 1, 3, 'PJG'),
(1538, 'M', 'LUTFI ALI F', '1111', 1, 3, 'PJG'),
(1543, 'DENY', 'SUPRIANTO', '1111', 1, 3, 'PJG'),
(1580, 'M', 'ROZZI', '1111', 1, 3, 'PJG'),
(1736, 'WAHYUDIN', 'WAHYUDIN', '1111', 1, 3, 'PJG'),
(1740, 'ESRON', 'SITOHANG', '1111', 1, 3, 'PJG'),
(1754, 'TOTOK', 'S', '1111', 1, 3, 'PJG'),
(1868, 'M', 'FAISAL', '1111', 1, 3, 'PJG'),
(3115, 'Idham', 'Kholiq', '1111', 1, 3, 'PJG'),
(3261, 'RUSTAM', 'EFFENDI', '1111', 1, 3, 'PJG'),
(3335, 'DEDI', 'SUHADA', '1111', 1, 3, 'PJG'),
(17863, 'WAHID', 'RAHMAT S', '123456', 1, 3, 'PJG'),
(91576, 'M. IAN', 'P', '1111', 1, 3, 'PJG'),
(92115, 'LEONALDI', 'AHMAD', '1111', 1, 3, 'PJG'),
(92118, 'YASIN', 'YASIN', '1111', 1, 3, 'PJG'),
(93108, 'Agun', 'Mulyana', '1111', 1, 3, 'PJG'),
(93116, 'AGUS', 'PURWANTO', '1111', 1, 3, 'PJG'),
(93117, 'JANES', 'SETIO', '1111', 1, 3, 'PJG'),
(93118, 'SOPIAN', 'SOPIAN', '1111', 1, 3, 'PJG'),
(93119, 'HERI', 'SUBAGIO', '1111', 1, 3, 'PJG'),
(93121, 'RANDU', 'RANDU', '1111', 1, 3, 'PJG'),
(93131, 'YADI', 'MULYANA', '1111', 1, 3, 'PJG'),
(93142, 'SURIP', 'SURIP', '1111', 1, 3, 'PJG'),
(93143, 'JOHANES', 'T', '1111', 1, 3, 'PJG'),
(93144, 'SALIRI', 'SALIRI', '1111', 1, 3, 'PJG'),
(93147, 'M. IQBAL', 'IQBAL', '1111', 1, 3, 'PJG'),
(93157, 'DASUKI', 'DASUKI', '1111', 1, 3, 'PJG'),
(93159, 'YULI', 'WARSITO', '1111', 1, 3, 'PJG'),
(93164, 'HERMAWAN', 'HERMAWAN', '1111', 1, 3, 'PJG'),
(93229, 'SARYONO', 'SARYONO', '1111', 1, 3, 'PJG'),
(93230, 'SAMID', 'SAMID', '1111', 1, 3, 'PJG'),
(93232, 'ARIPIN', 'ARIPIN', '1111', 1, 3, 'PJG'),
(93233, 'MARYAMIN', 'MARYAMIN', '1111', 1, 3, 'PJG'),
(93237, 'GUNTORO', 'GUNTORO', '1111', 1, 3, 'PJG'),
(93240, 'TARMIDI', 'TARMIDI', '1111', 1, 3, 'PJG'),
(93241, 'AHMAD', 'SULAIMAN', '1111', 1, 3, 'PJG'),
(93252, 'SUSILO', 'CAHYADI', '1111', 1, 3, 'PJG'),
(93258, 'BIMA NUR', 'ROHMAN', '1111', 1, 3, 'PJG'),
(93314, 'KM. SULAIMAN', 'SULAIMAN', '1111', 1, 3, 'PJG'),
(93317, 'YUSUF', 'YUSUF', '1111', 1, 3, 'PJG'),
(93318, 'M. LATIF', 'LATIF', '1111', 1, 3, 'PJG'),
(93320, 'M. HUSNI', 'THAMRIN', '1111', 1, 3, 'PJG'),
(93349, 'SLAMET', 'ARTOMORO', '1111', 1, 3, 'PJG'),
(93402, 'ABDUL', 'JAWAD', '1111', 1, 3, 'PJG'),
(93404, 'SAFRUDIN', 'SAFRUDIN', '1111', 1, 3, 'PJG'),
(93416, 'ZAENAL', 'ARIFIN', '1111', 1, 3, 'PJG'),
(93418, 'BAMBANG', 'SUDIMAN', '1111', 1, 3, 'PJG'),
(93426, 'DWI', 'PRIYONO', '1111', 1, 3, 'PJG'),
(93432, 'RISWAL', 'RAIYAL', '1111', 1, 3, 'PJG'),
(93434, 'DODI', 'RIANSYAH', '1111', 1, 3, 'PJG'),
(93445, 'NURJAMIL', 'NURJAMIL', '1111', 1, 3, 'PJG'),
(93446, 'ZAKARIA', 'ZAKARIA', '1111', 1, 3, 'PJG'),
(93449, 'RIYANTO', 'NAINGGOLAN', '1111', 1, 3, 'PJG'),
(93451, 'JAMALUDIN', 'JAMALUDIN', '1111', 1, 3, 'PJG'),
(93453, 'BAGUS TRI', 'WINARKO', '1111', 1, 3, 'PJG'),
(93457, 'UCE', 'SUPRIYADI', '1111', 1, 3, 'PJG'),
(112233, 'Tes', 'Pager', '112233', 1, 3, 'PJG'),
(26925337, 'admin', 'admin', 'admin', 1, 3, 'PJG'),
(26925338, 'ainul', 'mutaqin', 'ainul', 1, 3, 'PJG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `lane`
--
ALTER TABLE `lane`
  ADD PRIMARY KEY (`laneid`),
  ADD KEY `terminalId` (`terminal`);

--
-- Indexes for table `log_transaction`
--
ALTER TABLE `log_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`terminalId`);

--
-- Indexes for table `trx_api_terminal`
--
ALTER TABLE `trx_api_terminal`
  ADD PRIMARY KEY (`trxid_api_terminal`),
  ADD KEY `idApi` (`idApi`);

--
-- Indexes for table `trx_truck_terminal`
--
ALTER TABLE `trx_truck_terminal`
  ADD PRIMARY KEY (`truck_id`),
  ADD KEY `terminal_id` (`terminal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `trx_user_terminal`
--
ALTER TABLE `trx_user_terminal`
  ADD KEY `userid` (`userid`),
  ADD KEY `terminalid` (`terminalId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `idTerminal` (`idTerminal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lane`
--
ALTER TABLE `lane`
  MODIFY `laneid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `log_transaction`
--
ALTER TABLE `log_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `terminal`
--
ALTER TABLE `terminal`
  MODIFY `terminalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trx_api_terminal`
--
ALTER TABLE `trx_api_terminal`
  MODIFY `trxid_api_terminal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `trx_truck_terminal`
--
ALTER TABLE `trx_truck_terminal`
  MODIFY `truck_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26925339;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `trx_api_terminal`
--
ALTER TABLE `trx_api_terminal`
  ADD CONSTRAINT `trx_api_terminal_ibfk_2` FOREIGN KEY (`idApi`) REFERENCES `api` (`api_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `trx_user_terminal`
--
ALTER TABLE `trx_user_terminal`
  ADD CONSTRAINT `trx_user_terminal_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
