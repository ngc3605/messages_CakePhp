<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Все сообщения'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="messages form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Добавить сообщение') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('preview');
                    echo $this->Form->control('content');
                    // echo $this->Form->control('author_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Добавить')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
