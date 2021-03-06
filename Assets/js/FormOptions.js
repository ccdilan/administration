FormOptions = {
    submitForm: function (form_id, modal_id, table_id, clear_form = true, callback, trigger_change = []) {
        form_id ='#'+form_id;
        table_id ='#'+table_id;
        let isValid = $(form_id).valid();
        if (isValid) {
            let url = $(form_id).attr('action');
            let method = $(form_id).attr('method');
            $(form_id).ajaxSubmit(
                {
                    clearForm: clear_form,
                    url: url,
                    type: method,
                    success: function (result) {
                        ModalOptions.hideModal(modal_id);
                        if (result.success) {
                            let table = $(table_id).DataTable();
                            table.ajax.reload();
                            Notifications.showSuccessMsg(result.message);
                        } else {
                            Notifications.showErrorMsg(result.message);
                        }
                        if (!clear_form){
                            callback(form_id);
                        }
                        $.each(trigger_change,function (key, value) {
                            $(value).trigger('change');
                        });
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        ModalOptions.hideModal(modal_id);
                        Notifications.showErrorMsg(errorThrown);
                    }
                }
            );
        }
    },
    deleteRecord: function (record_id, url, table) {
        let tableName = '#' + table;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: 'delete',
                    data: {
                        id: record_id,
                    },
                    success: function (result) {
                        if (result.success) {
                            let table = $(tableName).DataTable();
                            table.ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            );
                        } else {
                            let msg = result.message;
                            Notifications.showErrorMsg(msg);
                        }
                    }
                });
            }
        });
    },
    initValidation:function (form_id, rules = []) {
        let form_name = '#'+form_id;
        $(form_name).validate({
            errorPlacement: function (error, element) {
                if (element.is('select') && element.hasClass('select2')) {
                    error.insertAfter(element.next());
                    element.next().addClass('error-element');
                }else {
                    error.insertAfter(element);
                    element.addClass('error-element');
                }
            },
            success: function (error,element) {
                error.remove();
                element.classList.remove('error-element');
            },
            rules: rules
        });
    },
    clearTrumbowygInput: function (form_id) {
        $(form_id).find('.permission').val('');
        $(form_id).find('.permission').trigger('change');
        $(form_id + ' .description').trumbowyg('html', "");
        $(form_id).trigger("reset");
    }
};
