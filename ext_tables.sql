#
# Table structure for table 'tx_searchbar_domain_model_items'
#
CREATE TABLE tx_searchbar_domain_model_items (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	hotkey varchar(255) DEFAULT '' NOT NULL,
	glue varchar(255) DEFAULT '' NOT NULL,
	searchurl varchar(255) DEFAULT '' NOT NULL,
	typoscript text,
	itemtype int(11) DEFAULT '0' NOT NULL,
	additionalfunctions text NOT NULL,
	hideinfe tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);
