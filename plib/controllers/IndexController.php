<?php

class IndexController extends pm_Controller_Action
{

    public function indexAction()
    {
        $this->view->pageTitle = 'Syslog Watch';

        $lines = (int)$this->_getParam('lines', 20);

        $form = new pm_Form_Simple();
        $form->addElement('text', 'lines', [
            'value' => $lines,
            'label' => 'Lines of log file to be displayed (from the end of the file)',
        ]);
        $this->view->form = $form;

        $this->view->tools = [[
            'title' => 'Reload',
            'class' => 'sb-refresh',
            'link' => 'javascript:reloadSysLog()',
        ]];

        $this->view->content = pm_ApiCli::callSbin('readlog', [$lines], pm_ApiCli::RESULT_STDOUT);
    }

}
