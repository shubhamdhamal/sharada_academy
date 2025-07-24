<div class="card custom-card">
    <div class="card-header custom-card-header">
        <h5 class="card-title tx-dark tx-medium mb-0"><?php echo translate('updates') ?></h5>
        <div class="card-options">
            <?php if (count($updates->installable_updates) || count($updates->downloadable_updates)) { ?>
                <a href="<?php echo admin_site_url("settings/change-log"); ?>" class="btn ripple btn-primary btn-sm ajaxload-popup" data-placement="top" data-toggle="tooltip" title="<?php echo translate('update_details') ?>"> <i class="fa fa-info-circle"></i> </a>
            <?php } ?>
            <a href="javascript:void(0);" class="card-options-fullscreen" data-bs-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?php if (count($updates->installable_updates) || count($updates->downloadable_updates)) { ?>
            <div class="alert alert-solid-warning" role="alert">
                <strong><?php echo translate('warning!'); ?>
                </strong> <?php echo translate('please_backup_all_files_and_database_before_start_the_installation'); ?>
            </div>
            <ul class="list-group">
                <?php foreach ($updates->installable_updates as $version => $salt) { ?>
                    <a class="list-group-item list-group-item-action do-update" data-version="<?php echo $version; ?>" href="javascript:void(0);">
                        <?php echo translate('click_here_to_install_the_version'); ?> - <b><?php echo $version; ?></b>
                    </a>
                <?php } ?>
            </ul>
            <ul class="list-group">
                <?php foreach ($updates->downloadable_updates as $version => $salt) { ?>
                    <span><a class="list-group-item list-group-item-action download-updates" data-salt="<?php echo $salt; ?>" data-version="<?php echo $version; ?>" href="javascript:void(0);">
                        <?php echo translate('version'); ?> - <b><?php echo $version; ?></b> <?php echo translate('available,_awaiting_for_download'); ?>
                    </a></span>
                <?php } ?>
            </ul>
        <?php }else{ ?>
            <div class="alert alert-solid-success" role="alert">
                <strong><?php echo translate('well_done!'); ?>
                </strong> <?php echo translate('no_updates_found_your_system_is_updated'); ?>
            </div>
        <?php } ?>
    </div>
    <div class="card-footer">
        <strong><?php echo translate('current_version'); ?> : <?php echo app_setting("app_version"); ?></strong>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var startDownload = function () {
            var $link = $(".download-updates").first(), version = $link.attr("data-version"), salt = $link.attr("data-salt");
            if ($link.length) {
                $link.replaceWith('<a class="list-group-item list-group-item-action downloading downloading-' + version + '" href="javascript:void(0);"><span aria-hidden="true" class="spinner-border spinner-border-sm"></span> <?php echo translate("downloading_the_version"); ?> - <b>' + version + '</b>. <?php echo translate("please_wait..."); ?></a>');
                $.ajax({
                    type: 'POST',
                    url: "<?php echo admin_site_url("settings/download_updates"); ?>",
                    dataType: "json",
                    data : {version : version, salt : salt},
                    success: function (response) {
                        if (response.status) {
                            $(".downloading").parent().html("<a class='list-group-item list-group-item-action do-update' data-version='" + version + "' href='javascript:void(0);'>Click here to Install the version - <b>" + version + "</b></a>").removeClass("downloading");
                            startDownload();
                        } else {
                            $(".downloading").html("<p>" + response.message + "</p>").removeClass("downloading").addClass("alert alert-danger");
                        }
                    }
                });
            }
        };
        startDownload();
        $('body').on('click', '.do-update', function () {
            var version = $(this).attr("data-version");
            Swal.fire({
                title: "<?php echo translate('are_you_sure_to_update_?') ?>",
                text: "<?php echo translate('please_backup_all_files_and_database_before_start_the_installation'); ?>",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: "<?php echo translate('update_now') ?>",
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo admin_site_url("settings/do_update") ?>',
                        data: {version : version},
                        success: function (data) {
                            if(data.status){
                                swal("<?php echo translate('success') ?>", "<?php echo translate('system_has_been_updated_successfully') ?>", "success");
                                location.reload();
                            }else{
                                swal("<?php echo translate('failed') ?>", "<?php echo translate('updation_failed_please_try_again') ?>", "error");
                            }
                        }
                    });
                }
            })
        });
        $('.btn-popup').magnificPopup({
            type: 'iframe'
        });
    });
</script>