<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    protected $guarded = ['id'];

    public function items(){
        return Item::where('name','like',"%{$this->name}%")->get();
    }

    public function finished_users(){
        $items = $this->items();
        foreach($items as $item){
            $transfers = $item->transfers;
            foreach($transfers as $transfer){
                $users[] = $transfer->to_user_id;
            }
        }
        return User::find($users);
    }

}
