<?php 

/**
 * AdobeLicense module class
 *
 * @package munkireport
 **/
class adobe_license_controller extends Module_controller
{
 
 /*** Protect methods with auth! ****/
 function __construct()
 {
 // Store module path
 $this->module_path = dirname(__FILE__);
 }

 /**
 * Default method
 *
 **/
 function index()
 {
 echo "You've loaded the adobe_license_status module!";
 }

    public function get_license_stats()
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }
                $sip_report = new Adobe_license_model;

                $out = array();
                $out['stats'] = $sip_report->get_license_stats();


        $obj->view('json', array('msg' => $out));
    }
 
} // END class default_module
