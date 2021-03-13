   <style type="text/css">

        @media only screen and (max-width: 767px) {

        @php
            foreach ($sliders as $slider){
                $subtitle_size = $slider->subtitle_size*.5;
                $title_size = $slider->title_size*.5;
                $details_size = $slider->details_size*.5;

                if ($details_size <12){
                    $details_size = 12;
                }

                if ($title_size <12){
                    $title_size = 12;
                }

                if ($subtitle_size <12){
                    $subtitle_size = 12;
                }

                echo "
                .subtitle".$slider->id."{
                    font-size:".$subtitle_size."px!important;
                }

                .title".$slider->id."{
                    font-size:".$title_size."px!important;
                }
                .details".$slider->id."{
                    font-size:".$details_size."px!important;
                }

                ";
            }
        @endphp
}

        @media only screen and (min-width: 768px) and (max-width: 991px) {

        @php
            foreach ($sliders as $slider){

                $subtitle_size = $slider->subtitle_size*.7;
                $title_size = $slider->title_size*.7;
                $details_size = $slider->details_size*.7;

                echo "
                .subtitle".$slider->id."{
                    font-size:".$subtitle_size."px!important;
                }

                .title".$slider->id."{
                    font-size:".$title_size."px!important;
                }
                .details".$slider->id."{
                    font-size:".$details_size."px!important;
                }

                ";
            }
        @endphp
}

    </style>