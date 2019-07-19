<!DOCTYPE html>
<html>
  <head>
    <title>Order Email</title>
  </head>
  <body>
    <table width="700px">
      <tr><td>&nbsp;</td></tr>
      <tr><td><img src="{{asset('images/frontend_images/images/home/logo1.jpg')}}" alt="" /></td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Hello {{ $name }}!</td></tr>
     <tr><td>&nbsp;</td></tr>
      <tr><td>Thanks for shopping with us.Below are your order details: <br> <br>Order No: {{$order_id}} <br> E-com website.</td> </tr>
    </table>
  </body>
</html>
