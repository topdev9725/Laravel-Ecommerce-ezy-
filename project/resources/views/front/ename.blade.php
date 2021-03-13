<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
  <!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
  <!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
  <!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/style.css')}}">
  <style>
    .name{font-weight: bold; font-size: 1.2em; border-bottom: 2px solid #333;}
    ul{margin:0; padding: 0;}
    li{list-style: none; border-bottom: 1px solid #ddd; padding:5px 0;}
    div.container{display: flex; position: relative;}
    div.icon{position: absolute;left: 0; width: 50px; text-align: center; display: block; line-height: 46px;}
    div.item{padding-left: 40px; width: 100%;}
    div.item p.main{margin-bottom: 0px; font-size: 1em; font-weight: bold;}
    div.item p.desc{font-size: 0.8em; color: #333; margin-bottom: 0;}
    .photo{position: absolute;    width: 75px;    border-radius: 50%;    top: 0;    right: 0;}
  </style>
</head>
<body>
<div class="profile-own-bg" id="user-profile-mobile-header">
	<div class="personal-header-info">
		<div class="container">
			<div class="row">

				<div class="col-12" style="text-align:-webkit-center">
					<div class="profile-img" style="background: url({{asset('assets/images/users/'.$user->photo)}})"></div>
				</div>
				
				<div class="col-12 text-center">
					<b class="text-uppercase">{{ $ename->name }}</b><br>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <p class="name p-3">{{$ename->name}}</p>
<img src="{{asset('assets/images/users/'.$user->photo)}}" class="photo"/> -->
<ul>  
  <li>
    <div class="container">
      <div class="icon"><i class="fa fa-building"></i></div>
      <div class="item"><p class="desc">Company</p><p class="main">{{$ename->company}}</p></div>
    </div>
  </li>
  <li>
    <div class="container">
      <div class="icon"><i class="fa fa-map-marker"></i></div>
      <div class="item"><p class="desc">Position</p><p class="main">{{$ename->position}}</p></div>
    </div>
  </li>
  <li>
    <div class="container">
      <div class="icon"><i class="fa fa-comments"></i></div>
      <div class="item"><p class="desc">Hp no & WhatsApp api</p><p class="main">{{$ename->hpno_whatsapp}}</p></div>
    </div>
  </li>
  <li>
    <div class="container">
      <div class="icon"><i class="fa fa-envelope"></i></div>
      <div class="item"><p class="desc">Email</p><p class="main">{{$ename->email}}</p></div>
    </div>
  </li>
  <li>
    <div class="container">
      <div class="icon"><i class="fa fa-globe"></i></div>
      <div class="item"><p class="desc">Web Link</p><p class="main">{{$ename->web_link}}</p></div>
    </div>
  </li>
  <li>
    <div class="container">
      <div class="icon"><i class="fa fa-paper-plane"></i></div>
      <div class="item"><p class="desc">Introduction</p><p class="main">{{$ename->introduction}}</p></div>
    </div>
  </li>
  <li>
    <div class="container">
      <div class="icon"><i class="fa fa-info-circle"></i></div>
      <div class="item"><p class="desc">Description</p><p class="main">{{$ename->description}}</p></div>
    </div>
  </li>
</ul>
</body>
</html>