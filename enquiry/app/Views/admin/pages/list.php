<div class="page-header">
	<div>
		<h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard'); ?>"><?php echo translate('dashboard'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
		</ol>
	</div>
    <div class="btn btn-list">
        <?php if(empty($permissions) || isset($permissions['pages']['edit'])){ ?>
            <a class="btn ripple btn-secondary" href="<?php echo admin_site_url('pages/order'); ?>"><i class="fe fe-move ml-2"></i> <?php echo translate('order') ?></a>
            <a class="btn ripple btn-primary" href="<?php echo admin_site_url('pages/add'); ?>"><i class="fe fe-plus-circle ml-2"></i> <?php echo translate('add_new') ?></a>
        <?php } ?>
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
                                <th><?php echo translate('short_description') ?></th>
                                <th><?php echo translate('created_on') ?></th>
                                <th><?php echo translate('status') ?></th>
                                <th><?php echo translate('actions') ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th><?php echo translate('name') ?></th>
                                <th><?php echo translate('short_description') ?></th>
                                <th><?php echo translate('created_on') ?></th>
                                <th><?php echo translate('status') ?></th>
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
    $(document).ready(function () {
        $('.data-list-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo admin_site_url('pages/crud'); ?>",
                "dataType": "json",
                "type": "POST",
                "data": {action : 'list'},
                "error": function(){ $(".data-list-table").css("display","none"); },
                "beforeSend": function () { },
                "complete": function () {
                    initDatatableOptions();
                }
            },
            "columns": [
                {"data": "id", orderable: false, searchable: false, className: 'text-center'},
                {"data": "name", orderable: false, className: 'text-center'},
                {"data": "short_description", orderable: false, className: 'text-center'},
                {"data": "created_on", searchable: false, className: 'text-center'},
                {"data": "status", orderable: false, searchable: false, className: 'text-center'},
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
            bInfo: true,
            pageLength: <?php echo app_setting('records_per_page','10') ?>,
            buttons: [],
            initComplete: function () {
                initDatatableOptions();
            }
        }).on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
            initDatatableOptions();
        });
    });
</script>