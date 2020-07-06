<?php


namespace App\Repositories;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;

class MessageRepository
{
    public function create($data)
    {
        return Model::create($data);
    }
}
