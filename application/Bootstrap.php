<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_logger;
    protected $_view;

    protected function _initLogging()
    {
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/log/logFile.log');        
        $logger = new Zend_Log($writer);

        Zend_Registry::set('log', $logger);

        $this->_logger = $logger;
    	$this->_logger->info('Bootstrap ' . __METHOD__);
    }

    protected function _initRequest()
	// Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
	// che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
	// Necessario solo se la Document-root di Apache non è la cartella public/
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }

    protected function _initViewSettings()
    {
        $this->bootstrap('view'); //crea la view
        $this->_view = $this->getResource('view');
        $this->_view->headMeta()->setCharset('UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT');
	$this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/bootstrap.min.css'));
	$this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/base.css'));
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/bootstrap-responsive.min.css'));
	$this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/couponshop.css'));
        $this->_view->headLink()->appendStylesheet("https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css");
        $this->_view->headTitle('COUPONshop');
    }

    protected function _initDefaultModuleAutoloader()
    {
    	$loader = Zend_Loader_Autoloader::getInstance();
		$loader->registerNamespace('App_');
        $this->getResourceLoader()
             ->addResourceType('modelResource','models/resources','Resource');
    }

    protected function _initFrontControllerPlugin()
    {
    	$front = Zend_Controller_Front::getInstance();
    	$front->registerPlugin(new App_Controller_Plugin_Acl());
    }
    
    protected function _initDbParms()
    {
    	include_once (APPLICATION_PATH . '/../../include/connect.php');
		$db = new Zend_Db_Adapter_Pdo_Mysql(array(
    			'host'     => $HOST,
    			'username' => $USER,
    			'password' => $PASSWORD,
    			'dbname'   => $DB
				));  
		Zend_Db_Table_Abstract::setDefaultAdapter($db);
    }
}