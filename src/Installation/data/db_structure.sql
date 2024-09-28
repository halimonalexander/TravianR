CREATE TABLE IF NOT EXISTS `a2b` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `ckey` varchar(255) NULL,
 `time_check` int(11) NULL DEFAULT '0',
 `to_vid` int(11) NULL,
 `u1` int(11) NULL,
 `u2` int(11) NULL,
 `u3` int(11) NULL,
 `u4` int(11) NULL,
 `u5` int(11) NULL,
 `u6` int(11) NULL,
 `u7` int(11) NULL,
 `u8` int(11) NULL,
 `u9` int(11) NULL,
 `u10` int(11) NULL,
 `u11` int(11) NULL,
 `type` smallint(1) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `a2b`
--

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
 `id` INT(25) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `userid` INT(25) NULL ,
 `name` VARCHAR(50) NULL ,
 `url` VARCHAR(150) NULL ,
 `pos` INT(10) NULL
) ENGINE = InnoDB;

--
-- Dumping data for table `links`
--

-- --------------------------------------------------------

--
-- Table structure for table `abdata`
--

CREATE TABLE IF NOT EXISTS `abdata` (
 `vref` int(11) NOT NULL,
 `a1` tinyint(2) NULL DEFAULT '0',
 `a2` tinyint(2) NULL DEFAULT '0',
 `a3` tinyint(2) NULL DEFAULT '0',
 `a4` tinyint(2) NULL DEFAULT '0',
 `a5` tinyint(2) NULL DEFAULT '0',
 `a6` tinyint(2) NULL DEFAULT '0',
 `a7` tinyint(2) NULL DEFAULT '0',
 `a8` tinyint(2) NULL DEFAULT '0',
 `b1` tinyint(2) NULL DEFAULT '0',
 `b2` tinyint(2) NULL DEFAULT '0',
 `b3` tinyint(2) NULL DEFAULT '0',
 `b4` tinyint(2) NULL DEFAULT '0',
 `b5` tinyint(2) NULL DEFAULT '0',
 `b6` tinyint(2) NULL DEFAULT '0',
 `b7` tinyint(2) NULL DEFAULT '0',
 `b8` tinyint(2) NULL DEFAULT '0',
 PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `abdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `activate`
--

CREATE TABLE IF NOT EXISTS `activate` (
 `id` int(255) NOT NULL AUTO_INCREMENT,
 `username` varchar(100) NULL,
 `password` varchar(100) NULL,
 `email` text NULL,
 `tribe` tinyint(1) NULL,
 `access` tinyint(1) NULL DEFAULT '1',
 `act` varchar(10) NULL,
 `timestamp` int(11) NULL DEFAULT '0',
 `location` text NULL,
 `act2` varchar(10) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `activate`
--


-- --------------------------------------------------------

--
-- Table structure for table `active`
--

CREATE TABLE IF NOT EXISTS `active` (
 `username` varchar(100) NOT NULL,
 `timestamp` int(11) NULL,
 PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `active`
--


-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE IF NOT EXISTS `admin_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user` text NULL,
 `log` text NULL,
 `time` int(25) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `admin_log`
--


-- --------------------------------------------------------
--
-- Table structure for table `allimedal`
--

CREATE TABLE IF NOT EXISTS `allimedal` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `allyid` int(11) NULL,
 `categorie` int(11) NULL,
 `plaats` int(11) NULL,
 `week` int(11) NULL,
 `points` bigint(255) NULL,
 `img` varchar(255) NULL,
 `del` tinyint(1) NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `artefacts`
--

CREATE TABLE IF NOT EXISTS `artefacts` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `owner` int(11) NULL,
 `type` tinyint(2) NULL,
 `size` tinyint(1) NULL,
 `conquered` int(11) NULL,
 `name` varchar(100) NULL,
 `desc` text NULL,
 `effect` varchar(100) NULL,
 `img` varchar(20) NULL,
 `active` tinyint(1) NULL,
 `kind` tinyint(1) NULL DEFAULT '0',
 `bad_effect` tinyint(1) NULL DEFAULT '0',
 `effect2` tinyint(2) NULL DEFAULT '0',
 `lastupdate` int(11) NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `artefacts`
--
-- --------------------------------------------------------

--
-- Table structure for table `alidata`
--

CREATE TABLE IF NOT EXISTS `alidata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) NULL,
 `tag` varchar(100) NULL,
 `leader` int(11) NULL,
 `coor` int(11) NULL,
 `advisor` int(11) NULL,
 `recruiter` int(11) NULL,
 `notice` text NULL,
 `desc` text NULL,
 `max` tinyint(2) NULL,
 `ap` bigint(255) NULL DEFAULT '0',
 `dp` bigint(255) NULL DEFAULT '0',
 `Rc` bigint(255) NULL DEFAULT '0',
 `RR` bigint(255) NULL DEFAULT '0',
 `Aap` bigint(255) NULL DEFAULT '0',
 `Adp` bigint(255) NULL DEFAULT '0',
 `clp` bigint(255) NULL DEFAULT '0',
 `oldrank` bigint(255) NULL DEFAULT '0',
 `forumlink` varchar(150) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `alidata`
