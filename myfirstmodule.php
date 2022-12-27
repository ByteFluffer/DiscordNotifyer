<?php
if (!defined("_PS_VERSION_")) {
	exit;
}


class MyFirstModule extends Module {
	public function __construct() {
		$this->name = "myfirstmodule";
		$this->tab = "checkout";
		$this->version = "1.0.0";
		$this->author = "Kelvin de Reus";
		$this->need_instance = 0;
		$this->ps_versions_compliancy = array("min" => "1.6", "max" => _PS_VERSION_);
		$this->bootstrap = true;

		parent::__construct();

		$this->displayName = $this->l("myfirstmodule");
		$this->description = $this->l("This is my very first module.");

		$this->confirmUninstall = $this->l("Are you sure you want to uninstall?");
	}
	
	// Gets called when module gets installed
	public function install()
	{
    if (Shop::isFeatureActive()) {
        Shop::setContext(Shop::CONTEXT_ALL);
    }

   return (
        parent::install() 
        && $this->registerHook("displayLeftColumn")
        && $this->registerHook("displayHeader")
        && Configuration::updateValue("MYMODULE_NAME", "my friend")
    ); 
	}
	
	// Gets called when module gets uninstalled
	public function uninstall() {
		if (
			!parent::uninstall()
		) {
			return false;
		} else {
			return true;
		}
	}
	
}
