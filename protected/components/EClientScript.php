<?php

class EClientScript extends CClientScript
{
    protected $dependencies = array();
    protected $priority = array();

    public function renderHead(&$output)
    {
        $cssFilesOrdered = array();
        $currentCssFiles = $this->cssFiles;

        if (!empty($this->priority)){
            # assign 0 to anything without a specific priority
            # can't do this in the register method because not every CSS file that ends up here used it
            $cssFilesWithPrioritySet = array_keys($this->priority);
            foreach ($currentCssFiles as $path => $v){
                if (!in_array($path, $cssFilesWithPrioritySet)){
                    $this->priority[$path] = 0;
                }
            }

            asort($this->priority);
            foreach ($this->priority as $path => $id){
                $cssFilesOrdered[$path] = $currentCssFiles[$path];
                unset($currentCssFiles[$path]);
            }
            # add any remaining CSS files that didn't have an order specified
            $cssFilesOrdered += $currentCssFiles;
        }

        if (!empty($cssFilesOrdered)){
            $this->cssFiles = $cssFilesOrdered;
        }

        parent::renderHead($output);
    }

    public function registerCssFile($url, $media = '', $order = null)
    {
        $this->setOrder($url, $order);
        return parent::registerCssFile($url, $media);
    }

    public function registerCss($id, $css, $media = '', $order = null)
    {
        $this->setOrder($id, $order);
        return parent::registerCss($id, $css, $media);
    }

    private function setOrder($identifier, $order)
    {
        if (!is_null($order)){
            if (is_array($order)){
                $this->dependencies[$identifier] = $order;
            } elseif (is_numeric($order)){
                $this->priority[$identifier] = $order;
            }
        }
    }
}