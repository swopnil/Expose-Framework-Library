<?php

//prevent direct access
defined ('EXPOSE_VERSION') or die ('resticted aceess');

//import parent gist class
expose_import('core.widget');

class ExposeWidgetMenu extends ExposeWidget{

    public $name = 'menu';

    public function render()
    {
        global $expose;
        $html = '';

        // Assign params values
        $animation = $this->get('animation');
        $animation_sublevel = $this->get('animation-sublevel');
        $startlevel = $this->get('startlevel', 1);
        $endlevel = $this->get('endlevel', -1);

        //$fancy = ($this->get('fancy-animation')) ? 'true' : 'false';

        $style = (isset ($_COOKIE[$expose->templateName.'_menu'])) ? $_COOKIE[$expose->templateName.'_menu'] : $this->get('style','mega');
        if(isset ($_REQUEST['menu'])){
            setcookie($expose->templateName.'_menu',$_REQUEST['menu'],time()+3600,'/');
            $style = $_REQUEST['menu'];
        }

        //$style = $this->get('style','mega');
        $hasSubMenu = '';

        $fileName = $style.'menu';


        switch($style){

            case 'split':
                $class = 'ExposeSplitMenu';
                $hasSubMenu = TRUE;
                $expose->addLink('splitmenu.css','css',2);
                break;

            case 'mega':
            default:
                $class = 'ExposeMegaMenu';
                $hasSubMenu = FALSE;
                break;
        }

        //import menu file
        expose_import("core.menu.$fileName");

        //set some menu params
        $align = ($expose->direction == 'rtl') ? 'right' : 'left';
        $expose->document->params->set('startlevel', $startlevel); //Startlevel
        $expose->document->params->set('endlevel', $endlevel); //endlevel

        $menu = new $class($expose->document->params);

        ob_start();
        ?>

        <nav class="ex-menu hidden-phone" dropdown-animation="<?php echo $animation; ?>" dropdown-sub-animation="<?php echo $animation_sublevel; ?>">

            <?php $menu->loadMenu(); ?>

            <?php $menu->genMenu(); ?>

            <?php if($hasSubMenu AND $menu->hasSubMenu(1) AND $menu->showSeparatedSub)
            { ?>
                <div id="subnav" class="clearfix">
                   <?php $menu->genMenu(1); ?>
                </div>
           <?php
            } ?>

        </nav> <!-- menu end -->



        <nav id="mobile-menu" class="visible-phone">
            <select onChange="window.location.replace(this.options[this.selectedIndex].value)">
                <?php foreach($menu->items as $key => $val):?>
                <?php
                    $itemId = JRequest::getvar('Itemid');
                    $active = '';
                   if ($itemId == $val->id) $active = 'selected="selected"';
                ?>
                <option value="<?php echo $val->url;?>" <?php echo $active; ?> >
                    <?php
                        if( count($val->tree) > 1 )
                        {
                            for($i=0; $i < (count($val->tree)-1); $i++){
                                echo "-";
                            }
                        }
                    ?>
                    <?php echo $val->title; ?>
                </option>
                <?php endforeach;?>
            </select>
        </nav>

        <?php
        return ob_get_clean();
    }

}
