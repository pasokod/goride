@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.on_board_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.on_board_table')}}</li>
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
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                            style="display: none;">{{trans('lang.processing')}}
                        </div>

                        {{--
                        <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="title">{{ trans('lang.title')}}</option>

                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search"
                                        aria-controls="users-table">
                            </label>&nbsp;<button onclick="searchtext();"
                                class="btn btn-warning btn-flat search_button">Search
                            </button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">Clear
                            </button>
                        </div>
                    </div>
                    --}}
                    <div class="table-responsive m-t-10">
                        <table id="userTable"
                            class="display  table table-hover table-striped table-bordered table table-striped"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>

                                    <th>{{trans('lang.image')}}</th>
                                    <th>{{trans('lang.title')}}</th>
                                    <th>{{trans('lang.description')}}</th>
                                    <th>{{trans('lang.app_screen')}}</th>
                                    <th>{{trans('lang.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody id="append_list1">
                            </tbody>
                        </table>
                        {{--
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item ">
                                    <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn"
                                        onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" id="users_table_next_btn"
                                        onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                </li>
                            </ul>
                        </nav>
                        --}}

                    </div>
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


<script type="text/javascript">

    var database = firebase.firestore();

    var defaultImg = "{{ asset('/images/default_user.png') }}";
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];

    var ref = database.collection('on_boarding');

    var append_list = '';

    $(document).ready(function () {

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        var inx = parseInt(offest) * parseInt(pagesize);
        jQuery("#overlay").show();

        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.get().then(async function (snapshots) {

            html = '';
            if (snapshots.docs.length > 0) {
                html = await buildHTML(snapshots);
            }

            jQuery("#overlay").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);

                if (snapshots.docs.length < pagesize) {
                    jQuery("#data-table_paginate").hide();
                }
                // disableClick();
            }
            $('#userTable').DataTable({
                order: [[3, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [0, 4] },
                ],
                "language": {
                    "zeroRecords": "{{trans('lang.no_record_found')}}",
                    "emptyTable": "{{trans('lang.no_record_found')}}"
                },
                "bPaginate": false
            });
        });

    });


    async function buildHTML(snapshots) {

        await Promise.all(snapshots.docs.map(async (listval) => {
            var val = listval.data();
            var getData = await getListData(val);
            html += getData;

        }));
        return html;
    }
    function getListData(val) {
        var html = '';
        html = html + '<tr>';
        newdate = '';
        var id = val.id;
        var route1 = '{{route("on-board.save",":id")}}';
        route1 = route1.replace(':id', id);

        if (val.image == '' || val.image == null) {

            html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
        } else {
            html = html + '<td><img class="rounded" style="width:50px" src="' + val.image + '" alt="image"></td>';
        }

        html = html + '<td><a href="' + route1 + '" class="onboard-edit">' + val.title + '</a></td>';

        html = html + '<td>' + val.description + '</td>';
        if (val.type == "customerApp") {
            var type = "Customer APP";
        } else {
            var type = "Driver APP";
        }
        html = html + '<td>' + type + '</td>';

        html = html + '<td class="action-btn"><a href="' + route1 + '" class="onboard-edit"><i class="fa fa-edit"></i></a></td>';

        html = html + '</tr>';
        return html;
    }

    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {

            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {
                listener = ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

            } else {
                listener = ref.startAt(end).limit(pagesize).get();
            }

            listener.then((snapshots) => {
                html = '';
                html = buildHTML(snapshots);

                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);
                }
            });
        }
    }

    function next() {

        if (start != undefined || start != null) {

            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

            } else {
                listener = ref.startAfter(start).limit(pagesize).get();
            }
            listener.then((snapshots) => {

                html = '';
                html = buildHTML(snapshots);
                console.log(snapshots);

                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];


                    if (endarray.indexOf(snapshots.docs[0]) != -1) {
                        endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                    }
                    endarray.push(snapshots.docs[0]);
                }
            });
        }
    }

    function searchclear() {
        jQuery("#search").val('');
        searchtext();
    }

    $('#search').keypress(function (e) {
        if (e.which == 13) {
            $('.search_button').click();
        }
    });

    function searchtext() {

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('fullName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

        } else {

            wherequery = ref.limit(pagesize).get();
        }

        wherequery.then((snapshots) => {

            html = '';
            html = buildHTML(snapshots);

            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {

                    jQuery("#data-table_paginate").hide();
                } else {

                    jQuery("#data-table_paginate").show();
                }
            }
        });

    }
    

</script>

@endsection