--


-- --------------------------------------------------------

--
-- Table structure for table `ali_invite`
--

CREATE TABLE IF NOT EXISTS `ali_invite` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `alliance` int(11) NULL,
 `sender` int(11) NULL,
 `timestamp` int(11) NULL,
 `accept` int(1) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ali_invite`
--


-- --------------------------------------------------------

--
-- Table structure for table `ali_log`
--

CREATE TABLE IF NOT EXISTS `ali_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `aid` int(11) NULL,
 `comment` text NULL,
 `date` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ali_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `ali_permission`
--

CREATE TABLE IF NOT EXISTS `ali_permission` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `alliance` int(11) NULL,
 `rank` varchar(100) NULL,
 `opt1` int(1) NULL DEFAULT '0',
 `opt2` int(1) NULL DEFAULT '0',
 `opt3` int(1) NULL DEFAULT '0',
 `opt4` int(1) NULL DEFAULT '0',
 `opt5` int(1) NULL DEFAULT '0',
 `opt6` int(1) NULL DEFAULT '0',
 `opt7` int(1) NULL DEFAULT '0',
 `opt8` int(1) NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ali_permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `attacks`
--

CREATE TABLE IF NOT EXISTS `attacks` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `t1` int(11) NULL,
 `t2` int(11) NULL,
 `t3` int(11) NULL,
 `t4` int(11) NULL,
 `t5` int(11) NULL,
 `t6` int(11) NULL,
 `t7` int(11) NULL,
 `t8` int(11) NULL,
 `t9` int(11) NULL,
 `t10` int(11) NULL,
 `t11` int(11) NULL,
 `attack_type` tinyint(1) NULL,
 `ctar1` int(11) NULL,
 `ctar2` int(11) NULL,
 `spy` int(11) NULL,
 `b1` tinyint(1) NULL,
 `b2` tinyint(1) NULL,
 `b3` tinyint(1) NULL,
 `b4` tinyint(1) NULL,
 `b5` tinyint(1) NULL,
 `b6` tinyint(1) NULL,
 `b7` tinyint(1) NULL,
 `b8` tinyint(1) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `attacks`
--


-- --------------------------------------------------------

--
-- Table structure for table `banlist`
--

CREATE TABLE IF NOT EXISTS `banlist` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `name` varchar(100) NULL,
 `reason` varchar(30) NULL,
 `time` int(11) NULL,
 `end` varchar(10) NULL,
 `admin` int(11) NULL,
 `active` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `banlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `bdata`
--

CREATE TABLE IF NOT EXISTS `bdata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `field` tinyint(2) NULL,
 `type` tinyint(2) NULL,
 `loopcon` tinyint(1) NULL,
 `timestamp` int(11) NULL,
 `master` tinyint(1) NULL,
 `level` tinyint(3) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `build_log`
--

CREATE TABLE IF NOT EXISTS `build_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `log` text NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `build_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
 `id` int(20) NOT NULL AUTO_INCREMENT,
 `id_user` int(11) NULL,
 `name` varchar(255) NULL,
 `alli` varchar(255) NULL,
 `date` varchar(255) NULL,
 `msg` varchar(255) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `chat`
--


-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
 `lastgavemedal` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
INSERT INTO `config` VALUES (0);

--
-- Dumping data for table `config`
--


-- --------------------------------------------------------

--
-- Table structure for table `deleting`
--

