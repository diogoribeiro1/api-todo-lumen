<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';

    protected $fillable = [
        'title',
        'description',
        'done',
        'done_at'
    ];

    public function done(): void
    {
        $this->update([
            'done' => true,
            'done_at'=> Carbon::now()
        ]);
    }

    public function undone(): void
    {
        $this->update([
            'done' => false,
            'done_at'=> null
        ]);
    }

}
