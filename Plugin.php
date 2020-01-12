<?php

namespace Kanboard\Plugin\GiteaWebhook;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Security\Role;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->actionManager->getAction('\Kanboard\Action\CommentCreation')->addEvent(WebhookHandler::EVENT_ISSUE_COMMENT);
        $this->actionManager->getAction('\Kanboard\Action\CommentCreation')->addEvent(WebhookHandler::EVENT_COMMIT);
        $this->actionManager->getAction('\Kanboard\Action\TaskAssignUser')->addEvent(WebhookHandler::EVENT_ISSUE_ASSIGNEE_CHANGE);

        $this->actionManager->getAction('\Kanboard\Action\TaskClose')->addEvent(WebhookHandler::EVENT_COMMIT);
        $this->actionManager->getAction('\Kanboard\Action\TaskClose')->addEvent(WebhookHandler::EVENT_ISSUE_CLOSED);
        $this->actionManager->getAction('\Kanboard\Action\TaskCreation')->addEvent(WebhookHandler::EVENT_ISSUE_OPENED);
        $this->actionManager->getAction('\Kanboard\Action\TaskOpen')->addEvent(WebhookHandler::EVENT_ISSUE_REOPENED);

        $this->template->hook->attach('template:project:integrations', 'GiteaWebhook:project/integrations');
        $this->route->addRoute('/webhook/gitea/:project_id/:token', 'WebhookController', 'handler', 'GiteaWebhook');
        $this->applicationAccessMap->add('WebhookController', 'handler', Role::APP_PUBLIC);
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');

        $this->eventManager->register(WebhookHandler::EVENT_COMMIT, t('Gitea commit received'));
        $this->eventManager->register(WebhookHandler::EVENT_ISSUE_OPENED, t('Gitea issue opened'));
        $this->eventManager->register(WebhookHandler::EVENT_ISSUE_CLOSED, t('Gitea issue closed'));
        $this->eventManager->register(WebhookHandler::EVENT_ISSUE_REOPENED, t('Gitea issue reopened'));
        $this->eventManager->register(WebhookHandler::EVENT_ISSUE_ASSIGNEE_CHANGE, t('Gitea issue assignee change'));
        $this->eventManager->register(WebhookHandler::EVENT_ISSUE_COMMENT, t('Gitea issue comment created'));
    }

    public function getPluginName()
    {
        return 'Gitea Webhook';
    }

    public function getPluginDescription()
    {
        return t('Bind Gitea webhook events to Kanboard automatic actions');
    }

    public function getPluginAuthor()
    {
        return 'Joël Schintgen';
    }

    public function getPluginVersion()
    {
        return '0.0.1';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/schintgenj/kanboard-giteawebhook';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.37';
    }
}
