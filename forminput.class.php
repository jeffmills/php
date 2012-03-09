<?php

require_once('database/forminputgrab.inc');

/**
* FormInput
*
* @package protect
* @author Jeff Mills
* @copyright 2011
* @version 1.0
* @access public
*/
class FormInput{
    
    public $type;
    public $label;
    public $name;
    public $options;
    public $attributes;

    /**
* FormInput::__construct()
*
* @param string $type Form type eg. select, text, radio etc.
* @param string $label The text for the label or the text for radios and checkboxes.
* @param string $name The inlead_field name assigned to the input
* @param array $attributes And array of additional input attributes such as class or placeholder eg. array('class' => 'required email')
* @param array $options The options or values of inputs.
* @return
*/
    public function __construct($params){
        if(isset($params['type'])) $this->type = $params['type'];
        if(isset($params['label'])) $this->label = $params['label'];
        if(isset($params['name'])) $this->name = $params['name'];
        if(isset($params['options'])) $this->options = $params['options'];
        if(isset($params['attributes'])) $this->attributes = $params['attributes'];
        
        if(empty($_GET[$this->name])){
        
            switch($this->type){
                case 'select':
                    $this->addSelect();
                    break;
                case 'text':
                    $this->addText();
                    break;
                case 'radio':
                    $this->addRadio();
                    break;
                case 'checkbox':
                    $this->addCheckBox();
                    break;
                case 'password':
                    $this->addPassword();
                    break;
                case 'submit':
                    $this->addSubmit();
                    break;
                case 'moneyrange':
                    $this->addMoneyRange();
                    break;
                case 'state':
                    $this->addStateSelect();
                    break;
                case 'range':
                    $this->addRange();
                    break;
            }
        
        }
        
        if($this->type == 'hidden'){
            $this->addHidden();
        }
    }
    
    /**
* FormInput::addSelect()
*
* @return
*/
    private function addSelect(){
        
        $this->renderLabel();
        
        echo "<select name='{$this->name}'" . $this->getAttributes($this->attributes) . " >";
        echo "<option value=\"\">Select One</option>";
        
        if(isset($this->options['selected'])){
            $selected = $this->options['selected'];
        }else{
            $selected = '';
        }
        
        foreach($this->options['values'] as $value => $label){
            ($selected == $value) ? $select = "selected='selected'" : $select = '';
            echo "<option value=\"{$value}\" {$select}>{$label}</option>";
        }
        
        echo "</select>";
        
    }
    
    private function addStateSelect(){
        
        $arrayStates = array('AL'=>"AL",'AK'=>"AK",'AZ'=>"AZ",'AR'=>"AR",'CA'=>"CA",'CO'=>"CO",'CT'=>"CT",'DE'=>"DE",'DC'=>"DC",'FL'=>"FL",'GA'=>"GA",'HI'=>"HI",'ID'=>"ID",'IL'=>"IL",'IN'=>"IN",'IA'=>"IA",'KS'=>"KS",'KY'=>"KY",'LA'=>"LA",'ME'=>"ME",'MD'=>"MD",'MA'=>"MA",'MI'=>"MI",'MN'=>"MN",'MS'=>"MS",'MO'=>"MO",'MT'=>"MT",'NE'=>"NE",'NV'=>"NV",'NH'=>"NH",'NJ'=>"NJ",'NM'=>"NM",'NY'=>"NY",'NC'=>"NC",'ND'=>"ND",'OH'=>"OH",'OK'=>"OK",'OR'=>"OR",'PA'=>"PA",'RI'=>"RI",'SC'=>"SC",'SD'=>"SD",'TN'=>"TN",'TX'=>"TX",'UT'=>"UT",'VT'=>"VT",'VA'=>"VA",'WA'=>"WA",'WV'=>"WV",'WI'=>"WI",'WY'=>"WY");
        
        $this->renderLabel();
        
        echo "<select name='{$this->name}'" . $this->getAttributes($this->attributes) . " >";
        echo "<option value=\"\">Select One</option>";
        if(isset($this->options['selected'])){
            $selected = $this->options['selected'];
        }else{
            $selected = '';
        }
        
        foreach($arrayStates as $value => $label){
            ($selected == $value) ? $select = "selected='selected'" : $select = '';
            echo "<option value=\"{$value}\" {$select}>{$label}</option>";
        }
        
        echo "</select>";
        
    }
    
    private function addRange(){
        $this->renderLabel();
        
        // div for the range value to be displayed
        echo "<div class='range_value'>$" . number_format($this->options['selected']) . "</div>";
        
        echo "<input name='{$this->name}' type='range' value='{$this->options['selected']}' min='{$this->options['min']}' max='{$this->options['max']}' step='{$this->options['step']}' " . $this->getAttributes($this->attributes) . " />";
    }
    
