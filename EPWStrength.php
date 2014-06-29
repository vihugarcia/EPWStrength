<?php
/* 
 * PWStrength extension  - wrapper to include the pwstrength jQuery plugin
 * @yiiVersion 1.1.14
 */

/**
 * Description of EStrongPassword
 *
 * Per the http://plugins.jquery.com/pwstrength/
 *
 * @author Victor Hugo Garcia <vihugarcia@gmail.com>
 * @version 1.0
 */
class EPWStrength extends CWidget {

    private $_jsFile;

    private $_cssFile;

    public $model;
    public $attribute;
    public $form;
    public $htmlOptions;
    public $useMin;
    public $textsOptions;

    protected $fieldName;

    public static $id_count=0;

    /**
     * Initialize the widget, called by beginWidget or createWidget
     */
    public function init()
    {
        if ($this->form === null)
        {
            throw new CHttpException(500, 'No form object specified.');
        }
        if ($this->model === null)
        {
            throw new CHttpException(500, 'No model passed to pwstrength');
        }
        if ($this->attribute === null)
        {
            if ($this->model->hasAttribute('password'))
                $this->attribute = 'password';
            else
                throw new CHttpException(500, 'No attribute specified for pwstrength');
        }

        $this->fieldName = "#".get_class($this->model)."_".$this->attribute;

        if ($this->htmlOptions === null )
        {
            throw new CHttpException(500, 'No data-indicator specified via htmlOptions.');
        }
        else
        {
            if (!array_key_exists('data-indicator', $this->htmlOptions))
            {
                throw new CHttpException(500, 'No data-indicator specified via htmlOptions.');
            }
        }
    }

    /**
     * Execute the widget, called by endWidget or when called without begin/end
     */
    public function run()
    {
        Yii::app()->clientScript->registerCoreScript('jquery');

        if ( $this->useMin )
            $this->_jsFile = Yii::app()->assetManager->publish( dirname( __FILE__ ).'/js/jquery.pwstrength.min.js');
        else
            $this->_jsFile = Yii::app()->assetManager->publish( dirname( __FILE__ ).'/js/jquery.pwstrength.js');

        Yii::app()->clientScript->registerScriptFile($this->_jsFile);

        $this->_cssFile = Yii::app()->assetManager->publish( dirname( __FILE__ ).'/css/pwstrength.css');

        Yii::app()->clientScript->registerCssFile($this->_cssFile);

        // default texts
        $texts = "{texts: ['very weak', 'weak', 'mediocre', 'strong', 'very strong']}";
        if ($this->textsOptions !== null )
        {
            $texts = CJSON::encode($this->textsOptions);
        }		

        Yii::app()->clientScript->registerScript('strPass'.self::$id_count++,"jQuery('".$this->fieldName."').pwstrength({$texts});");		

        $form = $this->form;
        echo $form->passwordField( $this->model, $this->attribute, $this->htmlOptions);

    }

}
?>
