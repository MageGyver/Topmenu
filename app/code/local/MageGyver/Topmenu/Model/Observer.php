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
	 * Observer for adding new entries to the topmenu before rendering
	 * @author buk@magegyver.de
	 */
	class MageGyver_Topmenu_Model_Observer {


		/**
		 * Append the previously top topmenu added links to the menu collection
		 */
		public function page_block_html_topmenu_gethtml_before ( Varien_Event_Observer $observer ) {
			$event = $observer->getEvent();

			$menu = $event->getMenu();
			$menuCollection = $menu->getChildren();

			if ( $block = Mage::app()->getLayout()->getBlock( 'catalog.topnav' ) ) {

				if ( $links = $block->getAdditionalLinks() ) {
					foreach ( $links as $link ) {

						$data = array(
							'id'            => 'category-additionalnode-' . crc32( $link[ 'url' ] ),
							'name'          => $link[ 'label' ],
							'url'           => $link[ 'url' ],
							'is_active'     => $link[ 'is_active' ],
						);

						$node = new Varien_Data_Tree_Node( $data, 'id', $menu->getTree() );
						$menuCollection->add( $node );
					}
				}

			}
		}
	}