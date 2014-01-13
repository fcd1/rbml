      <?php
        echo head(array('title' => metadata('exhibit', 'title'),'bodyclass' => 'exhibits show'));
      ?>
      <h1 class="head">
        <span style="color:#fff;height:30px;min-width:30px;background-color:#77403E;display:inline">
          &nbsp;
        </span>
        &nbsp;
        <?php
          $title = exhibit_builder_link_to_exhibit();
          echo $title;
        ?>
      </h1>
      <?php
        // fcd1, 9/9/11: In Omeka 1.5.3, exhibitions had sections, with no landing page.
        // When a section was selected, the first page in the section was displayed
        // From Omeka 2.0 on, there are no more sections. Instead, there are top-level
        // pages, which can have content, and these top-level pages can have child pages.
        // To mimic the Omeka 1.5.3 behavior for legacy exhibitions that were ported to
        // Omeka 2.1, we need to check if the current page is a top-level page, and 
        // display the content of the first child, if there is one. We also need this 
        // info so that "Next" links to the correct page
        $currentExhibitPage = get_current_record('exhibit_page');
        $exhibitPageParent = $currentExhibitPage->getParent();      
        $firstChild = null;
        if (!($exhibitPageParent)) {
          // this is a top-level page, and we want section-like behavior. First page in "section" will display
          // and the breadcrumb links have to reflect this
          $firstChild = $currentExhibitPage->getFirstChildPage();
        }
      ?>
      <div id="exhibit-nav">
        <?php 
          echo cul_legacy_exhibit_builder_page_nav($firstChild);
        ?>
      </div>
      <div id="content">
        <?php echo flash(); ?>
        <div id="primary">
          <div class="exhibit-content">
            <?php $pn = culWritePrevNext($firstChild); ?>
            <?php echo $pn; ?>
            <?php 
              //fcd1, 9/9/13: if this is a top-level page and the page has a child,
              // $firstChild will point to the first child. Otherwise, it is null
              echo cul_general_breadcrumb($firstChild); 
              exhibit_builder_render_exhibit_page($firstChild);
            ?>
            <?php echo $pn; ?>
            <p>&nbsp;</p>
          </div> <!--end class="exhibit-content"-->
        </div> <!--end class="primary"-->
      </div><!--end content-->
      <?php echo foot(); ?>
