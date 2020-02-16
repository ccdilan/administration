@extends('layouts.app')
@section('title','Roles')
@section('content')
    <div id="settings-trigger" data-toggle="modal"
         data-target="#roleCreateModal">
        <i class="fas fa-plus"></i>
    </div>

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="roleTable" class="table">
                                <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th>Guard</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="roleCreateModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalForms"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h5 class="modal-title">Create new role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body mt-3 mb-3">
                    {!! Form::open(['method' => 'post', 'id' => 'roleCreateForm']) !!}
                    @include('Administration::role.form')
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button
                            onclick="FormOptions.submitForm('roleCreateForm','roleCreateModal','roleTable')"
                            type="button" class="btn btn btn-outline-primary-blue">Create
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="roleEditModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalForms"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h5 class="modal-title">Edit role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body mt-3 mb-3">
                    {!! Form::open(['method' => 'put', 'id' => 'roleEditForm','class'=>'needs-validation','novalidate']) !!}
                    @include('Administration::role.form-edit')
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button
                            onclick="FormOptions.submitForm('roleEditForm','roleEditModal','roleTable')"
                            type="button" class="btn btn-outline-primary-blue">Update now
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
@push('styles')
{{--    @include('layouts.includes.styles.form')--}}
{{--    <link href="{{asset('plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet" type="text/css"/>--}}
@endpush

@push('scripts')
    <script src="{{asset('js/data-table.js')}}"></script>
{{--    @include('layouts.includes.scripts.form')--}}
    <!-- Data Table JavaScript -->
{{--    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}
{{--    <script src="{{asset('js/dataTables-data.js')}}"></script>--}}
    <script src="{{asset('js/tooltips.js')}}"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();

        initCheckBox();

        function initCheckBox() {
            $(".superParentCheckBox").click(
                function () {
                    $(this).parents('.super').find('.parentCheckBox').prop('checked', this.checked);
                    $(this).parents('.super').find('.childCheckBox').prop('checked', this.checked);
                }
            );

            $(".parentCheckBox").click(
                function () {
                    $(this).parents('.main-parent').find('.childCheckBox').prop('checked', this.checked);

                    if ($(this).parents('.super').find('.superParentCheckBox').prop('checked') == true && this.checked == false)
                        $(this).parents('.super').find('.superParentCheckBox').prop('checked', false);


                    if (this.checked == true) {
                        var superFlag = true;
                        $(this).parents('.super').find('.childCheckBox').each(
                            function () {
                                if (this.checked == false)
                                    superFlag = false;
                            }
                        );
                        $(this).parents('.super').find('.superParentCheckBox').prop('checked', superFlag);
                    }
                }
            );
            //clicking the last unchecked or checked checkbox should check or uncheck the parent checkbox
            $('.childCheckBox').click(
                function () {
                    if ($(this).parents('.super').find('.superParentCheckBox').prop('checked') == true && this.checked == false)
                        $(this).parents('.super').find('.superParentCheckBox').prop('checked', false);

                    if ($(this).parents('.main-parent').find('.parentCheckBox').prop('checked') == true && this.checked == false)
                        $(this).parents('.main-parent').find('.parentCheckBox').prop('checked', false);

                    if (this.checked == true) {
                        var flag = true;
                        var superFlag = true;
                        $(this).parents('.super').find('.childCheckBox').each(
                            function () {
                                if (this.checked == false)
                                    superFlag = false;
                            }
                        );

                        $(this).parents('.main-parent').find('.childCheckBox').each(
                            function () {
                                if (this.checked == false)
                                    flag = false;
                            }
                        );
                        $(this).parents('.main-parent').find('.parentCheckBox').prop('checked', flag);
                        $(this).parents('.super').find('.superParentCheckBox').prop('checked', superFlag);
                    }
                }
            );
        }

        DataTableOption.initDataTable('roleTable', 'roles/table/data');
        FormOptions.initValidation('roleCreateForm');
        FormOptions.initValidation('roleEditForm');

        function editPermission(role) {
            let id = role.dataset.id;
            let name = role.dataset.name;
            let permissions = role.dataset.permissions;
            $("#roleEditForm").find('#txtName').val(name);

            var values = "Test,Prof,Off";
            $.each(values.split(","), function (i, e) {
                $("#strings option[value='" + e + "']").prop("selected", true);
            });

            $("#roleEditForm").find('.input_tags').val(JSON.parse(permissions));
            $("#roleEditForm").find('.input_tags').trigger('change');

            $("#roleEditForm").attr('action', '/roles/' + id);
            ModalOptions.toggleModal('roleEditModal');
            $.ajax({
                url: '/roles/render/form',
                type: 'GET',
                data:{id:id},
                success: function success(result) {
                    $('#permissionForm').empty();
                    $('#permissionForm').append(result);
                    initCheckBox();
                },
                error: function error(XMLHttpRequest, textStatus, errorThrown) {

                }
            })
        }
    </script>)
    <script>
        $(".input_tags").select2({
            tags: false,
            tokenSeparators: [',', ' ']
        });
    </script>
@endpush
@push('styles')
    <style>
        /*.select2-container--default .select2-selection--multiple {*/
        /*   height: 12px !important;*/
        /*    min-height: 12px !important;*/
        /*}*/

        .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple {
            border: 1px solid #e0e3e4 !important;
            border-radius: 0 !important;
        }
    </style>
@endpush

