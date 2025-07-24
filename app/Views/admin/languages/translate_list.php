<div class="page-header">
	<div>
		<h2 class="main-content-title tx-24 mg-b-5"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo admin_site_url('dashboard'); ?>"><?php echo translate('dashboard'); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo admin_site_url('languages'); ?>"><?php echo translate('languages'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_title) && $page_title != '' ? translate($page_title) : '' ?></li>
		</ol>
	</div>
    <div class="btn btn-list">
        <button class="btn ripple btn-primary btn-translate"><i class="fa fa-language"></i> <?php echo translate('translate_all'); ?></button>
        <button class="btn ripple btn-secondary btn-translate-save-all"><i class="fa fa-save"></i> <?php echo translate('save_all_translation'); ?></button>
        <a class="btn ripple btn-primary" href="<?php echo admin_site_url('languages'); ?>"><i class="fe fe-list ml-2"></i> <?php echo translate('list') ?></a>
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
                                <th><?php echo translate('word') ?></th>
                                <th><?php echo translate('translation') ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th><?php echo translate('word') ?></th>
                                <th><?php echo translate('translation') ?></th>
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
                "url": "<?php echo admin_site_url('languages/crud'); ?>",
                "dataType": "json",
                "type": "POST",
                "data": {action : 'translate_list',slug : '<?php echo $languages->slug ?>'},
                "error": function(){ $(".data-list-table").css("display","none"); },
                "beforeSend": function () { },
                "complete": function () {
                    initDatatableOptions();
                }
            },
            "columns": [
                {"data": "id", orderable: false, searchable: false, className: 'text-center'},
                {"data": "word", className: 'text-center'},
                {"data": "translation", searchable: false, className: 'text-center'},
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
            order: [[1, "asc"]],
            bInfo: true,
            pageLength: <?php echo app_setting('records_per_page','10') ?>,
            buttons: [],
            initComplete: function () {
                initDatatableOptions();
            }
        }).on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
            initDatatableOptions();
        });
        $('body').on('click', '.btn-translate', function () {
            $('.data-list-table').find('.translate-abv').each(function (index, element) {
                var now = $(this);
                var dtt = now.closest('tr').find('.translate-ann');
                var str = now.html();
                str = str.replace(/<\/?[^>]+(>|$)/g, '');
                str = str.replace(/<\/?[^>]+(>|$)/g, '');
                dtt.val(str);
            });
        });
        $('body').on('click', '.btn-translate-save-all', function () {
            $('.data-list-table').find('form').each(function () {
                var nw = $(this);
                nw.find('.btn-submit').click();
            });
        });
    });
</script>