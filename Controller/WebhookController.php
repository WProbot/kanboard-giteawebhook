<?php

namespace Kanboard\Plugin\GiteaWebhook\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Plugin\GiteaWebhook\WebhookHandler;

/**
 * Webhook Controller
 *
 * @package  controller
 * @author   Joël Schintgen
 */
class WebhookController extends BaseController
{
    /**
     * Handle Gitea webhooks
     *
     * @access public
     */
    public function handler()
    {
        $this->checkWebhookToken();

        $handler = new WebhookHandler($this->container);
        $handler->setProjectId($this->request->getIntegerParam('project_id'));

        $result = $handler->parsePayload(
            $this->request->getHeader('X-Gitea-Event'),
            $this->request->getJson()
        );

        $this->response->text($result ? 'PARSED' : 'IGNORED');
    }
}
