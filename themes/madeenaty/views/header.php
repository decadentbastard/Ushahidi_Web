<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php echo $header_block; ?>
	<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>
</head>

<!-- main body -->
<div id="main" class="clearingfix">
	<div id="mainmiddle" class="floatbox withright">

<body id="page">
	<!-- wrapper -->
	<div class="rapidxwpr floatholder">

		<!-- main body -->
		<div id="middle">
    <!--
    <div id="top">
    </div>
    -->
    <!-- / mainmenu -->
		<div id="header">
			<!-- logo -->
			<div id="logo">
          <!-- languages -->
          <?php echo $languages;?>
          <!-- languages -->
          <ul>
            <?php nav::main_tabs($this_page); ?>
          </ul>
				<h1><?php echo $site_name; ?></h1>
			</div>
			<!-- / logo -->
			
			<!-- submit incident -->
			<?php echo $submit_btn; ?>
			<!-- / submit incident -->
			
		</div>
		<!-- / header -->


				<!-- mainmenu -->
