<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!----Invoice template gotten from https://bootsnipp.com/snippets/9gjD----->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
        <div class="invoice-title"><!----order id------->
          <h2>Invoice</h2><h3 class="pull-right">Order # {{$orderDetails->id}}</h3>
        </div>
        <hr>
        <div class="row">
          <div class="col-xs-6">
            <address>
            <strong>Billed To:</strong><br><!----Billing Address------->

             {{$userDetails->name}} <br>
              {{$userDetails->address}} <br>
              {{$userDetails->city}} <br>
              {{$userDetails->state}} <br>
              {{$userDetails->country}} <br>
              {{$userDetails->pincode}} <br>
              {{$userDetails->mobile}} <br>
             
            </address>
          </div>
          <div class="col-xs-6 text-right">
            <address>
              <strong>Shipped To:</strong><br><!---Shipping Address------->
              {{$orderDetails->name}} <br>
              {{$orderDetails->address}} <br>
              {{$orderDetails->city}} <br>
              {{$orderDetails->state}} <br>
              {{$orderDetails->country}} <br>
              {{$orderDetails->pincode}} <br>
              {{$orderDetails->mobile}} <br>
            </address>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <address>
              <strong>Payment Method:</strong><br><!----Payment Method/user email------->
             {{$orderDetails->payment_method}} ending **** 4242<br>
              {{$orderDetails->user_email}}
            </address>
          </div>
          <div class="col-xs-6 text-right">
            <address>
              <strong>Order Date:</strong><br><!----date order was made------->
              {{$orderDetails->created_at}}<br><br>
            </address>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Order summary</strong></h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-condensed">
                <thead>
                  <tr>
                      
                    <td class="text-left"><strong>Product Name</strong></td>
                    <td class="text-center"><strong>Code</strong></td>
                    <td class="text-center"><strong>Size</strong></td>
                    <td class="text-center"><strong>Color</strong></td>
                    <td class="text-center"><strong>Price</strong></td>
                    <td class="text-center"><strong>Qty</strong></td>
                    <td class="text-right"><strong>Totals</strong></td>
                  </tr>
                </thead>
                <tbody>
                  <!----Displays order details------->
                  <?php $Subtotal =0; ?> <!----Initializ subtotal value------->
                  @foreach($orderDetails->orders as $pro)
                    <tr>
                      <td class="text-left">{{$pro->product_name}}</td>
                      <td class="text-center">{{$pro->product_code}}</td>
                      <td class="text-center">{{$pro->product_size}}</td>
                      <td class="text-center">{{$pro->product_color}}</td>
                      <td class="text-center">&#8358;{{$pro->product_price}}</td>
                      <td class="text-center">{{$pro->product_qty}}</td> 
                      <td class="text-center">&#8358;{{$pro->product_price*$pro->product_qty}}</td> 
                    </tr>
                    <!----Compute subtotal value------->
                    <?php $Subtotal = $Subtotal + ($pro->product_price*$pro->product_qty); ?>
                    @endforeach 

                    <tr style="background: #000">
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line text-center"><strong></strong></td>
                      <td class="thick-line text-right"></td>
                    </tr>
                    <tr><!----order subtotal------->
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line text-center"><strong>Subtotal</strong></td>
                      <td class="thick-line text-right">&#8358;{{$Subtotal}}</td>
                    </tr>
                  
                  <tr><!----Cost of shipping order------->
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="no-line text-center"><strong>Shipping charges (+)</strong></td>
                    <td class="no-line text-right">&#8358;0</td>
                  </tr>
                 
                  <tr><!----Coupon discount------->
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="no-line text-center"><strong>Coupon Discount</strong></td>
                    <td class="no-line text-right">&#8358;{{$orderDetails->coupon_amount}}</td>
                  </tr>
                  <tr><!----Grand total of ordered products------->
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="no-line text-center"><strong>Grand Total</strong></td>
                    <td class="no-line text-right">&#8358;{{$orderDetails->grand_total}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>