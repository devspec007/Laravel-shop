/*
Author       : Dreamguys
Template Name: POS - Bootstrap Admin Template
*/


$(document).ready(function(){

	

	// Variables declarations
	var $wrapper = $('.main-wrapper');
	var $slimScrolls = $('.slimscroll');
	var $pageWrapper = $('.page-wrapper');
	feather.replace();

	// Page Content Height Resize
	$(window).resize(function () {
		if ($('.page-wrapper').length > 0) {
			var height = $(window).height();
			$(".page-wrapper").css("min-height", height);
		}
	});

	// Mobile menu sidebar overlay
	$('body').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btn', function() {
		$wrapper.toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').addClass('menu-opened');
		$('#task_window').removeClass('opened');
		return false;
	});

	$(".sidebar-overlay").on("click", function () {
		$('html').removeClass('menu-opened');
		$(this).removeClass('opened');
		$wrapper.removeClass('slide-nav');
		$('.sidebar-overlay').removeClass('opened');
		$('#task_window').removeClass('opened');
	});

	// Logo Hide Btn

	$(document).on("click",".hideset",function () {
		$(this).parent().parent().parent().hide();
	});

	$(document).on("click",".delete-set",function () {
		$(this).parent().parent().hide();
	});

	// Owl Carousel
	if($('.product-slide').length > 0 ){
		$('.product-slide').owlCarousel({
			items: 1,
			margin: 30,
			dots : false,
			nav: true,
			loop: false,
			responsiveClass:true,
			responsive: {
				0: {
					items: 1
				},
				800 : {
					items: 1
				},
				1170: {
					items: 1
				}
			}
		});
	}

	//Home popular 
	if($('.owl-product').length > 0 ){
		var owl = $('.owl-product');
			owl.owlCarousel({
			margin: 10,
			dots : false,
			nav: true,
			loop: false,
			touchDrag:false,
			mouseDrag  : false,
			responsive: {
				0: {
					items: 2
				},
				768 : {
					items: 4
				},
				1170: {
					items: 6
				}
			}
		});
	}

	
	// Datatable
	if($('.datanew').length > 0) {
		$('.datanew').DataTable({
			"bFilter": true,
			"sDom": 'fBtlpi',  
			'pagingType': 'numbers', 
			"ordering": true,
			"language": {
				search: ' ',
				sLengthMenu: '_MENU_',
				searchPlaceholder: "Search...",
				info: "_START_ - _END_ of _TOTAL_ items",
			 },
			initComplete: (settings, json)=>{
				$('.dataTables_filter').appendTo('#tableSearch');
				$('.dataTables_filter').appendTo('.search-input');
			},	
		});
	}

	// image file upload image
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function (e) {
				$('#blah').attr('src', e.target.result);
			}
	
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$("#imgInp").change(function(){
		readURL(this);
	});


	if($('.datatable').length > 0) {
		$('.datatable').DataTable({
			"bFilter": false
		});
	}
	// Loader
	setTimeout(function () {
		$('#global-loader');
		setTimeout(function () {
			$("#global-loader").fadeOut("slow");
		}, 100);
	}, 500);

	// Datetimepicker
	if($('.datetimepicker').length > 0 ){
		$('.datetimepicker').datetimepicker({
			format: 'DD-MM-YYYY',
			icons: {
				up: "fas fa-angle-up",
				down: "fas fa-angle-down",
				next: 'fas fa-angle-right',
				previous: 'fas fa-angle-left'
			}
		});
	}
	
	// toggle-password
	if($('.toggle-password').length > 0) {
		$(document).on('click', '.toggle-password', function() {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $(".pass-input");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}
	if($('.toggle-passwords').length > 0) {
		$(document).on('click', '.toggle-passwords', function() {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $(".pass-inputs");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}
	if($('.toggle-passworda').length > 0) {
		$(document).on('click', '.toggle-passworda', function() {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $(".pass-inputs");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}

	// Select 2
	if ($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}

	// Counter 
	if($('.counter').length > 0) {
		$('.counter').counterUp({
			delay: 20,
			time: 2000
		});
	}
	if($('#timer-countdown').length > 0) {
		$( '#timer-countdown' ).countdown( {
			from: 180, // 3 minutes (3*60)
			to: 0, // stop at zero
			movingUnit: 1000, // 1000 for 1 second increment/decrements
			timerEnd: undefined,
			outputPattern: '$day Day $hour : $minute : $second',
			autostart: true
		});
	}
	
	if($('#timer-countup').length > 0) {
		$( '#timer-countup' ).countdown( {
			from: 0,
			to: 180 
		});
	}
	
	if($('#timer-countinbetween').length > 0) {
		$( '#timer-countinbetween' ).countdown( {
			from: 30,
			to: 20 
		});
	}
	
	if($('#timer-countercallback').length > 0) {
		$( '#timer-countercallback' ).countdown( {
			from: 10,
			to: 0,
			timerEnd: function() {
				this.css( { 'text-decoration':'line-through' } ).animate( { 'opacity':.5 }, 500 );
			} 
		});
	}
	
	if($('#timer-outputpattern').length > 0) {
		$( '#timer-outputpattern' ).countdown( {
			outputPattern: '$day Days $hour Hour $minute Min $second Sec..',
			from: 60 * 60 * 24 * 3
		});
	}

	// Summernote

	if($('#summernote').length > 0) {
		$('#summernote').summernote({
		height: 300,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true                  // set focus to editable area after initializing summernote
		});
	}
	


	// Sidebar Slimscroll
	if($slimScrolls.length > 0) {
		$slimScrolls.slimScroll({
			height: 'auto',
			width: '100%',
			position: 'right',
			size: '7px',
			color: '#ccc',
			wheelStep: 10,
			touchScrollStep: 100
		});
		var wHeight = $(window).height() - 60;
		$slimScrolls.height(wHeight);
		$('.sidebar .slimScrollDiv').height(wHeight);
		$(window).resize(function() {
			var rHeight = $(window).height() - 60;
			$slimScrolls.height(rHeight);
			$('.sidebar .slimScrollDiv').height(rHeight);
		});
	}

	// Sidebar
	var Sidemenu = function() {
		this.$menuItem = $('#sidebar-menu a');
	};

	function init() {
		var $this = Sidemenu;
		$('#sidebar-menu a').on('click', function(e) {
			if($(this).parent().hasClass('submenu')) {
				e.preventDefault();
			}
			if(!$(this).hasClass('subdrop')) {
				$('ul', $(this).parents('ul:first')).slideUp(250);
				$('a', $(this).parents('ul:first')).removeClass('subdrop');
				$(this).next('ul').slideDown(350);
				$(this).addClass('subdrop');
			} else if($(this).hasClass('subdrop')) {
				$(this).removeClass('subdrop');
				$(this).next('ul').slideUp(350);
			}
		});
		$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
	}
	
	// Sidebar Initiate
	init();
	$(document).on('mouseover', function(e) {
        e.stopPropagation();
        if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
            var targ = $(e.target).closest('.sidebar, .header-left').length;
            if (targ) {
                $('body').addClass('expand-menu');
                $('.subdrop + ul').slideDown();
            } else {
                $('body').removeClass('expand-menu');
                $('.subdrop + ul').slideUp();
            }
            return false;
        }
    });

	//toggle_btn
	$(document).on('click', '#toggle_btn', function() {
		if ($('body').hasClass('mini-sidebar')) {
			$('body').removeClass('mini-sidebar');
			$(this).addClass('active');
			$('.subdrop + ul');
			localStorage.setItem('screenModeNightTokenState', 'night');
			setTimeout(function() {
				$("body").removeClass("mini-sidebar");
				$(".header-left").addClass("active");
			}, 100);
		} else {
			$('body').addClass('mini-sidebar');
			$(this).removeClass('active');
			$('.subdrop + ul');
			localStorage.removeItem('screenModeNightTokenState', 'night');
			setTimeout(function() {
				$("body").addClass("mini-sidebar");
				$(".header-left").removeClass("active");
			}, 100);
		}
		return false;
	});


	if (localStorage.getItem('screenModeNightTokenState') == 'night') {
		setTimeout(function() {
			$("body").removeClass("mini-sidebar");
			$(".header-left").addClass("active");
		}, 100);
	}

	$('.submenus').on('click', function(){
		$('body').addClass('sidebarrightmenu');
	});
	
	$('#searchdiv').on('click', function(){
		$('.searchinputs').addClass('show');
	});
	$('.search-addon span').on('click', function(){
		$('.searchinputs').removeClass('show');
	});
	$(document).on('click', '#filter_search', function() {
		$('#filter_inputs').slideToggle("slow");
	});
	$(document).on('click', '#filter_search1', function() {
		$('#filter_inputs1').slideToggle("slow");
	});
	$(document).on('click', '#filter_search2', function() {
		$('#filter_inputs2').slideToggle("slow");
	});
	$(document).on('click', '#filter_search', function() {
		$('#filter_search').toggleClass("setclose");
	});
	$(document).on("click",".productset",function () {
		$(this).toggleClass("active");
		var product =$(this).attr('data-product');
		var type =$(this).attr('data-type');

		addToCart(product, type)
	});


	function addToCart(product, type = 'pos') {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		
		$.ajax({
			type: 'POST',
			url: base_url+"/admin/add-to-cart",
			data: {product_id : product, type : type},
			dataType: 'json',
			success: function(response) {
			
				$('#cart-list').html(response.data);
				$('#final-subtotal').html(response.subtotal);
				$('#final-total').html(response.total);
				$('#final-checkout-total').html(response.total);
				$('.total-cart-quantity').html(response.quantity)
				$('.final-checkout-total-input').val(response.total)
				cartData()

			},
			error: function(xhr, status, error) {
				
			}
		})
	}

	$(document).on('change', '.sales-price-input', function(e){
		var cart_id = $(this).attr('data-id')
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: 'POST',
			url: base_url+"/admin/update-to-cart-price",
			data: {cart_id : cart_id, amount : $(this).val()},
			dataType: 'json',
			success: function(response) {
				
				$('#cart-list').html(response.data);
				$('#final-subtotal').html(response.subtotal);
				$('#final-total').html(response.total);
				$('#final-checkout-total').html(response.total);
				$('.total-cart-quantity').html(response.quantity)
				$('.final-checkout-total-input').val(response.total)
				cartData()

			},
			error: function(xhr, status, error) {
				
			}
		})
	})

	function cartData() {
		var final_amount = $('.final-checkout-total-input').val();
		var discount = $('.discount_amount').val();
		if(discount == undefined | discount == '') {
			discount = 0;
		}
		var amount = parseFloat(final_amount) - parseFloat(discount)
		var gst = $('.gst_amount').val();
		var gst_amount = (parseFloat(gst)/100)*parseFloat(amount)
		var final_amount = gst_amount+amount
		$('#final-total').html(final_amount);
		$('#final-checkout-total').html(final_amount);
		$('#discounted-amount').html('-'+discount)
		$('#gst-amount').html('+'+gst_amount)
		
	}
	
	$(document).on('keyup', '.discount_amount', function(e){
		cartData()
	})

	$(document).on('keyup', '.gst_amount', function(e){
		cartData()
	})
	
	

	//Increment Decrement value
	$(document).on('click', '.inc.button', function(){
		var this_var = $(this);
		var id = $(this).attr('data-id');
		var value = $(this).val();
		updateAddToCart(id, value)

	});
	$(document).on('click', '.dec.button', function(){
	    var this_var = $(this);
		var id = $(this).attr('data-id');
		var value = $(this).val();

		updateAddToCart(id, value)

	});

	function updateAddToCart(cart_id, value) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: 'POST',
			url: base_url+"/admin/update-add-to-cart",
			data: {cart_id : cart_id, value : value},
			dataType: 'json',
			success: function(response) {
				
				$('#cart-list').html(response.data);
				$('#final-subtotal').html(response.subtotal);
				$('#final-total').html(response.total);
				$('#final-checkout-total').html(response.total);
				$('.total-cart-quantity').html(response.quantity)
				$('.final-checkout-total-input').val(response.total)
				cartData()
			},
			error: function(xhr, status, error) {
				
			}
		})
	}
	if($('.custom-file-container').length > 0) {
		//First upload
		var firstUpload = new FileUploadWithPreview('myFirstImage')
		//Second upload
		var secondUpload = new FileUploadWithPreview('mySecondImage')
	}

	$('.counters').each(function() {
		var $this = $(this),
			countTo = $this.attr('data-count');
		$({ countNum: $this.text()}).animate({
			countNum: countTo
		},
		{
			duration: 2000,
			easing:'linear',
			step: function() {
			$this.text(Math.floor(this.countNum));
			},
			complete: function() {
			$this.text(this.countNum);
			}
		
		});  
		
	});
	

	// toggle-password
	if($('.toggle-password').length > 0) {
		$(document).on('click', '.toggle-password', function() {
			$(this).toggleClass("fa-eye fa-eye");
			var input = $(".pass-input");
			if (input.attr("type") == "text") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}


	if($('.win-maximize').length > 0) {
		$('.win-maximize').on('click', function(e){
			if (!document.fullscreenElement) {
				document.documentElement.requestFullscreen();
			} else {
				if (document.exitFullscreen) {
					document.exitFullscreen();
				}
			}
		})
	}


	$(document).on('click', '#check_all', function() {
		$('.checkmail').click();
		return false;
	});
	if($('.checkmail').length > 0) {
		$('.checkmail').each(function() {
			$(this).on('click', function() {
				if($(this).closest('tr').hasClass('checked')) {
					$(this).closest('tr').removeClass('checked');
				} else {
					$(this).closest('tr').addClass('checked');
				}
			});
		});
	}
		
	// Popover
	if($('.popover-list').length > 0) {
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
		var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
		return new bootstrap.Popover(popoverTriggerEl)
		})
	}

	// Clipboard 
	if($('.clipboard').length > 0) {
		var clipboard = new Clipboard('.btn');
	}

	// Chat
	var chatAppTarget = $('.chat-window');
	(function() {
		if ($(window).width() > 991)
			chatAppTarget.removeClass('chat-slide');
		
		$(document).on("click",".chat-window .chat-users-list a.media",function () {
			if ($(window).width() <= 991) {
				chatAppTarget.addClass('chat-slide');
			}
			return false;
		});
		$(document).on("click","#back_user_list",function () {
			if ($(window).width() <= 991) {
				chatAppTarget.removeClass('chat-slide');
			}	
			return false;
		});
	})();

	// Mail important
	
	$(document).on('click', '.mail-important', function() {
		$(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o');
	});

		
	var selectAllItems = "#select-all";
	var checkboxItem = ":checkbox";
	$(selectAllItems).click(function() {
		
		if (this.checked) {
		$(checkboxItem).each(function() {
			this.checked = true;
		});
		} else {
		$(checkboxItem).each(function() {
			this.checked = false;
		});
		}
		
	});
		
	// Tooltip
	if($('[data-bs-toggle="tooltip"]').length > 0) {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
	}

	var right_side_views = '<div class="right-side-views d-none">' +
	'<ul class="sticky-sidebar siderbar-view">' +
		'<li class="sidebar-icons">' +
			'<a class="toggle tipinfo open-layout open-siderbar" href="javascript:void(0);" data-toggle="tooltip" data-placement="left" data-bs-original-title="Tooltip on left">' +
				'<div class="tooltip-five ">' +
					'<img src="assets/img/icons/siderbar-icon2.svg" class="feather-five" alt="">' +
					'<span class="tooltiptext">Check Layout</span>' +
				'</div>' +
			'</a>' +
		'</li>' +
	'</ul>' +
'</div>' +

'<div class="sidebar-layout">' +
	'<div class="sidebar-content">' +
		'<div class="sidebar-top">' +
			'<div class="container-fluid">' +
				'<div class="row align-items-center">' +
					'<div class="col-xl-6 col-sm-6 col-12">' +
						'<div class="sidebar-logo">' +
							'<a href="index" class="logo">' +
								'<img src="assets/img/logo.png" alt="Logo" class="img-flex">' +
							'</a>' +
						'</div>' +
					'</div>' +
					'<div class="col-xl-6 col-sm-6 col-12">' +
						'<a class="btn-closed" href="javascript:void(0);"><img class="img-fliud" src="assets/img/icons/sidebar-delete-icon.svg" alt="demo"></a>' +
					'</div>' +
				'</div>' +
			'</div>' +
		'</div>' +
		'<div class="container-fluid">' +
			'<div class="row align-items-center">' +
				'<h5 class="sidebar-title">Choose layout</h5>' +
				'<div class="col-xl-12 col-sm-6 col-12">' +
					'<div class="sidebar-image align-center">' +
						'<img class="img-fliud" src="assets/img/demo-one.png" alt="demo">' +
					'</div>' +
					'<div class="row">' +
						'<div class="col-lg-6 layout">' +
							'<h5 class="layout-title">Dark Mode</h5>' +
						'</div>' +
						'<div class="col-lg-6 layout dark-mode">' +
							'<label class="toggle-switch" for="notification_switch3">' +
							'<span>' +
							'<input type="checkbox" class="toggle-switch-input" id="notification_switch3">' +
							'<span class="toggle-switch-label ms-auto">' +
							'	<span class="toggle-switch-indicator"></span>' +
							'</span>' +
							'</span>' +
							' </label>' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
		'</div>' +
	'</div>' +
	'</div>' +
    $("body").append(right_side_views);

	// Sidebar Visible
	
	$('.open-layout').on("click", function (s) {
		s.preventDefault();
		$('.sidebar-layout').addClass('show-layout');
		$('.sidebar-settings').removeClass('show-settings');
	});
	$('.btn-closed').on("click", function (s) {
		s.preventDefault();
		$('.sidebar-layout').removeClass('show-layout');
	});
	$('.open-settings').on("click", function (s) {
		s.preventDefault();
		$('.sidebar-settings').addClass('show-settings');
		$('.sidebar-layout').removeClass('show-layout');
	});

	$('.btn-closed').on("click", function (s) {
		s.preventDefault();
		$('.sidebar-settings').removeClass('show-settings');
	});

	$('.open-siderbar').on("click", function (s) {
		s.preventDefault();
		$('.siderbar-view').addClass('show-sidebar');
	});

	$('.btn-closed').on("click", function (s) {
		s.preventDefault();
		$('.siderbar-view').removeClass('show-sidebar');
	});

	if($('.toggle-switch').length > 0) {
		const toggleSwitch = document.querySelector('.toggle-switch input[type="checkbox"]');
		const currentTheme = localStorage.getItem('theme');
		var app = document.getElementsByTagName("BODY")[0];

		if (currentTheme) {
			app.setAttribute('data-theme', currentTheme);
		  
			if (currentTheme === 'dark') {
				toggleSwitch.checked = true;
			}
		}

		function switchTheme(e) {
			if (e.target.checked) {
				app.setAttribute('data-theme', 'dark');
				localStorage.setItem('theme', 'dark');
			}
			else {       
				app.setAttribute('data-theme', 'light');
				localStorage.setItem('theme', 'light');
			}    
		}

		toggleSwitch.addEventListener('change', switchTheme, false);	
	}
	
	if(window.location.hash == "#LightMode"){
		localStorage.setItem('theme', 'dark');
	}
	else {
		if(window.location.hash == "#DarkMode"){
			localStorage.setItem('theme', 'light');
		}
	}

	
	$('.owl-category li').click(function(){
		var $this = $(this);
		var $theTab = $(this).attr('id');
		// console.log($theTab);
		if($(this).find('input').is(":checked")) {
			$(this).addClass('active')
		}
		else {
			$(this).removeClass('active')

		}
		// if($this.hasClass('active')){
		//   // do nothing
		// } else{
		//   $this.closest('.tabs_wrapper').find('.owl-category li, .tabs_container .tab_content').removeClass('active');
		//   $('.tabs_container .tab_content[data-tab="'+$theTab+'"], .owl-category li[id="'+$theTab+'"]').addClass('active');
		// }
		get_products()
		
	});

	
	
	$('.owl-brand li').click(function(){
		var $this = $(this);
		var $theTab = $(this).attr('id');
		// console.log($theTab);
		if($(this).find('input').is(":checked")) {
			$(this).addClass('active')
		}
		else {
			$(this).removeClass('active')

		}
		// if($this.hasClass('active')){
		//   // do nothing
		// } else{
		//   $this.closest('.tabs_wrapper').find('.owl-brand li, .tabs_container .tab_content').removeClass('active');
		//   $('.tabs_container .tab_content[data-tab="'+$theTab+'"], .owl-brand li[id="'+$theTab+'"]').addClass('active');
		// }
		get_products()
		
	});

	// $(document).on('change', '.pos-brand-category-checkbox', function(e){
	// 	get_products()
	// })

	function get_products() {
		var data = $('.filter-data').serialize();
		$.ajax({
			type :'get',
			url : base_url+"/admin/sales-products",
			data : data,
			dataType : 'json',
			success : function(response) {
				$('#pos-product-list').html(response.data)
			},
			error : function(error) {
				
			}
		})
	}

	$(document).on('keyup', '.search-product', function(e){
		get_products()
	})
	

	var customize_link = '<div class="customizer-links">' +
			'<ul class="sticky-sidebar">' +
				'<li class="sidebar-icons">' +
					'<a href="#" class="add-setting" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Tooltip on left">' +
						'<img src="assets/img/icons/sidebar-icon-01.svg" class="feather-five" alt="">' +
					'</a>' +
				'</li>' +
				'<li class="sidebar-icons">' +
					'<a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Tooltip on left">' +
						'<img src="assets/img/icons/sidebar-icon-02.svg" class="feather-five" alt="">' +
					'</a>' +
				'</li>' +
				'<li class="sidebar-icons">' +
					'<a href="https://themeforest.net/item/dreamspos-pos-inventory-management-admin-dashboard-template/38834413" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Tooltip on left">' +
						'<img src="assets/img/icons/sidebar-icon-03.svg" class="feather-five" alt="">' +
					'</a>' +
				'</li>' +
			'</ul>' +
		'</div>' +

		'<div class="sidebar-settings preview-toggle">' +
			'<div class="sidebar-content sticky-sidebar-one">' +
				'<div class="sidebar-header">' +
					'<h5>Preview Settings</h5>' +
					'<a class="sidebar-close" href="#"><img src="assets/img/icons/close-icon.svg" alt=""></a>' +
				'</div>' +
				'<div class="sidebar-body">' +
					'<h6 class="theme-title">Choose Mode</h6>' +
					'<div class="switch-wrapper">' +
						'<div id="dark-mode-toggle">' +
							'<span class="light-mode active"> <img src="assets/img/icons/sun-icon.svg" class="me-2" alt=""> Light</span>' +
							'<span class="dark-mode"><i class="far fa-moon me-2"></i> Dark</span>' +
						'</div>' +
					'</div>' +
					'<div class="row  ">' +
						'<div class="col-xl-6 ere">' +
							'<div class="layout-wrap">' +								
								'<div class="d-flex align-items-center">' +
									'<div class="status-toggle d-flex align-items-center me-2">' +
										'<input type="checkbox" id="1" class="check">' +
										'<label for="1" class="checktoggle"><a  href="index.html"class="layout-link">checkbox</a> </label>' + 
									'</div>' +
									'<span class="status-text">LTR</span>' +
								'</div>' +
								'<div class="layout-img">' +
									'<img class="img-fliud" src="assets/img/layout-ltr.png" alt="layout">' +
								'</div>' +
							'</div>' +
						'</div>' +
						'<div class="col-xl-6 ere">' +
							'<div class="layout-wrap">' +								
								'<div class="d-flex align-items-center">' +
									'<div class="status-toggle d-flex align-items-center me-2">' +
										'<input type="checkbox" id="1" class="check">' +
										'<label for="1" class="checktoggle"><a  href="../template-rtl/index.html"class="layout-link">checkbox</a> </label>' + 
									'</div>' +
									'<span class="status-text">RTL</span>' +
								'</div>' +
								'<div class="layout-img">' +
									'<img class="img-fliud" src="assets/img/layout-rtl.png" alt="layout">' +
								'</div>' +
							'</div>' +
						'</div>' +
					'</div>' +
					'<div class="row  ">' +
						'<div class="col-xl-6 ere">' +
							'<div class="layout-wrap">' +								
								'<div class="d-flex align-items-center">' +
									'<div class="status-toggle d-flex align-items-center me-2">' +
										'<input type="checkbox" id="3" class="check">' +
										'<label for="3" class="checktoggle"><a  href="index-three.html"class="layout-link">checkbox</a> </label>' + 
									'</div>' +
									'<span class="status-text">Boxed</span>' +
								'</div>' +
								'<div class="layout-img">' +
									'<img class="img-fliud" src="assets/img/layout-04.png" alt="layout">' +
								'</div>' +
							'</div>' +
						'</div>' +
						'<div class="col-xl-6 ere">' +
						 	'<div class="layout-wrap">' +								
								'<div class="d-flex align-items-center">' +
								 	'<div class="status-toggle d-flex align-items-center me-2">' +
									 	'<input type="checkbox" id="3" class="check">' +
									 	'<label for="3" class="checktoggle"><a  href="index-four.html"class="layout-link">checkbox</a> </label>' + 
								 	'</div>' +
								 	'<span class="status-text">Collapsed</span>' +
								'</div>' +
							 	'<div class="layout-img">' +
									 '<img class="img-fliud" src="assets/img/layout-01.png" alt="layout">' +
							 	'</div>' +
						 	'</div>' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
	 	'</div>' +
		
		'<div class="sidebar-settings nav-toggle">' +
			'<div class="sidebar-content sticky-sidebar-one">' +
				'<div class="sidebar-header">' +
					'<h5>Navigation Settings</h5>' +
				 	'<a class="sidebar-close" href="#"><img src="assets/img/icons/close-icon.svg" alt=""></a>' +
				'</div>' +
			 	'<div class="sidebar-body">' +
				 	'<h6 class="theme-title">Navigation Type</h6>' +
				 	'<div class="row  ">' +
						'<div class="col-xl-6 ere">' +
							'<div class="layout-wrap">' +								
								'<div class="d-flex align-items-center">' +
									'<div class="status-toggle d-flex align-items-center me-2">' +
										'<input type="checkbox" id="1" class="check">' +
										'<label for="1" class="checktoggle"><a  href="index.html"class="layout-link">checkbox</a> </label>' + 
									'</div>' +
									'<span class="status-text">Vertical</span>' +
								'</div>' +
								'<div class="layout-img">' +
									'<img class="img-fliud" src="assets/img/layout-03.png" alt="layout">' +
								'</div>' +
							'</div>' +
						'</div>' +
						'<div class="col-xl-6 ere">' +
						 	'<div class="layout-wrap">' +								
								'<div class="d-flex align-items-center">' +
								 	'<div class="status-toggle d-flex align-items-center me-2">' +
									 	'<input type="checkbox" id="2" class="check">' +
									 	'<label for="2" class="checktoggle"><a  href="index-one.html"class="layout-link">checkbox</a> </label>' + 
								 	'</div>' +
								 	'<span class="status-text">Horizontal</span>' +
								'</div>' +
							 	'<div class="layout-img">' +
									 '<img class="img-fliud" src="assets/img/layout-01.png" alt="layout">' +
							 	'</div>' +
						 	'</div>' +
						'</div>' +
						'<div class="col-xl-6 ere">' +
						 	'<div class="layout-wrap">' +								
								'<div class="d-flex align-items-center">' +
								 	'<div class="status-toggle d-flex align-items-center me-2">' +
									 	'<input type="checkbox" id="3" class="check">' +
									 	'<label for="3" class="checktoggle"><a  href="index-four.html"class="layout-link">checkbox</a> </label>' + 
								 	'</div>' +
								 	'<span class="status-text">Collapsed</span>' +
								'</div>' +
							 	'<div class="layout-img">' +
									 '<img class="img-fliud" src="assets/img/layout-01.png" alt="layout">' +
							 	'</div>' +
						 	'</div>' +
						'</div>' +
						'<div class="col-xl-6 ere">' +
						 	'<div class="layout-wrap">' +								
								'<div class="d-flex align-items-center">' +
								 	'<div class="status-toggle d-flex align-items-center me-2">' +
									 	'<input type="checkbox" id="3" class="check">' +
									 	'<label for="3" class="checktoggle"><a  href="index-three.html"class="layout-link">checkbox</a> </label>' + 
								 	'</div>' +
								 	'<span class="status-text">Modern</span>' +
								'</div>' +
							 	'<div class="layout-img">' +
									 '<img class="img-fliud" src="assets/img/layout-04.png" alt="layout">' +
							 	'</div>' +
						 	'</div>' +
						'</div>' +
						'<div class="col-xl-6 ere">' +
						 	'<div class="layout-wrap">' +								
								'<div class="d-flex align-items-center">' +
								 	'<div class="status-toggle d-flex align-items-center me-2">' +
									 	'<input type="checkbox" id="3" class="check">' +
									 	'<label for="3" class="checktoggle"><a  href="index-two.html"class="layout-link">checkbox</a> </label>' + 
								 	'</div>' +
								 	'<span class="status-text">Boxed</span>' +
								'</div>' +
							 	'<div class="layout-img">' +
									 '<img class="img-fliud" src="assets/img/layout-03.png" alt="layout">' +
							 	'</div>' +
						 	'</div>' +
						'</div>' +
					'</div>' +
				'</div>' +
		 	'</div>' +
	  	'</div>';

$("body").append(customize_link);

$('.add-setting').on("click", function (e) {
	e.preventDefault();
	$('.preview-toggle.sidebar-settings').addClass('show-settings');
});
$('.sidebar-close').on("click", function (e) {
	e.preventDefault();
	$('.preview-toggle.sidebar-settings').removeClass('show-settings');
});
$('.navigation-add').on("click", function (e) {
	e.preventDefault();
	$('.nav-toggle.sidebar-settings').addClass('show-settings');
});
$('.sidebar-close').on("click", function (e) {
	e.preventDefault();
	$('.nav-toggle.sidebar-settings').removeClass('show-settings');
});

// DarkMode with LocalStorage
if($('#dark-mode-toggle').length > 0) {
	$("#dark-mode-toggle").children(".light-mode").addClass("active");
	let darkMode = localStorage.getItem('darkMode'); 
	
	const darkModeToggle = document.querySelector('#dark-mode-toggle');
	
	const enableDarkMode = () => {
		document.body.setAttribute('data-theme', 'dark');
		$("#dark-mode-toggle").children(".dark-mode").addClass("active");
		$("#dark-mode-toggle").children(".light-mode").removeClass("active");
		localStorage.setItem('darkMode', 'enabled');
	}

	const disableDarkMode = () => {
	  document.body.removeAttribute('data-theme', 'dark');
		$("#dark-mode-toggle").children(".dark-mode").removeClass("active");
		$("#dark-mode-toggle").children(".light-mode").addClass("active");
	  localStorage.setItem('darkMode', null);
	}
	 
	if (darkMode === 'enabled') {
		enableDarkMode();
	}

	darkModeToggle.addEventListener('click', () => {
	  darkMode = localStorage.getItem('darkMode'); 
	  
	  if (darkMode !== 'enabled') {
		enableDarkMode();
	  } else {  
		disableDarkMode(); 
	  }
	});
}
	  

});

	

