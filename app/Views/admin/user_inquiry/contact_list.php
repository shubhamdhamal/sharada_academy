<div class="page-header">
	<div>
		<h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard'); ?>"><?php echo translate('dashboard'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
		</ol>
	</div>
    <?php $date = '2000-01-01 - '.date(DB_DATE_FORMAT) ?>
    <div class="btn btn-list">
        <button class="btn ripple btn-export btn-outline-secondary" data-url="<?php echo admin_site_url('user-inquiry/crud') ?>" data-action="export_csv"><i class="fa fa-file-excel-o ml-2"></i> <?php echo translate('export_as_excel') ?></button>
        <a href="#" class="btn ripple btn-secondary navresponsive-toggler" data-bs-toggle="collapse" data-bs-target="#filter" aria-controls="filter" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fe fe-filter me-1"></i><?php echo translate('Filter') ?><i class="fa fa-caret-down ms-1"></i>
        </a>
    </div>
</div>
<form id="export_form">
    <input type="hidden" name="action" id="export_action">
    <input type="hidden" name="date" id="date_id">
    <input type="hidden" name="type" value="contact">
</form>
<div class="responsive-background">
    <div class="navbar-collapse collapse <?php echo !empty($post) ? 'show' : '' ?>" id="filter" style="">
        <div class="advanced-search br-3">
            <form class="form-filter" action="<?php echo current_url(); ?>" method="post">
                <div class="row align-items-center">
                    <div class="col-md-12 col-xl-6 col-lg-6 mt-4">
                        <div class="form-group mb-lg-0">
                            <label class=""><?php echo translate('date') ?></label>
                            <div class="input-group">
                                <input type="hidden" id="date" value="<?php echo $date; ?>">
                                <input type="text" class="form-control pull-right date" value="<?php echo $date; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row sidemenu-height">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table data-list-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo translate('name') ?></th>
                                <th><?php echo translate('email') ?></th>
                                <th><?php echo translate('subject') ?></th>
                                <th><?php echo translate('phone_no') ?></th>
                                
                                <th><?php echo translate('message') ?></th>
                                <th><?php echo translate('created_on') ?></th>
                                <th><?php echo translate('actions') ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th><?php echo translate('name') ?></th>
                                <th><?php echo translate('email') ?></th>
                                <th><?php echo translate('subject') ?></th>
                                <th><?php echo translate('phone_no') ?></th>
                               
                                <th><?php echo translate('message') ?></th>
                                <th><?php echo translate('created_on') ?></th>
                                <th><?php echo translate('actions') ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
			</div>
        </div>
    </div>
</div>
<script>
    var start = moment().subtract(29, 'days');
    var end = moment();
    function get_data(){
        <?php
            $data_srt = '"action":"contact_list"';
            if(isset($post) && !empty($post)){
                foreach ($post as $key => $value) {
                    if($key!='action' && $value!='' && $value!='all'){
                        $data_srt = $data_srt.",'".$key."':'".$value."'";
                    }
                }
            }
        ?>
        $("#date_id").val($("#date").val());
        $('.data-list-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo admin_site_url('user-inquiry/crud'); ?>",
                "dataType": "json",
                "type": "POST",
                "data": {<?php echo $data_srt; ?>,"date":$("#date").val()},
                "error": function(){ $(".data-list-table").css("display","none"); },
                "beforeSend": function () { },
                "complete": function () {
                    initDatatableOptions();
                }
            },
            "columns": [
                {"data": "id", orderable: false, searchable: false, className: 'text-center'},
                {"data": "name", orderable: false, className: 'text-center'},
                {"data": "email", orderable: false, className: 'text-center'},
                {"data": "subject", orderable: false, className: 'text-center'},
                {"data": "phone_no", searchable: false, className: 'text-center'},
                {"data": "message", orderable: false, className: 'text-center'},
                {"data": "created_on", orderable: false, searchable: false, className: 'text-center'},
                {"data": "actions", orderable: false, searchable: false, className: 'text-center'}
            ],
            bAutoWidth: false,
            responsive: true,
            searchDelay: 1500,
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            fixedHeader: {
                header: true,
                footer: true
            },
            oLanguage: {
                sZeroRecords: "<?php echo translate('no_results_available') ?>",
                sSearch: "<?php echo translate('search') ?>",
                sProcessing: "<?php echo translate('please_wait...') ?>",
                oPaginate: {
                    sFirst: "<?php echo translate('first') ?>",
                    sPrevious: "<?php echo translate('previous') ?>",
                    sNext: "<?php echo translate('next') ?>",
                    sLast: "<?php echo translate('last') ?>"
                }
            },
            aLengthMenu: <?php echo create_dt_length_menu(app_setting('records_per_page','10')); ?>,
            order: [[5, "desc"]],
            bInfo: true,
            pageLength: <?php echo app_setting('records_per_page','10') ?>,
            buttons: [],
            initComplete: function () {
                initDatatableOptions();
            }
        }).on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
            initDatatableOptions();
        });
    }
    $(document).ready(function () {
        $('.date').daterangepicker({
            startDate: start,
            endDate: end,
            timePicker: false,
            showDropdowns: true,
            autoApply: true,
            maxDate: "<?php echo date(DB_DATE_FORMAT) ?>",
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end, label) {
            $("#date").val(start.format('YYYY-MM-DD')+' - '+end.format('YYYY-MM-DD'));
            $('.data-list-table').DataTable().clear().destroy();
            get_data();
        });
        get_data();
    });
</script>