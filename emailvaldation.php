<?php 



class EmailValdation 
{ 
    //diclaring private properties
    private $_ip; 
    public $email; 
    
    
    //this mehtod return IP address of given doamin
    public function getIP($domain) 
    { 
        
        //configuration value set
        ini_set('display_errors', "0"); 
        $this->_ip = false; 
        
        //checking DNS records 
        try { 
            $records = dns_get_record($domain, DNS_MX); 
        } catch(Exception $e) { 
            return $e->getMessage(); 
        } 
        
        
        if(!empty($records)) { 
            //set value for flg
            $priority = null; 
            
            foreach($records as $record) { 
                if($priority == null || $record['pri'] < $priority) { 
                    
                    //getting IPv4 address specification
                    $myip = gethostbyname($record['target']);
                    
                    if($myip != $record['target']) { 
                        $this->_ip = $myip; 
                        $priority = $record['pri']; 
                    } //if($myip != $record['target']) {
                }//if($priority == null || $record['pri'] < $priority) {
            }//end foreach() 
        } //If no MX records are found 
        
        
        if(!$this->_ip) { 
            $ip = gethostbyname($domain); 
                if($this->_ip == $domain) { 
                    $this->_ip = false; 
                } 
        } 

        //returning IP address
        return $this->_ip; 
    } 
     
    
    
    
    
    
    /*
        following public function will check doamin name. It will return whether this 
        doamin is exist or not. And this function will get domain name based on email.     
    */
    
    public function checkDomain() 
    { 
        
        // separte domain name from email 
        // listing all variable from array
        list($emailPart, $domainPart) =  explode('@', $this->email); 
        
        
        //checking valid formated email and ip address of domain
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) && $this->getIP($domainPart)) { 
            
            // will return invalid domain
            return 1; 
        } 
        else { 
            
            // will return valid domain
            return 0;
        } 
    } 
     
} 
?>