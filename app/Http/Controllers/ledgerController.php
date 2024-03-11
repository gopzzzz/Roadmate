<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


use App\Tbl_leadgers;
use App\Tbl_expenses;

use DB;
use Hash;
use Auth;
use Response;

class ledgerController extends Controller
{
    
    public function ledger_master(){
        
        $ledger=DB::table('tbl_leadgers')->orderBy('id', 'DESC')->get();
        
		$role=Auth::user()->user_type;
		return view('ledger.ledger_master',compact('ledger','role'));
	}

    public function ledger_masterinsert(Request $request){
		$ledger=new Tbl_leadgers;
		$ledger->ledger_name=$request->ledger_name;
		$ledger->save();
		return redirect('ledger_master')->with('success', 'Ledger inserted successfully.');
	}

    public function ledgerfetch(Request $request){
		$id=$request->id;
		$ledger=Tbl_leadgers::find($id);
		print_r(json_encode($ledger));
	}
	public function ledger_masteredit(Request $request){
		$id=$request->id;
		$ledger=Tbl_leadgers::find($id);
		$ledger->ledger_name=$request->ledger_name;
		$ledger->save();
		return redirect('ledger_master')->with('success', 'Ledger edited successfully.');
	}


    public function expense(){
        
        $ledger = DB::table('tbl_leadgers')->get();
        $staff = DB::table('tbl_crms')->get();

        $expense=DB::table('tbl_expenses')
        ->leftJoin('tbl_leadgers', 'tbl_expenses.ledger_id', '=', 'tbl_leadgers.id')
        ->leftJoin('tbl_crms', 'tbl_expenses.staff_id', '=', 'tbl_crms.id')
		->select(
			'tbl_expenses.*',
			'tbl_leadgers.ledger_name',
            'tbl_crms.crm_name'
		)
        ->get();
        
		$role=Auth::user()->user_type;
		return view('ledger.expense',compact('ledger','staff','expense','role'));
	}

    public function expenseinsert(Request $request){
		$expense=new Tbl_expenses;
		$expense->ledger_id=$request->ledger;
        $expense->amount=$request->amount;
        $expense->staff_id=$request->staff;
        $expense->remark=$request->remark;
		$expense->save();
		return redirect('expense')->with('success', 'Expense inserted successfully.');
	}

    public function expensefetch(Request $request){
		$id=$request->id;
		$expense=Tbl_expenses::find($id);
		print_r(json_encode($expense));
	}

    public function expensedit(Request $request){
		$id=$request->id;
		$expense=Tbl_expenses::find($id);
		$expense->ledger_id=$request->ledger;
        $expense->amount=$request->amount;
        $expense->staff_id=$request->staff;
        $expense->remark=$request->remark;
		$expense->save();
		return redirect('expense')->with('success', 'Expense edited successfully.');
	}

    public function expensedelete($id){
		DB::delete('delete from tbl_expenses where id = ?', [$id]);
		return redirect('expense')->with('success', 'Expense Deleted successfully.');
	}
	
}
