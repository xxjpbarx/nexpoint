<?php include '../db_connect.php' ?>
<style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}
    .bg-gradient-primary{
        background: rgb(119,172,233);
        background: linear-gradient(149deg, rgba(119,172,233,1) 5%, rgba(83,163,255,1) 10%, rgba(46,51,227,1) 41%, rgba(40,51,218,1) 61%, rgba(75,158,255,1) 93%, rgba(124,172,227,1) 98%);
    }
    .btn-primary-gradient{
        background: linear-gradient(to right, #1e85ff 0%, #00a5fa 80%, #00e2fa 100%);
    }
    .btn-danger-gradient{
        background: linear-gradient(to right, #f25858 7%, #ff7840 50%, #ff5140 105%);
    }
    main .card{
        height:calc(100%);
    }
    main .card-body{
        height:calc(100%);
        overflow: auto;
        padding: 5px;
        position: relative;
    }
    main .container-fluid, main .container-fluid>.row,main .container-fluid>.row>div{
    }
    #o-list{
        max-height: 400px; /* Adjust the height as needed */
        overflow-y: auto;  /* Enable vertical scroll */
    }
    #calc{
        position: absolute;
        bottom: 1rem;
        height: calc(10%);
        width: calc(98%);
    }
    .prod-item{
        min-height: 12vh;
        cursor: pointer;
    }
    .prod-item:hover{
        opacity: .8;
    }
    .prod-item .card-body {
        display: flex;
        justify-content: center;
        align-items: center;

    }
    input[name="qty[]"]{
        width: 30px;
        text-align: center
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    #cat-list{
        /*height: calc(100%)*/
    }
    .cat-item{
        cursor: pointer;
    }
    .cat-item:hover{
        opacity: .8;
    }
</style>
<?php 

// Fetch the maximum order number
$result = $conn->query("SELECT MAX(order_number) AS max_order_number FROM orders");

// Default to 1 if no orders exist
$next_order_number = 1;

