<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class SecurityQuestion extends Model
{
    protected $table = 'nm_secquestion';

    protected $fillable = ['name'];

    protected $timestamp = false;

    public static function get_all_active_quesiton_list(){
        return DB::table('nm_secquestion')->where('status', 1)->get();
    }

    public static function save_secq_detail($entry)
    {
        return DB::table('nm_secquestion')->insert($entry);
    }

    public static function view_secq_detail()
    {
        return DB::table('nm_secquestion')->get();

    }

    public static function showindividual_secq_detail($id)
    {
        return DB::table('nm_secquestion')->where('id', '=', $id)->get();
    }

    public static function delete_secq_detail($id)
    {
        return DB::table('nm_secquestion')->where('id', '=', $id)->delete();
    }

    public static function update_secq_detail($id, $entry)
    {
        return DB::table('nm_secquestion')->where('id', '=', $id)->update($entry);
    }

    public static function update_status_secq($id, $status)
    {
        return DB::table('nm_secquestion')->where('id', '=', $id)->update(array('status' => $status));

    }
}

?>
