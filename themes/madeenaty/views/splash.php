<!-- main body -->
<div id="main" class="" style="padding: 6px;">
	<div id="mainmiddle" class="floatbox withright">

	<?php if($site_message != '') { ?>
		<div class="green-box">
			<h3><?php echo $site_message; ?></h3>
		</div>
	<?php } ?>

		<!-- right column -->
	
		<!-- content column -->
		<div id="content" class="">
			<div class="splash-floatbox">
			
				<!-- filters
				<div class="filters clearingfix">
					<div style="float:left; width: 100%">
						<strong><?php echo Kohana::lang('ui_main.filters'); ?></strong>
						<ul>
							<li><a id="media_0" class="active" href="#"><span><?php echo Kohana::lang('ui_main.reports'); ?></span></a></li>
							<li><a id="media_4" href="#"><span><?php echo Kohana::lang('ui_main.news'); ?></span></a></li>
							<li><a id="media_1" href="#"><span><?php echo Kohana::lang('ui_main.pictures'); ?></span></a></li>
							<li><a id="media_2" href="#"><span><?php echo Kohana::lang('ui_main.video'); ?></span></a></li>
							<li><a id="media_3" href="#"><span><?php echo Kohana::lang('ui_main.all'); ?></span></a></li>
						</ul>
					</div>
					<?php
					// Action::main_filters - Add items to the main_filters
					Event::run('ushahidi_action.map_main_filters');
					?>
				</div>
				 / filters -->
		
				<?php								
				// Map and Timeline Blocks
				echo $div_map;
        ?>
        <div id="splash-tab-cnt">	
          <div id="splash-submit-tab">
            <p> Submit <br> a report </p>
          </div>	
        </div>
        <?php
				echo $div_timeline;
				?>
			</div>
			<!-- category filters -->
		
			<ul id="category_switch" class="category-filters">
				<li><a id="cat_0" href="#"><span><img src="/themes/madeenaty/images/category.png" /></span><span class="category-title"><?php echo Kohana::lang('ui_main.all_categories');?></span></a></li>
				<?php
          $cat_counter = 1;
					foreach ($categories as $category => $category_info)
					{
            if ($cat_counter%3 == 0 and $cat_counter != (count($categories) + 1)  ) {
              $column = $cat_counter/3;
              $left = $column*180;  
              $bottom = $column*175;
              echo "</ul><ul class='category-filters category-column' style='margin-left:" . $left . "px; bottom:" . $bottom ."px;'>";
            } 
            $cat_counter++;
						$category_title = $category_info[0];
						$category_color = $category_info[1];
						$category_image = '';
						$color_css = 'class="swatch" style="background-color:#'.$category_color.'"';
						if($category_info[2] != NULL && file_exists(Kohana::config('upload.relative_directory').'/'.$category_info[2])) {
							$category_image = html::image(array(
								'src'=>Kohana::config('upload.relative_directory').'/'.$category_info[2],
								'style'=>'float:left;padding-right:5px;'
								));
							$color_css = '';
						}
						echo '<li><a href="#" id="cat_'. $category .'"><span '.$color_css.'>'.$category_image.'</span><span class="category-title">'.$category_title.'</span></a>';
						// Get Children
						echo '<div class="hide" id="child_'. $category .'">';
                                                if( sizeof($category_info[3]) != 0)
                                                {
                                                    echo '<ul>';
                                                    foreach ($category_info[3] as $child => $child_info)
                                                    {
                                                            $child_title = $child_info[0];
                                                            $child_color = $child_info[1];
                                                            $child_image = '';
                                                            $color_css = 'class="swatch" style="background-color:#'.$child_color.'"';
                                                            if($child_info[2] != NULL && file_exists(Kohana::config('upload.relative_directory').'/'.$child_info[2])) {
                                                                    $child_image = html::image(array(
                                                                            'src'=>Kohana::config('upload.relative_directory').'/'.$child_info[2],
                                                                            'style'=>'float:left;padding-right:5px;'
                                                                            ));
                                                                    $color_css = '';
                                                            }
                                                            echo '<li style="padding-left:20px;"><a href="#" id="cat_'. $child .'"><span '.$color_css.'>'.$child_image.'</span><span class="category-title">'.$child_title.'</span></a></li>';
                                                    }
                                                    echo '</ul>';
                                                }
						echo '</div></li>';
					}
				?>
			</ul>
			<!-- / category filters -->
			
			<?php
			if ($layers)
			{
				?>
				<!-- Layers (KML/KMZ) -->
				<div class="cat-filters">
					<strong><?php echo Kohana::lang('ui_main.layers_filter');?> <span>[<a href="javascript:toggleLayer('kml_switch_link', 'kml_switch')" id="kml_switch_link"><?php echo Kohana::lang('ui_main.hide'); ?></a>]</span></strong>
				</div>
				<ul id="kml_switch" class="category-filters">
					<?php
					foreach ($layers as $layer => $layer_info)
					{
						$layer_name = $layer_info[0];
						$layer_color = $layer_info[1];
						$layer_url = $layer_info[2];
						$layer_file = $layer_info[3];
						$layer_link = (!$layer_url) ?
							url::base().Kohana::config('upload.relative_directory').'/'.$layer_file :
							$layer_url;
						echo '<li><a href="#" id="layer_'. $layer .'"
						onclick="switchLayer(\''.$layer.'\',\''.$layer_link.'\',\''.$layer_color.'\'); return false;"><div class="swatch" style="background-color:#'.$layer_color.'"></div>
						<div>'.$layer_name.'</div></a></li>';
					}
					?>
				</ul>
				<!-- /Layers -->
				<?php
			}
			?>
			
			
			<?php
			if ($shares)
			{
				?>
				<!-- Layers (Other Ushahidi Layers) -->
				<div class="cat-filters" style="margin-top:20px;">
					<strong><?php echo Kohana::lang('ui_main.other_ushahidi_instances');?> <span>[<a href="javascript:toggleLayer('sharing_switch_link', 'sharing_switch')" id="sharing_switch_link"><?php echo Kohana::lang('ui_main.hide'); ?></a>]</span></strong>
				</div>
				<ul id="sharing_switch" class="category-filters">
					<?php
					foreach ($shares as $share => $share_info)
					{
						$sharing_name = $share_info[0];
						$sharing_color = $share_info[1];
						echo '<li><a href="#" id="share_'. $share .'"><div class="swatch" style="background-color:#'.$sharing_color.'"></div>
						<div>'.$sharing_name.'</div></a></li>';
					}
					?>
				</ul>
				<!-- /Layers -->
				<?php
			}
			?>
			
			
			<br />
		
			
			<?php
			// Action::main_sidebar - Add Items to the Entry Page Sidebar
			Event::run('ushahidi_action.main_sidebar');
			?>
		</div>
		<!-- / content column -->

	</div>
