<?php

if( ! defined( 'ABSPATH' ) ) exit;

class Cuztom_Tabs
{
	var $id;
	var $meta_type;
	var $tabs = array();

	function __construct( $id, $args )
	{
		$this->id  		= $id;

		// Localize tabs
		add_action( 'admin_enqueue_scripts', array( &$this, 'localize' ) );
	}
	
	function output( $object )
	{
		$tabs = $this->tabs;
				
		echo '<div class="js-cuztom-tabs cuztom-tabs">';
			echo '<ul>';
				foreach( $tabs as $title => $tab )
				{
					echo '<li><a href="#' . $tab->id . '">' . $tab->title . '</a></li>';
				}
			echo '</ul>';
	
			foreach( $tabs as $title => $tab )
			{
				$tab->output( $object, 'tabs' );
			}
		echo '</div>';
	}

	function save( $object_id, $values )
	{
		foreach( $this->tabs as $tab )
		{
			$tab->save( $object_id, $values );
		}
	}
	
	function localize()
	{
		wp_localize_script( 'cuztom', 'Cuztom_' . $this->id, (array) $this );
	}
}