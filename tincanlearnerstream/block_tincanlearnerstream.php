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

class block_tincanlearnerstream extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_tincanlearnerstream');
    }

    function get_content() {
        global $CFG, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }
		
        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';
		$this->content->text = '';

        // user/index.php expect course context, so get one if page has module context.
        $currentcontext = $this->page->context->get_course_context(false);

        if (! empty($this->config->text)) {
            $this->content->text = $this->config->text;
        }

        if (empty($currentcontext)) {
            return $this->content;
        }
        if ($this->page->course->id == SITEID) {
            $this->context->text .= "site context";
        }

        if (! empty($this->config->text)) {
            $this->content->text .= $this->config->text;
        }
		
		//get data from the LRS
		$statementsArray = $this->getRecentStatementsByNumber(10);
		//display it nicely
		$this->content->text = json_encode($statementsArray);

        return $this->content;
    }

    // my moodle can only have SITEID and it's redundant here, so take it away
    public function applicable_formats() {
        return array('all' => false,
                     'site' => true,
                     'site-index' => true,
                     'course-view' => true, 
                     'course-view-social' => false,
                     'mod' => true, 
                     'mod-quiz' => false);
    }

    public function instance_allow_multiple() {
          return true;
    }

    function has_config() {return true;}

    public function cron() {
            mtrace( "Hey, my cron script is running" );
             
                 // do something
                  
                      return true;
    }
	
	//TODO: move the functions below to a local lib file. 
	private function getRecentStatementsByNumber($numberOfStatementsToGet){
		$config = get_config('tincanlearnerstream');		
		$HTTPResults = $this->get_statemenets($config->endpoint, $config->login, $config->pass, $config->version, $this->getactor(), $numberOfStatementsToGet, 'canonical');
		$statements =  $HTTPResults['contents'];
		return $statements;
	}
	
	//TODO: this function is shared by the Tin Can launch plugin and needs to be moved to a shared library
	private function getactor()
	{
		global $USER, $CFG;
		if ($USER->email){
			return array(
				"name" => fullname($USER),
				"mbox" => "mailto:".$USER->email,
				"objectType" => "Agent"
			);
		}
		else{
			return array(
				"name" => fullname($USER),
				"account" => array(
					"homePage" => $CFG->wwwroot,
					"name" => $USER->id
				),
				"objectType" => "Agent"
			);
		}
	}
	
	//TODO: Put this function in a PHP Tin Can library. 
	//TODO: Handle failure nicely. E.g. retry getting. 
	//TODO: add more parameters
	private function get_statemenets($url, $basicLogin, $basicPass, $version, $agent, $numberOfStatementsToGet, $format) {
	
		$streamopt = array(
			'ssl' => array(
				'verify-peer' => false, 
				), 
			'http' => array(
				'method' => 'GET', 
				'ignore_errors' => false, 
				'header' => array(
					'Authorization: Basic ' . base64_encode( $basicLogin . ':' . $basicPass), 
					'Content-Type: application/json', 
					'Accept: application/json, */*; q=0.01',
					'X-Experience-API-Version: '.$version
				)
			), 
		);
	
		$streamparams = array(
			'format' => $format,
			'agent' => json_encode($agent),
			'limit' => $numberOfStatementsToGet
		);
		
		$context = stream_context_create($streamopt);
		
		$stream = fopen($url . 'statements'.'?'.http_build_query($streamparams,'','&'), 'rb', false, $context);
		
		//Handle possible error codes
		$return_code = @explode(' ', $http_response_header[0]);
	    $return_code = (int)$return_code[1];
	     
	    switch($return_code){
	        case 200:
	            $ret = stream_get_contents($stream);
				$meta = stream_get_meta_data($stream);
			
				if ($ret) {
					$ret = json_decode($ret, TRUE);
				}
	            break;
	        default: //error
	            $ret = NULL;
				$meta = $return_code;
	            break;
	    }
		
		return array(
			'contents'=> $ret, 
			'metadata'=> $meta
		);
	}
}
