@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('backend/css/backend_page_css/staff_view.css'))}}" />


@endsection
@section('mainContent')
<section class="mb-40 student-details">

   @if(session()->has('message-success'))
   <div class="alert alert-success">
      {{ session()->get('message-success') }}
   </div>
   @elseif(session()->has('message-danger'))
   <div class="alert alert-danger">
      {{ session()->get('message-danger') }}
   </div>
   @endif
   <div class="container-fluid p-0">
      <div class="row">
         <div class="col-lg-12">
            <!-- Start Student Meta Information -->
            <div class="main-title">
               <h3 class="mb-20">{{__('Organiser Info')}}</h3>
            </div>
            <div class="student-meta-box">
               <div class="student-meta-top"></div>

               <div class="avatar_div">
                  <img class="student-meta-img img-100"
                     src="{{ asset( (@$staffDetails->avatar !=null)?asset_path(@$staffDetails->avatar) : asset_path('backend/img/avatar.png')) }}"
                     alt="">
               </div>
               <div class="white-box">
                  <div class="single-meta mt-10 col-lg-3">
                     <div class="d-flex justify-content-between">
                        <div class="name">
                           {{ __('common.name') }}
                        </div>
                        <div class="value">
                           @if(isset($staffDetails)){{ucwords(@$staffDetails->first_name)}}@endif
                        </div>
                     </div>
                  </div>
                 
                  <div class="single-meta col-lg-3">
                     <div class="d-flex justify-content-between">
                        <div class="name">
                           {{ __('common.email') }}
                        </div>
                        <div class="value">
                           @if(isset($staffDetails)){{getNumberTranslate(@$staffDetails->email)}}@endif
                        </div>
                     </div>
                  </div>

                  <div class="single-meta col-lg-3">
                     <div class="d-flex justify-content-between">
                        <div class="name">
                           {{ __('common.phone') }}
                        </div>
                        <div class="value">
                           @if(isset($staffDetails)){{getNumberTranslate(@$staffDetails->phone)}}@endif
                        </div>
                     </div>
                  </div>

                 
               </div>
            </div>
            <!-- End Student Meta Information -->
         </div>
      
      </div>
   </div>
</section>
<div class="edit_form">

</div>

@include('backEnd.partials.delete_modal')
@endsection
@push('scripts')
<script type="text/javascript">
   (function($){
            "use strict";

            $(document).ready(function(){
               $(document).on('submit', '#document_create_form', function(event){
                  $('#create_name_error').text('');
                  $('#create_file_error').text('');
                  let name = $('#create_name').val();
                  let file = $('#document_file_1').val();

                  if(name == ''){
                     $('#create_name_error').text('The Name field is Required.');
                  }
                  if(file == ''){
                     $('#create_file_error').text('The File field is Required.');
                  }

                  if(name == '' || file == ''){
                     event.preventDefault();
                     return false;
                  }

               });

               $(document).on('change', '#document_file_1', function(){
                  getFileName($(this).val(),'#placeholderFileOneName');
               });

               $(document).on('click', '.printDiv', function(){
                  printDiv(divName);
               });

               function printDiv(divName) {

                  var printContents = document.getElementById(divName).innerHTML;
                  var originalContents = document.body.innerHTML;
                  document.body.innerHTML = printContents;
                  window.print();
                  document.body.innerHTML = originalContents;

               }

               $(document).on('click', '.delete_document', function(event){
                  event.preventDefault();
                  let url = $(this).data('value');
                  confirm_modal(url);
               });

            });

         })(jQuery);


</script>
@endpush
