<?php

$this->layout = "error";
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Errors
 * @since         CakePHP(tm) v 2.2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<h2><?php echo __d('cake_dev', 'Server is temporarily unavailable.'); ?></h2>
<p class="error">
	<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
	<?php if(strpos($error->getMessage(), 'SOAP-ERROR') !== false):?>
		<?php echo "Server is temporarily unavailable. Please try again later. "?>
	<?php else: ?>
		<?php echo h($error->getMessage()); ?>
		
	<?php endif; ?>
		
	<br>

	<strong><?php echo __d('cake_dev', 'File'); ?>: </strong>
	<?php echo h($error->getFile()); ?>
	<br>

	<!--<strong><?php echo __d('cake_dev', 'Line'); ?>: </strong>-->
	<?php //echo h($error->getLine()); ?>
</p>
<p class="notice">
	<!--<strong><?php echo __d('cake_dev', 'Notice'); ?>: </strong>-->
	<?php //echo __d('cake_dev', 'If you want to customize this error message, create %s', APP_DIR . DS . 'View' . DS . 'Errors' . DS . 'fatal_error.ctp'); ?>
</p>
