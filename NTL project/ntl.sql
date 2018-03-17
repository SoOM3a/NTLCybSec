

CREATE TABLE `coursera` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` text COLLATE utf8_unicode_ci NOT NULL,
  `L_name` text COLLATE utf8_unicode_ci NOT NULL,
  `F_name` text COLLATE utf8_unicode_ci NOT NULL,
  `Password` text COLLATE utf8_unicode_ci NOT NULL,
  `session` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sender` text COLLATE utf8_unicode_ci NOT NULL,
  `reciever` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


