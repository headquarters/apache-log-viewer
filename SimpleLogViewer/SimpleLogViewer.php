<?php

class SimpleLogViewer {
    
    public $rawLines;
    public $formattedLines = array();
    //public $fileModifiedTime;
    
    function __construct($logFilePath) {
        //set default time to prevent errors in the log itself about an invalid timezone
        date_default_timezone_set("America/New_York");
        
        //$lines = file('/var/log/apache2/projects_error_log', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $this->rawLines = file($logFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        $this->formatLines();
    }
    
    function formatLines(){
        for($index = count($this->rawLines) - 1; $index >= 0; $index--){
            $line = $this->rawLines[$index];
            
            $this->formattedLines[$index] = array();
            
            $dateAndTime = substr($line, 1, 24);            
            $timestamp = strtotime($dateAndTime);            
            $now = time();            
            $timeDifference = $now - $timestamp;
            
            $line = substr($line, 27);
            $line = str_replace("[client 127.0.0.1]", "", $line);
            $matches = array();
            $match = preg_match('[\w+]', $line, $matches);
            
            if($match){
                $level = $matches[0];
            } else {
                $level = "unknown";
            }
            
            $line = str_replace("[" . $level . "] ", "", $line);
            
            
            if($timeDifference < 86400) {
                $formattedDate = "[Today] " . strftime("%l:%M%p", $timestamp);
                
                $this->formattedLines[$index]["isToday"] = true;
            } else {
                $formattedDate = strftime("%b %d %y %l:%M%p", $timestamp);
                
                $this->formattedLines[$index]["isToday"] = false;
            }
            
            $this->formattedLines[$index]["level"] = $level;
            $this->formattedLines[$index]["message"] = $line;
            $this->formattedLines[$index]["dateAndTime"] = $formattedDate;
        }
    }
    
}