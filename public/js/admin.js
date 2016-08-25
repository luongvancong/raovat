$(function() {
   // Warning when delete an item
   //
   $('.btn-delete-action').click(function(ev) {
      ev.preventDefault();
      var answer = confirm('Bạn có chắc chắn muốn xóa bản ghi này?');
      if (answer) return window.location.href = $(this).attr('href');
      else return false;
   });

   $('.btn-active-action')
   .hover(toggleStyleEditBtn, toggleStyleEditBtn)
   .click(function(e) {
      e.preventDefault();
      var $this = $(this);
      $.ajax({
         url : $this.attr('href'),
         type : 'GET',
         dataType : 'json',
         beforeSend: function() {
            // initSpin();
         },
         success : function(data) {

            $(document).trigger('action_active_success');

            // stopSpin();
            if(data.code === 1) {
               var _btn = $this.find('i');
               if(data.status == 1) {
                  $this.html('<i class="fa fa-check-square fa-2x"></i>');
               }else{
                  $this.html('<i class="fa fa-square-o fa-2x"></i>');
               }
            }else{
               alert(data.message);
            }
         }
      })
   });

   $('.checkbox_all').click(function(ev) {
      var that = $(this);
      that.parents('.checkbox-list').find('.checkbox-child').prop('checked', that.is(':checked'));
   });
});

/**
 * Preview image before upload
 * @param  event
 * @return img dom
 */
function fileSelect(evt) {
   if (window.File && window.FileReader && window.FileList && window.Blob) {
      var files = evt.target.files;
      var result = '';
      var file;
      for (var i = 0; file = files[i]; i++) {
         // if the file is not an image, continue
         if (!file.type.match('image.*')) {
            continue;
         }

         reader = new FileReader();
         reader.onload = (function (tFile) {
            return function (evt) {
               var div = document.createElement('div');
               div.className = "img-preview-wrapper";
               div.innerHTML = '<img class="img-preview" src="' + evt.target.result + '" />';
               $('.preview-uploader').html(div);
            };
         }(file));
         reader.readAsDataURL(file);
      }
   } else {
      alert('The File APIs are not fully supported in this browser.');
   }
}

/**
 * Hàm thay đổi style class cho nút active
 */
function toggleStyleEditBtn () {
   var _btn = $(this).find('i');
   if (_btn.hasClass('fa-check-square')) {
      _btn.removeClass('fa-check-square').addClass('fa-square-o fa-2x');
   } else {
      _btn.removeClass('fa-square-o').addClass('fa-check-square fa-2x');
   }
}
