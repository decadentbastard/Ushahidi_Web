<!-- main body -->
<div id="green-header" style="width:930px; height: 45px; background: #9baf55; margin-left: 10px; margin-right: 10px; margin-bottom: 50px;" >
    <span style="margin-bottom: 0px; padding-bottom: 0px; font-size: 20px;"> Region - Current Reports </span>  
    <form action="/main/region" style="display: inline; padding-left: 150px; padding-top: 8px;">
      <select name="region" id="region" style="width:210px;" onchange="this.form.submit()">
      <option>Select your region</option>
      <option value="0">Beirut</option>
      <option value="1">South of Lebanon</option>
      <option value="2">Bekaa</option>
      <option value="3">Tripoli</option>
      </select>
    </form>
</div>
<div id="main" class="clearingfix" style="padding: 6px;">
	<div id="mainmiddle" class="floatbox withright">

	<?php if($site_message != '') { ?>
		<div class="green-box">
			<h3><?php echo $site_message; ?></h3>
		</div>
	<?php } ?>

		<!-- right column -->
		<div id="right" class="clearingfix" style="border: solid 1px #999; margin-top: 41px; height: 381px; width: 350px; padding-top: 5px;">
			<h5><?php echo Kohana::lang('ui_main.incidents_listed'); ?></h5>
			<table class="table-list">
				<thead>
					<tr>
						<th scope="col" class="title"><?php echo Kohana::lang('ui_main.title'); ?></th>
						<th scope="col" class="date"><?php echo Kohana::lang('ui_main.date'); ?></th>
						<th scope="col" class="location"><?php echo Kohana::lang('ui_main.location'); ?></th>
						<th scope="col" class="date"><?php echo Kohana::lang('ui_main.category'); ?></th>
						<th scope="col" class="location"><?php echo Kohana::lang('ui_main.support'); ?></th>
            <th scope="col" class="location"><?php echo Kohana::lang('ui_main.supporters'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
						if ($total_items == 0)
					{
					?>
					<tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_reports'); ?></td></tr>

					<?php
					}
					foreach ($incidents as $incident)
					{
						$incident_id = $incident->id;
						$incident_title = text::limit_chars($incident->incident_title, 40, '...', True);
						$incident_date = $incident->incident_date;
						$incident_date = date('M j Y', strtotime($incident->incident_date));
						$incident_location = $incident->location->location_name;
            $incident_supporters = $incident->incident_supporters;
            $incident_categories = $incident->category;
            $cat = "";
            $first = true;
            $category_image = "";
            $previous = ORM::factory('vote')
                        ->where('incident_id',$incident_id)
                        ->where('vote_ip',$_SERVER['REMOTE_ADDR'])
                        ->find();
            foreach ($incident_categories as $category)
            {
              // Check for localization of parent category
              $image_filename = $category->category_image;
              if($image_filename != NULL && file_exists(Kohana::config('upload.relative_directory').'/'.$image_filename)) {
                $category_image = html::image(array(
                  'src'=>Kohana::config('upload.relative_directory').'/'.$image_filename,
                  'style'=>'float:left;padding-right:5px;'
                  ));
              }
		          $l = Kohana::config('locale.language.0');
              $translated_title = Category_Lang_Model::category_title($category->id,$l);

              if($translated_title)
              {
                $display_title = $translated_title;
              }else{
                $display_title = $category->category_title;
              }
              if (!$first)
              {
                $cat . ", " . $display_title;
              } else {
                $cat = $display_title;
                $first = false;
              }
            }
					?>
					<tr style="background-color: #e9eaec;">
						<td><a href="<?php echo url::site() . 'reports/support/' . $incident_id; ?>"> <?php echo $incident_title ?></a></td>
						<td><?php echo $incident_date; ?></td>
						<td><?php echo $incident_location ?></td>
						<td><?php echo $category_image; ?></td>
            <td>
            <?php if ($previous->id == 0) { ?>
            <a href="" onclick="javascript:support('<?php echo $incident_id; ?>','oloader_<?php echo $incident_id; ?>');" class="support">
              <img  id="support_<?php echo $incident_id . '_img' ; ?>" src="/themes/madeenaty/images/support.png" />
            </a>
            <?php } else { ?>
            <img src="/themes/madeenaty/images/no_support.png" />
            <?php } ?>
            </td>
						<td id="support_<?php echo $incident_id; ?>"><?php echo $incident_supporters ?></td>
					</tr>
					<?php
					}
					?>

				</tbody>
			</table>
			<a class="more" href="<?php echo url::site() . 'reports/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
	
	
		</div>
		<!-- / right column -->
	
		<!-- content column -->
		<div id="content" class="clearingfix">
			<div class="floatbox">
			
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
		
        <div id="map-tab-cnt">	
          <div id="map-submit-tab">
            <p> Submit <br> a report </p>
          </div>	
          <div id="map-subscribe-tab">
            <p> Subscribe to this region </p>
          </div>	
        </div>
				<?php								
				// Map and Timeline Blocks
				echo $div_map;
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
		</div>
		<!-- / content column -->

	</div>
</div>
<!-- / main body -->

<!-- content -->
<div class="content-container">

	<!-- content blocks -->
	<div class="content-blocks clearingfix">

		<!-- left content block -->
		<div class="content-block-left">
		</div>
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