      <?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>
      <h1 class="head">
        <span style="color:#fff;height:30px;min-width:30px;background-color:#77403E;display:inline">&nbsp;
        </span>
        &nbsp;
        <?php
          $title = exhibit_builder_link_to_exhibit();
          echo $title;
        ?>
      </h1>
      <div id="exhibit-nav">
        <ul class="exhibit-section-nav">
          <li id="cul-general-exhibit-nav-title">
            <?php
              $title = exhibit_builder_link_to_exhibit(get_current_record('exhibit'),
						       "Home",
						       array('class' => 'section-nav-title'));
              echo $title;
            ?>
          </li>
          <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
          <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
            <?php 
              $html = '<li>' . '<a href="' . 
                      exhibit_builder_exhibit_uri(get_current_record('exhibit'), 
						  $exhibitPage) . '">' . 
                      cul_insert_angle_brackets(metadata($exhibitPage, 'title') ) . '</a></li>';
              echo $html;
            ?>
          <?php endforeach; ?>
        </ul>
      </div><!--end id="exhibit-nav"-->
      <div id="content">
        <?php echo flash(); ?>
        <div id="solidBlock">
          <table style="border-collapse:collapse">
            <tr>
              <td style="border-right:5px solid #fff;vertical-align:middle;padding:10px;width:380px">
                <h1>
                  <?php
                    $title = exhibit_builder_link_to_exhibit($exhibit);
                    $matches = explode(":",$title,2);
                  ?>
                  <?php
                    if (!is_null($matches[0]))
                      echo $matches[0];
                  ?>
                  <?php 
                    if ( (count($matches) == 2)
			 &&
			 (!is_null($matches[1]) ) )
                      echo ":<br />" . $matches[1];
                  ?>
                </h1>
              </td>
              <td>
                <?php
                  $uri = exhibit_builder_link_to_exhibit();
                  $imgFile = "";
                  $href = "";
                  $resolverURL = '';
                  if (stristr($uri,'plimpton')) {
                    $imgFile = 'hornbook2.jpg';
                    $resolverURL = "http://www.columbia.edu/cgi-bin/cul/resolve?lweb0116";
                  }
                  else if (stristr($uri,'melting-pot')) {
                    $imgFile = "sophietucker1.jpg";
                    $resolverURL = "http://www.columbia.edu/cgi-bin/cul/resolve?clio8012143";
                  }
                  else if (stristr($uri,'perkins')) {
                    $imgFile = "perkins1.jpg";
                    $resolverURL = 'http://www.columbia.edu/cgi-bin/cul/resolve?lweb0136';
                  }
                  else if (stristr($uri,'pulitzer')) {
                    $imgFile = "pulitzer-sm.jpg";
                    //$resolverURL = 'http://www.columbia.edu/cgi-bin/cul/resolve?lweb0136';
                  }
                  else if (stristr($uri, 'stokes')) {
                    $imgFile = "stokes1.jpg";
                    $resolverURL = 'http://www.columbia.edu/cgi-bin/cul/resolve?lweb0138';
                  }
                  else if (stristr($uri, 'nakedlunch')) {
                    $imgFile = "burroughs1.jpg";
                    $href = "nakedlunch/wsb/item/1067";
                    $resolverURL = 'http://www.columbia.edu/cgi-bin/cul/resolve?lweb0139';	
                  }
                  else if (stristr($uri, 'gumby')) {
                    $imgFile = "gumby-header.jpg";
                    //$href = "nakedlunch/wsb/item/1067";
                    //$resolverURL = 'http://www.columbia.edu/cgi-bin/cul/resolve?lweb0139';	
                  }
                  else if (stristr($uri,'music-centennial')) {
                    $imgFile = "music_home.jpg";
                  }
                  else if (stristr($uri,'hebrew_mss')) {
                    $imgFile = "hebrew_mss.jpg";
                  }
                  else if (stristr($uri,'kay')) {
                    $imgFile = "kay_home.jpg";
                  }
                ?>
                <?php 
                  if ($href != "")
                    echo '<a href="' . $href . '">';
                ?>
                <img src="<?php echo img($imgFile);?>" alt="<?php echo $href;?>">
                <?php if ($href != "") echo "</a>"; ?>
              </td>
            </tr>
          </table>
        </div><!--end id="solidBlock"-->
        <div class="exhibit-description">
          <?php echo $exhibit->description; ?>
        </div>
        <div id="exhibit-credits">	
          <h3>Exhibit Curator</h3>
          <p>
            <?php echo $exhibit->credits; ?>
          </p>
        </div>
        <div id="exhibit-sections">
          <?php 
            if ( !stristr($uri,'plimpton') && !stristr($uri,'gumby') ): 
             set_exhibit_pages_for_loop_by_exhibit();
              foreach (loop('exhibit_page') as $exhibitPage):
               $html = '<h3><a href="' . 
                exhibit_builder_exhibit_uri(get_current_record('exhibit'), $exhibitPage) . '">' . 
               cul_insert_angle_brackets(metadata($exhibitPage, 'title')) . '&nbsp;&raquo;</a></h3>';
                echo $html;
                $pageText = exhibit_builder_page_text(1);
                echo $pageText;
              endforeach;
            endif; 
          ?>
        </div><!--end id="exhibition-sections"-->
        <div style="float:right;font-style:italic">
          <?php if ($resolverURL != ""): ?>
            <p>Bookmark this page as: <a href="<?php echo $resolverURL;?>"><?=$resolverURL;?></a></p>
          <?php endif; ?>
        </div>
      </div><!--end id="content"-->
      <?php echo foot(); ?>

