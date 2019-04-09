<?php
namespace App\Http\Controllers\Backend\ProductChallan;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductChallanController
 *
 * @author Tanveer Qureshee
 */
class ProductChallanController extends Controller
{
    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index()
    {
//        $plantEquipments     = ItemsModel::all();
        return new ViewResponse('backend.product_challan.index', compact('plantEquipments'));
    }
    
    public function create(){
        $receiveCode   = $this->generateReceivecode(); 
        return new ViewResponse('backend.product_challan.create', compact('receiveCode'));
    }
    
    public function generateReceivecode(){
        
        $rendomnumber   =   getDefaultCategoryCode('inv_issue', 'issue_id', '03d', '001');
        return 'ISS-'.$rendomnumber;
    }
    public function store(Request $request) {
        $inv_receive        =   [];
        $receive_products   =   '';
        $status             =   'error';
        //get mrrno:
        $mrrno  =   getDefaultCategoryCode('inv_issue', 'mrr_no', '03d', '001');
        // Create a new validator instance
        $whereParam     =   [
            'receive_no'    =>  $request->receive_no
        ];
        $existingProduct    =   DB::table('temp_product_receive_data')->where($whereParam)->get();
        if(!$existingProduct->isEmpty()){
            $total_quantity =   0;
            $SubTotal       =   0;
            $grandTotal     =   0;
            foreach($existingProduct as $rcvProduct){
                
                $SubTotal               =   0;
                $SubTotal               =   $rcvProduct->quantity * $rcvProduct->unit_price;
                $grandTotal             =   $grandTotal+$SubTotal;
                $supplier_id            =   $rcvProduct->supplier_id;
                $receive_ware_hosue_id  =   $rcvProduct->project_id;
                $total_quantity         =   $total_quantity+$rcvProduct->quantity;
                
                // make data for inv receive details table data
                $inv_issuedetail[]    =   [
                    'issue_id'          =>    $mrrno,
                    'material_id'       =>    $rcvProduct->product_id,
                    'expense_acct_id'   =>    '1',
                    'cost_center'       =>    '1',
                    'issue_qty'         =>    $rcvProduct->quantity,
                    'issue_price'       =>    $rcvProduct->unit_price,
                    'sl_no'             =>    '1',
                    'total_issue'       =>    number_format((float)$SubTotal, 2, '.', ''),
                    'sales_price'       =>    0,
                    'total_sales'       =>    0,
                    'sales_profit'      =>    0,
                    'sales_margin'      =>    0,
                    'id_serial_id'      =>    '1',
                ];
                
                
                // make data for inv receive details table
                $inv_materialbalance[]    =   [
                    'mb_ref_id'             =>    $mrrno,
                    'mb_materialid'         =>    $rcvProduct->product_id,
                    'mb_date'               =>    (isset($request->mrr_date) && !empty($request->mrr_date) ? date('Y-m-d h:i:s', strtotime($request->mrr_date)) : date('Y-m-d h:i:s')),
                    'mbin_qty'              =>    0,
                    'mbin_val'              =>    0,
                    'mbout_qty'             =>    $rcvProduct->quantity,
                    'mbout_val'             =>    $SubTotal,
                    'mbprice'               =>    $rcvProduct->unit_price,
                    'mbtype'                =>    'Issue',
                    'mbserial'              =>    '1.1',//$receive_ware_hosue_id,
                    'mbunit_id'             =>    $receive_ware_hosue_id,//'1',
                    'mbserial_id'           =>    '0',//'1',
                    'jvno'                  =>    $mrrno,//$total_quantity,
                ];
                
                
            }// end of foreach for all receieve temp table;
            
            // make data for inv_receive table
            $inv_issue    =   [
                'issue_id'              =>    $mrrno,
                'issue_date'            =>    (isset($request->mrr_date) && !empty($request->mrr_date) ? date('Y-m-d h:i:s', strtotime($request->mrr_date)) : date('Y-m-d h:i:s')),                
                'buyer_id'              =>    $supplier_id,
                'posted_to_gl'          =>    '1',
                'remarks'               =>    'test',//$request->remarks,
                'issue_type'            =>    'Issue',
                'issue_unit_id'         =>    $receive_ware_hosue_id,
                'chk_year_end'          =>    '1',
                'issue_total'           =>    number_format((float)$grandTotal, 2, '.', ''),
                'no_of_material'        =>    $total_quantity,
            ];
        }
        // Begin Transaction
        DB::beginTransaction();
        try{
            $status =   'success';
            // insert into:inv_receive
            DB::table('inv_issue')->insert($inv_issue);
            // insert into:inv_receivedetail
            DB::table('inv_issuedetail')->insert($inv_issuedetail);
            // insert into:inv_materialbalance
            DB::table('inv_materialbalance')->insert($inv_materialbalance);

            // Commit Transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }
        $feedback_data          =   [
            'status'            =>  $status,
            'redirect_route'    =>  route('admin.product_challan.create'),
            'data'              =>  $receive_products
        ];
        echo json_encode($feedback_data);        
    }
    
    public function product_issue_list(){
        $product_issue_list     = DB::table('inv_issue')->orderBy('issue_date', 'DESC')->get();
        return new ViewResponse('backend.product_challan.product_issue_list', compact('product_issue_list'));
    }
    
    public function product_issue_view(Request $request){
        $inv_receive            =   DB::table('inv_issue')->where('issue_id', $request->issue_id)->first();
        $products               =   DB::table('inv_issuedetail')->where('issue_id', $request->issue_id)->get();
        $details_data           =   View::make('backend.partial.product_issue_view', compact('products', 'inv_receive'));
        $feedback_data          =   [
            'status'            =>  'success',
            'data'              =>  $details_data->render()
        ];
        echo json_encode($feedback_data);
    }
    
    public function edit($edit_id){
        $datas   =   [
            'editData'  =>  ItemsModel::where('id', $edit_id)->first()
        ];
        return new ViewResponse('backend.product_receive.edit',$datas);
    }
    public function update(Request $request){
        $equipment                      = ItemsModel::find($request->edit_id);
        $equipment->name        = $request->name;
        $equipment->save();
        return new RedirectResponse(route('admin.product_receive.index'), ['flash_success' => trans('alerts.backend.product_receive.updated')]); 
    }
    
    public function delete($deleteId){
        $deletedRows = ItemsModel::where('id', $deleteId)->delete();
        return new RedirectResponse(route('admin.product_receive.index'), ['flash_success' => trans('alerts.backend.product_receive.deleted')]);
    }
    
    public function process_product_issue_url(Request $request) {
        $all = $request->all();
        $status         =   '';
        $feedbackData   =   '';
        $rules = [
            'receive_date' => 'required',
            'receive_no' => 'required',
            'product_id' => 'required',
            'part_no' => 'required',
            'quantity' => 'required',
            'project_id' => 'required',
        ];
        $messages = [
            'receive_date.required' => 'Receive Date is required!',
            'receive_no.required' => 'Receive No required!',
            'product_id.required' => 'Product is required!',
            'part_no.required' => 'Part No is required!',
            'quantity.required' => 'Quantity is required!',
            'project_id.required' => 'Project is required!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $status         =   'validation_error';
            $feedbackData   =   $validator->errors();
        } else {
            // get product last unit price:
            $productUnitDetails     =   DB::table('inv_receivedetail')->where('material_id', $request->product_id)->orderBy('id', 'DESC')->first();
            $productUnitPrice       =   $productUnitDetails->unit_price;
            
            // get product Supplier id:
            $supplier_id     =   DB::table('inv_receive')->where('mrr_no', $productUnitDetails->mrr_no)->first()->supplier_id;            
            $productsData = [
                'receive_date'  => $request->receive_date,
                'receive_no'    => $request->receive_no,
                'product_id'    => $request->product_id,
                'supplier_id'   => $supplier_id,
                'part_no'       => $request->part_no,
                'quantity'      => $request->quantity,
                'unit_price'    => $productUnitPrice,
                'project_id'    => $request->project_id
            ];

            // check product is already in the receive form:
            $whereParam = [
                'mb.mb_materialid' => $request->product_id,
            ];
            $existingProductQty = DB::table('inv_materialbalance as mb')
                            ->select(DB::raw("(SUM(mb.mbin_qty)-SUM(mb.mbout_qty)) as BalanceQty"))
                            ->where($whereParam)->first();

            if ($existingProductQty->BalanceQty < $request->quantity) {
                $status         =   'qty_error';
                $feedbackData   =   'Insufficient quantity';
            } else {                
                // check product is already in the receive form:
                $whereParam     =   [
                    'receive_no'    =>  $request->receive_no,
                    'product_id'    =>  $request->product_id,
                ];
                $existingProduct    =   DB::table('temp_product_receive_data')->where($whereParam)->first();
                if (isset($existingProduct) && !empty($existingProduct)) {
                    $updateQuantity = $existingProduct->quantity + $request->quantity;
                    $updateData = [
                        'quantity' => $updateQuantity,
                    ];
                    DB::table('temp_product_receive_data')
                            ->where('id', $existingProduct->id)
                            ->update($updateData);
                } else {
                    DB::table('temp_product_receive_data')->insert($productsData);
                }                
                // Now update the generated dom file 
                $product_receive_no = $request->receive_no;
                $products = DB::table('temp_product_receive_data')->where('receive_no', $request->receive_no)->get();
                $details_data = View::make('backend.partial.process_product_issue_table', compact('products', 'product_receive_no', 'productUnitPrice'));
                $status         =   'success';
                $feedbackData   =   $details_data->render();
            }
        }
        $feedback_data = [
            'status'    => $status,
            'data'      => $feedbackData
        ];
        echo json_encode($feedback_data);
    }

    public function process_product_receive_delete_url(Request $request){
        $products   =   '';
        $deletedRows = DB::table('temp_product_receive_data')->where('id', $request->delete_id)->delete();
        // Now update the generated dom file 
        $products_data           =   DB::table('temp_product_receive_data')->where('receive_no', $request->receive_no)->get();
        
        if(!$products_data->isEmpty()){
            $products = $products_data;
            $product_receive_no =   $request->receive_no;
            $details_data   =   View::make('backend.partial.process_product_receive_table', compact('products', 'product_receive_no'));
            $feedback_data  =   [
                'status'            =>  'success',
                'data'              =>  $details_data->render()
            ];
            echo json_encode($feedback_data);
        }else{
            $feedback_data  =   [
                'status'            =>  'error',
                'data'              =>  ''
            ];
            echo json_encode($feedback_data);
        }        
    }
}
