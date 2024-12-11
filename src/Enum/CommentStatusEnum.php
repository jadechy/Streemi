<?php 

namespace App\Enum;

enum CommentStatusEnum: string 
{
    case VALIDATED = 'validated';
    case WAITING = 'waiting';
    case REJECTED = 'rejected';
}