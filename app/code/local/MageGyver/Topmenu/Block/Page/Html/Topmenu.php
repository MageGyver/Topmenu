<?php
/**
 * MageGyver/Topmenu
 *
 * Provides a simple way to add individual entries to the topmenu.
 *
 * @category    Topmenu
 * @package     MageGyver
 * @copyright   Copyright (c) 2013 MageGyver. (http://www.magegyver.de)
 * @license     http://creativecommons.org/licenses/by-sa/3.0/  CC-by-sa 3.0
 */

	/**
	 * Extend topmenu block to add links to it
	 * @author buk@magegyver.de
	 */
	class MageGyver_Topmenu_Block_Page_Html_Topmenu extends Mage_Page_Block_Html_Topmenu {

		/**
		 * Stores the added links
		 */
		protected $additionalLinks = array();



		/**
		 * Add a new link to the topmenu block
		 *
		 * Currently only the type 'path' is supported
		 *
		 * @param string $label
		 * @param string $type
		 * @param string $value
		 */
		public function addLink( $label, $type, $value ) {
			if ( 'path' == $type ) {
				$_coreUrlHelper = $this->helper( 'core/url' );

				$currentPath = str_replace( Mage::getBaseUrl(), '', $_coreUrlHelper->getCurrentUrl() );

				$url = Mage::getUrl( $value );

				$data = array(
					'label'                 => $label,
					'url'                   => $url,
					'is_active'             => (int)( $value == $currentPath ),
				);

				$this->additionalLinks[ $url ] = $data;
			}
		}



		/**
		 * Get list of added links
		 *
		 * @return array
		 */
		public function getAdditionalLinks() {
			return $this->additionalLinks;
		}
	}
