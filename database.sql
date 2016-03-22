--
-- Strucure of table `edit_users_types`
--

CREATE TABLE IF NOT EXISTS `edit_users_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `ico` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=1 ;

INSERT INTO `edit_users_types` (`id`, `project_id`, `name`, `position`, `ico`) VALUES
(1, 1, 'Creators', 0, 'fa fa-keyboard-o'),
(2, 1, 'Admins', 1, 'fa fa-bug'),
(3, 1, 'Moderators', 2, 'fa fa-edit'),
(4, 1, 'Advertisers', 3, 'fa fa-bullhorn'),
(5, 1, 'Publishers', 5, 'fa fa-video-camera'),
(6, 1, 'Reviewers', 4, 'fa fa-thumbs-o-up');