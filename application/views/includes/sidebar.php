    <!-- Start Sidebar -->
    <div id="sidebar">

      <!-- Start Live Search  -->
      <form class="searchform" action="#">
        <input id="livesearch" type="text" onblur="if (this.value == '') {this.value = 'Live Search...';}" onfocus="if (this.value == 'Live Search...') {this.value = '';}" value="Live Search..." class="searchfield" />
        <input type="button" value="Go" class="searchbutton" />
      </form>
      <!-- End Live Search  -->
      <!-- Start Content Nav  -->
      <span class="ul-header"><a id="toggle-pagesnav" href="#" class="toggle visible">Jobs</a></span>
      <ul id="pagesnav">
        <li><a class="icn_manage_pages" href="<?php echo base_url().'login/managejobs' ?>">Manage Jobs</a></li>
        <li><a class="icn_add_pages" href="<?php echo base_url().'login/addjob' ?>">Add Job</a></li>
      </ul>
      <!-- End Content Nav  -->
      <!-- Start Comments Nav  -->
      <span class="ul-header"><a id="toggle-commentsnav" href="#" class="toggle visible">Applications</a></span>
      <ul id="commentsnav">
        <li><a class="icn_manage_comments" href="<?php echo base_url().'login/manageapps' ?>">Manage Apps</a></li>
        <li><a class="icn_add_comments" href="<?php echo base_url().'login/addapp' ?>">Add App</a></li>
      </ul>
      <!-- End Comments Nav  -->

      <span class="ul-header"><a id="toggle-pagesnav" href="#" class="toggle visible">Bots</a></span>
      <ul id="pagesnav">
        <li><a class="icn_manage_pages" href="<?php echo base_url().'login/managebots' ?>">Manage Bots</a></li>
        <li><a class="icn_add_pages" href="<?php echo base_url().'login/addbot' ?>">Add Bot</a></li>
      </ul>

    </div>
    <!-- End Sidebar  -->