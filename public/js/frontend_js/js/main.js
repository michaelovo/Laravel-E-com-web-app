/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

// Change product price and stock according to selected size
$(document).ready(function(){
	// Change product price according to selected size
	$("#selSize").change(function(){
		var idSize = $(this).val();
		// if no size is selected, no alert 'error' msg
		if(idSize==""){
			return false;
		}
		$.ajax({
			type:'get',
			url:'/get-product-price',
			data:{idSize:idSize},
			success:function(resp){
				/*START .....hide/show 'Add to cart' button/'Availability' message 
				depending on selected size stock value*/
				var arr = resp.split('#');
				var arr1 = arr[0].split("-");//getcurrencyRates
				$("#getPrice").html("&#8358;"+ arr1[0]+"<br><h2>USD "+arr1[1]+"<br>EUR "+arr1[2]+"<br>GHC "+arr1[3]+"</h2>");
				$("#price").val(arr[0]);// to get and send price to input field wt id='price' in detail blade file
				if(arr[1]==0){
					$("#cartButton").hide();
					$("#Availability").text("  Out of Stock");
				}
				else{
					$("#cartButton").show();
					$("#Availability").text(" In Stock");
				}
				/*END ...... hide/show 'Add to cart'*/
			},error:function(){
				alert("Error");
			}
		});

	});

	

});
//Replace main image with alternate image on click
$(document).ready(function(){
	$(".changeImage").click(function(){
		var image = $(this).attr('src');
		//alert(image);
		$(".mainImage").attr('src',image);

	});
});

//--- easyzoom script
// Instantiate EasyZoom instances
var $easyzoom = $('.easyzoom').easyZoom();
	// Setup thumbnails example
var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

$('.thumbnails').on('click', 'a', function(e) {
	var $this = $(this);
	e.preventDefault();

	// Use EasyZoom's `swap` method
	api1.swap($this.data('standard'), $this.attr('href'));
});

// Setup toggles example
var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

$('.toggle').on('click', function() {
	var $this = $(this);

	if ($this.data("active") === true) {
		$this.text("Switch on").data("active", false);
			api2.teardown();
	} else {
		$this.text("Switch off").data("active", true);
		api2._init();
	}
});
//.... /easyzoom script

// USERS REGISTER Form Validation
$().ready(function(){
	// validate user register form onkey and submit
    $("#registerForm").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"
			},
			email:{
				required:true,
				email:true,
				remote:"/check-email" // remotely checks if email already exists or not
			},
			password:{
				required:true,
				minlength:6
			}
		},
		messages:{
			name:{
				required: "Please enter your name",
				minlength: "Your name must be atleast two(2) characters long",
				accept: "Your name should contain only letters"
			},
			email:{
				required:"Please enter your email address",
				email:"please enter a valid email",
				remote: "Email already exists!"	
			},
			password:{
				required:"Please provide your password",
				minlength:"Password must be atleast six(6) characters long"
			}
		}
	});
    
	// password strength meter/indicator script
	$(document).ready(function($) {
        $('#myPassword').passtrength({
          minChars: 4,
          passwordToggle: true,
          tooltip: true,
          eyeImg : "/images/frontend_images/images/eye.svg" // toggle icon
        });
    });
});

// USERS LOGIN Form Validation
$().ready(function(){
	// validate user login form onkeyup and submit
    $("#loginForm").validate({
		rules:{
			email:{
				required:true,
				email:true
			},
			password:{
				required:true
			}
		},
		messages:{
			email:{
				required:"Please enter your email address",
				email:"please enter a valid email"
			},
			password:{
				required:"Please provide your password"
			}
		}
	});

	// password strength meter/indicator script
	$(document).ready(function($) {
        $('#myLoginPassword').passtrength({
          minChars: 4,
          passwordToggle: true,
          tooltip: true,
          eyeImg : "/images/frontend_images/images/eye.svg" // toggle icon
        });
    });
});

