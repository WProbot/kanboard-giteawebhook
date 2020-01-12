Gitea Webhook
============

[![Build Status](https://travis-ci.org/kanboard/plugin-gogs-webhook.svg?branch=master)](https://travis-ci.org/kanboard/plugin-gogs-webhook)

Connect Gitea webhook events to Kanboard automatic actions.

Author
------

- Joël Schintgen
- License MIT

Requirements
------------

- Kanboard >= 1.0.37
- [Gitea](https://gitea.io/)
- Gitea webhooks configured for a project

Installation
------------

You have the choice between 3 methods:

1. Install the plugin from the Kanboard plugin manager in one click
2. Download the zip file and decompress everything under the directory `plugins/GiteaWebhook`
3. Clone this repository into the folder `plugins/GiteaWebhook`

Note: Plugin folder is case-sensitive.

Documentation
-------------

### List of supported events

- Gitea commit received

### List of supported actions

- Create a comment from an external provider
- Close a task

### Configuration

1. On Kanboard, go to the project settings and choose the section **Integrations**
2. Copy the Gitea webhook URL
3. On Gitea, go to the project settings and go to the section **Webhooks**
4. Add a new Gitea webhook and paste the Kanboard URL

### Examples

#### Close a Kanboard task when a commit pushed to Gitea

- Choose the event: **Gitea commit received**
- Choose action: **Close the task**

When one or more commits are sent to Gitea, Kanboard will receive the information, each commit message with a task number included will be closed.

Example:

- Commit message: "Fix bug #1234"
- That will close the Kanboard task #1234

#### Add a comment when a commit received

- Choose the event: **Gitea commit received**
- Choose action: **Create a comment from an external provider**

The comment will contain the commit message and the URL to the commit.

Example:

- Commit message: "Added feature for #1234"
- That will add a new comment on the task #1234
