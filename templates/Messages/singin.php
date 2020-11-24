<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message[]|\Cake\Collection\CollectionInterface $messages
 */
?>
<div class="messages form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Your name') ?></legend>
                <?php
                    __($this->Form->control('user'));
                    
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>