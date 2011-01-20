        <!-- footer -->
        <div id="footer" class="clearingfix">
       
          <div id="underfooter"></div>
              
          <!-- footer content -->
          <div class="rapidxwpr floatholder">
            <div class="footer-social">
              <a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-via="madeenaty">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
              <iframe src="http://www.facebook.com/plugins/like.php?href=http://www.madeenaty.org/" scrolling="no" frameborder="0" style="border:none; width:50px; height:20px"></iframe>
            </div>
       
          
            <!-- footer menu -->
            <div class="footermenu">
              <ul class="clearingfix">
                <li><a class="item1" href="<?php echo url::site(); ?>"><?php echo Kohana::lang('ui_main.home'); ?></a></li>
                <li><a href="<?php echo url::site()."reports/submit"; ?>"><?php echo Kohana::lang('ui_main.submit'); ?></a></li>
                <li><a href="<?php echo url::site()."alerts"; ?>"><?php echo Kohana::lang('ui_main.alerts'); ?></a></li>
                <li><a href="<?php echo url::site()."contact"; ?>"><?php echo Kohana::lang('ui_main.contact'); ?></a></li>
                <?php
                // Action::nav_main_bottom - Add items to the bottom links
                Event::run('ushahidi_action.nav_main_bottom');
                ?>
              </ul>
              <?php if($site_copyright_statement != '') { ?>
                <p><?php echo $site_copyright_statement; ?></p>
              <?php } ?>
            </div>
            <!-- / footer menu -->

          </div>
          <!-- / footer content -->
       
        </div>
        <!-- / footer -->
			</div>
		</div>
		<!-- / main body -->

	</div>
	<!-- / wrapper -->
 
	<?php echo $ushahidi_stats; ?>
	<?php echo $google_analytics; ?>
	
	<!-- Task Scheduler -->
	<img src="<?php echo url::base(); ?>media/img/spacer.gif" alt="" height="1" width="1" border="0" onload="runScheduler(this)" />
 
	<?php
	// Action::main_footer - Add items before the </body> tag
	Event::run('ushahidi_action.main_footer');
	?>
</body>
</html>
