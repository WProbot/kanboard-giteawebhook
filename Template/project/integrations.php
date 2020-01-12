<h3><img src="<?= $this->url->dir() ?>plugins/GiteaWebhook/gitea-icon.png"/>&nbsp;<?= t('Gitea webhooks') ?></h3>
<div class="panel">
    <input type="text" class="auto-select" readonly="readonly" value="<?= $this->url->href('WebhookController', 'handler', array('plugin' => 'GiteaWebhook', 'token' => $webhook_token, 'project_id' => $project['id']), false, '', true) ?>"/>
    <p class="form-help"><a href="https://github.com/schintgenj/kanboard-giteawebhook#documentation" target="_blank"><?= t('Help on Gitea webhooks') ?></a></p>
</div>