if ($result && $row = $result->fetch_assoc()) {
    if (!is_null($row['max_order_number'])) {
        $next_order_number = $row['max_order_number'] + 1;
    }
}
if(isset($_GET['id'])):
$order = $conn->query("SELECT * FROM orders where id = {$_GET['id']}");
foreach($order->fetch_array() as $k => $v){
    $$k= $v;
}
$items = $conn->query("SELECT o.*,p.name FROM order_items o inner join products p on p.id = o.product_id where o.order_id = $id ");
endif;
?>
<div class="container-fluid o-field">
    <div class="row mt-3 ml-3 mr-3">
        <!-- Column for Products -->
        <div class="col-lg-8 p-field">
            <div class="card">
                <div class="card-header text-dark">
                    <b>Products</b>
                </div>
                <div class="card-body row" id="prod-list">
                    <div class="col-md-12">
                        <!-- Category list -->
                        <div class="row justify-content-start align-items-center" id="cat-list">
                            <div class="mx-3 cat-item" data-id="all">
                                <button class="btn btn-primary"><b class="text-white">All</b></button>
                            </div>
                            <?php 
                            $qry = $conn->query("SELECT * FROM categories ORDER BY name ASC");
                            while($row=$qry->fetch_assoc()):
                            ?>
                            <div class="mx-3 cat-item" data-id="<?php echo $row['id'] ?>">
                                <button class="btn btn-primary"><?php echo ucwords($row['name']) ?></button>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <hr>
                        <div class="row">
                            <?php
                            $prod = $conn->query("SELECT * FROM products WHERE status = 1 ORDER BY name ASC");
                            while($row=$prod->fetch_assoc()):
                            ?>
                            <div class="col-md-2 mb-2">
                                <div class="prod-item text-center" data-json='<?php echo json_encode($row) ?>' data-category-id="<?php echo $row['category_id'] ?>">
                                    <img src="../assets/uploads/element1.jpg" class="rounded" width="100%">
                                    <span><?php echo $row['name'] ?></span>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-center">
                        <div class="btn btn-primary btn-sm col-sm-3 mr-2" type="button" id="pay">Pay</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column for Order List -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-dark">
                    <b>Order List</b>
                    <span class="float">
                        <a class="btn btn-primary btn-sm col-sm-3 float-right" href="../index.php">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <form action="" id="manage-order">
                        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                        <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>"> <!-- Capture User ID -->


                        <div class="bg-white" id="o-list">
                            <div class="d-flex w-100 bg-white mb-1">
                                <label for="" class="text-dark"><b>Order No.</b></label>
                                <span class="form-control-sm" style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 0.25rem;"><?php echo $next_order_number; ?></span>
                                <input type="hidden" name="order_number" value="<?php echo $next_order_number; ?>">
                            </div>
                            <table class="table bg-light mb-5">
                                <colgroup>
                                    <col width="20%">
                                    <col width="40%">
                                    <col width="40%">
                                    <col width="5%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>QTY</th>
                                        <th>Order</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($items)):
                                        while($row=$items->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="btn-minus"><b></b></span>
                                                <input type="number" name="qty[]" value="<?php echo $row['qty'] ?>">
                                                <span class="btn-plus"><b></b></span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="item_id[]" value="<?php echo $row['id'] ?>">
                                            <input type="hidden" name="product_id[]" value="<?php echo $row['product_id'] ?>">
                                            <?php echo ucwords($row['name']) ?>
                                            <small class="psmall"> (<?php echo number_format($row['price'],2) ?>)</small>
                                        </td>
                                        <td class="text-right">
                                             <input type="hidden" name="price[]" value="<?php echo $row['price'] ?>">
                                             <input type="hidden" name="amount[]" value="<?php echo $row['amount'] ?>">
                                              <span class="amount">₱<?php echo number_format($row['amount'],2) ?></span>
                                         </td>

                                        <td>
                                            <span class="btn-rem"><b><i class="fa fa-trash-alt"></i></b></span>
                                        </td>
                                    </tr>
                                    <script>
                                        $(document).ready(function(){
                                            qty_func();
                                            calc();
                                            cat_func();
                                        });
                                    </script>
                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-block bg-white" id="calc">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td><b><h6>Total</h6></b></td>
                                        <td class="text-right">
                                            <input type="hidden" name="total_amount" value="0">
                                            <input type="hidden" name="total_tendered" value="0">
                                            <span><h6><b id="total_amount">₱0.00</b></h6></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pay_modal" role='dialog'>
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"><b>Pay</b></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group">
                <label for="">Amount Payable</label>
                <input type="text" class="form-control text-right" id="apayable" readonly="" value="">
            </div>
            <div class="form-group">
                <label for="">Amount Tendered</label>
                <input type="text" class="form-control text-right" id="tendered" value="" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="">Change</label>
                <input type="text" class="form-control text-right" id="change" value="0.00" readonly="">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm"  form="manage-order">Pay</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Order Summary -->
        <div id="order-summary">
          <h6>Order List:</h6>
          <ul id="order-list"></ul> <!-- This will display the order list -->
          <h6>Total: <span id="order-total"></span></h6> <!-- This will display the total amount -->
        </div>
        <hr>
        Are you sure you want to proceed with the payment?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmPayment">Confirm</button>
      </div>
    </div>
  </div>
</div>



  <script>
    var total;
    cat_func();
    $('#prod-list .prod-item').click(function(){
        var data = $(this).attr('data-json');
        data = JSON.parse(data);
        if($('#o-list tr[data-id="'+data.id+'"]').length > 0){
            var tr = $('#o-list tr[data-id="'+data.id+'"]');
            var qty = tr.find('[name="qty[]"]').val();
            qty = parseInt(qty) + 1;
            qty = tr.find('[name="qty[]"]').val(qty).trigger('change');
            calc();
            return false;
        }
        var tr = $('<tr class="o-item"></tr>');
        tr.attr('data-id',data.id);
        tr.append('<td><div class="d-flex align-items-center"><span class="btn-minus"><b></i></b></span><input type="number" name="qty[]" id="" value="1"><span class=" btn-plus"><b></b></span></div></td>');

        tr.append('<td><input type="hidden" name="item_id[]" id="" value=""><input type="hidden" name="product_id[]" id="" value="'+data.id+'">'+data.name+' <small class="psmall">('+(parseFloat(data.price).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))+')</small></td>');

        tr.append('<td class="text-right"><input type="hidden" name="price[]" id="" value="'+data.price+'"><input type="hidden" name="amount[]" id="" value="'+data.price+'"><span class="amount">'+(parseFloat(data.price).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))+'</span></td>');

        tr.append('<td><span class="btn-rem"><b><i class="fa fa-trash-alt text"></i></b></span></td>');
        $('#o-list tbody').append(tr);
        qty_func();
        calc();
        cat_func();
    });

    function qty_func(){
        $('#o-list .btn-minus').click(function(){
            var qty = $(this).siblings('input').val();
            qty = qty > 1 ? parseInt(qty) - 1 : 1;
            $(this).siblings('input').val(qty).trigger('change');
            calc();
        });
        $('#o-list .btn-plus').click(function(){
            var qty = $(this).siblings('input').val();
            qty = parseInt(qty) + 1;
            $(this).siblings('input').val(qty).trigger('change');
            calc();
        });
        $('#o-list .btn-rem').click(function(){
            $(this).closest('tr').remove();
            calc();
        });
    }

    function calc(){
        $('[name="qty[]"]').each(function(){
            $(this).change(function(){
                var tr = $(this).closest('tr');
                var qty = $(this).val();
                var price = tr.find('[name="price[]"]').val();
                var amount = parseFloat(qty) * parseFloat(price);
                tr.find('[name="amount[]"]').val(amount);
                tr.find('.amount').text(parseFloat(amount).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}));
            });
        });

        var total = 0;
        $('[name="amount[]"]').each(function(){
            total = parseFloat(total) + parseFloat($(this).val());
        });
        console.log(total);
        $('[name="total_amount"]').val(total);
        $('#total_amount').text('₱' + parseFloat(total).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}));
    }

    function cat_func() {
    $('.cat-item').click(function() {
        var id = $(this).attr('data-id'); // Get the category ID from the clicked item
        console.log(id); // Log the ID to the console for debugging

        // Show or hide products based on the selected category
        if (id === 'all') {
            // Show all products
            $('.prod-item').parent().show(); // Use .show() instead of toggle(true)
        } else {
            // Hide all products first
            $('.prod-item').parent().hide();

            // Show only products that belong to the selected category
            $('.prod-item').each(function() {
                if ($(this).attr('data-category-id') === id) {
                    $(this).parent().show(); // Show the parent of the matched product
                }
            });
        }
    });
}


    $('#save_order').click(function(){
        $('#tendered').val('').trigger('change');
        $('[name="total_tendered"]').val('');
        $('#manage-order').submit();
    });

    $("#pay").click(function(){
        start_load();
        var amount = $('[name="total_amount"]').val();
        if($('#o-list tbody tr').length <= 0){
            alert_toast("Please add at least 1 product first.",'danger');
            end_load();
            return false;
        }
        $('#apayable').val(parseFloat(amount).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}));
        $('#pay_modal').modal('show');
        setTimeout(function(){
            $('#tendered').val('').trigger('change');
            $('#tendered').focus();
            end_load();
        },500);
    });

    $('#tendered').keyup('input',function(e){
        if(e.which == 13){
            $('#manage-order').submit();
            return false;
        }
        var tend = $(this).val();
        tend = tend.replace(/,/g,'');
        $('[name="total_tendered"]').val(tend);
        if(tend == '')
            $(this).val('');
        else
            $(this).val((parseFloat(tend).toLocaleString("en-US")));
        tend = tend > 0 ? tend : 0;
        var amount = $('[name="total_amount"]').val();
        var change = parseFloat(tend) - parseFloat(amount);
        $('#change').val(parseFloat(change).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}));
    });

    $('#tendered').on('input',function(){
        var val = $(this).val();
        val = val.replace(/[^0-9 \,]/, '');
        $(this).val(val);
    });
    $('#manage-order').submit(function(e){
    e.preventDefault();

    // Gather order list from the form
    let orderList = [];
    $('#o-list tbody tr').each(function(){
        let qty = $(this).find('input[name="qty[]"]').val();
        let itemName = $(this).find('td:eq(1)').text().trim();
        let amount = $(this).find('span.amount').text().trim();
        
        orderList.push({ qty, itemName, amount });
    });

    // Get total amount
    let totalAmount = $('#total_amount').text();

    // Clear existing content in the modal's order list
    $('#order-list').empty();

    // Populate the order list in the modal
    orderList.forEach(item => {
        $('#order-list').append('<li>' + item.qty + ' x ' + item.itemName + ' - ' + item.amount + '</li>');
    });

    // Display the total amount
    $('#order-total').text(totalAmount);

    // Show the confirmation modal
    $('#confirmModal').modal('show');

    // Handle confirmation button click
    $('#confirmPayment').off('click').on('click', function() {
        $('#confirmModal').modal('hide'); // Close the modal
        if(showInsufficientAmountMessage()) {
            start_load();
            $.ajax({
                url:'../ajax.php?action=save_order',
                method:'POST',
                data:$('#manage-order').serialize(),
                success:function(resp){
                    if(resp > 0){
                        if($('[name="total_tendered"]').val() > 0){
                            alert_toast("Data successfully saved.",'success');
                            setTimeout(function(){
                                var nw = window.open('../receipt.php?id='+resp,"_blank","width=900,height=600");
                                setTimeout(function(){
                                    nw.print();
                                    setTimeout(function(){
                                        nw.close();
                                        location.reload();
                                    },500);
                                },500);
                            },500);
                        }else{
                            alert_toast("Data successfully saved.",'success');
                            setTimeout(function(){
                                location.reload();
                            },500);
                        }
                    }
                }
            });
        }
    });
});


    function showInsufficientAmountMessage() {
        var tenderedAmount = parseFloat($('#tendered').val().replace(/,/g, '')) || 0;
        var totalAmount = parseFloat($('[name="total_amount"]').val()) || 0;
        var payableAmount = parseFloat($('#apayable').val().replace(/,/g, '')) || 0;

        if (tenderedAmount < totalAmount) {
            alert("Insufficient tendered amount. Please enter an amount greater than or equal to " + totalAmount.toLocaleString("en-US", {style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2}) + ".");
            return false;
        }

        if (payableAmount < totalAmount) {
            alert("The amount payable is less than the total amount. Please check your entries.");
            return false;
        }

        return true;
    }
</script>
