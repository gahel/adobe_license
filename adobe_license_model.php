<?php
class Adobe_license_model extends Model {

	function __construct($serial='')
	{
		parent::__construct('id', 'adobe_license'); //primary key, tablename
		$this->rs['id'] = 0;
		$this->rs['serial_number'] = $serial; $this->rt['serial_number'] = 'VARCHAR(255) UNIQUE';
		$this->rs['AdobeExpirySN'] = '';
		$this->rs['AdobeExpiryStatus'] = '';
		$this->rs['AdobeExpiryDate'] = '';
		
		// Schema version, increment when creating a db migration
		$this->schema_version = 0;
 
	       // Create table if it does not exist
        	$this->create_table();

	        if ($serial) {
        	    $this->retrieve_record($serial);
            	$this->serial = $serial;
       		 }

	}
	function process($data)
	{
		require_once(APP_PATH . 'lib/CFPropertyList/CFPropertyList.php');
		$parser = new CFPropertyList();
		$parser->parse($data);
		
		$plist = $parser->toArray();

		foreach(array('AdobeExpirySN', 'AdobeExpiryStatus', 'AdobeExpiryDate') AS $item)
		{
			if (isset($plist[$item]))
			{
				$this->$item = $plist[$item];
			}
			else
			{
				$this->$item = '';
			}
		}
		
		$this->save();
	}
    /**
     * Get statistics
     *
     * @return void
     * @author
     **/
 
     public function get_license_stats()
    {
        $sql = "SELECT COUNT(CASE WHEN AdobeExpiryDate = 'ReplaceWithYourExpiryDate' THEN 1 END) AS Disabled,
                COUNT(CASE WHEN AdobeExpiryStatus = '0' THEN 1 END) AS Active
                FROM adobe_license
                LEFT JOIN reportdata USING(serial_number)
                ".get_machine_group_filter();
        return current($this->query($sql));
    }

 
}

