<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Button extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'button_name',
        'button_slug',
        'is_del'
    ];

    public function Add_Edit_ButtonData($req)
    {
        $data = array(
            'button_name' => $req['button_name'],
            'button_slug' => $req['button_slug'],
            'is_del' => $req['is_del'],
        );
        if ($req['id']) {
            DB::table('buttons')->where('id', $req['id'])->update($data);
            return response()->json(['success' => 'Update Successfully..']);
        } else {
            DB::table('buttons')->insert($data);
            return response()->json(['success' => 'Button data added..']);
        }
    }

    public function Delete_ButtonData($req)
    {
        DB::table('buttons')->where('id', $req['id'])->delete();
        return response()->json(['success' => 'Delete Successfully..']);
    }
}
