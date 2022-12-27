<?php
if (!defined("_PS_VERSION_")) {
	exit;
}

// Main class, gets called when module hets loaded
class DiscordNotifyer extends Module {
	public function __construct() {
		$this->name = "DiscordNotifyer";
		$this->tab = "checkout";
		$this->version = "1.0.0";
		$this->author = "Kelvin de Reus";
		$this->need_instance = 0;
		// Checks compatiblity
		$this->ps_versions_compliancy = array("min" => "1.6", "max" => "1.8.99.99");
		$this->bootstrap = true;

		parent::__construct();

		$this->displayName = $this->l("DiscordNotifyer");
		$this->description = $this->l("Sends notification to Discord on order and contact");

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
