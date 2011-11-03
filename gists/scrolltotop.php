<?php
/**
 * @package     Expose
 * @version     2.0   
 * @author      ThemeXpert http://www.themexpert.com
 * @copyright   Copyright (C) 2010 - 2011 ThemeXpert
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3
 * @filesource
 * @file        scrolltotop.php
 **/

//prevent direct access
defined ('EXPOSE_VERSION') or die ('resticted aceess');
//we will not load it on mobile devices
if($this->get('scroll_top') AND !$this->layout->isMobile()){
    ob_start()
    ?>
<a href="#top" id="tx-scrolltop">Top</a>
<?php
    $this->addScript($this->exposeUrl.'interface/js/scrollTo.js');
    echo ob_get_clean();
}
?>

