<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Button;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\DB;

class ButtonController extends Controller
{
    protected $Button;
    public function __construct()
    {
        $this->Button = new Button();
    }

    public function index()
    {
        return view('button');
    }

    public function Get_ButtonData(Request $req)
    {
        if ($req->ajax()) {
            $builder = DB::table('buttons');
            if ($req->status_id != "") {
                $builder->where('is_del', $req->status_id);
            }
            $builder->select('id', 'button_name', 'button_slug', 'is_del');
            $result = $builder->get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $update_btn = '<button title="' . $row->button_name . '" class="btn btn-link edit_appdata" onclick="edit_buttondata(this)" data-val="' . $row->id . '"><i class="far fa-edit"></i></button>';
                    $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->button_name . '" class="btn btn-link" onclick="delete_buttondata(this)" data-val="' . $row->id . '" tabindex="-1"><i class="fa fa-trash-alt tx-danger"></i></button>';
                    return $update_btn . $delete_btn;
                })
                ->addColumn('status', function ($row) {
                    $statusList = array(
                        array("info" => "Enable"),
                        array("danger" => "Disable")
                    );
                    $iStatus = $statusList[$row->is_del];
                    $Status_btn = '<span style="color:white"; class="label p-1 label-sm bg-' . (key($iStatus)) . '">' . (current($iStatus)) . '</span>';
                    return $Status_btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        // return DataTables::of(Button::query())
        //     ->addColumn('action', function ($row) {
        //         $update_btn = '<button title="' . $row->button_name . '" class="btn btn-link edit_appdata" onclick="edit_buttondata(this)" data-val="' . $row->id . '"><i class="far fa-edit"></i></button>';
        //         $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->button_name . '" class="btn btn-link" onclick="delete_buttondata(this)" data-val="' . $row->id . '" tabindex="-1"><i class="fa fa-trash-alt tx-danger"></i></button>';
        //         return $update_btn . $delete_btn;
        //     })
        //     ->addColumn('status', function ($row) {
        //         $statusList = array(
        //             array("info" => "Enable"),
        //             array("danger" => "Disable")
        //         );
        //         $iStatus = $statusList[$row['is_del']];
        //         $Status_btn = '<span style="color:white"; class="label p-1 label-sm bg-' . (key($iStatus)) . '">' . (current($iStatus)) . '</span>';
        //         return $Status_btn;
        //     })
        //     ->rawColumns(['action', 'status'])
        //     ->make(true);
    }

    public function Add_Edit_ButtonData(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'button_name' => 'required',
            'button_slug' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data = $this->Button->Add_Edit_ButtonData($req->all());
            return $data;
        }
    }

    public function Edit_ButtonData($id)
    {
        $app_Data = Button::Where('id', $id)->first();
        if ($app_Data) {
            return response()->json(['edit_data' => $app_Data]);
        } else {
            return response()->json(['error' => "Button data not found"]);
        }
    }

    public function Delete_ButtonData(Request $req)
    {
        $data = $this->Button->Delete_ButtonData($req->all());
        return $data;
    }
}
