DROP TABLE IF EXISTS `jos_xtremelocator_config`;
CREATE TABLE `jos_xtremelocator_config` (
  `id` int(5) NOT NULL auto_increment,
  `site_id` int(10) NOT NULL default '0',
  `result_type_list` int(1) NOT NULL default '1',
  `show_slogan` int(1) NOT NULL default '1',
  `show_advanced_link` int(1) NOT NULL default '1',
  `show_new_registration_link` int(1) NOT NULL default '0',
  `show_all_location_link` int(1) NOT NULL default '0',
  `locations_per_page` int(5) NOT NULL default '0',
  `type` int(1) NOT NULL default '4',
  `search_type` int(1) NOT NULL default '1',
  `form_code` text,
  `describtion` text,
  `map_width_list` int(4) default NULL,
  `map_height_list` int(4) default NULL,
  `map_width_details` int(4) NOT NULL default '0',
  `map_height_details` int(4) NOT NULL default '0',
  `result_type_details` int(1) NOT NULL default '1',
  `map_layout_details` int(1) NOT NULL default '0',
  `map_layout_list` int(1) NOT NULL default '0',
  `location_columns` int(2) NOT NULL default '1',
  `zoom_level` int(3) NOT NULL default '10',
  `center_coordinates` varchar(50) NOT NULL default '',
  `text_width_list` int(4) NOT NULL default '0',
	`text_height_list` int(4) NOT NULL default '0',
	`text_width_details` int(4) NOT NULL default '0',
	`text_height_details` int(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `jos_xtremelocator_config`
-- 

INSERT INTO `jos_xtremelocator_config` VALUES (1, 0, 1, 0, 1, 1, 1, 10, 1, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 1, 10, '', 0, 0, 0, 0);
INSERT INTO `jos_xtremelocator_config` VALUES (2, 0, 1, 1, 1, 1, 0, 4, 2, 1, NULL, 'Enter your zip code to fine a dealer near you.', 600, 600, 600, 600, 3, 0, 0, 1, 10, '', 500, 0, 500, 0);
INSERT INTO `jos_xtremelocator_config` VALUES (6, 0, 1, 1, 0, 1, 0, 4, 3, 3, '<form id="searchForm" action="index.php?option=com_xtremelocator&view=advanced" method="post" name="searchForm">\r\n<input type="hidden" name="option" value="com_xtremelocator" />\r\n<input type="hidden" name="view" value="advanced" />\r\n	<table cellpadding="4" cellspacing="0" border="0">\r\n		<tr>\r\n		<td align="center">\r\n			<table border="0" cellpadding="0" cellspacing="0" width="100%">\r\n				<tr>\r\n					<td valign="top">\r\n						<table cellpadding="0" border="0" width="600px">							\r\n							<tr>\r\n								<td colspan="2"><hr size="1" width="99%"></td>\r\n							</tr>\r\n							<tr>\r\n								<td colspan="2" align="center">\r\n									<table border="0" cellpadding="0" cellspacing="0" width="100%">\r\n																				<tr>\r\n											<td width="29%">ZIP</td>\r\n											<td align="left"><input type="text" name="zip" size="6"></td>\r\n										</tr>\r\n																			</table>\r\n								</td>\r\n							</tr>\r\n							<tr>\r\n								<td nowrap colspan="2"><hr size="1" width="99%"></td>\r\n							</tr>\r\n														<tr>\r\n								<td width="225" nowrap>Name</td>\r\n								<td width="369"><input type=text name="name" size=0></td>\r\n							</tr>\r\n														<tr>\r\n								<td nowrap>City</td>\r\n								<td><input type=text name="city" size=0></td>\r\n							</tr>\r\n														<tr>\r\n								<td nowrap>State</td>\r\n								<td><input type=text name="state" size=0></td>\r\n							</tr>\r\n														<tr>\r\n								<td nowrap>Country</td>\r\n								<td><select name=country >\r\n								 <option value="0">US</option>\r\n								 <option value="1">Canada</option>\r\n</select></td>\r\n							</tr>\r\n														<tr>\r\n								<td nowrap>Telephone Area Code</td>\r\n								<td><input type=text name="telephone area code" size=3></td>\r\n							</tr>\r\n														<tr>\r\n								<td nowrap colspan="2"><hr size="1" width="99%"></td>\r\n							</tr>\r\n							<tr>\r\n								<td valign="top">Special events </td>\r\n								<td valign="top"><input type="Checkbox" name="events"></td>\r\n							</tr>\r\n														<tr>\r\n								<td colspan=2> </td>\r\n							</tr>\r\n							<tr>\r\n								<td valign="top" align="center" colspan="2">\r\n									<input type="submit" value="SEARCH"> \r\n									<input type="reset" value="CLEAR">\r\n								</td>\r\n							</tr>\r\n						</table>\r\n					</td>\r\n				</tr>\r\n			</table>\r\n		</td>\r\n		<tr>\r\n			<td> </td>\r\n		</tr>\r\n	</table>\r\n</FORM>					', 'You can find locations by filling this form.', 600, 600, 600, 600, 1, 0, 0, 1, 10, '', 500, 0, 500, 0);
INSERT INTO `jos_xtremelocator_config` VALUES (7, 0, 1, 0, 1, 0, 0, 5, 4, 1, NULL, 'This is a listing of all of our locations.', 600, 600, 600, 600, 1, 0, 0, 1, 10, '', 500, 0, 500, 0);
INSERT INTO `jos_xtremelocator_config` VALUES (8, 0, 2, 0, 1, 0, 0, 0, 5, 1, NULL, 'Click on an icon near you for location information.  Zoom in using the bar and drag the map for a closer view of your area.', 600, 500, 700, 400, 0, 0, 0, 1, 3, '40.044438,-98.701172', 0, 0, 0, 0);
INSERT INTO `jos_xtremelocator_config` VALUES (9, 0, 1, 0, 1, 0, 0, 0, 4, 1, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 1, 10, '', 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_xtremelocator_css`
-- 
DROP TABLE IF EXISTS `jos_xtremelocator_css`;

CREATE TABLE `jos_xtremelocator_css` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `class` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `jos_xtremelocator_css`
-- 

INSERT INTO `jos_xtremelocator_css` VALUES (1, 'xl_search_form', 'xl_search_form');
INSERT INTO `jos_xtremelocator_css` VALUES (2, 'xl_form_message', 'xl_form_message');
INSERT INTO `jos_xtremelocator_css` VALUES (3, 'searchForm', 'searchForm');
INSERT INTO `jos_xtremelocator_css` VALUES (5, 'xl_wraper', 'xl_wraper');
INSERT INTO `jos_xtremelocator_css` VALUES (6, 'xl_advanced_search_link', 'xl_advanced_search_link');
INSERT INTO `jos_xtremelocator_css` VALUES (7, 'xl_all_locations_link', 'xl_all_locations_link');
INSERT INTO `jos_xtremelocator_css` VALUES (8, 'xl_search_results', 'xl_search_results');
INSERT INTO `jos_xtremelocator_css` VALUES (9, 'xl_search_locations', 'xl_search_locations');
INSERT INTO `jos_xtremelocator_css` VALUES (10, 'xl_result', 'xl_result');
INSERT INTO `jos_xtremelocator_css` VALUES (11, 'xl_result_item_map', 'xl_result_item_map');
INSERT INTO `jos_xtremelocator_css` VALUES (12, 'xl_result_location', 'xl_result_location');
INSERT INTO `jos_xtremelocator_css` VALUES (13, 'xl_result_item', 'xl_result_item');
INSERT INTO `jos_xtremelocator_css` VALUES (14, 'xl_search_footer', 'xl_search_footer');
INSERT INTO `jos_xtremelocator_css` VALUES (15, 'xl_results_title', 'xl_results_title');
INSERT INTO `jos_xtremelocator_css` VALUES (16, 'xl_results_value', 'xl_results_value');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_xtremelocator_fields`
-- 
DROP TABLE IF EXISTS `jos_xtremelocator_fields`;

CREATE TABLE `jos_xtremelocator_fields` (
  `id` int(5) NOT NULL auto_increment,
  `field_name` varchar(40) NOT NULL default '',
  `field_id2` varchar(10) NOT NULL default '0',
  `enabled` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- 
-- Dumping data for table `jos_xtremelocator_fields`
-- 

INSERT INTO `jos_xtremelocator_fields` VALUES (6, 'Additional Info', '1', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (8, 'Address', '3', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (9, 'City', '4', 0);
INSERT INTO `jos_xtremelocator_fields` VALUES (10, 'Contact Name', '5', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (11, 'Contact Position', '6', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (12, 'Country', '7', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (13, 'Distance', '8', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (14, 'E-mail', '9', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (15, 'Fax', '10', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (17, 'Highlight', '12', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (18, 'Location Audio', '13', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (19, 'Location Image', '14', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (20, 'Location Radius', '15', 0);
INSERT INTO `jos_xtremelocator_fields` VALUES (21, 'Name', '16', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (22, 'Number', '17', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (23, 'Phone', '18', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (24, 'Specialties', '19', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (25, 'Sponsor', '20', 0);
INSERT INTO `jos_xtremelocator_fields` VALUES (26, 'State', '21', 0);
INSERT INTO `jos_xtremelocator_fields` VALUES (27, 'Status', '22', 0);
INSERT INTO `jos_xtremelocator_fields` VALUES (28, 'Street', '23', 0);
INSERT INTO `jos_xtremelocator_fields` VALUES (30, 'Telephone Area Code', '25', 0);
INSERT INTO `jos_xtremelocator_fields` VALUES (31, 'Territory', '26', 0);
INSERT INTO `jos_xtremelocator_fields` VALUES (32, 'Toll Free', '27', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (33, 'Url', '28', 1);
INSERT INTO `jos_xtremelocator_fields` VALUES (34, 'Zip', '29', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_xtremelocator_layouts`
-- 
DROP TABLE IF EXISTS `jos_xtremelocator_layouts`;
CREATE TABLE `jos_xtremelocator_layouts` (
  `field_id` int(5) NOT NULL default '0',
  `layout_id` int(5) NOT NULL default '0',
  `type` int(1) NOT NULL default '0',
  `visible` int(1) NOT NULL default '1',
  `show_title` int(1) NOT NULL default '1',
  `order` int(5) NOT NULL default '0',
  `lincable` int(1) NOT NULL default '0',
  KEY `field_id` (`field_id`),
  KEY `layout_id` (`layout_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_xtremelocator_layouts`
-- 

INSERT INTO `jos_xtremelocator_layouts` VALUES (0, 0, 0, 1, 1, 0, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (6, 4, 1, 0, 0, 6, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (6, 4, 2, 1, 0, 11, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (8, 4, 1, 1, 0, 2, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (8, 4, 2, 1, 0, 2, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (9, 4, 1, 0, 0, 9, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (9, 4, 2, 0, 0, 9, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (10, 4, 1, 0, 0, 10, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (10, 4, 2, 1, 1, 9, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (11, 4, 1, 0, 0, 11, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (11, 4, 2, 1, 1, 10, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (12, 4, 1, 1, 0, 3, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (12, 4, 2, 1, 0, 3, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (13, 4, 1, 0, 0, 13, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (13, 4, 2, 0, 0, 13, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (14, 4, 1, 0, 0, 14, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (14, 4, 2, 1, 1, 7, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (15, 4, 1, 0, 0, 15, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (15, 4, 2, 1, 1, 6, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (17, 4, 1, 0, 0, 17, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (17, 4, 2, 0, 0, 17, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (18, 4, 1, 0, 0, 18, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (18, 4, 2, 0, 0, 18, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (19, 4, 1, 0, 0, 19, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (19, 4, 2, 0, 0, 19, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (20, 4, 1, 0, 0, 20, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (20, 4, 2, 0, 0, 20, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (21, 4, 1, 1, 0, 1, 1);
INSERT INTO `jos_xtremelocator_layouts` VALUES (21, 4, 2, 1, 0, 1, 1);
INSERT INTO `jos_xtremelocator_layouts` VALUES (22, 4, 1, 0, 0, 22, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (22, 4, 2, 0, 0, 22, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (23, 4, 1, 1, 0, 4, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (23, 4, 2, 1, 1, 4, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (24, 4, 1, 0, 0, 24, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (24, 4, 2, 1, 1, 24, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (25, 4, 1, 0, 0, 25, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (25, 4, 2, 0, 0, 25, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (26, 4, 1, 0, 0, 26, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (26, 4, 2, 0, 0, 26, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (27, 4, 1, 0, 0, 27, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (27, 4, 2, 0, 0, 27, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (28, 4, 1, 0, 0, 28, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (28, 4, 2, 0, 0, 28, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (30, 4, 1, 0, 0, 30, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (30, 4, 2, 0, 0, 30, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (31, 4, 1, 0, 0, 31, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (31, 4, 2, 0, 0, 31, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (32, 4, 1, 0, 0, 32, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (32, 4, 2, 1, 1, 5, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (33, 4, 1, 0, 0, 33, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (33, 4, 2, 1, 1, 8, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (34, 4, 1, 0, 0, 34, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (34, 4, 2, 0, 0, 34, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (6, 2, 1, 0, 0, 6, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (6, 2, 2, 1, 1, 9, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (8, 2, 1, 1, 0, 2, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (8, 2, 2, 1, 0, 2, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (9, 2, 1, 0, 0, 9, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (9, 2, 2, 0, 0, 9, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (10, 2, 1, 0, 0, 10, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (10, 2, 2, 1, 1, 10, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (11, 2, 1, 0, 0, 11, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (11, 2, 2, 1, 1, 11, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (12, 2, 1, 1, 0, 3, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (12, 2, 2, 1, 0, 3, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (13, 2, 1, 1, 1, 5, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (13, 2, 2, 1, 1, 13, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (14, 2, 1, 0, 0, 14, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (14, 2, 2, 1, 1, 7, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (15, 2, 1, 0, 0, 15, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (15, 2, 2, 1, 1, 6, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (17, 2, 1, 0, 0, 17, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (17, 2, 2, 1, 0, 17, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (18, 2, 1, 0, 0, 18, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (18, 2, 2, 0, 0, 18, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (19, 2, 1, 0, 0, 19, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (19, 2, 2, 1, 0, 19, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (20, 2, 1, 0, 0, 20, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (20, 2, 2, 0, 0, 20, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (21, 2, 1, 1, 0, 1, 1);
INSERT INTO `jos_xtremelocator_layouts` VALUES (21, 2, 2, 1, 0, 1, 1);
INSERT INTO `jos_xtremelocator_layouts` VALUES (22, 2, 1, 0, 0, 22, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (22, 2, 2, 0, 0, 22, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (23, 2, 1, 1, 1, 4, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (23, 2, 2, 1, 1, 4, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (24, 2, 1, 0, 0, 24, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (24, 2, 2, 1, 0, 24, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (25, 2, 1, 0, 0, 25, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (25, 2, 2, 0, 0, 25, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (26, 2, 1, 0, 0, 26, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (26, 2, 2, 0, 0, 26, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (27, 2, 1, 0, 0, 27, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (27, 2, 2, 0, 0, 27, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (28, 2, 1, 0, 0, 28, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (28, 2, 2, 0, 0, 28, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (30, 2, 1, 0, 0, 30, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (30, 2, 2, 0, 0, 30, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (31, 2, 1, 0, 0, 31, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (31, 2, 2, 0, 0, 31, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (32, 2, 1, 0, 0, 32, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (32, 2, 2, 1, 1, 5, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (33, 2, 1, 0, 0, 33, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (33, 2, 2, 1, 1, 8, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (34, 2, 1, 0, 0, 34, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (34, 2, 2, 0, 0, 34, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (6, 3, 1, 0, 0, 7, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (6, 3, 2, 1, 0, 10, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (8, 3, 1, 1, 1, 2, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (8, 3, 2, 1, 1, 2, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (9, 3, 1, 0, 0, 9, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (9, 3, 2, 0, 0, 9, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (10, 3, 1, 0, 0, 10, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (10, 3, 2, 0, 0, 11, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (11, 3, 1, 0, 0, 11, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (11, 3, 2, 0, 0, 12, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (12, 3, 1, 1, 1, 3, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (12, 3, 2, 1, 1, 3, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (13, 3, 1, 1, 1, 5, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (13, 3, 2, 1, 1, 9, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (14, 3, 1, 0, 0, 14, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (14, 3, 2, 1, 1, 7, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (15, 3, 1, 0, 0, 15, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (15, 3, 2, 1, 1, 6, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (17, 3, 1, 1, 0, 6, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (17, 3, 2, 0, 0, 17, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (18, 3, 1, 0, 0, 18, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (18, 3, 2, 0, 0, 18, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (19, 3, 1, 0, 0, 19, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (19, 3, 2, 0, 0, 19, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (20, 3, 1, 0, 0, 20, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (20, 3, 2, 0, 0, 20, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (21, 3, 1, 1, 1, 1, 1);
INSERT INTO `jos_xtremelocator_layouts` VALUES (21, 3, 2, 1, 1, 1, 1);
INSERT INTO `jos_xtremelocator_layouts` VALUES (22, 3, 1, 0, 0, 22, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (22, 3, 2, 0, 0, 22, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (23, 3, 1, 1, 1, 4, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (23, 3, 2, 1, 1, 4, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (24, 3, 1, 0, 0, 24, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (24, 3, 2, 0, 0, 24, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (25, 3, 1, 0, 0, 25, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (25, 3, 2, 0, 0, 25, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (26, 3, 1, 0, 0, 26, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (26, 3, 2, 0, 0, 26, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (27, 3, 1, 0, 0, 27, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (27, 3, 2, 0, 0, 27, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (28, 3, 1, 0, 0, 28, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (28, 3, 2, 0, 0, 28, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (30, 3, 1, 0, 0, 30, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (30, 3, 2, 0, 0, 30, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (31, 3, 1, 0, 0, 31, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (31, 3, 2, 0, 0, 31, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (32, 3, 1, 0, 0, 8, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (32, 3, 2, 1, 1, 5, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (33, 3, 1, 0, 0, 33, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (33, 3, 2, 1, 1, 8, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (34, 3, 1, 0, 0, 34, 0);
INSERT INTO `jos_xtremelocator_layouts` VALUES (34, 3, 2, 0, 0, 34, 0);