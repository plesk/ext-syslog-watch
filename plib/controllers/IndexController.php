<?php

class IndexController extends pm_Controller_Action
{

    public function indexAction()
    {
        $this->view->pageTitle = 'Syslog Watch';

        $this->view->tools = [[
            'title' => 'Reload',
            'class' => 'sb-refresh',
            'link' => pm_Context::getBaseUrl(),
        ]];

        $this->view->content = pm_ApiCli::callSbin('readlog', [], pm_ApiCli::RESULT_STDOUT);
    }

}
