<?php

    require_once(TOOLKIT . '/class.datasource.php');

    Class datasource<!-- CLASS NAME --> extends Datasource{

        function about(){
            return array(
                'name' => '<!-- NAME -->',
                'author' => array(
                    'name' => '<!-- AUTHOR NAME -->',
                    'website' => '<!-- AUTHOR WEBSITE -->',
                    'email' => '<!-- AUTHOR EMAIL -->'),
                'version' => '1.0',
                'release-date' => '<!-- RELEASE DATE -->'
                );
        }
        
        public function allowEditorToParse(){
    		return false;
		}

        function grab(&$param_pool){
            $result = new XMLElement('<!-- NODE NAME -->');

            $nodes = $this->_Parent->Database->fetch("");

            foreach($nodes as $node){
                //$_node = new XMLElement('entry', $node['value']);
                //$_node->setAttributeArray(array('attribute_name' => $node['value']));
                //$result->appendChild($_node);
            }
            
            return $result;
        }
    }