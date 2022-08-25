SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DELIMITER $$

DROP PROCEDURE IF EXISTS `sp_delete`$$
CREATE  PROCEDURE `sp_delete` (`rid` INT(5))  BEGIN
delete from users where id=rid;
END$$

DROP PROCEDURE IF EXISTS `sp_insert`$$
CREATE  PROCEDURE `sp_insert` (`name` varchar(255), `gender` varchar(255),`mobile` varchar(255),`temp` varchar(255), `diag` varchar(255),`encounter` varchar(255), `vax` varchar(255),`nationality` varchar(255))  BEGIN
insert into users(Name,Gender,Mobile,Temp,Diag,Encounter,Vax,Nationality) value(name,gender,mobile,temp,diag,encounter,vax,nationality);
END$$

DROP PROCEDURE IF EXISTS `sp_read`$$
CREATE  PROCEDURE `sp_read` ()  BEGIN
select * from users;
END$$

DROP PROCEDURE IF EXISTS `sp_readarow`$$
CREATE  PROCEDURE `sp_readarow` (IN `rid` INT(5))  BEGIN
select * from users where id=rid;
END$$

DROP PROCEDURE IF EXISTS `sp_update`$$
CREATE  PROCEDURE `sp_update` (`name` varchar(255), `gender` varchar(255),`mobile` varchar(255),`temp` varchar(255), `diag` varchar(255),`encounter` varchar(255), `vax` varchar(255),`nationality` varchar(255),`rid` int(5))  BEGIN
update users set Name=name,Gender=gender,Mobile=mobile,Temp=temp,Diag=diag,Encounter=encounter,Vax=vax,Nationality=nationality where id=rid;
END$$

DELIMITER ;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Mobile` varchar(255) NOT NULL,
  `Temp` varchar(255) NOT NULL,
  `Diag` varchar(255) NOT NULL,
  `Encounter` varchar(255) NOT NULL,
  `Vax` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;