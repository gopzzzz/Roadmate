  <!-- SCRIPTS -->
  <!-- JQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>


<!-- DataTables -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.html5.min.js')}}"></script>
<!-- AdminLTE App -->

<script>
  $(function () {
    var table = $("#example1").DataTable({
					"searching": true,
					dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						]
    			});
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
	$('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $("#status").change(function () {
	var status=$(this).val();
	$.ajax({
			type: "POST",
			dataType: "html",
			url: "{{ route('customers') }}",
			data: {  "_token": "{{ csrf_token() }}",
			status: status },
			success: function (res) {
				if(res)
				{
					$('#customer_table1').hide();
					$('#customer_table2').html(res);
					$("#example3").DataTable({
						"searching": true,
						dom: 'Bfrtip',
							buttons: [
								'copy', 'csv', 'excel', 'pdf', 'print'
							]
					});
                }
			}
			
			});
				
  });
</script>

  <script>
  $('.selectvehicle').on('change',function(){
	var id=$(this).val();
	if(id){
		$.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('vehbrandfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          			//var obj=JSON.parse(res)
					 // brandlist
					 $('#brandlist').empty();
					 var html_each="<option value='0'>select</option>";
					  $.each( res, function( key, value ) {
  					html_each += '<option value='+value.id+'>'+value.brand+'</option>'
					});
					$('#brandlist').append(html_each);
					},
					});	
	}
  });
  $(document).on('click','.pending-modal',function(){
	var id=$(this).data('id');
	$('#keyid').val(id);
	$('#exampleModal11').modal('show');
  });

  $('.selectvehicleadd').on('change',function(){
	var id=$(this).val();
	if(id){
		$.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('vehbrandfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          			//var obj=JSON.parse(res)
					 // brandlist
					 $('#brandlistadd').empty();
					 var html_each="<option value='0'>select</option>";
					  $.each( res, function( key, value ) {
  					html_each += '<option value='+value.id+'>'+value.brand+'</option>'
					});
					$('#brandlistadd').append(html_each);
					},
					});	
	}
  });
  $('.brandmodelfetch').on('change',function(){
	 
	var id=$(this).val();
	if(id){
		$.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('brmodelfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          			//var obj=JSON.parse(res)
					 // brandlist
					 $('#modellist').empty();
					 var html_each="<option value='0'>select</option>";
					  $.each( res, function( key, value ) {
  					html_each += '<option value='+value.id+'>'+value.brand_model+'</option>'
					});
					$('#modellist').append(html_each);
					},
					});	
	}
  });

  $('.brandmodelfetchadd').on('change',function(){
	 
	 var id=$(this).val();
	 if(id){
		 $.ajax({
					 type: "POST",
					 dataType: "json",
					 url: "{{ route('brmodelfetch') }}",
					 data: {  "_token": "{{ csrf_token() }}",
					 id: id },
					 success: function (res) {
					 console.log(res);
					   //var obj=JSON.parse(res)
					  // brandlist
					  $('#modellistadd').empty();
					  var html_each="<option value='0'>select</option>";
					   $.each( res, function( key, value ) {
					   html_each += '<option value='+value.id+'>'+value.brand_model+'</option>'
					 });
					 $('#modellistadd').append(html_each);
					 },
					 });
	 }
   });
   $(document).on('click','.edit_timeslot',function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('timeslotfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#cust').val(obj.customer_id);
		 // $('#image').val(obj.image);
          $('#shop_cat').val(obj.shop_category_id);
          $('#shop').val(obj.shop_id);
          $('#type1').val(obj.book_type);
          $('#date').val(obj.adate);
          $('#time').val(obj.timeslots);
          $('#timeedit_id').val(obj.id);
         
					},
					});	
		}
		$('#edittimeslot_modal').modal('show');
	});



	$(document).on('click','.view_timeslot',function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('timeslotfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#cust1').val(obj.customer_id);
		 // $('#image').val(obj.image);
          $('#shop_cat1').val(obj.shop_category_id);
          $('#shop1').val(obj.shop_id);
          $('#type2').val(obj.book_type);
          $('#date1').val(obj.adate);
          $('#time1').val(obj.timeslots);
          $('#timeview_id').val(obj.id);
         
					},
					});	
		}
		$('#viewtimeslot_modal').modal('show');
	});
	
	$('.add_vehicle').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packagefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
        
          $('#packagevehid').val(obj.id);
         
         
					},
					});	

					$.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('packageforvehiclefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (data) {
						$("#vehiclelist_edit").empty();
					console.log(data);
					var html_each ="";
					$i=1;
					$.each(data, function (index, itemData) {
						html_each +='<tr><td>'+$i+'</td><td>'+itemData.veh_type+'</td><td>'+itemData.brand_model+'</td><td>'+itemData.fuel+'</td><td><a href="{{ URL::asset('/packagedeleteforveh/') }}/'+itemData.id +'"><li class="fa fa-trash"></li></a></td></tr>'
						$i++;
					});
					$("#vehiclelist_edit").append(html_each);
         
         
					},
					});	
		}
		$('#addvehicle').modal('show');
	});

	$('.addfeatures').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packagefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
        
          $('#packagefeatureid').val(obj.id);
         
         
					},
					});	

					$.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('packagefeaturefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (data) {
						$("#featurelistedit").empty();
					console.log(data);
					var html_each ="";
					$i=1;
					$.each(data, function (index, itemData) {
						html_each +='<tr><td>'+$i+'</td><td>'+itemData.featuredel+'</td><td><a href="{{ URL::asset('/packfeaturesdelete/') }}/'+itemData.id +'"><li class="fa fa-trash"></li></a></td></tr>'
						$i++;
					});
					$("#featurelistedit").append(html_each);
         
         
					},
					});	
		}

		
		$('#packagefeaturemodal').modal('show');
	});

	$('.edit_exe').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('executivefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#name').val(obj.name);
		 // $('#image').val(obj.image);
          $('#email').val(obj.email);
          $('#phnum').val(obj.phonenum);
          $('#district').val(obj.district);
          $('#location').val(obj.location);
          $('#address').val(obj.addrress);
          $('#exeid').val(obj.id);
         
					},
					});	
		}
		$('#editexecutive_modal').modal('show');
	});
	//
	$('.edit_sup').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('supabfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#name').val(obj.name);
		  $('#email').val(obj.email);
          $('#phnum').val(obj.phonenum);
          $('#district').val(obj.district);
          $('#location').val(obj.location);
          $('#address').val(obj.addrress);
          $('#exeid').val(obj.id);
         
					},
					});	
		}
		$('#edit_sup').modal('show');
	});
	//
	
	$('.view_execu').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('executivefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#name1').val(obj.name);
		 // $('#image').val(obj.image);
          $('#email1').val(obj.email);
          $('#phnum1').val(obj.phonenum);
          $('#district1').val(obj.district);
          $('#location1').val(obj.location);
          $('#address1').val(obj.addrress);
          $('#exeviewid').val(obj.id);
         
					},
					});	
		}
		$('#viewexecutive_modal').modal('show');
	});
  $('.edit_banner').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('bannerfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          //$('#image').val(obj.name);
          $('#bannertype').val(obj.banner_type);
          $('#bannerid').val(obj.id);
         
					},
					});	
		}
		$('#editbanner_modal').modal('show');
	});
	
	$('.view_banner').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('bannerfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#bannerimage1').val(obj.image);
          $('#bannertype1').val(obj.banner_type);
          $('#bannerid').val(obj.id);
         
					},
					});	
		}
		$('#viewbanner_modal').modal('show');
	});


  $('.edit_shopcategory').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shop_categoriesfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          //$('#image').val(obj.name);
          $('#categoryname').val(obj.category);
          $('#categoryid').val(obj.id);
          $('#image').val(obj.image);
		  $('#ordernumber').val(obj.order_number);
		  $('#percentage').val(obj.roadmate_percentage);
         
					},
					});	
		}
		$('#editcategory_modal').modal('show');
	});
	$('.view_shopcategory').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shop_categoriesfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          //$('#image').val(obj.name);
          $('#categoryname1').val(obj.category);
          $('#categoryviewid"').val(obj.id);
          //$('#image').val(obj.image);
         
					},
					});	
		}
		$('#viewcategory_modal').modal('show');
	});
   
   
	$(document).on('click','.edit_shop',function(){

		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shopfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#category1').val(obj.type);
          $('#edit_id').val(obj.id);
          //$('#image').val(obj.image);
         // $('#timing').val(obj.timming);
          $('#shopname1').val(obj.shopname);
          $('#address1').val(obj.address);
          $('#phone3').val(obj.phone_number);
		  $('#phone4').val(obj.phone_number2);
          $('#pincode1').val(obj.pincode);
		  $('#open1').val(obj.open_time);
		  $('#close1').val(obj.close_time);
		  $('#trans_id1').val(obj.trans_id);
		   if(obj.agrimentverification_status==1){
			  $("#verif_status3").prop("checked", true);
			 
			 // $('#verif_status3').attr('checked', true);
		  }else if(obj.agrimentverification_status==0){
			   $("#verif_statu4").prop("checked", true);
			// $('#verif_statu4').attr('checked', true);
		  }
		  if(obj.pay_status==1){
			  $("#pay_status3").prop("checked", true);
		  }else if(obj.pay_status==0){
			  $("#pay_status4").prop("checked", true);
		  }
		  if(obj.shop_oc_status==1){
			   $("#oc_status3").prop("checked", true);
		  }else if(obj.shop_oc_status==0){
			   $("#oc_status4").prop("checked", true);
		  }
		  $('#exename1').val(obj.exeid);
          $('#desc1').val(obj.description);
          $('#latitude1').val(obj.lattitude);
          $('#longitude1').val(obj.logitude);
         
					},
					});	
		}
		$('#editshop_modal').modal('show');
	});
	$(document).on('click','.view_shop',function(){

		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shopfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#category').val(obj.type);
          $('#id').val(obj.id);
         // $('#image').val(obj.image);
         // $('#timing').val(obj.timming);
          $('#shopname').val(obj.shopname);
          $('#address').val(obj.address);
          $('#phone1').val(obj.phone_number);
		  $('#phone2').val(obj.phone_number2);
          $('#pincode').val(obj.pincode);
		  $('#open').val(obj.open_time);
		  $('#close').val(obj.close_time);
		  $('#trans_id').val(obj.trans_id);
		 if(obj.agrimentverification_status==1){
			  $("#verif_status_1").prop("checked", true);
			 
			 // $('#verif_status3').attr('checked', true);
		  }else if(obj.agrimentverification_status==0){
			   $("#verif_status_0").prop("checked", true);
			// $('#verif_statu4').attr('checked', true);
		  }
		  if(obj.pay_status==1){
			  $("#pay_status_1").prop("checked", true);
		  }else if(obj.pay_status==0){
			  $("#pay_status_0").prop("checked", true);
		  }
		  if(obj.shop_oc_status==1){
			   $("#oc_status_1").prop("checked", true);
		  }else if(obj.shop_oc_status==0){
			   $("#oc_status_0").prop("checked", true);
		  }
		  $('#exename').val(obj.exeid);
          $('#desc').val(obj.description);
          $('#latitude').val(obj.lattitude);
          $('#longitude').val(obj.logitude);
         
					},
					});	
		}
		$('#viewshop_modal').modal('show');
	});
	$('.edit_storecategory').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('store_categoriesfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          //$('#image').val(obj.name);
          $('#categoryname').val(obj.cat_name);
          $('#categoryid').val(obj.id);
         
					},
					});	
		}
		$('#editstorecategory_modal').modal('show');
	});
	$('.view_storecategory').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('store_categoriesfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          //$('#image').val(obj.name);
          $('#categoryname1').val(obj.cat_name);
          $('#categoryviewid').val(obj.id);
         
					},
					});	
		}
		$('#viewstorecategory_modal').modal('show');
	});
  $('.edit_vehtype').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('vehtypefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#vehid').val(obj.id);
          $('#vehicletype').val(obj.veh_type);
         
					},
					});	
		}
		$('#editvehicle_modal').modal('show');
	});
	$('.view_vehtype').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('vehtypefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#vehviewid').val(obj.id);
          $('#vehicletype1').val(obj.veh_type);
         
					},
					});	
		}
		$('#viewvehicle_modal').modal('show');
	});
	$('.viewwallet').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('walletsfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#wallid').val(obj.id);
          $('#cust').val(obj.user_id);
           $('#amount').val(obj.amount_credited);
					},
					});	
		}
		$('#viewwallet_modal').modal('show');
	});
	$('.viewwalletcrd').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('walletcredithisfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#wallcrdid"').val(obj.id);
          $('#cust').val(obj.credited_by);
           $('#amount').val(obj.credited_amount);
		   $('#purp').val(obj.purpose);
					},
					});	
		}
		$('#viewwalletcrd_modal').modal('show');
	});
	$('.viewwalletdbt').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('walletdebtthisfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#walldbtid"').val(obj.id);
          $('#cust').val(obj.user_id);
           $('#amount').val(obj.debit_amount);
		    $('#debt').val(obj.debited_to);
		   $('#purp').val(obj.debited_purpose);
					},
					});	
		}
		$('#viewwalletdbt_modal').modal('show');
	});
	$('.edit_fueltype').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('fueltypefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#fuelid').val(obj.id);
          $('#fueltype').val(obj.fuel_type);
         
					},
					});	
		}
		$('#editfuel_modal').modal('show');
	});

	$('.edit_feature').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('featurefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#featureid').val(obj.id);
          $('#feature').val(obj.feature);
         
					},
					});	
		}
		$('#editfuel_modal').modal('show');
	});

	$('.view_fueltype').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('fueltypefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#fuelid_view').val(obj.id);
          $('#fueltype_view').val(obj.fuel_type);
         
					},
					});	
		}
		$('#viewfuel_modal').modal('show');
	});
  $('.editbrand').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
		           type: "POST",

					url: "{{ route('brandfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#vehid_edit').val(obj.id);
          $('#vehtype1').val(obj.vehicle);
          $('#brand1').val(obj.brand);
					},
					});	
		}
		$('#editbrand_modal').modal('show');
	});
	$('.view_brand').click(function(){
		var id=$(this).data('id');
	  if(id){
      $.ajax({
		           type: "POST",

					url: "{{ route('brandfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#vehid_view').val(obj.id);
          $('#vehtype_view').val(obj.vehicle);
          $('#brand_view').val(obj.brand);
					},
					});	
		}
		$('#viewbrand_modal').modal('show');
	});
  $('.editmodel').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('modelfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#modeledit_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand').val(obj.brand);
		  $('#model').val(obj.brand_model);
		  $('#fuel_type').val(obj.fuel_type);
					},
					});	
		}
		$('#editmodel_modal').modal('show');
	});
	
	 $('.viewmodel').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('modelfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#modelview_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand_view').val(obj.brand);
		  $('#model_view').val(obj.brand_model);
		  $('#fuel_type_view').val(obj.fuel_type);
					},
					});	
		}
		$('#viewmodel_modal').modal('show');
	});
	
	$('.viewviechle').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('vehclefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#vehclview_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand').val(obj.brand);
		  $('#model').val(obj.model);
		  $('#fuel_type').val(obj.fuel_type);
					},
					});	
		}
		$('#viewvehicle_modal').modal('show');
	});
	$('.editviechle').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('vehclefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#vehcledit_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand1').val(obj.brand);
		  $('#model1').val(obj.model);
		  $('#fuel_type1').val(obj.fuel_type);
					},
					});	
		}
		$('#editvehicle_modal').modal('show');
	});
	$('.viewcustvehcl').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('uservehclefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#custvehview_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand').val(obj.vehicle_brand);
		  $('#model').val(obj.vehicle_model);
		  $('#fuel_type').val(obj.fuel_type);
		  $('#cust').val(obj.user_id);
		  $('#vehtype_view').val(obj.vehicle_type);
		  $('#veh_num').val(obj.vehicle_number);
					},
					});	
		}
		$('#viewcustvehl_modal').modal('show');
	});
  $('.editcustvehcl').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('uservehclefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#custvehedit_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand1').val(obj.vehicle_brand);
		  $('#model1').val(obj.vehicle_model);
		  $('#fuel_type1').val(obj.fuel_type);
		  $('#cust1').val(obj.user_id);
		  $('#vehtype_view1').val(obj.vehicle_type);
		  $('#veh_num1').val(obj.vehicle_number);
					},
					});	
		}
		$('#editcustvehl_modal').modal('show');
	});
  $('#vehicle').on('change',function(){
	  var id=$(this).val();
	  $.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('brandidfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
					if(res){	
				$("#brandselect").empty();	
				$("#brandselect").append('<option>Select</option>');
				$.each(res,function(key,value){		
				$("#brandselect").append('<option value="'+key+'">'+value+'</option>');	
				});           			
				}else{			
				$("#brandselect").empty();		
				}
					},
					});	
  });

  $('#vehtype').on('change',function(){
	  var id=$(this).val();
	  $.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('brandidfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
					if(res){	
				$("#brandeditselect").empty();	
				$("#brandeditselect").append('<option>Select</option>');
				$.each(res,function(key,value){		
				$("#brandeditselect").append('<option value="'+key+'">'+value+'</option>');	
				});           			
				}else{			
				$("#brandeditselect").empty();		
				}
					},
					});	
  });
  $('.editfeature').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('featurefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
		   $('#package1').val(obj.package_id);
          $('#feature1').val(obj.feature);
         
					},
					});	
		}
		$('#editfeaturemodal').modal('show');
	});
	$('.viewfeature').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('featurefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#feat_id').val(obj.id);
		   $('#package_view').val(obj.package_id);
          $('#feature_view').val(obj.feature);
         
					},
					});	
		}
		$('#viewfeaturemodal').modal('show');
	});
	$('.viewstorequeri').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('mystorequeriesfeatch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#query_id').val(obj.id);
          $('#question1').val(obj.question);
         $('#customer1').val(obj.quserid);
					},
					});	
		}
		$('#viewstorequerismodal').modal('show');
	});
	$('.viewquerianswr').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('storequeryanswrfeatch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#qanswr_id').val(obj.id);
          $('#quest1').val(obj.question_id);
		   $('#answr1').val(obj.answer);
         $('#customer1').val(obj.anuserid);
					},
					});	
		}
		$('#viewstrquryanswermodal').modal('show');
	});
	$('.editquerianswr').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('storequeryanswrfeatch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#qanswredit_id').val(obj.id);
          $('#quest').val(obj.question_id);
		   $('#answr').val(obj.answer);
         $('#customer').val(obj.anuserid);
					},
					});	
		}
		$('#editstrquryanswermodal').modal('show');
	});
    $('.editcompackage').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packagefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
		  $('#pack_type').val(obj.package_type);
          $('#title').val(obj.title);
		  $('#description').val(obj.description);
		  $('#fuelid').val(obj.fuel);
		  $('#vehid').val(obj.vehtype);
		  $('#amount').val(obj.amount);
		  $('#shopamount').val(obj.shop_amount);
		  $('#offeramount').val(obj.offer_amount);
		  $('#offeramount').val(obj.offer_amount);
         $('#vehmodel1').val(obj.vehmodel);
		 $('#status').val(obj.status);
					},
					});	
		}
		$('#editcompackagemodal').modal('show');
	});

	//

	$('.editgiveway').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('giveawayfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					//console.log(res);
          var obj=JSON.parse(res)
          $('#package_id').val(obj.id);
		  $('#title').val(obj.title);
          $('#price').val(obj.price);
		  $('#normal').val(obj.normal_price);
		  $('#desc').val(obj.description);
		  $('#type').val(obj.vehicle_type);
		  
					},
					});	
		}
		$('#editgiveawaypackages').modal('show');
	});

	//
	
	$('.viewpackdet').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packagedetfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
		  $('#pack').val(obj.pkg_id);
          $('#det').val(obj.pkg_det_details);
					},
					});	
		}
		$('#viewpackdetmodal').modal('show');
	});
	
	$('.editpackdet').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packagedetfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#edit_id').val(obj.id);
		  $('#pack1').val(obj.pkg_id);
          $('#det1').val(obj.pkg_det_details);
					},
					});	
		}
		$('#editpackdetmodal').modal('show');
	});
	
	$('.viewpackshop').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packageshopfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
		  $('#shop').val(obj.pkg_shp_id);
          $('#packgs').val(obj.pkg_id);
					},
					});	
		}
		$('#viewpackshopmodal').modal('show');
	});
	$('.editpackshop').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packageshopfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#edit_id').val(obj.id);
		  $('#shop1').val(obj.pkg_shp_id);
          $('#packgs1').val(obj.pkg_id);
					},
					});	
		}
		$('#editpackshopmodal').modal('show');
	});
	
	$('.viewpackbook').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packagebookfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
		   $('#cust').val(obj.customer_id);
		    $('#randnum').val(obj.random_num);
		  $('#shop').val(obj.shop_id);
          $('#packgs').val(obj.package_id);
					},
					});	
		}
		$('#viewpackbookmodal').modal('show');
	});
	
	$('.viewcompackage').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packagefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#edit_id').val(obj.id);
		  $('#pack_type1').val(obj.package_type);
          $('#title1').val(obj.title);
		  $('#description1').val(obj.description);
		  $('#fuelid1').val(obj.fuel);
		  $('#vehid1').val(obj.vehtype);
		  $('#amount1').val(obj.amount);
		  $('#shopamount1').val(obj.shop_amount);
		  $('#offeramount1').val(obj.offer_amount);
		 // $('#offeramount').val(obj.offer_amount);
         $('#vehmodel2').val(obj.vehmodel);
		 $('#status1').val(obj.status);
					},
					});	
		}
		$('#viewcompackagemodal').modal('show');
	});
	$('.editstore').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('storefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
          $('#prod_cat').val(obj.store_prod_category);
		  $('#name').val(obj.product_name);
		  $('#price').val(obj.price);
		  $('#desc').val(obj.description);
		  $('#utype').val(obj.user_type);
		  $('#cust').val(obj.user_id);
		 			},
					});	
		}
		$('#editstore_modal').modal('show');
	});
	$('.viewstore').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('storefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#edit_id').val(obj.id);
          $('#prod_cat1').val(obj.store_prod_category);
		  $('#name1').val(obj.product_name);
		  $('#price1').val(obj.price);
		  $('#desc1').val(obj.description);
		  $('#utype1').val(obj.user_type);
		  $('#cust1').val(obj.user_id);
		 			},
					});	
		}
		$('#viewstore_modal').modal('show');
	});
	$('.editqu').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('queryfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
          $('#query').val(obj.question);
		  $('#category').val(obj.quserid);
		
		 			},
					});	
		}
		$('#editquerymodal').modal('show');
	});
	$('.edit_tcdetails').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('termconditionfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#tcedit_id').val(obj.id);
          $('#tc_edit').val(obj.tc_details);
         
					},
					});	
		}
		$('#edittc_modal').modal('show');
	});
	$('.view_tcdetails').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('termconditionfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#tcview_id').val(obj.id);
          $('#tc_view').val(obj.tc_details);
         
					},
					});	
		}
		$('#viewtc_modal').modal('show');
	});
	$('.view_csdetails').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('suggcomplntfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#csview_id').val(obj.id);
          $('#shop').val(obj.shopid);
          $('#sug_view').val(obj.suggestion);
		  $('#comp_view').val(obj.complaint);
					},
					});	
		}
		$('#viewcs_modal').modal('show');
	});
	$('.viewpackserv').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packageservicefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#packservnew_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#cat_view').val(obj.service_id);
		  $('#pack_view').val(obj.package_id);
		  
					},
					});	
		}
		$('#viewpackserv_modal').modal('show');
	});
	$('.editpackserv').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('packageservicefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#packservedit_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#cat_view1').val(obj.service_id);
		  $('#pack_view1').val(obj.package_id);
		  
					},
					});	
		}
		$('#editpackserv_modal').modal('show');
	});
	$('.viewprdtoffr').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('product_offersfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
		 // $('#image').val(obj.image);
          $('#shop').val(obj.shop_id);
          $('#otype').val(obj.offer_type);
          $('#title').val(obj.title);
          $('#desc').val(obj.description);
          $('#norm_amunt').val(obj.normal_amount);
          $('#dis_amunt').val(obj.discount_amount);
		  $('#edate').val(obj.end_date);
         
					},
					});	
		}
		$('#viewprodoffrmodal').modal('show');
	});
	
	$('.editprdtoffr').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('product_offersfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#edit_id').val(obj.id);
		 // $('#image').val(obj.image);
          $('#shop1').val(obj.shop_id);
          $('#otype1').val(obj.offer_type);
          $('#title1').val(obj.title);
          $('#desc1').val(obj.description);
          $('#norm_amunt1').val(obj.normal_amount);
          $('#dis_amunt1').val(obj.discount_amount);
		  $('#edate1').val(obj.end_date);
         
					},
					});	
		}
		$('#editprodoffrmodal').modal('show');
	});
	
	$('.viewshptoffr').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shop_offersfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
		 // $('#image').val(obj.image);
          $('#shop').val(obj.shop_id);
		  $('#cat').val(obj.shop_cat_id);
		  $('#vetyp').val(obj.vehicle_typeid);
		  $('#brand').val(obj.brand_id);
		  $('#model').val(obj.model_id);
          $('#otype').val(obj.offer_type);
          $('#title').val(obj.title);
          $('#desc').val(obj.small_desc);
          $('#norm_amunt').val(obj.normal_amount);
          $('#dis_amunt').val(obj.offer_amount);
		  $('#edate').val(obj.offer_end_date);
         
					},
					});	
		}
		$('#viewshopoffrmodal').modal('show');
	});
	$('.editshptoffr').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shop_offersfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#edit_id').val(obj.id);
		 // $('#image').val(obj.image);
          $('#shop1').val(obj.shop_id);
		  $('#cat1').val(obj.shop_cat_id);
		  $('#vetyp1').val(obj.vehicle_typeid);
		  $('#brand1').val(obj.brand_id);
		  $('#model1').val(obj.model_id);
          $('#otype1').val(obj.offer_type);
          $('#title1').val(obj.title);
          $('#desc1').val(obj.small_desc);
          $('#norm_amunt1').val(obj.normal_amount);
          $('#dis_amunt1').val(obj.offer_amount);
		  $('#edate1').val(obj.offer_end_date);
         
					},
					});	
		}
		$('#editshopoffrmodal').modal('show');
	});
	$('.viewshpprvdcat').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shop_providcatfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#id').val(obj.id);
		 // $('#image').val(obj.image);
          $('#shop').val(obj.shop_id);
		  $('#cat').val(obj.shop_cat_id);
		  
         
					},
					});	
		}
		$('#viewshpprvdcatmodal').modal('show');
	});
	$('.editshpprvdcat').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shop_providcatfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#edit_id').val(obj.id);
		 // $('#image').val(obj.image);
          $('#shop1').val(obj.shop_id);
		  $('#cat1').val(obj.shop_cat_id);
		  
         
					},
					});	
		}
		$('#editshpprvdcatmodal').modal('show');
	});
	$('.viewcustrevw').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shopreviewsfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#revwnewid').val(obj.id);
		 // $('#image').val(obj.image);
          $('#shop').val(obj.shop_id);
          $('#cust').val(obj.user_id);
          $('#commnt').val(obj.comment);
          $('#count').val(obj.review_count);
        
					},
					});	
		}
		$('#viewreview_modal').modal('show');
	});
	
	$('.viewoffrmodel').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shopoffermodelsfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#offrmdlview_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand').val(obj.brand_id);
		  $('#model').val(obj.model_id);
		  $('#offr').val(obj.offer_id);
		  $('#shop').val(obj.shop_id);
		  $('#vehtype_view').val(obj.vehicle_type_id);
		 
					},
					});	
		}
		$('#viewoffrmodl_modal').modal('show');
	});
	$('.editoffrmodel').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shopoffermodelsfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#edit_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand1').val(obj.brand_id);
		  $('#model1').val(obj.model_id);
		  $('#offr1').val(obj.offer_id);
		  $('#shop1').val(obj.shop_id);
		  $('#vehtype_view1').val(obj.vehicle_type_id);
		 
					},
					});	
		}
		$('#editoffrmodl_modal').modal('show');
	});
	$(document).on('click','.viewshopserv',function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shopservicesfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#shopservview_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand').val(obj.vehicle_brand_id);
		  $('#model').val(obj.vehicle_model_id);
		  $('#shop_cat').val(obj.shop_category);
		  $('#shop').val(obj.shop_id);
		  $('#vehtype_view').val(obj.vehicle_type_id);
		 
					},
					});	
		}
		$('#viewshopserv_modal').modal('show');
	});
	$(document).on('click','.editshopserv',function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shopservicesfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#shopservedit_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          $('#brand1').val(obj.vehicle_brand_id);
		  $('#model1').val(obj.vehicle_model_id);
		  $('#shop_cat1').val(obj.shop_category);
		  $('#shop1').val(obj.shop_id);
		  $('#vehtype_view1').val(obj.vehicle_type_id);
		 
					},
					});	
		}
		$('#editshopserv_modal').modal('show');
	});
	$(document).on('click','.viewshoptim',function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shoptimeslotfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#shoptimview_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          
		  $('#shop').val(obj.shop_id);
		  $('#timeslot').val(obj.timeslot);
		 
					},
					});	
		}
		$('#viewshoptim_modal').modal('show');
	});
	$('.editshoptim').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('shoptimeslotfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#shoptimedit_id').val(obj.id);
         // $('#vehtype').val(obj.vehicle);
          
		  $('#shop1').val(obj.shop_id);
		  $('#timeslot1').val(obj.timeslot);
		 
					},
					});	
		}
		$('#editshoptim_modal').modal('show');
	});
	$('.shopname').on('keyup', function() {
            var shopname = $(this).val();
            //alert(location);		
            $.ajax({
                type: "POST",
                url: "{{ route('shopsearch') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    shopname: shopname
                },
                success: function(res) {
                    console.log(res);
                    if (res) {
                        $('#shoplist').show();
                        $('#shoplist').html(res);
                    } else {
                        $('#shoplist').html("");
                    }
                },
            });
        });
        $("html").on('click', '.shop_click', function() {
            var locationname = $(this).closest('tr').find('#id_SCR').val();
            var locationid = $(this).closest('tr').find('#fff').val();
            //alert(locationname);		
            $('#shopname').val(locationname);
            $('#shopid').val(locationid);
            $('#shoplist').hide();
        });
		$('.editshopbank').on('click',function(){
			var id=$(this).data('id');
	
	if(id){
  $.ajax({
				type: "POST",

				url: "{{ route('shopidfetch') }}",
				data: {  "_token": "{{ csrf_token() }}",
				id: id },
				success: function (res) {
				console.log(res);
	  var obj=JSON.parse(res)
	  $('#shopnameedit').val(obj.shopname);
	  $('#shopidedit').val(obj.shop_id);
	 $('#id').val(obj.id);
	  $('#bank').val(obj.bank);
	  $('#branch').val(obj.branch);
	  $('#ifsc').val(obj.ifsc);
	  $('#bankaccount').val(obj.bankaccount);
	  $('#bankholdername').val(obj.account_holdername);
	 
				},
				});	
	}
			$('#editshopbankmodal').modal('show');
		});

		$('.shopnamedit').on('keyup', function() {
            var shopname = $(this).val();
            //alert(location);		
            $.ajax({
                type: "POST",
                url: "{{ route('shopsearch') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    shopname: shopname
                },
                success: function(res) {
                    console.log(res);
                    if (res) {
                        $('#shopnamelist').show();
                        $('#shopnamelist').html(res);
                    } else {
                        $('#shopnamelist').html("");
                    }
                },
            });
        });
        $("html").on('click', '.shop_click', function() {
            var shopname = $(this).closest('tr').find('#id_SCR').val();
            var shopid = $(this).closest('tr').find('#fff').val();
            //alert(locationname);		
            $('#shopnameedit').val(shopname);
            $('#shopidedit').val(shopid);
            $('#shopnamelist').hide();
        });


		$('#example1').on('click','.visitedshop',function(){
			
			var id=$(this).data('id');
			
			if(id){
				$.ajax({
                type: "POST",
				dataType: "json",
                url: "{{ route('visitedshop') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(res) {
					$('#visitedshoptbody').empty();
                    console.log(res);
					var html_each='';
					$i=1;
                    $.each( res, function( key, value ) {
						html_each+='<tr>'
						html_each+='<td>'+$i+'</td>';
						html_each+='<td>'+value.shopname+'</td>';
						html_each+='<td>'+value.phone_number+'</td>';
						html_each+='<td>'+value.address+'</td>';
						html_each+='<td><a href="{{ URL::asset('/converttoaddedshops/') }}/'+value.id +'""><i class="fa fa-arrow-right"></i></a></td>';
						html_each+='</tr>';
						$i++;
						});
					$('#visitedshoptbody').append(html_each);
                },
            });
			}
			$('#visitedshopmodal').modal('show');
		});

		$('#example1').on('click','.addedshop',function(){
			
			var id=$(this).data('id');
			
			
			if(id){
				$.ajax({
                type: "POST",
				dataType: "json",
                url: "{{ route('addedshop') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(res) {
					$('#visitedshoptbody').empty();
                    console.log(res);
					var html_each='';
					$i=1;
                    $.each( res, function( key, value ) {
						html_each+='<tr>'
						html_each+='<td>'+$i+'</td>';
						html_each+='<td>'+value.shopname+'</td>';
						html_each+='<td>'+value.phone_number+'</td>';
						html_each+='<td>'+value.address+'</td>';
						
						html_each+='</tr>';
						$i++;
						});
					$('#visitedshoptbody').append(html_each);
                },
            });
			}
			$('#visitedshopmodal').modal('show');
		});

		
