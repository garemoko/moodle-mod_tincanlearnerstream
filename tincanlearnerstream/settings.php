<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * tincanlearnerstream block caps.
 *
 * @package    block_tincanlearnerstream
 * @copyright  2013 Andrew Downes
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_heading('sampleheader',
                                         get_string('tincanlearnerstreamlrsfieldset', 'block_tincanlearnerstream'),
                                         get_string('tincanlearnerstreamlrsfieldsetdesc', 'block_tincanlearnerstream')));
										 
										 
$settings->add(new admin_setting_configtext('tincanlearnerstream/endpoint', new lang_string('tincanlearnerstreamlrsendpoint', 'block_tincanlearnerstream'),
        new lang_string('tincanlearnerstreamlrsendpoint_help', 'block_tincanlearnerstream'), "", PARAM_TEXT));
		
$settings->add(new admin_setting_configtext('tincanlearnerstream/login', new lang_string('tincanlearnerstreamlrslogin', 'block_tincanlearnerstream'),
        new lang_string('tincanlearnerstreamlrslogin_help', 'block_tincanlearnerstream'), "", PARAM_TEXT));
		
$settings->add(new admin_setting_configtext('tincanlearnerstream/pass', new lang_string('tincanlearnerstreamlrspass', 'block_tincanlearnerstream'),
        new lang_string('tincanlearnerstreamlrspass_help', 'block_tincanlearnerstream'), "", PARAM_TEXT));		
		
$settings->add(new admin_setting_configtext('tincanlearnerstream/version', new lang_string('tincanlearnerstreamlrsversion', 'block_tincanlearnerstream'),
        new lang_string('tincanlearnerstreamlrsversion_help', 'block_tincanlearnerstream'), "1.0.0", PARAM_TEXT));
