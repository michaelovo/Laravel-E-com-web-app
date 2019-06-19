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
				$("#getPrice").html("US $"+ arr[0]);
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

// easyzoom script
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
// USERS REGISTER Form Validation
$().ready(function(){
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
