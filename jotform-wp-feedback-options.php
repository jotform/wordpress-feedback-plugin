<div class="wrap">
<div class="icon32"><img src="<?=plugins_url( 'images/feedback32x32.png' , __FILE__ );?>"/><br></div><h2>JotForm Feedback Button</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'jotform-wp-feedback-options'); ?>
    <?php do_settings_fields( 'jotform-wp-feedback-options',"buttonOptions"  ); ?>

<table class="form-table">
<tbody>
    <tr valign="top">
        <th scope="row"><label for="formID">Form ID</label></th><td><input name="buttonOptions[formID]" type="text" id="formID" value="<?=@$options['formID']; ?>" style="width:273px" class="regular-text"><img align="middle" style="margin-top:-8px; margin-left:4px;" src="<?=plugins_url( 'images/browse-icon22x22.png' , __FILE__ );?>" id="pickForm"></td>
    </tr>
    <tr valign="top">
        <th scope="row"><label for="formTitle">Button Text</label></th>
        <td><input name="buttonOptions[formTitle]" type="text" id="formTitle" value="<?=@$options['formTitle']; ?>" class="regular-text">
        </td>
    </tr>
    <tr valign="middle">
    <th scope="row"><label for="formDimensions">Form Dimensions (in px)</label></th>
        <td> Width : <input name="buttonOptions[formWidth]" type="text" id="formWidth" value="<?=@$options['formWidth']; ?>" class="regular-text" style="width:50px"> Height : <input name="buttonOptions[formHeight]" type="text" id="formHeight" value="<?=@$options['formHeight']; ?>" class="regular-text" style="width:50px"></td>
    </tr>

    <tr>
    <th scope="row">Screen Alignment</th>
    <td>
        <fieldset><legend class="screen-reader-text"><span>Screen Alignment</span></legend>
            <?php foreach (array("top"=>"Top Side","right"=>"Right Side","bottom"=>"Bottom Side","left"=>"Left Side") as $key => $value) {
                ?>
                    <label title="<?=$value;?>"><input type="radio" name="buttonOptions[screenAlignment]" <?= @$options["screenAlignment"] == $key ? "checked=checked" : ""; ?> value="<?=$key;?>"> <span> <?=$value;?></span></label><br>
                <?php
            }
            ?>
        </fieldset>
    </td>
    </tr>

    <tr>
    <th scope="row">Horizontal Alignment</th>
    <td>
        <fieldset><legend class="screen-reader-text"><span>Horizontal Alignment</span></legend>
            <?php foreach (array("left"=>"Left", "center"=>"Center", "right"=>"Right") as $key => $value) {
                ?>
                    <label title="<?=$value;?>"><input type="radio" name="buttonOptions[horizontalAlignment]" <?= @$options["horizontalAlignment"] == $key ? "checked=checked" : ""; ?> value="<?=$key;?>"> <span> <?=$value;?></span></label><br>
                <?php
            }
            ?>
        </fieldset>
    </td>
    </tr>
    <th scope="row">Lightbox Style</th>
    <td>
        <fieldset>
            <input type="hidden" id="lightBoxType" name="buttonOptions[lightBoxType]" value="<?=@$options['lightBoxType']; ?>">
            <legend class="screen-reader-text"><span>Horizontal Alignment</span></legend>
            <fieldset class="widgetOptions styleLb">
                <div class="styleBrowser">
                    <div class="styleBox" data-value="false"></div>
                </div>
                <div class="styleBrowser midBrowser">
                    <div class="styleBox styleBox1" data-value="1"></div>
                </div>
                <div class="styleBrowser">
                    <div class="styleBox styleBox2" data-value="2"></div>
                </div>
        </fieldset>
    </td>
    </tr>

    <STYLE type="text/css">
    .widgetOptions.styleLb{
        width:500px;
    }

    .styleBrowser{
        display:inline-block;
        height: 58px;
        width: 96px;
        background:#666;
        margin:1px 12px 6px;
        border:2px solid transparent;
        
    }
    
     .styleBrowser:hover,
     .styleBrowser.selectedStyle{
        width: 96px;
        height: 58px;
        border: 2px solid #ffa500;
        
        -moz-box-shadow: 0 0 2px #ffa500;
    }

    .styleBrowser .styleBox{
        display:inline-block;
        height: 35px;
        width: 60px;
        background:#ddd;
        margin:9px 19px;
        border-top: 5px solid #F59202;
        
        -moz-border-radius:3px;
        -webkit-border-radius:3px;
        border-radius:3px;
    }
    .styleBrowser .styleBox1{
        height: 30px;
        width: 50px;
        border: 5px solid #fff;
        background:#ddd;
    }
    
    .styleBrowser .styleBox2{
        height: 30px;
        width: 50px;
        border: 5px solid #000;
        background:#ddd;
    }
    </STYLE>
    
    <tr valign="top">
    <th scope="row"><label for="feedbackColors">Button and Label Colors</label></th>
        <td> Button : <input name="buttonOptions[buttonColor]" type="text" id="buttonColor" value="<?=@$options['buttonColor']; ?>" class="jotform-color-field regular-text" style="width:70px"> Label : <input name="buttonOptions[labelColor]" type="text" id="labelColor" value="<?=@$options['labelColor']; ?>" class="jotform-color-field regular-text" style="width:70px"></td>
    </tr>


</tbody></table>


<?php submit_button(); ?>
</form>

</div>