$('document').ready(function() {
  $('.edit_customerype').click(function() {
    var id=$(this).data('id');
  
  if(id){
    $.ajax({
        type: "POST",

        url: "{{ route('customertypefetch') }}",
        data: {  "_token": "{{ csrf_token() }}",
        id: id },
        success: function (res) {
      //  $('#editunit_modal').html(res);
        console.log(res);
        var obj=JSON.parse(res)
       $('#c_type').val(obj.customer_type);
      
        $('#cust_editid').val(obj.id);
       
        },
        }); 
  }
  $("#editcustomertype_modal").modal("show");
   // $('#dummyModal').modal('show');
  });
});
  </script>
  <script>
	  $('#search').on('click', function() {
            var customer_search = $('#customer_search').val();
					
            $.ajax({
                type: "POST",
                url: "{{route('searchcustomer')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    customer_search: customer_search
                },
                success: function(res) {
                   
                    if (res) {
						console.log(res);
                         $('#customer_table1').hide();
						 $('#customer_table2').show();
						 $('#customer_table2').html(res);
                        // $('#shoplist').html(res);
                    } else {
						$('#customer_table1').show();
						$('#customer_table2').hide();
                        
                    }
                },
            });
        });

		
		$('.searchshops').on('keyup',function(){
         
         
	
			var shopname = $(this).val();
			if (shopname != '' && shopname != 0) {
				$.ajax({
                                        type: "POST",
                                        dataType: "json",
                                        url: "{{ route('shopseachnew') }}",
                                        data: {  "_token": "{{ csrf_token() }}",
                                        shopname: shopname},
                                        success: function (res) {
					
						if (res) {
							$('#shoplist').show();
							$('#shoplist').html(res);
						} else {
							$('#shoplist').html("");
						}
					},



				});	
      		}
			else{
				$('#shoplist').html("");
			}
  });


  $('#shoplist').on('click','.subSelect_itemedit',function(){
			
			var itemValue = $(this).data('value');
                        var shopname=$('#id_SCR'+itemValue).val();
						 var shopid=$('#fff'+itemValue).val();
                        $('#shopid').val(shopid);
                        $('#shopname').val(shopname);
                     
			     $('#shoplist').hide();
			
		

                      

		});
	</script>
	<script>
		$('#search_bookingting_slot').keyup(function(){
			var searchval=$(this).val();
			$.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('search_timeslot') }}",
					data: {  "_token": "{{ csrf_token() }}",
					searchval: searchval},
					success: function (res) {
						console.log(res);
					
						if (res) {
							$('#non-searchtimeslot').hide();
							$('#timslot_pgination').hide();
							$('#searchtimeslot').html(res);
							
						} else {
							
							$('#searchtimeslot').html(res);
						
						}
					},



				});	
			


		});
	</script>
	<script>
		$('#search_shop').keyup(function(){
			var searchval=$(this).val();
			$.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('search_shop') }}",
					data: {  "_token": "{{ csrf_token() }}",
					searchval: searchval},
					success: function (res) {
						console.log(res);
					
						if (res) {
							 $('#non-searchshoplist').hide();
							$('#shop_pagination').hide();
							 $('#searchshoplist').html(res);
							
						} else {
							
							 $('#searchshoplist').html(res);
						
						}
					},



				});	
			


		});
	</script>
	<script>
		$('#search_shop_service').keyup(function(){
			var searchval=$(this).val();
			$.ajax({
					type: "POST",
					dataType: "json",
					url: "{{ route('search_shop_service') }}",
					data: {  "_token": "{{ csrf_token() }}",
					searchval: searchval},
					success: function (res) {
						console.log(res);
					
						if (res) {
							 $('#non-searchshopservice').hide();
							$('#shopservice_pagination').hide();
							 $('#searchshopservice').html(res.namshopsericeList);
							 
							
						} else {
							
							  $('#searchshopservice').html(res.namshopsericeList);
							 
						
						}
					},



				});	
			


		});
	</script>
 <script>
$(window).on('load', function(){ 
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({type: "POST",

                url: "{{ route('payment_support') }}",

                data: {  "_token": "{{ csrf_token() }}" },

                success: function (res) {
                    if(res.status==0)
                    {
                        
                        setTimeout(function(){
                            $('#duepayModal').modal('show');
                        }, 2000);
                        
                        $('#alert').text(res.message);

                    }
                    


                }
        });
  });
</script>