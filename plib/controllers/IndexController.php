<?php
// Copyright 1999-2014. Parallels IP Holdings GmbH. All Rights Reserved.
class IndexController extends pm_Controller_Action
{
    protected $_accessLevel = 'admin';

    public function indexAction()
    {
        $this->view->pageTitle = $this->lmsg('pageTitle');

        $lines = (int)$this->_getParam('lines', 20);

        $form = new pm_Form_Simple();
        $form->setAction(pm_Context::getBaseUrl());
        $form->setMethod(pm_Form_Simple::METHOD_GET);
        $form->setEnctype(pm_Form_Simple::ENCTYPE_MULTIPART);
        $form->addElement('text', 'lines', [
            'value' => $lines,
            'label' => $this->lmsg('lines'),
        ]);
        $form->addElement('checkbox', 'autoUpdate', [
            'value' => (bool)$this->_getParam('autoUpdate', true),
            'label' => $this->lmsg('autoUpdate'),
        ]);
        $this->view->form = $form;

        $this->view->tools = [[
            'title' => $this->lmsg('reload'),
            'class' => 'sb-refresh',
            'link' => 'javascript:reloadSysLog()',
        ]];

        $logData = pm_ApiCli::callSbin('readlog', [$lines], pm_ApiCli::RESULT_STDOUT);
        $logData = trim($logData);
        list ($this->view->total, $this->view->content) = explode("\n", $logData, 2);
    }

    public function dataAction()
    {
        $from = (int)$this->_getParam('from', 0);
        echo pm_ApiCli::callSbin('readlog', [0, $from], pm_ApiCli::RESULT_STDOUT);
        exit;
    }
}