    private function addMoneyRange(){
        $this->renderLabel();
        
        echo "<select name='{$this->name}'" . $this->getAttributes($this->attributes) . " >";
        
        $count = count($this->options['range']);
        $interval = $this->options['range'][$count-1] - $this->options['range'][$count-2];
        if(isset($this->options['selected'])){
            $selected = $this->options['selected'];
        }else{
            $selected = '';
        }
        
        echo "<option>Select Amount</options>";
        
        foreach($this->options['range'] as $value => $label){
            $val = $label + ($interval/2);
            ($selected == $val) ? $select = "selected='selected'" : $select = '';
            echo "<option value='{$val}' {$select}>" . number_format($label) . " - " . number_format($label + ($interval-1)) . "</option>";
            
        }
        
        echo "</select>";
    }
    
    /**
* FormInput::addText()
*
* @return
*/
    private function addText(){
        $this->renderLabel();
        
        echo "<input type='text' name='{$this->name}'" . $this->getAttributes($this->attributes) . " />";
    }
    
    /**
* FormInput::addRadio()
*
* @return
*/
    private function addRadio(){
        $this->renderLabel();
        $selected = $this->options['selected'];
        
        foreach($this->options['values'] as $value => $label){
            ($selected == $value) ? $select = "checked='checked'" : $select = '';
            echo "<input type='radio' {$select} name='{$this->name}' value='{$value}'" . $this->getAttributes($this->attributes) . " /> ";
            echo "<span class='radio_label'>{$label}</span> ";
        }
    }
    
    /**
* FormInput::addCheckBox()
*
* @return
*/
    private function addCheckBox(){
        $this->renderLabel();
        
        foreach($this->options['values'] as $value => $label){
             echo "<input type='checkbox' name='{$this->name}' value='{$value}'" . $this->getAttributes($this->attributes) . " />";
             echo "<span class='checkbox_label'>{$label}</span>";
        }
    }
    
    /**
* FormInput::addPassword()
*
* @return
*/
    private function addPassword(){
        $this->renderLabel();
        
        echo "<input type='password' name='{$this->name}' " . $this->getAttributes($this->attributes) . " />";
    }
    
    /**
* FormInput::addSubmit()
*
* @return
*/
    private function addSubmit(){
        echo "<input type='submit' name='{$this->name}' value='{$this->label}' " . $this->getAttributes($this->attributes) . " />";
    }
    
    private function addHidden(){
        echo "<input type='hidden' name='{$this->name}' value='{$this->options}' " . $this->getAttributes($this->attributes) . " />";
    }
    
    /**
* FormInput::getAttributes()
*
* @param array $attributes
* @return
*/
    private function getAttributes($attributes = ''){
        $str = '';
        if(is_array($attributes)){
            foreach($attributes as $key => $val){
                if($val){
                    $str .= " {$key}='{$val}'";
                }
            }
            return $str;
        }
    }
    
    /**
* FormInput::renderLabel()
* If a class of required is added then it will add the asterisk to the label.
* If a class of guess is added then the "(okay to guess)" is added to the label.
* @return void
*/
    private function renderLabel(){
        $required = '';
        $guess = '';
        $nospam = '';
        if($this->attributes){
            foreach($this->attributes as $key => $val){
                if($key == 'class'){
                    if(stristr($val, 'required')){
                        $required = true;
                    }
                    if(stristr($val, 'guess')){
                        $guess = true;
                    }
                    if(stristr($val, 'nospam')){
                        $nospam = true;
                    }
                }
            }
        }
        
        if($required && $guess){
            $label = "<label for='{$this->name}'>{$this->label}<span class='required'>*</span> <span class='guess'>(okay to guess)</span></label>";
        }else if($required && $nospam){
            $label = "<label for='{$this->name}'>{$this->label}<span class='required'>*</span> <span class='guess'>(No Spam Guarantee)</span></label>";
        }else if($required){
            $label = "<label for='{$this->name}'>{$this->label}<span class='required'>*</span></label>";
        }else if($guess){
            $label = "<label for='{$this->name}'>{$this->label} <span class='guess'>(okay to guess)</span></label>";
        }else if($nospam){
            $label = "<label for='{$this->name}'>{$this->label} <span class='guess'>(No Spam Guarantee)</span></label>";
        }else{
            $label = "<label for='{$this->name}'>{$this->label}</label>";
        }
        echo $label;
    }
    
}

