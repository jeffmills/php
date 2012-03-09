<?php

/**
* GoogleOptimizer
*
* @package Schooldegrees
* @author Jeff Mills
* @copyright 2011
* @version $Id$
* @access public
*/
class GoogleOptimizer
{
    private $experiments;
    private $runningExperimentIds;
    private $runningExperiments;
    
    /**
* GoogleOptimizer::__contruct()
*
* @return
*/
    public function __construct(){
        $experiments = $this->getAllExperiments();
        $runningExperimentIds = $this->runningExperimentIds();
        $runningExperiments = $this->getRunningExperiments();
    }
    
    public function getAllExperiments(){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/analytics/feeds/websiteoptimizer/experiments?prettyprint=true");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $data = array('accountType' => 'GOOGLE',
        'Email' => 'conversion1on1@gmail.com',
        'Passwd' => '1on1conversion',
        'source' => 'SWIS-Webbeheer-4.0',
        'service' =>'analytics');
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('auth' => 'Authorization: GoogleLogin auth=DQAAAJ4AAACKDA5F4RjTij3XXFaDk5DhTEIqj-w6YA6ovExt8IKRg7bCmMPk1APC3cN5g8DkEZ7fWzSHjBEt-bnL_lQ6gNrksbXy8lBbRBzjOPAXB1yyUyBi06s8DCPqN9gYCg9CzAnLRdOMpnodMn6qHauQjTCed1x-Xmaom4jhqUlZJN0RL-1Oybbdh4JCxRktt9mE9s3kjqRI2DwUyn_RDJkpF_oH'));
        
        $this->experiments = curl_exec($ch);
        
        return $this->experiments;
    }
    
    
    /**
* GoogleOptimizer::runningTestIds()
*
* @return int The id's of tests that are currently running
*/
    public function runningExperimentIds(){
        
        $experiments = $this->experiments;
        
        $dom = new DOMDocument();
        
        $dom->loadXML($experiments);
        
        $entries = $dom->getElementsByTagName('entry');
        
        $i = 0;
        
        foreach($entries as $entry){
            
            $status = $entry->getElementsByTagName('status');
            $status = $status->item(0)->nodeValue;
            
            if($status == 'Running' || $status == 'New'){
            
                $this->runningExperimentIds[$i] = Array();
                
                $id = $entry->getElementsByTagName('experimentId');
                $this->runningExperimentIds[$i]['id'] = $id->item(0)->nodeValue;
            
                $i++;
            }
            
            
        }
        
        return $this->runningExperimentIds;
 
    }
    
    public function getRunningExperiments(){
        
        $result = Array();
        $tests = $this->runningExperimentIds;
        $i = 0;
        
        foreach($tests as $test){
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/analytics/feeds/websiteoptimizer/experiments/" . $test['id']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $data = array('accountType' => 'GOOGLE',
        'Email' => 'conversion1on1@gmail.com',
        'Passwd' => '1on1conversion',
        'source' => 'SWIS-Webbeheer-4.0',
        'service' =>'analytics');
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('auth' => 'Authorization: GoogleLogin auth=DQAAAJ4AAACKDA5F4RjTij3XXFaDk5DhTEIqj-w6YA6ovExt8IKRg7bCmMPk1APC3cN5g8DkEZ7fWzSHjBEt-bnL_lQ6gNrksbXy8lBbRBzjOPAXB1yyUyBi06s8DCPqN9gYCg9CzAnLRdOMpnodMn6qHauQjTCed1x-Xmaom4jhqUlZJN0RL-1Oybbdh4JCxRktt9mE9s3kjqRI2DwUyn_RDJkpF_oH'));
        
        $this->runningExperiments[$i] = curl_exec($ch);
        
        $i++;
        }
        
        return $this->runningExperiments;
    }
    
    public function getExperimentScripts(){
        $experiments = $this->runningExperiments;
        
        $i = 0;
        $scripts = Array();
        
        foreach($experiments as $experiment){
            
            $dom = new DOMDocument();
            
            $entries = $dom->loadXML($experiment);
            
            $entries = $dom->getElementsByTagName('trackingScript');

            $scripts[$i]['tracking'] = $entries->item(0)->nodeValue;
            
            $entries = $dom->getElementsByTagName('controlScript');

            $scripts[$i]['control'] = $entries->item(0)->nodeValue;
            
            $entries = $dom->getElementsByTagName('conversionScript');

            $scripts[$i]['conversion'] = $entries->item(0)->nodeValue;
            
            $entries = $dom->getElementsByTagName('experimentId');

            $scripts[$i]['id'] = $entries->item(0)->nodeValue;
            
            $i++;
        }
        
        return $scripts;
        
    }
    
    public function getExperimentTitle(){
        $experiments = $this->runningExperiments;
        $i = 0;
        $titleArray = Array();
        
        foreach($experiments as $experiment){
            
            $dom = new DOMDocument();
            
            $entries = $dom->loadXML($experiment);
            
            $entries = $dom->getElementsByTagName('title');

            $titleArray[$i] = $entries->item(0)->nodeValue;
            
            $i++;
        }
        
        return $titleArray;
    }
    
    public function getExperimentUrl(){
        $experiments = $this->runningExperiments;
        $i = 0;
        $urlArray = Array();
        
        foreach($experiments as $experiment){
         
            $dom = new DOMDocument();
                
            $entries = $dom->loadXML($experiment);
                
            $entries = $dom->getElementsByTagName('content');
            
            $urlArray[$i] = $entries->item(0)->nodeValue;
            
            $i++;
        }
        
        return $urlArray;
    }
    
    public function getABVariations(){
        
        $ABVariations = Array();
        $tests = $this->runningExperimentIds;
        $i = 0;
        
        foreach($tests as $test){
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/analytics/feeds/websiteoptimizer/experiments/" . $test['id'] . "/abpagevariations");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $data = array('accountType' => 'GOOGLE',
        'Email' => 'conversion1on1@gmail.com',
        'Passwd' => '1on1conversion',
        'source' => 'SWIS-Webbeheer-4.0',
        'service' =>'analytics');
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('auth' => 'Authorization: GoogleLogin auth=DQAAAJ4AAACKDA5F4RjTij3XXFaDk5DhTEIqj-w6YA6ovExt8IKRg7bCmMPk1APC3cN5g8DkEZ7fWzSHjBEt-bnL_lQ6gNrksbXy8lBbRBzjOPAXB1yyUyBi06s8DCPqN9gYCg9CzAnLRdOMpnodMn6qHauQjTCed1x-Xmaom4jhqUlZJN0RL-1Oybbdh4JCxRktt9mE9s3kjqRI2DwUyn_RDJkpF_oH'));
        
        $ABVariations[$i] = curl_exec($ch);
        
        $i++;
        }
        
        return $ABVariations;
        
    }
    
    public function getABInfo(){
        
        $variations = $this->getABVariations();
        $i = 0;
        $ABinfo = Array();
        
        foreach($variations as $variation){
            
            $dom = new DOMDocument();
                
            $entries = $dom->loadXML($variation);
            
            $entries = $dom->getElementsByTagName('content');
            
            for($e = 0; $e < $entries->length; $e++){
            
                $ABinfo[$i]['url'][$e] = $entries->item($e)->nodeValue;
            
            }
            
            $entries = $dom->getElementsByTagName('abPageVariationId');
            
            for($e = 0; $e < $entries->length; $e++){
            
                $ABinfo[$i][$e] = $entries->item($e)->nodeValue;
            
            }
            
            $i++;
        }
        
        return $ABinfo;
        
    }
    
    
    
}

?>