<div class="table-responsive">          
    <table class="table table-bordered">
        <thead>
            <tr style="background-color: #F3EFB4;">
                <th>#</th>
                <th>Material Id</th>
                <th>Name Of Material</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $slno   =   1;
                if(isset($productContainer) && !empty($productContainer)){
                    foreach($productContainer as $reportData){  
            ?>
            <tr style="background-color: #BCC6CC;">
                <td>Category</td>
                <td>ID</td>
                <td colspan="5"><?php echo $reportData['parent_details']['parentName'] ?></td>
            </tr>
            <tr style="background-color: #F9F8F6;">
                <td>Sub Category</td>
                <td>ID</td>
                <td colspan="5"><?php echo $reportData['parent_details']['subParentName'] ?></td>
            </tr>
            <?php
                $proSl  =   1;
                foreach($reportData['product_details'] as $productData){  
            ?>
            <tr>
                <td><span class="pull-right">{{ $proSl++ }}</span></td>
                <td>ID</td>
                <td><span class="pull-right">{{ $productData['product_name'] }}</span></td>
                <td>{{ $productData['unit_name'] }}</td>
                <td>{{ $productData['quantity'] }}</td>
                <td>{{ $productData['mbprice'] }}</td>
                <td>{{ $productData['mbprice'] * $productData['quantity']  }}</td>
            </tr>
            
            <?php  }}}else{ ?>
            <tr>
                <td colspan="7">No Data Found</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>