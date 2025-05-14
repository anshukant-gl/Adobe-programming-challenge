<?php
/**
 * Class Lead
 *
 * Fetch unique leads from all leads.
 * Genrate log data for all leads manipulation. 
 */
class Lead{
    public $file;
    public $log;
    
    public function __construct($file, $log){
        $this->file = $file;
        $this->log = $log;
    }

     /**
     * Read data from the json file.
     *
     * @return array
     */
    public function getInputData(){
        $data = $this->file->getFileData();
        return (!empty($data['leads'])) ? $data['leads']: array();
    }

    /**
     * Compare data time of current lead and existing lead
     *
     * @param array $currentLead current lead of actual array.
     * @param array $existingLead  Lead already in unique array.
     * @return boolean
     */
    public function compare($currentLead, $existingLead){
        $currentLeadDateTime = strtotime($currentLead['entryDate']);
        $existingLeadDateTime = strtotime($existingLead['entryDate']);
        return ($currentLeadDateTime >= $existingLeadDateTime) ? true : false;
    
    }
    
    /**
     * Executes a given command or process.
     */
    public function execute(){
        $data = $this->getInputData();
        $unique = array();
        $log = array();
        if(!empty($data)){
            array_filter($data, function($lead) use (&$unique, &$log){
                $id = $lead['_id'];
                $email= $lead['email'];
                $existingKey = null;
                foreach ($unique as $key => $value) { 
                   if($id == $value['_id'] || $email == $value['email']){
                        $existingKey = $key;
                        break;
                    }
                }
                if($existingKey !== null){
                    if($this->compare($lead, $unique[$key])){
                        $log[] = [
                            'old_record' => $unique[$existingKey],
                            'new_record' => $lead
                        ];
                        $unique[$existingKey] = $lead;
                    }
                    return false;    
                }
                $unique[] = $lead;
                return false;
            });
            if($this->file->createOutputFile(array('leads' => $unique))){
                echo "Unique leads file created successfully.\n";
            }else {
                echo "Unable to create output file.";
            }
            if($this->log->addLog($log)){
                echo "Log file created successfully.";
            } else {
                echo "Unable to create log file.";
            }
        } else {
            echo "Leads file is empty";
        }
        
    }
}