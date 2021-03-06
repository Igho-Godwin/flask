<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2007 Zend Technologies USA Inc. (http://www.zend.com)
 * @version    $Id: PartialLoop.php 7086 2007-12-11 20:35:31Z matthew $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_View_Helper_Partial */
require_once 'Zend/View/Helper/Partial.php';

/**
 * Helper for rendering a template fragment in its own variable scope; iterates 
 * over data provided and renders for each iteration.
 *
 * @package    Zend_View
 * @subpackage Helpers
 * @copyright  Copyright (c) 2005-2007 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_View_Helper_PartialLoop extends Zend_View_Helper_Partial 
{
    /**
     * Renders a template fragment within a variable scope distinct from the
     * calling View object.
     *
     * @param  string $name Name of view script
     * @param  string|array $module If $model is empty, and $module is an array,
     *                              these are the variables to populate in the 
     *                              view. Otherwise, the module in which the 
     *                              partial resides
     * @param  array $model Variables to populate in the view
     * @return string 
     */
    public function partialLoop($name, $module = null, $model = null)
    {
        if ((null == $model) && (null !== $module)) {
            $model  = $module;
            $module = null;
        } 

        if (!is_array($model) && (!$model instanceof Iterator)) {
            require_once 'Zend/View/Helper/Partial/Exception.php';
            throw new Zend_View_Helper_Partial_Exception('PartialLoop helper requires iterable data');
        }

        $content = '';
        foreach ($model as $item) {
            $content .= $this->partial($name, $module, $item);
        }

        return $content;
    }
}
