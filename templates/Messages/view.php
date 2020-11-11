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
            <h3><?= h($message->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($message->title) ?></td>
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
               <?php if (!empty($message->comments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            
                            <th><?= __('Author') ?></th>
                            <th><?= __('Comment') ?></th>
                           
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($message->comments as $comments) : ?>
                        <tr>
                            
                            <td><?= h($message->user->name) ?></td>
                            <td><?= h($comments->content) ?></td>
                            
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?> 
                        

                    </table>
                    
                </div>
                <?php endif; ?>
            </div>

            <div class="column-responsive column-80">
        <div class="messages form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Add comments') ?></legend>
                <?php
                    echo $this->Form->control('commentContent');
                        
                   
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
       
     
    </div>

        </div>
    </div>
</div>
