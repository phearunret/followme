  

$(function() {
	
	$( "a.item_in_day" ).click(function(e) {
		e.preventDefault();	
		var base_url = $(this).attr("href");
		var title = $(this).attr("alt");

       $.post( base_url, function(data) {

       		var num = 0;
       		var li ="";       		
	       	$.each(data, function(i,item){

	       		li += item.overdue;
	       		li += item.address;
	      		num = item.num;
	      
	        });

	        $('ul.itm-wrpper').html(li);

			    $( "ul.dialog" ).dialog({
					autoOpen: true,
					show: {
				        effect: "blind",
				        duration: 500
				      },
				      hide: {
				        effect: "explode",
				        duration: 1000
				      },
					title: title + ' (' + num +')',
					width: 700,
					height: 400,
					buttons: [
							{
								text: "Close",
								click: function() {
									$( 'ul.dialog' ).dialog( "close" );
								}
							}
						]
				});

			   
				$('a.addr_id').click(function(e) {
        			e.preventDefault(); 
        			var base_url = $(this).attr("href");
        			$.post( base_url, function(data) {
				       	var li ="";       		
					    $.each(data, function(i,item){
					       	li += item.addr;
					    });

				        $('ul.dropdown-menu').html(li);

				        } ,'json');
        	
    			});
    			 
       } ,'json');    
    }); // LESSEE OVERDUE IN DAYS


    $( "a.btn_fco_item" ).click(function(e) {
		e.preventDefault();	

		var base_url = $(this).attr("href");
		var title = $(this).attr("alt");
		var num = 0;
		 $.post( base_url, function(data) {

       		var li ="";
	       	$.each(data.items, function(i,item){
	       		num++;
	       		li += '<li class="itm-lst fco-wrapper">';
	       		li += '<img width="110" class="thumbnail img-left" src="http://192.168.7.8:8080/images/' + item.path +'">';
	       		li += '<div class="fco-right">';
	       		li += '<h6>'+ item.civil_code + '. ' + item.perso_va_firstname_en + ' ' + item.perso_va_lastname_en + '</h6>';
	       		li += '<p> ' + item.commu_desc_en +' Commune, ' + item.distr_desc_en +'District, '+item.prvin_desc_en +' Province.</p> ';
	       		li += 'Number overdue: 10 days';
	       		li += '</div>';
	       		li += '</li>';
	        	
	        });

	        $('ul.itm-wrpper').html(li);

			    $( "ul.dialog" ).dialog({
					autoOpen: true,
					show: {
				        effect: "blind",
				        duration: 1000
				      },
				      hide: {
				        effect: "explode",
				        duration: 4000
				      },
					title: title + ' (' + num +')',
					width: 700,
					height: 300,
					buttons: [
							{
								text: "Close",
								click: function() {
									$('ul.dialog').dialog( "close" );
								}
							}
						]
				});
 
       } ,'json');    
       
    }); //FCO


    $( "a.btn_leasee_comment" ).click(function(e) {
		e.preventDefault();	

		var base_url = $(this).attr("href");
		var title = $(this).attr("alt");
		var num = 0;
		 $.post( base_url, function(data) {

       		var li ="";
	       	$.each(data.items, function(i,item){
	       		num++;
	       		li += '<li class="itm-lst fco-wrapper">';
	       		li += '<img width="110" class="thumbnail img-left" src="http://192.168.7.8:8080/images/' + item.path +'">';
	       		li += '<div class="fco-right">';
	       		li += '<p class="text-info">'+ item.lesse_attribute +'</p>';
	       		li += '<h6 class="text-warning btn_sort_addr_by_id">'+ item.civil_code + '. ' + item.perso_va_firstname_en + ' ' + item.perso_va_lastname_en + '</h6>';
	       		li += '<p class="text-info"> ' + item.commu_desc_en +' Commune, ' + item.distr_desc_en +'District, '+item.prvin_desc_en +' Province.</p> ';
	       		li += '</div>';
	       		li += '</li>';
	        	
	        });

	        $('ul.itm-wrpper').html(li);

			    $( "ul.dialog" ).dialog({
					autoOpen: true,
					show: {
				        effect: "blind",
				        duration: 1000
				      },
				      hide: {
				        effect: "explode",
				        duration: 4000
				      },
					title: title + ' (' + num +')',
					width: 700,
					height: 300,
					buttons: [
							{
								text: "Close",
								click: function() {
									$('ul.dialog').dialog( "close" );
								}
							}
						]
				});
 
       } ,'json');    
       
    }); //Comment


    $( "a.btn_search" ).click(function(e) {
		e.preventDefault();	

		var base_url = $(this).attr("href");
		var title = $(this).attr("alt");

			li = '<div class="form-group">';
			li += '<label>Start:</label>';
			li += '<input type="number" class="form-control input-sm" id="start" value="1">';
			li += '</div>';

			li += '<div class="form-group">';
			li += '<label>To:</label>';
			li += '<input type="number" class="form-control input-sm" id="to" value="30">';
			li += '</div>';


	        $('ul.itm-wrpper').html(li);

			    $( "ul.dialog" ).dialog({
					autoOpen: true,
					show: {
				        effect: "blind",
				        duration: 1000
				      },
				      hide: {
				        effect: "explode",
				        duration: 4000
				      },
					title: title,
					width: 700,
					height: 250,
					buttons: [
							{
								text: "OK",
								click: function() {

									var start = $('#start').val();
									var to = $('#to').val();

									base_url += '/' + start + '/' + to;
									var num = 0;
									$.post( base_url, function(data) {

							       		var li ="";
								       	$.each(data, function(i,item){

								        	li += item.overdue;
	       									li += item.address;
	      									num = item.num;

								        });

								        $('ul.itm-wrpper').html(li);

								        $( "ul.dialog" ).dialog({
											title: title + ': Overdue ' + start +'-' + to + 'days (' + num +')',
											width: 700,
											height: 400,
											buttons: [
													{
														text: "Close",
														click: function() {
															$('ul.dialog').dialog( "close" );
														}
													}
												]
										});

										$('a.addr_id').click(function(e) {
						        			e.preventDefault(); 
						        			var base_url = $(this).attr("href");
						        			$.post( base_url, function(data) {
										       	var li ="";       		
											    $.each(data, function(i,item){
											       	li += item.addr;
											    });

										        $('ul.dropdown-menu').html(li);

										        } ,'json');
						        	
						    			});


								    }, 'json');


								}// OK
							},
							{
								text: "Close",
								click: function() {
									$('ul.dialog').dialog( "close" );
								}
							}
						]
				});
 
       
    }); //SEARCH


    $('a.btn_fresh').click(function(e) {
    	e.preventDefault();	
    	location.reload();
	}); // REFRESH


});//end fun







		