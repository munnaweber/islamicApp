tinyMCE.init({
  forced_root_block : '',
  selector:'.tinyarea',
  menubar: true,
    plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak placeholder',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools',
    ],
    toolbar1: 'code | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image | print preview media | cut copy paste | forecolor backcolor | fontselect fontsizeselect',
    image_advtab: true,
    
  
    file_browser_callback: function(field, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
            file: 'http://localhost:8000/assets/tinymice/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
            title: 'Filemanager',
            width: 900,
            height: 400,
            inline: true,
            close_previous: false
        }, {
            window: win,
            input: field
        });
        return false;
    },
    height: '400',
    placeholder: "এখানে লিখুন",
});