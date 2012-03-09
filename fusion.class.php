<?php

/******************************************************************************
** class FusionLogo
******************************************************************************/

   class FusionLogo
   {
    
    /******************************************************************************
** constructor
******************************************************************************/
     function __construct()
     {
       
       
     }
     
     
private function isURL($url) {
if(preg_match('/'.$url.'/i',$_SERVER['SERVER_NAME'])) {
return true;
}
return false;
}

/******************************************************************************
** displaylogo
******************************************************************************/
     
     function displaylogo()
     {
    
    $url = $_SERVER['SERVER_NAME'];
    
    //EDUCATION AND CAREER CENTER
if(($this->isURL('educationandcareercenter') || $_GET['logo'] == 'ecc') && file_exists('schools/fusion/'. $_GET['leadcat'] .'/images/ecc.png')) {
echo "<img src='/schooldegrees/schools/fusion/" . $_GET['leadcat'] . "/images/ecc.png' alt='Education and Career Center.com' />";
        
    //CHOOSE ONLINE COLLEGE
}elseif(($this->isURL('chooseonlinecollege') || $_GET['logo'] == 'coc') && file_exists('schools/fusion/'. $_GET['leadcat'] .'/images/coc.png')) {
            echo "<img src='/schooldegrees/schools/fusion/" . $_GET['leadcat'] . "/images/coc.png' alt='Choose Online College.com' />";
            
    //CHOOSE COLLEGE ONLINE
    }elseif(($this->isURL('choosecollegeonline') || $_GET['logo'] == 'cco') && file_exists('schools/fusion/'. $_GET['leadcat'] .'/images/cco.png')){
            echo "<img src='/schooldegrees/schools/fusion/" . $_GET['leadcat'] . "/images/cco.png' alt='Choose College Online.com' />";
            
    //CAREER INSTITUTE
    }elseif(($this->isURL('careerinstitutes') || $_GET['logo'] == 'ci') && file_exists('schools/fusion/'. $_GET['leadcat'] .'/images/ci.png')){
            echo "<img src='/schooldegrees/schools/fusion/" . $_GET['leadcat'] . "/images/ci.png' alt='Career Institutes.org' />";
            
    //CLASSES AND CAREERS
    }else{
echo "<img src='/schooldegrees/schools/fusion/" . $_GET['leadcat'] . "/images/logo.png' alt='Classes and Careers.com' />";
}
       
     }
    
   
   
   /******************************************************************************
** displayfooter
******************************************************************************/
   
   function displayfooter()
   {
    
        $url = $_SERVER['SERVER_NAME'];
        
        //EDUCATION AND CAREER CENTER
        if($this->isURL('educationandcareercenter')) {
            echo "&reg; EducationAndCareerCenter.com 2007-" . date('Y') . " | <a href='http://www.educationandcareercenter.com/privacy.php' target='_blank'>Privacy Policy</a> | <a href='mailto:info@educationandcareercenter.com'>Contact us</a><br/>
EducationAndCareercenter.com is a division/subsidiary of One on One Marketing, Inc.";
        
        //CHOOSE ONLINE COLLEGE
        }else if($this->isURL('chooseonlinecollege')){
            
            echo "&reg; ChooseOnlineCollege.com 2007-" . date('Y') . " | <a href='http://www.chooseonlinecollege.com/privacy.html' target='_blank'>Privacy Policy</a> | <a href='mailto:info@chooseonlinecollege.com'>Contact us</a><br/>
ChooseOnlineCollege.com is a division/subsidiary of One on One Marketing, Inc.";
        
        //CHOOSE COLLEGE ONLINE
        }else if($this->isURL('choosecollegeonline')){
            
            echo "&reg; ChooseCollegeOnline.com 2007-" . date('Y') . " | <a href='http://www.choosecollegeonline.com/privacy.html' target='_blank'>Privacy Policy</a> | <a href='mailto:info@choosecollegeonline.com'>Contact us</a><br/>
ChooseCollegeOnline.com is a division/subsidiary of One on One Marketing, Inc.";
            
        //CAREER INSTITUTES
        }else if($this->isURL('careerinstitutes')){
            
            echo "&reg; CareerInstitutes.org 2007-" . date('Y') . " | <a href='http://www.careerinstitutes.org/privacy.html' target='_blank'>Privacy Policy</a> | <a href='mailto:info@careerinstitutes.org'>Contact us</a><br/>
CareerInstitutes.org is a division/subsidiary of One on One Marketing, Inc.";
        
        //CLASSES AND CAREERS
        } else {
            
            echo "<span class='copywrite'>&reg; ClassesandCareers.com 2007-" . date('Y') . " |</span> <a href='http://www.classesandcareers.com/privacy' target='_blank'>Privacy Policy</a> | <a href='http://www.classesandcareers.com/link-to-us' target='_blank'>Link to us</a> | <a href='http://www.classesandcareers.com/pressreleases/' target='_blank'>Press</a> | <a href='http://www.classesandcareers.com/contactus' target='_blank'>Contact us</a> | <a href='http://www.classesandcareers.com/' target='_blank'>Online Education</a><br/>
<span class='footer_division'>ClassesandCareers.com is a division/subsidiary of One on One Marketing, Inc.</span>";

        }
        echo '</br></br><div class="legal_discloser"> <p style="margin:0 10px; font-size: 9px;">Financial aid may be available for those who qualify. This is an education offer, not related to any other promotion, job or reward. The displayed options are all top online degree programs, not necessarily based on your preferences.<p></div>';
   }
   
    /******************************************************************************
** displayheader
******************************************************************************/
    
    function displayheader() {
        
        $url = $_SERVER['SERVER_NAME'];
        //EDUCATION AND CAREER CENTER
        if($this->isURL('educationandcareercenter')) {
            
            echo "";
        
        //CHOOSE ONLINE COLLEGE
        }else if($this->isURL('chooseonlinecollege')){
            
            echo "
<ul>
<li><a href='mailto:info@chooseonlinecollege.com'>Contact Us</a> |</li>
<li><a href='http://www.chooseonlinecollege.com/privacy.html'>Privacy Policy</a></li>
</ul>";
        //CHOOSE ONLINE COLLEGE
        }else if($this->isURL('choosecollegeonline.')){
            
            echo "
<ul>
<li><a href='mailto:info@choosecollegeonline.com'>Contact Us</a> |</li>
<li><a href='http://www.choosecollegeonline.com/privacy.html'>Privacy Policy</a></li>
</ul>";
        
        //CAREER INSTITUTES
        }else if($this->isURL('careerinstitutes')){
            
            echo "
<ul>
<li><a href='http://www.careerinstitutes.org/'>Home</a> |</li>
<li><a href='mailto:info@careerinstitutes.org'>Contact us</a> |</li>
<li><a href='http://www.careerinstitutes.org/privacy.html' target='_blank'>Privacy Policy</a></li>
</ul>";
        
        //CLASSES AND CAREERS
        }else{
            
            echo "
<ul>
<li><a href='http://www.classesandcareers.com/'>Home</a> |</li>
<li><a href='http://www.classesandcareers.com/contactus'>Contact Us</a> |</li>
<li><a href='http://www.classesandcareers.com/privacy'>Privacy Policy</a></li>
</ul>";
            
        }
        
    }
   
      /******************************************************************************
** displayverisign
******************************************************************************/
   
    function displayverisign() {
     
      echo '<table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose VeriSign Trust Seal to promote trust online with consumers.">
<tr>
<td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.verisign.com/getseal?host_name='.$_SERVER["SERVER_NAME"].'&amp;size=S&amp;use_flash=NO&amp;use_transparent=NO&amp;lang=en <https://seal.verisign.com/getseal?host_name='.$_SERVER["SERVER_NAME"].'&amp;size=S&amp;use_flash=NO&amp;use_transparent=NO&amp;lang=en>"></script><br />
<a href="http://www.verisign.com/verisign-trust-seal" target="_blank" style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;"></a></td>
</tr>
</table>';
     
    }




   /******************************************************************************
** displays logo for files in schooldegree directory
******************************************************************************/
     
     function finaldisplaylogo()
     {

    
    //EDUCATION AND CAREER CENTER
    if(($this->isURL('educationandcareercenter') || $_GET['logo'] == 'ecc') && file_exists('images/logos/ecc.png')) {
        echo "<img src='images/logos/ecc.png' alt='Education and Career Center.com' />";
        
    //CHOOSE ONLINE COLLEGE
    }elseif(($this->isURL('chooseonlinecollege') || $_GET['logo'] == 'coc') && file_exists('images/logos/coc.png')) {
            echo "<img src='images/logos/coc.png' alt='Choose Online College.com' />";
            
    //CHOOSE COLLEGE ONLINE
    }elseif(($this->isURL('choosecollegeonline') || $_GET['logo'] == 'cco') && file_exists('images/logos/cco.png')){
            echo "<img src='images/logos/cco.png' alt='Choose College Online.com' />";
            
    //CAREER INSTITUTE
    }elseif(($this->isURL('careerinstitutes') || $_GET['logo'] == 'ci') && file_exists('images/logos/ci.png')){
            echo "<img src='images/logos/ci.png' alt='Career Institutes.org' />";
            
    //CLASSES AND CAREERS
    }else{
        echo "<img src='images/logos/logo.png' alt='Classes and Careers.com' />";
    }
       
     }
    
   }
   

?>