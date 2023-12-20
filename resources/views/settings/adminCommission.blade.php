@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{ trans('lang.admin_commission')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('lang.admin_commission')}}</li>
            </ol>
        </div>
    </div>
  <div class="container-fluid">
        <div class="card">
    <div class="card-body">
      <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
      <div class="error_top"></div>
      <div class="row restaurant_payout_create">
        <div class="restaurant_payout_create-inner"> 
          <fieldset>
            <legend>{{trans('lang.admin_commission')}}</legend>                
            <div class="form-check width-100">
              <input type="checkbox" class="form-check-inline" onclick="ShowHideDiv()" id="enable_commission">
                <label class="col-5 control-label" for="enable_commission">{{ trans('lang.enable_adminCommission')}}</label>
            </div>

            <div class="form-group row width-50">
                <label class="col-4 control-label">{{ trans('lang.commission_type')}}</label>
                <div class="col-7">
                  <select class="form-control commission_type" id="commission_type">
                    <option value="fix">{{trans('lang.fixed')}}</option>
                    <option value="percentage">{{trans('lang.percentage')}}</option>
                  </select>
                </div>
            </div>

            <div class="form-group row width-50" id="how_much_div"style="display:none">
              <label class="col-4 control-label">{{ trans('lang.admin_commission')}}<span class="required-field"></span></label>
              <div class="col-7">
                <input type="number" class="form-control commission_fix">
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <div class="form-group col-12 text-center btm-btn">
        <button type="button" class="btn btn-primary save_admin_commission" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
        <a href="{!! route('dashboard') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
      </div>
    </div>    
  </div>
</div>
</div>

 @endsection

@section('scripts')

<script type="text/javascript">
    
    var database = firebase.firestore();
    var ref = database.collection('settings').doc("adminCommission");
    
    $(document).ready(function(){
        jQuery("#overlay").show();
        ref.get().then( async function(snapshots){
            var adminCommissionSettings = snapshots.data();
            if(adminCommissionSettings == undefined){
                database.collection('settings').doc('adminCommission').set({});
            }else{
              if(adminCommissionSettings.isEnabled){
                  $("#enable_commission").prop('checked',true);
                  $("#how_much_div").show();
              }
              $(".commission_fix").val(adminCommissionSettings.amount);
              if(adminCommissionSettings.type){
                $("#commission_type").val(adminCommissionSettings.type);                
              }
            }
            jQuery("#overlay").hide();
        })

        $(".save_admin_commission").click(function(){
        
          var enable_commission = $("#enable_commission").is(":checked")?true:false;
          var commission_type = $("#commission_type :selected").val();
          var fix_commission = $(".commission_fix").val();
          if (fix_commission == '' && enable_commission) {
              $(".error_top").show();
              $(".error_top").html("");
              $(".error_top").append("<p>{{trans('lang.commission_help')}}</p>");
              window.scrollTo(0, 0);
          } else {
              jQuery("#overlay").show();
              database.collection('settings').doc("adminCommission").update({
                  'isEnabled':enable_commission,
                  'amount':fix_commission,
                  'type':commission_type
              }).then(function(result) {
                  jQuery("#overlay").hide();
                  window.location.href = '{{ url("settings/adminCommission")}}';
              });
          }
        })
    })

    function ShowHideDiv(){
      var enable_commission = $("#enable_commission").is(":checked");
      if(enable_commission){
        $("#how_much_div").show();
      }else{
        $("#how_much_div").hide();
      }
   }
 
</script>

@endsection