$(document).on('submit', '.submit-form',function(e) {
	e.preventDefault();
	$('.form-error').html('')
	var btnhtml = $('.basicbtn').html();	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: 'POST',
		url: this.action,
		data: new FormData(this),
		dataType: 'json',
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function() {
			$('.basicbtn').attr('disabled', '')
			$('.basicbtn').html('Please Wait....')
		},
		success: function(response) {
			$('.basicbtn').removeAttr('disabled')
			// Sweet('success', response)
			$('.basicbtn').html(btnhtml)
		 
				if(response.status == 'success') {

					// Sweet('success', response.message);
					if( response.url) {
	
						window.location.href = response.url;
					}
					else {
						window.location.reload()
					}
				}
				else {
					Swal.fire(
						'',
						response.message,
						'error'
					  )
					// console.log(response)
				}
			
		},
		error: function(xhr, status, error) {
			$('.basicbtn').removeAttr('disabled');
			$('.basicbtn').html(btnhtml);
			$.each(xhr.responseJSON.errors, function(key, item) {
				$('#'+key+"_error").html(item)
			});
		}
	})
});

$(document).on('click', '.pagination .page-link', function(e){
	e.preventDefault();
	var data = $('#filter-data').serialize();
	window.location.href = $(this).attr('href')+"&"+data 
})
	




