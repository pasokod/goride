@extends('layouts.app')


@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.deleted_languages')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.deleted_languages')}}</li>
                </ol>
            </div>
            <div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive m-t-10">
                                <table id="languageTable"
                                       class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>{{trans('lang.image')}}</th>
                                        <th>{{trans('lang.name')}}</th>
                                        <th>{{trans('lang.code')}}</th>
                                        <th>{{trans('lang.active')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="append_list1">
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        var database = firebase.firestore();

        var user_number = [];
        var languages = [];
        var ref = database.collection('languages').where('isDeleted', '==', true);
        var placeholderImage = "{{ asset('/images/default_user.png') }}";
        var append_list = '';

        $(document).ready(function () {

            jQuery("#overlay").show();

            append_list = document.getElementById('append_list1');
            append_list.innerHTML = '';

            ref.get().then(async function (snapshots) {

                var html = '';
                html = await buildHTML(snapshots);

                if (html != '') {
                    append_list.innerHTML = html;
                }
                $('#languageTable').DataTable({
                    order: [[1, 'asc']],
                    columnDefs: [
                        {orderable: false, targets: [0, 3, 4]},
                    ],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    }
                });
                jQuery("#overlay").hide();
            });

        });

        async function buildHTML(snapshots) {
            var html = '';
            await Promise.all(snapshots.docs.map(async (listval) => {
                var val = listval.data();
                var getData = await getListData(val);
                html += getData;
            }));
            return html;
        }


        async function getListData(val) {
            var html = '';

            html = html + '<tr>';
            newdate = '';
            var id = val.id;
            var route1 = '{{route("settings.languages.save",":id")}}';
            route1 = route1.replace(':id', id);
            if (val.image == '' || val.image == null) {
                var image = placeholderImage;
            } else {
                var image = val.image;
            }
            html = html + '<td><a href="' + route1 + '"><img src="' + image + '" class="rounded" style="width:50px" ></a></td>';

            html = html + '<td><a href="' + route1 + '">' + val.name + '</a></td>';

            html = html + '<td>' + val.code + '</td>';

            if (val.enable) {
                html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
            } else {
                html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
            }

            html = html + '<td class="action-btn"><a id="' + val.id + '" class="do_not_delete" name="lang-restore" href="javascript:void(0)"><i class="fa fa-undo"></i></a></td>';

            html = html + '</tr>';

            return html;
        }

        /* toggal publish action code start*/
        $(document).on("click", "input[name='isActive']", function (e) {
            var ischeck = $(this).is(':checked');
            var id = this.id;
            if (ischeck) {
                database.collection('languages').doc(id).update({
                    'enable': true
                }).then(function (result) {
                });
            } else {
                database.collection('languages').doc(id).update({
                    'enable': false
                }).then(function (result) {
                });
            }

        });

        /*toggal publish action code end*/

        $(document).on("click", "a[name='lang-restore']", function (e) {

            var id = this.id;
            jQuery("#overlay").show();
            database.collection('languages').doc(id).update({
                'isDeleted': false,

            }).then(function (result) {

                window.location.href = '{{ url()->current() }}';
            });
            jQuery("#overlay").show();


        });
    </script>

@endsection