								<div class="row">
									@foreach($vprods as $prod)
										@include('includes.product.product')
									@endforeach

								</div>

                            @if(isset($min) || isset($max))

                                <div class="page-center category">
                                  {!! $vprods->appends(['min' => $min, 'max' => $max])->links() !!}          
                                </div>

                            @elseif(!empty($sort))

                                <div class="page-center category">
                                  {!! $vprods->appends(['sort' => $sort])->links() !!}          
                                </div>

                            @else 

                                <div class="page-center category">
                                  {!! $vprods->links() !!}               
                                </div>

                            @endif


<script type="text/javascript">
        $("#sortby").on('change',function () {
          var sort = $("#sortby").val();
          window.location = "{{url('/store')}}/{{ str_replace(' ', '-', $vendor->shop_name) }}?sort="+sort;
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