$(document).on('change', '.filter-category',function(e) {
	e.preventDefault();
	var this_var = $(this)
	$.ajax({
		type: 'get',
		url: base_url+"/admin/filter-sub-category",
		data: {category_id : $(this).val()},
		dataType: 'json',
	
		success: function(response) {
			var list = '<option value="">Choose Sub Category</option>'
			$.each(response.categories, function(index, value){
				list += `<option value="${value.id}">${value.name}</option>`
			})
			this_var.parents().eq(3).find('.sub-category-list').html(list)
		},
		error: function(xhr, status, error) {
		}
			
	})
});




$(document).on('change', '.filter-brand',function(e) {
	e.preventDefault();
	var this_var = $(this)
	$.ajax({
		type: 'get',
		url: base_url+"/admin/filter-sub-brand",
		data: {brand_id : $(this).val()},
		dataType: 'json',
	
		success: function(response) {
			var list = '<option value="">Choose Sub Brand</option>'
			$.each(response.brands, function(index, value){
				list += `<option value="${value.id}">${value.name}</option>`
			})
			this_var.parents().eq(3).find('.filter-sub-brand').html(list)
		},
		error: function(xhr, status, error) {
		}
			
	})
});



$(document).on('change', '.select-attributes',function(e) {
	e.preventDefault();
	var this_var = $(this);
	$.ajax({
		type: 'get',
		url: base_url+"/admin/filter-attribute",
		data: {attribute_id : $(this).val()},
		dataType: 'json',
	
		success: function(response) {
			var list = ''
			$.each(response.options, function(index, value){
				list += `<option value="${value}">${value}</option>`
			})
			this_var.parents().eq(1).find('.options').html(list)
		},
		error: function(xhr, status, error) {
		}
			
	})
});


