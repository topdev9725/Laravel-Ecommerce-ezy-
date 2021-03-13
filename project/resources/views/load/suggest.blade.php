@foreach($prods as $prod)
	<div class="docname">
		@php
			$category_id = App\Models\Product::where('id', '=', $prod->id)->first()->category_id;
			$store_type = App\Models\Category::where('id', '=', $category_id)->first()->store_type;
		@endphp
		<a href="{{ route('front.product1',$prod->slug).'?store_type='.$store_type }}">
			<img src="{{ asset('assets/images/thumbnails/'.$prod->thumbnail) }}" alt="">
			<div class="search-content">
				<p>{!! mb_strlen($prod->name,'utf-8') > 66 ? str_replace($slug,'<b>'.$slug.'</b>',mb_substr($prod->name,0,66,'utf-8')).'...' : str_replace($slug,'<b>'.$slug.'</b>',$prod->name)  !!} </p>
				<span style="font-size: 14px; font-weight:600; display:block;">{{ $prod->showPrice() }}</span>
			</div>
		</a>
	</div> 
@endforeach