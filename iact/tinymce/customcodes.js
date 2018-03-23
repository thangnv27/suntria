// Add Button Hộp thông báo
(function() {  
    tinymce.create('tinymce.plugins.btntuyendung', {  
        init : function(ed, url) {  
            ed.addButton('btntuyendung', {  
                title : 'Thêm nút xem hình thức ứng tuyển',				
                image : url+'/button-download.png',  
                onclick : function() {  
                     ed.selection.setContent('[btntuyendung]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('btntuyendung', tinymce.plugins.btntuyendung);  
})();