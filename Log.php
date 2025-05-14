<?php
/**
 * Class Log
 *
 * Write log to the JSON file.
 */
class Log{
    /**
     * Add data to the log file
     *
     * @param array $logData Log data array.
     * @return boolean|int
     */
    public function addLog($logData){
        return file_put_contents('log.json', json_encode($logData, JSON_PRETTY_PRINT));;
    }
}
?>