$(document).on('click', '.remove-list', function(e){
 $(this).parents().eq(1).remove()
});
$(document).on('click', '#add-more', function(e){

	var attribute_list = '';
	$.each(attribute_data, function(index, value){
		attribute_list += `<option value="${value.id}">${value.lable}</option>`
	})
	$('#attribute_list').append(` <tr>
	<td>
		<select name="attribute[]" class="select select-attributes" id="">
			<option value="">Select Attribute</option>
			${attribute_list}
		</select>
	</td>
	<td>
		<select name="option[]" class="select options" id="">
			<option value="">Select Option</option>
		   
		</select>
	</td>
	<td>
		<button class="btn btn-sm btn-danger remove-list" type="button" >Delete</button>
	</td>
</tr>`)
$("select").select2()
})
$('.dropify').dropify();


$(document).on('click', '#add-more-product-row', function(e){
	e.preventDefault();
	var this_var = $(this);
	$.ajax({
		type: 'get',
		url: base_url+"/admin/render-multiple-product",
		data: {attribute_id : $(this).val()},
		dataType: 'json',
	
		success: function(response) {
			// console.log(response.data)
			$('#add-more-product-section').append(response.data)
			$('.dropify').dropify();
$("select").select2()

		},
		error: function(xhr, status, error) {
		}
			
	})
})




