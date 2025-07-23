<?php

namespace Modules\Customerpanel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Models\Customer;
// use Modules\Customerpanel\Database\Factories\ChatThreadFactory;

class ChatThread extends Model
{
    use HasFactory;

    protected $table="chat_threads";
    protected $fillable = ['sender_id', 'receiver_id'];

    public function sender() {
        return $this->belongsTo(Customer::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(Customer::class, 'receiver_id');
    }

    // protected static function newFactory(): ChatThreadFactory
    // {
    //     // return ChatThreadFactory::new();
    // }
}
