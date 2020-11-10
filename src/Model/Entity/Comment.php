<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property int $author_id
 * @property string $content
 * @property int $message_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Message $message
 */
class Comment extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'author_id' => true,
        'content' => true,
        'message_id' => true,
        'user' => true,
        'message' => true,
    ];
}
