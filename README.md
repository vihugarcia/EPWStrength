This is an extension to enable strong password validation based on the jQuery
pwstrength plugin, found here: http://plugins.jquery.com/pwstrength
 
 Example usage:

 	<div class="row">
        <?php echo $form->labelEx($model,'password'); ?>

        <?php

        $reqOptions = array(
                          'texts' => array('very weak', 'weak', 'mediocre', 'strong', 'very strong'),
                      );

        $this->widget('ext.EPWStrength.EPWStrength',
            array('form'=>$form, 'model'=>$model, 'attribute'=>'password', 'requirementOptions'=>$reqOptions, 'htmlOptions' => array('data-indicator'=>"pwindicator")));

        ?>

        <div id="pwindicator">
            <div class="bar"></div>
            <div class="label"></div>
        </div>

        <?php echo $form->error($model,'password'); ?>
    </div>
	
By default, it will use the minified version of the javascript. If you wish NOT to use
that, set useMin param to false in your configuration array.

GitHub Repo - https://github.com/vihugarcia/EPWStrength