<?php

	require_once(CONTENT . '/content.blueprintsdatasources.php');
	require_once(TOOLKIT . '/class.eventmanager.php');	
	
	class contentExtensionHypotenuseList extends AdministrationPage {
		protected $_driver;
		
		public function __viewIndex() {
			$this->_driver = $this->_Parent->ExtensionManager->create('hypotenuse');
						
			$this->setPageType('form');
			$this->setTitle('Symphony &ndash; ' . __('Hypotenuse'));
			
			$this->appendSubheading(__('Hypotenuse'));
						
			$container = new XMLElement('fieldset');
			$container->setAttribute('class', 'settings');
			$container->appendChild(
				new XMLElement('legend', __('Sections'))
			);
			
			$group = new XMLElement('div');
			$group->setAttribute('class', 'group');
			
			$input = new XMLElement('input');
			$input->setAttribute('type', 'text');
			$input->setAttribute('name', 'field[title]');
			
			$section = Widget::Label(__('Название:'));
			$section->appendChild($input);
			
			$group->appendChild($section);
				
			$container->appendChild($group);
			
			/*$group = new XMLElement('div');
			$group->setAttribute('class', 'group');
						
			$sm = new SectionManager($this->_Parent);
			$sections = $sm->fetch();
			$options = array();
			
			$dsm = new DatasourceManager($this->_Parent);
			$datasources = $dsm->listAll();
						
			foreach ($sections as $section) {
				//print($section->get('name').'<br/>');
				$selected = in_array('hypotenuse_' . str_replace('-', '_', $section->get('handle')), array_keys($datasources));
				
				$options[] = array(
					$section->get('handle'), $selected, $section->get('name')
				);
			}
			
			$section = Widget::Label(__('Create data sources for these sections:'));
			$section->appendChild(Widget::Select(
				'sections[]', $options
			));
			
			$group->appendChild($section);
			
			$container->appendChild($group);*/
			
			
			
			
			
			
			
			
			
			
			
			
			
			$this->Form->appendChild($container);
			
			
		//---------------------------------------------------------------------
			
			$div = new XMLElement('div');
			$div->setAttribute('class', 'actions');
			
			$attr = array('accesskey' => 's');
			$div->appendChild(Widget::Input('action[save]', __('Save Changes'), 'submit', $attr));

			$this->Form->appendChild($div);
		}	
		
		public function __actionIndex() {
			if (@isset($_POST['action']['save'])){
				$post = $_POST;
				
				$title = $post['field']['title'];
				$title_handle = Lang::createHandle($post['field']['title']);
				
				$shell = file_get_contents(EXTENSIONS . '/hypotenuse/content/template/datasource.tpl');
				
				$shell = str_replace('<!-- CLASS NAME -->', str_replace('-', '_', $title_handle), $shell);
				$shell = str_replace('<!-- NAME -->', $title, $shell);
				$shell = str_replace('<!-- AUTHOR NAME -->', Administration::instance()->Author->getFullName(), $shell);
				$shell = str_replace('<!-- AUTHOR WEBSITE -->', URL, $shell);
				$shell = str_replace('<!-- AUTHOR EMAIL -->', Administration::instance()->Author->get('email'), $shell);
				$shell = str_replace('<!-- RELEASE DATE -->', DateTimeObj::getGMT('c'), $shell);
				$shell = str_replace('<!-- FIELD ID -->', 'айдишник поля', $shell);
				$shell = str_replace('<!-- FILTER ID -->', 'айдишник фильтра', $shell);
				$shell = str_replace('<!-- PARAM NAME -->', 'название параметра', $shell);
				$shell = str_replace('<!-- NODE NAME -->', $title_handle, $shell);
				
				$file = DATASOURCES . '/data.' . str_replace('-', '_', str_replace('-', '_', $title_handle)) . '.php';
				
				if(!is_writable(dirname($file)) || !$write = General::writeFile($file, $shell, $this->_Parent->Configuration->get('write_mode', 'file'))){
					$this->pageAlert(__('Failed to write data sources to <code>%s</code>. Please check permissions.', array(DATASOURCES)), Alert::ERROR);
				}else{
					$this->pageAlert('Hypotenuse data source saved.', Alert::SUCCESS);
				}
			}
			
		}

	}
	
?>