// USERS ACCOUNT Update Form Validation
$().ready(function(){
	// validate user account form onkeyup and update
	$("#accountForm").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"
			},
			email:{
				required:true,
				email:true,
				remote:"/check-email" // remotely checks if email already exists or not
			},
			address:{
				required:true,
				minlength:10
			},
			city:{
				required:true,
				minlength:2
			},
			state:{
				required:true,
				minlength:2
			},
			country:{
				required:true
				//minlength:6
			},
			pincode:{
				required:true,
				minlength:6
			},
			mobile:{
				required:true
				//minlength:6
			}
		},
		messages:{
			name:{
				required: "Please enter your name",
				minlength: "Your name must be atleast two(2) characters long",
				accept: "Your name should contain only letters"
			},
			email:{
				required:"Please enter your email address",
				email:"please enter a valid email",
				remote: "Email already exists!"	
			},
			address:{
				required:"Please provide your password",
				maxlength:"Address must be atleast ten(10) characters long"
			},
			city:{
				required:"Please provide your city name",
				minlength:"City must be atleast two(2) characters long"
			},
			state:{
				required:"Please provide your State name",
				minlength:"State must be atleast two(2) characters long"
			},
			country:{
				required:"Please Select your conutry"
				//minlength:"Password must be atleast six(6) characters long"
			},
			pincode:{
				required:"Please provide a pincode",
				minlength:"Pincode must be atleast six(6) characters long"
			},
			mobile:{
				required:"Please provide your mobile number"
				//minlength:"Password must be atleast six(6) characters long"
			}
		}
	});
});


$(document).ready(function(){
	// Starts --- Compares current password with newly entered password and with confirm_pwd field
	$("#pwdForm").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		$.ajax({

			type:'get',
			url:'/check-user-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				if(resp=="false"){
					$("#pwdChk").html("<font color='red'> current password is incorrect</font>");
				}else if (resp=="true"){
					$("#pwdChk").html("<font color='green'> current password is correct</font>");
				}
			},
			error:function(){
				alert("error");
			}
		});
	});
	// End --- Compares current password with newly entered password and with confirm_pwd field

	// password strength meter/indicator script
	$(document).ready(function($) {
        $('#new_pwd').passtrength({
          minChars: 6,
          passwordToggle: true,
          tooltip: true,
          eyeImg : "/images/frontend_images/images/eye.svg" // toggle icon
        });
        // update password fileds validations
        $("#pwdForm").validate({
			rules:{
				current_pwd:{
					required: true,
					minlength:6,
					maxlength:20
				},
				new_pwd:{
					required: true,
					minlength:6,
					maxlength:20
				},
			confirm_pwd:{
					required:true,
					minlength:6,
					maxlength:20,
					equalTo:"#new_pwd"
				}
			},
			errorClass: "help-inline",
			errorElement: "span",
			highlight:function(element, errorClass, validClass) {
				$(element).parents('.control-group').addClass('error');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).parents('.control-group').removeClass('error');
				$(element).parents('.control-group').addClass('success');
			}
		});

		// copy billing address to shipping address if both are thesame
		 $("#copyAddress").click(function(){
		 	if(this.checked){
		 		 $('#shipping_name').val($('#billing_name').val());
		 		 $('#shipping_address').val($('#billing_address').val());
		 		 $('#shipping_city').val($('#billing_city').val());
		 		 $('#shipping_state').val($('#billing_state').val());
		 		 $('#shipping_pincode').val($('#billing_pincode').val());
		 		 $('#shipping_mobile').val($('#billing_mobile').val());
		 		 $('#shipping_country').val($('#billing_country').val());
		 		
		 	}
		 	else{
		 		 $('#shipping_name').val('');
		 		 $('#shipping_address').val('');
		 		 $('#shipping_city').val('');
		 		 $('#shipping_state').val('');
		 		 $('#shipping_pincode').val('');
		 		 $('#shipping_mobile').val('');
		 		 $('#shipping_country').val('');
		 	}

		 });
    }); 
});

// payment method function alert if user failed to select one
function selectPayMethod(){
	if ($('#Paypal').is(':checked') || $('#COD').is(':checked')){

	}else{
		alert("Please select payment method");
		return false;
	}
}
// Function to check zipcode availabilty
function checkZipcode(){
	//compare user to enter zipcode
	var zipcode = $("#chkzipcode").val();
	if(zipcode==""){
		alert("Please enter zipcode"); return false;
	}
	//ajax/jquery function to check availability of user entered zipcode
	$.ajax({
		type:'post',
		url:'/check-zipcode',
		data:{zipcode:zipcode},
		success:function(resp){
			if(resp>0){
				$("#zipcoderesponse").html("<font color='green'> This zipcode is available for delivery</font>");
			}else{
				$("#zipcoderesponse").html("<font color='red'> This zipcode is not available for delivery</font>");
			}
			
		},error:function(){
			alert("Error");
		}	
	});
}




