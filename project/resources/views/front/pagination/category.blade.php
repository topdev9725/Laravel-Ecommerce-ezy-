								<div class="row">
									@foreach($cats as $prod)
                                        @include('includes.product.product')
									@endforeach

								</div>

                			@if(isset($min) || isset($max))

						        <div class="page-center category">
						          {!! $cats->appends(['min' => $min, 'max' => $max])->links() !!}          
						        </div>

						    @elseif(!empty($sort))

						        <div class="page-center category">
						          {!! $cats->appends(['sort' => $sort])->links() !!}          
						        </div>

						    @else 

						        <div class="page-center category">
						          {!! $cats->links() !!}               
						        </div>

						    @endif


<script type="text/javascript">
        $("#sortby").on('change',function () {
        var sort = $("#sortby").val();
        @if(isset($cat))
        window.location = "{{url('/category')}}/{{$cat->slug}}?sort="+sort;
        @endif
        @if(isset($subcat))
        window.location = "{{url('/category')}}/{{$subcat->category->slug}}/{{$subcat->slug}}?sort="+sort;
        @endif
        @if(isset($childcat))
        window.location = "{{url('/category')}}/{{$childcat->subcategory->category->slug}}/{{$childcat->subcategory->slug}}/{{$childcat->slug}}?sort="+sort;
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