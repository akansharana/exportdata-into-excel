<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
   public $helpers = array('Html', 'Form');
    public $components = array('RequestHandler');
    public $uses = array("Page");

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
    
      public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index','export_excel');
          date_default_timezone_set('asia/kolkata');
    }
	public function index() { 
        $this->layout = NULL;
         
    }
    
        
        
       public function export_excel(){
           $this->layout = NULL;
          $data = $this->request->data;


          $query2= $this->Page->query("SELECT * FROM `pages` WHERE order_id >= '".$data['Page']['from_id']."' AND order_id <=  '".$data['Page']['to_id']."'OR order_date = '".$data['Page']['from_date']."' ");
          //OR order_date = '".$data['Page']['from_date']."'
       
 $header_row = ''; 
 $columnHeader='';
$columnHeader = "order_id" . "\t" . "order_customer_name" . "\t" . "order_item" . "\t"."order_value"."\t"."order_date"."\t";
$setData = '';

    $rowData = '';  
    
           foreach ($query2 as $value) {  
           
        $header_row = $value['pages']['order_id']."\t". $value['pages']['order_customer_name'] ."\t ".$value['pages']['order_item']." \t ".$value['pages']['order_value']." \t ".$value['pages']['order_date']."\n";
          
        
        $setData .= trim($header_row) . "\n";  
          
    }
    
header('Content-type: application/ms-excel');
header("Content-Disposition: attachment; filename=User_Detail.xls");  

 echo $columnHeader ."\n".$setData;

die();
       
}

       

        
    
}
