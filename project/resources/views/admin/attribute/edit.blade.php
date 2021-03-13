@extends('layouts.admin')

@section('content')
  <div class="content-area">
    <div class="mr-breadcrumb">
      <div class="row align-items-center">
        <div class="col-lg-12">
            <h4 class="heading d-inline-block">
              <span class="text-capitalize"></span> {{__('Categories')}}
              <a href="{{ url()->previous() }}" class="add-btn"><i class="fas fa-angle-left"></i> {{__('Back')}}</a>
            </h4>
            <ul class="links d-inline-block">
              <li>
                <a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}} </a>
              </li>
              <li><a href="javascript:;">{{__('Mange Attribute')}}</a></li>
              <li>
                <a href="#"><span class="text-capitalize"></span> {{__('Attribute')}}</a>
              </li>
              <li><a href="javascript:;">{{__('Edit')}}</a></li>
            </ul>

        </div>
      </div>
    </div>
    <div class="product-area">
      <div class="row">
        <div class="col-lg-12">
          <div class="py-5" id="app">

            <div class="add-product-content">
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                  <form id="geniusform" action="{{route('admin-attr-update', $attr->id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                      @include('includes.admin.form-both')

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                               <label for=""><strong>{{__('Name')}}</strong></label>
                               <div class="">
                                 <input type="text" class="input-field" name="name" value="{{$attr->name}}" placeholder="{{__('Enter Name')}}" required>
                               </div>
                               @if ($errors->has('name'))
                                 <p class="text-danger mb-0">{{$errors->first('name')}}</p>
                               @endif
                          </div>
                        </div>
                      </div>

                      <div class="row" id="optionarea">
                        <div class="col-md-12">
                          <div class="form-group">
                               <label for=""><strong>{{__('Options')}}</strong></label>
                               <div class="row mb-2 counterrow" v-for="option in options" :key="option.id">
                                 <div class="col-md-11">
                                   <input class="input-field optionin" type="text" name="options[]" :value="option.name" placeholder="{{__('Option label')}}" required>
                                 </div>

                                 <div class="col-md-1">
                                   <button type="button" class="btn btn-danger text-white" @click="removeExistingOption(option.id)"><i class="fa fa-times"></i></button>
                                 </div>
                               </div>
                               <div class="row mb-2 counterrow" v-for="n in counter" :id="'newOption'+n">
                                 <div class="col-md-11">
                                   <input class="input-field optionin" type="text" name="options[]" value="" placeholder="{{__('Option label')}}" required>
                                 </div>

                                 <div class="col-md-1">
                                   <button type="button" class="btn btn-danger text-white" @click="removeOption(n)"><i class="fa fa-times"></i></button>
                                 </div>
                               </div>
                               <button type="button" class="btn btn-success text-white" @click="addOption()"><i class="fa fa-plus"></i> {{__('Add Option')}}</button>
                               @if ($errors->has('options.*') || $errors->has('options'))
                                 <p class="text-danger mb-0">{{$errors->first('options.*')}}</p>
                                 <p class="text-danger mb-0">{{$errors->first('options')}}</p>
                               @endif
                          </div>
                        </div>
                      </div>


                      <div class="row mt-1">
                        <div class="col-lg-12">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="priceStatus1" name="price_status" class="custom-control-input" {{ $attr->price_status == 1 ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="priceStatus1">Allow Price Field</label>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-4">
                        <div class="col-lg-12">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="detailsStatus1" name="details_status" class="custom-control-input" {{ $attr->details_status == 1 ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="detailsStatus1">Show on Details Page</label>
                          </div>
                        </div>
                      </div>


                      <div class="text-left">
                        <button type="submit" class="btn btn-primary addProductSubmit-btn">{{__('UPDATE FIELD')}}</button>
                      </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    var app = new Vue({
      el: '#app',
      data: {
        options: [],
        counter: 0
      },
      created() {
        $.get("{{route('admin-attr-options', $attr->id)}}", (data) => {
          for (var i = 0; i < data.length; i++) {
            this.options.push(data[i]);
          }
        });
      },
      methods: {
        addOption() {
          this.counter++;
        },
        removeExistingOption(optionid) {
          for (var i = 0; i < this.options.length; i++) {
            if (this.options[i].id == optionid) {
              this.options.splice(i, 1);
            }
          }
        },
        removeOption(n) {
          $("#newOption"+n).remove();
        }
      }
    })
  </script>
@endsection
