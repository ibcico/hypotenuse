<?php

	Class extension_hypotenuse extends Extension {
	
		public function about() {
			return array(
				'name' => 'Hypotenuse',
				'version' => '0.0.1',
				'release-date' => '2011-04-27',
				'author' => array(
				 	'name' => 'name',
					'website' => 'http://www.website.com',
					'email' => 'e@mail.com'
				)
			);
		}
		
		public function fetchNavigation() {
			return array(
				array(
					'location'	=> __('Blueprints'),
					'name'	=> __('Hypotenuse'),
					'link'	=> '/list/'
				)
			);
		}
	}