</div>
<!-- / main body -->

<!-- content -->
<div class="content-container">

	<!-- content blocks -->
	<div class="content-blocks">

		<!-- left content block -->
		<!-- / left content block -->

		<!-- right content block -->
		<div class="content-block-right" style="display:none;">
			<h5><?php echo Kohana::lang('ui_main.official_news'); ?></h5>
			<table class="table-list">
				<thead>
					<tr>
						<th scope="col"><?php echo Kohana::lang('ui_main.title'); ?></th>
						<th scope="col"><?php echo Kohana::lang('ui_main.source'); ?></th>
						<th scope="col"><?php echo Kohana::lang('ui_main.date'); ?></th>
					</tr>
				</thead>
					<?php
                                        if ($feeds->count() != 0)
                                        {
                                            echo '<tbody>';
                                            foreach ($feeds as $feed)
                                            {
                                                    $feed_id = $feed->id;
                                                    $feed_title = text::limit_chars($feed->item_title, 40, '...', True);
                                                    $feed_link = $feed->item_link;
                                                    $feed_date = date('M j Y', strtotime($feed->item_date));
                                                    $feed_source = text::limit_chars($feed->feed->feed_name, 15, "...");
                                            ?>
                                            <tr>
                                                    <td><a href="<?php echo $feed_link; ?>" target="_blank"><?php echo $feed_title ?></a></td>
                                                    <td><?php echo $feed_source; ?></td>
                                                    <td><?php echo $feed_date; ?></td>
                                            </tr>
                                            <?php
                                            }
                                            echo '</tbody>';
                                        }
                                        else
                                        {
                                            echo '<tbody><tr><td></td><td></td><td></td></tr></tbody>';
                                        }
					?>
			</table>
			<a class="more" href="<?php echo url::site() . 'feeds' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
		</div>
		<!-- / right content block -->

	</div>
	<!-- /content blocks -->

</div>
<!-- content -->