$(document).on('change', '.filter-state-city',function(e) {
	e.preventDefault();
	var this_var = $(this)
	$.ajax({
		type: 'get',
		url: base_url+"/admin/filter-city",
		data: {state_id : $(this).val()},
		dataType: 'json',
	
		success: function(response) {
			var list = '<option value="">Choose City</option>'
			$.each(response.cities, function(index, value){
				list += `<option value="${value.id}">${value.name}</option>`
			})
			// console.log(list)
			this_var.parents().eq(4).find('.state-city-list').html(list)
		},
		error: function(xhr, status, error) {
		}
			
	})
});

$(document).on('keyup', '#search-product',function(e) {
	e.preventDefault();
	var this_var = $(this)
	$('.search-product-list').html('')
	if($(this).val() != '') {

		var data = $('.submit-form').serialize()+"&search="+$(this).val()
		$.ajax({
			type: 'get',
			url: base_url+"/admin/search-product",
			data: data,
			dataType: 'json',
		
			success: function(response) {
				console.log(response)
				// var list = '<option value="">Choose City</option>'
				var list = '';
				$.each(response.data, function(product_index, product_value){
					$.each(product_value.varaints, function(index, value){
						var attributes = '';
						$.each(value.product_attributes, function(a_index, a_value){
							attributes += '/'+a_value.attribute_value;
						});
						list += `<li class="search-product-item search-product-item-product" data-key="${value.id}"><a>${product_value.name} ${attributes}</a></li>`
						// list += `<option value="${value.id}">${value.name}</option>`
					})
				})
				$('.search-product-list').html(list)
				// console.log(list)
				// this_var.parents().eq(4).find('.state-city-list').html(list)
			},
			error: function(xhr, status, error) {
			}
				
		})
	}
});

