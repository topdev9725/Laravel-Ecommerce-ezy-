							<div class="row">
									@foreach($products as $prod)
										@include('includes.product.product')
									@endforeach

								</div>

                			@if(isset($min) || isset($max))

						        <div class="page-center category">
						          {!! $products->appends(['cat_id' => $cat_id ,'min' => $min, 'max' => $max])->links() !!}
						        </div>

						    @elseif(!empty($sort))
						    	@if(!empty($category_id))

						        <div class="page-center category">
						          {!! $products->appends(['category_id' => $category_id, 'search' => $search, 'sort' => $sort])->links() !!}               
						        </div>

						    	@else
						        <div class="page-center category">
						          {!! $products->appends(['cat_id' => $cat_id, 'min' => $min, 'max' => $max, 'sort' => $sort])->links() !!}
						        </div>
						        @endif
						    @else

						        <div class="page-center category">
						          {!! $products->appends(['category_id' => $category_id, 'search' => $search])->links() !!}               
						        </div>

						    @endif

<script type="text/javascript">
        $("#sortby").on('change',function () {
        var sort = $("#sortby").val();
        @if(empty($sort))
		window.location = window.location.href+'&sort='+sort;
		@else
		var url = window.location.href.split("&sort");;
		window.location = url[0]+'&sort='+sort;
		@endif
    	});

// Tooltip Section

    $('[data-toggle="tooltip"]').tooltip({

    });

    $('[rel-toggle="tooltip"]').tooltip();

    $('[data-toggle="tooltip"]').on('click',function(){
        $(this).tooltip('hide');
    })


    $('[rel-toggle="tooltip"]').on('click',function(){
        $(this).tooltip('hide');
    })

// Tooltip Section Ends
</script>
