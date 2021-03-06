<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 *
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Message'), ['action' => 'edit', $message->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Message'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Message'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="messages view content">
            <h3><?= __($message->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= __($message->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $message->has('user') ? $this->Html->link($message->user->name, ['controller' => 'Users', 'action' => 'view', $message->user->id]) : '' ?></td>
                </tr>
                <!-- <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($message->id) ?></td>
                </tr> -->
            </table>
            <div class="text">
                <strong><?= __('Preview') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($message->preview)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Content') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($message->content)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Comments') ?></h4>
               
                <div class="table-responsive">
                    <table>
                        <tr>
                            
                            <th><?= __('Author') ?></th>
                            <th><?= __('Comment') ?></th>
                           
                            
                        </tr>
                        <?php foreach ($allComments as $value) : ?>
                        <tr>
                            
                            <td><?= __($value->user->name) ?></td>
                            <td><?= __($value->content) ?></td>
                            
                          
                        </tr>
                        <?php endforeach; ?> 
                        

                    </table>
                    
                </div>
      
            </div>

            <div class="column-responsive column-80">
        <div class="messages form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Add comments') ?></legend>
                <?php
                    echo __($this->Form->control('commentContent'));
                        
                   
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <a href='<?= "/{$message->id}/comments/add" ?>'><?= __("Add comment")?></a>
    </div>
    </div>
</div>


