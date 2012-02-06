<?php
/**
 * PluginBase is the parent class for every plugin.
 *
 * @author Jaisen Mathai <jaisen@jmathai.com>
 */
class PluginBase extends BaseModel
{
  private $plugin, $pluginName, $pluginConf = null;
  public function __construct($params = null)
  {
    parent::__construct();
    $this->pluginName = preg_replace('/Plugin$/', '', get_class($this));
    if(isset($params['plugin']))
      $this->plugin = $params['plugin'];
    else
      $this->plugin = getPlugin();
  }

  public function defineConf()
  {
    return null;
  }

  public function getConf()
  {
    if($this->pluginConf !== null)
      return $this->pluginConf;

    $this->pluginConf = new stdClass;
    $conf = $this->plugin->loadConf($this->pluginName);
    foreach($conf as $name => $value)
      $this->pluginConf->$name = $value;

    return $this->pluginConf;
  }

  public function onAction($params)
  {
    $this->logger->info('Plugin onAction called');
  }

  public function onBodyBegin($params = null)
  {
    $this->logger->info('Plugin onBodyBegin called');
  }

  public function onBodyEnd($params = null)
  {
    $this->logger->info('Plugin onBodyEnd called');
  }

  public function onHead($params = null)
  {
    $this->logger->info('Plugin onHead called');
  }

  public function onLoad($params = null)
  {
    $this->logger->info('Plugin onLoad called');
  }

  public function onView($params)
  {
    $this->logger->info('Plugin onView called');  
  }
}