$(document).on('click', '.search-product-item-product',function(e) {
	e.preventDefault();
	var value = $(this).attr('data-key')
	var this_var = $(this)
	$.ajax({
		type: 'get',
		url: base_url+"/admin/purchase-product-form",
		data: {product_id : value},
		dataType: 'json',
	
		success: function(response) {
			// console.log(response)
			this_var.addClass('active')
			$('#purchase-items').append(response.data)
			$("select").select2()
			
		},
		error: function(xhr, status, error) {
		}
			
	})
});





$(document).on('click', function(event) {

    if (!$(event.target).closest('.search-product-list').length) {
      $('.search-product-list').html('')
    }
  });


  $(document).on('click', '.remove-purchase-item', function(e){
	$(this).parents().eq(1).remove()
  })

  $(document).on('change', '.purchase-quantity', function(e){
	var quanity = $(this).parents().eq(1).find('.quantity').val()
	var price = $(this).parents().eq(1).find('.unit-price').val()
	var mrp = $(this).parents().eq(1).find('.unit-price').attr('data-mrp')
	var purchase_tax = $(this).parents().eq(1).find('.purchase_tax').val();
	if(parseFloat(price) > parseFloat(mrp)) {
		alert('Price should be less then mrp')
		price = parseFloat(mrp)
		$(this).parents().eq(1).find('.unit-price').val(mrp)
		// return false
	}
	
	// console.log(parseFloat(quanity) +"*"+ parseFloat(price))
	var tax_price = (price*purchase_tax)/100;
	var total_tax_price = (parseFloat(tax_price)*parseFloat(quanity))
	$(this).parents().eq(1).find('.tax_amount').val(tax_price)
	// $(this).parents().eq(1).find('.unit-price').val((parseFloat(price) - tax_price).toFixed(2))
	$(this).parents().eq(1).find('.tax-value').html((parseFloat(tax_price)*parseFloat(quanity)).toFixed(2))
	var total = (parseFloat(quanity) * parseFloat(price));
	$(this).parents().eq(1).find('.final-price').val(parseFloat(total+total_tax_price).toFixed(2))
	var final = 0
	$('.final-price').each(function(){
		final += parseFloat($(this).val())
		$('#grand-total').html(final)
		$('#final-price').val(final)
	})
  })

  $(document).on('change', '.purchase-inward-quantity', function(e){
	var quanity = $(this).parents().eq(1).find('.quantity').val()
	var price = $(this).parents().eq(1).find('.unit-price').val()

	var total = (parseFloat(quanity) * parseFloat(price));
	$(this).parents().eq(1).find('.final-price').val(parseFloat(total).toFixed(2))
	var final = 0
	$('.final-price').each(function(){
		console.log($(this).val());
		final += parseFloat($(this).val())
		$('#grand-total').html(final)
		$('#final-price').val(final)
	})
  })


  $(document).on('keyup', '#search-product-for-transer',function(e) {
	e.preventDefault();
	var this_var = $(this)
	var store_id = $('#from_store').val();
	$('.search-product-list').html('')
	var data = $('.submit-form').serialize()+"&search="+$(this).val()+"&store_id="+store_id;
	
	$.ajax({
		type: 'get',
		url: base_url+"/admin/search-product-for-transer",
		data: data,
		dataType: 'json',
	
		success: function(response) {
			// var list = '<option value="">Choose City</option>'
			var list = '';
			$.each(response.data, function(index, value){
				console.log(value.id, 'response')
				list += `<li class="search-product-item search-product-item-transfer" data-key="${value.id}"><a>${value.product_name} ${value.category} ${value.subcategory} ${value.brand_name} (sku : ${value.sku} >>  quanitity : ${value.left_quantity} >> unit : price ${value.unit_price})</a></li>`
				// list += `<option value="${value.id}">${value.name}</option>`
			})
			$('.search-product-list').html(list)
			// console.log(list)
			// this_var.parents().eq(4).find('.state-city-list').html(list)
		},
		error: function(xhr, status, error) {
		}
			
	})
});


