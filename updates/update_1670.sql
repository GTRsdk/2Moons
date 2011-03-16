ALTER TABLE `prefix_users` ADD `geworben` VARCHAR( 32 ) NOT NULL ,
ADD `belohnung` INT( 11 ) NOT NULL ,
ADD `premium_aktiv` INT( 15 ) NOT NULL ;

ALTER TABLE `prefix_config` ADD `premium` ENUM( '0', '1' ) NOT NULL ,
ADD `belohnung` INT( 11 ) NOT NULL DEFAULT '1000',
ADD `mehr_ress` INT( 3 ) NOT NULL DEFAULT '60',
ADD `bauzeit_fleet` INT( 3 ) NOT NULL DEFAULT '90',
ADD `bauzeit_build` INT( 3 ) NOT NULL DEFAULT '40',
ADD `bauzeit_defense` INT( 3 ) NOT NULL DEFAULT '90';

ALTER TABLE `prefix_users_valid` ADD `geworben` VARCHAR( 32 ) NOT NULL;