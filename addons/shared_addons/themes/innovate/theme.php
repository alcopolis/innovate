<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Theme_Innovate extends Theme {

    public $name			= 'Innovate';
    public $author			= 'Adriant Rivano';
    public $author_website	= 'http://adriantrivano.com/';
    public $website			= 'http://adriantrivano.com/';
    public $description		= 'Default Innovate v1.0.1 Theme Development.';
    public $version			= '1.0.1';
	public $options 		= array('show_breadcrumbs' => 	array('title' 		=> 'Show Breadcrumbs',
																'description'   => 'Would you like to display breadcrumbs?',
																'default'       => 'yes',
																'type'          => 'radio',
																'options'       => 'yes=Yes|no=No',
																'is_required'   => true),
									'layout' => 			array('title' => 'Layout',
																'description'   => 'Which type of layout shall we use?',
																'default'       => '2 column',
																'type'          => 'select',
																'options'       => '2 column=Two Column|full-width=Full Width|full-width-home=Full Width Home Page',
																'is_required'   => true),
								   );
}

/* End of file theme.php */