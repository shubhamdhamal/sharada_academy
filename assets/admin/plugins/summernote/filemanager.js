/**
 *
 * copyright 2022 Akshay Gorad.
 * email: abgorad@gmail.com
 * license: Your chosen license, or link to a license file.
 *
 */

 (function (factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    module.exports = factory(require('jquery'));
  } else {
    factory(window.jQuery);
  }
}(function ($) {
  $.extend(true, $.summernote.lang, {
    'en-US': {
      image: {
        image: 'Image',
        insert: 'Insert Image',
        select: 'Select Image',
        url: 'Image URL'
      }
    }
  });
  $.extend($.summernote.options, {
    image: {
      icon: '<i class="note-icon-picture" />'
    },
    callbacks: {
      onImageInsert: null
    }
  });
  $.extend($.summernote.plugins, {
    /**
     *  @param {Object} context - context object has status of editor.
    */
    'image': function (context) {
      var self = this,
        ui = $.summernote.ui,
        $note = context.layoutInfo.note,
        $editor = context.layoutInfo.editor,
        $editable = context.layoutInfo.editable,
        $toolbar = context.layoutInfo.toolbar,
        options = context.options,
        lang = options.langInfo;
        context.memo('button.image', function () {
          var button = ui.button({
            contents: options.image.icon,
            tooltip: lang.image.image,
            click: function (e) {
              context.invoke('image.show');
            }
          });
          return button.render();
        });
        this.initialize = function () {
          var $container = options.dialogsInBody ? $(document.body) : $editor;
          var id = Date.now().toString(36) + Math.random().toString(36).substr(2);
          var url = filemanager_url+'?type=1&field_id='+id;
          var body = [
            '<div class="form-group note-group-image-url" style="overflow:auto;">',
            '<label class="note-form-label">' + lang.image.url + '</label>',
            '<small class="text-muted">(<a href="javascript:void(0);" data-url="'+url+'" class="btn-iframe">'+lang.image.select+'</a>)</small>',
            '<input class="note-image-url form-control note-form-control note-input ',
            ' col-md-12" type="text" id="'+id+'" />',
            '</div>'
          ].join('');
          var footer = '<button href="javascript:void(0);" class="btn btn-primary note-btn note-btn-primary note-image-btn">' + lang.image.insert + '</button>';
          this.$dialog = ui.dialog({
            title: lang.image.insert,
            body: body,
            footer: footer
          }).render().appendTo($container);
        };
        this.destroy = function () {
          ui.hideDialog(this.$dialog);
          this.$dialog.remove();
        };
        this.bindEnterKey = function ($input, $btn) {
          $input.on('keypress', function (event) {
            if (event.keyCode === 13)
              $btn.trigger('click');
          });
        };
        this.bindLabels = function () {
          self.$dialog.find('.form-control:first').focus().select();
          self.$dialog.find('label').on('click', function () {
            $(this).parent().find('.form-control:first').focus();
          });
        };
      this.show = function (data) {
        context.invoke('editor.saveRange');
        this.showImageDialog().then(function (data) {
          ui.hideDialog(self.$dialog);
          context.invoke('editor.restoreRange');
          if (typeof data === 'string') {
            $note.summernote('editor.insertImage', data);
          }
        }).fail(function () {
          context.invoke('editor.restoreRange');
        });
      };
      this.showImageDialog = function () {
        return $.Deferred(function (deferred) {
          var $imageUrl = self.$dialog.find('.note-image-url');
          var $imageBtn = self.$dialog.find('.note-image-btn');
          ui.onDialogShown(self.$dialog, function () {
              context.triggerEvent('dialog.shown');
              $imageBtn.click(function (e) {
                e.preventDefault();
                deferred.resolve($imageUrl.val());
              });
              $imageUrl.on('keyup paste', function() {
                var url = $imageUrl.val();
                ui.toggleBtn($imageBtn, url);
              }).val('');

              self.bindEnterKey($imageUrl, $imageBtn);
              self.bindLabels();
          });
          ui.onDialogHidden(self.$dialog, function () {
              $imageUrl.off('keyup paste keypress');
              $imageBtn.off('click');
              if (deferred.state() === 'pending')
                deferred.reject();
          });
          ui.showDialog(self.$dialog);
        });
      };
    }
  });
}));

/*(function (factory) {
  /* global define *
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // Node/CommonJS
    module.exports = factory(require('jquery'));
  } else {
    // Browser globals
    factory(window.jQuery);
  }
}(function ($) {
  $.extend($.summernote.plugins, {
    'image': function (context) {
      var self = this;
      var ui = $.summernote.ui;
      context.memo('button.image', function () {
        var button = ui.button({
          contents: '<i class="note-icon-picture" />',
          tooltip: "File Manager",
          click: function () {
            var se = $(this).closest('.note-editor').parent().children('.summernote');
            alert(se);
            //imageDialog($(this).closest('.note-editor').parent().children('.summernote'));

            var url = filemanager_url+'?type=1&field_id=rfmimage';
            Fancybox.show([{
              src: url,
              type: "iframe",
              preload: false
            },]);



          }
        });
        var $image = button.render();
        return $image;
      });
      this.destroy = function () {
        this.$panel.remove();
        this.$panel = null;
      };
    }
  });
}));*/