$(document).on('click', '.search-product-item-transfer',function(e) {
	e.preventDefault();
	var value = $(this).attr('data-key')
	var this_var = $(this)
	var store_id = $('#from_store').val();
	$('.search-product-list').html('')
	$.ajax({
		type: 'get',
		url: base_url+"/admin/transfer-product-form",
		data: {inventory_id : value, 'store_id' : store_id},
		dataType: 'json',
	
		success: function(response) {
			console.log(response)	
			this_var.addClass('active')
			$('#transfer-items').append(response.data)
			$("select").select2()
			
			
		},
		error: function(xhr, status, error) {
		}
			
	})
});



$(document).on('change', '.payment-type-option', function(e) {
	$('.setvaluecash ul li a').removeClass('active')
	$(this).parents().eq(0).find('a').addClass('active')
})

	
$(document).on('click', '#add-more-product', function(e) {
	$('#product-list').append(html);
	$("select").select2()
})

	



function get_order_products() {
	var data = $('.filter-data').serialize();
	$.ajax({
		type :'get',
		url : base_url+"/admin/customer-order-products",
		data : data,
		dataType : 'json',
		success : function(response) {
			$('#pos-product-list').html(response.data)
		},
		error : function(error) {
			
		}
	})
}

$(document).on('keyup', '.order-search-product', function(e){
	get_order_products()
})


