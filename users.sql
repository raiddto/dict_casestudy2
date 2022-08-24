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
CREATE  PROCEDURE `sp_insert` (`fname` VARCHAR(120), `lname` VARCHAR(120), `age` int(11), `school` VARCHAR(255))  BEGIN
insert into users(FirstName,LastName,Age,School) value(fname,lname,age,school);
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
CREATE  PROCEDURE `sp_update` (`fname` VARCHAR(120), `lname` VARCHAR(120), `age` int(11), `school` VARCHAR(255), `rid` INT(5))  BEGIN
update users set FirstName=fname,LastName=lname,Age=age,School=school where id=rid;
END$$

DELIMITER ;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `Age` int(11) NOT NULL,
  `School` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
