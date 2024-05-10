<?php

namespace MF\Controller;

abstract class Action
{

    protected $viewData;
    protected $setHtmlData;

    public function __construct()
    {
        $this->viewData = new \stdClass();
        $this->setHtmlData = new \stdClass();
    }

    protected function render($view, $layout = 'layout')
    {

        $this->viewData->page = $view;

        if (file_exists('../app/Views/' . $layout . '.phtml')) {
            require_once '../app/Views/' . $layout . '.phtml';
        } else {
            $this->content();
        }
    }


    protected function content()
    {
        $actualClass = str_replace('App\\Controllers\\', '', get_class($this));
        $viewLocation = str_replace('Controller', '', $actualClass);
        $viewLocation = lcfirst($viewLocation);
        require_once "../app/Views/" . $viewLocation . "/" . $this->viewData->page . ".phtml";
    }
}