$(document).on('click', '.remove-attribute', function(e){
	e.preventDefault();
	
	$(this).parents(1).remove();
})

$(document).on('change', '.wholesale-discount', function(e){
	var discount_type = $('#wholesale_discount_type').val();
	
	var price = $('#wholesale_price').val() ? $('#wholesale_price').val() : 0 ;
	var discount = $('#wholesale_discount').val() ? $('#wholesale_discount').val() : 0;
	if(discount_type == 1) {
		// alert(discount_type)
		$('#wholesale_regular_price').val(parseInt(price) - parseInt(discount))
	}
	else if(discount_type == 2) {
		// alert(discount_type)
		var percentage = (parseInt(discount)/100)*parseInt(price);
		$('#wholesale_regular_price').val(parseInt(price) - percentage)
	}
	else {
		$('#wholesale_regular_price').val(price)

	}
})

$(document).on('change', '.customer-discount', function(e){
	var discount_type = $('#discount_type').val();
	
	var price = $('#price').val() ? $('#price').val() : 0 ;
	var discount = $('#discount').val() ? $('#discount').val() : 0;
	if(discount_type == 1) {
	
		$('#regular_price').val(parseInt(price) - parseInt(discount))
	}
	else if(discount_type == 2) {

		var percentage = (parseInt(discount)/100)*parseInt(price);
		$('#regular_price').val(parseInt(price) - percentage)
	}
	else {
		$('#regular_price').val(price)

	}

})

$(document).on('change', '.sku-details', function(e){
	e.preventDefault();
	var this_var = $(this)
	$.ajax({
		type: 'GET',
		url: base_url+"/admin/product-sku",
		data: {id : $(this).val()},
		dataType: 'json',
		success: function(response) {
			
			console.log(response)
			this_var.parents().eq(1).find('.price-details').html(`Price (C) = ${response.data.price}<br>Price (W) = ${response.data.wholesale_price}<br>MRP = ${response.data.mrp}`)

		},
		error: function(xhr, status, error) {
			
		}
	})
})


$(document).on('change', '#update_inventory', function(e){
	if($(this).val() == 'yes') {
		$('.update_inventory-section').show()
	}
	else {
		$('.update_inventory-section').hide()

	}
})