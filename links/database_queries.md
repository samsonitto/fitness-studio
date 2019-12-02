# LUONTISKRIPTI

```sql
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema fitness
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema fitness
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `fitness` DEFAULT CHARACTER SET utf8 ;
USE `fitness` ;

-- -----------------------------------------------------
-- Table `fitness`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fitness`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(128) NOT NULL,
  `password` VARCHAR(500) NOT NULL,
  `group` VARCHAR(128) NULL,
  `image` VARCHAR(128) NULL,
  `email_verified_at` DATETIME NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fitness`.`class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fitness`.`class` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `course_name` VARCHAR(255) NOT NULL,
  `course_length` DECIMAL(10) NOT NULL,
  `course_description` VARCHAR(1000) NULL,
  `start_at` DATETIME NOT NULL,
  `difficulty` INT NOT NULL,
  `capacity` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fitness`.`booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fitness`.`booking` (
  `booking_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `course_id` INT NOT NULL,
  `booking_time` DATETIME NOT NULL,
  INDEX `fk_user_has_course_course1_idx` (`course_id` ASC),
  INDEX `fk_user_has_course_user_idx` (`user_id` ASC),
  PRIMARY KEY (`booking_id`),
  CONSTRAINT `fk_user_has_course_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `fitness`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_course_course1`
    FOREIGN KEY (`course_id`)
    REFERENCES `fitness`.`class` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

```

# TESTIDATA
## USER
```sql
INSERT INTO user (`name`,`email`,`password`,`group`,`created_at`)
VALUES ('Samson Azizyan','samsonitto@gmail.com','samson13','master',NOW());

INSERT INTO users (`name`,`email`,`password`,`group`,`created_at`,`updated_at`)
VALUES ('Jaber Askari','jaber@gmail.com','jaber1234','admin',NOW(),NOW()),
('Niina Mattola','niina.mattola@gmail.com','niina','admin',NOW(),NOW()),
('Jussi Juntunen','jussi.juntunen@gmail.com','jussi123','admin',NOW(),NOW()),
('Joel Aalto','joel@gmail.com','joel1234',null,NOW(),NOW()),
('Ken Guru','kg@gmail.com','ken12345',null,NOW(),NOW()),
('Lorppa Huuli','lorppa@gmail.com','lorppa12',null,NOW(),NOW());
```

## CLASS
```sql
INSERT INTO class (`class_name`,`difficulty`,`capacity`,`created_at`,`updated_at`)
VALUES ('Yin Yoga',3,15,NOW(),NOW()),
('Brazilian Jiu-Jitsu',5,20,NOW(),NOW()),
('Pole Dancing 1',2,15,NOW(),NOW()),
('Boxing Basics',1,10,NOW(),NOW()),
('Spinning',1,10,NOW(),NOW()),
('Hot Yoga',1,15,NOW(),NOW()),
('Aerial Yoga',1,10,NOW(),NOW());
```

## CLASS IS AVAILABLE
```sql
INSERT INTO class_is_available (`teacher_id`,`class_id`,`start_time`,`end_time`,`created_at`,`updated_at`)
VALUES (1,2,'2019-11-25 08:00:00','2019-11-25 09:30:00',NOW(),NOW()),
(3,1,'2019-11-25 09:30:00','2019-11-25 10:30:00',NOW(),NOW()),
(2,3,'2019-11-25 10:30:00','2019-11-25 12:00:00',NOW(),NOW()),
(1,4,'2019-11-26 09:00:00','2019-11-26 10:00:00',NOW(),NOW()),
(2,7,'2019-11-27 12:00:00','2019-11-27 13:00:00',NOW(),NOW()),
(3,6,'2019-11-29 18:00:00','2019-11-29 19:30:00',NOW(),NOW()),
(2,7,'2019-11-30 12:00:00','2019-11-30 13:00:00',NOW(),NOW()),
(2,7,'2019-12-01 12:00:00','2019-12-01 13:00:00',NOW(),NOW()),
(2,7,'2019-12-02 12:00:00','2019-12-02 13:00:00',NOW(),NOW()),
(2,7,'2019-12-03 12:00:00','2019-12-03 13:00:00',NOW(),NOW()),
(2,7,'2019-12-04 12:00:00','2019-12-04 13:00:00',NOW(),NOW())
```


## BOOKING
```sql
INSERT INTO booking (`user_id`,`course_id`,`booking_time`)
VALUES (4,2,NOW()),
(4,1,NOW()),
(5,3,NOW()),
(6,1,NOW()),
(6,5,NOW()),
(4,6,NOW()),
(3,7,NOW());
```

## MY_BOOKING VIEW

```sql
CREATE VIEW my_booking AS
SELECT class_is_available.id, booking.user_id as user_id, class.class_name as class, booking.id as booking_id, class.capacity as capacity, class.class_description as description, users.name as teacher, class_is_available.start_time as start, class_is_available.end_time as end
FROM class_is_available
INNER JOIN class
  ON class.id = class_is_available.class_id
INNER JOIN users
	ON class_is_available.teacher_id = users.id
INNER JOIN booking
	ON class_is_available.id = booking.class_is_available_id;
```

## CALENDAR VIEW

```sql
CREATE VIEW calendar AS
SELECT class_is_available.id, class.class_name as class, class.capacity as capacity, class.class_description as description, users.name as teacher, class_is_available.start_time as start, class_is_available.end_time as end
FROM class_is_available
INNER JOIN class
  ON class.id = class_is_available.class_id
INNER JOIN users
	ON class_is_available.teacher_id = users.id;
```

## UPDATE CLASS DESCRIPTIONS

UPDATE class SET `class_description` = 'Brazilian jiu-jitsu is a martial art and combat sport system that focuses on
 grappling with particular emphasis on ground fighting. Brazilian jiu-jitsu was developed from Kodokan judo 
 ground fighting (newaza) fundamentals that were taught by a number of Japanese individuals including Takeo Yano, 
 Mitsuyo Maeda, Soshihiro Satake, and Isao Okano. Brazilian jiu-jitsu eventually came to be its own defined combat sport 
 through the innovations, practices, and adaptation of judo.' WHERE `id` = 2;