<?php
/**
 * Class File
 *
 * Read leads from the JSON file.
 * Write leads to the JSON file. 
 */
class File {
    private $inputFile;
    private $outputFile;
    public function __construct($inputFile, $outputFile) {
        $this->inputFile = $inputFile;
        $this->outputFile = $outputFile;
    }
    /**
     * Read json data from the file.
     *
     * @return array
     */
    public function getFileData(){
        return json_decode(file_get_contents($this->inputFile), true);
    }

    /**
     * Create output file which contain unique leads
     *
     * @param array $outputData unique leads array.
     * @return boolean|int
     */
    public function createOutputFile($outputData){
        return file_put_contents($this->outputFile, json_encode($outputData, JSON_PRETTY_PRINT));;
    }
}
?>