CREATE TABLE IF NOT EXISTS `deleting` (
 `uid` int(11) NOT NULL,
 `timestamp` int(11) NULL,
 PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deleting`
--


-- --------------------------------------------------------

--
-- Table structure for table `demolition`
--

CREATE TABLE IF NOT EXISTS `demolition` (
 `vref` int(11) NOT NULL,
 `buildnumber` int(11) NULL DEFAULT '0',
 `lvl` int(11) NULL DEFAULT '0',
 `timetofinish` int(11) NULL,
 PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `demolition`
--


-- --------------------------------------------------------

--
-- Table structure for table `diplomacy`
--

CREATE TABLE IF NOT EXISTS `diplomacy` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `alli1` int(11) NULL,
 `alli2` int(11) NULL,
 `type` tinyint(1) NULL,
 `accepted` tinyint(1) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--
-- Dumping data for table `diplomacy`
--


-- --------------------------------------------------------

--
-- Table structure for table `enforcement`
--

CREATE TABLE IF NOT EXISTS `enforcement` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `u1` int(11) NULL DEFAULT '0',
 `u2` int(11) NULL DEFAULT '0',
 `u3` int(11) NULL DEFAULT '0',
 `u4` int(11) NULL DEFAULT '0',
 `u5` int(11) NULL DEFAULT '0',
 `u6` int(11) NULL DEFAULT '0',
 `u7` int(11) NULL DEFAULT '0',
 `u8` int(11) NULL DEFAULT '0',
 `u9` int(11) NULL DEFAULT '0',
 `u10` int(11) NULL DEFAULT '0',
 `u11` int(11) NULL DEFAULT '0',
 `u12` int(11) NULL DEFAULT '0',
 `u13` int(11) NULL DEFAULT '0',
 `u14` int(11) NULL DEFAULT '0',
 `u15` int(11) NULL DEFAULT '0',
 `u16` int(11) NULL DEFAULT '0',
 `u17` int(11) NULL DEFAULT '0',
 `u18` int(11) NULL DEFAULT '0',
 `u19` int(11) NULL DEFAULT '0',
 `u20` int(11) NULL DEFAULT '0',
 `u21` int(11) NULL DEFAULT '0',
 `u22` int(11) NULL DEFAULT '0',
 `u23` int(11) NULL DEFAULT '0',
 `u24` int(11) NULL DEFAULT '0',
 `u25` int(11) NULL DEFAULT '0',
 `u26` int(11) NULL DEFAULT '0',
 `u27` int(11) NULL DEFAULT '0',
 `u28` int(11) NULL DEFAULT '0',
 `u29` int(11) NULL DEFAULT '0',
 `u30` int(11) NULL DEFAULT '0',
 `u31` int(11) NULL DEFAULT '0',
 `u32` int(11) NULL DEFAULT '0',
 `u33` int(11) NULL DEFAULT '0',
 `u34` int(11) NULL DEFAULT '0',
 `u35` int(11) NULL DEFAULT '0',
 `u36` int(11) NULL DEFAULT '0',
 `u37` int(11) NULL DEFAULT '0',
 `u38` int(11) NULL DEFAULT '0',
 `u39` int(11) NULL DEFAULT '0',
 `u40` int(11) NULL DEFAULT '0',
 `u41` int(11) NULL DEFAULT '0',
 `u42` int(11) NULL DEFAULT '0',
 `u43` int(11) NULL DEFAULT '0',
 `u44` int(11) NULL DEFAULT '0',
 `u45` int(11) NULL DEFAULT '0',
 `u46` int(11) NULL DEFAULT '0',
 `u47` int(11) NULL DEFAULT '0',
 `u48` int(11) NULL DEFAULT '0',
 `u49` int(11) NULL DEFAULT '0',
 `u50` int(11) NULL DEFAULT '0',
 `hero` tinyint(1) NULL DEFAULT '0',
 `from` int(11) NULL DEFAULT '0',
 `vref` int(11) NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `enforcement`
--

-- --------------------------------------------------------

--
-- Table structure for table `farmlist`
--

CREATE TABLE IF NOT EXISTS `farmlist` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wref` int(11) NULL,
 `owner` int(11) NULL,
 `name` varchar(100) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `farmlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `fdata`
--

CREATE TABLE IF NOT EXISTS `fdata` (
 `vref` int(11) NOT NULL,
 `f1` tinyint(2) NULL DEFAULT '0',
 `f1t` tinyint(2) NULL DEFAULT '0',
 `f2` tinyint(2) NULL DEFAULT '0',
 `f2t` tinyint(2) NULL DEFAULT '0',
 `f3` tinyint(2) NULL DEFAULT '0',
 `f3t` tinyint(2) NULL DEFAULT '0',
 `f4` tinyint(2) NULL DEFAULT '0',
 `f4t` tinyint(2) NULL DEFAULT '0',
 `f5` tinyint(2) NULL DEFAULT '0',
 `f5t` tinyint(2) NULL DEFAULT '0',
 `f6` tinyint(2) NULL DEFAULT '0',
 `f6t` tinyint(2) NULL DEFAULT '0',
 `f7` tinyint(2) NULL DEFAULT '0',
 `f7t` tinyint(2) NULL DEFAULT '0',
 `f8` tinyint(2) NULL DEFAULT '0',
 `f8t` tinyint(2) NULL DEFAULT '0',
 `f9` tinyint(2) NULL DEFAULT '0',
 `f9t` tinyint(2) NULL DEFAULT '0',
 `f10` tinyint(2) NULL DEFAULT '0',
 `f10t` tinyint(2) NULL DEFAULT '0',
 `f11` tinyint(2) NULL DEFAULT '0',
 `f11t` tinyint(2) NULL DEFAULT '0',
 `f12` tinyint(2) NULL DEFAULT '0',
 `f12t` tinyint(2) NULL DEFAULT '0',
 `f13` tinyint(2) NULL DEFAULT '0',
 `f13t` tinyint(2) NULL DEFAULT '0',
 `f14` tinyint(2) NULL DEFAULT '0',
 `f14t` tinyint(2) NULL DEFAULT '0',
 `f15` tinyint(2) NULL DEFAULT '0',
 `f15t` tinyint(2) NULL DEFAULT '0',
 `f16` tinyint(2) NULL DEFAULT '0',
 `f16t` tinyint(2) NULL DEFAULT '0',
 `f17` tinyint(2) NULL DEFAULT '0',
 `f17t` tinyint(2) NULL DEFAULT '0',
 `f18` tinyint(2) NULL DEFAULT '0',
 `f18t` tinyint(2) NULL DEFAULT '0',
 `f19` tinyint(2) NULL DEFAULT '0',
 `f19t` tinyint(2) NULL DEFAULT '0',
 `f20` tinyint(2) NULL DEFAULT '0',
 `f20t` tinyint(2) NULL DEFAULT '0',
 `f21` tinyint(2) NULL DEFAULT '0',
 `f21t` tinyint(2) NULL DEFAULT '0',
 `f22` tinyint(2) NULL DEFAULT '0',
 `f22t` tinyint(2) NULL DEFAULT '0',
 `f23` tinyint(2) NULL DEFAULT '0',
 `f23t` tinyint(2) NULL DEFAULT '0',
 `f24` tinyint(2) NULL DEFAULT '0',
 `f24t` tinyint(2) NULL DEFAULT '0',
 `f25` tinyint(2) NULL DEFAULT '0',
 `f25t` tinyint(2) NULL DEFAULT '0',
 `f26` tinyint(2) NULL DEFAULT '0',
 `f26t` tinyint(2) NULL DEFAULT '0',
 `f27` tinyint(2) NULL DEFAULT '0',
 `f27t` tinyint(2) NULL DEFAULT '0',
 `f28` tinyint(2) NULL DEFAULT '0',
 `f28t` tinyint(2) NULL DEFAULT '0',
 `f29` tinyint(2) NULL DEFAULT '0',
 `f29t` tinyint(2) NULL DEFAULT '0',
 `f30` tinyint(2) NULL DEFAULT '0',
 `f30t` tinyint(2) NULL DEFAULT '0',
 `f31` tinyint(2) NULL DEFAULT '0',
 `f31t` tinyint(2) NULL DEFAULT '0',
 `f32` tinyint(2) NULL DEFAULT '0',
 `f32t` tinyint(2) NULL DEFAULT '0',
 `f33` tinyint(2) NULL DEFAULT '0',
 `f33t` tinyint(2) NULL DEFAULT '0',
 `f34` tinyint(2) NULL DEFAULT '0',
 `f34t` tinyint(2) NULL DEFAULT '0',
 `f35` tinyint(2) NULL DEFAULT '0',
 `f35t` tinyint(2) NULL DEFAULT '0',
 `f36` tinyint(2) NULL DEFAULT '0',
 `f36t` tinyint(2) NULL DEFAULT '0',
 `f37` tinyint(2) NULL DEFAULT '0',
 `f37t` tinyint(2) NULL DEFAULT '0',
 `f38` tinyint(2) NULL DEFAULT '0',
 `f38t` tinyint(2) NULL DEFAULT '0',
 `f39` tinyint(2) NULL DEFAULT '0',
 `f39t` tinyint(2) NULL DEFAULT '0',
 `f40` tinyint(2) NULL DEFAULT '0',
 `f40t` tinyint(2) NULL DEFAULT '0',
 `f99` tinyint(2) NULL DEFAULT '0',
 `f99t` tinyint(2) NULL DEFAULT '0',
 `wwname` varchar(100) NULL DEFAULT 'World Wonder',
 PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_cat`
--

CREATE TABLE IF NOT EXISTS `forum_cat` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `owner` varchar(255) NULL,
 `alliance` varchar(255) NULL,
 `forum_name` varchar(255) NULL,
 `forum_des` text NULL,
 `forum_area` varchar(255) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_cat`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_edit`
--

CREATE TABLE IF NOT EXISTS `forum_edit` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `alliance` varchar(255) NULL,
 `result` varchar(255) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_edit`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_post`
--

CREATE TABLE IF NOT EXISTS `forum_post` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `post` longtext NULL,
 `topic` varchar(255) NULL,
 `owner` varchar(255) NULL,
 `date` varchar(255) NULL,
 `alliance0` int(11) NULL,
 `player0` int(11) NULL,
 `coor0` int(11) NULL,
 `report0` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_post`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_survey`
--

CREATE TABLE IF NOT EXISTS `forum_survey` (
 `topic` int(11) NULL,
 `title` varchar(255) NULL,
 `option1` varchar(255) NULL,
 `option2` varchar(255) NULL,
 `option3` varchar(255) NULL,
 `option4` varchar(255) NULL,
 `option5` varchar(255) NULL,
 `option6` varchar(255) NULL,
 `option7` varchar(255) NULL,
 `option8` varchar(255) NULL,
 `vote1` int(11) NULL DEFAULT '0',
 `vote2` int(11) NULL DEFAULT '0',
 `vote3` int(11) NULL DEFAULT '0',
 `vote4` int(11) NULL DEFAULT '0',
 `vote5` int(11) NULL DEFAULT '0',
 `vote6` int(11) NULL DEFAULT '0',
 `vote7` int(11) NULL DEFAULT '0',
 `vote8` int(11) NULL DEFAULT '0',
 `voted` text NULL,
 `ends` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_survey`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_topic`
--

CREATE TABLE IF NOT EXISTS `forum_topic` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `title` varchar(255) NULL,
 `post` longtext NULL,
 `date` varchar(255) NULL,
 `post_date` varchar(255) NULL,
 `cat` varchar(255) NULL,
 `owner` varchar(255) NULL,
 `alliance` varchar(255) NULL,
 `ends` varchar(255) NULL,
 `close` varchar(255) NULL,
 `stick` varchar(255) NULL,
 `alliance0` int(11) NULL,
 `player0` int(11) NULL,
 `coor0` int(11) NULL,
 `report0` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_topic`
--


-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE IF NOT EXISTS `general` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `casualties` int(11) NULL,
 `time` int(11) NULL,
 `shown` tinyint(1) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `general`
--


-- --------------------------------------------------------

--
-- Table structure for table `gold_fin_log`
--

CREATE TABLE IF NOT EXISTS `gold_fin_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `log` text NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gold_fin_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `hero`
--

CREATE TABLE IF NOT EXISTS `hero` (
 `heroid` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `unit` smallint(2) NULL,
 `name` tinytext NULL,
 `wref` int(11) NULL,
 `level` tinyint(3) NULL,
 `points` int(3) NULL,
 `experience` int(11) NULL,
 `dead` tinyint(1) NULL,
 `health` float(12,9) NULL,
 `attack` tinyint(3) NULL,
 `defence` tinyint(3) NULL,
 `attackbonus` tinyint(3) NULL,
 `defencebonus` tinyint(3) NULL,
 `regeneration` tinyint(3) NULL,
 `autoregen` int(2) NULL,
 `lastupdate` int(11) NULL,
 `trainingtime` int(11) NULL,
 `inrevive` tinyint(1) NULL,
 `intraining` tinyint(1) NULL,
 PRIMARY KEY (`heroid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `hero`
--



-- --------------------------------------------------------

--
-- Table structure for table `illegal_log`
--

CREATE TABLE IF NOT EXISTS `illegal_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user` int(11) NULL,
 `log` text NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `illegal_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE IF NOT EXISTS `login_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `ip` varchar(15) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE IF NOT EXISTS `market` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `gtype` tinyint(1) NULL,
 `gamt` int(11) NULL,
 `wtype` tinyint(1) NULL,
 `wamt` int(11) NULL,
 `accept` tinyint(1) NULL,
 `maxtime` int(11) NULL,
 `alliance` int(11) NULL,
 `merchant` tinyint(2) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `market`
--


-- --------------------------------------------------------

--
-- Table structure for table `market_log`
--

CREATE TABLE IF NOT EXISTS `market_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `log` text NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `market_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `mdata`
--

CREATE TABLE IF NOT EXISTS `mdata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `target` int(11) NULL,
 `owner` int(11) NULL,
 `topic` varchar(100) NULL,
 `message` text NULL,
 `viewed` tinyint(1) NULL,
 `archived` tinyint(1) NULL,
 `send` tinyint(1) NULL,
 `time` int(11) NULL DEFAULT '0',
 `deltarget` int(11) NULL,
 `delowner` int(11) NULL,
 `alliance` int(11) NULL,
 `player` int(11) NULL,
 `coor` int(11) NULL,
 `report` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `medal`
--

CREATE TABLE IF NOT EXISTS `medal` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `userid` int(11) NULL,
 `categorie` int(11) NULL,
 `plaats` int(11) NULL,
 `week` int(11) NULL,
 `points` varchar(15) NULL,
 `img` varchar(10) NULL,
 `del` tinyint(1) NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `medal`
--


-- --------------------------------------------------------

--
-- Table structure for table `movement`
--

CREATE TABLE IF NOT EXISTS `movement` (
 `moveid` int(11) NOT NULL AUTO_INCREMENT,
 `sort_type` tinyint(4) NULL DEFAULT '0',
 `from` int(11) NULL DEFAULT '0',
 `to` int(11) NULL DEFAULT '0',
 `ref` int(11) NULL DEFAULT '0',
 `ref2` int(11) NULL DEFAULT '0',
 `starttime` int(11) NULL DEFAULT '0',
 `endtime` int(11) NULL DEFAULT '0',
 `proc` tinyint(1) NULL DEFAULT '0',
 `send` tinyint(1) NULL,
 `wood` int(11) NULL,
 `clay` int(11) NULL,
 `iron` int(11) NULL,
 `crop` int(11) NULL,
 PRIMARY KEY (`moveid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `movement`
--


-- --------------------------------------------------------

--
-- Table structure for table `ndata`
--

CREATE TABLE IF NOT EXISTS `ndata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `toWref` int(11) NULL,
 `ally` int(11) NULL,
 `topic` text NULL,
 `ntype` tinyint(1) NULL,
 `data` text NULL,
 `time` int(11) NULL,
 `viewed` tinyint(1) NULL,
 `archive` tinyint(1) NULL DEFAULT '0',
 `del` tinyint(1) NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ndata`
--


-- --------------------------------------------------------

--
-- Table structure for table `odata`
--

CREATE TABLE IF NOT EXISTS `odata` (
 `wref` int(11) NOT NULL,
 `type` tinyint(2) NULL,
 `conqured` int(11) NULL,
 `wood` int(11) NULL,
 `iron` int(11) NULL,
 `clay` int(11) NULL,
 `maxstore` int(11) NULL,
 `crop` int(11) NULL,
 `maxcrop` int(11) NULL,
 `lastupdated` int(11) NULL,
 `lastupdated2` int(11) NULL,
 `loyalty` float(9,6) NULL DEFAULT '100',
 `owner` int(11) NULL DEFAULT '2',
 `name` varchar(32) NULL DEFAULT 'Unoccupied Oasis',
 `high` tinyint(1) NULL,
 PRIMARY KEY (`wref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `odata`
--


-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE IF NOT EXISTS `online` (
 `name` varchar(32) NULL,
 `uid` int(11) NULL,
 `time` varchar(32) NULL,
 `sit` tinyint(1) NULL,
 UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online`
--

-- --------------------------------------------------------

--
-- Table structure for table `prisoners`
--

CREATE TABLE IF NOT EXISTS `prisoners` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wref` int(11) NULL,
 `from` int(11) NULL,
 `t1` int(11) NULL,
 `t2` int(11) NULL,
 `t3` int(11) NULL,
 `t4` int(11) NULL,
 `t5` int(11) NULL,
 `t6` int(11) NULL,
 `t7` int(11) NULL,
 `t8` int(11) NULL,
 `t9` int(11) NULL,
 `t10` int(11) NULL,
 `t11` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `prisoners`
--


-- --------------------------------------------------------

--
-- Table structure for table `raidlist`
--

CREATE TABLE IF NOT EXISTS `raidlist` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `lid` int(11) NULL,
 `towref` int(11) NULL,
 `x` int(11) NULL,
 `y` int(11) NULL,
 `distance` varchar(5) NULL DEFAULT '0',
 `t1` int(11) NULL,
 `t2` int(11) NULL,
 `t3` int(11) NULL,
 `t4` int(11) NULL,
 `t5` int(11) NULL,
 `t6` int(11) NULL,
 `t7` int(11) NULL,
 `t8` int(11) NULL,
 `t9` int(11) NULL,
 `t10` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `raidlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE IF NOT EXISTS `research` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `tech` varchar(3) NULL,
 `timestamp` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `research`
--


-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE IF NOT EXISTS `route` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NULL,
 `wid` int(11) NULL,
 `from` int(11) NULL,
 `wood` int(5) NULL,
 `clay` int(5) NULL,
 `iron` int(5) NULL,
 `crop` int(5) NULL,
 `start` tinyint(2) NULL,
 `deliveries` tinyint(1) NULL,
 `merchant` int(11) NULL,
 `timestamp` int(11) NULL,
 `timeleft` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `route`
--


-- --------------------------------------------------------

--
-- Table structure for table `send`
--

CREATE TABLE IF NOT EXISTS `send` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wood` int(11) NULL,
 `clay` int(11) NULL,
 `iron` int(11) NULL,
 `crop` int(11) NULL,
 `merchant` tinyint(2) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `send`
--


-- --------------------------------------------------------

--
-- Table structure for table `tdata`
--

CREATE TABLE IF NOT EXISTS `tdata` (
 `vref` int(11) NOT NULL,
 `t2` tinyint(1) NULL DEFAULT '0',
 `t3` tinyint(1) NULL DEFAULT '0',
 `t4` tinyint(1) NULL DEFAULT '0',
 `t5` tinyint(1) NULL DEFAULT '0',
 `t6` tinyint(1) NULL DEFAULT '0',
 `t7` tinyint(1) NULL DEFAULT '0',
 `t8` tinyint(1) NULL DEFAULT '0',
 `t9` tinyint(1) NULL DEFAULT '0',
 `t12` tinyint(1) NULL DEFAULT '0',
 `t13` tinyint(1) NULL DEFAULT '0',
 `t14` tinyint(1) NULL DEFAULT '0',
 `t15` tinyint(1) NULL DEFAULT '0',
 `t16` tinyint(1) NULL DEFAULT '0',
 `t17` tinyint(1) NULL DEFAULT '0',
 `t18` tinyint(1) NULL DEFAULT '0',
 `t19` tinyint(1) NULL DEFAULT '0',
 `t22` tinyint(1) NULL DEFAULT '0',
 `t23` tinyint(1) NULL DEFAULT '0',
 `t24` tinyint(1) NULL DEFAULT '0',
 `t25` tinyint(1) NULL DEFAULT '0',
 `t26` tinyint(1) NULL DEFAULT '0',
 `t27` tinyint(1) NULL DEFAULT '0',
 `t28` tinyint(1) NULL DEFAULT '0',
 `t29` tinyint(1) NULL DEFAULT '0',
 `t32` tinyint(1) NULL DEFAULT '0',
 `t33` tinyint(1) NULL DEFAULT '0',
 `t34` tinyint(1) NULL DEFAULT '0',
 `t35` tinyint(1) NULL DEFAULT '0',
 `t36` tinyint(1) NULL DEFAULT '0',
 `t37` tinyint(1) NULL DEFAULT '0',
 `t38` tinyint(1) NULL DEFAULT '0',
 `t39` tinyint(1) NULL DEFAULT '0',
 `t42` tinyint(1) NULL DEFAULT '0',
 `t43` tinyint(1) NULL DEFAULT '0',
 `t44` tinyint(1) NULL DEFAULT '0',
 `t45` tinyint(1) NULL DEFAULT '0',
 `t46` tinyint(1) NULL DEFAULT '0',
 `t47` tinyint(1) NULL DEFAULT '0',
 `t48` tinyint(1) NULL DEFAULT '0',
 `t49` tinyint(1) NULL DEFAULT '0',
 PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `tech_log`
--

CREATE TABLE IF NOT EXISTS `tech_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `wid` int(11) NULL,
 `log` text NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tech_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE IF NOT EXISTS `training` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `vref` int(11) NULL,
 `unit` tinyint(2) NULL,
 `amt` int(11) NULL,
 `pop` int(11) NULL,
 `timestamp` int(11) NULL,
 `eachtime` int(11) NULL,
 `timestamp2` int(11) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `training`
--


-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
 `vref` int(11) NOT NULL,
 `u1` int(11) NULL DEFAULT '0',
 `u2` int(11) NULL DEFAULT '0',
 `u3` int(11) NULL DEFAULT '0',
 `u4` int(11) NULL DEFAULT '0',
 `u5` int(11) NULL DEFAULT '0',
 `u6` int(11) NULL DEFAULT '0',
 `u7` int(11) NULL DEFAULT '0',
 `u8` int(11) NULL DEFAULT '0',
 `u9` int(11) NULL DEFAULT '0',
 `u10` int(11) NULL DEFAULT '0',
 `u11` int(11) NULL DEFAULT '0',
 `u12` int(11) NULL DEFAULT '0',
 `u13` int(11) NULL DEFAULT '0',
 `u14` int(11) NULL DEFAULT '0',
 `u15` int(11) NULL DEFAULT '0',
 `u16` int(11) NULL DEFAULT '0',
 `u17` int(11) NULL DEFAULT '0',
 `u18` int(11) NULL DEFAULT '0',
 `u19` int(11) NULL DEFAULT '0',
 `u20` int(11) NULL DEFAULT '0',
 `u21` int(11) NULL DEFAULT '0',
 `u22` int(11) NULL DEFAULT '0',
 `u23` int(11) NULL DEFAULT '0',
 `u24` int(11) NULL DEFAULT '0',
 `u25` int(11) NULL DEFAULT '0',
 `u26` int(11) NULL DEFAULT '0',
 `u27` int(11) NULL DEFAULT '0',
 `u28` int(11) NULL DEFAULT '0',
 `u29` int(11) NULL DEFAULT '0',
 `u30` int(11) NULL DEFAULT '0',
 `u31` int(11) NULL DEFAULT '0',
 `u32` int(11) NULL DEFAULT '0',
 `u33` int(11) NULL DEFAULT '0',
 `u34` int(11) NULL DEFAULT '0',
 `u35` int(11) NULL DEFAULT '0',
 `u36` int(11) NULL DEFAULT '0',
 `u37` int(11) NULL DEFAULT '0',
 `u38` int(11) NULL DEFAULT '0',
 `u39` int(11) NULL DEFAULT '0',
 `u40` int(11) NULL DEFAULT '0',
 `u41` int(11) NULL DEFAULT '0',
 `u42` int(11) NULL DEFAULT '0',
 `u43` int(11) NULL DEFAULT '0',
 `u44` int(11) NULL DEFAULT '0',
 `u45` int(11) NULL DEFAULT '0',
 `u46` int(11) NULL DEFAULT '0',
 `u47` int(11) NULL DEFAULT '0',
 `u48` int(11) NULL DEFAULT '0',
 `u49` int(11) NULL DEFAULT '0',
 `u50` int(11) NULL DEFAULT '0',
 `u99` int(11) NULL DEFAULT '0',
 `u99o` int(11) NULL DEFAULT '0',
 `hero` int(11) NULL DEFAULT '0',
 PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vdata`
--

CREATE TABLE IF NOT EXISTS `vdata` (
`wref` int(11) NOT NULL,
`owner` int(11) NULL,
`name` varchar(100) NULL,
`capital` tinyint(1) NULL,
`pop` int(11) NULL,
`cp` int(11) NULL,
`celebration` int(11) NULL DEFAULT '0',
`type` int(11) NULL DEFAULT '0',
`wood` float(12,2) NULL,
`clay` float(12,2) NULL,
`iron` float(12,2) NULL,
`maxstore` int(11) NULL,
`crop` float(12,2) NULL,
`maxcrop` int(11) NULL,
`lastupdate` int(11) NULL,
`lastupdate2` int(11) NULL DEFAULT '0',
`loyalty` float(9,6) NULL DEFAULT '100',
`exp1` int(11) NULL DEFAULT '0',
`exp2` int(11) NULL DEFAULT '0',
`exp3` int(11) NULL DEFAULT '0',
`created` int(11) NULL,
`natar` tinyint(1) NULL DEFAULT '0',
`starv` int(11) NULL DEFAULT '0',
`starvupdate` int(11) NULL DEFAULT '0',
`evasion` tinyint(1) NULL DEFAULT '0',
PRIMARY KEY (`wref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `vdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `wdata`
--

CREATE TABLE IF NOT EXISTS `wdata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `fieldtype` tinyint(2) NULL,
 `oasistype` tinyint(2) NULL,
 `x` int(11) NULL,
 `y` int(11) NULL,
 `occupied` tinyint(1) NULL,
 `image` varchar(3) NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wdata`
--

-- --------------------------------------------------------
--
-- Table structure for table `password`
--

CREATE TABLE IF NOT EXISTS `password` (
 `uid` int(11) NOT NULL,
 `npw` varchar(100) NULL,
 `cpw` varchar(100) NULL,
 `used` tinyint(1) NULL DEFAULT '0',
 `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `password`
--

-- --------------------------------------------------------
--
-- Table structure for table `ww_attacks`
--

CREATE TABLE IF NOT EXISTS `ww_attacks` (
 `vid` int(25) NULL,
 `attack_time` int(25) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `password`
--

-- --------------------------------------------------------
