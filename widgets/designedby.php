<?php
/**
 * @package     Expose
 * @version     2.0  
 * @author      ThemeXpert http://www.themexpert.com
 * @copyright   Copyright (C) 2010 - 2011 ThemeXpert
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3
 **/

//prevent direct access
defined ('EXPOSE_VERSION') or die ('resticted aceess');

//import parent gist class
expose_import('core.widget');

class ExposeWidgetDesignedby extends ExposeWidget{
    
    public $name = 'designedby';

    public function render()
    {

        ob_start()
        ?>
        <div class="designed-by">
            <p>Designed by <a target="_blank" title="ThemeXpert" href="http://www.themexpert.com">ThemeXpert</a></p>
        </div>


        <?php
        return ob_get_clean();
    }
}

?>
