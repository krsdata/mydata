<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>elFinder 2.0</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/elfinder/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/elfinder/css/theme.css">

		<script type="text/javascript" src="<?php echo BACKEND_THEME_URL ?>assets/tinymce/tinymce.min.js"></script>
		<!-- elFinder JS (REQUIRED) -->
		<script src="<?php echo base_url() ?>assets/elfinder/js/elfinder.min.js"></script>

		<!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->

		<script type="text/javascript">
		/*  var FileBrowserDialogue = {
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
		      url: '<?php echo base_url("elfinders") ?>',  // connector URL
		      getFileCallback: function(file) { // editor callback
		        // file.url - commandsOptions.getfile.onlyURL = false (default)
		        // file     - commandsOptions.getfile.onlyURL = true
		        FileBrowserDialogue.mySubmit(file); // pass selected file path to TinyMCE 
		      }
		    }).elfinder('instance');      
		  });*/
		</script>

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">

/*

			// Documentation for client options:
			// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
			$(document).ready(function() {
				$('#elfinder').elfinder({
					url : '<?php echo base_url("elfinders") ?>'  // connector URL (REQUIRED)
					// , lang: 'ru'                    // language (OPTIONAL)
				});
			});*/
		</script>

		<!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->

		<script type="text/javascript">
		  var FileBrowserDialogue = {
		    init: function() {
		      // Here goes your code for setting your custom things onLoad.
		    },
		    mySubmit: function (URL) {
		      // pass selected file data to TinyMCE
		      parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);
		      // close popup window
		      var t = parent.tinymce.activeEditor.windowManager.windows[0];
              t.find('#src').fire('change');

		      parent.tinymce.activeEditor.windowManager.close();
		    }
		  }

		  $().ready(function() {
		    var elf = $('#elfinder').elfinder({
		      // set your elFinder options here
		      url: '<?php echo base_url("elfinders/init") ?>',  // connector URL
		      getFileCallback: function(file) { // editor callback
		      	//console.log(file);
		        // Require `commandsOptions.getfile.onlyURL = false` (default)
		        FileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE 
		      }
		    }).elfinder('instance');      
		  });
		</script>

	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
