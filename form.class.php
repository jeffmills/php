<?php

require_once('database/forminputgrab.inc');
require_once('forminput.class.php');

class Form {
    private $questions;

    function __construct(){
        $this->questions = new FormInputGrab();
    }
    
    public function renderInputById($id){
        
        $result = $this->questions->getInputById($id);
        
        $this->renderInput($result);
          
    }
    
    public function renderInputsById($ids){
        
        foreach($ids as $id){
            
            $result = $this->questions->getInputById($id);
            
            $this->renderInput($result);
            
          }
    }
    
    public function renderInputsByName($names){
        
        foreach($names as $name){
            
            $result = $this->questions->getInputByName($name);
            
            $this->renderInput($result);
            
          }
    }
    
    private function renderInput($result){
        $options = '';
        $count = 0;
        
              if(count($result['0']) > 1 || $result['type'] == 'checkbox'){
                  $values = array();
                  $options = array();
                  foreach($result['0'] as $value){
                     $values[$result[0][$count]['value']] = $result[0][$count]['label'];
                     if($result[0][$count]['selected'] == 1){
                        $options['selected'] = $result[0][$count]['value'];
                     }
                     $count++;
                  }
                  $options['values'] = $values;
              }else if($result['type'] == 'hidden'){
                  $options = $result[0][0]['value'];
              }else if(isset($result[0][0]['range_min']) && isset($result[0][0]['range_max'])){
                
                  // Options for input type moneyrange
                  $options['range'] = range($result[0][0]['range_min'], $result[0][0]['range_max'], $result[0][0]['r_interval']);
                  
                  // Options for input type range
                  $options['min'] = $result[0][0]['range_min'];
                  $options['max'] = $result[0][0]['range_max'];
                  $options['step'] = $result[0][0]['r_interval'];
                  
                  if(isset($result[0][0]['selected'])){
                  $options['selected'] = $result[0][0]['selected'];
                  
                  }
              }
            
              $class = $result['class'];
            
              if($result['required'] == 1){
                  $class .= ' required';
              }
            
              if($result['guess'] == 1){
                  $class .= ' guess';
              }
            
              if($result['nospam'] == 1){
                  $class .= ' nospam';
              }
              
              if(isset($result['placeholder'])){
                $placeholder = $result['placeholder'];
              }
                
              echo "<div class='field' id='{$result['inlead_name']}_field'>";
                
              new FormInput(array('type'=>$result['type'],'label'=>$result['label'],'name'=>$result['inlead_name'],'attributes'=>array('id'=>$result['id'], 'class'=>$class, 'placeholder'=>$placeholder),'options'=>$options));
              
              echo "</div>";
    }
    
}