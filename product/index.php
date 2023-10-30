<!-- For more projects: Visit codeastro.com  -->
<?php
 
    session_start();

    if(!isset($_SESSION['user_session'])){

        header("location:../index.php");
    }
?>

<body>
 	 	<form method="POST" action="register.php?invoice_number=<?php echo $_GET['invoice_number']?>">
  	  	  <table id="table" style="width: 400px; margin: auto;overflow-x:auto; overflow-y: auto;">
  	  	 <tr>
         <td>Bar Code:</td>
         <td><input type="text" name="bar_code" id="bar_code" size="10" placeholder="Set a bar code" required></td>
          </tr>
          <tr id="row1">
         <td>Medicine Name:</td>
         <td><input type="text" name="med_name"  id="med_name" size="10" required ></td>
        </tr>
        <tr>
                   <td>Category:</td>

          <td><input type="text" name="category" id="category" size="10"  required></td>
        </tr>
        <tr>
                   <td>Quantity:</td>
        <!-- For more projects: Visit codeastro.com  -->
        <td><input type="number" style="width: 95px;" name="quantity">

             <select style="width: 95px; height: 28px; border-color: #000080" name="sell_type" > 
                 <option value="Bot">Bot</option>
                 <option value="Stp">Stp</option>
                  <option value="Tab">Tab</option>
		 <option value="Sachet">Sachet</option>	
		<option value="Unit">Unit</option>
		<option value="Tube">Tube</option>
                 </select></td>
        
        </tr> 
        <tr>
                   <td>Registered Date:</td>

          <td><input type="date"  name="reg_date" id="reg_date" size="5"  required>  </td>
        </tr>
        <tr>
                   <td>Expired Date:</td>

          <td><input type="date" name="exp_date" id="exp_date" size="5"  required></td>
        </tr>
        <tr>
                   <td>Company:</td>

          <td><input type="text" name="company" id="company" size="10"></td>
        </tr>
       
          <tr>
                     <td>Buying Price:</td>

          <td><input type="number" name="actual_price" id="actual_price"></td>
        </tr>
        <tr>
   <td>Retail Price:</td>
   <td><input type="number" name="retail_price" id="retail_price"></td>
</tr>
<tr>
   <td>Wholesale Price:</td>
   <td><input type="number" name="wholesale_price" id="wholesale_price"></td>
</tr>

<tr>
   <td>Wholesale Profit:</td>
   <td><input type="text" name="wholesale_profit" id="wholesale_profit" readonly></td>
</tr>
<tr>
   <td>Retail Profit:</td>
   <td><input type="text" name="retail_profit" id="retail_profit" readonly></td>
</tr>


        <tr>
          <td></td>
          <td> <input type="submit" name="submit" class="btn btn-success btn-large" style="width: 225px" value="Save"> </td>
        </tr>

  	  	 </table> 
        <br>
  	  	 </form><br>
</body>

<script type="text/javascript">
		$(document).ready(function(){

      $(document).on('keyup','#med_name', 

        function(){
             var med_name_cap = $("#med_name").val();
              
              $("#med_name").val(med_name_cap.charAt(0).toUpperCase()+med_name_cap.slice(1));
      
        });


      $(document).on('keyup','#category', 

        function(){
             var category_cap = $("#category").val();
              
              $("#category").val(category_cap.charAt(0).toUpperCase()+category_cap.slice(1));
      
        });


      $(document).on('keyup','#actual_price', 

        function(){
             var act_price = $("#actual_price").val();
      var sell_price = $("#selling_price").val();
      var pro_price = parseInt(sell_price) - parseInt(act_price);
	var percentage = Math.round((parseInt(pro_price)/parseInt(act_price))*100);
	var output = pro_price.toString().concat("(")+percentage.toString().concat("%)");
        $("#profit_price").val(output);
        });

       $(document).on('keyup','#selling_price', 
        function(){
      var act_price = $("#actual_price").val();
      var sell_price = $("#selling_price").val();
      var pro_price = parseInt(sell_price) - parseInt(act_price);
	var percentage = Math.round((parseInt(pro_price)/parseInt(act_price))*100);
	var output = pro_price.toString().concat("(")+percentage.toString().concat("%)");
        $("#profit_price").val(output);
            });
          
            $(document).on('keyup', '#actual_price, #retail_price, #wholesale_price', function(){
   var actual_price = $("#actual_price").val();
   var retail_price = $("#retail_price").val();
   var wholesale_price = $("#wholesale_price").val();

   // Calculate and populate retail profit
   if (retail_price) {
       var retail_profit = parseInt(retail_price) - parseInt(actual_price);
       $("#retail_profit").val(retail_profit);

       var retail_profit_percentage = ((retail_profit / actual_price) * 100).toFixed(2);
       $("#retail_profit_percentage").val(retail_profit_percentage + "%");
   } else {
       $("#retail_profit").val('');
       $("#retail_profit_percentage").val('');
   }

   // Calculate and populate wholesale profit
   if (wholesale_price) {
       var wholesale_profit = parseInt(wholesale_price) - parseInt(actual_price);
       $("#wholesale_profit").val(wholesale_profit);

       var wholesale_profit_percentage = ((wholesale_profit / actual_price) * 100).toFixed(2);
       $("#wholesale_profit_percentage").val(wholesale_profit_percentage + "%");
   } else {
       $("#wholesale_profit").val('');
       $("#wholesale_profit_percentage").val('');
   }
});




});
  	
  </script>
</html>

