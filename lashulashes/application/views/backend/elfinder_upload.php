<!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->
<!-- jQuery and jQuery UI (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/elfinder/css/elfinder.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/elfinder/css/theme.css">

        <!-- elFinder JS (REQUIRED) -->
        <script src="<?php echo base_url() ?>assets/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript">
  var FileBrowserDialogue = {
    init: function() {
      // Here goes your code for setting your custom things onLoad.
    },
    mySubmit: function (URL) {
      // pass selected file path to TinyMCE
      parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);

      // force the TinyMCE dialog to refresh and fill in the image dimensions
      var t = parent.tinymce.activeEditor.windowManager.windows[0];
      t.find('#src').fire('change');

      // close popup window
      parent.tinymce.activeEditor.windowManager.close();
    }
  }

  $().ready(function() {
    var elf = $('#elfinder').elfinder({
      // set your elFinder options here
      url: '<?php echo base_url("elfinders/init") ?>',  // connector URL
      getFileCallback: function(file) { // editor callback
        // file.url - commandsOptions.getfile.onlyURL = false (default)
        // file     - commandsOptions.getfile.onlyURL = true
        FileBrowserDialogue.mySubmit(file); // pass selected file path to TinyMCE 
      }
    }).elfinder('instance');      
  });
</script>