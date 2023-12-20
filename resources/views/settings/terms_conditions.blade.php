@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.terms_and_conditions')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.terms_and_conditions')}}</li>
                </ol>
            </div>
       

        </div>

     <div class="container-fluid">
       <div class="card">  
        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
            <div class="error_top"></div>

            <div class="terms-cond restaurant_payout_create row">
                <div class="restaurant_payout_create-inner">
                    <fieldset>
                        <legend>{{trans('lang.terms_and_conditions')}}</legend>

                        <div class="form-group width-100">
                            <textarea class="form-control col-7" name="terms_and_conditions" id="terms_and_conditions"></textarea>
                        </div>


                    </fieldset>

                </div>
            </div>

           <div class="form-group col-12 text-center btm-btn" >
            <button type="button" class="btn btn-primary  create_user_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
            <a href="{!! route('settings.termsAndConditions') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
        </div> 
        </div>

        
       </div>
      </div>
    </div>

@endsection

@section('scripts')
    <script>

        var database = firebase.firestore();
        var photo ="";
        var ref = database.collection('settings').doc('global');
        $(document).ready(function () {
            try {
                jQuery("#overlay").show();
                ref.get().then(async function (snapshots) {
                    var termsAndCondition = snapshots.data();

                    if(termsAndCondition.termsAndConditions)
                    {
                        $('#terms_and_conditions').summernote("code", termsAndCondition.termsAndConditions);
                    }
                });
                jQuery("#overlay").hide();
            } catch (error) {
                jQuery("#overlay").hide();
            }
            $('#terms_and_conditions').summernote({
                height: 400,
                toolbar: [

                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['forecolor', ['forecolor']],
                    ['backcolor', ['backcolor']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
            $(".create_user_btn").click(function(){

                var terms_and_conditions =  $('#terms_and_conditions').summernote('code');

                if(terms_and_conditions == ''){
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.terms_condition_error')}}</p>");
                    window.scrollTo(0, 0);
                }else{
                    database.collection('settings').doc('global').update({'termsAndConditions':terms_and_conditions}).then(function(result) {
                        window.location.href = '{{ route("settings.termsAndConditions")}}';
                    })
                }
            })
        });

    </script>
@endsection
