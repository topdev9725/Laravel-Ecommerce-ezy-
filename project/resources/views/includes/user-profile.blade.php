                            
                        <div class="col-lg-3 col-md-3 col-sm-4">
                             <div class="patient__linksArea">
                             	<a href="{{route('user-dashboard')}}" class="patient-btn">{{ $lang->lang78 }}</a>
                                <a href="{{route('user-appointments')}}" class="patient-btn">{{ $lang->lang79 }}</a>
                                <a href="{{route('user-messages')}}" class="patient-btn">{{ $lang->lang80 }}</a>   
                                <a href="{{route('user-message-index')}}" class="patient-btn">{{ $lang->lang81}}</a>  
                             
                                <a href="{{route('user-profile')}}" class="patient-btn">{{ $lang->lang82 }}</a>
                                <a href="{{route('user-reset')}}" class="patient-btn">{{ $lang->lang83 }}</a>
                                <a href="{{route('user-logout')}}" class="patient-btn">{{ $lang->lang84 }}</a>
                            </div>
                            <div class="patient__socialArea mt_30">
                                <ul>
                                    <li><a href=""><i class="fa fa-map-marker"></i> <span>{{ $lang->lang85 }} {{ $user->address }}</span></a></li>
                                    <li><a href=""><i class="fa fa-phone"></i> <span>{{ $lang->lang86 }} {{ $user->phone }}</span></a></li>
                                    <li><a href=""><i class="fa fa-envelope"></i> <span>{{ $lang->lang87 }} {{ $user->email }}</span></a></li>
                                </ul>
                            </div>
                        </div>


