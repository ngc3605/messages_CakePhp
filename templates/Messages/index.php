<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message[]|\Cake\Collection\CollectionInterface $messages
 */
?>
<div class="messages index content">
  



    <h3><?= __('Messages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('preview') ?></th>
                    <th><?= $this->Paginator->sort('author_id') ?></th>
                    <th class="actions"><?= __('Действия') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                <tr>
                    
                    <td><?= h($message->title) ?></td>
                    <td><?= h($message->preview) ?></td>
                    <td><?= $message->has('user') ? $this->Html->link($message->user->name, ['controller' => 'Users', 'action' => 'view', $message->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Просмотреть'), ['action' => 'view', $message->id]) ?>
                        <?= $this->Html->link(__('Редактировать'), ['action' => 'edit', $message->id]) ?>
                        <?= $this->Form->postLink(__('Удалить'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
    <a href="/messages/add">Новое сообщение</a><hr>
    <a href="/users/logout">Выйти</a>
</div>
