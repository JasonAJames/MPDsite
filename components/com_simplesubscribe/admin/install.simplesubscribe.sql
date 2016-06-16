CREATE TABLE #__simplesub_options (
  `id` int(10) unsigned NOT NULL auto_increment,
  `field_name` varchar(50) NOT NULL,
  `field_value` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `NewIndex` (`field_name`)
) Type=MyISAM; 


