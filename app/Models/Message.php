<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $recipient_id
 * @property int $sender_id
 * @property string $topic
 * @property string $message
 * @property int $report_id
 * @property bool $is_viewed
 * @property bool $is_archived
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'target',
        'owner',
        'topic',
        'message',
        'report_id',
        'is_viewed',
        'is_archived',
    ];
}
